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

        
        if (empty($username) || empty($email) || empty($gender) || empty($dob) || empty($address) || empty($phone) || empty($password) || empty($confirm_password)) {
            echo "All fields are required.";
        }
        elseif (!preg_match("/^[a-zA-Z]+$/", $username)){
            echo "Name should contain Character and Space";
        }
        
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
        }
        elseif (strlen($password)<7){
            echo "Password Should be atleast 6 chaeacters";
        }
        elseif(!preg_match("#[0-9]+#",$password)){
                echo "type at least one digit";
        }
        elseif(!preg_match("#[a-z]+#",$password)){
                echo "type at least one lowercase";
        }
        elseif(!preg_match("#[A-Z]+#",$password)){
                echo "type at least uppercase";
            }
        elseif ($password !== $confirm_password) {
            echo "Passwords do not match.";
        }
        elseif (!preg_match('/^[0-9]{10}$/', $phone)) { 
            echo "Invalid phone number.";
        } else {
            
            $user = [
                'username' => $username,
                'email' => $email,
                'gender' => $gender,
                'dob' => $dob,
                'address' => $address,
                'phone' => $phone,
                'password' => password_hash($password, PASSWORD_BCRYPT) 
            ];

            
            $status = addUser($username, $password, $email, $gender, $dob, $address, $phone);

            if ($status) {
            header ('location: ../view/login.html');
            } else {
                echo "Registration failed. Please try again.";
            }
        }
    } else {
        header('location: ../view/signup.html'); 
    }
?>
