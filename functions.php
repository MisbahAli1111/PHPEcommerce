<?php



    function prx($arr)
    {
        echo '<pre>';
        print_r($arr);
        die();
    }

function get_safe_value($conn,$str)
{
    if($str!='')
    {
        return strip_tags(mysqli_real_escape_string($conn,$str));
    }
}

function getproduct($conn,$limit='',$cat_id='',$product_id='',$search_str='',$sort_order='',$best_seller='',$sub_categories='',$attr_id=''){
    $sql="select product.*,categories.categories,product_attributes.mrp,product_attributes.price,product_attributes.qty from product,categories,product_attributes where product.status=1 and product.id=product_attributes.product_id";
    if($cat_id!='')
    {
        $sql.=" and product.categories_id = '$cat_id' ";
    }
    if($product_id!='')
    {
        $sql.=" and product.id='$product_id'";
    }
    if($sub_categories!='')
    {
        $sql.=" and product.sub_categories_id='$sub_categories'";
    }
    if($best_seller!='')
    {
        $sql.=" and product.best_seller='1'";
    }
    if($attr_id>0)
    {
        $sql.=" and product_attributes.id=$attr_id";
    }
    $sql.=" and product.categories_id=categories.id "; 
   
    if($search_str!='')
    {
        $sql.=" and (product.name like '%$search_str%' or product.discription like '%$search_str%')";
    }
    $sql.=" group by product.id ";
  
    if($sort_order!='')
    {
        $sql.="$sort_order";
   
    }else{
        $sql.="order by product.id desc";
   
    }
    
    if($limit!='')
    {
        $sql.=" limit $limit";
    }
    $result=mysqli_query($conn,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $data[]=$row;
    }
    return $data;

}

function wishlist_add($conn,$uid,$pid){
    $added_on=date('Y-m-d h:i:s');
    $query=mysqli_query($conn,"insert into whishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
   
}

function ProductSoldQtyByProductId($conn,$pid,$attrId){
     $sql="select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and order_detail.product_attr_id='$attrId' and `order`.order_status!=4 and ((`order`.payment_type='payu' and `order`.payment_status='Success') or (`order`.payment_type='COD' and `order`.payment_status!=''))";
  // echo $sql;
     $res=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($res);
    return $row['qty'];
}

function ProductQty($conn,$id,$Attr_id){
    $sql = "SELECT MIN(qty) AS min_qty FROM product_attributes WHERE id = '$Attr_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
if ($row) {
    return $row['min_qty'];
} else {
    return null; // or handle the case where no rows are found
}
}

function imageComapress($source,$path,$quality=60){
    $arr=getimagesize($source);
    if($arr['mime']=="image/png"){
        $i=imagecreatefrompng($source);
    }else{
        $i=imagecreatefromjpeg($source);
    }
    imagejpeg($i,$path,$quality);
}
function getProductAttr($conn,$pid){
    $sql="select id from product_attributes where product_id='$pid'";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['id'];
}
?>