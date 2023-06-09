<?php
   require('security.php');
   isAdmin();
$color='';
$id='';
?>
   <?php
                      if(isset($_GET['id']) && $_GET['id']!=' ') // checking if id is from URL and the Id is not NULL
                      {
                          $id=$_GET['id'];
                     $query=mysqli_query($conn,"select * from color_master where id=$id");
                     if($query){
                         $row=mysqli_fetch_assoc($query);
                         $color=$row['color'];
                         
                     }
                  
                  } 
                  
   
                  
                       if(isset($_POST['update']))
                    {
                          $cat=$_POST['color'];
                         if(isset($_GET['id']) && $_GET['id']!='')
                         {
                         echo $id;
                           if(empty($cat) || empty($id))
                           {
                            header('Location:color.php?EmptyFeilds') ;
                            die(); 
                           }
                           else{
                            
                                $result=mysqli_query($conn,"SELECT * FROM `color_master` WHERE color='$cat'");
                                if(mysqli_num_rows($result)>0)
                                {
                                    header("location:update_color.php?id='$id'");
                                    die();
                                }
                                else{
                                    $sql="update  color_master set color='$cat' where id=$id";
                                    mysqli_query($conn,$sql);
                                   
                                    header('location:color.php') ;
                                     die(); 
     
                                }

                           }
                    }
                }
                require('includes/header.php');
   require('includes/navbar.php');
   require('includes/topbar.php');

   ?>


   
<?php

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

                                    

                                    <h1 class="h4 text-gray-900 mb-4">Update color</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="color" 
                                                value="<?php echo $color ?>" >
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
                                    
                
                          