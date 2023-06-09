<?php
   include('security.php');

   $msg="";
    
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
        
         $code=get_safe_value($conn,$_POST['code']);
         $value=get_safe_value($conn,$_POST['value']);
          
         $coupon_type=get_safe_value($conn,$_POST['coupon_type']);
         $cart_min_value=get_safe_value($conn,$_POST['cart_min_value']);
         $status=get_safe_value($conn,$_POST['status']);
        
      
    
            if(empty($code) || empty($coupon_type) || empty($value)  || empty($cart_min_value) || empty($status))
           {
            $msg="Please Enter all valid feilds";
            
           }
           else{
            $sql="SELECT * FROM `coupon_master` WHERE coupon_code='$code'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $msg="Coupon Already Exist";
                header("Location:add_coupon.php?CouponAlreadyExist");
                exit();
            }
            else{
                 $sql="insert into `coupon_master`(coupon_code,coupon_value,coupon_type,cart_min_value,status) values('$code','$value','$coupon_type','$cart_min_value','$status')";
                 $query=mysqli_query($conn,$sql);
                if($query){
                    header("Location:coupon_master.php");
                    exit();
                }
                else{
                    die();
                }
            }
           }
           
            }


   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="add_coupon.php" method="post" enctype="multipart/form-data">
<body class="bg-gradient">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-8  ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">


                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                <div class="feild_error"><?php echo $msg ?></div>
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Add Coupon</h1>
                                    </div>
                                   <label for=""></label>
                                            <div class="form-group">
                                            <label> Coupon Code </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="code" placeholder="Enter Coupon Code">
                                            </div>
                                            <div class="form-group">
                                            <label> Coupon Value </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="value" placeholder="Enter Coupon Value">
                                            </div>
                                            <div class="form-group">
                                            <label> Coupon Type </label>
                                            <select name="coupon_type" class="form-control form-control-user" required>
                                                <option value="">Select</option>
                                           <?php 
                                                   if($coupon_type=='percentage'){
                                                    echo '<option value="Percentage" selected>Percentage</option>
                                                    <option value="Cash">Cash</option>';            
                                                  } else if($coupon_type=='Cash'){
                                                    echo '<option value="Percentage">Percentage</option>
                                                    <option value="Cash" selected>Cash</option>';
                                                  }   else{
                                                    echo '<option value="Percentage" >Percentage</option>
                                                    <option value="Cash">Cash</option>';
                                                  } 

                                            ?>
                                            </select>
                                            </div>
                                            <div class="form-group">
                                            <label> Cart Min Value </label>
                                            <input type="number" class="form-control"
                                                name="cart_min_value" placeholder="Enter Cart Min Value">
                                            </div>
                                            
                                            <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-user" name="status" id="status" required>
                                                <option value='' selected>Validity</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                
                                            </select>
                                        </div>
                                 
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                          
                                        
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>

   
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<style>
.feild_error{
    align-content: center;
    color: red;
    
    padding: 9px;
}
.form-group{
    color:black;
}

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>