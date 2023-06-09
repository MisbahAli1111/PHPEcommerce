<?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
    //include('includes/database.php');
    
    
   ?>


<?php
$condition='';
$condition1='';

if($_SESSION['ADMIN_ROLE']=='1'){
    $condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
    $condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
}

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
           
            $sql="update product set status='$status' $condition1 where id='$id'";
            mysqli_query($conn,$sql);
        }
        if($type=='delete')
        {
            
            $id=$_GET['id'];
            $sql="delete from product where id='$id' $condition1";
            mysqli_query($conn,$sql);

        }
    }
    
?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
    <h5><a href="add_product.php">Add Products</a></h5>
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
                                
                                $sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id $condition order by product.id desc";
                                $query_run=mysqli_query($conn,$sql);
                                
                                
                                ?>
  <thead>
    <tr>
      <th scope="col">Categories</th>
      
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      
      
      
      
    </tr>
  </thead>

  <?php
         
        if(mysqli_num_rows($query_run)>0)
        {
            
       
            while($row=mysqli_fetch_assoc($query_run))
            {
                
            ?>
                <tr>
                    <td><?php echo $row['categories'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><img src="image/<?php echo $row['image'] ?>"  width="40" height="30"/></td>

            <?php    
            ?>        
                    <td>        
                    </td>
                    
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
                
                        <?php echo "<span class='upd'><a href='update_product.php?id=".$row['id']."'>Update</a></span>" ?>
                
                       
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