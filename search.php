
  <?php
require('includes/header.php');
require('includes/topbar.php');
$str=get_safe_value($conn,$_GET['str']);


if($str!='')
{
    $get_str=getproduct($conn,'','','',$str);
}else{
    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
}

if(count($get_str)>0)
                {
  ?>
  
  <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php"><strong>Home</strong></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">
                                  <strong> Products ></span> </strong>
                                  <span class="breadcrumb-item active">
                                  <strong> <?php echo $str ?></span> </strong>  
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
               <?php
                
    
               ?>
               
                <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                           
                           
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                             <!-- Start Single Category -->
                             <?php
                                
                               foreach($get_str as $list)
                               {
                            ?>  
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product_details.php?id=<?php  echo $list['id']; ?>">
                                            <img src="Admin/image/<?php echo $list['image'] ?>" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><?php echo $list['name'] ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><?php echo '$'.$list['mrp'] ?></li>
                                            <li><?php echo '$'.$list['price'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                   
                            <!-- End Single Category -->
                            <?php
                            }
                            ?>
                      
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- End Product View -->
                        </div>
                        
                    </div>
                    
                
                
                    <?php
                }
                else{
                    echo "Data Not found";
                }
                ?>
                
                </div>
                
            </div>
        </section>
        
        <!-- End Product Grid -->
        <!-- Start Brand Area -->
        
        <!-- End Brand Area -->
        <!-- Start Banner Area -->
        <div class="htc__banner__area">
            <ul class="banner__list owl-carousel owl-theme clearfix">
                <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/3.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/4.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/5.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/6.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
            </ul>
        </div>
        <!-- End Banner Area -->
        <!-- End Banner Area -->

        <?php
    include('includes/footer.php');
        ?>
                  <script>
      function manage_cart(pid,type){
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href='cart.php';
			}
			jQuery('.htc__qua').html(result);
		}	
	});	
}

    function wishlist_manage(pid,type){
        jQuery.ajax({
		url:'wishlist_manage.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			if(result=='notlogin'){
				window.location.href='login.php';
			}
            else{
                jQuery('.htc__wishlist').html(result);

            }
		}	
	});	
    }
       </script>