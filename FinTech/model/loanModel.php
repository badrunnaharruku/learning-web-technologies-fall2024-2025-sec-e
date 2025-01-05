<?php
function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'fintech');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function applyLoan($loanData) {
    $con = getConnection();
    $sql = "INSERT INTO loan_applications (employment_status, monthly_income, loan_amount, interest_rate, application_date) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sddds", 
        $loanData['employment_status'],
        $loanData['monthly_income'],
        $loanData['loan_amount'],
        $loanData['interest_rate'],
        $loanData['application_date']
    );

    $status = mysqli_stmt_execute($stmt);
    mysqli_close($con);
    return $status;
}
?>
