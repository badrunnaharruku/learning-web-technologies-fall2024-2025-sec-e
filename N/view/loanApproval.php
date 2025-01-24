<?php
require_once('header.php');
require_once('../../R/model/loanModel.php');

$loans = getAllLoans();
?>

<html>
    <head>
        <title>Loan Details</title>
        <link rel="stylesheet" href="../css/loanDetails.css">
    </head>
    <body>
        <h1>Loan Details</h1>

        <h2>All Loans</h2>
        <table border="1">
            <tr>
                <th>Loan ID</th>
                <th>User ID</th>
                <th>Loan Amount</th>
                <th>Interest Rate</th>
                <th>Loan Term (Months)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($loans)) { ?>
                <?php foreach ($loans as $loan) { ?>
                    <tr>
                        <td><?= $loan['id'] ?></td>
                        <td><?= $loan['user_id'] ?></td>
                        <td>$<?= number_format($loan['loan_amount'], 2) ?></td>
                        <td><?= $loan['interest_rate'] ?>%</td>
                        <td><?= $loan['loan_duration'] ?></td>
                        <td><?= $loan['status'] ?></td>
                        <td>
                            <a href="viewApplication.php?id=<?= $loan['id'] ?>">View Application</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7">No loans found.</td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
