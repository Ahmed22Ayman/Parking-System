<?php
include('header.php');

if (isset($_GET['id'])) {
    $studentid = $_GET['id'];

    // Validate student ID
    if (!empty($studentid)) {
        $deleteQuery = "DELETE FROM student WHERE id=:studentid";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':studentid', $studentid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student has been deleted successfully.";
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] = "Failed to delete student.";
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    } else {
        $_SESSION['message'] = "Invalid student ID.";
        $_SESSION['alert-class'] = "alert alert-danger";
    }
} else {
    $_SESSION['message'] = "Student ID not provided.";
    $_SESSION['alert-class'] = "alert alert-danger";
}

header('Location: manage-student.php');
exit();
?>
