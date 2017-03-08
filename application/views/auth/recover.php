<style>
	.login_overlap{
		margin-top: 2px;
	}
	.alert-danger{
		color:red !important;
	}
	@media only screen and (max-width:480px) and (min-width:320px){
		.btn-success{
			width:155px;
			margin: 5px 0px;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php
						echo base_url();
						if (isset($_SERVER['HTTP_REFERER']) && str_replace(base_url(), '', $_SERVER['HTTP_REFERER']) === 'employee-login') {
							echo 'employee-login';
						} else if (isset($_SERVER['HTTP_REFERER']) && str_replace(base_url(), '', $_SERVER['HTTP_REFERER']) === 'employer-login') {
							echo 'employer-login';
						} else {
							echo 'login';
						}
						?>">Login</a></li>
                    <li class="active">Recover Your Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" id="user_login_form_div">
        <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
			<div class="well">
				<p class="login-box-msg recover-password">Recover Your Account</p><hr/>
				<div id="recover-box-msg"></div>
				<form id="forget_password_form" action="" method="post" role="form">
					<div class="form-group">
						<label>Email</label>
						<input name="email_address" id="email_address" type="text" class="form-control" placeholder="Email"/>
					</div>
					<?php if (isset($captcha_image)) { ?>
						<div class="form-group text-center">
							<?php echo $captcha_image; ?> &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>
						</div>
						<div class="form-group">
							<label>Image Text</label>
							<input type="text" autocomplete="off" class="form-control" placeholder="Image Text" name="user_captcha" id="user_captcha" maxlength="6">
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-xs-12 col-sm-9 col-md-7 col-lg-8">
							<a href="<?php echo base_url() . 'login'; ?>" id="user_recover_button_cancel" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back to Login</a>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-5 col-lg-4">
							<button id="user_recover_button" type="submit" class="btn btn-success" data-loading-text="Loading...">Submit <i class="fa fa-plane"></i></button>
						</div>
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
											$("#forget_password_form").validate({
												errorElement: 'span', errorClass: 'help-block',
												rules: {
													email_address: {
														required: true,
														email: true
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
													email_address: {
														required: "Please enter your email address",
														email: "Email must be valid"
													},
													user_captcha: {
														required: "Please enter the secure image",
														number: "The secure image field must contain numbers only",
														remote: "Please enter correct image text"
													}
												},
												invalidHandler: function (event, validator) {
													//	show_login_error();
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
													$("#user_recover_button").button('loading');
													$.post('', $("#forget_password_form").serialize(), function (data) {
														if (data === '1') {
															$("#recover-box-msg").html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>We have sent you an email with your new password.</div>');
															setTimeout(function () {
																document.location.href = base_url + 'login';
															}, 4000);
														} else if (data === '-1') {
															$("#recover-box-msg").html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email does not exist.</div>');
															setInterval(function () {
																$(".alert-danger").fadeOut();
															}, 5000);
														} else {
															$("#recover-box-msg").html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data + '</div>');
														}
														$("#user_recover_button").button('reset');
													});
												}
											});
										});

										function show_login_error() {
											$("p.login-box-msg").after('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>You have entered an invalid email.</div>');
										}
</script>