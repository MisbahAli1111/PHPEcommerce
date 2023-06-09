<?php
   require('security.php');
   isAdmin();
$banner='';
$msg='';
$id='';
?>
   <?php
                      if(isset($_GET['id']) && $_GET['id']!=' ') // checking if id is from URL and the Id is not NULL
                      {
                          $id=$_GET['id'];
                     $query=mysqli_query($conn,"select * from banner where id=$id");
                     if($query){
                         $row=mysqli_fetch_assoc($query);
                         $heading1=$row['heading1'];
                         $heading2=$row['heading2'];
                         $btn_link=$row['btn_link'];
                         $image=$row['image'];
                      }
                  
                  } 
                  
   
                  
                       if(isset($_POST['update']))
                    {
                        
                          $heading1=get_safe_value($conn,$_POST['heading1']);
                          $heading2=get_safe_value($conn,$_POST['heading2']);
                          $btn_link=get_safe_value($conn,$_POST['btn_link']);
                          
                           
                           if($_FILES['image']['name']!='' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/png'){
                            $msg='Please select png,jpg or jpeg images';             
                           }
                           else{
                            if($_FILES['image']['name']!=NULL){
                            
                                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                                move_uploaded_file($_FILES['image']['tmp_name'],'Banner_images/'.$image);
                                $sql="update `banner` set heading1='$heading1',heading2='$heading2',btn_link='$btn_link',image='$image' where id='$id'";
                            }else{
                                $sql="update `banner` set heading1='$heading1',heading2='$heading2',btn_link='$btn_link' where id='$id'";
                            }
                           
                                 mysqli_query($conn,$sql);
                                   
                                    header('location:banner.php') ;
                                      
     
                               

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

<form  method="post" enctype="multipart/form-data">
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
                                    <h1 class="h4 text-gray-900 mb-4">Update banner</h1>
                                    </div>
                                    <form class="user" enctype="multipart/form-data">
                                    <div class="feild_error"><?php echo $msg; ?></div>
                             
                                    <div class="form-group">
                                            <label for="">Heading1</label>
                                            <input type="text" class="form-control form-control-user"
                                                name="heading1" 
                                                value="<?php echo $heading1 ?>" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="">Heading2</label>
                                            <input type="text" class="form-control form-control-user"
                                                name="heading2" 
                                                value="<?php echo $heading2 ?>" required>
                                        </div><div class="form-group">
                                        <label for="">btn_link</label>
                                            <input type="text" class="form-control form-control-user"
                                                name="btn_link" 
                                                value="<?php echo $btn_link ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control form-control-user"
                                                name="image">
                                                <br>
                                              <?php  if($image!=''){
                                                echo "<a target='_blank' href='".'image/'.$image."'><img width='150px' src='".'banner_images/'.$image."'/></a>";
                                                }
                                                ?>
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
<style>
    .feild_error{
    color: red;
    font-weight: 700;
    
}
</style>
</html>

   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>


<?php
                                    
                
                          