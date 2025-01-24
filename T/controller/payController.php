<?php
require_once "config.php";
require_once "PayModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => 'Invalid request'];

    // Fetch form data
    $bankName = isset($_POST['bank_name']) ? trim($_POST['bank_name']) : null;
    $accountNumber = isset($_POST['account_number']) ? trim($_POST['account_number']) : null;
    $billAmount = isset($_POST['bill_amount']) ? floatval($_POST['bill_amount']) : null;
    $paymentDate = isset($_POST['payment_date']) ? $_POST['payment_date'] : null;
    $paymentTime = isset($_POST['payment_time']) ? $_POST['payment_time'] : null;

    // Validate inputs
    if (!$bankName || !$accountNumber || !$billAmount || !$paymentDate || !$paymentTime) {
        $response['message'] = 'All fields are required!';
        echo json_encode($response);
        exit;
    }

    // Get or create the bank account
    $bankAccountId = getOrCreateBankAccount($bankName, $accountNumber, $conn);

    // Schedule the auto-payment
    $success = scheduleAutoPay($bankAccountId, $billAmount, $paymentDate, $paymentTime, $conn);

    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Auto Pay set up successfully.';
    } else {
        $response['message'] = 'Failed to set up Auto Pay.';
    }

    echo json_encode($response);
    exit;
}
?>