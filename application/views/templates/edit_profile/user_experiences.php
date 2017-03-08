<?php if (isset($user_details_array['job_type_slug']) && $user_details_array['job_type_slug'] === 'flight-attendant') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4>Aircraft Experience</h4>
			<div class="form-group">
				<label class="col-sm-4 control-label">Aircraft Type</label>
				<div class="col-sm-8">
					<select name="user_aircraft_experience_my_aircrafts_id[]" multiple="multiple" id="user_aircraft_experience_my_aircrafts_id" class="form-control select2_edit_profile" data-placeholder="Aircraft Type">
						<?php
						$other_selected = false;
						$aircraft_experience_key = '';
						foreach ($my_aircraft_array as $my_aircraft) {
							$selected = false;
							foreach ($user_aircraft_experience_array as $key => $aircraft_experience) {
								if ($aircraft_experience['my_aircrafts_id'] === '0') {
									$aircraft_experience_key = $key;
									$other_selected = true;
								}
								if ($aircraft_experience['my_aircrafts_id'] === $my_aircraft['my_aircraft_id']) {
									$selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $my_aircraft['my_aircraft_id'] ?>"><?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group user_aircraft_experience_aircraft_type_other" style="display:none">
				<label for="user_aircraft_experience_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_aircraft_experience_aircraft_type_other_name" id="user_aircraft_experience_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type" value="<?php echo isset($user_aircraft_experience_array[$aircraft_experience_key]['user_aircraft_experience_aircraft_type_other']['user_aircraft_experience_aircraft_type_other_name']) && $user_aircraft_experience_array[$aircraft_experience_key]['user_aircraft_experience_aircraft_type_other']['user_aircraft_experience_aircraft_type_other_name'] !== '' ? $user_aircraft_experience_array[$aircraft_experience_key]['user_aircraft_experience_aircraft_type_other']['user_aircraft_experience_aircraft_type_other_name'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_aircraft_last_flight">Last Flight</label>
				<div class="col-sm-8">
					<div class="input-group date edit_profile_date_picker">
						<input type="text" id="user_aircraft_last_flight" class="form-control date-picker" name="user_aircraft_last_flight" placeholder="Last Flight" value="<?php echo $user_details_array['user_aircraft_last_flight'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_details_array['user_aircraft_last_flight'])) : ''; ?>">
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } ?>
<script>
	$(function () {
		$("#user_aircraft_experience_my_aircrafts_id option:selected").each(function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
		$("#user_aircraft_experience_my_aircrafts_id").on('change', function () {
			$("#user_aircraft_experience_my_aircrafts_id option").each(function () {
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

