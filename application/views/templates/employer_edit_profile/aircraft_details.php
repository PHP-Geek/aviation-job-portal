<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
		<div class="form-horizontal">
			<h4>Fleet Details</h4>
			<div class="form-group">
				<label for="user_number_of_aircrafts" class="col-sm-4 control-label">Number of Aircrafts</label>
				<div class="col-sm-8">
					<input type="text" name="user_number_of_aircrafts" id="user_number_of_aircrafts" placeholder="Number of Aircrafts" class="form-control" value="<?php echo $user_details_array['user_number_of_aircrafts'] !== '0' ? $user_details_array['user_number_of_aircrafts'] : ''; ?>" autocomplete="off"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_my_aircrafts_id" class="col-sm-4 control-label">Type of Aircraft</label>
				<div class="col-sm-8">
					<select name="user_my_aircrafts_id[]" id="user_my_aircrafts_id" class="form-control select2_edit_profile" data-placeholder="Aircraft Type (may select mulitple)" multiple="multiple">
						<?php
						foreach ($my_aircraft_array as $my_aircraft) {
							$selected = false;
							$other_selected = false;
							foreach ($user_aircraft_array as $user_aircraft) {
								if ($user_aircraft['my_aircrafts_id'] === $my_aircraft['my_aircraft_id']) {
									$selected = true;
								}
								if ($user_aircraft['my_aircrafts_id'] === '0') {
									$other_selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $my_aircraft['my_aircraft_id']; ?>"><?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?> >Other</option>
					</select>
				</div>
			</div>
			<div class="form-group" style="display:none" id="other_aircraft_type_div">
				<label for="user_aircraft_type_other_name" class="col-sm-4 control-label">Other Aircraft Type</label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_aircraft_other_name" id="user_aircraft_other_name" class="form-control" placeholder="Other Aircraft Type" value="<?php echo isset($user_aircraft_type_other['user_aircraft_other_name']) && $user_aircraft_type_other['user_aircraft_other_name'] !== '' ? $user_aircraft_type_other['user_aircraft_other_name'] : ''; ?>"/>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<script>
	$(function () {
		if ($("#user_my_aircrafts_id option:selected").length > 0) {
			$("#user_my_aircrafts_id option:selected").each(function () {
				if ($(this).val() === '0') {
					$("#other_aircraft_type_div").show();
					return;
				} else {
					$("#other_aircraft_type_div").hide();
				}
			});
		} else {
			$("#other_aircraft_type_div").hide();
		}
		$("#user_my_aircrafts_id").on('change', function () {
			if ($("#user_my_aircrafts_id option:selected").val().length) {
				$("#user_my_aircrafts_id option:selected").each(function () {
					if ($(this).val() === '0') {
						$("#other_aircraft_type_div").show();
						return;
					} else {
						$("#other_aircraft_type_div").hide();
					}
				});
			} else {
				$("#other_aircraft_type_div").hide();
			}
		});
	});

</script>