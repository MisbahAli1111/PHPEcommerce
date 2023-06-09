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
        
        if($type=='delete')
        {
            
            $id=$_GET['id'];
            $sql="delete from contact_us where id='$id'";
            mysqli_query($conn,$sql);

        }
    }
?>


  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Contact Us</h1>
   
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

                                $sql="select * from contact_us  order by name desc";
                                $query_run=mysqli_query($conn,$sql);

                                

                                ?>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">Comment</th>
      <th scope="col">Action</th>
      
      
      
      
    </tr>
  </thead>

  <?php

        if(mysqli_num_rows($query_run)>0)
        {
            while($row=mysqli_fetch_assoc($query_run))
            {
                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['added_on'] ?></td>
                    <td><?php echo $row['comment'] ?></td>
                    
                    <td> 
                    
                
                 
                   <?php echo "<span class='danger'><a href='?type=delete&id=".$row['id']."'>Delete</a> </span>";?>
                  
                   
                   
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