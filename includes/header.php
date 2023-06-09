<?php
    require('database.php');
    require('functions.php');
    require('add_to_cart.inc.php');

    $meta_title="Ecom_website";
    $meta_desc="Ecom_website";
    $meta_keyword="Ecom_website";

    $script_name=$_SERVER['SCRIPT_NAME'];
    $script_name_arr=explode('/',$script_name);
    $mypage=$script_name_arr[count($script_name_arr)-1];

    if($mypage=="product_details.php"){

    
    $prod_id=get_safe_value($conn,$_GET['id']);
    $product_meta=mysqli_fetch_assoc(mysqli_query($conn,"select * from product where id='$prod_id'"));
     $meta_title=$product_meta['meta_title'];
     $meta_desc=$product_meta['meta_desc'];             
     $meta_keyword=$product_meta['meta_keyword'];
    } 
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title ?></title>
    <meta name="description" content="<?php echo $meta_desc ?>">
    <meta name="keyword" content="<?php echo $meta_keyword ?>">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

