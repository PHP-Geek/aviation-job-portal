<style>
    .register-category p{
        background:#F25B1D;
        color: #fff;
        overflow: hidden;
        padding: 5px 48px;
        margin-bottom:14px;
        border:dotted 0px #000000;
        -moz-border-radius-topleft: 30px;
        -moz-border-radius-topright:0px;
        -moz-border-radius-bottomleft:0px;
        -moz-border-radius-bottomright:30px;
        -webkit-border-top-left-radius:30px;
        -webkit-border-top-right-radius:0px;
        -webkit-border-bottom-left-radius:0px;
        -webkit-border-bottom-right-radius:30px;
        border-top-left-radius:30px;
        border-top-right-radius:0px;
        border-bottom-left-radius:0px;
        border-bottom-right-radius:30px;
    }
    a {
        text-decoration: none !important;
    }
	.alert-danger {
		color: red !important;
	}
	.login-msg-box{
		font-size:16px;
	}
	#remember-me{
		font-weight: normal;
	}
	.employe-login-heading h2{
		font-size: 25px;		
	}
	.employe-login-heading p{
		font-size: 15px;		
	}
    .div-line{
		margin-bottom: 11px;
	}
	.register-category > p:hover {
		background: #ce4204 none repeat scroll 0 0;
	}
    @media only screen and (max-width:766px) and (min-width:481px){
        .div-line{
            display:none;
        }
    }
    @media only screen and (max-width:480px) and (min-width:320px){
        .div-line{
            display:none;
        }
		.register-category p {
			padding: 5px 34px;
		}
    }
	@media only screen and (max-width:1024px) and (min-width:767px) and (orientation: portrait){
        .div-line{
            display:none;
        }
    }
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="active">Candidate Register</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-lg-4">
			<div class="employe-login-heading">
				<h2>Register</h2>
				<p>Register with InCrew by selecting one of the options below to create your account.</p>
				<?php foreach ($job_type_array as $job_type) { ?>
					<a href="<?php echo base_url(); ?>register/employee/<?php echo $job_type['job_type_slug']; ?>"><div class="register-category">
							<p><span class="fa fa-plane"></span> <?php echo $job_type['job_type_name']; ?></p>
						</div></a>
				<?php } ?>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-lg-3">
			<div class="div-line">
				<img src="<?php echo base_url(); ?>assets/img/div-line.png" alt="pilot" class="img-responsive center-block"/>
			</div>
		</div>
		<div class="col-md-5 col-sm-6 col-lg-5">
			<div class="row" id="login_success_redirect" style="display: none;">
				<div class="col-md-10">
					<div class="well background_white">
						<div class="alert alert-success">Login Successful. Please Wait...</div>
					</div>
				</div>
			</div>
			<div class="login login-form">
				<h2>Login to InCrew</h2>
				<p>Please login below if you already have an account with us.</p>
				<p class="login-msg-box"></p>
				<form id="user_login_form" action="" method="post" role="form">
					<div class="form-group">
						<label for="user_login">Email</label>
						<input type="text" class="form-control" id="user_login" name="user_login" placeholder="Email" autocomplete="off">
						<span class="help-block">
							<?php
							if (isset($_SESSION['login_error']['invalid_email']) && $_SESSION['login_error']['invalid_email'] === TRUE) {
								echo 'Please enter a valid email address';
								unset($_SESSION['login_error']);
							}
							?></span>
					</div>
					<div class="form-group">
						<label for="user_login_password">Password</label>
						<input type="password" class="form-control" id="user_login_password" name="user_login_password" placeholder="Password" autocomplete="off">
						<?php
						if (isset($_SESSION['login_error']['invalid_password']) && $_SESSION['login_error']['invalid_password'] === TRUE) {
							echo 'The password you have entered is incorrect';
							unset($_SESSION['login_error']);
						}
						?>
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
                </form>
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
												number: "The secure image field must contain numbers only.",
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
													$("#user_login_password").closest('.form-group').addClass('has-error').append('<span class="help-block">The password you have entered is incorrect.</span>');
												} else if (data === '-3') {
													$("#user_login").closest('.form-group').addClass('has-error').append('<span class="help-block">Please enter a valid email id.</span>');
												} else {
													bootbox.alert(data);
												}
												$("#user_login_button").button('reset');
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
