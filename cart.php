<?php
require('includes/header.php');
require('includes/topbar.php');
    //prx($_SESSION['cart']);
    //unset($_SESSION['cart']);
///echo $_SESSION['cart']['18']['qty'];  // trying to access the $_SESSION-cart-array_id=18-qty=
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
                                  <span class="breadcrumb-item active">Cart</span>
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
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                          
                                                            
                               <?php
                               $var=0;
                               
                                    if(isset($_SESSION['cart']))
                                    {
                                        foreach($_SESSION['cart'] as $key=>$val){
                                 
                                            foreach($val as $key1=>$val1){

                                                $r=mysqli_fetch_assoc(mysqli_query($conn,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
                                                left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
                                                left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
                                                where product_attributes.id='$key1'"));
                                                

                                            $productArr=getproduct($conn,'','',$key,'','','','',$key1);
                                                $pname=$productArr[0]['name'];
                                                $mrp=$productArr[0]['mrp'];
                                                $price=$productArr[0]['price'];
                                                $image=$productArr[0]['image'];
                                                $qty=$val1['qty'];
                                                
                                    
                                
                                ?>

                                    <tr>
                                            <td class="product-thumbnail"><a href="product_details.php"><img src="Admin/image/<?php echo $image ?>"/></a></td>
                                            <td class="product-name"><a href="#"><?php echo $pname; ?></a>
                                             <?
                                            if(isset($r['color']) && $r['color']!=''){
                                                echo "</br>".$r['color']."</br>";
                                            }
                                            if(isset($r['size']) && $r['size']!=''){
                                                echo "</br>".$r['size']."</br>";
                                            }
                                            ?>   
                                            
                                            <ul  class="pro__prize">
                                                    <li class="old__prize"><?php  echo $mrp ?></li>
                                                    <li><?php echo $price ?></li>
                                                </ul>
                                                <?php 
                                                 $var=1;
                                                 ?>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $price ?></span></td>
                                            <td class="product-price"><span class="amount" ><?php echo $qty ?></span></td> 
                                             <input type="hidden" id="qty" value="<? echo $qty ?>">
                                            <td class="product-subtotal"><?php echo $price*$qty ?></td>
                                            <td class="product-remove"><a href="javascript:void(0)"  onclick="manage_cart_update('<?php echo $key ?>','remove','<? echo $r['size_id'] ?>','<? echo $r['color_id'] ?>')"><i class="icon-trash icons"></i></a></td>
                                        </tr>

                            <?php
                                           }   }  }
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
    <input type="hidden" id="cid">
    <input type="hidden" id="sid">
        <?php

            include('includes/footer.php');

?>
<script>

function manage_cart_update(pid,type,size_id,color_id){
    jQuery('#sid').val(size_id);
    jQuery('#cid').val(color_id);
    manage_cart(pid,type);
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
    
    if(type!='remove'){
    
    if(isColor!=0 && cid==''){
        jQuery('#cartMessage').html('Please Select Color');
        isError='yes';
    }
    if(isSize!=0 && sid=='' && isError==''){
        jQuery('#cartMessage').html('Please Select Size');
        isError='yes';
    }
        
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
     
     </script>