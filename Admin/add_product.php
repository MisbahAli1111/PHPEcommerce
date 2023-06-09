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


    if(isset($_POST['add_btn']))
    {
        
          $cat=$_POST['categories_id'];
          $sub_cat=$_POST['sub_categories_id'];
          $name=$_POST['name'];
          $meta_title=$_POST['meta_title'];
          $meta_desc=$_POST['meta_desc'];
          $meta_key=$_POST['meta_key'];
          $s_desc=$_POST['short_desc'];
          $l_desc=$_POST['description'];
          $best_seller=$_POST['best_seller'];
        
      
            if(isset($product_files)){
            foreach($_FILES['product_images']['type'] as $key=>$val){
            if($_FILES['product_images']['type'][$key]!='image/jpeg' && $_FILES['product_images']['type'][$key]!='image/jpg'  &&  $_FILES['product_images']['type'][$key]!= 'image/png')
            {
                    $msg="Please select  jpeg , png or jpg images";      
            }
            }
        }
            if($_FILES['img']['type']!='image/jpeg' && $_FILES['img']['type']!='image/jpg'  &&  $_FILES['img']['type']!= 'image/png')
            {
                $msg="Please select  jpeg , png or jpg images";
            }
            else{ 
            if($_FILES['img']['name']=='')
            {
                $msg="Please select  jpeg , png or jpg images";
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['img']['name'];
            //$file_tmp=$_FILES['img']['temp_name'];
            imageComapress($_FILES['img']['tmp_name'],'image/'.$image);
                  
         //    move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$image);
             
            if( empty($name) || empty($sub_cat) ||  empty($meta_title) || empty($meta_key) || empty($meta_desc) ||empty($s_desc) ||  empty($l_desc) )
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
                 
                 $sql="insert into product(categories_id,sub_categories_id,name,image,short_desc,description,meta_title,meta_desc,meta_keyword,status,best_seller,added_by) values('$cat','$sub_cat','$name','$image','$s_desc','$l_desc','$meta_title','$meta_desc','$meta_key','1','$best_seller','".$_SESSION['ADMIN_ID']."')";
              
                 $query=mysqli_query($conn,$sql);
                 $p_id=mysqli_insert_id($conn);
                 if(isset($_FILES['product_images']['name'])){
		
                foreach($_FILES['product_images']['name'] as $key=>$val){
                    //$_FILES['product_images']['type'][$key];
                    $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                    imageComapress($_FILES['product_images']['tmp_name'][$key],'product_images/'.$image);
                    //move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'product_images/'.$image);
                    
                    $query1=mysqli_query($conn,"insert into product_images(product_id,product_images) values('$p_id','$image')");
                    if($query1){
                        
                    }else{
                        die();
                    }
                   
                }
            }
                if(isset($_POST['mrp'])){
                    foreach($_POST['mrp'] as $key=>$val){
                        $mrp=get_safe_value($conn,$_POST['mrp'][$key]);
                        $price=get_safe_value($conn,$_POST['price'][$key]);
                        $qty=get_safe_value($conn,$_POST['qty'][$key]);
                        $size_id=get_safe_value($conn,$_POST['size_id'][$key]);
                        $color_id=get_safe_value($conn,$_POST['color_id'][$key]);
                        $attr_id=get_safe_value($conn,$_POST['attr_id'][$key]);
				
                        $query=mysqli_query($conn,"insert into product_attributes(product_id,size_id,color_id,mrp,price,qty) values('$p_id','$size_id','$color_id','$mrp','$price','$qty')");
                        if(!$query){
                            die();
                        }
                    }
                }

                
                if($query){
                    header("Location:Products.php");
                    exit();
                }
                else{
                    
                }
            }
           }
           
            }
            
           
        }
         }


   ?>
   


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<form action="add_product.php" method="post" enctype="multipart/form-data">
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
                                                $result=mysqli_query($conn,"select id,categories from categories order by categories asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
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
                                          
                                            <input type="string" class="form-control form-control-user" name="name" placeholder="Enter Product name">
                                            </div>
                                           
                                                <div class="col-lg-5">
                                                <label>Best Seller</label>
                                                <select class="form-control form-control-user" name="best_seller" required>
                                                <option value='' selected>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                </div>
                                            </select>    
                                            </div>
                                            </div>
                                           </div>
                                            <div class="form-group"  id="product_attr_box">
                                            <div class="row" id="attr_1">                                                    
                                                <div class="col-lg-2">
                                                <label> MRP </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="mrp[]" placeholder="MRP" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Price </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="price[]" placeholder="Price" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Quantity </label>
                                            <input type="number" class="form-control form-control-user"
                                                name="qty[]" placeholder="Quantity" required>
                                                </div>
                                                <div class="col-lg-2">
                                                <label> Size </label>
                                                <select class="form-control form-control-user" name="size_id[]" id="size_id" required>
                                                <option value="">Select Size</option>
                                                <?php
                                                $result=mysqli_query($conn,"select * from size_master order by order_by asc");
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    echo "<option value=".$row['id'].">".$row['size']."</option>";
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
                                                    echo "<option value=".$row['id'].">".$row['color']."</option>";
                                                }
                                                ?>
                                            </select>   
                                                </div>
                                                <br>
                                                <div class="col-lg-2.5">
                                                <button type="button" class="btn btn-primary btn-user btn-block" id="" onclick="add_more_attr()">Add More</button> 
                                    
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
                                                    <button type="button" class="btn btn-primary btn-user btn-block" id="" onclick="add_more_images()">Add More Images</button> 
                                                 </div>
                                            </div>
                                             </div>
                                            
                                            <div class="form-group">
                                            <label>Meta Title </label>
                                            <textarea name="meta_title" cols="30" rows="2" placeholder="Enter Product Meta title" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Description </label>
                                            <textarea name="meta_desc" cols="30" rows="2" placeholder="Enter Product Meta Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Meta Keyword </label>
                                            <textarea name="meta_key" cols="30" rows="2" placeholder="Enter Product Meta Key word" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Short Description </label>
                                            <textarea name="short_desc" cols="30" rows="2" placeholder="Enter Product Short Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label>Description </label>
                                            <textarea name="description" cols="30" rows="5" placeholder="Enter Product Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="form-group">
                                            
                                        </div>
                                 
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="add_btn">ADD</button> 
                                          
                                        
                                       
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
.btn-block{
    margin-top: 30px;
  
}
.mt{
    margin-top: 10px;
}

</style>
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
        var color_html=jQuery('#attr_1 #color_id').html();
        
        var html='<div class="row mt" id="attr_'+attr_count+'"> <div class="col-lg-2"> <label> MRP </label><input type="number" class="form-control form-control-user" name="mrp[]" placeholder="MRP"> </div> <div class="col-lg-2"> <label> Price </label><input type="number" class="form-control form-control-user" name="price[]" placeholder="Price"> </div> <div class="col-lg-2"> <label> Quantity </label><input type="number" class="form-control form-control-user" name="qty[]" placeholder="Quantity"> </div> <div class="col-lg-2"> <label> Size </label> <select class="form-control form-control-user" name="size_id[]" id="size_id" required> '+size_html+' </select> </div> <div class="col-lg-2"> <label> Color </label> <select class="form-control form-control-user" name="color_id[]" id="color_id" required> '+color_html+'  </select> </div> <br> <div class="col-lg-2.5"> <button type="button" class="btn btn-danger btn-user btn-block" id="" onclick=remove_attr("'+attr_count+'")>Remove</button> </div></div>';
        jQuery('#product_attr_box').append(html);
    }
    function remove_attr(attr_count){
        jQuery('#attr_'+attr_count).remove(); 
    }
</script>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>