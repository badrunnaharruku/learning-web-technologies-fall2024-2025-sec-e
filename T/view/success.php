<?php
require_once('../../N/view/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .message {
            font-size: 20px;
            color: green;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>Loan Application Submitted</h2>
    <p class="message">Your loan application has been submitted successfully.</p>
    <button onclick="window.location.href='loan.php';">Back to Loan Form</button>
</body>
</html>