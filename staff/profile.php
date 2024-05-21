<?php
include('header.php');

$getname = '';
$getcontact = '';
$getdepartment = '';
$getfaculty = '';
$errors = [];

// Ensure that the $indexnumber variable is set correctly
$indexnumber = $_SESSION['indexnumber']; // Assuming you're storing it in session

// Get the details of the staff
$getStaff = "SELECT * FROM staff WHERE indexnumber=:indexnumber LIMIT 1";
$stmt = $conn->prepare($getStaff);
$stmt->execute(['indexnumber' => $indexnumber]);

// Get the result in an array
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $stmt->rowCount();

if ($userCount > 0) {
    $getname = $row['name'];
    $getcontact = $row['contact'];
    $getdepartment = $row['department'];
    $getfaculty = $row['faculty'];
} else {
    // Handle case where no staff is found
    $errors[] = "No staff found with the provided index number.";
}

// Update staff info
if (isset($_POST['submit'])) {
    // Get all the data from the form fields
    $name = htmlentities($_POST['name']);
    $contact = htmlentities($_POST['contact']);

    // Validate form fields
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    if (empty($contact)) {
        $errors['contact'] = "Contact is required";
    }

    if (count($errors) === 0) {
        // Let's edit the details
        $SQL = "UPDATE staff SET name=:name, contact=:contact WHERE indexnumber=:indexnumber";
        $stmt = $conn->prepare($SQL);
        $isExecuted = $stmt->execute([
            'name' => $name,
            'contact' => $contact,
            'indexnumber' => $indexnumber
        ]);

        if ($isExecuted) {
            $_SESSION['message'] = "$indexnumber, your profile has been updated";
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] = "$indexnumber, your profile failed to be updated";
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    }
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                        <span>Manage Profile</span>
                    </h1>
                </div>
            </div>
        </div>

        <!--Start Form-->
        <div class="container-fluid mt-n10">
            <div class="card mb-4">
                <div class="card-header">Your Details</div>
                <div class="card-body">
                    <form method="POST">

                        <div class="text-center">
                            <?php
                            if (count($errors) > 0) :
                            ?>
                                <div class="alert alert-danger">
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?php echo $error; ?></li><br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                                    <strong> <?php echo $_SESSION['message'];
                                                unset($_SESSION['message']);
                                                unset($_SESSION['alert-class']);
                                                ?></strong>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row col-md-6 offset-md-3">

                            <label for="user-name">Name </label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $getname ?>">

                            <br>

                            <label for="index">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $getcontact; ?>">
                            <br>

                            <label for="index">Faculty</label>
                            <input type="text" name="faculty" id="faculty" class="form-control" disabled value="<?php echo $getfaculty ?>">
                            <br>

                            <label for="index">Department</label>
                            <input type="text" name="department" id="department" class="form-control" disabled value="<?php echo $getdepartment ?>">
                            <br>

                        </div>

                        <br>
                        <div class="row col-md-6 offset-md-3">
                            <div class="col-6">
                                <button class="btn btn-primary mr-2 my-1 form-control" type="submit" name="submit">Edit Profile</button>
                            </div>

                            <div class="col-6">
                                <a class="btn btn-success mr-2 my-1 form-control" href="changePassword.php">Change Password</a>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
        <!--End Form-->

    </main>

</div>

<!--Script JS-->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>