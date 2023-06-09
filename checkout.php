
  <?php
require('includes/header.php');
require('includes/topbar.php');
//prx($_SESSION['cart']);
$cart_total=0;


if(isset($_POST['submit']))
{

 
    $address=get_safe_value($conn,$_POST['address']);
    $city=get_safe_value($conn,$_POST['city']);
    $code=get_safe_value($conn,$_POST['code']);

    $payment_type='COD';
    $user_id=$_SESSION['USER_ID'];

    foreach($_SESSION['cart'] as $key=>$val){
		foreach($val as $key1=>$val1)	{
			$resAttr=mysqli_fetch_assoc(mysqli_query($conn,"select price from product_attributes where id='$key1'"));
			$price=$resAttr['price'];
			$qty=$val1['qty'];
			$cart_total=$cart_total+($price*$qty);
			
		}
	}

    $total_price=$cart_total;
    $payment_status='pending';
    if($payment_type=='COD'){
        $Patment_status='success';
    }
    $order_status='1';
    $added_on=date('Y-m-d h:i:s');
    
    if(isset($_SESSION['COUPON_ID'])){
        $coupon_value=$_SESSION['COUPON_VALUE'];
        $coupon_id=$_SESSION['COUPON_ID'];
        $coupon_code=$_SESSION['COUPON_CODE'];
        $cart_total=$cart_total-$coupon_value;
        unset($_SESSION['COUPON_VALUE']);
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_CODE']);
        
    } else{
        $coupon_value='';
        $coupon_id=0;
        $coupon_code='';
    }
    ///echo "INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `coupon_id`, `coupon_code`, `coupon_value`, `added_on`) VALUES (NULL, '$user_id', '$address', '$city', '$code', '$payment_type', '$cart_total', '$payment_status', '$order_status', '$coupon_id', '$coupon_code', '$coupon_value', '$added_on')";
    $query=mysqli_query($conn,"INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `coupon_id`, `coupon_code`, `coupon_value`, `added_on`) VALUES (NULL, '$user_id', '$address', '$city', '$code', '$payment_type', '$cart_total', '$payment_status', '$order_status', '$coupon_id', '$coupon_code', '$coupon_value', '$added_on')");
    if(!$query){
        die();      
    }
    

    $order_id=mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $key=>$val){
                                    
        foreach($val as $key1=>$val1)	{
			$resAttr=mysqli_fetch_assoc(mysqli_query($conn,"select price from product_attributes where id='$key1'"));
			$price=$resAttr['price'];
			$qty=$val1['qty'];
			
			$query1=mysqli_query($conn,"insert into `order_detail`(order_id,product_id,product_attr_id,qty,price) values('$order_id','$key','$key1','$qty','$price')");
			
		}    
    }
        if($query1){
            unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href='thankyou.php';
        </script>   
<?php
        }
        
 }

