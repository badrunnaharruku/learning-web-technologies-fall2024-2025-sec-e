<?php
// Fetch all payments
function fetchPayments($conn) {
    $sql = "SELECT sp.id, ba.bank_name, ba.account_number, sp.bill_amount, sp.payment_date, sp.payment_time, sp.is_paid
            FROM scheduled_payments sp
            JOIN bank_account ba ON sp.bank_account_id = ba.id
            ORDER BY sp.payment_date, sp.payment_time";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch payment by ID
function getPaymentById($id, $conn) {
    $sql = "SELECT * FROM scheduled_payments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Delete payment
function deletePayment($id, $conn) {
    $sql = "DELETE FROM scheduled_payments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Update payment
function updatePayment($id, $billAmount, $paymentDate, $paymentTime, $conn) {
    $sql = "UPDATE scheduled_payments SET bill_amount = ?, payment_date = ?, payment_time = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssi", $billAmount, $paymentDate, $paymentTime, $id);
    return $stmt->execute();
}
?>