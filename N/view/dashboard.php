<?php
require_once('header.php');
require_once('../model/billModel.php');
require_once('../model/reminderModel.php');
require_once('../model/notificationModel.php');

$upcomingBills = getUpcomingBills();
$reminders = getAllReminders();
$notifications = getNotifications();
?>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/dashboard.css">
    </head>

    <body>
        <h2>Notifications</h2>
        <table border="1">
            <tr>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php if (!empty($notifications)) { ?>
                <?php foreach (array_slice($notifications, 0, 3) as $notification) { ?>
                    <tr>
                        <td><?= htmlspecialchars($notification['message']) ?></td>
                        <td><?= htmlspecialchars($notification['date']) ?></td>
                        <td><?= htmlspecialchars($notification['status']) ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3">No notifications available.</td>
                </tr>
            <?php } ?>
        </table>
        <a href="notificationPanel.php">
            <button>View All Notifications</button>
        </a>

        <br>
        <br>

        <h2>Upcoming Bills</h2>
        <table border="1">
            <tr>
                <th>Bill Name</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            <?php if (!empty($upcomingBills)) { ?>
                <?php foreach ($upcomingBills as $bill) { ?>
                    <tr>
                        <td><?= htmlspecialchars($bill['name']) ?></td>
                        <td>$<?= htmlspecialchars($bill['amount']) ?></td>
                        <td><?= htmlspecialchars($bill['due_date']) ?></td>
                        <td><?= htmlspecialchars($bill['status']) ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4">No upcoming bills found.</td>
                </tr>
            <?php } ?>
        </table>

        <br>
        <br>

        <h2>Reminders</h2>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($reminders)) { ?>
                <?php foreach ($reminders as $reminder) { ?>
                    <tr>
                        <td><?= $reminder['title'] ?></td>
                        <td><?= $reminder['description']?></td>
                        <td><?= $reminder['due_date']?></td>
                        <td><?= $reminder['status']?></td>
                        <td>
                            <a href="editReminder.php?id=<?= $reminder['id'] ?>">Edit</a> 
                            |
                            <a href="../controller/deleteReminderController.php?id=<?= $reminder['id'] ?>"> Delete </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">No reminders found.</td>
                </tr>
            <?php } ?>
        </table>
        <a href="addReminder.php">
            <button>Add New Reminder</button>
        </a>

        <br>
        <br>

        <h2>Quick Actions</h2>
        <button onclick="location.href='installmentTracker.php'">View Installment Tracker</button>
        <button onclick="location.href='loanApproval.php'">View Applications</button>
        
    
    </body>
</html>



