<?php
   include('security.php');
   $sub_categories_id='';
   isAdmin();
   ?>

   <?php

$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
    {
        $id=$_GET['id'];
        $query=mysqli_query($conn,"select * from `coupon_master` where id=$id");
        $check=mysqli_num_rows($query);
        if($check>0)
        {

            $row=mysqli_fetch_assoc($query);

            $code=$row['coupon_code'];
            $value=$row['coupon_value'];
            $type=$row['coupon_type'];
            $min_value=$row['cart_min_value'];
            
        }
        
     
       
        if(isset($_POST['update_btn']))
        {

           $code=$_POST['coupon_code'];
            $value= $_POST['coupon_value'];       
            $type=$_POST['coupon_type'];
            $min_value=$_POST['cart_min_value'];
            
            
            if(empty($code) || empty($type) || empty($value)  || empty($min_value))
            {
                $msg="Please Enter all valid details";
            }
            else{
                 $result=mysqli_query($conn,"update `coupon_master`
                 set coupon_code='$code',coupon_value='$value',coupon_type='$type',cart_min_value='$min_value' where id=$id");
                 if($result)
                {
                    header('Location:coupon_master.php?Updated');
                    exit();
                }
               else{
                   $msg="Query Error";
               }
                 }

                 
                 
         }
           
     

    }
?>

<link href="css/sb-admin-2.min.css" rel="stylesheet">

<form  method="post" enctype="multipart/form-data">
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
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Update Product</h1>
                                    </div>
                                   <label for=""></label>
                                        
                                        <div class="form-group">
                                            <label> Coupon Code </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="coupon_code" value="<?php echo $code ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Coupon Value </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="coupon_value" value="<?php echo $value; ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Cart Min Value </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="cart_min_value" value="<?php echo $min_value ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Coupon Type </label>
                                            <select class="form-control form-control-user" name="coupon_type" required>
                                                     <option value="">Select</option>
                                                     <?php
                                                        if($type=='Percentage')
                                                        {
                                                            echo '<option value="Percentage" selected >Percentage</option>
                                                            <option value="Cash">Cash</option>';
                                                        }
                                                        elseif($type=='Cash'){
                                                            echo '<option value="Percentage" >Percentage</option>
                                                            <option value="Cash" selected>Cash</option>';

                                                        }else{
                                                            echo '<option value="Percentage">Percentage</option>
                                                            <option value="Cash">Cash</option>';
                                                        }
                                                        
                                                    ?>
                                            </select>
                                            </div>
                                            

                                        <button type="submit" class="btn btn-primary  btn-user btn-block" name="update_btn">Update</button> 
                                            <div class="feild_error"><?php echo "$msg"; ?></div>
                                        
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    </div>
    </form>

    <script>
        function get_sub_cat(sub_cat_id){
            var categories_id=jQuery('#categories_id').val();
            
            jQuery.ajax({
                url: 'get_sub_cat.php',
                type: 'post',
                data: 'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
                success:function(result){
                    jQuery('#sub_categories_id').html(result);
                }
            });
        }
        
    </script>
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
    color: red;
}
.form-group{
    color:black;
}

</style>




                    

<?php


include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
    <?php
        if(isset($_GET['id'])){
            ?>
            get_sub_cat(<?php echo $sub_categories_id; ?>);
            <?php
        }
        ?>
</script>