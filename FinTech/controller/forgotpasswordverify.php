<?php
session_start();
require_once('../model/userModel.php'); 

if (isset($_POST['submitverify'])) {
    
    $verification_code = $_POST['verification_code'];
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];

    
    $error_message = "";

    
    if (!isset($_SESSION['otp'])) {
        $error_message = "Session expired. Please request a new OTP.";
    } elseif ($verification_code != $_SESSION['otp']) {
        $error_message = "Invalid verification code.";
    } elseif ($new_password != $retype_password) {
        
        $error_message = "Passwords do not match. Please try again.";
    } elseif (strlen($new_password) < 6) {
        
        $error_message = "Password must be at least 6 characters long.";
    }


    if (empty($error_message)) {
        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        
        $email = $_SESSION['email'];  
        $con = getConnection(); 

        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
        $update_result = mysqli_stmt_execute($stmt);

        if ($update_result) {
            
            echo "Password has been successfully changed.";
            
            header("Location:../view/login.html");
            exit;
        } else {
            
            echo "Error updating password. Please try again.";
        }

        mysqli_close($con);
    } else {
        
        echo $error_message;
    }
}
?>
