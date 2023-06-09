   <?php
   include('security.php');
   include('includes/header.php');
   include('includes/navbar.php');
   include('includes/topbar.php');

   isAdmin(); 
   ?>
   
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><strong>Dashboard</strong></h1>
                       </div>


                    <?php

if(isset($_SESSION['success']) && $_SESSION['success']!='')
{

    echo '<h2 class="card-title bg-primary text-white"> '.$_SESSION['success'].'</h2>';
    unset($_SESSION['success']);
}

                    ?>

                    <!-- Content Row -->
                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                             Total Admins</div>
                                               <?php
                                            $query=mysqli_query($conn,"select * from admin_users");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            
                                            ?>
                                               <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $num; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                             Total User Customers</div>
                                               <?php
                                            $query=mysqli_query($conn,"select * from users");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            
                                            ?>
                                               <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $num; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Categories </div>
                                              <?php
                                                $query=mysqli_query($conn,"select * from categories");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num ?></div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                            <?php
                                            $query=mysqli_query($conn,"select * from product");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            ?>                                            
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $num ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Orders
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                            <?php
                                            $query=mysqli_query($conn,"select * from `order`");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            ?>                  
                                                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num ?></div>
                                        </div>
                                        
                                            </div>
                                        </div>
                                                                            </div>
                                </div>
                            </div>
                    
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Remaining Deleveries
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                            <?php
                                            $query=mysqli_query($conn,"  select * from `order` where order_status='1'");
                                            $num=0;
                                            While(mysqli_fetch_assoc($query))
                                            {
                                                    $num++;
                                            } 
                                            ?>                                            
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $num ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                    

                    <!-- Content Row -->

                    
                  
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>