?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                            <?php if(isset($_SESSION['USER_LOGIN'])){
                                               ?>
                                                    <span class="login_error" id="login_error"></span>
                                               <div class='alert alert-success'><strong>You have successfully already loggedIn, you can Proceed</strong></div>
                                               <?php

                                        
                                        }
                                            else{
                                                ?>
                                                    <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                    <form id="login-form" >
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="feild_error" id="login_email_error"></span>
										
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="feild_error" id="login_password_error"></span>
										
									</div>
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="user_login()" class="fv-btn">Login</button>
										
										
									</div>
								</form>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>    
                                            
                                                <!-- <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <div class="dark-btn">
                                                                <a href="#">Register</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if(isset($_SESSION['USER_LOGIN'])){
                                        ?>
                                                <div class="accordion__title">
                                                Address Informations
                                                </div>
                                                <form method="post">     
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                           
                                                <div class="row">
                                                   
                                                  
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State"required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="code" placeholder="Post code/ zip"required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            
                                        </div>
                                    </div>
                                            <div class="single-method">
                                                      <strong> As per our policy delivery method is COD only</strong>
                                            </div>
                                            <br>
                                            
                                    <div class="single-method">
                                                  <button type="submit" name="submit" class="fv-btn">Submit</button>
                                            </div>
                                </form>
                               
                                    
                                        <?php
                                    }

                                    else{
                                    
                                    }
                                    ?>
                               
                                    
                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            
                    <?php
                    
                                            $totalPrice=0;
                                            foreach($_SESSION['cart'] as $key=>$val){
                                            //$productArr=get_product($con,'','',$key);
                                            
                                            //prx($productArr);
                                            
                                            foreach($val as $key1=>$val1){
                                                
                                            $resAttr=mysqli_fetch_assoc(mysqli_query($conn,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
                                            left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
                                            left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
                                            where product_attributes.id='$key1'"));						
                                            $productArr=getproduct($conn,'','',$key,'','','','',$key1);
                                            $pname=$productArr[0]['name'];
                                            $mrp=$productArr[0]['mrp'];
                                            $price=$productArr[0]['price'];
                                            $image=$productArr[0]['image'];
                                            $qty=$val1['qty'];	
                                            
                                            $totalPrice=$totalPrice+($price*$qty);
                                            ?>
                                
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="Admin/image/<?php echo $image; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price"><?php echo $price; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                    <a href="javascript:void(0)"  onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                          
        <?php
                    }        }
                    

        ?>
         </div>         
                            <div class="ordre-details__total">
                                <h5>Coupon Code</h5>
                                <input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon code here">
                                <button class="fv-btnn"  onclick="set_coupon()">Enter</button>
                            </div>
                            <div id="coupon_result"></div>
                            <div class="ordre-details__total" id="coupon_box">
                                <h5>Coupon Value</h5>
                                <span class="price " id="coupon_price"></span>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price" id="order_total_price"><?php echo $totalPrice ?></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            
   
        function set_coupon(){
            jQuery('#coupon_result').html(''); 
				var coupon_code=jQuery('#coupon_code').val();
				
				if(coupon_code==''){
					jQuery('#email_error').html('Please enter otp');
				}else{
					jQuery.ajax({
						url: 'set_coupon.php',
						type: 'post',
						data : 'coupon_code='+coupon_code,
						success:function(result){
							result=$.trim(result);
                            var data=jQuery.parseJSON(result);
                            if(data.is_error=='yes'){
                                jQuery('#coupon_box').hide();
                                jQuery('#coupon_result').html(data.dd);           
                                jQuery('#order_total_price').html(data.result);
                            }
                            if(data.is_error=='no'){
                                jQuery('#coupon_box').show();
                                jQuery('#coupon_price').html(data.dd);
                                jQuery('#order_total_price').html(data.result);
                                
                            }
						}
					});
				
				}
				
			}
    
            function manage_cart(pid,type){
         if(type=='update')
         {
            var qty=jQuery("#"+pid+"qty").val();
             
         }else{
             var qty=jQuery("#qty").val(); 
         }
        jQuery.ajax({
        url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href='checkout.php';
			}
			jQuery('.htc__qua').html(result);
        }    
                    
                });
    }

       </script>


    <style>
       
        #coupon_box{
            display: none;
        }

        #coupon_result {
            padding-left: 131px; 
        color: red;
        font-weight: bold;
    }

.accordion .accordion__hide {
  background: #f4f4f4;
  height: 65px;
  line-height: 65px;
  display: flex;
  align-items: center;
  padding: 0 30px;
  position: relative;
  font-size: 16px;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 10px;
  font-family: "Poppins";
  cursor: pointer;
}
.fv-btnn {
    background: #c43b68 none repeat scroll 0 0;
    border: 1px solid #c43b68;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 600;
    height: 29px;
    padding: 0 30px;
    text-transform: uppercase;
    transition: all 0.4s ease 0s;
    padding-right: 20px;
}
.order-details .ordre-details__total h5 {
    color: #3f3f3f;
    text-transform: uppercase;
    font-size: 16px;
    letter-spacing: 1px;
    font-weight: 700;
    margin-right: 10px;
}
.order-details .ordre-details__total span.price{
     
     text-align: left;
     font-weight: 700;
     font-family: "Poppins";
     letter-spacing: 1px;
 } 
    </style>
    <script>
function user_login(){

jQuery('.field_error').html('');
var email=jQuery("#login_email").val();
var password=jQuery("#login_password").val();
var is_error='';
if(email==""){
    jQuery('#login_email_error').html('Please enter email');
    is_error='yes';
}if(password==""){
    jQuery('#login_password_error').html('Please enter password');
    is_error='yes';
}
if(is_error==''){
    jQuery.ajax({
        url:'login_submit.php',
        type:'post',
        data:'email='+email+'&password='+password,
        success:function(result){
            result=$.trim(result); 
            if(result=='wrong'){
                $('#login-form').trigger('reset');
                $('#login_error').html("<div class='alert alert-danger'><strong>Please enter valid login details</strong></div>");

            }
            if(result=='valid'){	                              		
              
                $('#login-form').trigger('reset');		
                $('#login_error').html("<div class='alert alert-success'><strong>You have successfully logged in now you can Proceed</strong></div>");
                window.location.href='checkout.php'; 
            }
        }	
    });
}	
}

    </script>

    <style>
        .feild_error{
            color: red;
        }
        .feild_success{
            color: green;
            margin: 55px;
            font-size: 20px;
        }
        .login_error{
            color: red;
            margin: 20px;
            font-size: 15px;
        }

    </style>




        <?php
 if(isset($_SESSION['COUPON_ID'])){
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    
}

    include('includes/footer.php');
        ?>