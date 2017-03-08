<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
		<div class="form-horizontal">
			<h4>Minimum Pilot Experience</h4>
			<div class="form-group">
				<label for="user_pilot_type_rating_required" class="col-sm-4 control-label">Type Rating</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile" name="user_pilot_type_rating_required" id="user_pilot_type_rating_required" data-placeholder="Type Rating Required">
						<option></option>
						<option <?php
						if ($user_details_array['user_pilot_type_rating_required'] === 'Chanllanger 805') {
							echo 'selected="selected"';
						}
						?> value="Chanllanger 805">Challanger 805</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="user_pilot_total_time_required" class="col-sm-4 control-label">Total Time</label>
				<div class="col-sm-8">
					<input type="text" name="user_pilot_total_time_required" id="user_pilot_total_time_required" class="form-control" placeholder="Total Time Required" value="<?php echo $user_details_array['user_pilot_total_time_required']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_pilot_pic_time_required" class="col-sm-4 control-label">PIC Time (Hours)</label>
				<div class="col-sm-8">
					<input type="text" name="user_pilot_pic_time_required" id="user_pilot_pic_time_required" class="form-control" placeholder="PIC Time Required" value="<?php echo $user_details_array['user_pilot_pic_time_required']; ?>"/>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>