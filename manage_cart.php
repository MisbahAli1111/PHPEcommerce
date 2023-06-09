<?php

    require('includes/database.php');
    require('functions.php');
    require('add_to_cart.inc.php');


    $pid=get_safe_value($conn,$_POST['pid']);
    $qty=get_safe_value($conn,$_POST['qty']);
    $type=get_safe_value($conn,$_POST['type']);
   
    $attr_id=0;
    

    if(isset($_POST['sid']) && isset($_POST['cid'])){
        $sub_sql='';
        $cid=get_safe_value($conn,$_POST['cid']);
        $sid=get_safe_value($conn,$_POST['sid']);    
        if($sid>0){
            $sub_sql.=" and size_id=$sid ";
        }
        if($cid>0){
            $sub_sql.=" and color_id=$cid ";
        }
        $row=mysqli_fetch_assoc(mysqli_query($conn,"select id from product_attributes where product_id='$pid' $sub_sql"));
        $attr_id=$row['id'];
    }

        
    $soldqty=ProductSoldQtyByProductId($conn,$pid,$attr_id);  
    $totalqty=ProductQty($conn,$pid,$attr_id);  
    
    $pendingQty=$totalqty-$soldqty;
    if($qty>$pendingQty && $type!='remove'){
        echo "not_avaliable";
        die();
    }

    $obj=new add_to_cart();
   
        
        if($qty>$pendingQty){
            echo 'not available';
            die();
        }
        if($type=='add')
        {
            $obj->addProduct($pid,$qty,$attr_id);
        }
    
        if($type=='remove')
        {
            $obj->deleteProduct($pid,$attr_id);
        }
        
        if($type=='update')
        {
        
            $obj->updateProduct($pid,$qty,$attr_id);
        }

    

    echo $obj->totalProduct();
?>