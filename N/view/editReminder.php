<?php
    require_once('header.php');
    require_once('../model/reminderModel.php');

    
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $reminderId = $_GET['id'];
        $reminder = getReminderById($reminderId); // Fetch the reminder by ID

        if (!$reminder) {
            echo "Reminder not found.";
            exit;
        }
    } 
    else {
        echo "Invalid reminder ID.";
        exit;
    }
?>

<html>

    <head>
        <title>Edit Reminder</title>
        <link rel="stylesheet" href="../css/editReminder.css">
    </head>

    <body>
        <h1>Edit Reminder</h1>
        <form method="post" action="../controller/updateReminderController.php">
            <input type="hidden" name="id" value="<?= $reminder['id'] ?>">

            <label>Title:</label>
            <input type="text" name="title" value="<?= $reminder['title'] ?>" required> <br><br>

            <label>Description:</label>
            <textarea name="description" required><?= $reminder['description'] ?></textarea> <br><br>

            <label>Due Date:</label>
            <input type="date" name="due_date" value="<?= $reminder['due_date'] ?>" required> <br><br>

            <label>Status:</label>
            <select name="status">
                <option value="Pending" <?= $reminder['status'] == 'Pending' ? 'Pending' : '' ?>>Pending</option>
                <option value="Completed" <?= $reminder['status'] == 'Completed' ? 'Completed' : '' ?>>Completed</option>
            </select>
            <br><br>

            <input type="submit" value="Update Reminder">
        </form>
    </body>
</html>
