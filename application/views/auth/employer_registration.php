<style>
    .well{
        border:1px dotted #c3c3c3;
    }
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.has-error .select2-container--default .select2-selection--single {
		border: 1px solid red !important;
		border-radius:5px;
	}
	#country_code
	{
		vertical-align:top;
		background-color:#F5F5F5;
		text-align: left;
	}
	.has-error #user_primary_contact
	{
		border-radius:5px;
	}
	.has-error .accept_term {
		color:#333 !important;
	}
	.register h3 {
		font-size: 20px;
	}
	.checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] {
		margin-left: -21px;
		margin-top: 1px;
		position: absolute;
	}
	@media only screen and (max-width:360px) and (min-width:320px) {
		#country_code
		{
			float:left;
			width:100%;
		}
		#country_code .select2-container--default
		{
			text-align:left;
			width:100% !important;
		}
		.register {
			margin-bottom: 0px;
		}
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>employer-login">Employer Register</a></li>
                    <li class="active"><?php echo $role; ?> Registration</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="little-banner-text">
                    <h1><span style="font-weight: 500"><?php echo $role; ?> Registration</span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="well spaceup-20">
        <div class="row">
            <div class="col-md-12 col-lg-12">
				<div class="register">
					<h3><?php echo $role; ?> Registration</h3>
					<p>Aviation employers and recruiters please complete the form below to register and post jobs with InCrew. Registration and posting of jobs are free.</p>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2" id="user_signup_form_div">
                <form role="form" class="form-horizontal" id="employer_signup_form" method="post" action="">
					<div class="spacer9"></div>
					<h4>Company Details</h4>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_business_name">Company Name <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="Company Name" id="user_business_name" name="user_business_name" autocomplete="off">
                        </div>
                    </div>
					<hr/>
                    <h4>Complete Company Physical Address</h4>
					<div class="spacer9"></div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_address">Street <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="Company Address" id="user_address" name="user_address" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_city">City/Town <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="City/Town" id="user_city" name="user_city" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="states_id">State </label>
                        <div class="col-sm-8">
							<input type="text" autofocus="" class="form-control" placeholder="State" id="user_state" name="user_state" autocomplete="off">
						</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_zipcode">PostCode/Zipcode </label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="Postcode/Zipcode" id="user_zipcode" name="user_zipcode" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="countries_id">Country <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control select2_register_employer" id="countries_id" name="countries_id" data-placeholder="&nbsp;Country">
                                <option></option>
								<?php foreach ($country_array as $country) { ?>
									<option value="<?php echo $country['country_id']; ?>">
										<?php echo $country['country_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_website_address">Website URL </label>
						<div class="col-sm-8">
							<input type="text" autofocus="" class="form-control" placeholder="www.example.com/" id="user_website_address" name="user_website_address">
						</div>
					</div>
					<hr/>
					<h4>Create Your Account Login Information</h4>
					<div class="spacer9"></div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_email">Email <span class="required">*</span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" placeholder="Email" id="user_email" name="user_email" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_password">Password <span class="required">*</span></label>
						<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="Password" id="user_password" name="user_password" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_confirm_password">Confirm Password <span class="required">*</span></label>
						<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="Confirm Password" id="user_confirm_password" name="user_confirm_password" autocomplete="off">
						</div>
					</div>
					<hr>
					<h4>Contact Person for the Account</h4>
					<div class="spacer9"></div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_first_name">First Name <span class="required">*</span></label>
						<div class="col-sm-8">
							<input type="text" autofocus="" class="form-control" placeholder="First Name" id="user_first_name" name="user_first_name" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_last_name">Last Name <span class="required">*</span></label>
						<div class="col-sm-8">
							<input type="text" autofocus="" class="form-control" placeholder="Last Name" id="user_last_name" name="user_last_name" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="user_primary_contact"  class="col-sm-4 control-label">Contact Number <span class="required">*</span></label>
						<div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon" id="country_code" style="border:none;padding:0">
                                    <select name="user_country_code" class="select2_register_employer" data-placeholder="&nbsp;Country Code">
										<option></option>
										<?php
										foreach ($country_array as $country) {
											if ($country['country_code'] != '') {
												echo '<option value="' . $country['country_code'] . '">' . $country['country_name'] . '(' . $country['country_code'] . ')' . '</option>';
											}
										}
										?>
                                    </select>
                                </div>
                                <input type="text" class="form-control" id="user_primary_contact" name="user_primary_contact" placeholder="Contact Number">
                            </div>
                        </div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_skype_id">Skype</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Skype Name" id="user_skype_id" name="user_skype_id" autocomplete="off">
						</div>
					</div><!-- /.form-group -->
					<hr/>
					<?php if (isset($captcha_image)) { ?>
						<div class="form-group text-center">
							<div class="col-md-offset-3 col-sm-offset-4">
								<?php echo $captcha_image; ?>  &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_captcha">Image Text <span class="required">*</span></label>
							<div class="col-sm-8">
								<input type="text" autofocus="" class="form-control" placeholder="Image Text" id="user_captcha" name="user_captcha" autocomplete="off">
							</div>
						</div> <?php } ?>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <div class="checkbox">
                                <label class="accept_term">
                                    <input type="checkbox" value="1" id="terms_accepted" name="terms_accepted">I accept the <a href="<?php echo base_url(); ?>employer-terms-and-conditions" target="_blank">terms and conditions.</a>
                                </label>
                            </div>
                        </div>
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-6">
                            <button id="employer_signup_button" class="btn btn-success" data-loading-text="Loading......." type="submit">Submit <i class="fa fa-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
									$(function () {
										$(".select2_register_employer").select2({allowClear: true});
										$("#employer_signup_form").validate({
											errorElement: 'span',
											errorClass: 'help-block pull-right',
											focusInvalid: true,
											ignore: null,
											rules: {
												user_business_name: {
													required: true
												},
												user_address: {
													required: true
												},
												user_city: {
													required: true,
													alpha: true
												},
												countries_id: {
													required: true
												},
												user_website_address: {
													complete_url: true
												},
												user_email: {
													required: true,
													email: true,
													remote: {
														url: base_url + "auth/validate_email",
														type: "post"
													}
												},
												user_password: {
													required: true,
													minlength: 4
												},
												user_confirm_password: {
													required: true,
													equalTo: "#user_password"
												},
												user_first_name: {
													required: true,
													alpha: true
												},
												user_last_name: {
													required: true,
													alpha: true
												},
												user_country_code: {
													required: true
												},
												user_primary_contact: {
													required: true,
													number: true,
												},
												user_captcha: {
													required: true,
													remote: {
														url: base_url + "auth/captcha_validate",
														type: "post"
													}
												},
												terms_accepted: {
													required: true
												}
											},
											messages: {
												user_business_name: {
													required: "Please enter your company name",
												},
												user_address: {
													required: "Please enter your address"
												},
												user_city: {
													required: "Please enter your city",
													alpha: "City name must be valid"
												},
												countries_id: {
													required: "Please select your country"
												},
												user_website_address: {
													complete_url: "Website url must be valid"
												},
												user_email: {
													required: "Please enter your email",
													email: "Email must be valid",
													remote: "Email already in use"
												},
												user_password: {
													required: "Please enter a password that is at least 4 characters long",
													minlength: "Please enter a password that is at least 4 characters long"
												},
												user_confirm_password: {
													required: "Please enter your password again",
													equalTo: "Password’s do not match, Please correct"
												},
												user_first_name: {
													required: "Please enter first name of contact person",
													alpha: "First name must contain only alphabets or spaces"
												},
												user_last_name: {
													required: "Please enter last name of contact person",
													alpha: "Last name must contain only alphabets or spaces"
												},
												user_country_code: {
													required: "Please select country code"
												},
												user_primary_contact: {
													required: "&nbsp;Please enter your contact number",
													number: "Contact number must be valid"
												},
												user_captcha: {
													required: "Please complete the image text",
													remote: "Please enter correct image text"
												},
												terms_accepted: {
													required: "Please accept the terms and conditions"
												}
											},
											//			invalidHandler: function (event, validator) {
											//				show_signup_error();
											// 		},
											highlight: function (element) {
												$(element).closest('.form-group div').addClass('has-error');
											},
											unhighlight: function (element) {
												$(element).closest('.form-group div').removeClass('has-error');
											},
											success: function (element) {
												$(element).closest('.form-group div').removeClass('has-error');
												$(element).closest('.form-group div').children('span.help-block').remove();
											}, errorPlacement: function (error, element) {
												error.appendTo(element.closest('.form-group div'));
											},
											submitHandler: function (form) {
												$("#employer_signup_button").button("loading");
												$.post('', $("#employer_signup_form").serialize(), function (data) {
													if (data === '1') {
														bootbox.alert("You have registered successfully. A verification link has been sent to your registered email address. Please verify your email and complete your profile to post jobs.", function () {
															document.location.href = base_url + 'user/employer_edit_profile';
														});
													} else if (data === '0') {
														bootbox.alert("Error submitting records");
													} else {
														bootbox.alert(data);
													}
													$("#employer_signup_button").button("reset");
												});
											}
										});
									});
									$.validator.addMethod("alpha", function (value, element) {
										return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
									});
									$('select').change(function () {
										$("#employer_signup_form").validate().element($(this));
									});
									jQuery.validator.addMethod("complete_url", function (val, elem) {
										if (val.length == 0) {
											return true;
										}
										if (!/^(https?|ftp):\/\//i.test(val)) {
											val = 'http://' + val; // set both the value
											$(elem).val(val); // also update the form element
										}
										return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
									});
									function show_signup_error() {
										$("#employer_signup_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
										setTimeout(function () {
											$('.alert-danger').fadeOut();
										}, 2000);
									}
</script>

