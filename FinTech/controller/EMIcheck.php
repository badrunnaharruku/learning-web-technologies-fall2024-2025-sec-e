<?php
if (isset($_POST['submit'])) {
    $loan_amount = trim($_POST['loan_amount']);
    $interest_rate = trim($_POST['interest_rate']);
    $loan_tenure = trim($_POST['loan_tenure']);

    
    if (empty($loan_amount) || empty($interest_rate) || empty($loan_tenure)) {
        echo "All fields are required!";
        exit;
    }

    if (!is_numeric($loan_amount) || $loan_amount <= 0) {
        echo "Loan amount must be a positive number!";
        exit;
    }

    if (!is_numeric($interest_rate) || $interest_rate <= 0) {
        echo "Interest rate must be a positive number!";
        exit;
    }

    if (!is_numeric($loan_tenure) || $loan_tenure <= 0) {
        echo "Loan tenure must be a positive number!";
        exit;
    }

    
    $monthly_interest_rate = ($interest_rate / 100) / 12;
    $number_of_payments = $loan_tenure * 12;
    
    $emi = ($loan_amount * $monthly_interest_rate * pow(1 + $monthly_interest_rate, $number_of_payments)) / (pow(1 + $monthly_interest_rate, $number_of_payments) - 1);
    
    echo "<h2 align='center'>Your EMI is: " . number_format($emi, 2) . "</h2>";
} else {
    echo "Invalid request!";
}
?>
