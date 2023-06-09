
<?php
include('includes/header.php');
include('includes/topbar.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	header("Location:index.php");
	die();
}
?> 
      <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Log In / Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
      <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" >
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="feild_error" id="login_email_error"></span>
										
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="feild_error" id="login_password_error"></span>
										
									</div>
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="user_login()" class="fv-btn">Login</button>
										<a href="forget_password.php" class="forget_password">Forget Password?</a>
										
									</div>
								</form>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="register-form">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
										</div>
										<span class="feild_error" id="name_error"></span>
								
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email"  id="email" placeholder="Your Email*" style="width:50%">
											<button type="button" class="fv-btn email_send_otp height_60px" onclick="email_send_otp()" class="fv-btn">Send OTP</button>

											<input class="email_verify_otp height_60px" type="text"name="email_otp" id="email_otp" placeholder="OTP*" style="width:45%" >
											<button class="fv-btn email_verify_otp height_60px" type="button" onclick="email_verify_otp()" >Verify OTP</button>

											<span class="feild_done" id="email_otp_result"></span>
									
										</div>
										<span class="feild_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="number" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
										</div>
										<span class="feild_error" id="mobile_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
										</div>
										<span class="feild_error" id="password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="button" class="fv-btn register_btn" onclick="user_register()" disabled>Register</button>
										<span class="feild_success" id="success" ></span>
									</div>
									
								</form>
							
								
							</div>
						</div> 
                
				</div>
					
            </div>
        </section> 
		
		<script>

			function email_send_otp(){
				jQuery('#email_error').html('');
				var email=jQuery('#email').val();
				
				if(email==''){
					jQuery('#email_error').html('Please Enter email Id ');
				}else{
			
					jQuery.ajax({
						url: 'send_otp.php',
						type: 'post',
						data : 'email='+email+'&type='+"email",
						success:function(result){
							result=$.trim(result);
							
							if(result=="done")
							{
								jQuery('#email').attr('disabled',true);
								jQuery('.email_verify_otp').show();
								jQuery('.email_send_otp').hide();
							}
							else{
								jQuery('#email_error').html('Please try After some time');
			
							}
						}
					});
				
				}
			}
	
			function email_verify_otp(){
				var email_otp=jQuery('#email_otp').val();
				
				if(email_otp==''){
					jQuery('#email_error').html('Please enter otp');
				}else{
					jQuery.ajax({
						url: 'verify_otp.php',
						type: 'post',
						data : 'otp='+email_otp+'&type=email',
						success:function(result){
							result=$.trim(result);
							if(result=="done")
							{
								jQuery('.email_verify_otp').hide();
								jQuery('#email_otp_result').html("Email id Verified!");
								jQuery('.register_btn').attr('disabled',false);
							}
							else{
								jQuery('#email_error').html('Please enter valid OTP');
			
							}
						}
					});
				
				}
				
			}
	function user_register(){
	jQuery('.feild_error').html('');
    var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var is_error='';
	if(name==''){
		jQuery('#name_error').html('Enter your name');
		is_error='yes';
	}
	if(email==''){
		jQuery('#email_error').html('Enter your email');
		is_error='yes';
	}
	if(mobile==''){
		jQuery('#mobile_error').html('Enter your mobile');
		is_error='yes';
	}
	if(password==''){
		jQuery('#password_error').html('Enter your password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			
			url : 'register_submit.php',
			type : 'post',
			data: 'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
				if(result=='present')
				{
					$('#register-form').trigger('reset');
					jQuery('#email_error').html('This email has already been registered');
					
				}
				if(result=='insert')
				{	
					$('#register-form').trigger('reset');
					$('#success').html("<div class='alert alert-success'><strong>You Have been Registred. </strong></div>");
					
				}
			}
		});
		
	}

}
//jQuery('.login_msg p').html('Please enter valid login details');
			




function user_login(){

	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Please enter email');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Please enter password');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				result=$.trim(result); 
				if(result=='wrong'){
					$('#login-form').trigger('reset');
					$('#login_error').html("<div class='alert alert-danger'><strong>Please enter valid login details</strong></div>");
   
				}
				if(result=='valid'){	                              				
					window.location.href='index.php';
				}
			}	
		});
	}	
}

		</script>

		<style>
			.feild_error{
				color: red;
				font-size: 18px;
			}
			.feild_success{
				color: green;
				margin: 55px;
				font-size: 20px;
			}
			.feild_done{
				color: green;
				margin: 20px;
				font-size: 20px;
			}
			.login_error{
				color: red;
				margin: 20px;
				font-size: 15px;
			}
			.email_verify_otp{
				display: none;
			}
			.height_60px{
				height: 60px;
			}			
			.forget_password{
				margin-left: 30px;
			}
			
		</style>

<?php
    include('includes/footer.php');
       ?>

