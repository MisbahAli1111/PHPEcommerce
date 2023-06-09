<?php
require('includes/header.php');
require('includes/topbar.php');
    //prx($_SESSION['cart']);
    //unset($_SESSION['cart']);
///echo $_SESSION['cart']['18']['qty'];  // trying to access the $_SESSION-cart-array_id=18-qty=

    if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
            window.location.href='index.php';
        </script>
        <?php
    }
    $uid=$_SESSION['USER_ID'];
    $query=mysqli_query($conn,"select  product.name,product.image,product.price,product.mrp,whishlist.id from product,whishlist where whishlist.product_id=product.id and whishlist.user_id='$uid'");

   
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Wish list</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
<div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                          
                                                            
                               <?php
                               $var=0;
                                while($row=mysqli_fetch_assoc($query)){
                                        
                                
                                ?>

                                    <tr>
                                            <td class="product-thumbnail"><a href="product_details.php"><img src="Admin/image/<?php echo $row['image'] ?>"/></a></td>
                                            <td class="product-name"><a href="#"><?php echo $row['name'] ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><?php  echo $row['mrp'] ?></li>
                                                    <li><?php echo $row['price'] ?></li>
                                                </ul>
                                                <?php 
                                                 $var=1;
                                                 ?>
                                            </td>
                                            <td class="product-remove"><a href="wishlist.php?wishlist_id=<?php echo $row['id'] ?>"><i class="icon-trash icons"></i></a></td>
                                        </tr>

                            <?php
                                        
                                    }    
                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                            if($var==1){

                            
                            ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            
                                            <a href="checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        }
                        else{
                            echo "Your cart is currently empty";
                                
                            ?>
                           
                            <br>
                            <br>
                             <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                  
                            <?php
                          
                        }
                        ?> 
                    </div>
                </div>
            </div>
        </div>

        <script>
 
       </script>

   


            <?php

            include('includes/footer.php');

?>
<script>
    
     </script>