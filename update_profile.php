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

    $name=get_safe_value($conn,$_POST['name']);
    $uid=$_SESSION['USER_ID'];

    $query=mysqli_query($conn,"update `users` set name='$name' where id='$uid'");
    if($query){
        $_SESSION['USER_NAME']=$name;
        echo 'Your Name Updated';
    }
 
?>