<?php
include('includes/database.php');
include('functions.php');

$json=array();

if(isset($_SESSION['COUPON_ID'])){
      unset($_SESSION['COUPON_VALUE']);
      unset($_SESSION['COUPON_ID']);
      unset($_SESSION['COUPON_CODE']);
      
  }


$totalPrice=0;
foreach($_SESSION['cart'] as $key=>$val){
                                    
      $productArr=getproduct($conn,'','',$key);
      $price=$productArr[0]['price'];
      $qty=$val['qty'];
      $totalPrice=$totalPrice+($price*$qty);
  }

      $coupon_code=get_safe_value($conn,$_POST['coupon_code']);
      $result=mysqli_query($conn,"select * from `coupon_master` where coupon_code='$coupon_code' and status='1'");
      $coupon_details=mysqli_num_rows($result);
      if($coupon_details>0){
        $row=mysqli_fetch_assoc($result);
        $id=$row['id'];
        $coupon_value=$row['coupon_value'];
        $coupon_type=$row['coupon_type'];
        $cart_min_value=$row['cart_min_value'];
        
        

         if($cart_min_value>$totalPrice){
            $jsonArr=array('is_error'=>'yes','result'=>$totalPrice,'dd'=>'Cart total must be greater than '.$coupon_value);
            

         }else{
            if($coupon_type=='Cash'){
                  $final_price=$totalPrice-$coupon_value; 
                  
            }else{
                  $final_price=$totalPrice-(($totalPrice*$coupon_value)/100);
            }
            $dd=$totalPrice-$final_price; 
            $_SESSION['COUPON_VALUE']=$dd;
            $_SESSION['COUPON_ID']=$id;
            $_SESSION['FNAL_PRICE']=$final_price;
            $_SESSION['COUPON_CODE']=$coupon_code;
        
            $jsonArr=array('is_error'=>'no','result'=>$final_price,'dd'=>$dd);
            
         }

        }                       
    else{
      $jsonArr=array('is_error'=>'yes','result'=>$totalPrice,'dd'=>'No such Coupon Code exist');
            
}
echo json_encode($jsonArr);
?>