<?php
   include('security.php');
   $sub_categories_id='';
   $multipleImageArr=[];
   $productAttr=[];
   ?>

    
   <?php
if(isset($_GET['pi']) && $_GET['pi']>0){
	$pi=get_safe_value($conn,$_GET['pi']);
	$delete_sql="delete from product_images where id='$pi'";
	mysqli_query($conn,$delete_sql);
}

$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
    {
       
        $id=$_GET['id'];
        $query=mysqli_query($conn,"select * from product where id=$id");
        $check=mysqli_num_rows($query);
        if($check>0)
        {
           
            $row=mysqli_fetch_assoc($query);
            $categories_id=$row['categories_id'];
            $name= $row['name'];       
            $sub_categories_id=$row['sub_categories_id'];
            
            $image=$row['image'];
            $s_disc=$row['short_desc'];
            $disc=$row['description'];
            $meta_title=$row['meta_title'];
            $meta_desc=$row['meta_desc'];
            $meta_key=$row['meta_keyword'];
            $best_seller=$row['best_seller'];
            $image=$row['image'];
            $p_id=$row['id'];
            
           
            $resMultipleImage=mysqli_query($conn,"select id,product_images from product_images where product_id='$id'");
		    if(mysqli_num_rows($resMultipleImage)>0){
			$jj=0;
			while($rowMultipleImage=mysqli_fetch_assoc($resMultipleImage)){
				$multipleImageArr[$jj]['product_images']=$rowMultipleImage['product_images'];
				$multipleImageArr[$jj]['id']=$rowMultipleImage['id'];
				$jj++;
			}
		}
        $resProductAttr=mysqli_query($conn,"select * from product_attributes where product_id='$id'");
        
		if(mysqli_num_rows($resProductAttr)>0){
			$jj=0;
			while($rowproduct_attr=mysqli_fetch_assoc($resProductAttr)){
				$productAttr[$jj]['product_id']=$rowproduct_attr['product_id'];
                $productAttr[$jj]['size_id']=$rowproduct_attr['size_id'];
                $productAttr[$jj]['color_id']=$rowproduct_attr['color_id'];
                $productAttr[$jj]['mrp']=$rowproduct_attr['mrp'];
                $productAttr[$jj]['price']=$rowproduct_attr['price'];
                $productAttr[$jj]['qty']=$rowproduct_attr['qty'];
                $productAttr[$jj]['id']=$rowproduct_attr['id'];
				$jj++;
			}
        }                        
     
     }
       
        if(isset($_POST['update_btn']))
        {
           
           $cat_id=$_POST['categories_id'];
            $name= $_POST['name'];       
            $sub_categories_id=$_POST['sub_categories_id'];
           $s_disc=$conn->real_escape_string($_POST['short_desc']);
            $disc=$conn->real_escape_string($_POST['description']);
            
            
            $meta_title=$_POST['meta_title'];
            $meta_desc=$_POST['meta_desc'];
            $meta_key=$_POST['meta_key'];
            $best_seller=$_POST['best_seller'];
            if(empty($name) || empty($sub_categories_id) ||  empty($meta_title) || empty($meta_key) || empty($meta_desc) ||empty($s_disc) ||  empty($disc)){
            $msg="Empty Feilds";
            header("Location:update_product.php?id=$id&msg=$msg");
            die();   
            }
            if(isset($_FILES['product_images'])){
                
                foreach($_FILES['product_images']['type'] as $key=>$val){
                    if($_FILES['product_images']['type'][$key]!=''){
                        
                        if($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg'){
                            $msg="Please select only png,jpg and jpeg image formate in multipel product images";
                            header("Location:update_product.php?id=$id&msg=$msg");
                            die();   
                        }
                    }
                }
            }             
            
            if($_FILES['img']['type']!='image/jpeg' && $_FILES['img']['type']!='image/jpg'  &&  $_FILES['img']['type']!= 'image/png' && $_FILES['img']['name']!='')
            {
                $msg="Please select only jpeg , png or jpg images";
            }
            else{ 
               
                foreach($_FILES['product_images']['name'] as $key=>$val){
                    if($_FILES['product_images']['name'][$key]!=''){
                        if(isset($_POST['product_images_id'][$key])){
                            
                           $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                            move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'product_images/'.$image);
                            mysqli_query($conn,"update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");
                           
                        }else{      
                            $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                            move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'product_images/'.$image);
                            mysqli_query($conn,"insert into product_images(product_id,product_images) values('$id','$image')");
                        }
                    }            
                }
                 
                if($_FILES['img']['name']!=NULL )
                {
                     $image=rand(111111111,999999999).'_'.$_FILES['img']['name'];
                     move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$image);
                     $result=mysqli_query($conn,"update product
                     set categories_id='$cat_id',sub_categories_id='$sub_categories_id',name='$name',image='$image',short_desc='$s_disc',description='$disc',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_key',best_seller='$best_seller' where id=$id");
 
                     if($result)
                     {
                         header('Location:products.php?Updated');
                         exit();
                     }
                 }  
                     else{
                         $result=mysqli_query($conn,"update product
                         set categories_id='$cat_id',sub_categories_id='$sub_categories_id',name='$name',   short_desc='$s_disc',description='$disc',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_key',best_seller='$best_seller' where id=$id");   
                           
                  }
                  
                  if(isset($_POST['mrp'])){
                    
                    foreach($_POST['mrp'] as $key=>$val){
                       
                        $mrp=get_safe_value($conn,$_POST['mrp'][$key]);
                        $price=get_safe_value($conn,$_POST['price'][$key]);
                        $qty=get_safe_value($conn,$_POST['qty'][$key]);
                        $size_id=get_safe_value($conn,$_POST['size_id'][$key]);
                        $color_id=get_safe_value($conn,$_POST['color_id'][$key]);
                        $attr_id=get_safe_value($conn,$_POST['attr_id'][$key]);
                        
                        if($attr_id>0){
                            $query=mysqli_query($conn,"update product_attributes set size_id='$size_id',color_id='$color_id',mrp='$mrp',price='$price',qty='$qty' where id='$attr_id'");
                            if(!$query){
                                die();
                            }
                        }
                        else{
                            $query=mysqli_query($conn,"insert into product_attributes(product_id,size_id,color_id,mrp,price,qty) values('$p_id','$size_id','$color_id','$mrp','$price','$qty')");
                            if(!$query){
                                $msg="Empty Feilds";
                                header("Location:update_product.php?id=$id&msg=$msg");
                            die();  
                            }
                               
                        }

                        
                    }
                }
                header('Location:products.php?updated');
                exit();
            }
           }
    }
