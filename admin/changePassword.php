<?php
include('header.php');


//update student info
if (isset($_POST['submit'])) {
    //get all the data from the field
    $oldpassword = htmlentities($_POST['oldpassword']);
    $newpassword = htmlentities($_POST['newpassword']);
    $confirmnewpassword = htmlentities($_POST['confirmnewpassword']);

    //validate all the fields
    if(empty($oldpassword)){
        $errors['oldpassword'] = "Old Password Is Required";
    }

    if(empty($newpassword)){
        $errors['newpassword'] = "New Password Is Required";
    }

    if(empty($confirmnewpassword)){
        $errors['confirmnewpassword'] = "Confirm New Password Is Required";
    }

    if(($newpassword) != ($confirmnewpassword)){
        $errors['misPassword'] = "New Password and Confirm Password Are Different";
    }

    if (count($errors) === 0) {
         // hash the new password
         $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);