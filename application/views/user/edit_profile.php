<style>
    .little-banner{
        margin-bottom: 22px;
    }
    .footer{
        margin-top:22px;
    }
    .has-error .select2-container--default .select2-selection--single {
        border: 1px solid red !important;
        border-radius:5px;
    }
    .select2-container .select2-selection--single  {
        height:34px !important;
        border:1px solid #ccc !important;
    }
    .help-block{
        color:red !important;
    }
    .btn-success{
        width:164px !important;
    }
    #country_code
    {
        vertical-align:top;
        background-color:#F5F5F5;
        text-align:left;
    }
    .has-error #user_primary_contact
    {
        border-radius:5px;
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
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Edit Profile</li>
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
                    <h1><span style="font-weight: 500">Edit Profile</span></h1>
                    <p>Please complete the form below to update your profile and start applying for the best opportunities.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
			<?php
			if ($this->session->flashdata('profile_complete_warning') !== '' && $this->session->flashdata('profile_complete_warning') !== null) {
				echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $this->session->flashdata('profile_complete_warning') . '</div>';
			}
			?>

        </div>
    </div>
    <form id="edit_profile_form" method="post" action="" class="form-horizontal well spaceup-20">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <h4>Please complete your personal information, work experience and qualifications in the fields below.</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
                <div class="register">
                    <h4>Personal</h4>
                    <div class="form-group">
                        <label for="user_first_name" class="col-sm-4 control-label">First Name<span class="required">*</span></label>
                        <div class="col-sm-8 place-error">
                            <input type="text" class="form-control" id="user_first_name" name="user_first_name" placeholder="First Name" value="<?php echo $user_details_array['user_first_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_last_name" class="col-sm-4 control-label">Last Name<span class="required">*</span></label>
                        <div class="col-sm-8 place-error">
                            <input type="text" id="user_last_name" class="form-control" name="user_last_name" placeholder="Last Name" value="<?php echo $user_details_array['user_last_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_gender" class="col-sm-4 control-label">Gender<span class="required">*</span></label>
                        <div class="col-sm-8 place-error">
                            <input type="radio" name="user_gender" id="user_gender" value="1" <?php echo $user_details_array['user_gender'] === '1' ? 'checked="checked"' : ''; ?>/> Male
                            <input type="radio" name="user_gender" id="user_gender" value="2" <?php echo $user_details_array['user_gender'] === '2' ? 'checked="checked"' : ''; ?>/> Female
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Birth<span class="required">*</span></label>
                        <div class="col-sm-8 place-error">
                            <span class="input-group date edit_profile_date_picker">
                                <input type="text" id="user_dob" name="user_dob" class="form-control" placeholder="Date of Birth" value="<?php echo $user_details_array['user_dob'] != '0000-00-00' ? date('d/m/Y', strtotime($user_details_array['user_dob'])) : ''; ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="col-sm-4 control-label">Email<span class="required">*</span></label>
                        <div class="col-sm-8 place-error">
                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $user_details_array['user_email']; ?>" placeholder="Email" readonly="readonly"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_address" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-8 place-error">
                            <textarea class="form-control" rows="3" placeholder="Address" name="user_address" id="user_address"><?php echo $user_details_array['user_address'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_city" class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" name="user_city" id="user_city" placeholder="City" value="<?php echo $user_details_array['user_city']; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_city" class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" name="user_state" id="user_state" placeholder="State" value="<?php echo $user_details_array['user_state']; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_city" class="col-sm-4 control-label">Post Code</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" name="user_zipcode" id="user_zipcode" placeholder="Postcode" value="<?php echo $user_details_array['user_zipcode']; ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="countries_id" class="col-sm-4 control-label">Country</label>
                        <div class="col-sm-8 place-error">
                            <select name="countries_id" class="form-control select2_edit_profile" data-placeholder="Country">
                                <option></option>
								<?php
								foreach ($country_array as $country) {
									?>
									<option <?php
									if ($country['country_id'] === $user_details_array['countries_id']) {
										echo 'selected="selected"';
									}
									?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
										<?php
									}
									?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_primary_contact_number" class="col-sm-4 control-label">Contact Number</label>
                        <div class="col-sm-8 place-error">
                            <div class="input-group">
                                <div class="input-group-addon" id="country_code" style="border:none;padding:0">
                                    <select name="user_country_code" class="select2_edit_profile" data-placeholder="Country Code">
                                        <option></option>
										<?php
										foreach ($country_array as $country) {
											if ($country['country_code'] != '') {
												?>
												<option <?php
												if ($user_details_array['user_country_code'] === $country['country_code']) {
													echo 'selected="selected"';
												}
												?> value="<?php echo $country['country_code']; ?>"><?php echo $country['country_name'] . '(' . $country['country_code'] . ')'; ?></option>
													<?php
												}
											}
											?>
                                    </select>
                                </div>
                                <input type="text" class="form-control" id="user_primary_contact" name="user_primary_contact" placeholder="Contact Number" value="<?php echo $user_details_array['user_primary_contact']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_skype_id" class="col-sm-4 control-label">Skype Name</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" id="user_skype_id" name="user_skype_id" value="<?php echo $user_details_array['user_skype_id']; ?>" class="form-control" placeholder="Skype Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_skype_id" class="col-sm-4 control-label">LinkedIn</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" id="user_linkedin_id" name="user_linkedin_id" value="<?php echo $user_details_array['user_linkedin_id']; ?>" class="form-control" placeholder="LinkedIn"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
		<?php
		$this->load->view('templates/edit_profile/qualification');
		$this->load->view('templates/edit_profile/user_experiences');
		$this->load->view('templates/edit_profile/license');
		$this->load->view('templates/edit_profile/aircraft_ratings');
		$this->load->view('templates/edit_profile/engineer_aircraft_ratings');
		?>		<?php
		$this->load->view('templates/edit_profile/validation');
		$this->load->view('templates/edit_profile/training_courses');
		$this->load->view('templates/edit_profile/area_experience');
		$this->load->view('templates/edit_profile/medical');
		?>
		<?php $this->load->view('templates/edit_profile/passport'); ?>
		<?php $this->load->view('templates/edit_profile/visa'); ?>
		<?php $this->load->view('templates/edit_profile/previous_employment'); ?>
		<?php // $this->load->view('templates/edit_profile/pilot'); ?>
		<?php $this->load->view('templates/edit_profile/references'); ?>
		<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot') { ?>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
					<h4 style="display:inline">Pilot Qualifications
						<small> ( Please only fill out if you want to utilize these
							skills.)</small></h4>
				</div>
			</div>
			<div class="spacer9"></div>
			<div class="spacer9"></div>
			<?php if (count($pilot_medical_array) === 0 && count($user_pilot_license_array) === 0 && count($pilot_flight_time_array) === 0 && count($user_area_experience_array) === 0 && count($user_pilot_aircraft_rating_array) === 0 && count($user_retired_pilot_array) === 0) { ?>
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
						<div class="text-right">
							<a class="" href="javascript:;" id="show_pilot_qualification1"><i class="fa fa-plus-circle"></i> Add Pilot Qualification</a>
						</div>
					</div>
				</div>
				<div class="spacer9"></div>
				<?php
			}
		}
		?>
		<?php $this->load->view('templates/edit_profile/retired_pilot'); ?>
		<?php $this->load->view('templates/edit_profile/pilot_license'); ?>
		<?php $this->load->view('templates/edit_profile/pilot_aircraft_ratings'); ?>
		<?php $this->load->view('templates/edit_profile/pilot_area_experience'); ?>
		<?php $this->load->view('templates/edit_profile/pilot_flight_time'); ?>
		<?php $this->load->view('templates/edit_profile/pilot_medical_certificate'); ?>
		<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'maintenance-engineer') { ?>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
					<h4 style="display:inline">Maintenance Licenses
						<small> ( Please only fill out if you want to utilize these
							skills.)</small></h4>
				</div>
			</div>
			<div class="spacer9"></div>
			<div class="spacer9"></div>
			<?php if (count($user_me_license_array) === 0 && count($user_me_aircraft_rating_array) === 0) { ?>
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
						<div class="text-right">
							<a class="" href="javascript:;" id="show_me_license"><i class="fa fa-plus-circle"></i> Add a Maintenance License</a>
						</div>
					</div>
				</div>
				<div class="spacer9"></div>
				<div class="spacer9"></div>
				<?php
			}
		}
		?>
		<?php $this->load->view('templates/edit_profile/other_skills_me_licenses'); ?>
		<?php $this->load->view('templates/edit_profile/other_skills_aircraft_ratings'); ?>
		<?php $this->load->view('templates/edit_profile/other_skills_management_experience'); ?>
		<?php $this->load->view('templates/edit_profile/desired_employment'); ?>
        <div class="row" id="user_upload_div">
            <div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
                <h4>Resume and Photo</h4>
                <div class="register">
					<div class="row">
						<div class="col-sm-offset-2 col-md-offset-3 col-xs-offset-2">
							<div class="form-group" id="resume_upload_container">
								<a title="upload resume" id="resume_uploader" href="javascript:;" class="btn btn-upload"><i class="fa fa-plus"></i> Upload Resume</a>
								<label for="resume">Upload/Change Resume (pdf,doc 25MB max )</label>
								<input type="hidden" name="user_resume" id="user_resume" value="<?php echo $user_details_array['user_resume']; ?>" class="form-control">
								<input type="hidden" name="user_resume_original_file" id="user_resume_original_file" value="<?php echo $user_details_array['user_resume_original_file']; ?>"/>
								<div id="user_resume_div" class="text-center">
									<?php if (is_file(FCPATH . 'uploads/users/resumes' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_resume'])) { ?>
										<div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove();
												remove_resume();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
											<a href="<?php echo base_url() . 'uploads/users/resumes' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_resume']; ?>" target="_blank" title="Resume File"><i class="fa <?php
												$file_extension = pathinfo($user_details_array['user_resume'], PATHINFO_EXTENSION);
												switch ($file_extension) {
													case 'pdf':
														echo 'fa-file-pdf-o';
														break;
													case 'doc':
													case 'docx':
														echo 'fa-file-word-o';
														break;
													default :
														echo 'fa-file-word-o';
												}
												?> fa-3x"></i></a><br/>
											<span><?php echo $user_details_array['user_resume_original_file']; ?></span>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <hr/>
					<div class="row">
						<div class="col-sm-offset-2 col-md-offset-3 col-xs-offset-2">
							<div class="form-group" id="photo_upload_container">
								<a title="upload photo" id="photo_uploader" href="javascript:;" class="btn btn-upload"><i class="fa fa-plus"></i> Upload Photo</a>
								<label for="photo">Upload/Change Profile Image (jpg,png 10MB max )</label>
								<input type="hidden" name="user_profile_image" id="user_profile_image" value="<?php echo $user_details_array['user_profile_image']; ?>"/>
								<input type="hidden" name="user_profile_image_original_name" id="user_profile_image_original_name" value="<?php echo $user_details_array['user_profile_image_original_name']; ?>"/>
								<div id="user_image_div" class="text-center">
									<?php if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_image'])) { ?>
										<div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove();
												remove_image();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
											<img src="<?php echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_image']; ?>" style="width:57px;height:57px"><br/>
											<span><?php echo $user_details_array['user_profile_image_original_name']; ?></span>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
                    <hr/>
                    <div class="form-group">
                        <label for="Subject" class="control-label col-sm-4">ADDITIONAL INFORMATION</label>
                        <div class="col-sm-8 place-error">
                            <textarea class="form-control" rows="3" placeholder="Additional Information" id="user_descripton" name="user_description"><?php echo str_replace(array('<br>', '<br/>', '<br />'), '', $user_details_array['user_description']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_find_us" class="control-label col-sm-4">How did you find us?</label>
                        <div class="col-sm-8 place-error">
                            <input type="text" class="form-control" id="user_find_us" name="user_find_us" placeholder="How did you find us?" value="<?php echo $user_details_array['user_find_us']; ?>">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
						<div class="text-center">
							<button class="btn btn-warning " type="submit" id="update_profile_button"  data-loading-text="Please wait.....">Submit <span class="fa fa-plane"></span></button>
						</div>
                    </div>
                </div>
            </div>	
        </div>
</div>
</form>
</div>
<div id="current_timestamp" style="display:none"></div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
										$(function () {
<?php if (count($user_me_license_array) === 0 && count($user_me_aircraft_rating_array) === 0) { ?>
												setTimeout(function () {
													$("#me_license_div").hide();
													$("#me_rating_div").hide();
												}, 100);
<?php } ?>
<?php if (count($pilot_medical_array) === 0 && count($user_pilot_license_array) === 0 && count($pilot_flight_time_array) === 0 && count($user_area_experience_array) === 0 && count($user_pilot_aircraft_rating_array) === 0 && count($user_retired_pilot_array) === 0) { ?>
												setTimeout(function () {
													$("#pilot_medical_div").hide();
													$("#pilot_license_div_1").hide();
													$("#pilot_flight_time_div").hide();
													$("#pilot_area_experience_div").hide();
													$("#pilot_rating_div").hide();
													$("#retired_pilot_div").hide();
												}, 100);
<?php } ?>

											$('select,input[type=checkbox],input[type=radio],.edit_profile_date_picker').on('change', function () {
												set_timestamp();
											});
											$('#edit_profile_form').keypress(function () {
												set_timestamp();
											});
										});
										window.onbeforeunload = function () {
											if ($("#current_timestamp").html() !== '') {
												return "Leaving the page will result reset of all unsaved changes.";
											}
										}
										$("#show_me_license").click(function () {
											$("#me_license_div").show();
											$("#me_rating_div").show();
											$(this).hide();
										});
										$("#show_pilot_qualification1").click(function () {
											$("#pilot_medical_div").show();
											$("#pilot_license_div_1").show();
											$("#pilot_flight_time_div").show();
											$("#pilot_area_experience_div").show();
											$("#pilot_rating_div").show();
											$("#retired_pilot_div").show();
											$("#show_pilot_qualification1").hide();
										});
										$(".edit_profile_date_picker").datepicker({
											clearBtn: true,
											format: 'dd/mm/yyyy',
											autoclose: true,
											startView: 2, todayBtn: "linked"
										});
										$("select").select2({
											allowClear: true
										});
										$("#edit_profile_form").validate({
											errorElement: 'span',
											errorClass: 'help-block pull-right',
											focusInvalid: true, ignore: null, rules: {
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
													email: true
												},
												user_dob: {
													required: true
												},
												user_gender: {
													required: true
												},
												user_primary_contact: {
													number: true,
													minlength: 4
												},
											},
											messages: {
												user_first_name: {
													required: "Please enter your first name",
													alpha: "First Name must contain only alphabets and spaces"
												},
												user_last_name: {
													required: "Please enter your last name",
													alpha: "Last Name must contain only alphabets and spaces"
												},
												user_address: {
													required: "Please enter your address"
												},
												user_email: {
													required: "Please enter your email",
													email: "Email be must be valid"
												},
												user_dob: {
													required: "Please enter date of birth"
												},
												user_gender: {
													required: "Please select gender"
												},
												user_primary_contact: {
													number: "Contact number must be valid",
													minlength: "Contact number must have atleast 4 digits"
												},
											},
											//		invalidHandler: function (event, validator) {
											////show_signup_error();
											//		},
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
												bootbox.confirm("Save Changes?", function (result) {
													if (result) {
														$("#update_profile_button").button("loading");
														$.post('', $("#edit_profile_form").serialize(), function (data) {
															if (data === '1') {
																$("#current_timestamp").html('');
																bootbox.alert("Profile has been updated successfully.", function () {
																	document.location.href = base_url + 'dashboard';
																});
															} else if (data === '0') {
																bootbox.alert("Error submitting records");
															} else {
																bootbox.alert(data);
															}
															$("#update_profile_button").button("reset");
														});
													}
												});
											}
										});
										$('select').change(function () {
											$("#edit_profile_form").validate().element($(this));
										});
										$.validator.addMethod("alpha", function (value, element) {
											return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
										});
										function clone_component(t, n) {
											var tr = $(t).closest('.clone_component_' + n);
											tr.find('select').each(function (i, o) {
												$(o).select2('destroy');
											});
											var clone = tr.clone();
											clone.find('input,select').val('');
											clone.find('input[type=checkbox]').attr('checked', false);
											clone.find('.show_file_div').empty();
											clone.find('.form-other-input').hide();
											tr.after(clone);
											$('select').select2({allowClear: true});
											$('.edit_profile_date_picker').datepicker({
												clearBtn: true,
												format: 'dd/mm/yyyy',
												autoclose: true,
												startView: 2, todayBtn: "linked"
											});
											if ($('.clone_component_' + n).length !== 1) {
												$('.remove_component_button_' + n).show();
											}
											$(t).hide();
											handle_multiselect(n);
											handle_multiupload(n);
										}

										function remove_component(t, n) {
											if ($('.clone_component_' + n).length !== 1) {
												$(t).closest('.clone_component_' + n).remove();
												if ($('.clone_component_' + n).length === 1) {
													$('.remove_component_button_' + n).hide();
												}
											} else {
												$('.remove_component_button_' + n).hide();
											}
											$('.clone_component_button_' + n).eq(($('.clone_component_' + n).length - 1)).show();
											handle_multiselect(n);
											handle_multiupload(n);
										}

										function handle_multiselect(n) {
											if (n == '12') {
												add_references_other();
											}
											if (n == '2') {
												add_other_validation_aircraft();
												add_other_validation_license_type();
											}
											if (n == '3') {
												add_medicals_other();
											}
											if (n == '8') {
												$('.select2_edit_profile_multiple_position').each(function (i, v) {
													$(v).attr('name', 'user_employment_positions_id[' + i + '][]');
												});
												$('.select2_edit_profile_multiple_location').each(function (i, v) {
													$(v).attr('name', 'user_employment_location[' + i + '][]');
												});
												add_user_employment_position_other();
												add_notice_period_other();
												add_employment_type_other();
											}
											if (n == '7') {
												add_previous_employment_other();
											}
											if (n == '1') {
												$('.select2_edit_profile_multiple_license_position').each(function (i, v) {
													$(v).attr('name', 'user_license_positions_id[' + i + '][]');
												});
												$('.user_license_english_proficient_box').each(function (i, v) {
													$(v).attr('value', i);
												});
												add_license_authority_other();
												add_license_type_other();
												add_approval_rating_other();
												add_position_other();
												add_license_position_other();
											}
											if (n == '13') {
												$('.select2_edit_profile_multiple_license_authority').each(function (i, v) {
													$(v).attr('name', 'user_aircraft_rating_license_authorities_id[' + i + '][]');
												});
												$('.user_aircraft_rating_is_current_box').each(function (i, v) {
													$(v).attr('value', i);
												});
												add_aircraft_rating_aircraft_type_other();
												add_aircraft_rating_license_authority_other();
											}
											if (n == '14') {
												add_me_license_authority_other();
												add_me_license_type_other();
											}
											if (n == '15') {
												$('.select2_edit_profile_multiple_coverage').each(function (i, v) {
													$(v).attr('name', 'user_aircraft_rating_coverage[' + i + '][]');
												});
												$('.user_aircraft_rating_is_current_box').each(function (i, v) {
													$(v).attr('value', i);
												});
												add_aircraft_rating_other();
												add_aircraft_rating_coverage_other();
											}
											if (n == '16') {
												$('.select2_edit_profile_me_multiple_coverage').each(function (i, v) {
													$(v).attr('name', 'user_me_aircraft_rating_coverage[' + i + '][]');
												});
												add_me_aircraft_rating_other();
												add_me_aircraft_rating_coverage_other();
											}
											if (n == '17') {
												add_pilot_license_authority_other();
												add_pilot_license_type_other();
												add_pilot_license_approval_rating_other();
											}
											if (n == '18') {
												$('.select2_edit_profile_multiple_pilot_license_authority').each(function (i, v) {
													$(v).attr('name', 'pilot_aircraft_rating_license_authorities_id[' + i + '][]');
												});
												add_pilot_aircraft_rating_other_aircraft_type();
												add_pilot_aircraft_rating_other_license_authority();
											}
											if (n == '19') {
												add_pilot_medical_certificat_license_authority_other();
											}
											if (n == '9') {
												$("select.training-other-select").each(function (i, v) {
													$(v).attr("id", "trainings_id" + i);
												});
												$(".training_other").each(function (i, v) {
													$(v).attr('id', 'training_div' + i);
												});
												add_training_other();
											}
										}
										function handle_multiupload(n) {
											if (n == '6') {
												$(".visa_upload").each(function (i, v) {
													$(v).attr('id', 'visa_upload_container' + i);
													$('a ', v).attr('id', 'visa_uploader' + i);
													$('.visa_file ', v).attr('id', 'user_visa_file' + i);
													$('.visa_original_file ', v).attr('id', 'user_visa_original_file' + i);
													$('span ', v).attr('id', 'user_visa_div' + i);
													var visa_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'visa_uploader' + i,
														container: 'visa_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_visa_file" + i).val(file.target_name);
																$("#user_visa_original_file" + i).val(file.name);
																$("#user_visa_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_visa_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													visa_uploader.init();
												});
											}
											if (n == '5') {
												$(".passport_upload").each(function (i, v) {
													$(v).attr('id', 'passport_upload_container' + i);
													$('a ', v).attr('id', 'passport_uploader' + i);
													$('.passport_file ', v).attr('id', 'user_passport_file' + i);
													$('.passport_original_file ', v).attr('id', 'user_passport_original_file' + i);
													$('span ', v).attr('id', 'user_passport_div' + i);
													var passport_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'passport_uploader' + i,
														container: 'passport_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_passport_file" + i).val(file.target_name);
																$("#user_passport_original_file" + i).val(file.name);
																$("#user_passport_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_passport_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													passport_uploader.init();
												});
											}
											if (n == '3') {
												$(".medical_certificate_upload").each(function (i, v) {
													$(v).attr('id', 'medical_certificate_upload_container' + i);
													$('a ', v).attr('id', 'medical_certificate_uploader' + i);
													$('.medical_certificate_file ', v).attr('id', 'user_medical_certificate_file' + i);
													$('.medical_certificate_original_file ', v).attr('id', 'user_medical_certificate_original_file' + i);
													$('span ', v).attr('id', 'user_medical_certificate_div' + i);
													var medical_certificate_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'medical_certificate_uploader' + i,
														container: 'medical_certificate_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_medical_certificate_file" + i).val(file.target_name);
																$("#user_medical_certificate_original_file" + i).val(file.name);
																$("#user_medical_certificate_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_medical_certificate_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													medical_certificate_uploader.init();
												});
											}
											if (n == '2') {
												$(".validation_upload").each(function (i, v) {
													$(v).attr('id', 'validation_upload_container' + i);
													$('a ', v).attr('id', 'validation_uploader' + i);
													$('.validation_file ', v).attr('id', 'user_validation_file' + i);
													$('.validation_original_file ', v).attr('id', 'user_validation_original_file' + i);
													$('span ', v).attr('id', 'user_validation_div' + i);
													var validation_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'validation_uploader' + i,
														container: 'validation_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_validation_file" + i).val(file.target_name);
																$("#user_validation_original_file" + i).val(file.name);
																$("#user_validation_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_validation_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													validation_uploader.init();
												});
											}
											if (n == '1') {
												$(".license_upload").each(function (i, v) {
													$(v).attr('id', 'license_upload_container' + i);
													$('a ', v).attr('id', 'license_uploader' + i);
													$('.license_file ', v).attr('id', 'user_license_file' + i);
													$('.license_original_file ', v).attr('id', 'user_license_original_file' + i);
													$('span ', v).attr('id', 'user_license_div' + i);
													var license_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'license_uploader' + i,
														container: 'license_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_license_file" + i).val(file.target_name);
																$("#user_license_original_file" + i).val(file.name);
																$("#user_license_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_license_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													license_uploader.init();
												});
											}
											if (n == '13') {
												$(".aircraft_rating_training_upload").each(function (i, v) {
													$(v).attr('id', 'aircraft_rating_training_upload_container' + i);
													$('a ', v).attr('id', 'aircraft_rating_training_uploader' + i);
													$('.training_file ', v).attr('id', 'user_aircraft_rating_training_file' + i);
													$('.training_original_file ', v).attr('id', 'user_aircraft_rating_training_original_file' + i);
													$('span ', v).attr('id', 'user_aircraft_rating_training_div' + i);
													var aircraft_rating_training_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'aircraft_rating_training_uploader' + i,
														container: 'aircraft_rating_training_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_aircraft_rating_training_file" + i).val(file.target_name);
																$("#user_aircraft_rating_training_original_file" + i).val(file.name);
																$("#user_aircraft_rating_training_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_aircraft_rating_training_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													aircraft_rating_training_uploader.init();
												});
											}
											if (n == '14') {
												$(".me_license_upload").each(function (i, v) {
													$(v).attr('id', 'me_license_upload_container' + i);
													$('a ', v).attr('id', 'me_license_uploader' + i);
													$('.me_license_file ', v).attr('id', 'user_me_license_file' + i);
													$('.me_license_original_file ', v).attr('id', 'user_me_license_original_file' + i);
													$('span ', v).attr('id', 'user_me_license_div' + i);
													var me_license_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'me_license_uploader' + i,
														container: 'me_license_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#user_me_license_file" + i).val(file.target_name);
																$("#user_me_license_original_file" + i).val(file.name);
																$("#user_me_license_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_me_license_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													me_license_uploader.init();
												});
											}
											if (n == '17') {
												$(".pilot_license_upload").each(function (i, v) {
													$(v).attr('id', 'pilot_license_upload_container' + i);
													$('a ', v).attr('id', 'pilot_license_uploader' + i);
													$('.pilot_license_file ', v).attr('id', 'pilot_license_file' + i);
													$('.pilot_license_original_file ', v).attr('id', 'pilot_license_original_file' + i);
													$('span ', v).attr('id', 'pilot_license_div' + i);
													var pilot_license_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'pilot_license_uploader' + i,
														container: 'pilot_license_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#pilot_license_file" + i).val(file.target_name);
																$("#pilot_license_original_file" + i).val(file.name);
																$("#pilot_license_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_license_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													pilot_license_uploader.init();
												});
											}
											if (n == '18') {
												$(".pilot_aircraft_rating_upload").each(function (i, v) {
													$(v).attr('id', 'pilot_aircraft_rating_training_upload_container' + i);
													$('a ', v).attr('id', 'pilot_aircraft_rating_training_uploader' + i);
													$('.pilot_training_file ', v).attr('id', 'pilot_aircraft_rating_training_file' + i);
													$('.pilot_training_original_file ', v).attr('id', 'pilot_aircraft_rating_training_original_file' + i);
													$('span ', v).attr('id', 'pilot_aircraft_rating_training_div' + i);
													var pilot_aircraft_rating_training_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'pilot_aircraft_rating_training_uploader' + i,
														container: 'pilot_aircraft_rating_training_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#pilot_aircraft_rating_training_file" + i).val(file.target_name);
																$("#pilot_aircraft_rating_training_original_file" + i).val(file.name);
																$("#pilot_aircraft_rating_training_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_rating_training_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													pilot_aircraft_rating_training_uploader.init();
												});
											}
											if (n == '19') {
												$(".pilot_medical_certificate_upload").each(function (i, v) {
													$(v).attr('id', 'pilot_medical_certificate_upload_container' + i);
													$('a ', v).attr('id', 'pilot_medical_certificate_uploader' + i);
													$('.pilot_medical_certificate_file ', v).attr('id', 'pilot_medical_certificate_file' + i);
													$('.pilot_medical_certificate_original_file ', v).attr('id', 'pilot_medical_certificate_original_file' + i);
													$('span ', v).attr('id', 'pilot_medical_certificate_div' + i);
													var pilot_medical_certificate_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'pilot_medical_certificate_uploader' + i,
														container: 'pilot_medical_certificate_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#pilot_medical_certificate_file" + i).val(file.target_name);
																$("#pilot_medical_certificate_original_file" + i).val(file.name);
																$("#pilot_medical_certificate_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_medical_certificate_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													pilot_medical_certificate_uploader.init();
												});
											}
											if (n == '9') {
												$(".training_upload").each(function (i, v) {
													$(v).attr('id', 'training_upload_container' + i);
													$('a ', v).attr('id', 'training_uploader' + i);
													$('input ', v).attr('id', 'training_file' + i);
													$('span ', v).attr('id', 'training_div' + i);
													var training_uploader = new plupload.Uploader({
														runtimes: 'html5,flash,html4',
														browse_button: 'training_uploader' + i,
														container: 'training_upload_container' + i,
														url: base_url + 'user/upload_files',
														chunk_size: '1mb',
														unique_names: true,
														flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
														silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
															mime_types: [
																{title: "Document files", extensions: "pdf,doc,docx"}
															]
														},
														init: {
															FilesAdded: function (up, files) {
																setTimeout(function () {
																	up.start();
																	$(window).block({message: 'Please wait...'});
																}, 1);
															},
															FileUploaded: function (up, file) {
																var file_extension_array = file.target_name.split('.');
																var file_extension = file_extension_array[file_extension_array.length - 1];
																var file_icon = '';
																switch (file_extension) {
																	case 'pdf':
																		var file_icon = 'fa-file-pdf-o';
																		break;
																	case 'doc':
																	case 'docx':
																		var file_icon = 'fa-file-word-o';
																		break;
																	default :
																		var file_icon = 'fa-file-word-o';
																		break;
																}
																$("#training_file" + i).val(file.target_name);
																$("#training_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_training_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle" id="remove_file"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a></div></div>');
															},
															UploadComplete: function () {
																$(window).unblock();
															},
															Error: function (up, err) {
																$(window).unblock();
																bootbox.alert(err.message);
															}
														}
													});
													training_uploader.init();
												});
											}
										}</script>
<script type="text/javascript">
	var resume_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "resume_uploader",
		container: "resume_upload_container",
		url: base_url + 'user/upload_files',
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
			mime_types: [
				{title: "Document files", extensions: "pdf,doc,docx"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				if (up.files.length > 1) {
					resume_uploader.removeFile(resume_uploader.files[0]);
				}
				setTimeout(function () {
					up.start();
					$(window).block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				var file_extension_array = file.target_name.split('.');
				var file_extension = file_extension_array[file_extension_array.length - 1];
				var file_icon = '';
				switch (file_extension) {
					case 'pdf':
						var file_icon = 'fa-file-pdf-o';
						break;
					case 'doc':
					case 'docx':
						var file_icon = 'fa-file-word-o';
						break;
					default :
						var file_icon = 'fa-file-word-o';
						break;
				}
				$("#user_resume").val(file.target_name);
				$("#user_resume_original_file").val(file.name);
				$("#user_resume_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_resume();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
			},
			UploadComplete: function () {
				$(window).unblock();
			},
			Error: function (up, err) {
				$(window).unblock();
				bootbox.alert(err.message);
			}
		}
	});
	function remove_resume() {
		$("#user_resume").val('');
	}
	resume_uploader.init();
	var photo_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "photo_uploader",
		container: "photo_upload_container",
		url: base_url + 'user/upload_files',
		chunk_size: '10mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {
			max_file_size: '11mb',
			mime_types: [
				{title: "Document files", extensions: "jpg,jpeg,png"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				if (up.files.length > 1) {
					photo_uploader.removeFile(photo_uploader.files[0]);
					$("#photo_upload_container img").remove();
				}
				setTimeout(function () {
					up.start();
					$(window).block({
						message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#user_profile_image").val(file.target_name);
				$("#user_profile_image_original_name").val(file.name);
				$("#user_image_div").html('<div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_image();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:57px;height:57px"><br/><span>' + file.name + '</span></div>');
			},
			UploadComplete: function () {
				$(window).unblock();
			},
			Error: function (up, err) {
				$(window).unblock();
				bootbox.alert(err.message);
			}
		}
	});
	photo_uploader.init();
	function remove_image() {
		$("#user_profile_image").val('');
	}
	function set_timestamp() {
		$("#current_timestamp").html(new Date().getTime());
	}
</script>
