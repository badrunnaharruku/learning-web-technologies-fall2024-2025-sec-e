<?php
require_once('dbConnection.php');

function getAllReminders() {
    $con = getConnection();
    $sql = "SELECT * FROM reminders ORDER BY due_date ASC";
    $result = mysqli_query($con, $sql);
    $reminders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($reminders, $row);
    }

    //mysqli_close($con);
    return $reminders;
}

function addReminder($user_id, $title, $description, $due_date) {
    $con = getConnection();
    $sql = "INSERT INTO reminders (user_id, title, description, due_date, status) VALUES ('$user_id', '$title', '$description', '$due_date', 'Pending')";
    $status = mysqli_query($con, $sql);

    //mysqli_close($con);
    return $status;
}

function updateReminder($id, $title, $description, $due_date, $status) {
    $con = getConnection();
    $sql = "UPDATE reminders SET title = '$title', description = '$description', due_date = '$due_date', status = '$status' WHERE id = $id";
    $statusUpdate = mysqli_query($con, $sql);

    //mysqli_close($con);
    return $statusUpdate;
}

function deleteReminder($id) {
    $con = getConnection();
    $sql = "DELETE FROM reminders WHERE id = $id";
    $deleteStatus = mysqli_query($con, $sql);

    //mysqli_close($con);
    return $deleteStatus;
}

function getReminderById($id) {
    $con = getConnection();
    $sql = "SELECT * FROM reminders WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $reminder = mysqli_fetch_assoc($result);
    } else {
        $reminder = null;
    }

    //mysqli_close($con);
    return $reminder;
}
?>