?>

<link href="css/sb-admin-2.min.css" rel="stylesheet">
<form  method="post" enctype="multipart/form-data">
<body class="bg-gradient">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-8  ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">       
                            <div class="col-lg-12">
                                <div class="p-5">
                                <div class="feild_error"><?php echo $msg ?></div>
                                    <div class="card-header">

                                    <h1 class="h4 text-Black-900 mb-4">Update Product</h1>
                                    </div>
                                    <?php
                                    
                                    if(isset($_GET['msg']) && $_GET['msg']!=''){                                  
                                        ?>                          
                                          <div class="feild_error"><?php echo $_GET['msg'] ?></div>          	
                                        <?php
                                    }

                                    ?>
                                   <label for=""></label>
                                        <div class="form-group">
                                            <div class="row">       
                                                <div class="col-lg-6">
                                                <label> Category</label>
                                            <select class="form-control form-control-user" name="categories_id" id="categories_id" onchange="get_sub_cat()" required>
                                            <option value="">Select Category</option>
                                                <?php
                                                	$res=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                                    while($row=mysqli_fetch_assoc($res)){
                                                        if($row['id']==$categories_id){
                                                            echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                                        }else{
                                                            echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                        }                       
                                                    }
                                                ?>
                                            </select>
                                                </div>
                                                <div class="col-lg-6">
                                                <label>Sub Category</label>
                                            <select class="form-control form-control-user" name="sub_categories_id" id="sub_categories_id">
                                            <option value="">Select Sub Category</option>
                                            </select>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                       
                                       <div class="row">
                                       <div class="col-lg-6">
                                       <label> Product Name </label>
                                     
                                       <input type="string" class="form-control form-control-user" name="name" placeholder="Enter Product name" value=" <?php echo $name  ?>">
                                       </div>
                                      
                                           <div class="col-lg-5">
                                           <label>Best Seller</label>
                                           <select class="form-control form-control-user" name="best_seller" required>
                                           <option value='' selected>Select</option>
                                           <?php

												if($best_seller==1){
													echo '<option value="1" selected>Yes</option>
														<option value="0">No</option>';
												}elseif($best_seller==0){
													echo '<option value="1">Yes</option>
														<option value="0" selected>No</option>';
												}else{
													echo '<option value="1">Yes</option>
														<option value="0">No</option>';
												}
												?>
                                           </div>
                                       </select>    
                                       </div>
                                       </div>
                                       <div class="form-group mt"  id="product_attr_box">

                                        <?php
                                        $attrLoop=1;
                                        foreach($productAttr as $list){
                                        ?>
                                            <div class="row" id="attr_<?php echo $attrLoop ?>">                                                    
                                                <div class="col-lg-2">
                                                <label> MRP </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="mrp[]" placeholder="MRP" value="<?php echo $list['mrp'] ?>" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Price </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="price[]" placeholder="Price" value="<?php echo $list['price'] ?>" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Quantity </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="qty[]" placeholder="Quantity" value="<?php echo $list['qty'] ?>" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Size </label>
                                                <select class="form-control form-control-user" name="size_id[]" id="size_id" required>
                                                <option value="">Select Size</option>
                                                <?php
                                                $result=mysqli_query($conn,"select * from size_master order by order_by asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    if($list['size_id'] == $row['id']){
                                                    echo "<option value=".$row['id']." selected>".$row['size']."</option>";
                                                    }
                                                    else{
                                                        echo "<option value=".$row['id'].">".$row['size']."</option>";  
                                                    }
                                                }
                                                ?>
                                                </select>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Color </label>
                                                <select class="form-control form-control-user" name="color_id[]" id="color_id" required>
                                                <option value="">Select Color</option>
                                                <?php
                                                $result=mysqli_query($conn,"select * from color_master order by color asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    if($list['color_id'] == $row['id']){
                                                        echo "<option value=".$row['id']." selected>".$row['color']."</option>";
                                                        }
                                                        else{
                                                            echo "<option value=".$row['id'].">".$row['color']."</option>";  
                                                        }
                                                }
                                                ?>
                                            </select>   
                                                </div>
                                                <br>
                                                <div class="col-lg-2.5">
                                                    <?php
                                                    if($attrLoop==1){
                                                       ?>  
                                                       <button type="button" class="btn btn-primary btn-user btn-block" id="" onclick="add_more_attr()">Add More</button>           
                                                        <?php
                                                    }
                                                    else{
                                                        ?>  
                                                        <button type="button" class="btn btn-danger btn-user btn-block" id="" onclick="remove_attr('<?php echo  $attrLoop ?>','<?php echo $list['id'] ?>')">Remove</button>           
                                                         <?php
                                                    }
                                                    ?>
                                              <input type="hidden" name="attr_id[]" value='<?php echo  $list['id'] ?> '>
                                                </div>
                                            </div>
                                            <?php $attrLoop++;  } ?>  
                                            </div>
                                            
                                            <div class="form-group" >
                                            <div class="row" id="image_box">       
                                                <div class="col-lg-10">
                                                <label> Image </label>
                                                    <input type="file" class="form-control"
                                                        name="img" placeholder="img">     
                                                        <?php
                                                if($image!=''){
                                                echo "<a target='_blank' href='".'image/'.$image."'><img width='150px' src='".'image/'.$image."'/></a>";
                                                }
                                                ?>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="categories" class="form-control-label"></label>    
                                                  	<button type="button" class="btn btn-primary" onclick="add_more_images()">ADD MORE IMAGES</button>
						
												</div>
                                            
                                                <?php
                                        if(isset($multipleImageArr[0])){
                                        foreach($multipleImageArr as $list){
                                            echo '<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'.$list['id'].'"><label for="categories" class=" form-control-label">Image</label><input type="file" name="product_images[]" class="form-control" ><a href="update_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;"><button type="button" class="btn btn-lg btn-danger btn-block"><span id="payment-button-amount"><a href="update_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;">Remove</span></button></a>';
                                            echo "<a target='_blank' href='".'product_images/'.$list['product_images']."'><img width='150px' src='".'product_images/'.$list['product_images']."'/></a>";
                                            echo '<input type="hidden" name="product_images_id[]" value="'.$list['id'].'"/></div>';
                                            
                                        }
                                    }	
                                                ?>
                                                
                                            </div>
                                             </div>
                                            
                                            <div class="form-group">
											<label>Meta Title </label>
                                            <textarea name="meta_title" cols="30" rows="2" placeholder="Enter Product Meta title" class="form-control" ><?php echo $meta_title?></textarea>
                              			    </div>
                                            <div class="form-group">
											<label>Meta Description </label>
                                            <textarea name="meta_desc" cols="30" rows="2" placeholder="Enter Product Meta Description" class="form-control" ><?php echo $meta_desc?></textarea>
                                          </div>
                                            <div class="form-group">
											<label>Meta Keyword </label>
                                            <textarea name="meta_key" cols="30" rows="2" placeholder="Enter Product Meta Key word" class="form-control" ><?php echo $meta_key?></textarea>
                                 		    </div>
                                            <div class="form-group">
											<label>Short Description </label>
                                            <textarea name="short_desc" cols="30" rows="2" placeholder="Enter Product Short Description" class="form-control" ><?php echo $s_disc?></textarea>
                                    	   </div>
                                            <div class="form-group">
                                            <label>Description </label>
                                            <textarea name="description" cols="30" rows="5" placeholder="Enter Product Description" class="form-control" ><?php echo $disc?></textarea>
                                            </div>
                                            <div class="form-group">
                                            
                                        </div>
                                 
                                        
                                        <button type="submit" class="btn btn-primary  btn-user btn-block" name="update_btn">Update</button> 
                                            <div class="feild_error"><?php echo "$msg"; ?></div>
                         				        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>


    <script>
        function get_sub_cat(sub_cat_id){
            var categories_id=jQuery('#categories_id').val();
            
            jQuery.ajax({
                url: 'get_sub_cat.php',
                type: 'post',
                data: 'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
                success:function(result){
                    jQuery('#sub_categories_id').html(result);
                }
            });
        }
        
    </script>
    <script>
    var total_image=1;
    function add_more_images(){
        total_image++;
        var html='<div class="col-lg-5" style="margin-top:20px;" id="add_image_box_'+total_image+'"><label> Image </label><input name="product_images[]" type="file" class="form-control"name="img" placeholder="img"><button type="button" class="btn btn-danger btn-user btn-block" onclick=remove_image("'+total_image+'")>Remove</button></div>';
      jQuery('#image_box').after(html);
    }
    
    function remove_image(id){
        jQuery('#add_image_box_'+id).remove();
    }
    var attr_count=1;
    function add_more_attr(){
        attr_count++;

        var size_html=jQuery('#attr_1 #size_id').html();
        size_html=size_html.replace('selected','');
        var color_html=jQuery('#attr_1 #color_id').html();
        color_html=color_html.replace('selected','');

        var html='<div class="row mt" id="attr_'+attr_count+'"> <div class="col-lg-2"> <label> MRP </label><input type="number" class="form-control form-control-user" name="mrp[]" placeholder="MRP"> </div> <div class="col-lg-2"> <label> Price </label><input type="number" class="form-control form-control-user" name="price[]" placeholder="Price"> </div> <div class="col-lg-2"> <label> Quantity </label><input type="number" class="form-control form-control-user" name="qty[]" placeholder="Quantity"> </div> <div class="col-lg-2"> <label> Size </label> <select class="form-control form-control-user" name="size_id[]" id="size_id" required> '+size_html+' </select> </div> <div class="col-lg-2"> <label> Color </label> <select class="form-control form-control-user" name="color_id[]" id="color_id" required> '+color_html+'  </select> </div> <br> <div class="col-lg-2.5"> <button type="button" class="btn btn-danger btn-user btn-block" id="" onclick=remove_attr("'+attr_count+'")>Remove</button> </div><input type="hidden" name="attr_id[]" value=""></div>';
        jQuery('#product_attr_box').append(html);
    }
    function remove_attr(attr_count,id){
        jQuery.ajax({
            url: 'remove_attr.php',
            type: 'post',
            data: 'id='+id,
            success:function(result){
                jQuery('#attr_'+attr_count).remove(); 
  
            }
        });
    }
</script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<style>
.feild_error{
    color: red;
}
.form-group{
    color:black;
}
.mt{
    margin-top: 10px;
}
.btn-block{
    margin-top: 30px;
  
}
</style>




                    

<?php


include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
    <?php
        if(isset($_GET['id'])){
            ?>
            get_sub_cat(<?php echo $sub_categories_id; ?>);
            <?php
        }
        ?>
</script>