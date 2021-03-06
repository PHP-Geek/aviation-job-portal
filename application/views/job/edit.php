<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
	.has-error .select2-container--default .select2-selection--single {
		border: 1px solid red !important;
		border-radius:5px;
	}
	.license_div_none{
		display:none;
	}
	.license_div_block{
		display:inline-grid ;
	}
	.help-block{
		color:red !important;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Edit Job</li>
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
                    <h1><span style="font-weight: 500">Edit Job</span></h1>
                    <p>Aided by InCrew's online Aircrew Brokerage, we make ferrying and delivery a breeze. A call to InCrew secures a crew, flightplan, en route planning and permissions, and flight watch for your ferry flight, with the minimum of fuss.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="well spaceup-20">
		<div class="row">
			 <div class="col-md-12 col-lg-12">
			<h4>Update Job Details</h4>
        </div>
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
				<form id="job_edit_form" method="post" action="" role="form" class="form-horizontal">
					<div class="register">
						<div class="form-group">
							<label for="job_title" class="col-sm-4 control-label">Job Title</label>
							<div class="col-sm-8 place-error">
								<input type="text" id="job_title" class="form-control" name="job_title" placeholder="Job Title" value="<?php echo $job_array['job_title']; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="job_contact_email" class="col-sm-4 control-label">Contact Email</label>
							<div class="col-sm-8 place-error">
								<input type="email" class="form-control" id="job_contact_email" placeholder="test@gmail.com" name="job_contact_email" value="<?php echo $job_array['job_contact_email']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="job_contact_number" class="col-sm-4 control-label">
								Contact Number
							</label>
							<div class="col-sm-8 place-error">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>
									<input type="text" id="job_contact_number" name="job_contact_number" class="form-control input-mask-phone" placeholder="(999) 999-9999" value="<?php echo $job_array['job_contact_number']; ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="companies_id" class="col-sm-4 control-label">Company Name</label>
							<div class="col-sm-8 place-error">
								<input type="text" name="job_company_name" id="job_comany_name" value="<?php echo $job_array['job_company_name']; ?>" class="form-control" placeholder="Company Name"/>
							</div>
						</div>
						<div class="form-group">
							<label for="job_company_website" class="col-sm-4 control-label">Company Website</label>
							<div class="col-sm-8 place-error">
								<input type="text" name="job_company_website" id="job_company_website" value="<?php echo $job_array['job_company_website']; ?>" class="form-control" placeholder="Company Website"/>
							</div>
						</div>
						<div class="form-group">
							<label for="job_company_description" class="col-sm-4 control-label">About Company</label>
							<div class="col-sm-8 place-error">
								<textarea id="job_company_description" name="job_company_description" class="form-control" placeholder="Company Description Here" rows="4"><?php echo $job_array['job_company_description']; ?></textarea>
							</div>
						</div>
						<div class="form-group" id="photo_upload_container">
							<div class="col-sm-7 col-md-10 col-sm-offset-2">
								<div class=" place-error">
									<a title="Upload Company Logo" id="photo_uploader" href="javascript:;" class="btn btn-success btn-sm"><i class="fa fa-photo"></i> Upload Photo</a>
									<label for="photo">Change Company Logo (jpg,png 10 MB max )</label>
									<input type="hidden" name="job_company_logo" id="job_company_logo" value="<?php echo $job_array['job_company_logo']; ?>"/>
									<input type="hidden" name="job_company_logo_original_name" id="job_company_logo_original_name" value="<?php echo $job_array['job_company_logo_original_name']; ?>"/>
								<div class="text-center">	<img src="<?php echo base_url() . 'uploads/jobs/company_logos' . date('/Y/m/d/H/i/s/', strtotime($job_array['job_created'])) . $job_array['job_company_logo']; ?>" class="img-responsive center-block" id="company_logo_img" style="max-width:100px;max-height: 100px"/><br/><span id="original_name"><?php echo $job_array['job_company_logo_original_name']; ?></span>
								</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="job_edit_date" class="col-sm-4 control-label">Post Date</label>
							<div class="col-sm-8 place-error">
								<span class="input-group date edit_job_datepicker datepicker_job_start">
									<input type='text' class="form-control" name="job_post_date" id="job_post_date" placeholder="Job Post Date" autocomplete="off" value="<?php echo date('d/m/Y', strtotime($job_array['job_post_date'])); ?>"/>
									<span class="input-group-addon">
										<span class="fa fa-calendar bigger-110"></span>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Expiry Date</label>
							<div class="col-sm-8 place-error">
								<span class="input-group date edit_job_datepicker datepicker_job_expire">
									<input type="text" placeholder="Job Expiry date" id="job_expire_date" class="form-control" name="job_expire_date"  autocomplete="off" value="<?php echo date('d/m/Y', strtotime($job_array['job_expire_date'])); ?>"/>
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="job_types_id" class="col-sm-4 control-label">Category</label>
							<div class="col-sm-8 place-error">
								<select id="job_types_id"   class="form-control select2_edit_job" data-placeholder="Job Category" name="job_types_id">
									<option></option>
									<?php foreach ($job_category_array as $job_category) { ?>
										<option <?php
										if ($job_array['job_types_id'] === $job_category['job_type_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $job_category['job_type_id']; ?>">
											<?php echo $job_category['job_type_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="job_employee_type" class="col-sm-4 control-label">Employment Type</label>
							<div class="col-sm-8 place-error">
								<select id="job_employee_type" class="form-control select2_edit_job" data-placeholder="Employee Type"  name="job_employee_type">
									<?php foreach ($employee_type_array as $key => $employee_type) { ?>
										<option <?php
										if ($key === $job_array['job_employee_type']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $key; ?>"><?php echo $employee_type; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Expected Start Date</label>
							<div class="col-sm-8 place-error">
								<span class="input-group date edit_job_datepicker datepicker_job_expected">
									<input type="text" placeholder="Job Start Date" id="job_start_date" class="form-control" name="job_start_date" value="<?php echo date('d/m/Y', strtotime($job_array['job_start_date'])); ?>"/>
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group" id="aircraft_type_div">
							<label class="col-sm-4 control-label">Aircraft <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<select id="my_aircrafts_id"  class="select2_edit_job form-control" name="my_aircrafts_id" data-placeholder="Aircraft Type">
									<option></option>
									<?php foreach ($my_aircraft_array as $my_aircraft) { ?>
										<option <?php
										if ($my_aircraft['my_aircraft_id'] === $job_array['my_aircrafts_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $my_aircraft['my_aircraft_id']; ?>">
												<?php echo $my_aircraft['my_aircraft_name']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group" id="license_type_div">
							<label class="col-sm-4 control-label">License <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<select id="licenses_id" class="form-control select2_edit_job" name="licenses_id" data-placeholder="License Type">
									<option></option>
									<?php foreach ($license_array as $license) { ?>
										<option <?php
										if ($license['license_id'] === $job_array['licenses_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type']; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="countries_id" class="col-sm-4 control-label">Location</label>
							<div class="col-sm-8 place-error">
								<select  id="countries_id" name="countries_id" class="form-control select2_edit_job" data-placeholder="Job Location">
									<option></option>
									<?php foreach ($country_array as $country) { ?>
										<option <?php
										if ($country['country_id'] === $job_array['countries_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" class="col-sm-4 control-label">Pay</label>
							<div class="col-sm-8 place-error">
								<div class="col-md-3 col-lg-3">
									<div class="form-group">
										<select id="job_pay_currency"   name="job_pay_currency" class="form-control select2_edit_job" data-placeholder="Currency">
											<option></option>
											<?php foreach ($currency_array as $currency) { ?>
												<option <?php
												if ($job_array['job_pay_currency'] === $currency) {
													echo 'selected="selected"';
												}
												?> value="<?php echo $currency; ?>">
													<?php echo $currency; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-5 col-lg-5">
									<div class="form-group">
										<input type="text" name="job_pay_amount" class="form-control" id="job_pay_amount" placeholder="Pay" value="<?php echo $job_array['job_pay_amount']; ?>"/>
									</div>
								</div>
								<div class="col-md-4 col-lg-4">
									<div class="form-group">
										<select id="job_pay_tenor"   name="job_pay_tenor" class="form-control select2_edit_job" data-placeholder="Job Tenor">
											<option></option>
											<?php foreach ($job_pay_tenor_array as $pay_tenor) { ?>
												<option <?php
												if ($job_array['job_pay_tenor'] === $pay_tenor) {
													echo 'selected="selected"';
												}
												?> value="<?php echo $pay_tenor; ?>">
													<?php echo $pay_tenor; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="job_details" class="col-sm-4 control-label">Job Details/Requirements</label>
							<div class="col-sm-8 place-error">
								<textarea class="form-control" rows="5" placeholder="Job Details" id="job_details" name="job_details"><?php echo str_replace(array('<br>', '<br/>', '<br />'), '', $job_array['job_details']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="job_details" class="col-sm-4 control-label">Salary and Benefits Packages  <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<textarea class="form-control" rows="5" placeholder="Salary & other packages to Employees" id="job_benifit_package" name="job_benifit_package"><?php echo str_replace(array('<br>', '<br/>', '<br />'), '', $job_array['job_benifit_package']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="job_details" class="col-sm-4 control-label">Minimum Requirements <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<textarea class="form-control" rows="5" placeholder="Job Requirements" id="job_requirements" name="job_requirements"><?php echo str_replace(array('<br>', '<br/>', '<br />'), '', $job_array['job_requirements']); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="licenses_id" class="col-sm-4 control-label">Notification Setup <span class="required">*</span></label>
							<div class="col-sm-8 place-error">
								<label>
									<input type="radio" value="1" name="job_notification" id="job_notifiation" <?php
									if ($job_array['job_notification'] === '1') {
										echo 'checked="checked"';
									}
									?>">
									<span class="label-text">Email And Dashboard</span>
								</label><br/>
								<label>
									<input type="radio" value="2" name="job_notification" id="job_notifiation" <?php
									if ($job_array['job_notification'] === '2') {
										echo 'checked="checked"';
									}
									?>">
									<span class="label-text">Email Only</span>
								</label><br/>
								<label>
									<input type="radio" value="2" name="job_notification" id="job_notifiation" <?php
									if ($job_array['job_notification'] === '2') {
										echo 'checked="checked"';
									}
									?>>
									<span class="label-text">Dashboard Only</span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-9">
							<a href="<?php echo base_url(); ?>job" class="btn btn-success">Cancel <i class="fa fa-plane"></i></a>
							<button id="edit_job_button" class="btn btn-success" data-loading-text="Please wait......." type="submit">Update Job <i class="fa fa-plane"></i></button>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$(function () {
		$(".edit_job_datepicker").datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startView: 2,
			todayBtn: "linked"
		});
		setTimeout(function () {
			$("#license_type_div").addClass('license_div_none');
			$("#aircraft_type_div").addClass('license_div_none');
		}, 500);
		$(".select2_edit_job").select2({clearBtn: true});
		if ($("#job_types_id").val() === '1' || $("#job_types_id").val() === '2') {
			$("#license_type_div").css({display: "block"});
			$("#aircraft_type_div").css({display: "block"});
		}
		$("#job_types_id").on('change', function () {
			if ($(this).val() === '1' || $(this).val() === '2') {
				$("#license_type_div").css({display: "block"});
				$("#aircraft_type_div").css({display: "block"});
			} else {
				$("#license_type_div").css({display: "none"});
				$("#aircraft_type_div").css({display: "none"});
			}
		});
		$('select').change(function () {
			$("#job_edit_form").validate().element($(this));
		});
		$("#job_edit_form").validate({
			errorElement: 'span',
			errorClass: 'help-block pull-right',
			focusInvalid: true,
			ignore: null,
			rules: {
				job_contact_email: {
					required: true,
					email: true
				},
				job_contact_number: {
					required: true
				},
				job_comapny: {
					required: true
				},
				job_company_description: {
					required: true
				},
				job_company_logo: {
					required: true
				},
				job_edit_date: {
					required: true
				},
				job_post_date: {
					required: true
				},
				job_expire_date: {
					required: true
				},
				job_types_id: {
					required: true
				},
				job_title: {
					required: true
				},
				employee_type: {
					required: true
				},
				job_start_date: {
					required: true
				},
				my_aircrafts_id: {
					required: {
						depends: function (element) {
							return ($("#job_types_id").val() == '1' || $("#job_types_id").val() == '2')
						}
					}
				},
				job_license_type: {
					required: {
						depends: function (element) {
							return ($("#job_types_id").val() == '1' || $("#job_types_id").val() == '2')
						}
					}
				},
				countries_id: {
					required: true
				},
				job_pay_currency: {
					required: true
				},
				job_pay_amount: {
					required: true,
					number: true
				},
				job_pay_tenor: {
					required: true
				},
				job_details: {
					required: true
				},
				job_company_website: {
					url: true
				},
				job_requirements: {
					required: true
				},
				job_benifit_package: {
					required: true
				},
				job_notification: {
					required: true
				}
			},
			messages: {
				job_contact_email: {
					required: "Please enter contact email",
					email: "Please enter valid email."
				},
				job_contact_number: {
					required: "Please enter contact number"
				},
				job_company_website: {
					url: "Website url must be valid"
				},
				job_company: {
					required: "Please enter company name"
				},
				job_company_description: {
					required: "Please enter company description"
				},
				job_company_logo: {
					required: "Please upload company logo"
				},
				job_post_date: {
					required: "Please enter job post date"
				},
				job_expire_date: {
					required: "Please enter job expire date"
				},
				job_expire_date: {
					required: "Please enter job expire date"
				},
				job_types_id: {
					required: "Please select job category"
				},
				job_title: {
					required: "Please enter job title"
				},
				employee_type: {
					required: "Please select employment type"
				},
				job_start_date: {
					required: "Please enter job start date"
				},
				my_aircrafts_id: {
					required: "Please select aircraft type"
				},
				job_license_type: {
					required: "Please select license type"
				},
				countries_id: {
					required: "Please select job location"
				},
				job_pay_currency: {
					required: "Please select job currency"
				},
				job_pay_tenor: {
					required: "Please select tenor"
				},
				job_pay_amount: {
					required: "Please enter pay amount",
					number: "Please enter valid currency"
				},
				job_details: {
					required: "Please enter job details"
				},
				job_requirements: {
					required: "Please enter job requirements"
				},
				job_benifit_package: {
					required: "Please enter benifit packages"
				},
				job_notification: {
					required: "Please select job notification type"
				}
			},
			invalidHandler: function (event, validator) {
				//show_signup_error();
			},
			highlight: function (element) {
				$(element).closest('.form-group div').addClass('has-error .place-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group div').removeClass('has-error');
			},
			success: function (element) {
				$(element).closest('.form-group').removeClass('has-error');
				$(element).closest('.form-group').children('span.help-block').remove();
			},
			errorPlacement: function (error, element) {
				error.appendTo(element.closest('.form-group div'));
			},
			submitHandler: function (form) {
				bootbox.confirm("Are you sure to save changes?", function (result) {
					if (result) {
						$("#edit_job_button").button("loading");
						$.post('', $("#job_edit_form").serialize(), function (data) {
							if (data === '1') {
								bootbox.alert("Job Updated Successfully", function () {
									document.location.href = base_url + 'job';
								});
							} else if (data === '0') {
								bootbox.alert("Error Posting Job.");
							} else {
								bootbox.alert(data);
							}
							$("#edit_job_button").button("reset");
						});
					}
				});
			}
		});
	});
	$('.datepicker_job_start, .datepicker_job_expire, .datepicker_job_expected').on('change', function () {
		$(this).closest('.form-group div').removeClass('has-error');
		$(this).closest('.form-group div').removeClass('has-error');
		$(this).closest('.form-group div').children('span.help-block').remove();
	});
	function show_signup_error() {
		$("#edit_job_form").prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error While Creating an Account !!!</div>');
		setTimeout(function () {
			$('.alert-danger').fadeOut();
		}, 2000);
	}
</script>
<script>
	var photo_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "photo_uploader",
		container: "photo_upload_container",
		url: base_url + 'job/upload_files',
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
				if (up.files.length > 1) {
					photo_uploader.removeFile(photo_uploader.files[0]);
					$("#photo_upload_container img").remove();
				}
				setTimeout(function () {
					up.start();
					$('#edit_job_form').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#job_company_logo").val(file.target_name);
				$("#original_name").html(file.name);
				$("#job_company_logo_original_name").val(file.name);
				$("#company_logo_img").attr("src", base_url + "uploads/" + file.target_name);
			},
			UploadComplete: function () {
				$('#edit_job_form').unblock();
			},
			Error: function (up, err) {
				$('#edit_job_form').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	photo_uploader.init();</script>


