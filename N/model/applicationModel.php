<?php
require_once('dbConnection.php');

function getPendingApplications() {
    $con = getConnection();
    $sql = "SELECT * FROM loan_applications WHERE status = 'Pending' ORDER BY created_at ASC";
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
function getApplicationDetails($id) {
    $con = getConnection();
    $sql = "SELECT * FROM loan_applications INNER JOIN application_details ON loan_application.application_id = application_details.application_id WHERE loan_application.application_id = $id";
    $result = mysqli_query($con, $sql);
    $application = mysqli_fetch_assoc($result);
    

    //mysqli_close($con);
    return $application;
}

function updateApplicationStatus($applicationId, $status) {
    $con = getConnection();
    $sql = "UPDATE loan_applications SET status = '$status' WHERE application_id = $applicationId";
    $result = mysqli_query($con, $sql);

    //mysqli_close($con);
    return $result;
}

function addNotification($userId, $message) {
    $con = getConnection();
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO notifications (user_id, message, date, status) VALUES ('$userId', '$message', '$date', 'Unread')";
    $result = mysqli_query($con, $sql);

    //mysqli_close($con);
    return $result;
}
?>
