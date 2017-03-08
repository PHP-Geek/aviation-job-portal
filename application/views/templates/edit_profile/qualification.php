<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'flight-attendant') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4><?php echo $user_details_array['job_type_name']; ?> Qualifications</h4>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="positions_id">Current Position</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile position-other-select" data-placeholder="&nbsp; Current Position" id="positions_id" name="positions_id">
						<option></option>
						<?php foreach ($position_array as $position) { ?>
							<option <?php echo $position['position_id'] === $user_details_array['positions_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $user_details_array['positions_id'] === '0' ? 'selected="selected"' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group position_other" style="display:none">
				<label for="user_position_other" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_position_other" id="user_position_other" class="form-control" placeholder="Other Position" value="<?php echo isset($user_details_array['positions_id']) ? $user_details_array['user_position_other'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_years_of_experience">Minimum Years Experience</label>
				<div class="col-sm-8">
					<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years of Experience" value="<?php echo $user_details_array['user_years_of_experience']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_skills_id">Skills</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile skill-other-select" data-placeholder="&nbsp; Skills(may select multiple)" id="user_skills_id" name="user_skills_id[]" multiple="multiple">
						<?php
						$other_selected = false;
						$skill_key = '';
						foreach ($skill_array as $skill) {
							$selected = false;
							foreach ($user_skill_array as $key => $skills) {
								if ($skills['skills_id'] === '0') {
									$skill_key = $key;
									$other_selected = true;
								}
								if ($skill['skill_id'] === $skills['skills_id']) {
									$selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group user_skill_other" style="display:none">
				<label for="user_skill_other_name" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_skill_other_name" id="user_skill_other_name" class="form-control" placeholder="Other Skill" value="<?php echo isset($user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name']) && $user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name'] !== '' ? $user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name'] : ''; ?>"/>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } ?>
<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'corporate') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4><?php echo $user_details_array['job_type_name']; ?> Qualifications</h4>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_qualification_positions_id">Current Position</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile" data-placeholder="&nbsp; Current Position (may select multiple)" id="user_qualification_positions_id" name="user_qualification_positions_id[]" multiple="multiple">
						<?php
						$other_selected = false;
						$user_current_position_key = '';
						foreach ($position_array as $position) {
							$selected = false;
							foreach ($user_position_array as $key => $positions) {
								if ($positions['positions_id'] === '0') {
									$other_selected = true;
									$user_current_position_key = $key;
								}
								if ($position['position_id'] === $positions['positions_id']) {
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
			<div class="form-group" style="display:none">
				<label for="user_current_position_other_name" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_current_position_other_name" id="user_current_position_other_name" class="form-control" placeholder="Other Position" value="<?php echo isset($user_position_array[$user_current_position_key]['user_current_position_other']['user_current_position_other_name']) && $user_position_array[$user_current_position_key]['user_current_position_other']['user_current_position_other_name'] !== '' ? $user_position_array[$user_current_position_key]['user_current_position_other']['user_current_position_other_name'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_department">Department</label>
				<div class="col-sm-8">
					<input type="text" name="user_department" id="user_department" class="form-control" placeholder="Department" value="<?php echo $user_details_array['user_department']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="my_aircrafts_id">Minimum Years Experience</label>
				<div class="col-sm-8">
					<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years of Experience" value="<?php echo $user_details_array['user_years_of_experience'] === '0' ? '' : $user_details_array['user_years_of_experience']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_countries_of_experience">Countries of Experience</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile" data-placeholder="&nbsp; Countries of Experience (may select multiple)" id="user_countries_of_experience" name="user_countries_of_experience[]" multiple="multiple">
						<?php
						foreach ($country_array as $country) {
							$selected = false;
							foreach ($user_countries_of_experience_array as $countries) {
								if ($countries['countries_id'] === $country['country_id']) {
									$selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Skills </label>
				<div class="col-sm-8">
					<select id="user_qualification_skills_id" name="user_qualification_skills_id[]"  class="form-control select2_edit_profile" data-placeholder="&nbsp;Skills (may select multiple)" multiple="multiple">
						<?php
						$other_selected = false;
						$skill_key = '';
						foreach ($skill_array as $skill) {
							$selected = false;
							foreach ($user_skill_array as $key => $skills) {
								if ($skills['skills_id'] === '0') {
									$skill_key = $key;
									$other_selected = true;
								}
								if ($skill['skill_id'] === $skills['skills_id']) {
									$selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group user_skill_other" style="display:none">
				<label for="user_skill_other_name" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_skill_other_name" id="user_skill_other_name" class="form-control" placeholder="Other Skill" value="<?php echo isset($user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name']) && $user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name'] !== '' ? $user_skill_array[$skill_key]['user_skill_other']['user_skill_other_name'] : ''; ?>"/>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } ?>
<script>
	$(document).ready(function () {
		add_user_operation_current_position_other();
		if ($("#positions_id").val() === '0') {
			$("#positions_id").closest('.form-group').next('div').show();
		}
		$("#user_skills_id option:selected").each(function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_qualification_skills_id option:selected").each(function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_qualification_positions_id option:selected").each(function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#positions_id").on('change', function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_skills_id").on('change', function () {
			if ($("#user_skills_id option:selected").length > 0) {
				$("#user_skills_id option:selected").each(function () {
					if ($(this).val() === '0') {
						$(this).closest('.form-group').next('div').show();
					} else {
						$(this).closest('.form-group').next('div').hide();
					}
				});
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_qualification_skills_id").on('change', function () {
			if ($("#user_qualification_skills_id option:selected").length > 0) {
				$("#user_qualification_skills_id option:selected").each(function () {
					if ($(this).val() === '0') {
						$(this).closest('.form-group').next('div').show();
					} else {
						$(this).closest('.form-group').next('div').hide();
					}
				});
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_qualification_positions_id").on('change', function () {
			if ($("#user_qualification_positions_id option:selected").length > 0) {
				$("#user_qualification_positions_id option:selected").each(function () {
					if ($(this).val() === '0') {
						$(this).closest('.form-group').next('div').show();
					} else {
						$(this).closest('.form-group').next('div').hide();
					}
				});
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		setTimeout(function () {
			$("#endorsement_div").css('display', 'none');
		}, 100);
	});
	function add_user_operation_current_position_other() {
		$("#user_qualification_positions_id").on('change', function () {
			$("#user_qualification_positions_id option").each(function () {
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
	$("#user_endorsement").on('change', function () {
		if ($("#user_endorsement").val() === 'Other') {
			$("#endorsement_div").css('display', 'block');
		} else {
			$("#endorsement_div").css('display', 'none');
		}
	});
</script>
