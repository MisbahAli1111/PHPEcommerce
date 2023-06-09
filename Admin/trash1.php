<?php
   include('security.php');

   $msg="";
   $condition='';
   $condition1='';
   
   if($_SESSION['ADMIN_ROLE']=='1'){
       $condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
       $condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
   }
   ?>

   <?php
	
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id' $condition1");
  
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$sub_categories_id=$row['sub_categories_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_desc=$row['short_disc'];
		$description=$row['discription'];
		$meta_title=$row['meta_title'];
		$meta_desc=$row['meta_disc'];
		$meta_keyword=$row['meta_keyword'];
		$best_seller=$row['best_seller'];
		$image=$row['image'];
		
		$resMultipleImage=mysqli_query($conn,"select id,product_images from product_images where product_id='$id'");
		if(mysqli_num_rows($resMultipleImage)>0){
			$jj=0;
			while($rowMultipleImage=mysqli_fetch_assoc($resMultipleImage)){
				$multipleImageArr[$jj]['product_images']=$rowMultipleImage['product_images'];
				$multipleImageArr[$jj]['id']=$rowMultipleImage['id'];
				$jj++;
			}
		}
		
	}else{
		header('location:product.php');
		die();
	}
}

    if(isset($_POST['add_btn']))
    {
       
         $cat=$_POST['categories_id'];
         $sub_cat=$_POST['sub_categories_id'];
        
         $name=$_POST['name'];
        
         $mrp=$_POST['mrp'];
         $price=$_POST['price'];
         $qty=$_POST['qty'];
         //$image=$_POST['img'];
          $meta_title=$_POST['meta_title'];
          $meta_desc=$_POST['meta_desc'];
          $meta_key=$_POST['meta_key'];
          $s_desc=$_POST['short_desc'];
          $l_desc=$_POST['description'];
          $best_seller=$_POST['best_seller'];
        
      
         if($_FILES['img']['type']!='image/jpeg' && $_FILES['img']['type']!='image/jpg'  &&  $_FILES['img']['type']!= 'image/png')
         {
             $msg="Please select  jpeg , png or jpg images";
         }
         if(isset($_FILES['product_images'])){
            foreach($_FILES['product_images']['type'] as $key=>$val){
                if($_FILES['product_images']['type'][$key]!='image/jpeg' && $_FILES['product_images']['type'][$key]!='image/jpg'  &&  $_FILES['product_images']['type'][$key]!= 'image/png')
                {
                     $msg="Please select  jpeg , png or jpg images";      
                }
            }
         } 
         else{
            
            if($_FILES['img']['name']=='')
            {
                $msg="Please select  jpeg , png or jpg images";
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['img']['name'];
            //$file_tmp=$_FILES['img']['temp_name'];
             move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$image);
            
            if( empty($name) || empty($sub_cat) || empty($mrp) || empty($price) || empty($qty) ||  empty($meta_title) || empty($meta_key) || empty($meta_desc) ||empty($s_desc) ||  empty($l_desc) )
           {
            $msg="Please Enter all valid feilds";
            
           }
           else{
            $sql="SELECT * FROM `product` WHERE name='$name' $condition1";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                $msg="Product Already Exist";
                header("Location:add_product.php?ProductAlreadyexist");
                exit();
            }
            else{
                 
                 $sql="insert into product(categories_id,sub_categories_id,name,mrp,price,qty,image,short_disc,discription,meta_title,meta_disc,meta_keyword,status,best_seller,added_by) values('$cat','$sub_cat','$name','$mrp','$price','$qty','$image','$s_desc','$l_desc','$meta_title','$meta_desc','$meta_key','1','$best_seller','".$_SESSION['ADMIN_ID']."')";
                
                 $query=mysqli_query($conn,$sql);
               $id=mysqli_insert_id($conn);

                foreach($_FILES['product_images']['name'] as $key=>$val){
                    //$_FILES['product_images']['type'][$key];
                    $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'product_images/'.$image);
                    
                    $query1=mysqli_query($conn,"insert into product_images(product_id,product_images) values('$id','$image')");
                    if($query1){
                        die();
                    }else{

                    }
                   
                }
                // echo 'here';
                // die();
                if($query){
                    header("Location:Products.php");
                    exit();
                }
            }
           }
           
            }
            
           
        }
         }


   ?>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="" method="post" enctype="multipart/form-data">
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

                                    <h1 class="h4 text-Black-900 mb-4">Add Product</h1>
                                    </div>
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
                                       
                                                   
                                        <label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name?>">
                              </div>
                                           
                                            <div class="form-group">
                                            <div class="row">       
                                                <div class="col-lg-3">
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
                                                
                                            </select>
                                                </div>
                                                <div class="col-lg-3">
												<label for="categories" class=" form-control-label">MRP</label>
										<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp?>">
							                </div>
                                                <div class="col-lg-3">
												<label for="categories" class=" form-control-label">Price</label>
										<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
					                 </div>
                                                <div class="col-lg-3">
												<label for="categories" class=" form-control-label">Qty</label>
										<input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty?>">
							               </div>
                                            </div>
                                         
                                            </div>
                                           
                                            <div class="form-group" >
                                            <div class="row" id="image_box">       
                                                <div class="col-lg-10">
                                                <label> Image </label>
                                                    <input type="file" class="form-control"
                                                        name="img" placeholder="img">        
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="categories" class="form-control-label"></label>    
                                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="" onclick="add_more_images()">Add More Images</button> 
                                                 </div>
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
                                            <textarea name="meta_key" cols="30" rows="2" placeholder="Enter Product Meta Key word" class="form-control" ><?php echo $meta_keyword?></textarea>
                                 		    </div>
                                            <div class="form-group">
											<label>Short Description </label>
                                            <textarea name="short_desc" cols="30" rows="2" placeholder="Enter Product Short Description" class="form-control" ><?php echo $short_desc?></textarea>
                                    	   </div>
                                            <div class="form-group">
                                            <label>Description </label>
                                            <textarea name="description" cols="30" rows="5" placeholder="Enter Product Description" class="form-control" ><?php echo $description?></textarea>
                                            </div>
                                            <div class="form-group">
                                            
                                        </div>
                                 
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">Update</button> 
                                          
                                        
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>


  <!-- Custom styles for this template-->

    <script>
        function get_sub_cat(){
            var categories_id=jQuery('#categories_id').val();
            jQuery.ajax({
                url: 'get_sub_cat.php',
                type: 'post',
                data: 'categories_id='+categories_id,
                success:function(result){
                    jQuery('#sub_categories_id').html(result);
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
    align-content: center;
    color: red;
    
    padding: 9px;
}
.form-group{
    color:black;
}

</style>
<script>
    var total_image=1;
    function add_more_images(){
        total_image++;
        var html='<div class="col-lg-5" style="margin-top:20px;" id="add_image_box_'+total_image+'"><label> Image </label><input name="product_images[]" type="file" class="form-control"name="img" placeholder="img"><button type="button" class="btn btn-danger btn-user btn-block" onclick=remove_image("'+total_image+'")>Remove</button></div>';
      jQuery('#image_box').append(html);
    }
    
    function remove_image(id){
        jQuery('#add_image_box_'+id).remove();
    }
</script>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>