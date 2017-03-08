<?php if (isset($employee_category) && $employee_category === 'air-traffic-controller') { ?>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="license_authorities_id">License Authority</label>
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
		<label class="col-sm-4 control-label" for="user_license_authority_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_license_authority_other_name" id="user_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
		</div>
	</div>
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
		<label class="col-sm-4 control-label" for="user_license_position_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_license_position_other_name" id="user_license_position_other_name" class="form-control" placeholder="Other Current Position"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="type_ratings_id">Ratings</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" data-placeholder="&nbsp; Current Type Ratings (may select multiple)" id="type_ratings_id" name="type_ratings_id[]" multiple="multiple">
				<?php foreach ($type_rating_array as $type_rating) { ?>
					<option value="<?php echo $type_rating['type_rating_id']; ?>"><?php echo $type_rating['type_rating_name']; ?></option>
				<?php } ?>
				<option value="0">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group" style="display:none">
		<label class="col-sm-4 control-label" for="user_rating_other_name">Other</label>
		<div class="col-sm-8">
			<input type="text" name="user_rating_other_name" id="user_rating_other_name" class="form-control" placeholder="Other Rating"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Endorsement(s)</label>
		<div class="col-sm-8">
			<select class="form-control select2_register" id="user_endorsement" name="user_endorsement" data-placeholder="&nbsp;Endorsement(s)">
				<option></option>
				<?php foreach ($endorsement_array as $endorsement) { ?>
					<option value="<?php echo $endorsement; ?>"><?php echo $endorsement; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group" id="endorsement_div">
		<label class="col-sm-4 control-label" for="user_endorsement1">Other Endorsements</label>
		<div class="col-sm-8">
			<input type="text" name="user_endorsement1" id="user_endorsement1" class="form-control" placeholder="Other Enodorsement"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="user_airport_area">Location/Airport/Area/Unit</label>
		<div class="col-sm-8">
			<input type="text" name="user_airport_area" id="user_airport_area" class="form-control" placeholder="Location/Airport/Area/Unit"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="my_aircrafts_id">Years Of Experience</label>
		<div class="col-sm-8">
			<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years Of Experience"/>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			setTimeout(function () {
				$("#endorsement_div").css('display', 'none');
			}, 100);
		});
		$("#user_endorsement").on('change', function () {
			if ($("#user_endorsement").val() === 'Other') {
				$("#endorsement_div").css('display', 'block');
			} else {
				$("#endorsement_div").css('display', 'none');
			}
		});
		$("#license_authorities_id").on('change', function () {
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
		$("#type_ratings_id").on('change', function () {
			$("#type_ratings_id option").each(function () {
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
<?php } ?>
