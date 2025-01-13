<?php
session_start();
include '../model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Plain text password as requested

    // Direct SQL query without password encryption
    $sql = "SELECT * FROM authors WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        echo "Login successful!";
        
        exit;
    } else {
        header("Location: search_author.php");
    }
}
?>
