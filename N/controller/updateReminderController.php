<?php
    require_once('../model/reminderModel.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $due_date = $_POST['due_date'];
        $status = $_POST['status'];

        // Validate inputs
        if (empty($title) || empty($description) || empty($due_date) || empty($status)) {
            echo "All fields are required.";
            exit;
        }

        // Update the reminder in the database
        $result = updateReminder($id, $title, $description, $due_date, $status);

        if ($result) {
            header('location: ../view/dashboard.php');
        } else {
            echo "Error updating reminder.";
        }
    }
?>
