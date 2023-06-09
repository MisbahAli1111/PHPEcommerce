<?php
include('vendor/autoload.php');
require('includes/database.php');
require('functions.php');
    if(!isset($_SESSION['ADMIN_USER'])){
        if(!isset($_SESSION['USER_ID'])){
            die();
        }
    }
    

$order_id=$_GET['id'];
$query=mysqli_query($conn,"select coupon_value from `order` where id='$order_id'");
$coupon_details=mysqli_fetch_assoc($query);
if($query){
    $coupon_value=$coupon_details['coupon_value'];
}else{
    $coupon_value=0;
}
$css=file_get_contents('css/bootstrap.min.css');
$css.=file_get_contents('style.css');



$html='


<div class="wishlist-area ptb--100 bg__white">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="wishlist-content">
                <form action="#">
                    <div class="wishlist-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Product Name</th>
                                    <th class="product-thumbnail">Product Image</th>
                                    
                                    <th class="product-name"><span class="nobr">Qty</span></th>
                                    <th class="product-price"><span class="nobr"> Price </span></th>
                                    <th class="product-price"><span class="nobr"> Total Price </span></th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
                            
                            $total_price=0;
                            if($_SESSION['ADMIN_USER']){
                                $query=mysqli_query($conn,"select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order` where order_detail.order_id='$order_id' and order_detail.product_id=product.id");
                                    
                            }else{
                                $user_id=$_SESSION['USER_ID'];
                                $query=mysqli_query($conn,"select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order` where order_detail.order_id='$order_id' and `order`.user_id='$user_id' and order_detail.product_id=product.id");
                               
                            }
                            if(mysqli_num_rows($query)==0){
                                die();
                            }
                            while($row=mysqli_fetch_assoc($query))
                            {
                            $total_price=$total_price+($row['price']*$row['qty']);
                                            
                            $html.='<tr>
                                   <td class="product-name">'.$row['name'].'</td>
                                    <td class="product-image"><img src="Admin/image/'.$row['image'].'" alt="image"></td>
                                    <td class="product-name">'.$row['qty'].'</td>
                                    <td class="product-name">'.$row['price'].'</td>
                                    <td class="product-name">'.$total_price.'</td>
                                    
                                </tr>';
                             }
                             if($coupon_value!=''){
                             $html.='
                             <tr>
                             <td colspan="3"></td>
                             <td class="product-name">Coupon Value</td>
                             <td class="product-name">'.$coupon_value.'</td>
                             </tr>';
                             }
                             else{
                                $coupon_value=0;
                            } 
                
                            $total_price=$total_price-$coupon_value;
                            $html.='
                                    
                            
                                    <tr>
                                    <td colspan="3"></td>
                                    <td class="product-name">Total Price</td>
                                    <td class="product-name">'.$total_price.'</td>
                                    
                                </tr>
                            </tbody>
                           
                        </table>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
</div>';

$mpdf=new \Mpdf\Mpdf();
$css=file_get_contents('css/bootstrap.min.css');
$css.=file_get_contents('style.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$file=time().'.pdf';
$mpdf->Output($file,'D');    

include('includes/header.php');
?>


 <link rel="stylesheet" href="css/bootstrap.min.css">
 