<?php

    require('includes/database.php');
    require('functions.php');
    require('add_to_cart.inc.php');

    $pid=get_safe_value($conn,$_POST['pid']);
    $type=get_safe_value($conn,$_POST['type']);

    if(isset($_SESSION['USER_LOGIN'])){
        $uid=$_SESSION['USER_ID'];
        $added_on=date('Y-m-d h:i:s');
        
        if(mysqli_num_rows(mysqli_query($conn,"select * from whishlist where user_id='$uid' and product_id='$pid'"))>0){
         //   echo "alreadyexist";
        }
        else{
            // $query=mysqli_query($conn,"insert into whishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
            wishlist_add($conn,$uid,$pid);     
        }
        echo $total_record=mysqli_num_rows(mysqli_query($conn,"select * from whishlist where user_id='$uid'"));
       
    }else{
        $_SESSION['WISHLIST_ID']=$pid;
        echo "notlogin";
  
    }
?>