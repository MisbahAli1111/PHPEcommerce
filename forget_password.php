
<?php
include('includes/header.php');
include('includes/topbar.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	header("Location:myorder.php");
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
                                  <span class="breadcrumb-item active">Forget Password</span>
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
									<h2 class="title__line--6">Forget Password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="forget-form" >
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
										</div>
										<span class="feild_error" id="email_error"></span>
										
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="number" id="number" placeholder="Your provided Number*" style="width:100%">
										</div>
										<span class="feild_error" id="number_error"></span>
										
									</div>
									<div class="single-contact-form">
										<div class="contact-box name" >
											<input type="password" name="new_password" id="new_password" placeholder="Your New Password*" style="width:100%" >
										</div>
										<span class="feild_error" id="password_error"></span>
										
									</div>
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="forget_password()" class="fv-btn" id="btn_submit">Submit</button>
                                        <button type="button" onclick="window.location.href='login.php'" class="fv-btn" id="btn_submit">Continue Login</button>
                                    </div>
                                    <div class="contact-btn">
										
									</div>
	
                                </form>
                                <span class="feild_success" id="success" ></span>
								<div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
				</div>
				

				
            </div>
        </section> 
	
		<script>

//jQuery('.login_msg p').html('Please enter valid login details');
			




function forget_password(){

	jQuery('.field_error').html('');
	jQuery('#email_error').html('');
	jQuery('#number_error').html('');
	jQuery('#password_error').html('');

	var email=jQuery("#email").val();
	var number=jQuery("#number").val();
	var password=jQuery('#new_password').val();
    var is_error='';
	if(email==""){
		jQuery('#email_error').html('Please enter email');
		is_error='yes';
	}
	if(number==""){
		jQuery('#number_error').html('Please enter Mobile number');
		is_error='yes';
	}
    if(password==""){
		jQuery('#password_error').html('Please enter your new password');
		is_error='yes';
	}
	if(is_error==''){
        jQuery.ajax({
			url:'forget_password_submit.php',
			type:'post',
			data:'email='+email+'&number='+number+'&password='+password,
			success:function(result){
				result=$.trim(result);
                if(result=='done'){
                    $('#forget-form').trigger('reset');
					$('#success').html("<div class='alert alert-success'><strong>Your Email has been Updated!</strong></div>");
                }
                else{
                    $('#forget-form').trigger('reset');
			        jQuery('#email_error').html('The Email is not registered with given number');	            
                }
        
            }
		});
	}	
}

			
		</script>

		<style>
			.feild_error{
				color: red;
				font-size: 15px;
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
            .feild_success{
				color: green;
				margin: 55px;
				font-size: 20px;
			}	
			
		</style>

<?php
    include('includes/footer.php');
       ?>

