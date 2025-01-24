<?php
session_start();
require_once('../model/loanModel.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);


        if ($data) {
            $employment_status = trim($data['employment_status']);
            $monthly_income = trim($data['monthly_income']);
            $loan_amount = trim($data['loan_amount']);
            $loan_duration = trim($data['loan_duration']);
            $user_id = $_SESSION['user_id'];
        } 

        if (!$agree_terms) {
            http_response_code(400);
            echo json_encode(["message" => "Terms must be agreed."]);
            exit;
        }

        $user_id = $_SESSION['user_id'];
    


    if (empty($employment_status) || empty($monthly_income) || empty($loan_amount) || empty($loan_duration)) {
        http_response_code(400);
        
        exit;
    } 
    else if (!is_numeric($monthly_income) || $monthly_income <= 0) {
        http_response_code(400);
        
        exit;
    } 
    else if (!is_numeric($loan_amount) || $loan_amount <= 0) {
        http_response_code(400);
        
        exit;
    } 
    else if (!in_array($loan_duration, ['6', '12', '24', '36'])) {
        http_response_code(400);
        
        exit;
    }


    $interest_rate = match ($loan_duration) {
        '6' => 5.0,
        '12' => 6.5,
        '24' => 7.5,
        '36' => 8.5,
        default => 0,
    };


    $loanData = [
        'employment_status' => $employment_status,
        'monthly_income' => (float)$monthly_income,
        'loan_amount' => (float)$loan_amount,
        'loan_duration' => (int)$loan_duration,
        'interest_rate' => (float)$interest_rate,
        'user_id' => $user_id,
    ];

    if (applyLoan($loanData)) {
        http_response_code(200);
        echo json_encode(["message" => "Loan application submitted successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to submit loan application. Try again."]);
    }
} else {
    header("Location: ../view/applyloan.php");
    exit;
}
?>
