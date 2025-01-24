<?php
    require_once('../model/loanModel.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $paid_date = $_POST['paid_date'] ?? null;

        $result = updateInstallmentStatus($id, $status, $paid_date);
        if ($result) {
            header('location: ../view/installmentTracker.php');
        } else {
            echo "Error updating installment status!";
        }
    }
?>
