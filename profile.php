
<?php
include('includes/header.php');
include('includes/topbar.php');
if(!isset($_SESSION['USER_LOGIN'])){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
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
                                  <span class="breadcrumb-item active">Profile</span>
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
									<h2 class="title__line--6">Profile</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="forget-form" >
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name" style="width:100%" value="<?php echo $_SESSION['USER_NAME'] ?>">
										</div>
										<span class="feild_error" id="name_error"></span>
										<span class="feild_success" id="success" ></span>
								
									</div>
						
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="update_profile()" class="fv-btn" id="btn_submit">Update Name</button>
                                        <button type="button" onclick="window.location.href='login.php'" class="fv-btn" id="btn_submit">Back TO Shopping</button>
                                    </div>
                                    <div class="contact-btn">
										
									</div>
	
                                </form>
                             <div class="form-output">
									<p class="form-messege"></p>
								</div>
							</div>
						</div> 
                
						
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Change password</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="forget-form" >
									<div class="single-contact-form">
										<label>Current Password</label>
										<div class="contact-box name">
											<input type="text" name="cpassword" id="cpassword" placeholder="Your Current Password" style="width:100%">
										</div>
										<span class="feild_error" id="cpassword_error"></span>
										
									</div>
									<div class="single-contact-form">
									<label>New Password</label>
										<div class="contact-box name">
											<input type="text" name="npassword" id="npassword" placeholder="Your New Password" style="width:100%">
										</div>
										<span class="feild_error" id="npassword_error"></span>
										
										<br>
										<div class="contact-box name">
											<input type="text" name="nnpassword" id="nnpassword" placeholder="Your New Password" style="width:100%">
										</div>
									
										<span class="feild_error" id="nnpassword_error"></span>
										<span class="feild_success" id="nsuccess" ></span>
								
									</div>
									<span class="feild_success" id="csuccess" ></span>
									<span class="login_error" id="login_error"></span>
									<div class="contact-btn">
										<button type="button" onclick="update_password()" class="fv-btn" id="btn_update">Update Password</button>
                                    </div>
                                    <div class="contact-btn">
										
									</div>
	
                                </form>
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
			




	function update_profile(){

		jQuery('.field_error').html('');
		jQuery('.field_success').html('');
		jQuery('#name_error').html('');
		jQuery('#success').html('');
		var name=jQuery("#name").val();
		var is_error='';
		if(name==""){
			jQuery('#name_error').html('Please enter Name');
			is_error='yes';
		}
		if(is_error==''){
			jQuery('#btn_submit').html('Please waite...');
			jQuery('#btn_submit').attr('disabled',true ); 
			jQuery.ajax({
				url:'update_profile.php',
				type:'post',
				data:'name='+name,
				success:function(result){
					result=$.trim(result);
					jQuery('#success').html(result);				
					jQuery('#btn_submit').html('Update');
					jQuery('#btn_submit').attr('disabled',false );
				}
			});
		}	
	}

		function update_password(){

		jQuery('.field_error').html('');
		jQuery('.field_success').html('');
		jQuery('#cpassword_error').html('');
		jQuery('#npassword_error').html('');
		jQuery('#nnpassword_error').html('');
		jQuery('#csuccess').html('');
		var cpassword=jQuery("#cpassword").val();
		var npassword=jQuery("#npassword").val();
		var nnpassword=jQuery("#nnpassword").val();
		var is_error='';
		if(cpassword==""){
			jQuery('#cpassword_error').html('Please enter Current Password');
			is_error='yes';
		}
		if(npassword==""){
			jQuery('#npassword_error').html('Please your new Password');
			is_error='yes';
		}
		if(nnpassword==""){
			jQuery('#nnpassword_error').html('Please your new Password');
			is_error='yes';
		}
		if(npassword!="" && nnpassword!="" && npassword!=nnpassword){
			jQuery('#nnpassword_error').html('Please enter same password');
			is_error='yes';
		}
		if(is_error==''){
			jQuery('#btn_update').html('Please waite...');
			jQuery('#btn_update').attr('disabled',true );
			
			jQuery.ajax({
				url:'update_password.php',
				type:'post',
				data:'cpassword='+cpassword+'&npassword='+npassword,
				success:function(result){
					result=$.trim(result);
					if(result=='no'){
						jQuery('#nnpassword_error').html('Password not registered');
						jQuery('#btn_update').html('Update');		
						
					}
					else{
						jQuery('#btn_update').html('Updated');		
						jQuery('#csuccess').html('Your Password has been updated');
				
					}
					
					jQuery('#btn_update').attr('disabled',false );
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
				margin: 45px;
				font-size: 18px;
			}	
			
		</style>

<?php
    include('includes/footer.php');
       ?>

