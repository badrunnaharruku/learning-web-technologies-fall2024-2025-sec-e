<?php
require_once('../../N/Model/dbConnection.php');
function getAllLoans() {
    $con = getConnection();
    $sql = "SELECT * FROM loan_applications ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    $loans = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($loans, $row);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    //mysqli_close($con);
    return $loans;
}

function getApplicationDetails($id) {
    $con = getConnection();
    $sql = "SELECT * FROM loan_applications INNER JOIN application_details ON loan_applications.id = application_details.application_id WHERE loan_applications.id = $id";
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
    $sql = "UPDATE loan_applications SET status = '$status' WHERE application_id = $applicationId";
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


function applyLoan($loanData) {
    $con = getConnection();
    $sql = "INSERT INTO loan_applications (user_id, employment_status, monthly_income, loan_amount, loan_duration, interest_rate, status) 
        VALUES ('{$loanData['user_id']}', '{$loanData['employment_status']}', '{$loanData['monthly_income']}', '{$loanData['loan_amount']}', '{$loanData['loan_duration']}', '{$loanData['interest_rate']}', 'Pending')";

    $status = mysqli_query($con, $sql);

    if (!$status) {
        echo "Error: " . mysqli_error($con);
    }
    else {
        //addApplicationDeatails($loanData);
    }

    //mysqli_close($con);
    return $status;
}

function addApplicationDeatails($loanData){
    $con = getConnection(); 
    $sql = "INSERT INTO application_details (application_id, user_id, loan_amount, interest_rate, loan_term, status) 
        VALUES ('{$loanData['application_id']}', '{$loanData['user_id']}', '{$loanData['loan_amount']}', '{$loanData['interest_rate']}', '{$loanData['loan_term']}', 'Pending')";
    $status = mysqli_query($con, $sql);
    if (!$status) {
        echo "Error: " . mysqli_error($con);
    }    
}
?>