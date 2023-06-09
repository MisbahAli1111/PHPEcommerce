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
        $query=mysqli_query($conn,"select * from `admin_users` where id=$id");
        $check=mysqli_num_rows($query);
        if($check>0)
        {

            $row=mysqli_fetch_assoc($query);

            $name=$row['username'];
            $password=$row['password'];
            $email=$row['email'];
            $mobile=$row['mobile'];
            
        }
        
     
       
        if(isset($_POST['update_btn']))
        {

            $name_u=$row['username'];
            $password_u=$row['password'];
            $hashPass_u=password_hash($password,PASSWORD_DEFAULT);
            $email_u=$row['email'];
            $mobile_u=$row['mobile'];
            
            
            if(empty($name_u) || empty($email_u) || empty($mobile_u)  || empty($hashPass_u))
            {
                $msg="Please Enter all valid details";
            }
            else{
                 $result=mysqli_query($conn,"update `admin_users`
                 set username='$name_u',password='$hashPass_u',mobile='$mobile_u',email='$email_u' where id=$id");
                 echo "update `admin_users`
                 set username='$name_u',password='$hashPass_u',mobile='$mobile_u',email='$email_u' where id=$id";
                 die();
                 if($result)
                {
                    header('Location:vendor.php?Updated');
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

                                    <h1 class="h4 text-Black-900 mb-4">Update vendor</h1>
                                    </div>
                                   <label for=""></label>
                                        
                                        <div class="form-group">
                                            <label> vendor name </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="username" value="<?php echo $name ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> Vendor email </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="email" value="<?php echo $email; ?>" required>
                                            </div>
                                            <div class="form-group">
                                            <label> password </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="password" placeholder="Enter new Password" required>
                                            </div>
                                            <div class="form-group">
                                            <label>Mobile Number </label>
                                            <input type="input" class="form-control form-control-user"
                                                name="mobile" value="<?php echo $mobile ?>" required>
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