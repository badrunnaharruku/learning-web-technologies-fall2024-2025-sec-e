<?php
    require_once('../model/reminderModel.php');

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $result = deleteReminder($id);

        if ($result) {
            header('location: ../view/dashboard.php');
            exit;
        } else {
            echo "Error deleting the reminder.";
        }
    } else {
        echo "Invalid reminder ID.";
    }
?>
