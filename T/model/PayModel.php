<?php
// Add or fetch bank account
function getOrCreateBankAccount($bankName, $accountNumber, $conn) {
    $sql = "SELECT id FROM bank_account WHERE bank_name = ? AND account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $bankName, $accountNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id']; // Return existing ID
    } else {
        $sqlInsert = "INSERT INTO bank_account (bank_name, account_number) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ss", $bankName, $accountNumber);
        $stmtInsert->execute();
        return $conn->insert_id; // Return new ID
    }
}

// Schedule an auto-payment
function scheduleAutoPay($bankAccountId, $billAmount, $paymentDate, $paymentTime, $conn) {
    $sql = "INSERT INTO scheduled_payments (bank_account_id, bill_amount, payment_date, payment_time, is_paid) 
            VALUES (?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idss", $bankAccountId, $billAmount, $paymentDate, $paymentTime);
    return $stmt->execute();
}
?>