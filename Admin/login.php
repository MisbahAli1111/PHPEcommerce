<?php
session_start();
include("includes/database.php");
// $pad=123;
// $hashedPassw=password_hash($pad,PASSWORD_DEFAULT);
// echo $hashedPassw;
?>


 <?php
//session_start();
if(isset($_POST['logout_btn']))
{
    
    session_destroy();
    unset($_SESSION['username']);
}
?> 

  
  <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="logout.php" method="post">
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
                                                                
<?php

if(isset($_SESSION['status']) && $_SESSION['status']!='')
{

    echo '<h2 class="card-title bg-danger text-white"> '.$_SESSION['status'].'</h2>';
    unset($_SESSION['status']);
}

?>

                                        <h1 class="h4 text-gray-900 mb-4">Log In!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="name" class="form-control form-control-user"
                                                name="name" aria-describedby="emailHelp"
                                                placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> -->
                                        </div>
                                        <button type="login" class="btn btn-primary btn-user btn-block" name="login_btn">Login</button> 
                                            
                                        
                                       
                                        <!-- <div class="text-center">
                                            <a class="small" href="register.html">Create an Account!</a>
                                        </div> -->
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