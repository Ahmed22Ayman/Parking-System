<?php
include('header.php');

if (isset($_GET['id'])) {
    $parkingSlotId = $_GET['id'];

    // Validate parking slot ID
    if (!empty($parkingSlotId)) {
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Delete parking slot from the parking_lot table
            $deleteParkingSlotQuery = "DELETE FROM parking_lot WHERE id=:parkingSlotId";
            $parkingSlotStmt = $conn->prepare($deleteParkingSlotQuery);
            $parkingSlotStmt->bindParam(':parkingSlotId', $parkingSlotId, PDO::PARAM_INT);
            $parkingSlotStmt->execute();

            // Commit transaction
            $conn->commit();

            $_SESSION['message'] = "Parking slot has been deleted successfully.";
            $_SESSION['alert-class'] = "alert alert-success";
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollBack();
            $_SESSION['message'] = "Failed to delete parking slot: " . $e->getMessage();
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    } else {
        $_SESSION['message'] = "Invalid parking slot ID.";
        $_SESSION['alert-class'] = "alert alert-danger";
    }
} else {
    $_SESSION['message'] = "Parking slot ID not provided.";
    $_SESSION['alert-class'] = "alert alert-danger";
}

header('Location: view-parking-slots.php');
exit();
?>
