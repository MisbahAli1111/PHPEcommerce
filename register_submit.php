<?php
include('includes/database.php');
include('functions.php');

$name=get_safe_value($conn,$_POST['name']);
$email=get_safe_value($conn,$_POST['email']);
$mobile=get_safe_value($conn,$_POST['mobile']);
$password=get_safe_value($conn,$_POST['password']);
$added_on=date('Y-m-d h:i:s');
$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
$check_user=mysqli_num_rows(mysqli_query($conn,"select * from users where email= '$email'"));
if($check_user>0)
{
    echo "present";
}
else{
    $sql="INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES (NULL, '$name', '$hashedpassword', '$email', '$mobile', '$added_on')";
    $result=mysqli_query($conn,$sql);
    
        echo "insert";
}


?>