<?php

require_once('dbConnection.php');

function getUpcomingBills() {
    $con = getConnection();
    $today = date('Y-m-d');
    $user_id = $_SESSION['user_id'];
    $futureDate = date('Y-m-d', strtotime('+30 days'));
    $sql = "SELECT * FROM bills WHERE due_date BETWEEN '$today' AND '$futureDate' AND user_id = '$user_id' ORDER BY due_date ASC";
    $result = mysqli_query($con, $sql);
    $bills = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($bills, $row);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    return $bills;
}

function addBill($user_id, $name, $amount, $due_date, $status) {
    $con = getConnection();
    $sql = "INSERT INTO bills (user_id, name, amount, due_date, status) VALUES ('$user_id', '$name', '$amount', '$due_date', '$status')";
    $statusInsert = mysqli_query($con, $sql);

    if (!$statusInsert) {
        echo "Error: " . mysqli_error($con);
    }


    return $statusInsert;
}
?>
