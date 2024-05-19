<?php
include('header.php');

//get the parking name from the url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Get the details of the id in the url
$bookNameSQL = "Select * from booking WHERE id=:id LIMIT 1";
$stmt = $conn->prepare($bookNameSQL);
$stmt->bindParam("s", $id, PDO::PARAM_STR);
$stmt->execute(['id' => $id]);

//Get the result in an array
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $stmt->rowCount();

if ($userCount > 0) {
    $parking_lot = $row['parking_lot'];
    $carnumber = $row['carnumber'];
    $contact = $row['contact'];
}

$_SESSION['message'] =  "Are you sure of releasing parking space??";
$_SESSION['alert-class'] = "alert alert-warning";

//############################################
//codes to release space
if (isset($_POST['submit'])) {

    if (count($errors) === 0) {
        $bookSQL = "DELETE FROM booking WHERE id=:id;
                    UPDATE parking_lot SET status='Active' WHERE name=:parking_lot";
        $bookSQLStmt = $conn->prepare($bookSQL);
        $bookSQLStmt->bindParam('s', $parking_lot, PDO::PARAM_STR);
        $bookSQLStmt->bindParam(':id', $id, PDO::PARAM_INT);

        //execute query
        $is_executed = $bookSQLStmt->execute([
            'parking_lot' => $parking_lot,
            'id' => $id
        ]);

        if ($is_executed) {
            $_SESSION['message'] =  $parking_lot . ' Released Successfully' . $indexnumber;
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] =  "Booking Release Failed";
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    }
}


