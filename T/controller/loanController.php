<?php
// loanController.php
require_once "config.php";
require_once "loanModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employmentStatus = $_POST["employment_status"];
    $monthlyIncome = $_POST["monthly_income"];
    $loanAmount = $_POST["loan_amount"];
    $interestRate = $_POST["interest_rate"];
    $termsAccepted = isset($_POST["terms_accepted"]) ? 1 : 0;

    if (empty($employmentStatus) || empty($monthlyIncome) || empty($loanAmount) || empty($interestRate) || !$termsAccepted) {
        header("Location: loan.php?error=Please fill in all fields and accept the terms.");
        exit;
    }

    $success = applyLoan($employmentStatus, $monthlyIncome, $loanAmount, $interestRate, $termsAccepted, $conn);

    if ($success) {
        header("Location: loan.php?success=Loan application submitted successfully.");
    } else {
        header("Location: loan.php?error=Failed to apply for the loan.");
    }
    exit;
}

// Handle loan history fetch via AJAX
if (isset($_GET['action']) && $_GET['action'] == 'fetchHistory') {
    $loanHistory = getLoanHistory($conn);
    if (!empty($loanHistory)) {
        echo json_encode(['success' => true, 'loans' => $loanHistory]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No loan history available.']);
    }
    exit;
}