<?php
    require('includes/database.php');
    require('functions.php');

    $name=get_safe_value($conn,$_POST['name']);
    $email=get_safe_value($conn,$_POST['email']);
    $mobile=get_safe_value($conn,$_POST['mobile']);
    $comment=get_safe_value($conn,$_POST['message']);
    $added_on=date('Y-m-d h:i:s');
    $sql="INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `added_on`, `comment`) VALUES (NULL, '$name', '$email', '$mobile', '$added_on', '$comment')";
    
    if(mysqli_query($conn,$sql)){
        echo "success";
    }

?>