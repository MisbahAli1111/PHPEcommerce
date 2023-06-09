<?php 
require('includes/database.php');
require('functions.php');
if(!isset($_SESSION['USER_LOGIN'])){
    ?>
    <script>   
        window.location.href='index.php';
    </script>
    <?php
}

    $cpassword=get_safe_value($conn,$_POST['cpassword']);
    $npassword=get_safe_value($conn,$_POST['npassword']);
    $hashpass=password_hash($npassword,PASSWORD_DEFAULT);
    $uid=$_SESSION['USER_ID'];
    $query=mysqli_query($conn,"select * from `users` where id='$uid'");
    if(mysqli_num_rows($query)>0){
        while($row=mysqli_fetch_assoc($query)){
            $pwd=$row['password'];
            if(password_verify($cpassword,$pwd)){
                $query=mysqli_query($conn,"update `users` set password='$hashpass' where id='$uid'");
             if($query){
                    echo 'done';
             }
            }else{
                echo 'no';
            }
        }
    }
    else{
        echo 'noid';
    }
    
 
?>