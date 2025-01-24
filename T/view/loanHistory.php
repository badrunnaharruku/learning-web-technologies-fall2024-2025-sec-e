<?php
// loanHistory.php
require_once "config.php";
require_once "loanModel.php";
require_once('../../N/view/header.php');

// Fetch loan history
$loanHistory = getLoanHistory($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>Loan History</h2>
    <?php if (!empty($loanHistory)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employment Status</th>
                    <th>Monthly Income</th>
                    <th>Loan Amount</th>
                    <th>Interest Rate (%)</th>
                    <th>Terms Accepted</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loanHistory as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['id']); ?></td>
                        <td><?php echo htmlspecialchars($loan['employment_status']); ?></td>
                        <td><?php echo htmlspecialchars($loan['monthly_income']); ?></td>
                        <td><?php echo htmlspecialchars($loan['loan_amount']); ?></td>
                        <td><?php echo htmlspecialchars($loan['interest_rate']); ?></td>
                        <td><?php echo $loan['terms_accepted'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($loan['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No loan history available.</p>
    <?php endif; ?>

    <button class="back-button" onclick="window.location.href='loan.php';">Back to Loan Form</button>
</body>
</html>