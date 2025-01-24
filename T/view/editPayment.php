<?php
require_once "config.php";
require_once "paymentModel.php";
require_once('../../N/view/header.php');

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = intval($_GET['id']);
$payment = getPaymentById($id, $conn);

if (!$payment || $payment['is_paid']) {
    echo "Invalid payment or payment already completed.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Edit Payment</h2>
    <form id="editPaymentForm">
        <input type="hidden" name="id" value="<?= $payment['id'] ?>">

        <label for="bill_amount">Bill Amount:</label>
        <input type="number" step="0.01" name="bill_amount" id="bill_amount" value="<?= $payment['bill_amount'] ?>" required>
        <br><br>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" value="<?= $payment['payment_date'] ?>" required>
        <br><br>

        <label for="payment_time">Payment Time:</label>
        <input type="time" name="payment_time" id="payment_time" value="<?= $payment['payment_time'] ?>" required>
        <br><br>

        <button type="submit">Update Payment</button>
    </form>

    <div id="responseMessage"></div>

    <script>
        $(document).ready(function () {
            $('#editPaymentForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: 'paymentController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize() + '&action=editPayment',
                    success: function (response) {
                        alert(response.message);
                        if (response.success) {
                            window.location.href = 'paymentHistory.php';
                        }
                    },
                    error: function () {
                        alert('Failed to update payment.');
                    }
                });
            });
        });
    </script>
</body>
</html>