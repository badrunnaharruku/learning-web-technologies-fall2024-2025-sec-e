<?php
    require_once('header.php');

    require_once('../model/notificationModel.php');
    $notifications = getNotifications();
?>

<html>

    <head>
        <title>Notification Panel</title>
        <link rel="stylesheet" href="../css/notificationPanel.css">
    </head>
    
    <body>
        <h1>Notification Panel</h1>
        <table border="1">
            <tr>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php if (!empty($notifications)) { ?>
                <?php foreach ($notifications as $notification) { ?>
                    <tr>
                        <td><?= $notification['message'] ?></td>
                        <td><?= $notification['date'] ?></td>
                        <td><?= $notification['status'] ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3">No notifications available.</td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
