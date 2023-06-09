<?php
    function prx($arr)
    {
        echo '<pre>';
        print_r($arr);
        die();
    }


    function get_safe_value($conn,$var)
    {
       if($var!='')
       {
        return strip_tags(mysqli_real_escape_string($conn,$var));       }
    }
    function ProductSoldQtyByProductId($conn,$id){
        $sql="select sum(order_detail                                                                           .qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id
        and order_detail.product_id='$id' and `order`.order_status!='4'";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
       return $row['qty'];
   }
   
   function ProductQty($conn,$id,$attr_id){
       $sql="select qty from product_attributes where id='$attr_id'";
       $res=mysqli_query($conn,$sql);
       $row=mysqli_fetch_assoc($res);
      return $row['qty'];
   }
   
   function isAdmin(){
   if(!isset($_SESSION['ADMIN_USER'])){
    ?>
    <script>
        window.location.href='login.php'; 
    </script>
    <?php
    }
    if($_SESSION['ADMIN_ROLE']=='1'){
        
        ?>
        <script>
            window.location.href='products.php'; 
        </script>
        <?php
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
   
?>