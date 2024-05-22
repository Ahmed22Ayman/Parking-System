<?php
include('header.php');

if (isset($_GET['id'])) {
    $staffId = $_GET['id'];

    // Validate staff ID
    if (!empty($staffId)) {
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Delete staff from the authentication table
            $deleteAuthQuery = "DELETE FROM authentication WHERE indexnumber=(SELECT indexnumber FROM staff WHERE id=:staffId)";
            $authStmt = $conn->prepare($deleteAuthQuery);
            $authStmt->bindParam(':staffId', $staffId, PDO::PARAM_INT);
            $authStmt->execute();

            // Delete staff from the staff table
            $deleteStaffQuery = "DELETE FROM staff WHERE id=:staffId";
            $staffStmt = $conn->prepare($deleteStaffQuery);
            $staffStmt->bindParam(':staffId', $staffId, PDO::PARAM_INT);
            $staffStmt->execute();

            // Commit transaction
            $conn->commit();

            $_SESSION['message'] = "Staff has been deleted successfully.";
            $_SESSION['alert-class'] = "alert alert-success";
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollBack();
            $_SESSION['message'] = "Failed to delete staff: " . $e->getMessage();
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    } else {
        $_SESSION['message'] = "Invalid staff ID.";
        $_SESSION['alert-class'] = "alert alert-danger";
    }
} else {
    $_SESSION['message'] = "Staff ID not provided.";
    $_SESSION['alert-class'] = "alert alert-danger";
}

header('Location: staff.php');
exit();
?>
