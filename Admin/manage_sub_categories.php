<?php
   include('security.php');
isAdmin();
   $msg='';
   $sub_categories='';
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
        
       echo $cat=$_POST['categories_id'];
       echo $sub_cat=$_POST['sub_categories'];
        

        if(empty($cat) || empty($sub_cat))
        {
         header('Location:sub_Categories.php?EmptyFeilds') ;
         exit(); 
        }
        $sql="SELECT * FROM `sub_categories` WHERE categories_id='$cat' and sub_categories='$sub_cat'";
    
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0) 
        {
            $msg="Sub Categoriy Already Exist";
            header("Location:sub__categories.php?CategoryAlreadyexist");
            exit();
        }
        else{
                
        $sql="insert into sub_categories(categories_id,sub_categories,status) values('$cat','$sub_cat','1')";
        mysqli_query($conn,$sql);
        header('Location:sub_categories.php?CategoriesEntered');
        die();
        }


    }


    include('includes/header.php');
    include('includes/navbar.php');
    include('includes/topbar.php');
   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="manage_sub_categories.php" method="post">
<body class="bg-gradient">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-6 col-lg-12 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
 
                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">

                                    

                                    <h1 class="h4 text-gray-900 mb-4">Add Sub Categories Form</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                          
                                                <select name="categories_id" class="form-control" required>
                                                        <option value="">Select Categories</option>
                                                        <?php
                                                            $res=mysqli_query($conn,"select * from categories where status='1'");
                                                            while($row=mysqli_fetch_assoc($res)){
                                                                echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                                
                                                            }
                                                        ?>
                                                </select>
                                             
                                        </div>
                                        <div class="form-group">
                                            <label for="categories" class="form-control-label"><strong>Sub Categories</strong></label>
                                            <input type="text" name="sub_categories" placeholder="Enter Sub Categories" class="form-control" required value="<?php echo $sub_categories; ?>">
                                        </div>
                                        
                                      
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                            <div class="feild_error"><?php echo $msg; ?></div>
                                        
                                       
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

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>