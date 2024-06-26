<?php
include('header.php');
$errors = array();
// get the id of the user to be updated
$studentid = $_GET['id'];
// Get the details of the student
$getStudent = "SELECT * FROM student WHERE id=:studentid LIMIT 1";
$stmt = $conn->prepare($getStudent);
$stmt->bindParam(':studentid', $studentid, PDO::PARAM_STR);
$stmt->execute(['studentid' => $studentid]);

// Get the result in an array
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $stmt->rowCount();

if ($userCount > 0) {
    $getname = $row['name'];
    $getcontact = $row['contact'];
    $getdept = $row['department'];
    $getfaculty = $row['faculty'];
}

// Update student info
if (isset($_POST['submit'])) {
    // Get all the data from the field
    $name = htmlentities($_POST['name']);
    $contact = htmlentities($_POST['contact']);

    // Validate all the fields
    if (empty($name)) {
        $errors['name'] = "Name Is Required";
    }

    if (empty($contact)) {
        $errors['contact'] = "Contact Is Required";
    }

    if (count($errors) === 0) {
        // Let's edit the details
        $SQL = "UPDATE student SET name=:name, contact=:contact WHERE id=:studentid";
        $stmt = $conn->prepare($SQL);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
        $stmt->bindParam(':studentid', $studentid, PDO::PARAM_STR);

        $isExecuted = $stmt->execute([
            'name' => $name,
            'contact' => $contact,
            'studentid' => $studentid
        ]);

        if ($isExecuted) {
            $_SESSION['message'] = $getname . ", Student Details Have Been Updated";
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] = $getname . ", Student Profile Failed To Be Updated";
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
                        <span>Edit Student Profile</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Start Form -->
        <div class="container-fluid mt-n10">
            <div class="card mb-4">
                <div class="card-header">Current Student Details</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="text-center">
                            <?php if (count($errors) > 0) : ?>
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
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $getname ?>">

                            <br>

                            <label for="contact">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $getcontact ?>">

                            <br>

                            <label for="faculty">Faculty</label>
                            <input type="text" name="faculty" id="faculty" readonly class="form-control" value="<?php echo $getfaculty ?>">

                            <br>

                            <label for="department">Department</label>
                            <input type="text" name="department" id="department" readonly class="form-control" value="<?php echo $getdept ?>">

                            <br>
                        </div>

                        <br>
                        <div class="row col-md-6 offset-md-3">
                            <div class="col-12">
                                <button class="btn btn-primary mr-2 my-1 form-control" type="submit" name="submit">Edit Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Form -->

    </main>
</div>

<!-- Script JS -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
