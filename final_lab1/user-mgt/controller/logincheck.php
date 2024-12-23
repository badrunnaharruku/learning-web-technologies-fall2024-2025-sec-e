<?php 
    session_start();
    //include('../model/userModel.php');
    //include_once('../model/useModel.php');
    //require('../model/useModel.php');
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['username']);
        $password = trim($_REQUEST['password']);

        if($username == null || empty($password)){
            echo "Null username/password";
        }else{
            
            $status = login($username, $password);
            if($status){
                setcookie('status', 'true', time()+3600, '/');
                $_SESSION['username'] = $username;
                header('location: ../view/home.php');
            }else{
                echo "invalid user!";
            }
        }
    }else{
        //echo "invalid request!";
        header('location: ../view/login.html');
    }

?>