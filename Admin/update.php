<?php
  isAdmin();
include('includes/database.php');

  if(isset($_POST['delete_btn']))
  {
    $id=$_POST['delete_id'];
    $sql="delete from attendance where attendee_id='$id'";
    $query_run=mysqli_query($conn,$sql);
    if($query_run)
    {
        header('Location:index.php?deleteSuccessful');
        exit();
    }
  }
  
if(isset($_POST['update']))
    {
       $id=$_POST['edit_id'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $hashedPass=password_hash($passd,PASSWORD_DEFAULT);
        
        $sql="update attendance set username='$username', email='$email',password='$hashedPass' where attendee_id='$id' ";
        $query_run=mysqli_query($conn,$sql);
        header('Location:index.php?UpdateSuccessful');
        exit();
  
            
       
    }
?>

<?php
include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');
    require_once('includes/database.php');
   ?>

<?php

   



if(isset($_POST['edit_btn']))
{
?>

<?php  

    $id=$_POST['edit_id'];
    $sql="select * from attendance where attendee_id='$id' ";
    $query_run=mysqli_query($conn,$sql);
    foreach($query_run as $row)
    {


?>


<form action="update.php" method="post">
<div class="py-5">
        <div class="container">
            <div class="col d-flex justify-content-center">
                <div class="col-mid-15">
                    <div class="card" style="width: 50rem;">
                        <div class="card-header">
                            <h4>Update Form</h4>
                        </div>
                        <div class="card-body">
                        <div class="form-group mb-3">
                                <label>Name</label>
                                <input  type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control" >
                             </div>
                             <div class="form-group mb-3">
                            
                             <div class="form-group mb-3">
                                <label>Email Adress</label>
                                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" >
                             </div>
                             <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" value="<?php echo $row['email']; ?>" class="form-control" name="password">
                             </div>
                             <input type="hidden" name="edit_id" value="<?php echo $row['attendee_id']; ?>" >
                             
                      

                            
                             <button type="submit" class="btn btn-primary" name="update">SUBMIT</button>
                             <a href="index.php" class="btn btn-secondary" role="button">Home</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

<?php }} ?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>