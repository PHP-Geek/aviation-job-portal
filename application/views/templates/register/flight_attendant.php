<?php if (isset($employee_category) && $employee_category === 'flight-attendant') { ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="positions_id">Current Position</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Current Position" id="positions_id" name="positions_id">
				<option></option>
				<?php foreach ($position_array as $position) { ?>
					<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_position_other">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_position_other" id="user_position_other" class="form-control" placeholder="Other Current Position"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="my_aircrafts_id">Aircraft Type</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Aircraft Type" id="my_aircrafts_id" name="my_aircrafts_id">
				<option></option>
				<?php foreach ($my_aircraft_array as $my_aircraft) { ?>
					<option value="<?php echo $my_aircraft['my_aircraft_id']; ?>"><?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?></option>
				<?php } ?>
					<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="my_aircraft_other">Other</label>
		<div class="col-sm-8">
			<input type="text" name="my_aircraft_other" id="my_aircraft_other" class="form-control" placeholder="Other Aircraft Type"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="my_aircrafts_id">Years of Experience</label>
		<div class="col-sm-8">
			<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years of Experience"/>
		</div>
	</div>
	<script>
		$("#positions_id").on('change', function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#my_aircrafts_id").on('change', function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
	</script>
<?php } ?>