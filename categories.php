
  <?php
require('includes/header.php');
require('includes/topbar.php');


if(!isset($_GET['id']) && $_GET['id']!=''){
    ?>
    <script>
        window.location.href='index.php';
    </script>

    <?php
}

$sort_order='';

$price_high_selected="";
$price_low_selected="";
$new_selected="";
$old_selected="";
$cat_name='';
    
    $cat_id=get_safe_value($conn,$_GET['id']);
    $sub_cat_id='';
    if(isset($_GET['sub_categories'])){
        $sub_cat_id=get_safe_value($conn,$_GET['sub_categories']);
    }

if(isset($_GET['sort'])){
    $sort=get_safe_value($conn,$_GET['sort']);
    if($sort=="price_high"){
        $sort_order="order by product.price desc";         
        $price_high_selected="selected";

    }
    if($sort=="price_low"){
        $sort_order="order by product.price asc"; 
        $price_low_selected="selected";         
    }
    if($sort=="new"){
        $sort_order="order by product.id desc";  
        $new_selected="selected";       
    }
     if($sort=="old"){
        $sort_order="order by product.id asc ";
        $old_selected="selected";         
    }
}



$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] ;
$url=$url."/PHP/categories.php?"; // Outputs:  URL

    if($cat_id>0)
    {
        $get_product=getproduct($conn,'',$cat_id,'','',$sort_order,'',$sub_cat_id);
        foreach($get_product as $row){
        $prod_id=$row['id'];
        }
        
        $sql=mysqli_query($conn,"select *,categories.categories as cname from categories,product where categories.id=product.categories_id");
        while($row=mysqli_fetch_assoc($sql)){
            $cat_name=$row['cname'];
        }

    }else{
    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
}

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
                                  <a class="breadcrumb-item" href="index.html"><strong>Home</strong></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">
                                  <strong> <?php echo $cat_name; ?></span> </strong>  
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
if(count($get_product)>0)
{

    
               ?>
               
                <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id ?>','<?php echo $url ?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_high_selected ?>>Sort by price low to high</option>
                                        <option value="price_high"<?php echo $price_low_selected ?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected ?>>Sort by new first</option>
                                        <option value="old" <?php echo $old_selected ?>>Sort by old first</option>
                                    </select>
                                </div>
                                
                            </div>
                           
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                             <!-- Start Single Category -->
                             <?php
                                
                               foreach($get_product as $list)
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
            
function sort_product_drop(cat_id,site_path){
    var sort_id=jQuery('#sort_product_id').val();
    window.location.href=site_path+"&id="+cat_id+"&sort="+sort_id;
}
        </script>

        <!-- <?php
        $sql=mysqli_query($conn,"select *,product.name as pname from product");
        while($row=mysqli_fetch_assoc($sql)){
            echo $name=$row['pname'];
        }
        ?> -->
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
			}
            if(result=='not available'){
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