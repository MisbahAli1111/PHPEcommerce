<?php
include('includes/database.php');
include('functions.php');
$type=get_safe_value($conn,$_POST['type']);

if($type=='email')
    {
        
        
      $email=get_safe_value($conn,$_POST['email']);
  // $email="k201093@nu.edu.pk";
        $otp=rand(1111,9999);
        $msg="$otp is your otp";
        $_SESSION['EMAIL_OTP']=$otp;
        
include('smtp/PHPMailerAutoload.php');

$subject="OTP Code";

    $mail = new PHPMailer(); 
	//$mail->SMTPDebug=3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "587"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "k201093@nu.edu.pk";  /// my email
	$mail->Password = 'sm03002128375';  /// my password
	$mail->SetFrom("Anonymous");  /// my email
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($email);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo "done";
	}
}
 
  


?> 