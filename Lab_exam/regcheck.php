<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] =="POST" && isset($_POST['submit'])){
    $name = $_POST['name'];
    $id =$_POST['id'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $dob =$_POST['dob'];
    $gender =$_POST['gender'];
    $department =$_POST['department'];
    $address =$_POST['address'];

    if (!isset ($_SESSION['users'])){
        $_SESSION['users'] = [];
    }
    $userdata = [
        'name' => $name,
        'id' => $id,
        'email' => $email,
        'password' => $password,
        'dob' => $dob,
        'gender'=> $gender,
        'department' => $department,
        'address' => $address
    ];
    $_SESSION['users']['name'] = $userdata;
    $_SESSION['users'] = $userdata;
    $_SESSION['status'] = true;
    header('Location: home.php');
    exit();
}
       else{      echo "request error!!!";
    }


?>