<?php

require('includes/database.php');
require('function.php');


    $categories_id=get_safe_value($conn,$_POST['categories_id']);
    $sub_cat_id=get_safe_value($conn,$_POST['sub_cat_id']);
    $query=mysqli_query($conn,"select * from `sub_categories` where categories_id='$categories_id' and status='1'");

    if(mysqli_num_rows($query)>0){
        
        $html='';
        while($row=mysqli_fetch_assoc($query)){
            if($sub_cat_id==$row['id']){
                $html.= "<option value=".$row['id']." selected>".$row['sub_categories']."</option>";    
            }else{
                $html.= "<option value=".$row['id'].">".$row['sub_categories']."</option>"; 
            }
  
        }
        echo $html;
    }else{
        echo "<option value=''>No Sub Category Found</option>";
    }

?>