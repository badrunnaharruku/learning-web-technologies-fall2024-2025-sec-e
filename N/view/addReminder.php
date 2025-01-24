<?php
require_once('header.php');
?>

<html>
    <head>
        <title>Add Reminder</title>
        <link rel="stylesheet" href="../css/addReminder.css">
        <script>
            function validateReminderForm() {
                let title = document.getElementById("title").value.trim();
                let description = document.getElementById("description").value.trim();
                let dueDate = document.getElementById("due_date").value;

                if (title.length < 3) {
                    alert("Title must be at least 3 characters long.");
                    return false;
                }

                if (description.length < 5) {
                    alert("Description must be at least 5 characters long.");
                    return false;
                }

                if (dueDate === "") {
                    alert("Please select a due date.");
                    return false;
                }

                let currentDate = new Date().toISOString().split('T')[0];
                if (dueDate < currentDate) {
                    alert("Due date cannot be in the past.");
                    return false;
                }

                return true;
            }

            function submitReminderForm(event) {
                event.preventDefault();

                if (!validateReminderForm()) {
                    return false;
                }

                let title = document.getElementById("title").value;
                let description = document.getElementById("description").value;
                let dueDate = document.getElementById("due_date").value;

                let reminderData = {
                    title: title,
                    description: description,
                    due_date: dueDate
                };

                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/addReminderController.php', true);
                xhttp.setRequestHeader('Content-Type', 'application/json');

                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            alert("Reminder added successfully: " + this.responseText);
                        } else {
                            alert("Failed to add reminder: " + this.responseText);
                        }
                    }
                };

                xhttp.send(JSON.stringify(reminderData));
            }
        </script>
    </head>
    <body>
        <h1>Add Reminder</h1>
        <form id="reminderForm" onsubmit="return submitReminderForm(event)">
            <label>Title:</label>
            <input type="text" id="title" required><br><br>

            <label>Description:</label>
            <textarea id="description" required></textarea><br><br>

            <label>Due Date:</label>
            <input type="date" id="due_date" required><br><br>
            
            <button type="submit">Add Reminder</button>
        </form>
    </body>
</html>
