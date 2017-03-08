<style>
    .login-msg-box{
        font-size:16px;
    }
	#remember-me{
		font-weight: normal;
	}
	.login_overlap{
		margin-top:2px;
	}
	.alert-danger {
		color: red !important;
	}
	#candidate_login_link{
		margin-right: 6px;
	}
	div#rotate-plane {
		background-color: hsla(0, 0%, 0%, 0.5);
		border: thin solid hsl(0, 0%, 87%);
		display: none;
		height: 100vh;
		left: 0;
		position: fixed;
		text-align: center;
		top: 0;
		width: 100%;
		z-index: 200;
	}
	div#rotate-plane .white-bg-circle {
		z-index: 200;
		opacity: 1;
		margin: 0 auto;
		width: 232px;
		height: 232px;
		display: inline-block;
		vertical-align: middle;
		*vertical-align: auto;
		*zoom: 1;
		*display: inline;
		position: relative;
		top: 50%;
		-moz-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		transform: translateY(-50%);
		background-color: white;
		-moz-border-radius: 100%;
		-webkit-border-radius: 100%;
		border-radius: 100%;
		padding: 75px 17px
	}
	div#rotate-plane img {
		display: block !important;
		background-color: white;
		position: relative;
		/*		-moz-border-radius: 100%;
				-webkit-border-radius: 100%;
				border-radius: 100%;
				-webkit-transition-property: -webkit-transform;
				-webkit-transition-duration: 1s;
				-moz-transition-property: -moz-transform;
				-moz-transition-duration: 1s;
				transition-property: transform;
				transition-duration: 1s;
				-webkit-animation-name: rotate;
				-webkit-animation-duration: 2s;
				-webkit-animation-iteration-count: infinite;
				-webkit-animation-timing-function: linear;
				-moz-animation-name: rotate;
				-moz-animation-duration: 2s;
				-moz-animation-iteration-count: infinite;
				-moz-animation-timing-function: linear;*/
		/*		animation-name: rotate;
				animation-duration: 2s;
				animation-iteration-count: infinite;
				animation-timing-function: linear;*/
		display: none;
		z-index: 2000
	}
	@-webkit-keyframes spinnerRotate
	{
		from{-webkit-transform:rotate(0deg);}
		to{-webkit-transform:rotate(360deg);}
	}
	@-moz-keyframes spinnerRotate
	{
		from{-moz-transform:rotate(0deg);}
		to{-moz-transform:rotate(360deg);}
	}
	@-ms-keyframes spinnerRotate
	{
		from{-ms-transform:rotate(0deg);}
		to{-ms-transform:rotate(360deg);}
	}
	@-moz-keyframes rotate {
		from {
			-moz-transform: rotate(0deg)
		}
		to {
			-moz-transform: rotate(360deg)
		}
	}
	@keyframes rotate {
		from {
			transform: rotate(0deg)
		}
		to {
			transform: rotate(360deg)
		}
	}
	@-webkit-keyframes rotate {
		from {
			-webkit-transform: rotate(0deg)
		}
		to {
			-webkit-transform: rotate(360deg)
		}
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.login-blue{
			margin: 0 0 20px;
		}
		.btn-success {
			margin: 0;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Login</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row" id="user_login_form_div">
        <div class="col-md-7 col-sm-6 col-lg-8">
            <div class="row">
				<div class="row" id="login_success_redirect" style="display: none;">
					<div class="col-md-10">
						<div class="well background_white">
							<div class="alert alert-success">Login Successful. Please Wait...</div>
						</div>
					</div>
				</div>
                <div class="col-md-9 col-lg-8 login-form">
                    <div class="well">
                        <h2>Login to InCrew</h2>
                        <p>Please login below if you already have an account with us.</p>
                        <p class="login-msg-box"></p>
                        <form id="user_login_form" action="" method="post" role="form">
                            <div class="form-group">
                                <label for="user_login">Email</label>
                                <input name="user_login" id="user_login" type="text" class="form-control" placeholder="Email"/><span class="help-block">
									<?php
									if (isset($_SESSION['login_error']['invalid_email']) && $_SESSION['login_error']['invalid_email'] === TRUE) {
										echo 'Please enter a valid email address';
										unset($_SESSION['login_error']);
									}
									?></span>
                            </div>
                            <div class="form-group">
                                <label for="user_login_password">Password</label>
                                <input name="user_login_password" id="user_login_password" type="password" class="form-control" placeholder="Password" autocomplete="off"/>
								<span class="help-block">
									<?php
									if (isset($_SESSION['login_error']['invalid_password']) && $_SESSION['login_error']['invalid_password'] === TRUE) {
										echo 'The password you have entered is incorrect';
										unset($_SESSION['login_error']);
									}
									?></span>
                            </div>
							<?php if (isset($captcha_image)) { ?>
								<div class="form-group text-center">
									<?php echo $captcha_image; ?> &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>
								</div>
								<div class="form-group">
									<label for="user_captcha">Image Text</label>
									<input type="text" autocomplete="off" class="form-control" placeholder="Enter Image Text" name="user_captcha" id="user_captcha" maxlength="6">
								</div>
							<?php } ?>
                            <div class="pull-right">
								<div class="text-right">
									<input type="checkbox" name="login_remember" id="login_remember" value="1"/> <label for="login_remember" id="remember-me"> Remember Me</label>
								</div>
                                <div class="checkbox">
									<a href="<?php echo base_url(); ?>recover">Forgot Your Password?</a>
                                </div>
                            </div>
                            <div class="pull-left">
                                <button id="user_login_button" type="submit" class="btn btn-success">Login <i class="fa fa-plane" data-loading-text="Please Wait..."></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-lg-4"></div>
            </div>
        </div>
        <div class="col-md-5 col-sm-6 col-lg-4"> 
            <div class="login-blue">
                <h2>Do you have an account with us?</h2>
                <p>Sign up with us today by selecting the employer or candidate icon below and start applying or posting jobs. </p>
                <a href="<?php echo base_url(); ?>employee-login"> <button type="submit" class="btn btn-warning btn-lg login_overlap" id="candidate_login_link">Candidate <span class="fa fa-plane"></span></button></a>
                <a href="<?php echo base_url(); ?>employer-login" class="btn btn-warning btn-lg login_overlap">Employer <span class="fa fa-plane"></span></a>
            </div>
        </div>
		<div id="rotate-plane" style="">
			<div class="white-bg-circle">
				<img src="assets/img/road2.gif" class="img-responsive">
				<!--<img src="assets/img/plane-load.png" class="img-responsive">-->
				<h5>Loading</h5>
			</div>
		</div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/md5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/base64.min.js"></script>
<script>
										$(function () {
											$("#user_login_form").validate({
												errorElement: 'span', errorClass: 'help-block',
												rules: {
													user_login: {
														required: true
													},
													user_login_password: {
														required: true
													},
													user_captcha: {
														required: true,
														number: true,
														remote: {
															url: base_url + "auth/captcha_validate",
															type: "post"
														}
													}
												},
												messages: {
													user_login: {
														required: "Please enter a valid email address."
													},
													user_login_password: {
														required: "Please enter a valid password with a minimum of 4 characters."
													},
													user_captcha: {
														required: "Please enter the secure image in the text field",
														number: "The secure image field must contain numbers only",
														remote: "Please enter correct image text"
													}
												},
												invalidHandler: function (event, validator) {
													//show_login_error();
												},
												highlight: function (element) {
													$(element).closest('.form-group').addClass('has-error');
												},
												unhighlight: function (element) {
													$(element).closest('.form-group').removeClass('has-error');
												},
												success: function (element) {
													$(element).closest('.form-group').removeClass('has-error');
													$(element).closest('.form-group').children('span.help-block').remove();
												},
												errorPlacement: function (error, element) {
													error.appendTo(element.closest('.form-group'));
												},
												submitHandler: function (form) {
													$("#rotate-plane").css('display', 'block');
													$(".alert-danger").remove();
													$("#user_login_button").button('loading');
													$.post('', {'user_login': btoa(btoa($.trim($("#user_login").val()))), 'user_login_password': btoa(btoa(md5(md5($.trim($("#user_login_password").val()).toLowerCase())))), 'login_remember': $("#login_remember").is(':checked'), 'user_captcha': $("#user_captcha").val()}, function (data) {
														if (data === '1') {
															$(".login-form").hide();
															$("#login_success_redirect").fadeIn('fast');
															document.location.href = base_url + 'dashboard';
														} else if (/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(data)) {
															$("#user_login_form_div").hide();
															$("#login_success_redirect").fadeIn('fast');
															document.location.href = data;
														} else if (data === '-1') {
															document.location.href = '';
														} else if (data === '0') {
															show_login_error();
														} else if (data === '-2') {
															$("#user_login_password").closest('.form-group').addClass('has-error').append('<span class="help-block">The password you have entered is incorrect</span>');
														} else if (data === '-3') {
															$("#user_login").closest('.form-group').addClass('has-error').append('<span class="help-block">Please enter a valid email id.</span>');
														} else {
															bootbox.alert(data);
														}
														$("#user_login_button").button('reset');
														$("#rotate-plane").css('display', 'none');
													});
												}
											});
										});

										function show_login_error() {
											$(".login-msg-box").html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please enter a valid email and password.</div>');
											setTimeout(function () {
												$('.alert-danger').fadeOut();
											}, 3000);
										}

</script>