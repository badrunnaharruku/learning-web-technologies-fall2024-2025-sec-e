<?php
// Include the config file
require_once 'config.php';

// Test the database connection
if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to the database: " . mysqli_connect_error();
}
?>