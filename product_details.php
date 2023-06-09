
<?php
ob_start();
require('includes/header.php');
require('includes/topbar.php');
$sizeattr;
$product_id=$_GET['id'];

if($product_id>0)
{
    $get_product=getproduct($conn,'','',$product_id);

}else{
    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
}

$mres=mysqli_query($conn,"select * from product_images where product_id='$product_id'");
$multipleimages=[];
if(mysqli_num_rows($mres)>0){
    while($row=mysqli_fetch_assoc($mres)){
        $multipleimages[]=$row['product_images'];   
    }
}
$sql="select product_attributes.*,color_master.color,size_master.size from product_attributes 
left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
where product_attributes.product_id='$product_id'";
$attrRes=mysqli_query($conn,$sql);

$multipleattr=[];
$colorattr=[];
$sizeattr=[];

if(mysqli_num_rows($attrRes)>0){
    while($row=mysqli_fetch_assoc($attrRes)){
        $multipleattr[]=$row;   
        $colorattr[$row['color_id']][]=$row['color'];   
        $sizeattr[$row['size_id']]=$row['size'];   

        $colorattr1[]=$row['color'];
        $sizeattr1[]=$row['size'];       
    }
}
//print_r($sizeattr);
$isSize=count(array_filter($sizeattr1));
$isColor=count(array_filter($colorattr1));

//prx($multipleattr);
//$colorattr=array_unique($colorattr);
$sizeattr=array_unique($sizeattr);
 //  prx($colorattr);

