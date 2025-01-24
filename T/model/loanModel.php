<?php
// loanModel.php

// Function to insert a loan application into the database
function applyLoan($employmentStatus, $monthlyIncome, $loanAmount, $interestRate, $termsAccepted, $conn) {
    $sql = "INSERT INTO loan (employment_status, monthly_income, loan_amount, interest_rate, terms_accepted, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdddi", $employmentStatus, $monthlyIncome, $loanAmount, $interestRate, $termsAccepted);

    return $stmt->execute();
}

// Function to retrieve all loan applications from the database
function getLoanHistory($conn) {
    $sql = "SELECT * FROM loan";
    $result = $conn->query($sql);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}
?>