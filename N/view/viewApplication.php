<?php
require_once('header.php');
require_once('../../R/model/loanModel.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $applicationId = $_GET['id'];
    $application = getApplicationDetails($applicationId);

    if (!$application) {
        echo "Application not found.";
        exit;
    }
} else {
    echo "Invalid application ID.";
    exit;
}
?>

<html>
    <head>
        <title>View Application</title>
        <link rel="stylesheet" href="../css/viewApplication.css">
    </head>
    <body>
        <h1>Application Details</h1>
        <table border="1">
            <tr>
                <th>Application ID</th>
                <td><?= $application['application_id'] ?></td>
            </tr>
            <tr>
                <th>Applicant ID</th>
                <td><?= $application['user_id'] ?></td>
            </tr>
            <tr>
                <th>Loan Amount</th>
                <td>$<?= number_format($application['loan_amount'], 2) ?></td>
            </tr>
            <tr>
                <th>Interest Rate</th>
                <td><?= $application['interest_rate'] ?>%</td>
            </tr>
            <tr>
                <th>Loan Term</th>
                <td><?= $application['loan_term'] ?> months</td>
            </tr>
            <tr>
                <th>Application Status</th>
                <td><?= $application['status'] ?></td>
            </tr>
        </table>

        <br>
        <form method="post" action="../controller/handleApplicationController.php">
            <input type="hidden" name="application_id" value="<?= $application['application_id'] ?>">
            <input type="hidden" name="user_id" value="<?= $application['user_id'] ?>">

            <button type="submit" name="action" value="approve">Approve</button>
            <button type="submit" name="action" value="reject">Reject</button>
        </form>
    </body>
</html>
