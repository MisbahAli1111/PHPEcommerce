<?php
   include('security.php');

   $msg="";
    
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
        
         $name=$_POST['username'];
         $email=$_POST['email'];
          $role='1';
         $password=$_POST['password'];
         $mobile=$_POST['mobile'];
         $status=$_POST['status'];
        
        $hashPass=password_hash($password,PASSWORD_DEFAULT);
    
            if(empty($name) || empty($email) || empty($password)  || empty($mobile) || empty($status))
           {
            $msg="Please Enter all valid feilds";
            
           }
           else{
            $sql="SELECT * FROM `admin_users` WHERE email='$email'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $msg="Email Already registered";
                header("Location:add_vendor.php?VendorAlreadyExist");
                exit();
            }
            else{
                 $sql="insert into `admin_users`(username,email,password,mobile,role,status) values('$name','$email','$hashPass','$mobile','$role','$status')";
                 $query=mysqli_query($conn,$sql);
                if($query){
                    header("Location:vendor.php");
                    exit();
                }
                else{
                    die();
                }
            }
           }
           
            }


   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="add_vendor.php" method="post" enctype="multipart/form-data">
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
                                <div class="feild_error"><?php echo $msg ?></div>
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Add Vendor</h1>
                                    </div>
                                   <label for=""></label>
                                            <div class="form-group">
                                            <label> Vendor Name </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="username" placeholder="Enter Vendor Name">
                                            </div>
                                            <div class="form-group">
                                            <label> Vendor Email </label>
                                            <input type="email" class="form-control form-control-user"
                                                name="email" placeholder="Enter Vendor Email">
                                            </div>
                                            <div class="form-group">
                                            <label> Vendor Password </label>
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Enter Vendor Password">
                                            </div>
                                        
                                            <div class="form-group">
                                            <label> Mobile Number </label>
                                            <input type="number" class="form-control"
                                                name="mobile" placeholder="Enter Mobile Number">
                                            </div>
                                            
                                            <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-user" name="status" id="status" required>
                                                <option value='' selected>Activity</option>
                                                <option value="1">Active</option>
                                                <option value="0">Unactive</option>
                                                
                                            </select>
                                        </div>
                                 
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                          
                                        
                                       
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
    align-content: center;
    color: red;
    
    padding: 9px;
}
.form-group{
    color:black;
}

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>