<?php if (isset($employee_category) && $employee_category === 'pilot') { ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="license_authorities_id">License Authority</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp;License Authority(may select multiple)" id="license_authorities_id" name="license_authorities_id[]" multiple="multiple">
				<?php foreach ($license_authority_array as $license_authority) { ?>
					<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="license_authorities_id">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_license_authority_other_name" id="user_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="licenses_id">License Type</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp;License Types (may select multiple)" id="licenses_id" name="licenses_id[]" multiple="multiple">
				<?php foreach ($license_array as $license) { ?>
					<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] . ' ' . $license['license_type']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_license_type_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_license_type_other_name" id="user_license_type_other_name" class="form-control" placeholder="Other License Type"/>
		</div>
	</div>
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
		<label class="col-sm-4 control-label" for="user_total_hours">Total Hours</label>
		<div class="col-sm-8">
			<input type="text" name="user_total_hours" id="user_total_hours" class="form-control" placeholder="Total Hours"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="type_ratings_id">Current Aircraft Ratings</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Current Aircraft Ratings (may select multiple)" id="my_aircrafts_id" name="my_aircrafts_id[]" multiple="multiple">
				<?php foreach ($my_aircraft_array as $type_rating) { ?>
					<option value="<?php echo $type_rating['my_aircraft_id']; ?>"><?php echo $type_rating['my_aircraft_category'] !== '' ? $type_rating['my_aircraft_category'] . ' ' . $type_rating['my_aircraft_name'] : $type_rating['my_aircraft_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_aircraft_rating_aircraft_type_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_aircraft_rating_aircraft_type_other_name" id="user_aircraft_rating_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Rating"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="user_hours_on_type">Hours on Type</label>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-md-4">
					<input type="text" name="user_total_hours_on_type" id="user_total_hours_on_type" class="form-control" placeholder="Total Hours"/>
				</div>
				<div class="col-md-4">
					<input type="text" name="user_pic_on_type" id="user_pic_on_type" class="form-control" placeholder="PIC"/>
				</div>
				<div class="col-md-4">
					<input type="text" name="user_sic_on_type" id="user_sic_on_type" class="form-control" placeholder="SIC"/>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function () {
			$("#my_aircrafts_id").on('change', function () {
				$("#my_aircrafts_id option").each(function () {
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
			$("#license_authorities_id").on('change', function () {
				$("#license_authorities_id option").each(function () {
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
			$("#licenses_id").on('change', function () {
				$("#licenses_id option").each(function () {
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
		});
	</script>

<?php } ?>