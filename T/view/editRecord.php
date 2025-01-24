<?php
require_once 'calendarModel.php';
require_once('../../N/view/header.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die('Invalid record.');
}

// Fetch record details for the loan
$sql = "SELECT * FROM loan WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();

if (!$record) {
    die('Loan record not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Loan Record</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .back-btn {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h2>Edit Loan Record</h2>
    <form id="editLoanForm">
        <input type="hidden" name="id" value="<?= $record['id'] ?>">

        <label for="employment_status">Employment Status</label>
        <select name="employment_status" id="employment_status" required>
            <option value="Employed" <?= $record['employment_status'] === 'Employed' ? 'selected' : '' ?>>Employed</option>
            <option value="Self-Employed" <?= $record['employment_status'] === 'Self-Employed' ? 'selected' : '' ?>>Self-Employed</option>
            <option value="Unemployed" <?= $record['employment_status'] === 'Unemployed' ? 'selected' : '' ?>>Unemployed</option>
        </select>

        <label for="monthly_income">Monthly Income</label>
        <input type="number" name="monthly_income" id="monthly_income" value="<?= $record['monthly_income'] ?>" required>

        <label for="loan_amount">Loan Amount</label>
        <input type="number" name="loan_amount" id="loan_amount" value="<?= $record['loan_amount'] ?>" required>

        <label for="interest_rate">Interest Rate (%)</label>
        <input type="number" step="0.01" name="interest_rate" id="interest_rate" value="<?= $record['interest_rate'] ?>" required>

        <label for="terms_accepted">Terms Accepted</label>
        <select name="terms_accepted" id="terms_accepted" required>
            <option value="1" <?= $record['terms_accepted'] ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= !$record['terms_accepted'] ? 'selected' : '' ?>>No</option>
        </select>

        <button type="button" id="updateButton">Update</button>
        <p class="error" id="formError" style="display: none;">All fields are required. Please fill out all fields.</p>
    </form>

    <a href="calendar.php" class="back-btn">Back</a>

    <script>
        $(document).ready(function () {
            $('#updateButton').click(function () {
                const formData = $('#editLoanForm').serializeArray(); // Serialize form data
                let valid = true;

                // Front-end validation: Ensure all fields are filled
                formData.forEach(function (field) {
                    if (!field.value.trim()) {
                        valid = false;
                    }
                });

                if (!valid) {
                    $('#formError').show();
                    return;
                } else {
                    $('#formError').hide();
                }

                // Send data to the server
                $.ajax({
                    url: 'calendarController.php?action=updateLoan',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert(response);
                        if (response.includes('successfully')) {
                            window.location.href = 'calendar.php'; // Redirect back to the main page
                        }
                    },
                    error: function () {
                        alert('Error updating record.');
                    }
                });
            });
        });
    </script>
</body>
</html>