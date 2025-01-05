<?php
session_start();
require_once('../model/loanModel.php');

if (isset($_POST['submit'])) {
    $employment_status = trim($_POST['employment_status']);
    $monthly_income = trim($_POST['monthly_income']);
    $loan_amount = trim($_POST['loan_amount']);
    $interest_rate = trim($_POST['interest_rate']);
    $application_date = trim($_POST['application_date']);
    $agree_terms = isset($_POST['agree_terms']);

    
    if (empty($employment_status) || empty($monthly_income) || empty($loan_amount) || 
        empty($interest_rate) || empty($application_date) || !$agree_terms) {
        echo "All fields are required, and terms must be agreed.";
    } elseif (!is_numeric($monthly_income) || $monthly_income <= 0) {
        echo "Monthly income must be a positive number.";
    } elseif (!is_numeric($loan_amount) || $loan_amount <= 0) {
        echo "Loan amount must be a positive number.";
    } elseif (!is_numeric($interest_rate) || $interest_rate <= 0) {
        echo "Interest rate must be a positive number.";
    } else {
        
        $loanData = [
            'employment_status' => $employment_status,
            'monthly_income' => (float)$monthly_income,
            'loan_amount' => (float)$loan_amount,
            'interest_rate' => (float)$interest_rate,
            'application_date' => $application_date,
        ];

    
        if (applyLoan($loanData)) {
            echo "Loan application submitted successfully!";
            header("Location: ../view/success.html"); 
        } else {
            echo "Failed to submit loan application. Try again.";
        }
    }
} else {
    header("Location: ../view/applyloan.html");
}
?>
