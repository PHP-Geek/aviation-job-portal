<div id="pilot_area_experience_div">
	<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot') { ?>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
				<div class="register">
					<h4>Area Experience</h4>
					<div class="form-group">
						<label for="pilot_experience_locations_id" class="col-sm-4 control-label">Continent</label>
						<div class="col-sm-8">
							<select name="pilot_experience_locations_id[]" id="pilot_experience_locations_id" class="form-control select2_edit_profile" multiple="multiple" data-placeholder="Continent (may select multiple)">
								<?php
								foreach ($location_array as $location) {
									$selected = false;
									foreach ($pilot_experience_array as $experience) {
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
					<?php
					if (count($user_area_experience_array) > 0) {
						foreach ($user_area_experience_array as $user_area_experience) {
							?>
							<div class="form-group">
								<label for="pilot_atlantic_crossing" class="col-sm-4 control-label">Atlantic Crossings</label>
								<div class="col-sm-8">
									<select name="pilot_atlantic_crossing" id="pilot_atlantic_crossing" class="form-control select2_edit_profile" data-placeholder="Atlantic Crossings">
										<option></option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
										<option <?php echo $user_area_experience['user_area_experience_atlantic_crossings'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pilot_pacific_crossing" class="col-sm-4 control-label">Pacific Crossings</label>
								<div class="col-sm-8">
									<select name="pilot_pacific_crossing" id="pilot_pacific_crossing" class="form-control select2_edit_profile" data-placeholder="Pacific Crossings">
										<option></option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
										<option <?php echo $user_area_experience['user_area_experience_pacific_crossings'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pilot_polar_crossing" class="col-sm-4 control-label">Polar Crossings</label>
								<div class="col-sm-8">
									<select name="pilot_polar_crossing" id="pilot_polar_crossing" class="form-control select2_edit_profile" data-placeholder="Polar Crossings">
										<option></option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '1-3' ? 'selected="selected"' : ''; ?> value="1-3">1-3</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '11-20' ? 'selected="selected"' : ''; ?> value="11-20">11-20</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '21-50' ? 'selected="selected"' : ''; ?> value="21-50">21-50</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '51-100' ? 'selected="selected"' : ''; ?> value="51-100">51-100</option>
										<option <?php echo $user_area_experience['user_area_experience_polar_crossings'] === '>100' ? 'selected="selected"' : ''; ?> value=">100">>100</option>
									</select>
								</div>
							</div>
							<?php
						}
					} else {
						?>
						<div class="form-group">
							<label for="pilot_atlantic_crossing" class="col-sm-4 control-label">Atlantic Crossings</label>
							<div class="col-sm-8">
								<select name="pilot_atlantic_crossing" id="pilot_atlantic_crossing" class="form-control select2_edit_profile" data-placeholder="Atlantic Crossings">
									<option value=''></option>
									<option value="0">0</option>
									<option  value="1-3">1-3</option>
									<option  value="4-10">4-10</option>
									<option  value="11-20">11-20</option>
									<option  value="21-50">21-50</option>
									<option  value="51-100">51-100</option>
									<option  value=">100">>100</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="pilot_pacific_crossing" class="col-sm-4 control-label">Pacific Crossings</label>
							<div class="col-sm-8">
								<select name="pilot_pacific_crossing" id="pilot_pacific_crossing" class="form-control select2_edit_profile" data-placeholder="Pacific Crossings">
									<option value=''></option>
									<option  value="0">0</option>
									<option  value="1-3">1-3</option>
									<option  value="4-10">4-10</option>
									<option  value="11-20">11-20</option>
									<option  value="21-50">21-50</option>
									<option  value="51-100">51-100</option>
									<option value=">100">>100</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="pilot_polar_crossing" class="col-sm-4 control-label">Polar Crossings</label>
							<div class="col-sm-8">
								<select name="pilot_polar_crossing" id="pilot_polar_crossing" class="form-control select2_edit_profile" data-placeholder="Polar Crossings">
									<option value=''></option>
									<option  value="0">0</option>
									<option value="1-3">1-3</option>
									<option value="4-10">4-10</option>
									<option value="11-20">11-20</option>
									<option value="21-50">21-50</option>
									<option value="51-100">51-100</option>
									<option value=">100">>100</option>
								</select>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<hr/>
	<?php } ?>
</div>