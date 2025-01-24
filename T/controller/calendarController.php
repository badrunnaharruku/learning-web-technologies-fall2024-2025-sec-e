<?php
require_once 'calendarModel.php';

$action = $_GET['action'] ?? '';

if ($action === 'getTables') {
    // Fetch loan and payment data
    $loans = getLoanTable($conn);
    $payments = getPaymentTable($conn);
    echo json_encode(['loans' => $loans, 'payments' => $payments]);
    exit;

} elseif ($action === 'delete') {
    // Handle deletion of a record
    $id = $_POST['id'];
    $type = $_POST['type'];
    deleteRecord($id, $type, $conn);
    echo "Record deleted successfully";
    exit;

} elseif ($action === 'updateLoan') {
    // Validate incoming POST data
    $id = $_POST['id'] ?? null;
    $employment_status = $_POST['employment_status'] ?? '';
    $monthly_income = $_POST['monthly_income'] ?? '';
    $loan_amount = $_POST['loan_amount'] ?? '';
    $interest_rate = $_POST['interest_rate'] ?? '';
    $terms_accepted = $_POST['terms_accepted'] ?? '';

    // Back-end validation: Ensure all required fields are filled
    if (!$id || !$employment_status || !$monthly_income || !$loan_amount || !$interest_rate || $terms_accepted === '') {
        echo "Error: All fields are required.";
        exit;
    }

    // Update the loan record in the database
    $sql = "UPDATE loan 
            SET employment_status = ?, monthly_income = ?, loan_amount = ?, interest_rate = ?, terms_accepted = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sddisi", 
        $employment_status, 
        $monthly_income, 
        $loan_amount, 
        $interest_rate, 
        $terms_accepted, 
        $id
    );

    if ($stmt->execute()) {
        echo "Loan record updated successfully.";
    } else {
        echo "Error updating loan record.";
    }
    exit;
}

echo "Invalid action.";
?>