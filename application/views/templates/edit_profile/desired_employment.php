<div class="register">
	<?php
	if (count($user_employment_array) > 0) {
		foreach ($user_employment_array as $key => $user_employment) {
			?>
			<div class="clone_component_8">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
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
								<select name="user_employment_location[<?php echo $key; ?>][]" class="form-control select2_edit_profile select2_edit_profile_multiple_location" data-placeholder="&nbsp;Preferred Location(s)(may select multiple)" style="width:100%" id="user_employment_location" multiple="multiple">
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
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
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
							<select name="user_employment_location[0][]" class="form-control select2_edit_profile select2_edit_profile_multiple_location" data-placeholder="&nbsp;Preferred Location(s)(may select multiple)" style="width:100%" id="user_employment_location" multiple="multiple">
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
</div>
<hr/>
<script>
	$(function () {
		add_user_employment_position_other();
		add_notice_period_other();
		add_employment_type_other();
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
