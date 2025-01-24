<?php
require_once('../model/loanModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = $_POST['application_id'];
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'Approved';
        $message = "Your loan application (ID: $applicationId) has been approved.";
    } elseif ($action === 'reject') {
        $status = 'Rejected';
        $message = "Your loan application (ID: $applicationId) has been rejected.";
    } else {
        echo "Invalid action.";
        exit;
    }

    // Update the application status
    if (updateApplicationStatus($applicationId, $status)) {
        // Add a notification for the user
        addNotification($userId, $message);
        header('Location: ../view/loanManagement.php');
        exit;
    } else {
        echo "Failed to update the application status.";
    }
}
?>
