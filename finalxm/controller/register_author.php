<?php
include '../model/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['author_name'];
    $contact = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];  

    if ($name == "" || $contact == "" || $username == "" || $password == "") {
        echo "Please fill all fields!";
        exit;
    }

    
    $sql = "INSERT INTO authors (author_name, contact_no, username, password) 
            VALUES ('$name', '$contact', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        //echo "Author Registered Successfully!";
       header('location: ../view/login.html');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
