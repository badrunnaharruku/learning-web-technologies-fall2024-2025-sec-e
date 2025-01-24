<?php
    require_once('../model/notificationModel.php');
    require_once('../model/billModel.php');
    require_once('../model/loanModel.php');

    // Fetch pending bills
    $bills = getUpcomingBills();
    foreach ($bills as $bill) {
        if ($bill['status'] == 'Pending') {
            $due_date = strtotime($bill['due_date']);
            $today = strtotime(date('Y-m-d'));

            if (($due_date - $today) / (60 * 60 * 24) == 2) {
                $message = "Reminder: Bill '{$bill['name']}' is due on {$bill['due_date']}.";
                addNotification($message, 'Pending');
            }
        }
    }

    // Fetch pending installments
    $installments = getInstallments();
    foreach ($installments as $installment) {
        if ($installment['status'] == 'Pending') {
            $due_date = strtotime($installment['due_date']);
            $today = strtotime(date('Y-m-d'));

            // Notify 7 days before due date
            if (($due_date - $today) / (60 * 60 * 24) == 7) {
                $message = "Reminder: Installment for Loan ID {$installment['loan_id']} is due on {$installment['due_date']}.";
                addNotification($message, 'Pending');
            }
        }
    }

    // Generate notifications for reminders
    $reminders = getAllReminders();
    foreach ($reminders as $reminder) {
        if ($reminder['status'] == 'Pending') {
            $due_date = strtotime($reminder['due_date']);
            $today = strtotime(date('Y-m-d'));

            if (($due_date - $today) / (60 * 60 * 24) == 1) {
                $message = "Reminder: '{$reminder['title']}' is due on {$reminder['due_date']}.";
                addNotification($message, 'Pending');
            }
        }
    }

?>
