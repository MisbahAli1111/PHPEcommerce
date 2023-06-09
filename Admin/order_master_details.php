<?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
  isAdmin();
   ?>
 <?php                               
                                
  $order_id=$_GET['id'];
  $query=mysqli_query($conn,"select coupon_value,coupon_code from `order` where id='$order_id'");
$coupon_details=mysqli_fetch_assoc($query);
if($query){
    $coupon_value=$coupon_details['coupon_value'];
    $coupon_code=$coupon_details['coupon_code'];
}else{
    $coupon_value=0;
    $coupon_code=0;
}

if(isset($_POST['update_order_status'])){
     $update_status=$_POST['update_order_status'];

     mysqli_query($conn,"update `order` set order_status='$update_status' where id='$order_id'");
     

}                                


?>


 
 <?php
 
    ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
   
</div>


                    <!-- Content Row -->
                    <div class="row">
                  
                        <!-- Content Column -->
                        <div class="col-xl-12 col-lg-100">
                            <div class="card shadow mb-5">
                            <div class="card-header py-3">
                                    <h2 class="m-0 font-weight-bold text-primary">Order Details</h2>                                  
                                </div>
  
                                <div class="card-body">
                                <table class="table">
                                <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                
                                                <th class="product-name"><span class="nobr">Qty</span></th>
                                                <th class="product-price"><span class="nobr"> Price </span></th>
                                                <th class="product-price"><span class="nobr"> Total Price </span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_price=0;
                                            $query=mysqli_query($conn,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image,`order`.address,`order`.city,`order`.pincode,`order`.order_status from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id");
                                            while($row=mysqli_fetch_assoc($query)){
                                                    $address=$row['address'];
                                                    $city=$row['city'];
                                                    $pincode=$row['pincode'];
                                                    $order_status=$row['order_status'];
                                                    
                                                    $total_price=$total_price+($row['price']*$row['qty']);
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['name'] ?></td>
                                                <td class="product-name"><?php echo $row['image'] ?></td>
                                                <td class="product-name"><?php echo $row['qty'] ?></td>
                                                <td class="product-name"><?php echo $row['price'] ?></td>
                                                <td class="product-name"><?php echo $row['qty']*$row['price'] ?></td>
                                                
                                            </tr>
                                            <?php
                                             if($coupon_value!=''){

                                          
                                                ?>
                                                <tr>
                                                      <td colspan="3"></td>
                                                      <td class="product-name">Coupon Value</td>
                                                      <td class="product-name"><?php echo $coupon_value ."($coupon_code)" ?></td>
                                                      
                                                  </tr>
                                                  <?php }
                                                  else{
                                                      $coupon_value=0;
                                                  } 
                                      ?>
                                            
                                          <?php
                                          }  
                                          ?>
                                          <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>
                                                <td class="product-name"><?php echo $total_price-$coupon_value ?></td>
                                                
                                            </tr>
                                        </tbody>
                                     
                                       
                                    </table> 
                                    <div class="address_details">
                                        <strong>Address</strong>
                                    <?php echo $address ?> , <?php echo $city ?> , <?php echo $pincode ?>
                                    <br>
                                    <strong>
                                        order Status
                                    </strong>
                                         
                                    <?php
                                     $query=mysqli_fetch_assoc(mysqli_query($conn,"select order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id "));
                                    echo $query['name'] ?>
                                          
                                </div>
                                <form method="post">
                                    <select class="form-control" name="update_order_status">
                                        <option>Select Status</option>
                                        <?php
                                        $res=mysqli_query($conn,"select * from `order_status`");
                                        while($row= mysqli_fetch_assoc($res)){
                                            if($row['id']==$categories_id){
                                                echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                            }
                                            else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            }
                                        }
                                    
                                        ?>
                                    </select>
                                    <input type="submit" class="form-control">
                                </form>
    </div>
    </div>
    
                                    </div>
                                </div>
    
<style>

.del a{
    background-color: red;
    color: white;
    padding: 8px 8px; 
}

</style>
  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>