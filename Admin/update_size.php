<?php
   require('security.php');
   isAdmin();
    $size='';
    $id='';
?>
   <?php
                    if(isset($_GET['id']) && $_GET['id']!=' ') // checking if id is from URL and the Id is not NULL
                    {
                          $id=$_GET['id'];
                          $query=mysqli_query($conn,"select * from size_master where id=$id");
                    if($query){
                         $row=mysqli_fetch_assoc($query);
                         $size=$row['size'];
                         $order_by=$row['order_by'];
                     }
                  
                  } 
                  
   
                  
                       if(isset($_POST['update']))
                    {
                        
                          $cat=get_safe_value($conn,$_POST['size']);
                          $order_by=get_safe_value($conn,$_POST['order_by']);
                      
                           if(empty($cat) || empty($id) || empty($order_by))
                           {
                            header('Location:size.php?EmptyFeilds') ;
                            die(); 
                           }
                           else{
                                $result=mysqli_query($conn,"SELECT * FROM `size_master` WHERE size='$cat' and order_by='$order_by'");
                                if(mysqli_num_rows($result)>0)
                                {
                                    header('location:update_size.php');
                                    die();
                                }
                                else{
                                      $sql="update  size_master set size='$cat',order_by='$order_by' where id=$id";
                                      mysqli_query($conn,$sql);
                                      header('location:size.php') ;
                                      die(); 
                                }

                           }
                   
                }
                require('includes/header.php');
                require('includes/navbar.php');
                require('includes/topbar.php');

   ?>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form  method="post">
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
                                    <h1 class="h4 text-gray-900 mb-4">Update size</h1>
                                    </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="size" 
                                                value="<?php echo $size ?>" >
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user"
                                                name="order_by" 
                                                value="<?php echo $order_by ?>" >
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user"
                                                name="id" 
                                                value="<?php echo   $id?>" >
                                        </div>
                                    

                                        <button type="submit" class="btn btn-primary btn-user btn-block"  name="update">UPDATE</button> 
                                            
                                        
                                       
                                         <!-- <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div>  -->
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

   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>


<?php
                                    
                
                          