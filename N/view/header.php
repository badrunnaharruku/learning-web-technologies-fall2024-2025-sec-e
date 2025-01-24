<?php

    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['login'])) {
        header('location: ../../R/view/login.html');
        exit;
    }

    
    $navigation = [
        'Dashboard' => '../../N/view/dashboard.php',
        'Notifications' => '../../N/view/notificationPanel.php',
        'Installment Tracker' => '../../N/view/installmentTracker.php',
        'Add Bill' => '../../N/view/addBill.php',
        'Add Reminder' => '../../N/view/addReminder.php',
        'View Applications' => '../../N/view/loanApproval.php',
        'Apply Loan'=> '../../R/view/applyLoan.php',
        'Calculate EMI'=> '../../R/view/EMI.php',
        'Add Payment'=> '../../T/view/paymentForm.php',
        'Payment History'=> '../../T/view/paymentHistory.php',
        'Loan Histoy'=> '../../T/view/loanHistory.php',
        'Logout' => '../../N/view/controller/logout.php'

    ];
?>

<html>
    
    <head>
        <link rel="stylesheet" href="../css/headerStyle.css">
    </head>

    <body>

        <header>
            <h1>FinMan</h1>
            
            <nav>
                <?php foreach ($navigation as $name => $link): ?>
                    <a href="<?= $link ?>"><?= $name ?></a> |
                <?php endforeach; ?>
            </nav>

            <hr>
        </header>

    </body>

</html>
