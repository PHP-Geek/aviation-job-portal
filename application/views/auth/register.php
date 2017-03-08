<style>
    .select2-container .select2-selection--single  {
        height:34px !important;
		/*border:1px solid #ccc !important;*/
    }
	#country_code.has-error  .select2-container {
		width:100% !important;
	}
	#country_code
	{
		vertical-align:top;
		background-color:#F5F5F5;
		text-align: left;
	}
	.has-error .select2-container--default .select2-selection--single {
		border: 1px solid red !important;
		border-radius:5px;
	}
	.has-error .accept_term {
		color:#333 !important;
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
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>employee-login">Candidate Register</a></li>
                    <li class="active"><?php echo $job_type; ?> Registration</li>
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
                    <h1><span style="font-weight: 500"><?php echo $job_type; ?> Registration</span></h1>
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
                    <h2><?php echo $job_type; ?> Registration</h2>
                    <p>Please fill in the form. Once registration is completed a verification email will be sent to your email address which will allow you to login and update your profile. </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2" id="user_signup_form_div">
                <form role="form" class="form-horizontal" id="user_signup_form" method="post" action="">
                    <h4 class="col-md-offset-1">Personal Details</h4>
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
                            <input type="text" autofocus="" class="form-control" placeholder="Last Name" id="user_last_name" name="user_last_name" autocomplete="off"/>
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_address">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" placeholder="Address" name="user_address" id="user_address"></textarea>
                        </div>
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_city">City</label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="City" id="user_city" name="user_city" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="states_id">State</label>
                        <div class="col-sm-8">
                            <input type="text" autofocus="" class="form-control" placeholder="State" id="user_state" name="user_state" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="user_zipcode">Postcode</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Postcode" id="user_zipcode" name="user_zipcode" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="countries_id">Country </label>
                        <div class="col-sm-8">
                            <select class="form-control select2_register" id="countries_id" name="countries_id" data-placeholder="&nbsp;Country">
                                <option></option>
								<?php
								foreach ($country_array as $country) {
									echo '<option value="' . $country['country_id'] . '">' . $country['country_name'] . '</option>';
								}
								?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_primary_contact"  class="col-sm-4 control-label">Contact Number</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon" id="country_code" style="border:none;padding:0">
                                    <select name="user_country_code" class="select2_register" data-placeholder="&nbsp;Country Code">
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
                    <hr/>
					<h4 class="col-md-offset-1"><?php
						switch ($breadcrumb_text) {
							case 'maintenance-engineer':
								echo 'Maintenance Licenses';
								break;
							case 'air-traffic-controller':
								echo 'ATC Qualifications';
								break;
							default :
								echo $job_type . ' Qualification';
						}
						?></h4>
					<div class="spacer9"></div>
					<?php $this->load->view('templates/register/pilot'); ?>
					<?php $this->load->view('templates/register/engineer'); ?>
					<?php $this->load->view('templates/register/flight_attendant'); ?>
					<?php $this->load->view('templates/register/operation'); ?>
					<?php $this->load->view('templates/register/air_traffic_controller'); ?>
					<hr/>
					<h4 class="col-md-offset-1">Desired Career/Employment</h4>
					<div class="spacer9"></div>
					<div class="container-fluid clone_component_0">
						<div class="row">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_employment_desired_position">Desired Position</label>
								<div class="col-sm-8">
									<input type="text" name="user_employment_desired_position[]" id="user_employment_desired_position" class="form-control" value="" placeholder="Desired Position">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_positions_id">Position Type</label>
								<div class="col-sm-8">
									<select class="form-control  select2_register_multiple select2_register select2_register_multiple_position user_employment_position-other-select" id="user_positions_id" name="user_positions_id[0][]" data-placeholder="&nbsp;Position Type (may select multiple)" multiple="multiple">
										<?php foreach ($position_array as $position) { ?>
											<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group user_employment_position_other form-other-input" style="display:none">
								<label for="user_employment_position_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_employment_position_other_name[]" id="user_employment_position_other_name" class="form-control" placeholder="Other Position"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_preferred_company">Preferred Company</label>
								<div class="col-sm-8">

									<input type="text" name="user_employment_preferred_company[]" id="user_employment_preferred_company" class="form-control" placeholder="Preferred Company"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_employment_type">Employment Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_register employment_type_other" name="user_employment_type[]" id="user_employment_type" data-placeholder="&nbsp;Type of Employment">
										<option></option>
										<?php foreach ($user_employment_type_array as $user_employment_type) {
											?>
											<option value="<?php echo $user_employment_type; ?>"><?php echo $user_employment_type; ?></option>
										<?php }
										?>
									</select>
								</div>
							</div>
							<div class="form-group" style="display:none">
								<label class="col-sm-4 control-label" for="user_employment_type_other">Other Employment Type</label>
								<div class="col-sm-8">
									<input type="text" name="user_employment_type_other[]" id="user_employment_type_other" class="form-control" placeholder="Other Employment Type"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_employment_willing_to_relocate">Willing to Locate</label>
								<div class="col-sm-8">
									<select name="user_employment_willing_to_relocate[]" id="user_employment_willing_to_relocate" data-placeholder="&nbsp;Willing to Locate" class="form-control select2_register" style="width:100%">
										<option></option>
										<option value="1">Yes</option>
										<option value="2">No</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_employment_location">Locations</label>
								<div class="col-sm-8">
									<select name="user_employment_location[0][]" class="form-control select2_register_multiple select2_register select2_register_multiple_location" data-placeholder="&nbsp;Preferred Location(s)" style="width:100%" id="user_employment_location" multiple="multiple">
										<?php foreach ($country_array as $country) { ?>
											<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
										<?php }
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_employment_availability">Availability/Notice Period</label>
								<div class="col-sm-8">
									<select name="user_employment_availability[]" class="form-control select2_register user-employment-notice-period" style="width:100%" data-placeholder="&nbsp;Availability/Notice Period" id="user_employment_availability">
										<option></option>
										<?php foreach ($notice_period_array as $notice_period) {
											?>
											<option value="<?php echo $notice_period; ?>"><?php echo $notice_period; ?></option><?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group" style="display: none">
								<label class="col-sm-4 control-label" for="user_employment_availability">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_employment_availability_other" id="user_employment_availability_other" placeholder="Other" class="form-control edit_profile_date_picker"/>
								</div>
							</div>
						</div>
						<div class="form-group text-right">
							<a class="clone_component_button" href="javascript:;" onclick="clone_component(this, 0);"><i class="fa fa-plus-circle"></i> Add Another Desired Position</a>
							<a class="remove_component_button" href="javascript:;" onclick="remove_component(this, 0);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
					<hr/>
					<?php if (isset($captcha_image)) { ?>
						<div class="form-group text-center">
							<div class="col-md-offset-3 col-sm-offset-4">
								<?php echo $captcha_image; ?> &nbsp; <a href="javascript:;" onclick="refresh_captcha(this);"><i class="fa fa-refresh"></i></a>
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
								<label>
									<input type="checkbox" value="1" id="subscribe_newsletters" name="subscribe_newsletters">I want to subscribe newsletters.
								</label>
							</div>
						</div>
						<div class="col-sm-8 col-sm-offset-4">
							<div class="checkbox">
								<label class="accept_term">
									<input type="checkbox" value="1" id="terms_accepted" name="terms_accepted">I accept the <a href="<?php echo base_url(); ?>employee-terms-and-conditions" target="_blank">terms and conditions.</a>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-6">
							<button id="user_signup_button" class="btn btn-success" data-loading-text="Loading......." type="submit">Submit <i class="fa fa-plane"></i></button>
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
									function add_employment_type_other() {
										$(".employment_type_other").on('change', function () {
											if ($(this).val() === 'Other') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										})
									}
									function add_notice_period_other() {
										$(".user-employment-notice-period").on('change', function () {
											$("#user_employment_availability_other").val('');
											if ($(this).val() === 'Other') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
									}


									function add_user_employment_position_other() {
										$(".user_employment_position-other-select").on('change', function () {
											$(".user_employment_position-other-select option").each(function () {
												if ($(this).is(':selected')) {
													if ($(this).val() === '0') {
														$(this).closest('.form-group').next('div').show();
													} else {
														$(this).closest('.form-group').next('div').hide();
													}
												} else {
													$(this).closest('.form-group').next('div').hide();
												}
											});
										});
									}
									$(function () {
										add_user_employment_position_other();
										add_notice_period_other();
										add_employment_type_other();
										$(".select2_register").select2({
											allowClear: true
										});
										$("#user_signup_form").validate({
											errorElement: 'span',
											errorClass: 'help-block pull-right',
											focusInvalid: true, ignore: null,
											rules: {
												user_first_name: {
													required: true,
													alpha: true
												},
												user_last_name: {
													required: true,
													alpha: true
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
												user_primary_contact: {
													number: true,
													minlength: 4
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
												user_first_name: {
													required: "Please enter your first name",
													alpha: "First name must contain only alphabets and spaces"
												},
												user_last_name: {
													required: "Please enter your last name",
													alpha: "Last name must contain only alphabets and spaces"
												},
												user_email: {
													required: "Please enter your email",
													email: "Email must be valid",
													remote: "Email already in use."
												},
												user_password: {
													required: "Please enter a password that is at least 4 characters long",
													minlength: "Please enter a password that is at least 4 characters long"
												},
												user_confirm_password: {
													required: "Please enter your password again",
													equalTo: "Password's do not match. Please correct"
												},
												user_primary_contact: {
													number: "Contact number must be valid",
													minlength: "Contact number must have atleast 4 digits"
												},
												user_captcha: {
													required: "Please complete the image text",
													remote: "Please enter correct image text"
												},
												terms_accepted: {
													required: "Please accept the terms and conditions"
												}
											},
//											invalidHandler: function (event, validator) {
//												//show_signup_error();
//											},
											highlight: function (element) {
												$(element).closest('.form-group div').addClass('has-error');
											},
											unhighlight: function (element) {
												$(element).closest('.form-group div').removeClass('has-error');
											},
											success: function (element) {
												$(element).closest('.form-group div').removeClass('has-error');
												$(element).closest('.form-group div').children('span.help-block').remove();
											},
											errorPlacement: function (error, element) {
												error.appendTo(element.closest('.form-group div'));
											},
											submitHandler: function (form) {
												$("#user_signup_button").button("loading");
												$.post('', $("#user_signup_form").serialize(), function (data) {
													if (data === '1') {
														bootbox.alert("You have registered successfully. A verification link has been sent to your registered email address. Please verify your email address and complete your profile to be considered for upcoming roles.", function () {
															document.location.href = base_url + 'edit-profile';
														});
													} else if (data === '0') {
														bootbox.alert("Error submitting records");
													} else {
														bootbox.alert(data);
													}
													$("#user_signup_button").button("reset");
												});
											}
										});
									});
									$('select').change(function () {
										$("#user_signup_form").validate().element($(this));
									});
									$.validator.addMethod("alpha", function (value, element) {
										return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
									});
									function show_signup_error() {
										$("#user_signup_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
										setTimeout(function () {
											$('.alert-danger').fadeOut();
										}, 2000);
									}
									function clone_component(t, count) {
										var tr = $(t).closest('.clone_component_' + count);
										tr.find('select').each(function (i, o) {
											$(o).select2('destroy');
										});
										var clone = tr.clone();
										clone.find('input,select').val('');
										tr.after(clone);
										$('select').select2({allowClear: true});
										if ($('.clone_component_' + count).length !== 1) {
											$('.remove_component_button').show();
										}
										$(t).hide();
										handle_multiselect(count);
									}

									function remove_component(t, count) {
										if ($('.clone_component_' + count).length !== 1) {
											$(t).closest('.clone_component_' + count).remove();
											if ($('.clone_component_' + count).length === 1) {
												$('.remove_component_button').hide();
											}
										} else {
											$('.remove_component_button').hide();
										}
										$('.clone_component_button').eq(($('.clone_component_' + count).length - 1)).show();
										handle_multiselect(count);
									}

									function handle_multiselect(count) {
										if (count == '0') {
											$('.select2_register_multiple_location').each(function (i, v) {
												$(v).attr('name', 'user_employment_location[' + i + '][]');
											});
											$('.select2_register_multiple_position').each(function (i, v) {
												$(v).attr('name', 'user_positions_id[' + i + '][]');
											});
											add_user_employment_position_other();
											add_notice_period_other();
											add_employment_type_other();
										}
										if (count == '2') {
											add_aircraft_rating_other();
											$('.select2_register_multiple_coverage').each(function (i, v) {
												$(v).attr('name', 'user_aircraft_rating_coverage[' + i + '][]');
											});
											$('.aircraft_rating_is_rating_box').each(function (i, v) {
												$(v).attr('value', i);
											});
										}
									}
</script>

