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
            $sql="update size_master set status='$status' where id='$id'";
            mysqli_query($conn,$sql);
        }
        if($type=='delete')
        {
            
            $id=$_GET['id'];
            $sql="delete from size_master where id='$id'";
            mysqli_query($conn,$sql);

        }
    }
?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Size</h1>
    <h5><a href="add_size.php">Add Size</a></h5>
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

                                $sql="select * from size_master  order by order_by asc";
                                $query_run=mysqli_query($conn,$sql);

                                

                                ?>
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">size</th>
      <th scope="col">status</th>
      <th scope="col">Order by</th>
      
    </tr>
  </thead>

  <?php

        if(mysqli_num_rows($query_run)>0)
        {
            while($row=mysqli_fetch_assoc($query_run))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['size'] ?></td>
                    <td><?php echo $row['order_by'] ?></td>
                    <td><?php 
                    
                    if($row['status']=='1')
                    {
                        ?>
                        
                        <?php echo "<span class='btn'> <a class='<btn btn-secondary' href='?type=status&operation=deactivated&id=".$row['id']."'>Active</a></span>&nbsp";?>
                   
                <?php
                }
                    else{
                        ?>
                         <?php echo "<span class='bn'><a href='?type=status&operation=activated&id=".$row['id']."' >DeActive</a></span>&nbsp"; ?>   
                        <?php
                    }
                   ?>
                 
                   <?php echo "<span class='danger'><a href='?type=delete&id=".$row['id']."'>Delete</a> </span>";?>
                  
                   
                   <?php echo "<span class='update'><a href='update_size.php?id=".$row['id']."'>Update</a> </span>";?>
                   
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



.btn a{
    
  background-color: #199319;
  color: white;
  padding: 8px 8px;
  
}
.bn a{
    margin-right: 8px;
    margin: auto 0px;
    background-color: orange;
  color: white;
  padding: 8px 8px;
    
}
.danger a{
    margin-right: 8px;
    
    background-color: red;
    color:white;
    padding: 8px 8px;
}

.update a{
    margin-right: 8px;
    background-color: sandybrown;
    color: wheat;
    padding: 8px 8px;
}





</style>



<?php
include('includes/scripts.php');

?>