
<?php
session_start();
include("includes/database.php");
include("function.php");


if(!$_SESSION['username'])
{
    header('Location:login.php');
    exit();
}

?>