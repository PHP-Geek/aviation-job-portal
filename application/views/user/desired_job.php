<style>
	.view-profile p{
		font-size:15px !important;
		margin-top:-11px;
	}
	.desired-job{
		font-size:15px
	}
	.dashboard-divider {
		border-left: 1px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard-divider {
		border-left: 4px solid #2c2c2c;
		padding: 0 0 0 38px;
	}
	.dashboard-title h3{
		margin-top: 0px!important;
        /*color:hsl(202, 62%, 48%);*/
    }
	.dashboard-heading h3{
		color:#009fff;
	}
	.register {
		margin-bottom: 0px;
	}
	.select2-container .select2-search--inline .select2-search__field {
		margin-top: 6px !important;
	}
	.select2-container .select2-selection--single .select2-selection__rendered {
		padding-left: 10px !important;
	}
</style>
<div class="bread">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li class="active">Desired Job</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="little-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="well-black">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-lg-2">
							<div class="//piceffect">
								<img src="<?php
								if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'])) {
									echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($_SESSION['user']['user_created'])) . $_SESSION['user']['user_profile_thumb'];
								} else {
									echo base_url() . 'assets/img/profile.png';
								}
								?>" alt="profile" class="img-responsive"/>
								<!--								<div class="//overlay">
																	<a href="javascript:;" class="info" data-toggle="modal" data-target="#upload_modal">Change Image <i class="fa fa-plane"></i></a>
																</div>-->
							</div>
							<?php if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee' && isset($_SESSION['user']['user_profile_completeness'])) { ?>
								<div class="profile-complete-overflow">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-7">
											<div class="spacer9"></div>
											<h5 class="profile-complete">Profile Completed </h5>
											<div class="progress">
												<div class="progress-bar <?php
												if ($_SESSION['user']['user_profile_completeness'] < 10) {
													echo 'progress-bar-danger';
												} else if ($_SESSION['user']['user_profile_completeness'] < 35) {
													echo 'progress-bar-warning';
												} else if ($_SESSION['user']['user_profile_completeness'] < 65) {
													echo 'progress-bar-info';
												} else {
													echo 'progress-bar-success';
												}
												?>" role="progressbar" aria-valuenow="<?php echo $_SESSION['user']['user_profile_completeness'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $_SESSION['user']['user_profile_completeness'] ?>%">
													<?php echo $_SESSION['user']['user_profile_completeness']; ?>%
												</div>
											</div>
											<a href="<?php echo base_url(); ?>user/profile" class="info"><h5 class="color-brown">View/Edit Profile <i class="fa fa-plane"></i></h5></a>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-md-3 col-sm-3 col-lg-4 col-sm-6">
							<div class="row">
								<div class="col-lg-12">
									<div class="dashboard-title dashboard-heading">
										<h3><?php echo $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name']; ?></h3>
									</div>
									<div class="dashboard-title">
										<p><strong><?php echo $_SESSION['user']['job_type_name']; ?></strong></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-5 col-sm-6 dashboard-divider">
							<div class="dashboard-title">
								<h3>Qualifications</h3>
							</div>
							<?php $this->load->view('templates/dashboard/qualification.php'); ?>
							<div class = "spacer9"></div>
							<div class = "spacer9"></div>
							<?php if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employee' && $_SESSION['user']['user_verified'] === '0') {
								?>
								<div class="row">
									<div class="col-md-12 col-lg-12 col-sm-12">
										<a class="btn btn-primary btn-md pull-right" id="printit" onclick="send_verify_link();">Resend Verify Email <i class="fa fa-plane"></i></a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="well spaceup-20">
		<form id="desired_job_form" method="post" class="form-horizontal">
			<div class="register">
				<?php
				if (count($user_employment_array) > 0) {
					foreach ($user_employment_array as $key => $user_employment) {
						?>
						<div class="clone_component_8">
							<div class="row">
								<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
									<h4>Desired Career/Employment</h4>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_desired_position">Desired Position</label>
										<div class="col-sm-8">
											<input type="text" name="user_employment_desired_position[]" id="user_employment_desired_position" class="form-control" placeholder="Desired Position" value="<?php echo $user_employment['user_employment_desired_position']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_positions_id">Position Type</label>
										<div class="col-sm-8">
											<select class="form-control select2_edit_profile select2_edit_profile_multiple_position user_employment_position-other-select" id="user_employment_positions_id" name="user_employment_positions_id[<?php echo $key; ?>][]" data-placeholder="&nbsp;Position Type (may select multiple)" multiple="multiple">
												<?php
												$other_selected = false;
												$employment_position_key = '';
												foreach ($position_array as $position) {
													$selected = false;
													foreach ($user_employment['user_employment_positions'] as $key1 => $positions) {
														if ($positions['positions_id'] === '0') {
															$employment_position_key = $key1;
															$other_selected = true;
														}
														if ($positions['positions_id'] === $position['position_id']) {
															$selected = true;
														}
													}
													?>
													<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
												<?php } ?>
												<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
											</select>
										</div>
									</div>
									<div class="form-group user_employment_position_other form-other-input" style="display:none">
										<label for="user_employment_position_other_name" class="col-sm-4 control-label">Other</label>
										<div class="col-sm-8">
											<input type="text" name="user_employment_position_other_name[]" id="user_employment_position_other_name" class="form-control" placeholder="Other Position" value="<?php echo isset($user_employment['user_employment_positions'][$employment_position_key]['user_employment_position_other']['user_employment_position_other_name']) && $user_employment['user_employment_positions'][$employment_position_key]['user_employment_position_other']['user_employment_position_other_name'] !== '' ? $user_employment['user_employment_positions'][$employment_position_key]['user_employment_position_other']['user_employment_position_other_name'] : ''; ?>"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_preferred_company">Preferred Company</label>
										<div class="col-sm-8">

											<input type="text" name="user_employment_preferred_company[]" id="user_employment_preferred_company" class="form-control" placeholder="Preferred Company" value="<?php echo $user_employment['user_employment_preferred_company']; ?>"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_type">Employment Type</label>
										<div class="col-sm-8">
											<select class="form-control select2_edit_profile employment_type_other" name="user_employment_type[]" id="user_employment_type" data-placeholder="&nbsp;Type of Employment">
												<option></option>
												<?php foreach ($user_employment_type_array as $user_employment_type) {
													?>
													<option <?php echo $user_employment['user_employment_type'] === $user_employment_type ? 'selected="selected"' : ''; ?> value="<?php echo $user_employment_type; ?>"><?php echo $user_employment_type; ?></option>
												<?php }
												?>
											</select>
										</div>
									</div>
									<div class="form-group" style="display: none">
										<label class="col-sm-4 control-label" for="user_employment_availability">Other Employment Type</label>
										<div class="col-sm-8">
											<input type="text" name="user_employment_type_other[]" id="user_employment_type_other" placeholder="Other Employment Type" class="form-control" value="<?php echo $user_employment['user_employment_type_other']; ?>"/>
										</div>
									</div>
									<div class="form-group" style="display:none">
										<label class="col-sm-4 control-label" for="user_employment_type_next_availability">Next Availability</label>
										<div class="col-sm-8">
											<div class="input-group date edit_profile_date_picker">
												<input type="text" class="form-control" name="user_employment_type_next_availability[]" id="user_employment_type_next_availability" placeholder="Next Availability" value="<?php echo $user_employment['user_employment_type_next_availability'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_employment['user_employment_type_next_availability'])) : ''; ?>">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_willing_to_relocate">Willing to Locate</label>
										<div class="col-sm-8">
											<select name="user_employment_willing_to_relocate[]" id="user_employment_willing_to_relocate" data-placeholder="&nbsp;Willing to Locate" class="form-control select2_edit_profile" style="width:100%">
												<option></option>
												<option <?php echo $user_employment['user_employment_willing_to_relocate'] === '1' ? 'selected="selected"' : ''; ?> value="1">Yes</option>
												<option <?php echo $user_employment['user_employment_willing_to_relocate'] === '2' ? 'selected="selected"' : ''; ?> value="2">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_location">Locations</label>
										<div class="col-sm-8">
											<select name="user_employment_location[<?php echo $key; ?>][]" class="form-control select2_edit_profile select2_edit_profile_multiple_location" data-placeholder="&nbsp;Preferred Location(s)" style="width:100%" id="user_employment_location" multiple="multiple">
												<?php
												foreach ($country_array as $country) {
													$selected = false;
													foreach ($user_employment['user_employment_locations'] as $locations) {
														if ($locations['countries_id'] === $country['country_id']) {
															$selected = true;
														}
													}
													?>
													<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
												<?php }
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="user_employment_availability">Availability/Notice Period</label>
										<div class="col-sm-8">
											<select name="user_employment_availability[]" class="form-control select2_edit_profile user-employment-notice-period" style="width:100%" data-placeholder="&nbsp;Availability/Notice Period" id="user_employment_availability">
												<option></option>
												<?php foreach ($notice_period_array as $notice_period) {
													?>
													<option <?php echo $notice_period === $user_employment['user_employment_availability'] ? 'selected="selected"' : ''; ?> value="<?php echo $notice_period; ?>"><?php echo $notice_period; ?></option><?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group" style="display: none">
										<label class="col-sm-4 control-label" for="user_employment_availability">Other</label>
										<div class="col-sm-8">
											<input type="text" name="user_employment_availability_other" id="user_employment_availability_other" placeholder="Other" class="form-control" value="<?php echo $user_employment['user_employment_availability_other']; ?>"/>
										</div>
									</div>
									<div class="text-right">
										<?php if ($key == count($user_employment_array) - 1) { ?>
											<a class="clone_component_button_8" href="javascript:;" onclick="clone_component(this, 8);"><i class="fa fa-plus-circle"></i> Add Another Desired Position</a>
										<?php } else { ?>
											<a class="clone_component_button_8" href="javascript:;" onclick="clone_component(this, 8);" style="display:none"><i class="fa fa-plus-circle"></i> Add Another Desired Position</a>
										<?php } ?>
										<?php if (count($user_employment_array) === 1) { ?>
											<a class="remove_component_button_8" href="javascript:;" onclick="remove_component(this, 8);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
										<?php } else { ?>
											<a class="remove_component_button_8" href="javascript:;" onclick="remove_component(this, 8);"><i class="fa fa-minus-circle"></i> Remove</a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				} else {
					?>
					<div class="clone_component_8">
						<div class="row">
							<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-1 col-lg-offset-2">
								<h4>Desired Career/Employment</h4>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_employment_desired_position">Desired Position</label>
									<div class="col-sm-8">
										<input type="text" name="user_employment_desired_position[]" id="user_employment_desired_position" class="form-control" placeholder="Desired Position">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_employment_positions_id">Position Type</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile select2_edit_profile_multiple_position user_employment_position-other-select" id="user_employment_positions_id" name="user_employment_positions_id[0][]" data-placeholder="&nbsp;Position Type (may select multiple)" multiple="multiple">
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
										<select class="form-control select2_edit_profile employment_type_other" name="user_employment_type[]" id="user_employment_type" data-placeholder="&nbsp;Type of Employment">
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
								<div class="form-group" style="display:none">
									<label class="col-sm-4 control-label" for="user_employment_type_next_availability">Next Availability</label>
									<div class="col-sm-8">
										<div class="input-group date edit_profile_date_picker">
											<input type="text" class="form-control" name="user_employment_type_next_availability[]" id="user_employment_type_next_availability" placeholder="Next Availability">
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_employment_willing_to_relocate">Willing to Locate</label>
									<div class="col-sm-8">
										<select name="user_employment_willing_to_relocate[]" id="user_employment_willing_to_relocate" data-placeholder="&nbsp;Willing to Locate" class="form-control select2_edit_profile" style="width:100%">
											<option></option>
											<option value="1">Yes</option>
											<option value="2">No</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_employment_location">Locations</label>
									<div class="col-sm-8">
										<select name="user_employment_location[0][]" class="form-control select2_edit_profile select2_edit_profile_multiple_location" data-placeholder="&nbsp;Preferred Location(s)" style="width:100%" id="user_employment_location" multiple="multiple">
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
										<select name="user_employment_availability[]" class="form-control select2_edit_profile user-employment-notice-period" style="width:100%" data-placeholder="&nbsp;Availability/Notice Period" id="user_employment_availability">
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
								<div class="text-right">
									<a class="clone_component_button_8" href="javascript:;" onclick="clone_component(this, 8);"><i class="fa fa-plus-circle"></i> Add Another Desired Position</a>
									<a class="remove_component_button_8" href="javascript:;" onclick="remove_component(this, 8);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
								</div>
							</div>
						</div>
					</div>
				<?php }
				?>
				<div class="spacer9"></div>
				<hr/>
				<div class="text-center">
					<button type="button" name="desired_job_button" class="btn btn-success" id="desired_job_button">Update <i class="fa fa-plane"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php $this->load->view('templates/dashboard/upload_pic'); ?>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>
									$(function () {
										add_user_employment_position_other();
										add_notice_period_other();
										add_employment_type_other();
										add_employment_type_next_availability();
										$(".user_employment_position-other-select").each(function (i, v) {
											$(".user_employment_position-other-select option:selected").each(function (i, v) {
												if ($(this).val() === '0') {
													$(this).closest('.form-group').next('div').show();
												}
											});
										});
										$(".user-employment-notice-period").each(function (i, v) {
											if ($(this).val() === 'Other') {
												$(this).closest('.form-group').next('div').show();
											}
										});
										$(".employment_type_other").each(function (i, v) {
											if ($(this).val() === 'Other') {
												$(this).closest('.form-group').next('div').show();
											}
											if ($(this).val() === 'Contract/Freelance') {
												$(this).closest('.form-group').next().next('div').show();
											}
										});
									});
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
									function add_employment_type_other() {
										$(".employment_type_other").on('change', function () {
											if ($(this).val() === 'Other') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										})
									}

									function add_employment_type_next_availability() {
										$(".employment_type_other").on('change', function () {
											$("#user_employment_type_next_availability").val('');
											if ($(this).val() === 'Contract/Freelance') {
												$(this).closest('.form-group').next().next('div').show();
											} else {
												$(this).closest('.form-group').next().next('div').hide();
											}
										})
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
</script>
<script type="text/javascript">
	$("select").select2({
		allowClear: true
	});
	$(".edit_profile_date_picker").datepicker({
		clearBtn: true,
		format: 'dd/mm/yyyy',
		autoclose: true,
		startView: 2, todayBtn: "linked"
	});
	$("#desired_job_button").click(function () {
		$("#desired_job_button").button('loading');
		$.post('', $("#desired_job_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert('Desired Employment Updated Successfully', function () {
					document.location.href = base_url + 'dashboard';
				});
			} else if (data === '0') {
				bootbox.alert('Error Updating Desired Employment');
			} else {
				bootbox.alert(data);
			}
			$("#desired_job_button").button('reset');
		});
	});
	function clone_component(t, n) {
		var tr = $(t).closest('.clone_component_' + n);
		tr.find('select').each(function (i, o) {
			$(o).select2('destroy');
		});
		var clone = tr.clone();
		clone.find('input,select').val('');
		tr.after(clone);
		$('select').select2({allowClear: true});
		$('.edit_profile_date_picker').datepicker({
			clearBtn: true,
			format: 'dd/mm/yyyy',
			autoclose: true,
			startView: 2,
			todayBtn: "linked"
		});
		if ($('.clone_component_' + n).length !== 1) {
			$('.remove_component_button_' + n).show();
		}
		$(t).hide();
		handle_multiselect();
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
	}
	function handle_multiselect() {
		add_user_employment_position_other();
		add_notice_period_other();
		add_employment_type_other();
		add_employment_type_next_availability();
		$('.select2_edit_profile_multiple_position').each(function (i, v) {
			$(v).attr('name', 'user_employment_positions_id[' + i + '][]');
		});
		$('.select2_edit_profile_multiple_location').each(function (i, v) {
			$(v).attr('name', 'user_employment_location[' + i + '][]');
		});
	}
</script>