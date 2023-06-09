<?php
include('includes/database.php');
include('functions.php');

$email=get_safe_value($conn,$_POST['email']);
$number=get_safe_value($conn,$_POST['number']);

$password=get_safe_value($conn,$_POST['password']);

$res=mysqli_query($conn,"select * from `users` where email='$email' and mobile='$number'");
$query=mysqli_num_rows($res);
if($query>0){
    $hashedpassword=password_hash($password,PASSWORD_DEFAULT);
    $query=mysqli_query($conn,"update `users` set password='$hashedpassword' where email='$email'");
    if($query){
        echo 'done';
    }
}else{
        echo 'no';
        
}


 
  


?> 