<?php
require_once('dbConnection.php');

function getInstallments() {
    $con = getConnection();
    $sql = "SELECT * FROM installments ORDER BY due_date ASC";
    $result = mysqli_query($con, $sql);
    $installments = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($installments, $row);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $installments;
}

function updateInstallmentStatus($id, $status, $paid_date = null) {
    $con = getConnection();
    if ($status == 'Paid') {
        $sql = "UPDATE installments SET status = '$status', paid_date = '$paid_date' WHERE id = $id";
    } else {
        $sql = "UPDATE installments SET status = '$status', paid_date = NULL WHERE id = $id";
    }

    $statusUpdate = mysqli_query($con, $sql);

    if (!$statusUpdate) {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $statusUpdate;
}

function getApplicationDetails($id) {
    $con = getConnection();
    $sql = "SELECT * FROM loan_application INNER JOIN application_details ON loan_application.application_id = application_details.application_id WHERE loan_application.application_id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $application = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $application;
}

function updateApplicationStatus($applicationId, $status) {
    $con = getConnection();
    $sql = "UPDATE loan_application SET status = '$status' WHERE application_id = $applicationId";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $result;
}

function addNotification($userId, $message) {
    $con = getConnection();
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO notifications (user_id, message, date, status) VALUES ('$userId', '$message', '$date', 'Unread')";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $result;
}

function getPendingApplications() {
    $con = getConnection();
    $sql = "SELECT * FROM loan_application WHERE status = 'Pending' ORDER BY created_at ASC";
    $result = mysqli_query($con, $sql);
    $applications = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($applications, $row);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $applications;
}

function applyLoan($loanData) {
    $con = getConnection();
    $sql = "INSERT INTO loans (user_id, employment_status, monthly_income, loan_amount, loan_duration, interest_rate, status) 
        VALUES ('{$loanData['user_id']}', '{$loanData['employment_status']}', '{$loanData['monthly_income']}', '{$loanData['loan_amount']}', '{$loanData['loan_duration']}', '{$loanData['interest_rate']}', 'Pending')";

    $status = mysqli_query($con, $sql);

    if (!$status) {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $status;
}

function getUserInstallments($userId) {
    $con = getConnection();
    $sql = "SELECT i.* FROM installments i 
            INNER JOIN loans l ON i.loan_id = l.id 
            WHERE l.user_id = '$userId' ORDER BY i.due_date ASC";
    $result = mysqli_query($con, $sql);
    $installments = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($installments, $row);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $installments;
}
?>
