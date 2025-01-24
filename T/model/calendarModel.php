<?php
require_once 'config.php';

// Fetch all loans
function getLoanTable($conn) {
    $sql = "SELECT * FROM loan";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch all payments
function getPaymentTable($conn) {
    $sql = "SELECT p.id, b.bank_name, p.bill_amount, p.payment_date, p.is_paid 
            FROM scheduled_payments p 
            JOIN bank_account b ON p.bank_account_id = b.id";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Delete a record
function deleteRecord($id, $type, $conn) {
    if ($type === 'loan') {
        $sql = "DELETE FROM loan WHERE id = ?";
    } elseif ($type === 'payment') {
        $sql = "DELETE FROM scheduled_payments WHERE id = ?";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}