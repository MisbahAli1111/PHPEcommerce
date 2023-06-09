<?php
    session_start();
    $dbhost="localhost";
    $dbUser="root";
    $dbPass="";
    $dbName="ecommerce";

    $conn=mysqli_connect($dbhost,$dbUser,$dbPass,$dbName);
    
    // define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/PHP/Admin/');
    // //define('SITE_PATH','');

    // define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'image/');
    // define('PRODUCT_IMAGE_SERVER_PATH',SITE_PATH.'image/');



    if(!$conn)
    {
        die("Data Base connection Failed") ;
    }
    

?>