if(isset($_POST['review_submit'])){
	$rating=get_safe_value($conn,$_POST['rating']);
	$review=get_safe_value($conn,$_POST['review']);
	
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($conn,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','1','$added_on')");
	header('location:product_details.php?id='.$product_id);
	die();
}


//prx($get_product);
?>

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
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
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
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="categories.php?id= <?php echo $get_product['0']['categories_id']; ?>"><?php echo $get_product['0']['categories']; ?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo '$'.$get_product['0']['name']; ?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active imageZoom" id="img-tab-1">
                                        <?php
                                        $pimage=$get_product['0']['image']
                                        ?>
                                         <img  width="" data-origin="Admin/image/<?php echo $get_product['0']['image']?>" src="Admin/image/<?php echo $get_product['0']['image']?>" onclick=showmultipleimages(image.pimage)>
                                 
                                        </div>
                                        
                                        <?php

                                            if(isset($multipleimages[0])){
                                                ?>
                                                <div id="multiple_images">
                                                    <?php
                                                        foreach($multipleimages as $list){
                                                            echo "<img src='".'Admin/product_images/'.$list."' onclick=showmultipleimages('".'Admin/product_images/'.$list."')>";
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <?  $getProductAttr=getProductAttr($conn,$get_product['0']['id']);

                                ?>
                                <h2><?php echo $get_product['0']['name']; ?></h2>  
                                <ul  class="pro__prize">
                                    <li class="old__prize"><?php echo '$'.$get_product['0']['mrp']; ?></li>
                                    <li class="new__price"><?php echo '$'.$get_product['0']['price']; ?></li>
                                </ul>
                                <?php
                                        $cartShow='yes';
                                        $data=ProductSoldQtyByProductId($conn,$get_product['0']['id'],$getProductAttr);
                                      
                                        if($get_product['0']['qty']>ProductSoldQtyByProductId($conn,$get_product['0']['id'],$getProductAttr)){
                                            $stock='In Stock';
                                        }   
                                        else{
                                            $stock='Out of Stock';
                                            $cartShow='';
                                        } 
                                        ?>
                                <p class="pro__info"><?php echo $get_product['0']['short_desc']; ?></p>
                                
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <? if($isColor==0 && $isSize==0){ ?>
                                        <p><span>Availability:</span>
                                        
                                      <strong>  <?php echo $stock;  ?></p> </strong>
                                    </div>
                                    <?} ?>
                                <?php
                                 $qtysol=ProductSoldQtyByProductId($conn,$get_product['0']['id'],$getProductAttr);
                                  $totalqty=ProductQty($conn,$get_product['0']['id'],$getProductAttr);
                                
                                 $remqty=$totalqty-$qtysol;

                                	$cart="hide";
									if($isColor==0 && $isSize==0){
										$cart="";
                                    }
									$isQtyHide="hide";
									if($isColor==0 && $isSize==0){
										$isQtyHide="";
									}
									
                                if($cartShow!=''){
                                    ?>
                                    <div class="sin__desc align--left <? echo $isQtyHide?>" id="cart_qty">
                                        <p><span>Qty</span>
                                        <select id="qty">
                                    <?php
                                   
                                    for($x=1;$x<=$remqty;$x++){

                                ?>   
                                            <option><?php echo $x ?></option>
                                     <?php } ?>
                                        </select></p>
                                    </div>
                                    <?php
                                    
                                }
                                    ?>


                                <?php if($isColor>0){?>
									<div class="sin__desc align--left">
										<p><span>color:</span></p>
										<ul class="pro__color">
											<?php 
											foreach($colorattr as $key=>$val){
												echo "<li style='background:".$val[0]." none repeat scroll 0 0'><a href='javascript:void(0)' onclick=loadAttr('".$key."','".$get_product['0']['id']."','color')>".$val[0]."</a></li>";
											}
											?>
											
										</ul>
									</div>
									<?php } ?>
									
									<?php if($isSize>0){?>
									<div class="sin__desc align--left">
										<p><span>size</span></p>
										<select class="select__size" id="size_attr" onchange="showQty()">
											<option value="">Size</option>
											<?php 
											foreach($sizeattr as $key=>$val){
												echo "<option value='".$key."'>".$val[0]."</option>";
											}
                                            

											?>
                                        
											
										</select>
									</div>
									<?php } ?>
                                    
                                  <div id="cartMessage">
                                    
                                  </div>
                                  
                                  <!-- <?php
									$isQtyHide="hide";
									if($iscolor==0 && $issize==0){
										$isQtyHide="";
									}
									?> -->

                                  
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                        <script src="js/main.js"></script>
                                            <li><a href=""><strong><?php echo $get_product['0']['categories']; ?></a></strong></li>
                                        </ul>
                                    </div>
                                    <div id="cart" class="<?php echo $cart?>">
                                    <a class="fr__btn" href="javascript:void(0)" onclick="manage_cart(<?php echo $get_product['0']['id'] ?>,'add')">ADD TO CART</a>
                               
                                    <a class="fr__btnn" href="javascript:void(0)" onclick="manage_cart(<?php echo $get_product['0']['id'] ?>,'add','yes')">BUY NOW!</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <input type="hidden" id="cid">
        <input type="hidden" id="sid">
        

        <!-- End Product Details Area -->
        <!-- Start Product Description -->
            <!-- End Product Details Area -->
        <!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
							<li role="presentation" class="review"><a href="#review" role="tab" data-toggle="tab" class="active show" aria-selected="true">review</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $get_product['0']['description']?>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <?php
                 $product_review_res=mysqli_query($conn,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on desc");

        ?>
        
                            
							<div role="tabpanel" id="review" class="pro__single__content tab-pane fade active show">
                                <div class="pro__tab__content__inner">
                                    <?php 
									if(mysqli_num_rows($product_review_res)>0){
									
									while($product_review_row=mysqli_fetch_assoc($product_review_res)){
									?>
									
									<article class="row">
										<div class="col-md-12 col-sm-12">
										  <div class="panel panel-default arrow left">
											<div class="panel-body">
											  <header class="text-left">
												<div><span class="comment-rating"> <?php echo $product_review_row['rating']?></span> (<?php echo $product_review_row['name']?>)</div>
												<time class="comment-date"> 
                                            <?php
                                            $added_on=strtotime($product_review_row['added_on']);
                                            echo date('d M Y',$added_on);
                                            ?>
												
												
												
												</time>
											  </header>
											  <div class="comment-post">
												<p>
												  <?php echo $product_review_row['review']?>
												</p>
											  </div>
											</div>
										  </div>
										</div>
									</article>
									<?php } }else { 
										echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
									}
									?>
									
									
                                    <h3 class="review_heading">Enter your review</h3><br/>
									<?php
									if(isset($_SESSION['USER_LOGIN'])){
									?>
									<div class="row" id="post-review-box" style=>
									   <div class="col-md-12">
										  <form action="" method="post">
											 <select class="form-control" name="rating" required>
												  <option value="">Select Rating</option>
												  <option>Worst</option>
												  <option>Bad</option>
												  <option>Good</option>
												  <option>Very Good</option>
												  <option>Fantastic</option>
											 </select>	<br/>
											 <textarea class="form-control" cols="50" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>
											 <div class="text-right mt10">
												<button class="btn btn-success btn-lg" type="submit" name="review_submit">Submit</button>
											 </div>
										  </form>
									   </div>
									</div>
									<?php } else {
										echo "<span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review</span>";
									}
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Description -->
        <!-- Start Product Area -->
              
        <!-- End Product Description -->
        <!-- Start Product Area -->
              
    
     
        <!-- End Product Description -->
        <!-- Start Product Area -->
        <?php
		//unset($_COOKIE['recently_viewed']);
		if(isset($_COOKIE['recently_viewed'])){
			$arrRecentView=unserialize($_COOKIE['recently_viewed']);
			$countRecentView=count($arrRecentView);
			$countStartRecentView=$countRecentView-4;
			if($countStartRecentView>4){
				$arrRecentView=array_slice($arrRecentView,$countStartRecentView,4);
			}
			$recentViewId=implode(",",$arrRecentView);
			$res=mysqli_query($conn,"select * from product where id IN ($recentViewId) and status=1");
			
		?>
		<section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 style="font-size: 20px;font-weight: bold;">Recently Viewed</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <div class="row">
								<?php while($list=mysqli_fetch_assoc($res)){?>
								<div class="col-xs-3">
									<div class="category">
												<div class="ht__cat__thumb">
													<a href="product.php?id=<?php echo $list['id']?>">
														<img src="Admin/image/<?php echo $list['image']?>" alt="product images">
													</a>
												</div>
												<div class="fr__hover__info">
													<ul class="product__action">
														<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
														<li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="icon-handbag icons"></i></a></li>
													</ul>
												</div>
												<div class="fr__product__inner">
													<h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
													<ul class="fr__pro__prize">
														<li class="old__prize"><?php echo $list['mrp']?></li>
														<li class="new__price"><?php echo $list['price']?></li>
													</ul>
												</div>
											</div>
										
								</div>
								<?php } ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php 
			$arrRec=unserialize($_COOKIE['recently_viewed']);
			if(($key=array_search($product_id,$arrRec))!==false){
				unset($arrRec[$key]);
			}
			$arrRec[]=$product_id;
		}else{
			$arrRec[]=$product_id;
		}
		setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);
		?>
        <!-- End Product Area -->
        <!-- End Banner Area -->

        
       <script>
        
        
        function showmultipleimages(im){
            alert(im);

            jQuery('#img-tab-1').html("<img src='"+im+"' data-origin='"+im+"'/>");
				jQuery('.imageZoom').imgZoom();
			}
      function manage_cart(pid,type,is_checkout){
        isError='';
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
    let sid=jQuery('#sid').val();
    let cid=jQuery('#cid').val();
    
    
    if(isColor!=0 && cid==''){
        jQuery('#cartMessage').html('Please Select Color');
        isError='yes';
    }
    if(isSize!=0 && sid=='' && isError==''){
        jQuery('#cartMessage').html('Please Select Size');
        isError='yes';
    }
    if(isError==''){
    jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type+'&cid='+cid+'&sid='+sid,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href='cart.php';
			}if(result=='not available'){
                alert('Quantity not available')
            }else{
                jQuery('.htc__qua').html(result);
                if(is_checkout=='yes'){
                    window.location.href='checkout.php';
                }

            }
			
		}	
	});	
  }
}

