<?php
require_once "config.php";
require_once "paymentModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => 'Invalid request'];

    $action = $_POST['action'] ?? null;

    if ($action === 'fetchPayments') {
        $payments = fetchPayments($conn);
        $response['success'] = true;
        $response['data'] = $payments;
    } elseif ($action === 'deletePayment') {
        $id = intval($_POST['id']);
        if (deletePayment($id, $conn)) {
            $response['success'] = true;
            $response['message'] = 'Payment deleted successfully.';
        } else {
            $response['message'] = 'Failed to delete payment.';
        }
    } elseif ($action === 'editPayment') {
        $id = intval($_POST['id']);
        $billAmount = floatval($_POST['bill_amount']);
        $paymentDate = $_POST['payment_date'];
        $paymentTime = $_POST['payment_time'];

        if (updatePayment($id, $billAmount, $paymentDate, $paymentTime, $conn)) {
            $response['success'] = true;
            $response['message'] = 'Payment updated successfully.';
        } else {
            $response['message'] = 'Failed to update payment.';
        }
    }

    echo json_encode($response);
    exit;
}
?>