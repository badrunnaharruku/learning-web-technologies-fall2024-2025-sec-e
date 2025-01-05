<?php
session_start();
require_once('../model/userModel.php');
require_once('../mail/mail.php');  

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $con = getConnection();

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        
        $otp = rand(100000, 999999); 
        $_SESSION['otp'] = $otp;

        
        
        sendOTP($email, $otp);

        
        header("Location: ../view/forgotpasswordverify.html");
        exit;
    } else {
        
        echo "Email not found. Please try again.";
    }

    mysqli_close($con);
}
?>
