<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'corporate' || $user_details_array['job_type_slug'] === 'air-traffic-controller' || $user_details_array['job_type_slug'] === 'operations') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<?php
			switch ($user_details_array['job_type_slug']) {
				default:
					echo '<h4>Area Experience</h4>';
			}
			?>
			<div class="form-group">
				<label class="col-sm-4 control-label">
					<?php echo $user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'executive' ? 'Countries of Experience' : 'Countries'; ?></label>
				<div class="col-sm-8">
					<select name="user_experience_countries_id[]" multiple="multiple" id="user_experience_countries_id" class="form-control select2_edit_profile" data-placeholder="Select Countries (may select multiple)">
						<?php
						foreach ($country_array as $country) {
							$selected = false;
							foreach ($user_experience_array as $experience) {
								if ($experience['countries_id'] === $country['country_id']) {
									$selected = true;
									break;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } else if ($user_details_array['job_type_slug'] === 'flight-attendant') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<div class="register">
				<h4>Area Experience</h4>
				<div class="form-group">
					<label for="user_locations_id" class="col-sm-4 control-label">Continent</label>
					<div class="col-sm-8">
						<select name="user_experience_locations_id[]" id="user_experience_locations_id" class="form-control select2_edit_profile" multiple="multiple" data-placeholder="Continent (may select multiple)">
							<?php
							foreach ($location_array as $location) {
								$selected = false;
								foreach ($user_experience_array as $experience) {
									if ($experience['locations_id'] === $location['location_id']) {
										$selected = true;
										break;
									}
								}
								?>
								<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $location['location_id']; ?>"><?php echo $location['location_name']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else if ($user_details_array['job_type_slug'] === 'pilot') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<div class="register">
				<h4>Area Experience</h4>
				<div class="form-group">
					<label for="user_experience_locations_id" class="col-sm-4 control-label">Continent</label>
					<div class="col-sm-8">
						<select name="user_experience_locations_id[]" id="user_experience_locations_id" class="form-control select2_edit_profile" multiple="multiple" data-placeholder="Continent (may select multiple)">
							<?php
							foreach ($location_array as $location) {
								$selected = false;
								foreach ($user_experience_array as $experience) {
									if ($experience['locations_id'] === $location['location_id']) {
										$selected = true;
										break;
									}
								}
								?>
								<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $location['location_id']; ?>"><?php echo $location['location_name']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="user_atlantic_crossing" class="col-sm-4 control-label">Atlantic Crossings</label>
					<div class="col-sm-8">
						<select name="user_atlantic_crossing" id="user_atlantic_crossing" class="form-control select2_edit_profile" data-placeholder="Atlantic Crossings">
							<option></option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
							<option <?php echo $user_details_array['user_atlantic_crossing'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="user_pacific_crossing" class="col-sm-4 control-label">Pacific Crossings</label>
					<div class="col-sm-8">
						<select name="user_pacific_crossing" id="user_pacific_crossing" class="form-control select2_edit_profile" data-placeholder="Pacific Crossings">
							<option></option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
							<option <?php echo $user_details_array['user_pacific_crossing'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="user_polar_crossing" class="col-sm-4 control-label">Polar Crossings</label>
					<div class="col-sm-8">
						<select name="user_polar_crossing" id="user_polar_crossing" class="form-control select2_edit_profile" data-placeholder="Polar Crossings">
							<option></option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
							<option <?php echo $user_details_array['user_polar_crossing'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } ?>