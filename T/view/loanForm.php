<?php
require_once('../../N/view/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Loan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Apply for Loan</h2>
    <?php if (isset($_GET['error'])): ?>
        <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="loanController.php" method="POST" onsubmit="return validateForm()">
        <label for="employment_status">Employment Status:</label>
        <select name="employment_status" id="employment_status" required>
            <option value="">-- Select Status --</option>
            <option value="Employed">Employed</option>
            <option value="Self-Employed">Self-Employed</option>
            <option value="Unemployed">Unemployed</option>
        </select>
        <br><br>

        <label for="monthly_income">Monthly Income:</label>
        <input type="number" id="monthly_income" name="monthly_income" required><br><br>

        <label for="loan_amount">Loan Amount:</label>
        <input type="number" id="loan_amount" name="loan_amount" required><br><br>

        <label for="interest_rate">Interest Rate (%):</label>
        <input type="number" step="0.01" id="interest_rate" name="interest_rate" required><br><br>

        <input type="checkbox" id="terms_accepted" name="terms_accepted">
        <label for="terms_accepted">I agree to the terms and conditions</label><br><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Loan History</h2>
    <button id="fetchLoanHistory">View Loan History</button>
    <div id="loanHistoryContainer"></div>

    <script>
        function validateForm() {
            const termsAccepted = document.getElementById("terms_accepted").checked;
            if (!termsAccepted) {
                alert("You must agree to the terms and conditions.");
                return false;
            }
            return true;
        }

        document.getElementById('fetchLoanHistory').addEventListener('click', function () {
            fetch('loanController.php?action=fetchHistory')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('loanHistoryContainer');
                    if (data.success) {
                        let tableHTML = `
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employment Status</th>
                                        <th>Monthly Income</th>
                                        <th>Loan Amount</th>
                                        <th>Interest Rate (%)</th>
                                        <th>Terms Accepted</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                        data.loans.forEach(loan => {
                            tableHTML += `
                                <tr>
                                    <td>${loan.id}</td>
                                    <td>${loan.employment_status}</td>
                                    <td>${loan.monthly_income}</td>
                                    <td>${loan.loan_amount}</td>
                                    <td>${loan.interest_rate}</td>
                                    <td>${loan.terms_accepted ? 'Yes' : 'No'}</td>
                                    <td>${loan.created_at}</td>
                                </tr>`;
                        });
                        tableHTML += '</tbody></table>';
                        container.innerHTML = tableHTML;
                    } else {
                        container.innerHTML = '<p>No loan history available.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching loan history:', error);
                    document.getElementById('loanHistoryContainer').innerHTML = '<p>Failed to load loan history.</p>';
                });
        });
    </script>
</body>
</html>