<?php
require_once('header.php');
?>

<html>
    <head>
        <title>
            Add Bill
        </title>

        <link rel="stylesheet" href="../css/addBill.css">
        <script>
            function validateForm() {
                let name = document.getElementById('name').value.trim();
                let amount = document.getElementById('amount').value;
                let due_date = document.getElementById('date').value;
                let category = document.getElementById('category').value;
                let status = document.getElementById('status').value;

                if (name === "") {
                    alert("Name is required.");
                    return false;
                }

                if (amount === "" || parseFloat(amount) <= 0) {
                    alert("Amount must be a positive number.");
                    return false;
                }

                if (due_date === "") {
                    alert("Due date is required.");
                    return false;
                }

                const currentDate = new Date().toISOString().split('T')[0];
                if (due_date < currentDate) {
                    alert("Due date cannot be in the past.");
                    return false;
                }

                if (category === "") {
                    alert("Category is required.");
                    return false;
                }

                if (status === "") {
                    alert("Status is required.");
                    return false;
                }

                return true;
            }

            function submitBillForm(event) {
                event.preventDefault();

                if (!validateForm()) {
                    return false;
                }

                let name = document.getElementById('name').value;
                let amount = document.getElementById('amount').value;
                let due_date = document.getElementById('date').value;
                let category = document.getElementById('category').value;
                let status = document.getElementById('status').value;

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/addBillController.php', true);
                xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        header(location: 'dashboard.php');
                    }
                };
                xhttp.send(`name=${name}&amount=${amount}&due_date=${due_date}&category=${category}&status=${status}`);
            }
        </script>
    </head>

    <body>
        <h1>Add Bill</h1>
        <form id="billForm" onsubmit="return submitBillForm(event)">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" min="0" required>
            <br>
            <label for="date">Due Date</label>
            <input type="date" name="due_date" id="date" required>
            <br>
            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="food">Food</option>
                <option value="education">Education</option>
                <option value="transport">Transport</option>
                <option value="clothes">Clothes</option>
                <option value="electricity">Electricity</option>
                <option value="water">Water</option>
                <option value="rent">Rent</option>
                <option value="wifi">Wifi</option>
                <option value="gas">Gas</option>
                <option value="mobile">Mobile</option>
                <option value="card">Card</option>
                <option value="other">Other</option>
            </select>
            <br>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Auto-Pay Enabled">Auto-Pay Enabled</option>
            </select>
            <br>
            <button type="submit">Add Bill</button>
        </form>
    </body>
</html>
