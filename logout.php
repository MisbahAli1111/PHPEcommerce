<?php

include('includes/database.php');
include('functions.php');

unset($_SESSION['USER_LOGIN']);
 unset($_SESSION['USER_ID']);
 unset($_SESSION['USER_NAME']);
header('Location:index.php');
?>