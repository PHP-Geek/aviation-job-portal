<div id="me_rating_div">
	<?php if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') {
		?>
		<div class="register">
			<?php
			if (count($user_me_aircraft_rating_array) > 0) {
				foreach ($user_me_aircraft_rating_array as $key => $user_me_aircraft_rating) {
					?>
					<div class="clone_component_16">
						<div class="row">
							<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_current_rating">Aircraft Ratings</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile me_aircraft_rating-other-select" data-placeholder="&nbsp;Aircraft Ratings" id="user_me_aircraft_rating_type_ratings_id" name="user_me_aircraft_rating_type_ratings_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($me_type_rating_array as $type_rating) {
												if ($user_me_aircraft_rating['type_ratings_id'] === '0') {
													$other_selected = true;
												}
												?>
												<option <?php echo $type_rating['type_rating_id'] === $user_me_aircraft_rating['type_ratings_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $type_rating['type_rating_id']; ?>">
													<?php echo $type_rating['type_rating_name']; ?>
												</option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group me_aircraft_rating_other form-other-input" style="display:none">
									<label for="user_me_aircraft_rating_type_rating_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_me_aircraft_rating_type_rating_other_name[]" id="user_me_aircraft_rating_type_rating_other_name" class="form-control" placeholder="Other Aircraft Rating" value="<?php echo isset($user_me_aircraft_rating['user_me_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name']) && $user_me_aircraft_rating['user_me_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name'] !== '' ? $user_me_aircraft_rating['user_me_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_aircraft_rating_coverage">Coverage</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile select2_edit_profile_me_multiple_coverage me_aircraft_rating_coverage-other" data-placeholder="&nbsp;Coverage (may select multiple)" id="user_me_aircraft_rating_coverage" name="user_me_aircraft_rating_coverage[<?php echo $key; ?>][]" multiple="multiple">
											<?php
											$coverage_array = array('Avionics', 'Airframe', 'Engines', 'Other');
											$me_coverage_key = '';
											foreach ($coverage_array as $coverages) {
												$selected = false;
												foreach ($user_me_aircraft_rating['user_me_aircraft_rating_coverages'] as $key1 => $coverage) {
													if ($coverage['user_aircraft_rating_coverage_name'] === 'Other') {
														$me_coverage_key = $key1;
													}
													if ($coverage['user_aircraft_rating_coverage_name'] == $coverages) {
														$selected = true;
														break;
													}
												}
												?>
												<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $coverages; ?>"><?php echo $coverages; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group" style="display:none">
									<label class="col-sm-4 control-label" for="user_me_aircraft_rating_coverage_other_name">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_me_aircraft_rating_coverage_other_name[]" id="user_me_aircraft_rating_coverage_other_name" class="form-control" placeholder="Other Coverage" value="<?php echo isset($user_me_aircraft_rating['user_me_aircraft_rating_coverages'][$me_coverage_key]['user_aircraft_rating_other']['user_aircraft_rating_coverage_other_name']) && $user_me_aircraft_rating['user_me_aircraft_rating_coverages'][$me_coverage_key]['user_aircraft_rating_other']['user_aircraft_rating_coverage_other_name'] !== '' ? $user_me_aircraft_rating['user_me_aircraft_rating_coverages'][$me_coverage_key]['user_aircraft_rating_other']['user_aircraft_rating_coverage_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_aircraft_rating_is_current">Current</label>
									<div class="col-sm-8">
										<input type="checkbox" name="user_me_aircraft_rating_is_current[]" id="user_me_aircraft_rating_is_current" <?php echo $user_me_aircraft_rating['user_aircraft_rating_is_current'] === '1' ? 'checked="checked"' : ''; ?> class="user_aircraft_rating_me_is_current_box" value="<?php echo $key; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_aircraft_rating_last_worked_on_ac">Last Worked on Aircraft</label>
									<div class="col-sm-8">
										<span class="input-group date edit_profile_date_picker">
											<input type="text" id="user_me_aircraft_rating_last_worked_on_ac" name="user_me_aircraft_rating_last_worked_on_ac[]" class="form-control" placeholder="Last Worked on Aircraft" value="<?php echo $user_me_aircraft_rating['user_aircraft_rating_last_worked_on_ac'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_me_aircraft_rating['user_aircraft_rating_last_worked_on_ac'])) : ''; ?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_aircraft_rating_year_of_experience">Years Experience</label>
									<div class="col-sm-8">
										<input type="text" name="user_me_aircraft_rating_year_of_experience[]" id="user_me_aircraft_rating_year_experience" class="form-control" placeholder="Year Experience" value="<?php echo $user_me_aircraft_rating['user_aircraft_rating_year_of_experience']; ?>"/>
									</div>
								</div>
								<div class="text-right">
									<?php if ($key === count($user_me_aircraft_rating_array) - 1) { ?>
										<a class="clone_component_button_16" href="javascript:;" onclick="clone_component(this, 16);"><i class="fa fa-plus-circle"></i> Add a Rating</a>
									<?php } else { ?>
										<a class="clone_component_button_16" href="javascript:;" onclick="clone_component(this, 16);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Rating</a>
									<?php } ?>
									<?php if (count($user_me_aircraft_rating_array) === 1) { ?>
										<a class="remove_component_button_16" href="javascript:;" onclick="remove_component(this, 16);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } else { ?>
										<a class="remove_component_button_16" href="javascript:;" onclick="remove_component(this, 16);"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="clone_component_16">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_current_rating">Aircraft Ratings</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile me_aircraft_rating-other-select" data-placeholder="&nbsp;Aircraft Ratings" id="user_me_aircraft_rating_type_ratings_id" name="user_me_aircraft_rating_type_ratings_id[]">
										<option></option>
										<?php foreach ($me_type_rating_array as $type_rating) { ?>
											<option value="<?php echo $type_rating['type_rating_id']; ?>">											<?php echo $type_rating['type_rating_name']; ?>
											</option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group me_aircraft_rating_other form-other-input" style="display:none">
								<label for="user_me_aircraft_rating_type_rating_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_me_aircraft_rating_type_rating_other_name[]" id="user_me_aircraft_rating_type_rating_other_name" class="form-control" placeholder="Other Aircraft Rating"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_aircraft_rating_coverage">Coverage</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile select2_edit_profile_me_multiple_coverage me_aircraft_rating_coverage-other" data-placeholder="&nbsp;Coverage (may select multiple)" id="user_me_aircraft_rating_coverage" name="user_me_aircraft_rating_coverage[0][]" multiple="multiple">
										<option value="Avionics">Avionics</option>
										<option value="Airframe">Airframe</option>
										<option value="Engines">Engines</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group" style="display:none">
								<label class="col-sm-4 control-label" for="user_me_aircraft_rating_coverage_other_name">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_me_aircraft_rating_coverage_other_name[]" id="user_me_aircraft_rating_coverage_other_name" class="form-control" placeholder="Other Coverage"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_aircraft_rating_is_current">Current</label>
								<div class="col-sm-8">
									<input type="checkbox" value="0" name="user_me_aircraft_rating_is_current[]" id="user_me_aircraft_rating_is_current"  class="user_aircraft_rating_me_is_current_box"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_aircraft_rating_last_worked_on_ac">Last Worked on Aircraft</label>
								<div class="col-sm-8">
									<span class="input-group date edit_profile_date_picker">
										<input type="text" id="user_me_aircraft_rating_last_worked_on_ac" name="user_me_aircraft_rating_last_worked_on_ac[]" class="form-control" placeholder="Last Worked on Aircraft"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_aircraft_rating_year_of_experience">Years Experience</label>
								<div class="col-sm-8">
									<input type="text" name="user_me_aircraft_rating_year_of_experience[]" id="user_me_aircraft_rating_year_experience" class="form-control" placeholder="Year Experience"/>
								</div>
							</div>
							<div class="text-right">
								<a class="clone_component_button_16" href="javascript:;" onclick="clone_component(this, 16);"><i class="fa fa-plus-circle"></i> Add a Rating</a>
								<a class="remove_component_button_16" href="javascript:;" onclick="remove_component(this, 16);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<hr/>
	<?php } ?>
</div>
<script>
	$(function () {
		add_me_aircraft_rating_other();
		add_me_aircraft_rating_coverage_other();
		$(".me_aircraft_rating-other-select").each(function (i, v) {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			}
		});
		$(".me_aircraft_rating_coverage-other").each(function (i, v) {
			$(".me_aircraft_rating_coverage-other option:selected").each(function (i, v) {
				if ($(this).val() === 'Other') {
					$(this).closest('.form-group').next('div').show();
				}
			});
		});
	});
	function add_me_aircraft_rating_other() {
		$(".me_aircraft_rating-other-select").on('change', function () {
			if ($(this).val() === '0') {
				$(this).closest('.form-group').next('div').show();
			} else {
				$(this).closest('.form-group').next('div').hide();
			}
		});
	}
	function add_me_aircraft_rating_coverage_other() {
		$(".me_aircraft_rating_coverage-other").on('change', function () {
			$(".me_aircraft_rating_coverage-other option").each(function () {
				if ($(this).is(':selected')) {
					if ($(this).val() === 'Other') {
						$(this).closest('.form-group').next('div').show();
					} else {
						$(this).closest('.form-group').next('div').hide();
					}
				} else {
					$(this).closest('.form-group').next('div').hide();
				}
			});
		});
	}
</script>
