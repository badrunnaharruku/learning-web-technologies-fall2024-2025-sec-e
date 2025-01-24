<?php
session_start();
require_once('../model/billModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $amount = trim($_POST['amount']);
    $due_date = trim($_POST['due_date']);
    $status = trim($_POST['status']);
    $user_id = $_SESSION['user_id'];

    $result = addBill($user_id, $name, $amount, $due_date, $status);
    if ($result) {
        header('location: ../view/dashboard.php');
    } else {
        echo "Error adding bill!";
    }
}
?>
