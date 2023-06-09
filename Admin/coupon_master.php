<?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
    //include('includes/database.php');
    
    isAdmin();
   ?>


<?php

    if(isset($_GET['type']) && $_GET['type']!='')
    {
        $type=$_GET['type'];
        if($type=='status')
        {
            $operation=$_GET['operation'];
            $id=$_GET['id'];
            
            if($operation=='activated')
            {
                $status='1';
            }
            else
            {
                $status='0';
            
            }
           
            $sql="update `coupon_master` set status='$status' where id='$id'";
            mysqli_query($conn,$sql);
        }
        if($type=='delete')
        {
            
            $id=$_GET['id'];
            $sql="delete from `coupon_master` where id='$id'";
            mysqli_query($conn,$sql);

        }
    }
?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coupon Details</h1>
    <h5><a href="add_coupon.php">Add Coupons</a></h5>
</div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-xl-12 col-lg-100">
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List</h6>
                                </div>
                                <div class="card-body">
                                <table class="table" cellspacing="100%">

                                <?php
                            //    $sql="select product.*,categories.categories,sub_categories.id,sub_categories.sub_categories,product.id as pid from product,categories,sub_categories where  product.categories_id=categories.id and product.sub_categories_id=sub_categories.id  order by product.id desc";
                                
                                $sql="select * from coupon_master order by id asc";
                                $query_run=mysqli_query($conn,$sql);
                                
                                
                                ?>
  <thead>
    <tr>
      <th scope="col">Coupon Code</th>
      <th scope="col">Coupon Value</th>
      <th scope="col">Coupon Type</th>
      <th scope="col">Cart Min Value</th>
      <th scope="col">Status</th>
      
      
      
      
    </tr>
  </thead>

  <?php
         
        if(mysqli_num_rows($query_run)>0)
        {
            
       
            while($row=mysqli_fetch_assoc($query_run))
            {
                
            ?>
                <tr>
                    <td><?php echo $row['coupon_code'] ?></td>
                    <td><?php echo $row['coupon_value'] ?></td>
                    <td><?php echo $row['coupon_type'] ?></td>
                    <td><?php echo $row['cart_min_value'] ?></td>
                    
                    <td><?php 
                    
                    if($row['status']=='1')
                    {
                        ?>
                        
                       <?php echo "<span class='act'><a href='?type=status&operation=deactivated&id=".$row['id']."'>Active</a></span>"  ?>
                    
                <?php
                }
                    else{
                        ?>
                       <?php  echo "<span class='deact'><a href='?type=status&operation=activated&id=".$row['id']."'>Deactivated</a>&nbsp</span>" ?>
                       
                    <?php
                    }
                   ?>
                   
                   
                        <?php echo "<span class='del'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>" ?>
                
                        <?php echo "<span class='upd'><a href='update_coupon.php?id=".$row['id']."'>Update</a></span>" ?>
                
                       
                </td>
                    
                
               
            </tr>

        

            </td>
             

             </tr>
 
         <?php
             }
         }
         ?>
        
        
        <tbody>
      
     
 
 
     
      </tbody>
    </table>
    </div>
    </div>
    
                                    </div>
                                </div>
    
    
<style>
.act a{
    background-color:  #199319;
    color: white;
    padding: 8px 8px;
    
}

.deact a{
    background-color: orange;
    color: white;
    padding: 8px 8px;
    
}
.del a{
    background-color: red;
    color: white;
    padding: 8px 8px;
    
}
.upd a{
    background-color: sandybrown;
    color: white;
    padding: 8px 8px;
    
}






</style>



<?php
include('includes/scripts.php');

?>