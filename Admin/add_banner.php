<?php
   include('security.php');

   
   isAdmin();
   $msg='';
   
   ?>

   <?php


    if(isset($_POST['add_btn']))
    {
       
        $h1=get_safe_value($conn,$_POST['heading1']);
        $h2=get_safe_value($conn,$_POST['heading2']);
        $btn_link=get_safe_value($conn,$_POST['btn_link']);
        $status=get_safe_value($conn,$_POST['status']);
        $btn_text='';

        if(empty($image) && empty($h1) && empty($h2) && empty($btn_link))
        {
         $msg="Empty Feilds";
         header("Location:add_banner.php?EmptyFeilds&msg=$msg") ;
         exit(); 
        }
        if($_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/jpg'  &&  $_FILES['image']['type']!= 'image/png')
        {
            $msg="Please select  jpeg , png or jpg images";
            header("Location:add_banner.php?Error&msg=$msg") ;
            exit(); 
               
        }
        
       
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
         move_uploaded_file($_FILES['image']['tmp_name'],'Banner_images/'.$image);
     
        $sql="insert into banner(heading1,heading2,btn_text,btn_link,image,status) values('$h1','$h2','$btn_text','$btn_link','$image','$status')";
        mysqli_query($conn,$sql);
        header('Location:banner.php?bannerEntered');
        
    }


    


    include('includes/header.php');
    include('includes/navbar.php');
    include('includes/topbar.php');
   ?>
   <?php
    if(isset($_GET['msg']) && $_GET['msg']!=''){
        $msg=get_safe_value($conn,$_GET['msg']);
    }
    ?>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form method="post" enctype="multipart/form-data">
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

                              
                                    <h1 class="h4 text-gray-900 mb-4">Add banner</h1>
                                    </div>
                                    <form class="user">
                                    <div class="form-group">
                     
                                    <div class="feild_error"><?php echo $msg; ?></div>
                                    </div>
                                    <div class="form-group">
                                    <label for=""><strong>Heading 1</strong></label>    
                                    <input type="text" class="form-control form-control-user"
                                                name="heading1" placeholder="Heading1">
                                        </div>
                                        <div class="form-group">
                                        <label for=""><strong>Heading 2</strong></label>
                                        
                                        <input type="text" class="form-control form-control-user"
                                                name="heading2" placeholder="Heading2">
                                                
                                        </div><div class="form-group">
                                            <label for=""><strong>Image</strong></label>
                                            <input type="file" class="form-control form-control-user"
                                                name="image" placeholder="image">
                                           
                                        </div><div class="form-group">
                                        <label for=""><strong>Btn_link</strong></label>
                                            <input type="btn_link" class="form-control form-control-user"
                                                name="btn_link" placeholder="link">
                                        </div>   
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-user" name="status" id="status" required>
                                                <option value='' selected>Validity</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                
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
    color: red;
    font-weight: 700;
    
}

</style>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>