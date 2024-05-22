<?php
include('header.php');

if (isset($_GET['id'])) {
    $facultyId = $_GET['id'];

    // Validate faculty ID
    if (!empty($facultyId)) {
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Delete faculty from the faculty table
            $deleteFacultyQuery = "DELETE FROM faculty WHERE id=:facultyId";
            $facultyStmt = $conn->prepare($deleteFacultyQuery);
            $facultyStmt->bindParam(':facultyId', $facultyId, PDO::PARAM_INT);
            $facultyStmt->execute();

            // Commit transaction
            $conn->commit();

            $_SESSION['message'] = "Faculty has been deleted successfully.";
            $_SESSION['alert-class'] = "alert alert-success";
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollBack();
            $_SESSION['message'] = "Failed to delete faculty: " . $e->getMessage();
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    } else {
        $_SESSION['message'] = "Invalid faculty ID.";
        $_SESSION['alert-class'] = "alert alert-danger";
    }
} else {
    $_SESSION['message'] = "Faculty ID not provided.";
    $_SESSION['alert-class'] = "alert alert-danger";
}

header('Location: faculty.php');
exit();
?>
