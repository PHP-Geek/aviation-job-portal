<style>
	.has-error .select2-container--default .select2-selection--single {
		border: 1px solid red !important;
		border-radius:5px;
	}
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
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
					<li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<form id="edit_employer_profile_form" method="post" action="" enctype="multipart/form-data" onkeypress="set_timestamp();" class="form-horizontal well spaceup-20">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<h4>Please provide your company’s information, personal information, and other relevant information in the fields below.</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
				<h4>Company Details</h4>
				<div class="form-group">
					<label for="user_business_name" class="col-sm-4 control-label">Company Trading Name <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<input type="text" class="form-control" name="user_business_name" id="user_business_name" placeholder="Company Trading Name" value="<?php echo $user_details_array['user_business_name']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_business_legal_name" class="col-sm-4 control-label">Company Legal/Registered Name <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_business_legal_name" id="user_business_legal_name" class="form-control" placeholder="Company Legal Name" value="<?php echo $user_details_array['user_business_legal_name']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_business_number" class="col-sm-4 control-label">Company Number</label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_business_number" id="user_business_number" class="form-control" placeholder="Company Number" value="<?php echo $user_details_array['user_business_number']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="countries_id" class="col-sm-4 control-label">Registered Country <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<select name="user_registered_countries_id" id="user_registered_countries_id" class="form-control select2_edit_profile" data-placeholder="Registered Country">
							<option></option>
							<?php foreach ($country_array as $country) { ?>
								<option <?php
								if ($country['country_id'] === $user_details_array['user_registered_countries_id']) {
									echo 'selected="selected"';
								}
								?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
								<?php } ?>
						</select>
					</div>
				</div>
				<hr/>
				<h4>Company Information</h4>
				<div class="form-group">
					<label for="user_address" class="col-sm-4 control-label">Street <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<textarea class="form-control" name="user_address" id="user_address" placeholder="Company Address"><?php echo $user_details_array['user_address']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="user_city" class="col-sm-4 control-label">City <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_city" id="user_city" placeholder="City" class="form-control" value="<?php echo $user_details_array['user_city']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_state" class="col-sm-4 control-label">State <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_state" id="user_state" placeholder="State" class="form-control" value="<?php echo $user_details_array['user_state']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_city" class="col-sm-4 control-label">Postcode/Zipcode</label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_zipcode" id="user_zipcode" placeholder="Postcode/Zipcode" class="form-control" value="<?php echo $user_details_array['user_zipcode']; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_country" class="col-sm-4 control-label">Country <span class="required">*</span></label>
					<div class="col-sm-8 place-error">
						<select name="countries_id" id="countries_id" class="form-control select2_edit_profile" data-placeholder="Country">
							<option></option>
							<?php foreach ($country_array as $country) { ?>
								<option <?php echo $country['country_id'] === $user_details_array['countries_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="user_website_address" class="col-sm-4 control-label">Website</label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_website_address" id="user_website_address" placeholder="www.example.com" class="form-control" value="<?php echo $user_details_array['user_website_address']; ?>"/>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<?php $this->load->view('templates/employer_edit_profile/contact_person'); ?>
		<?php $this->load->view('templates/employer_edit_profile/aircraft_details'); ?>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
				<h4>Company Logo <span class="required">*</span></h4>
				<div class="form-horizontal col-md-offset-3 col-sm-offset-2">
					<div class="form-group" id="upload_image_container">
						<a  href="javascript:;" class="btn btn-upload" title="upload image" id="image_uploader"><i class="fa fa-image"></i> Upload Image</a><label>Company Logo (png,jpg,jpeg 10 MB max)</label>
						<div>
							<input type="hidden" name="user_business_logo" id="user_business_logo" value="<?php echo $user_details_array['user_profile_image']; ?>"/>
							<input type="hidden" name="user_profile_image_original_name" id="user_profile_image_original_name" value="<?php echo $user_details_array['user_profile_image_original_name']; ?>"/>
						</div>
						<div id="uploaded_image">
							<?php if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_image'])) { ?>
								<div class="text-center">
									<img src="<?php echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_image']; ?>" style="max-width:55px;max-height: 55px" class="img-responsive center-block"/><span><?php echo $user_details_array['user_profile_image_original_name']; ?></span>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<?php $this->load->view('templates/employer_edit_profile/certificate_license'); ?>
		<?php $this->load->view('templates/employer_edit_profile/notification_pilot_experience'); ?>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="user_city" class="col-sm-4 control-label">How Did You Hear About Us?</label>
						<div class="col-sm-8 place-error">
							<input type="text" name="user_find_us" id="user_find_us" placeholder="How Did You Hear About Us?" class="form-control" value="<?php echo $user_details_array['user_find_us']; ?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<button class="btn btn-success " type="submit" id="update_employer_profile_button"  data-loading-text="Please wait.....">Update Profile <span class="fa fa-plane"></span></button>
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
			$('select,input[type=checkbox],input[type=radio]').on('change', function () {
				set_timestamp();
			});
			$('#edit_employer_profile_form').keypress(function () {
				set_timestamp();
			});
		});
		window.onbeforeunload = function () {
			if ($("#current_timestamp").html() !== '') {
				return "Leaving the page will result reset of all unsaved changes.";
			}
		}
		$(".edit_profile_date_picker").datepicker({
			clearBtn: true, format: 'dd/mm/yyyy',
			autoclose: true,
			startView: 2,
			todayBtn: "linked"
		});
		$(".select2_edit_profile").select2({
			allowClear: true
		});
		$("#edit_employer_profile_form").validate({
			errorElement: 'span',
			errorClass: 'help-block pull-right',
			focusInvalid: true, ignore: null,
			rules: {
				user_business_name: {
					required: true
				},
				user_business_legal_name: {
					required: true
				},
				user_registered_countries_id: {
					required: true
				},
				user_address: {
					required: true
				},
				user_city: {
					required: true
				},
				user_state: {
					required: true
				},
				countries_id: {
					required: true
				},
				user_website_address: {
					complete_url: true
				},
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
				user_business_logo: {
					required: true
				},
				user_country_code: {
					required: true
				},
				user_primary_contact: {
					required: true,
					number: true
				},
				user_pilot_total_time_required: {
					number: true
				},
				user_pilot_pic_time_required: {
					number: true
				},
				'user_operation_types_id[]': {
					required: true
				},
				user_number_of_staff: {
					required: true,
					number: true
				},
				user_number_of_aircrafts: {
					number: true
				},
				user_business_title: {
					required: true
				}
			},
			messages: {
				user_business_name: {
					required: "Please enter company trading name"
				},
				user_business_legal_name: {
					required: "Please enter company legal name"
				},
				user_registered_countries_id: {
					required: "Please select your registered country"
				},
				user_address: {
					required: "Please enter your company address"
				},
				user_city: {
					required: "Please enter city"
				},
				user_state: {
					required: "Please enter state"
				},
				user_zipcode: {
					required: "Please enter zipcode"
				},
				countries_id: {
					required: "Please select country"
				},
				user_website_address: {
					complete_url: "Website url must be valid"
				},
				user_first_name: {
					required: "Please enter first name of contact person",
					alpha: "First Name must contain only characters and spaces"
				},
				user_business_logo: {
					required: "Please upload company logo"
				},
				user_last_name: {
					required: "Please enter last name of contact person",
					alpha: "First Name must contain only characters and spaces"
				},
				user_email: {
					required: "Please enter contact email",
					email: "Email must be valid"
				},
				user_business_title: {
					required: "Please enter business title of contact person"
				},
				user_country_code: {
					required: "Please select country code"
				},
				user_primary_contact: {
					required: "Please enter contact number",
					number: "Contact number must be valid"
				},
				user_pilot_total_time_required: {
					number: "Total time must be valid number"
				},
				user_pilot_pic_time_required: {
					number: "Total PIC time must be valid number"
				},
				'user_operation_types_id[]': {
					required: "Please select type of operation"
				},
				user_number_of_staff: {
					required: "Please fill number of staff",
					number: "Number of staff must be a valid integer"
				},
				user_number_of_aircrafts: {
					number: "Number of aircrafts must be valid number"
				}
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
						$("#update_employer_profile_button").button("loading");
						$.post('', $("#edit_employer_profile_form").serialize(), function (data) {
							if (data === '1') {
								$("#current_timestamp").html('');
								bootbox.alert("Profile has been updated successfully.", function () {
									document.location.href = base_url + 'dashboard';
								});
							} else if (data === '0') {
								bootbox.alert("Error Updating Profile.");
							} else {
								bootbox.alert(data);
							}
							$("#update_employer_profile_button").button("reset");
						});
					}
				});
			}
		});
		$('select').change(function () {
			$("#edit_employer_profile_form").validate().element($(this));
		});
		$.validator.addMethod("alpha", function (value, element) {
			return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
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
		function clone_component(t, n) {
			var tr = $(t).closest('.clone_component_' + n);
			tr.find('select').each(function (i, o) {
				$(o).select2('destroy');
			});
			var clone = tr.clone();
			clone.find('input,select').val('');
			clone.find('textarea').html('');
			clone.find('.show_file_div').empty();
			tr.after(clone);
			$('select').select2({allowClear: true});
			$('.edit_profile_date_picker').datepicker({
				clearBtn: true,
				format: 'dd/mm/yyyy',
				autoclose: true});
			if ($('.clone_component_' + n).length !== 1) {
				$('.remove_component_button_' + n).show();
			}
			$(t).hide();
			handle_multiselect();
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
			handle_multiselect();
			handle_multiupload(n);
		}
		function handle_multiselect() {
			$('.select2_edit_profile_multiple').each(function (i, v) {
				$(v).attr('name', 'user_company_base[' + i + '][]');
			});
		}
		function handle_multiupload(n) {
			if (n == '2') {
				$(".operation_type_upload").each(function (i, v) {
					$(v).attr('id', 'operation_type_upload_container' + i);
					$('a ', v).attr('id', 'operation_type_uploader' + i);
					$('.temp_name ', v).attr('id', 'user_operation_type_logo' + i);
					$('original_name ', v).attr('id', 'user_operation_type_original_name' + i);
					$('span ', v).attr('id', 'user_operation_type_div' + i);
					var operation_type_uploader_uploader = new plupload.Uploader({
						runtimes: 'html5,flash,html4',
						browse_button: 'operation_type_uploader' + i,
						container: 'operation_type_upload_container' + i,
						url: base_url + 'user/upload_files',
						chunk_size: '1mb',
						unique_names: true,
						flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
						silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
							mime_types: [
								{title: "Image files", extensions: "jpg,png,jpeg"}
							]
						}, init: {
							FilesAdded: function (up, files) {
								setTimeout(function () {
									up.start();
									$(window).block({message: 'Please wait...'});
								}, 1);
							},
							FileUploaded: function (up, file) {
								$("#user_operation_type_logo" + i).val(file.target_name);
								$("#user_operation_type_original_name" + i).val(file.name);
								$("#user_operation_type_div" + i).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_operation_type_file1(' + i + ');" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:70px;height:70px"/><br/><span>' + file.name + '</span></div></div>');
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
					operation_type_uploader_uploader.init();
				});
			}
		}
</script>
<script type="text/javascript">
	var image_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "image_uploader", container: "upload_image_container",
		url: base_url + 'user/upload_files',
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {
			max_file_size: '11mb',
			mime_types: [
				{title: "Image files", extensions: "jpg,png,jpeg"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				if (up.files.length > 1) {
					image_uploader.removeFile(image_uploader.files[0]);
				}
				$("#uploaded_image").empty();
				setTimeout(function () {
					up.start();
					$(window).block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#user_business_logo").val(file.target_name);
				$("#user_profile_image_original_name").val(file.name);
				$("#uploaded_image").append('<div class="text-center"><img src="' + base_url + 'uploads/' + file.target_name + '" class="img-responsive center-block" style="max-width:55px;max-height:55px"/><span>' + file.name + '</span></div></div></div>');
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
	function remove_photo() {
		$("#user_business_logo").val('');
	}
	image_uploader.init();
	var certificate_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "certificate_uploader",
		container: "upload_certificate_container",
		url: base_url + 'user/upload_files',
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {
			max_file_size: '26mb',
			mime_types: [
				{title: "Document files", extensions: "doc,docx,pdf,xls"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				if (up.files.length > 1) {
					image_uploader.removeFile(certificate_uploader.files[0]);
					$("#uploaded_certificate").empty();
				}
				setTimeout(function () {
					up.start();
					$('#certificate_upload_div').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#user_business_certificate").val(file.target_name);
				$("#user_business_certificate_original_name").val(file.name);
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
				$("#uploaded_certificate").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); certificate_remove();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href="' + base_url + 'uploads/' + file.target_name + '" target="_blank"><i class="fa fa-3x ' + file_icon + '"></i></a><br/><span>' + file.name + '</span></div></div>');
			},
			UploadComplete: function () {
				$('#certificate_upload_div').unblock();
			},
			Error: function (up, err) {
				$('#certificate_upload_div').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	function certificate_remove() {
		$("#user_business_certificate").val('');
	}

	certificate_uploader.init();
	var company_logo_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "company_logo_uploader",
		container: "user-company-logo-container",
		url: base_url + 'user/upload_files',
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {
			max_file_size: '10mb',
			mime_types: [
				{title: "Image files", extensions: "jpg,jpeg,png"}
			]
		},
		init: {
			FilesAdded: function (up, files) {
				$("#logo_uploaded").empty();
				if (up.files.length > 1) {
					company_logo_uploader.removeFile(company_logo_uploader.files[0]);
				}
				setTimeout(function () {
					up.start();
					$('.clone_component_2').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#user_company_logo").val(file.target_name);
				$("#logo_uploaded").append('<img src="' + base_url + 'uploads/' + file.target_name + '" class="img-responsive center-block" style="max-width:100px;max-height:100px"/>');
			},
			UploadComplete: function () {
				$('.clone_component_2').unblock();
			},
			Error: function (up, err) {
				$('.clone_component_2').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	company_logo_uploader.init();
	function set_timestamp() {
		$("#current_timestamp").html(new Date().getTime());
	}
</script>
