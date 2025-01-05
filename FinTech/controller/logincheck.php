<?php 
    session_start();
    require_once('../model/userModel.php'); 

    if(isset($_REQUEST['submit'])){ 
        $username = trim($_REQUEST['username']); 
        $password = trim($_REQUEST['password']); 

        if($username == null || empty($password)){ 
            echo "Null username/password";
        } else {
            $status = login($username, $password); 
            if($status){
                setcookie('status', 'true', time()+3600, '/'); 
                $_SESSION['username'] = $username; 
                header('location: ../view/home.php'); 
            } else {
                echo "Invalid user!"; 
            }
        }
    } else {
        header('location: ../view/login.html'); 
    }
?>
