<?php
require_once('../../N/view/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Up Auto Pay</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Set Up Auto Pay</h2>
    <form id="autoPayForm">
        <!-- Select Bank Name -->
        <label for="bank_name">Select Bank:</label>
        <select name="bank_name" id="bank_name" required>
            <option value="">-- Select Bank --</option>
            <option value="Sonali Bank">Sonali Bank</option>
            <option value="Dhaka Bank">Dhaka Bank</option>
            <option value="City Bank">City Bank</option>
            <option value="AB Bank">AB Bank</option>
            <option value="Jonota Bank">Jonota Bank</option>
            <option value="Bank Asia">Bank Asia</option>
            <option value="BRAC Bank">BRAC Bank</option>
            <option value="IFIC Bank">IFIC Bank</option>
            <option value="UCB Bank">UCB Bank</option>
        </select>
        <br><br>

        <!-- Enter Account Number -->
        <label for="account_number">Account Number:</label>
        <input type="text" name="account_number" id="account_number" placeholder="Enter Account Number" required>
        <br><br>

        <!-- Bill Amount -->
        <label for="bill_amount">Bill Amount:</label>
        <input type="number" step="0.01" name="bill_amount" id="bill_amount" placeholder="Enter Bill Amount" required>
        <br><br>

        <!-- Payment Date -->
        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" required>
        <br><br>

        <!-- Payment Time -->
        <label for="payment_time">Payment Time:</label>
        <input type="time" name="payment_time" id="payment_time" required>
        <br><br>

        <button type="submit">Set Auto Pay</button>
    </form>

    <div id="responseMessage"></div>

    <script>
        $(document).ready(function () {
            $('#autoPayForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: 'payController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#responseMessage').html('<p style="color: green;">' + response.message + '</p>');
                            $('#autoPayForm')[0].reset(); // Reset the form
                        } else {
                            $('#responseMessage').html('<p style="color: red;">' + response.message + '</p>');
                        }
                    },
                    error: function () {
                        $('#responseMessage').html('<p style="color: red;">An error occurred while processing the request.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>