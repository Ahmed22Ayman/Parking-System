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