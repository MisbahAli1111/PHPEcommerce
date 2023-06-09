

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Base</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php
                if($_SESSION['ADMIN_ROLE']!='1'){

                
            ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php  } ?>
           
            <li class="nav-item active">
                <a class="nav-link" href="Products.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Product </span></a>
            </li>
             
            
            <?php if($_SESSION['ADMIN_ROLE']!='1'){
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="order_master.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Order Master</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="Users.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>User Master</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="banner.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Banner</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="review.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Review</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Categories</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="sub_categories.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Sub Categories Master</span></a>
            </li>
           
            <li class="nav-item active">
                <a class="nav-link" href="coupon_master.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Coupon Master</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="contactUs.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Contact Us </span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="vendor.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Vendor Management</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="color.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Color Master</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="size.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Size Master</span></a>
            </li>
            <?php
                 }else{
                        ?>
                <li class="nav-item active">
                <a class="nav-link" href="order_master_vendor.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Order Master</span></a>
            </li>

                    <?php

                 }
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
           
            <!-- Nav Item - Pages Collapse Menu -->
            

            <!-- Nav Item - Utilities Collapse Menu -->
        

            <!-- Divider -->

            <!-- Sidebar Message -->
           
        </ul>
        <!-- End of Sidebar -->

            
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    
                    <button class="btn btn-secondary" type="button"  data-dismiss="modal">Cancel</button>
                    <form action="login.php" method="post">
                    <button  type="submit" name="logout_btn" class="btn btn-primary"  >Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

