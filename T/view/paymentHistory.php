<?php
require_once('../../N/view/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Payment History</h2>
    <div id="paymentTableContainer">
        <!-- The table will be populated here dynamically -->
    </div>

    <script>
        $(document).ready(function () {
            // Fetch and display payment history
            function fetchPayments() {
                $.ajax({
                    url: 'paymentController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { action: 'fetchPayments' },
                    success: function (response) {
                        if (response.success) {
                            let html = '<table border="1" cellpadding="10">';
                            html += '<tr><th>Bank Name</th><th>Account Number</th><th>Bill Amount</th><th>Payment Date</th><th>Payment Time</th><th>Status</th><th>Actions</th></tr>';

                            response.data.forEach(function (payment) {
                                html += '<tr>';
                                html += `<td>${payment.bank_name}</td>`;
                                html += `<td>${payment.account_number}</td>`;
                                html += `<td>${payment.bill_amount}</td>`;
                                html += `<td>${payment.payment_date}</td>`;
                                html += `<td>${payment.payment_time}</td>`;
                                html += `<td>${payment.is_paid ? 'Paid' : 'Pending'}</td>`;
                                html += '<td>';

                                if (!payment.is_paid) {
                                    html += `<button class="editBtn" data-id="${payment.id}">Edit</button>`;
                                    html += `<button class="deleteBtn" data-id="${payment.id}">Delete</button>`;
                                }

                                html += '</td>';
                                html += '</tr>';
                            });

                            html += '</table>';
                            $('#paymentTableContainer').html(html);
                        } else {
                            $('#paymentTableContainer').html('<p>No payments found.</p>');
                        }
                    },
                    error: function () {
                        $('#paymentTableContainer').html('<p>Error fetching payment history.</p>');
                    }
                });
            }

            // Call fetchPayments on page load
            fetchPayments();

            // Delete payment
            $(document).on('click', '.deleteBtn', function () {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this payment?')) {
                    $.ajax({
                        url: 'paymentController.php',
                        type: 'POST',
                        dataType: 'json',
                        data: { action: 'deletePayment', id: id },
                        success: function (response) {
                            alert(response.message);
                            fetchPayments();
                        },
                        error: function () {
                            alert('Failed to delete payment.');
                        }
                    });
                }
            });

            // Edit payment (redirect to edit page)
            $(document).on('click', '.editBtn', function () {
                const id = $(this).data('id');
                window.location.href = `editPayment.php?id=${id}`;
            });
        });
    </script>
</body>
</html>