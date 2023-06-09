<?php
include('includes/database.php');
include('functions.php');

$otp=get_safe_value($conn,$_POST['otp']);

    if($otp==$_SESSION['EMAIL_OTP']){
        echo 'done';
    }else{
        echo 'no';
    }



?>