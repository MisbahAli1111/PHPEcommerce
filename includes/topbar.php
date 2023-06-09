
     <?php
   
    
   $wishListCount=0;
    $query=mysqli_query($conn,"select * from categories where status=1 order by categories asc");
    $cat_array=array();
    while($row=mysqli_fetch_assoc($query))
    {
        $cat_array[]=$row;
    }
    if(isset($_SESSION['USER_LOGIN'])){
        $uid=$_SESSION['USER_ID'];
    
        // if(isset($_GET['wishlist_id'])){
        //     $wid=$_GET['wishlist_id'];
        //      mysqli_query($conn,"delete from whishlist where id='$wid' and user_id='$uid'");
        // }

    //$wishListCount=mysqli_num_rows(mysqli_query($conn,"select  product.name,product.image,product.price,product.mrp,whishlist.id from product,whishlist where whishlist.product_id=product.id and whishlist.user_id='$uid'"));
   
}

    $obj= new add_to_cart();
    $total_product=$obj->totalProduct();

    
?>
     
      <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                    <?php
                                        foreach($cat_array as $list)
                                        {
                                            ?>
                                            <li class="drop"><a href="categories.php?id=<?php  echo $list['id'] ?>"><?php echo $list['categories'] ?></a>  
                                             <?php
                                                $categories_id=$list['id'];
                                                $sql=mysqli_query($conn,"select * from sub_categories where status='1' and categories_id='$categories_id'");
                                                if(mysqli_num_rows($sql)>0){
                                                    ?>
                                                <ul class="dropdown">
                                                    <?php
                                                        while($sub_row=mysqli_fetch_assoc($sql)){
                                                            echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_row['id'].'" >'.$sub_row['sub_categories'].'</a></li>';
                                                        }
                                                        ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                    
                                                ?>
                                            
                                            </li>
                                    <?php   
                                        }
                                    ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                      
                                            <?php
                                        foreach($cat_array as $list)
                                        {
                                            ?>
                                            <li><a href="categories.php?id=<?php  $list['id'] ?>"><?php echo $list['categories'] ?></a></li>    
                                    <?php   
                                        }
                                    ?>
                                      
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href=""><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN']))
                                        {
                                            ?>
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                             <span class="navbar-toggler-icon"></span>
                                           </button>

                                           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                             <ul class="navbar-nav mr-auto">
                                               <li class="nav-item dropdown">
                                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <?php echo $_SESSION['USER_NAME'] ?>
                                                 </a>
                                                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                   <a class="dropdown-item" href="myorder.php">Order</a>
                                                   <a class="dropdown-item" href="profile.php">Profile</a>
                                                   <a class="dropdown-item" href="logout.php">Logout</a>
                                                 </div>
                                               </li>
                                               
                                             </ul>
                                           </div>
                                         </nav>
                                         <?php
                                        }else{
                                            echo '<a href="login.php">Login/Regiter</a>';
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="htc__shopping__cart">
                                          
                                    <?php
                                    if(isset($_SESSION['USER_ID'])){

                                    ?>
                                          <a href="wishlist.php"><i class="icon-heart icons"></i></a>
                                          <a href=""><span class="htc__wishlist"><?php echo $wishListCount ?></span></a>
                                    <?php
                                    }
                                    ?>
                                        <a href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $total_product;  ?></span></a>
                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->

  
  
  <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input name="str" placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <style>
            .htc__shopping__cart a span.htc__wishlist {
                    background: #c43b68;
                    border-radius: 100%;
                    color: #fff;
                    font-size: 9px;
                    height: 17px;
                    line-height: 19px;
                    position: absolute;
                    right: 17px;
                    text-align: center;
                    top: -4px;
                    width: 17px;
                }
        </style>