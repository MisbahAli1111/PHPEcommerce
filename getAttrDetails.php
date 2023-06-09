<?php

include('includes/database.php');
include('functions.php');

$color=get_safe_value($conn,$_POST['color']);
$pid=get_safe_value($conn,$_POST['pid']);
$size=get_safe_value($conn,$_POST['size']);
if($color==''){
	$color=0;
}if($size==''){
	$size=0;
}

$res=mysqli_query($conn,"select * from product_attributes where product_id='$pid' and color_id='$color' and size_id='$size'");
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	$productSoldQtyByProductId=productSoldQtyByProductId($conn,$pid,$row['id']);									
	$pending_qty=$row['qty']-$productSoldQtyByProductId;
	echo json_encode(['qty'=>$pending_qty,'price'=>$row['price'],'mrp'=>$row['mrp']]);
	
}else{
	
}
?>