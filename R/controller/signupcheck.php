<?php
session_start();
require_once('../model/userModel.php');

if (isset($_POST['submit'])) { 
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = 'User';

    if (empty($username) || empty($email) || empty($gender) || empty($dob) || empty($address) || empty($phone) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } 
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $username)) {
        echo "Name should contain only characters and spaces.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } 
    elseif (strlen($password) < 7) {
        echo "Password should be at least 7 characters.";
    } 
    elseif (!preg_match("#[0-9]+#", $password)) {
        echo "Password must contain at least one digit.";
    } 
    elseif (!preg_match("#[a-z]+#", $password)) {
        echo "Password must contain at least one lowercase letter.";
    } 
    elseif (!preg_match("#[A-Z]+#", $password)) {
        echo "Password must contain at least one uppercase letter.";
    } 
    elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } 
    elseif (!preg_match('/^[0-9]{11}$/', $phone)) {
        echo "Phone number must be numeric and exactly 10 digits.";
    } 
    else {
        
        $status = addUser($username, $password, $email, $gender, $dob, $address, $phone, $role);

        if ($status) {
            header('location: ../view/login.html');
        } else {
            echo "Registration failed. Please try again.";
        }
    }
} 
else {
    header('location: ../view/signup.html');
}
?>
