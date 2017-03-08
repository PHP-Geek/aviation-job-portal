<?php if (isset($employee_category) && $employee_category === 'maintenance-engineer') { ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="user_license_authority">License Authority</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp;License Authority" id="license_authorities_id" name="license_authorities_id">
				<option></option>
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
			<select class="form-control select2_register" data-placeholder="&nbsp;License Types " id="licenses_id" name="licenses_id">
				<option></option>
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
			<select class="form-control select2_register" data-placeholder="&nbsp;Current Position" id="positions_id" name="positions_id">
				<option></option>
				<?php foreach ($position_array as $position) { ?>
					<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_license_position_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_license_position_other_name" id="user_license_position_other_name" class="form-control" placeholder="Other Current Position"/>
		</div>
	</div>
	<div class="container-fluid clone_component_2">
		<div class="row">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="type_rating_id">Aircraft Ratings</label>
				<div class="col-sm-8">
					<select class="form-control select2_register aircraft_rating_other_select" data-placeholder="&nbsp;Current Type Rating" id="type_ratings_id" name="type_ratings_id[]">
						<option></option>
						<?php foreach ($type_rating_array as $type_rating) { ?>
							<option value="<?php echo $type_rating['type_rating_id'] ?>"><?php echo $type_rating['type_rating_name']; ?></option>
						<?php } ?>
						<option value="0">Other</option>
					</select>
				</div>
			</div>
			<div class="form-group" style="display:none">
				<label class="col-sm-4 control-label" for="user_aircraft_rating_type_rating_other_name">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_aircraft_rating_type_rating_other_name[]" id="user_aircraft_rating_type_rating_other_name" class="form-control" placeholder="Other Aircraft Rating"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_aircraft_rating_coverage">Coverage</label>
				<div class="col-sm-8">
					<select class="form-control select2_register select2_register_multiple_coverage" data-placeholder="&nbsp;Coverage" id="user_aircraft_rating_coverage" name="user_aircraft_rating_coverage[0][]" multiple="multiple">
						<option value="Avionics">Avionics</option>
						<option value="Airframe">Airframe</option>
						<option value="Engines">Engines</option>
						<!--<option value="Other">Other</option>-->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_aircraft_rating_is_current">Current</label>
				<div class="col-sm-8">
					<input type="checkbox" value="0" name="user_aircraft_rating_is_current[]" id="user_aircraft_rating_is_current" class="aircraft_rating_is_rating_box"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_aircraft_rating_year_of_experience">Years Experience</label>
				<div class="col-sm-8">
					<input type="text" name="user_aircraft_rating_year_of_experience[]" id="user_aircraft_rating_year_experience" class="form-control" placeholder="Year Experience"/>
				</div>
			</div>
		</div>
		<div class="form-group text-right">
			<a class="clone_component_button" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add a Rating</a>
			<a class="remove_component_button" href="javascript:;" onclick="remove_component(this, 2);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
		</div>
	</div>
	<script type="text/javascript">
		$(function () {
			add_aircraft_rating_other();
			$("#license_authorities_id").on('change', function () {
				if ($(this).val() === '0') {
					$(this).closest('.form-group').next('div').show();
				} else {
					$(this).closest('.form-group').next('div').hide();
				}
			});
			$("#licenses_id").on('change', function () {
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
		});
		function add_aircraft_rating_other() {
			$(".aircraft_rating_other_select").on('change', function () {
				if ($(this).val() === '0') {
					$(this).closest('.form-group').next('div').show();
				} else {
					$(this).closest('.form-group').next('div').hide();
				}
			});
		}
	</script>
<?php } ?>