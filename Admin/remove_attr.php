<?php
include('includes/database.php');
include('function.php');

if(isset($_POST['id'])){
    
// if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

// }
// else{
//     header('location:login.php');
//     die();
// }

$id=get_safe_value($conn,$_POST['id']);
mysqli_query($conn,"delete from product_attributes where id='$id'");

}
?>