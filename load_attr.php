<?php

    require('includes/database.php');
    require('functions.php');
    require('add_to_cart.inc.php');

    $cs_id=get_safe_value($conn,$_POST['cs_id']);
    $pid=get_safe_value($conn,$_POST['product_id']);
    $type=get_safe_value($conn,$_POST['type']);
    
    if($type=='color'){
       $s="select product_attributes.size_id,size_master.size from product_attributes,size_master where product_attributes.product_id='$pid' and product_attributes.color_id=$cs_id and size_master.id=product_attributes.size_id and size_master.status=1 order by size_master.order_by asc";
       echo $s; 
       $sql=mysqli_query($conn,$s);
       
        $html='';
        if(mysqli_num_rows($sql)>0){
            while($rowAttr=mysqli_fetch_assoc($sql)){
                $html.="<option value='".$rowAttr['size_id']."'>".$rowAttr['size']."</option>";
            }
        }
        echo $html; 
    }
    
?> 