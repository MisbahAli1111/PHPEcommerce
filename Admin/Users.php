<?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
   isAdmin();
   ?>
   <?php
   if(isset($_GET['id']) && $_GET['id']!=NULL)
   {
       $id=$_GET['id'];
       mysqli_query($conn,"delete from users where id='$id'");
   }

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
                                    <h2 class="m-0 font-weight-bold text-primary">Users</h2>                                  
                                </div>
  
                                <div class="card-body">
                                <table class="table" cellspacing="100%">


                                <?php
                                
                                $sql="select * from users order by id desc";
                                $query_run=mysqli_query($conn,$sql);
                                
                                
                                ?>
  <thead>
    <tr>
      <th scope="col">ID</th>
    
      
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Date</th>
      <th scope="col">Actions</th>
      
      
      
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
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['mobile'] ?></td>
                    <td><?php echo $row['added_on'] ?></td>
                    <td><?php 
                             echo "<span class='del'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>" 
                         ?>
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