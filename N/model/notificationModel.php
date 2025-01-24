<?php
    require_once('dbConnection.php');

    function getNotifications() {
        $con = getConnection();
        $sql = "SELECT * FROM notifications ORDER BY date DESC";
        $result = mysqli_query($con, $sql);
        $notifications = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($notifications, $row);
        }
        return $notifications;
    }

    function addNotification($message, $status) {
        $con = getConnection();
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO notifications (message, date, status) VALUES ('$message', '$date', '$status')";
        return mysqli_query($con, $sql);
    }
?>
