<?php
include('header.php');

// Get the details of the student
$getStudent = "Select * from student WHERE indexnumber=:indexnumber LIMIT 1";
$stmt = $conn->prepare($getStudent);
$stmt->bindParam("s", $id, PDO::PARAM_STR);
$stmt->execute(['indexnumber' => $indexnumber]);

//Get the result in an array
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $stmt->rowCount();

if ($userCount > 0) {
    $getname = $row['name'];
    $getcontact = $row['contact'];
    $getdepartment = $row['department'];
    $getfaculty = $row['faculty'];
}

//update student info
if (isset($_POST['submit'])) {
    //get all the data from the field
    $name = htmlentities($_POST['name']);
    $contact = htmlentities($_POST['contact']);

    //validate all the fields
    if (empty($name)) {
        $errors['name'] = "Name Is Required";
    }

    if (empty($contact)) {
        $errors['contact'] = "Contact Is Required";
    }

    if (count($errors) === 0) {
        //Lets edit the details
        $SQL = "UPDATE student SET name=:name,contact=:contact WHERE indexnumber=:indexnumber";
        $stmt = $conn->prepare($SQL);
        $stmt->bindParam('s', $name, PDO::PARAM_STR);
        $stmt->bindParam('s', $indexnumber, PDO::PARAM_STR);
        $stmt->bindParam('s', $contact, PDO::PARAM_STR);

        $isExecuted = $stmt->execute([
            'name' => $name,
            'indexnumber' => $indexnumber,
            'contact' => $contact
        ]);

        if ($isExecuted) {
            $_SESSION['message'] = $indexnumber . ", Your Profile Has Been Updated";
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] = $indexnumber . ", Your Profile Failed To Be Updated";
            $_SESSION['alert-class'] = "alert alert-success";
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