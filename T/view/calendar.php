<?php
require_once('../../N/view/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan and Payment Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Loan and Payment Information</h2>

        <h3>Loan Table</h3>
        <table class="table table-bordered" id="loanTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employment Status</th>
                    <th>Monthly Income</th>
                    <th>Loan Amount</th>
                    <th>Interest Rate</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h3>Payment Table</h3>
        <table class="table table-bordered" id="paymentTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bank Account</th>
                    <th>Bill Amount</th>
                    <th>Payment Date</th>
                    <th>Paid Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        // Fetch and populate the loan and payment tables dynamically
        $(document).ready(function () {
            fetchTables();

            // Fetch the tables dynamically
            function fetchTables() {
                $.ajax({
                    url: 'calendarController.php?action=getTables',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        populateTable('#loanTable tbody', data.loans, true);
                        populateTable('#paymentTable tbody', data.payments, false);
                    }
                });
            }

            // Populate a specific table
            function populateTable(selector, items, isLoan) {
                let rows = '';
                items.forEach(item => {
                    rows += `<tr>
                        <td>${item.id}</td>
                        <td>${isLoan ? item.employment_status : item.bank_name}</td>
                        <td>${isLoan ? item.monthly_income : item.bill_amount}</td>
                        <td>${isLoan ? item.loan_amount : item.payment_date}</td>
                        <td>${isLoan ? item.interest_rate : (item.is_paid ? 'Paid' : 'Pending')}</td>
                        <td>${isLoan ? item.created_at : ''}</td>
                        <td>${item.is_paid ? '' : `
                            <button class="btn btn-primary btn-sm edit-btn" data-id="${item.id}" data-type="${isLoan ? 'loan' : 'payment'}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${item.id}" data-type="${isLoan ? 'loan' : 'payment'}">Delete</button>`}
                        </td>
                    </tr>`;
                });
                $(selector).html(rows);

                // Attach click handlers
                attachHandlers();
            }

            // Attach click handlers for edit and delete
            function attachHandlers() {
                $('.edit-btn').click(function () {
                    const id = $(this).data('id');
                    const type = $(this).data('type');
                    window.location.href = `editRecord.php?id=${id}&type=${type}`;
                });

                $('.delete-btn').click(function () {
                    const id = $(this).data('id');
                    const type = $(this).data('type');
                    if (confirm('Are you sure you want to delete this record?')) {
                        $.ajax({
                            url: 'calendarController.php?action=delete',
                            method: 'POST',
                            data: { id, type },
                            success: function () {
                                fetchTables();
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>

<?php
    require_once 'footer.php';
?>