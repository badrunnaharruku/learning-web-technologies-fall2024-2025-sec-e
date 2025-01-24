<?php
require_once('header.php');
require_once('../model/installmentModel.php');

$user_id = $_SESSION['user_id'];
$installments = getUserInstallments($user_id);
?>

<html>
    <head>
        <title>Installment Tracker</title>
        <link rel="stylesheet" href="../css/installmentTracker.css">
    </head>
    <body>
        <h1>Installment Tracker</h1>

        <h2>Upcoming Installments</h2>
        <table border="1">
            <tr>
                <th>Loan ID</th>
                <th>Installment Amount</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            <?php foreach ($installments as $installment) { ?>
                <?php if ($installment['status'] == 'Pending') { ?>
                    <tr>
                        <td><?= $installment['loan_id'] ?></td>
                        <td>$<?= $installment['amount'] ?></td>
                        <td><?= $installment['due_date'] ?></td>
                        <td><?= $installment['status'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>

        <h2>Completed Installments</h2>
        <table border="1">
            <tr>
                <th>Loan ID</th>
                <th>Installment Amount</th>
                <th>Paid Date</th>
                <th>Status</th>
            </tr>
            <?php foreach ($installments as $installment) { ?>
                <?php if ($installment['status'] == 'Paid') { ?>
                    <tr>
                        <td><?= $installment['loan_id'] ?></td>
                        <td>$<?= $installment['amount'] ?></td>
                        <td><?= $installment['paid_date'] ?></td>
                        <td><?= $installment['status'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </body>
</html>
