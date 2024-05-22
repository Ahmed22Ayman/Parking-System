<?php
include('header.php');

if (isset($_GET['id'])) {
    $departmentId = $_GET['id'];

    // Validate department ID
    if (!empty($departmentId)) {
        // Delete the department from the database
        $deleteQuery = "DELETE FROM department WHERE id=:departmentId";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':departmentId', $departmentId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Department has been deleted successfully.";
            $_SESSION['alert-class'] = "alert alert-success";
        } else {
            $_SESSION['message'] = "Failed to delete department.";
            $_SESSION['alert-class'] = "alert alert-danger";
        }
    } else {
        $_SESSION['message'] = "Invalid department ID.";
        $_SESSION['alert-class'] = "alert alert-danger";
    }
} else {
    $_SESSION['message'] = "Department ID not provided.";
    $_SESSION['alert-class'] = "alert alert-danger";
}

header('Location: department.php');
exit();
?>