function showQty(){
            let cid=jQuery('#cid').val();
            if(cid=='' && isColor>0){
                jQuery('#cartMessage').html('Please select color');
            }else{
                let sid=jQuery('#size_attr').val();
                jQuery('#sid').val(sid);
                getAttrDetails(pid);
                jQuery('#cartMessage').html('');
                jQuery('#cart_qty').removeClass('hide');
            }
        }

    function getAttrDetails(pid){
    let color=jQuery('#cid').val();
	let size=jQuery('#sid').val();
        jQuery('#cart').addClass('hide');
	    jQuery('#cart_qty').hide();
	
	jQuery.ajax({
		url:'getAttrDetails.php',
		type:'post',
		data:'pid='+pid+'&color='+color+'&size='+size,
		success:function(result){
			result=jQuery.parseJSON(result);
			jQuery('.old__prize').html(result.mrp);
			jQuery('.new__price').html(result.price);
			var qty=result.qty;
			
			if(qty>0){
				var html='';
				for(i=1;i<=qty;i++){
					html=html+"<option>"+i+"</option>";
				}
				jQuery('#cart_qty').show();
				jQuery('#qty').html(html);
				jQuery('#cart').removeClass('hide');
				jQuery('#cartMessage').html('');
				jQuery('#cart_qty').removeClass('hide');
			}else{
				jQuery('#cartMessage').html('Out of stock');
			}
		}
	});
    }

    function loadAttr(cs_id,product_id,type){
        jQuery('#cart_qty').addClass('hide');
        jQuery('#cart').addClass('hide');
        jQuery('#cid').val(cs_id);
                
        if(isSize==0){
            jQuery('#cartMessage').html('');
            jQuery('#cart_qty').removeClass('hide');
            getAttrDetails(pid);
        }else{
            jQuery.ajax({
            url : 'load_attr.php',
            type : 'post',
            data : 'cs_id='+cs_id+'&product_id='+product_id+'&type='+type,
            success:function(result){
                jQuery('#size_attr').html("<option value=''>Size</option>"+result)
            }
        });
        }
    }
        let isSize='<? echo $isSize ?>';
        let isColor='<? echo $isColor ?>';
        let pid='<?echo $product_id?>';
    
       </script>
        <style>
            .submit_review_hint{
                font-size: 16px;
                color:#c43b68;
            }
            .fr__btn {
            background: #c43b68 none repeat scroll 0 0;
            color: #fff;
            display: inline-block;
            font-family: Poppins;
            font-size: 15px;
            height: 50px;
            line-height: 50px;
            padding: 0 36px;
            transition: 0.3s;
            margin: 1px;
        }
            .pro__colo {
            display: flex; /* add this line */
            flex-wrap: wrap;
            }

            .pro__colo li a{
           display: inline-block;
            height: 20px;
            text-indent: -999999px;
            width: 20px;
            display: flex;
        }
        .pro__colo li a:active {
  border: 20px solid #000 !important;
}
   

           .fr__btnn {
            background: #337ab7 none repeat scroll 0 0;
            color: #fff;
            display: inline-block;
            font-family: Poppins;
            font-size: 15px;
            height: 50px;
            line-height: 50px;
            padding: 0 36px;
            transition: 0.3s;
            margin: 3px;
        }
        #multiple_images img{
            width: 15%;
        }
        #multiple_images{
            margin-top: 10px;
        }
        #cartMessage{
            color:red;
            margin-top: 18px;
            font-size: 27px;
        }
        </style>
       

     
<?php
    

    require('includes/footer.php');
    ob_flush();
?>