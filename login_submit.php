	<?php

include('includes/database.php');
include('functions.php');
$email=get_safe_value($conn,$_POST['email']);
$password=get_safe_value($conn,$_POST['password']);
//$password='123'; 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// echo $hashedPassword;

$res=mysqli_query($conn,"select * from users where email='$email'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
	while($row=mysqli_fetch_assoc($res)){
		// echo $row['password'];
		// echo $password;
		if(password_verify($password,$row['password']))
		{
			$_SESSION['USER_LOGIN']='yes';
			$_SESSION['USER_ID']=$row['id'];
			$_SESSION['USER_NAME']=$row['name'];
			if(isset($_SESSION['WISHLIST_ID']) && isset($_SESSION['WISHLIST_ID'])!=''){
				wishlist_add($conn,$_SESSION['USER_ID'],$_SESSION['WISHLIST_ID']);
				unset($_SESSION['WISHLIST_ID']);
			}
			echo "valid";
		}else{
			echo "wrong";
		}

	}

}
else{
	echo "wrong";
}
// $password = "123";
// $hashedPassword = '$2y$10$B./GJLasjCsqRnreDP5zpOczdZhsoslg1X.PV0KkV0vVsn/Ni7aru';

// if (password_verify($password, $hashedPassword)) {
//     echo "Password is correct";
// } else {
//     echo "Password is incorrect";
// }

?> 