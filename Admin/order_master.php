<?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
  
   ?>
                                 <?php
                                
                                $sql="select * from users order by id desc";
                                $query_run=mysqli_query($conn,$sql);
                                
                                
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
                                    <h2 class="m-0 font-weight-bold text-primary">Order Master</h2>                                  
                                </div>
  
                                <div class="card-body">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order ID</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr"> Adress </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Action</span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              
                                         
                                            $query=mysqli_query($conn,"select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=`order`.order_status");
                                                while($row=mysqli_fetch_assoc($query)){

                                                
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['id'] ?></a></td>
                                                <td class="product-name"><?php echo $row['added_on'] ?></a></td>
                                                <td class="product-name"><?php echo $row['address'] ?><br>  
                                                <?php echo $row['city'] ?><br>
                                                <?php echo $row['pincode'] ?>
                                            </a></td>
                                                <td class="product-name"><?php echo $row['payment_type'] ?></a></td>
                                                <td class="product-name"><?php echo $row['payment_status'] ?></a></td>
                                                <td class="product-name"><?php echo $row['order_status_str'] ?></a></td>
                                                <td class="product-add-to-cart"><button class="btn btn-light"><a href="../order_pdf.php?id=<?php echo $row['id'] ?>">Print PDF</a></td></button>
                                                <td class="product-add-to-cart"><button class="btn btn-light"><a href="order_master_details.php?id=<?php echo $row['id'] ?>">Update Status</a></button></td>
                                            
                                            </tr>
                                          <?php
                                          }  
                                          ?>
                                        </tbody>
                                       
                                    </table> 
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
    .btn-print{
        color: yellow;
    }

</style>
  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>