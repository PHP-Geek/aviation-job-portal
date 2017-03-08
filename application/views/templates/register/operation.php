<?php if (isset($employee_category) && $employee_category === 'operations' || $employee_category === 'executive' || $employee_category === 'corporate') { ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="positions_id">Current Position</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Current Position (may select multiple)" id="positions_id" name="positions_id[]" multiple="multiple">
				<?php foreach ($position_array as $position) { ?>
					<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_current_position_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_current_position_other_name" id="user_current_position_other_name" class="form-control" placeholder="Other Current Position"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="my_aircrafts_id">Years of Experience</label>
		<div class="col-sm-8">
			<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years of Experience"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="user_countries_of_experience">Countries of Experience</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Countries of Experience" id="user_countries_of_experience" name="user_countries_of_experience">
				<option></option>
				<?php foreach ($country_array as $country) { ?>
					<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Skills </label>
		<div class="col-sm-8">
			<select id="skills_id" name="skills_id[]"  class="form-control select2_register" data-placeholder="&nbsp;Skills (may select multiple)" multiple="multiple">
				<?php foreach ($skill_array as $skill) { ?>
					<option value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_skill_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_skill_other_name" id="user_skill_other_name" class="form-control" placeholder="Other Skill"/>
		</div>
	</div>
	<script>
		$("#positions_id").on('change', function () {
			$("#positions_id option").each(function () {
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
		$("#skills_id").on('change', function () {
			$("#skills_id option").each(function () {
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
	</script>
<?php }
?>