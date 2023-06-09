
<?php
include('includes/header.php');
include('includes/topbar.php');
$resBanner=mysqli_query($conn,"select * from banner where status='1'");

?> 
        <div class="body__overlay"></div>
        <?php if(mysqli_num_rows($resBanner)>0){?>
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <?php while($rowBanner=mysqli_fetch_assoc($resBanner)){?>
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2><?php echo $rowBanner['heading1']?></h2>
                                        <h1><?php echo $rowBanner['heading2']?></h1>
										
										<?php
										if($rowBanner['btn_txt'] !='' && $rowBanner['btn_link']!=''){
											?>
											<div class="cr__btn">
												<a href="<?php echo $rowBanner['btn_link']?>"><?php echo $rowBanner['btn_txt']?></a>
											</div>
											<?php
										}
										?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                <td><img src="images/bg/<?php echo $rowBanner['image'] ?>" width="500" height="500"></td>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>
            </div>
        </div>
        <!-- Start Slider Area -->
		<?php } ?>
        <!-- Start Slider Area -->
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>Design Creates Culture. Culture creates values. Values Determines the futture.    </p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <!-- Start Single Category -->
                            <?php
                                $get_product=getproduct($conn,4,'','','','','1');
                               foreach($get_product as $list)
                               {
                            ?>  
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product_details.php?id=<?php echo $list['id'] ?>">
                                            <img src="Admin/image/<?php echo $list['image'] ?>" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="product_details.php?id=<? echo $list['id'] ?>"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><a href="product-details.php"><?php echo $list['name'] ?></a></h4>
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
            </div>
        </section>
        <!-- End Category Area -->
        <!-- Start Product Area -->
        <section class="ftr__product__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>Design Creates Culture. Culture creates values. Values Determines the futture.  </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="product__wrap clearfix">
                       
                    <?php
                    $sort_order=" order by product.id desc";
                               $query=getproduct($conn,'8','','','',$sort_order);
                               foreach($query as $list){
                                
                                ?>    
                                
                    <!-- Start Single Category -->
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                <a href="product_details.php?id=<?php echo $list['id'] ?>">
                                    <img src="Admin/image/<?php echo $list['image'] ?>" alt="product images">
                                    </a>
                                </div>
                               
                                <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="product_details.php?id=<? echo $list['id'] ?>"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                <div class="fr__product__inner">
                                <h4><?php echo $list['name'] ?></a></h4>
                                    
                                    <ul class="fr__pro__prize">
                                        <li class="old__prize"><?php echo $list['mrp'] ?></li>
                                        <li><?php echo $list['price'] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Area -->

        <style>
            .cl a img{
                width: 100%;
                height: 100%;   
            }
        </style>
              <script>
      function manage_cart(pid,type){
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
    var qty='1';
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href='cart.php';
			} if(result=='not available'){
                alert('Sorry! The product is out of stock');
            }else{
			jQuery('.htc__qua').html(result);
            }
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

       
       <?php
    include('includes/footer.php');
       ?>