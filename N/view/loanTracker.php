<?php
    require_once('header.php');
    require_once('../model/loanModel.php');
    $loans = getAllLoans();
?>

<html>

    <head>
        <title>Loan Tracker</title>
    </head>
    <body>
        <h1>Loan Tracker</h1>
        <table border="1">
            <tr>
                <th>Loan ID</th>
                <th>Amount</th>
                <th>Remaining Amount</th>
                <th>Next Payment Due</th>
            </tr>
            <?php foreach ($loans as $loan) { ?>
                <tr>
                    <td><?= $loan['id'] ?></td>
                    <td>$<?= $loan['amount'] ?></td>
                    <td>$<?= $loan['remaining_amount'] ?></td>
                    <td><?= $loan['next_due_date'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
