<!-- Aircraft Ratings Details -->
<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
	<div class="register">
		<?php
		if (count($user_aircraft_rating_array) > 0) {
			foreach ($user_aircraft_rating_array as $key => $user_aircraft_rating) {
				?>
				<div class="clone_component_13">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Pilot Aircraft Ratings</h4>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="aircraft_rating_aircrafts_id">Aircraft Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile aircraft_rating_aircraft-other-select" data-placeholder="&nbsp;Aircraft Type" id="user_aircraft_rating_my_aircrafts_id" name="user_aircraft_rating_my_aircrafts_id[]">
										<option></option>
										<?php
										$other_selected = false;
										foreach ($my_aircraft_array as $my_aircraft) {
											if ($user_aircraft_rating['my_aircrafts_id'] === '0') {
												$other_selected = true;
											}
											?>
											<option <?php echo $my_aircraft['my_aircraft_id'] === $user_aircraft_rating['my_aircrafts_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $my_aircraft['my_aircraft_id']; ?>">
												<?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?>
											</option>
										<?php } ?>
										<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
									</select>
								</div>
							</div>
							<div class="form-group aircraft_rating_aircraft_type form-other-input" style="display:none">
								<label for="user_aircraft_rating_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_aircraft_rating_aircraft_type_other_name[]" id="user_aircraft_rating_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type" value="<?php echo isset($user_aircraft_rating['user_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name']) && $user_aircraft_rating['user_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] !== '' ? $user_aircraft_rating['user_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] : ''; ?>"/>
								</div>
							</div>
							<div class="form-group license_approval_rating" style="display:none">
								<label for="user_license_approval_rating_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_approval_rating_name[]" id="user_license_approval_rating_name" class="form-control" placeholder="Other Approval Ratings"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Last Flight</label>
								<div class="col-sm-8 place-error">
									<span class="input-group date edit_profile_date_picker">
										<input type="text" id="user_aircraft_rating_last_flight" name="user_aircraft_rating_last_flight[]" class="form-control" placeholder="Last Flight" value="<?php echo $user_aircraft_rating['user_aircraft_rating_last_flight'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_aircraft_rating['user_aircraft_rating_last_flight'])) : ''; ?>"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_aircraft_rating_is_current">Hours on Type</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-4">
											<input type="text" id="user_aircraft_rating_total_hours" name="user_aircraft_rating_total_hours[]" class="form-control" placeholder="Total" value="<?php echo $user_aircraft_rating['user_aircraft_rating_total_hours']; ?>"/>
										</div>
										<div class="col-sm-4">
											<input type="text" id="user_aircraft_rating_pic_hours" name="user_aircraft_rating_pic_hours[]" class="form-control" placeholder="PIC" value="<?php echo $user_aircraft_rating['user_aircraft_rating_pic_hours']; ?>"/>
										</div>
										<div class="col-sm-4">
											<input type="text" id="user_aircraft_rating_sic_hours" name="user_aircraft_rating_sic_hours[]" class="form-control" placeholder="SIC" value="<?php echo $user_aircraft_rating['user_aircraft_rating_sic_hours']; ?>"/>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_aircraft_rating_is_current">Current</label>
								<div class="col-sm-8">
									<input type="checkbox" name="user_aircraft_rating_is_current[]" id="user_aircraft_rating_is_current" <?php echo $user_aircraft_rating['user_aircraft_rating_is_current'] === '1' ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" class="user_aircraft_rating_is_current_box"/> <span class="checkbox_label">3 takeoff and Landing Current in 90 days</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Last Recurrent Date</label>
								<div class="col-sm-8 place-error">
									<span class="input-group date edit_profile_date_picker">
										<input type="text" id="user_aircraft_rating_recurrent" name="user_aircraft_rating_recurrent[]" class="form-control" placeholder="Last Recurrent Date" value="<?php echo $user_aircraft_rating['user_aircraft_rating_recurrent'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_aircraft_rating['user_aircraft_rating_recurrent'])) : ''; ?>"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_aircraft_rating_license_authorities_id">License Authority</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile select2_edit_profile_multiple_license_authority aircraft_rating_license_authority-other-select" data-placeholder="&nbsp;License Authority(may select multiple)" id="user_aircraft_rating_license_authorities_id" name="user_aircraft_rating_license_authorities_id[<?php echo $key; ?>][]" multiple="multiple">
										<?php
										$other_selected = false;
										$license_authority_key = '';
										foreach ($license_authority_array as $license_authority) {
											$selected = false;
											foreach ($user_aircraft_rating['user_aircraft_rating_license_authorities'] as $key1 => $user_aircraft_rating_authority) {
												if ($user_aircraft_rating_authority['license_authorities_id'] === '0') {
													$license_authority_key = $key1;
													$other_selected = true;
												}
												if ($license_authority['license_authority_id'] === $user_aircraft_rating_authority['license_authorities_id']) {
													$selected = true;
												}
											}
											?>
											<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $license_authority['license_authority_id']; ?>">
												<?php echo $license_authority['license_authority_name']; ?>
											</option>
										<?php } ?>
										<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
									</select>
								</div>
							</div>
							<div class="form-group aircraft_rating_other_license_authority form-other-input" style="display:none">
								<label for="user_aircraft_rating_license_authority_other" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_aircraft_rating_license_authority_other_name[]" id="user_aircraft_rating_license_authority_other_name" class="form-control" placeholder="Other License Authority" value="<?php echo isset($user_aircraft_rating['user_aircraft_rating_license_authorities'][$license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name']) && $user_aircraft_rating['user_aircraft_rating_license_authorities'][$license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] !== '' ? $user_aircraft_rating['user_aircraft_rating_license_authorities'][$license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] : ''; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_aircraft_rating_file"></label>
								<div class="col-sm-8">
									<div id="aircraft_rating_training_upload_container<?php echo $key; ?>" class="aircraft_rating_training_upload">
										<a title="upload Visa" id="aircraft_rating_training_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload Training Records</a> (doc,docx,pdf 25MB max )
										<input type="hidden" name="user_aircraft_rating_training_file[]" id="user_aircraft_rating_training_file<?php echo $key; ?>" value="<?php echo $user_aircraft_rating['user_aircraft_rating_training_file']; ?>" class="training_file"/>
										<input type="hidden" name="user_aircraft_rating_training_original_file[]" id="user_aircraft_rating_training_original_file<?php echo $key; ?>" value="<?php echo $user_aircraft_rating['user_aircraft_rating_training_original_file']; ?>" class="training_original_file"/>
										<div class="spacer9"></div>
										<span id="user_aircraft_rating_training_div<?php echo $key; ?>" class="show_file_div">
											<?php
											if (is_file(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_aircraft_rating['user_aircraft_rating_training_file'])) {
												$ext = pathinfo($user_aircraft_rating['user_aircraft_rating_training_file'], PATHINFO_EXTENSION);
												$font_icon = 'docx';
												switch ($ext) {
													case 'pdf':
														$font_icon = 'fa-file-pdf-o';
														break;
													default:
														$font_icon = 'fa-file-word-o';
												}
												?>
												<div class="text-center">
													<div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove();
															remove_aircraft_rating_training_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
														<a href="<?php echo base_url(); ?>uploads/users/ratings<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_aircraft_rating['user_aircraft_rating_training_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_aircraft_rating['user_aircraft_rating_training_original_file']; ?></span>
													</div>
												</div>
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_aircraft_rating_array) - 1) { ?>
									<a class="clone_component_button_13" href="javascript:;" onclick="clone_component(this, 13);"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
								<?php } else { ?>
									<a class="clone_component_button_13" href="javascript:;" onclick="clone_component(this, 13);" style="display:none"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
								<?php } ?>
								<?php if (count($user_aircraft_rating_array) === 1) { ?>
									<a class="remove_component_button_13" href="javascript:;" onclick="remove_component(this, 13);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_13" href="javascript:;" onclick="remove_component(this, 13);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_13">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Pilot Aircraft Ratings</h4>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="aircraft_rating_aircrafts_id">Aircraft Type</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile aircraft_rating_aircraft-other-select" data-placeholder="&nbsp;Aircraft Type" id="user_aircraft_rating_my_aircrafts_id" name="user_aircraft_rating_my_aircrafts_id[]">
									<option></option>
									<?php foreach ($my_aircraft_array as $my_aircraft) { ?>
										<option value="<?php echo $my_aircraft['my_aircraft_id']; ?>">
											<?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?>
										</option>
									<?php } ?>
									<option value="0">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group aircraft_rating_aircraft_type form-other-input" style="display:none">
							<label for="user_aircraft_rating_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
							<div class="col-sm-8">
								<input type="text" name="user_aircraft_rating_aircraft_type_other_name[]" id="user_aircraft_rating_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Last Flight</label>
							<div class="col-sm-8 place-error">
								<span class="input-group date edit_profile_date_picker">
									<input type="text" id="user_aircraft_rating_last_flight" name="user_aircraft_rating_last_flight[]" class="form-control" placeholder="Last Flight" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_aircraft_rating_is_current">Hours on Type</label>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-4">
										<input type="text" id="user_aircraft_rating_total_hours" name="user_aircraft_rating_total_hours[]" class="form-control" placeholder="Total" />
									</div>
									<div class="col-sm-4">
										<input type="text" id="user_aircraft_rating_pic_hours" name="user_aircraft_rating_pic_hours[]" class="form-control" placeholder="PIC" />
									</div>
									<div class="col-sm-4">
										<input type="text" id="user_aircraft_rating_sic_hours" name="user_aircraft_rating_sic_hours[]" class="form-control" placeholder="SIC" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_aircraft_rating_is_current">Current</label>
							<div class="col-sm-8">
								<input type="checkbox" name="user_aircraft_rating_is_current[]" id="user_aircraft_rating_is_current" value="0" class="user_aircraft_rating_is_current_box"/> <span class="checkbox_label">3 takeoff and Landing Current in 90 days</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Last Recurrent Date</label>
							<div class="col-sm-8 place-error">
								<span class="input-group date edit_profile_date_picker">
									<input type="text" id="user_aircraft_rating_recurrent" name="user_aircraft_rating_recurrent[]" class="form-control" placeholder="Last Recurrent Date"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_aircraft_rating_license_authorities_id">License Authority</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile select2_edit_profile_multiple_license_authority aircraft_rating_license_authority-other-select" data-placeholder="&nbsp;License Authority(may select multiple)" id="user_aircraft_rating_license_authorities_id" name="user_aircraft_rating_license_authorities_id[0][]" multiple="multiple">
									<?php foreach ($license_authority_array as $license_authority) { ?>
										<option data-child_value ="<?php echo $license_authority['license_authority_child_name']; ?>" value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group aircraft_rating_license_authority_other form-other-input" style="display:none">
							<label for="user_aircraft_rating_license_authority_other_name" class="col-sm-4 control-label">Other</label>
							<div class="col-sm-8">
								<input type="text" name="user_aircraft_rating_license_authority_other_name[]" id="user_aircraft_rating_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_aircraft_rating_training_file"></label>
							<div class="col-sm-8">
								<div id="aircraft_rating_training_upload_container" class="aircraft_rating_training_upload">
									<a title="upload Training Records" id="aircraft_rating_training_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload Training Records</a> (doc,docx,pdf 25MB max )
									<input type="hidden" name="user_aircraft_rating_training_file[]" id="user_aircraft_rating_training_file" class="training_file"/>
									<input type="hidden" name="user_aircraft_rating_training_original_file[]" id="user_aircraft_rating_training_original_file" class="training_original_file"/>
									<div class="spacer9"></div>
									<span id="user_aircraft_rating_training_div" class="show_file_div"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_13" href="javascript:;" onclick="clone_component(this, 13);"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
							<a class="remove_component_button_13" href="javascript:;" onclick="remove_component(this, 13);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<hr/>
	<?php
}
if ($user_details_array['job_type_slug'] === 'air-traffic-controller') {
	?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4>ATC Ratings</h4>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="type_ratings_id">Ratings</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile" data-placeholder="&nbsp; Current Type Ratings (may select multiple)" id="type_ratings_id" name="type_ratings_id[]" multiple="multiple">
						<?php
						$other_selected = false;
						$user_type_rating_key = '';
						foreach ($type_rating_array as $type_rating) {
							$selected = false;
							foreach ($user_rating_array as $key1 => $rating) {
								if ($rating['type_ratings_id'] === '0') {
									$user_type_rating_key = $key1;
									$other_selected = true;
								}
								if ($rating['type_ratings_id'] === $type_rating['type_rating_id']) {
									$selected = true;
								}
							}
							?>
							<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $type_rating['type_rating_id']; ?>"><?php echo $type_rating['type_rating_name']; ?></option>
						<?php } ?>
						<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
					</select>
				</div>
			</div>
			<div class="form-group aircraft_rating_type_rating_other form-other-input" style="display:none">
				<label for="user_rating_other_name" class="col-sm-4 control-label">Other</label>
				<div class="col-sm-8">
					<input type="text" name="user_rating_other_name" id="user_rating_other_name" class="form-control" placeholder="Other Rating" value="<?php echo isset($user_rating_array[$user_type_rating_key]['user_type_rating_other']['user_rating_other_name']) && $user_rating_array[$user_type_rating_key]['user_type_rating_other']['user_rating_other_name'] !== '' ? $user_rating_array[$user_type_rating_key]['user_type_rating_other']['user_rating_other_name'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Endorsement(s)</label>
				<div class="col-sm-8">
					<select class="form-control select2_edit_profile" id="user_endorsement" name="user_endorsement" data-placeholder="&nbsp;Endorsement(s)">
						<option></option>
						<?php foreach ($endorsement_array as $endorsement) { ?>
							<option <?php echo $endorsement === $user_details_array['user_endorsement'] ? 'selected="selected"' : ''; ?> value="<?php echo $endorsement; ?>"><?php echo $endorsement; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group form-other-input" style="display:none">
				<label class="col-sm-4 control-label" for="user_endorsement_other">Other Endorsements</label>
				<div class="col-sm-8">
					<input type="text" name="user_endorsement_other" id="user_endorsement_other" class="form-control" placeholder="Other Enodorsement" value="<?php echo isset($user_details_array['user_endorsement_other']) && $user_details_array['user_endorsement_other'] !== '' ? $user_details_array['user_endorsement_other'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group" style="display:none">
				<label class="col-sm-4 control-label" for="user_endorsement_unit">Select Unit</label>
				<div class="col-sm-8">
					<input type="text" name="user_endorsement_unit" id="user_endorsement_unit" class="form-control" placeholder="Select Unit" value="<?php echo isset($user_details_array['user_endorsement_unit']) && $user_details_array['user_endorsement_unit'] !== '' ? $user_details_array['user_endorsement_unit'] : ''; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_airport_area">Location/Airport/Area/Unit</label>
				<div class="col-sm-8">
					<input type="text" name="user_airport_area" id="user_airport_area" class="form-control" placeholder="Location/Airport/Area/Unit" value="<?php echo $user_details_array['user_airport_area']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_last_check">Last Check</label>
				<div class="col-sm-8">
					<div class="input-group date edit_profile_date_picker">
						<input type="text" id="user_last_check" class="form-control date-picker" name="user_last_check" placeholder="Last Check" value="<?php echo $user_details_array['user_last_check'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_details_array['user_last_check'])) : ''; ?>">
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="user_years_of_experience">Years of Experience</label>
				<div class="col-sm-8">
					<input type="text" name="user_years_of_experience" id="user_years_of_experience" class="form-control" placeholder="Years of Experience" value="<?php echo $user_details_array['user_years_of_experience'] === '0' ? '' : $user_details_array['user_years_of_experience']; ?>"/>
				</div>
			</div>
		</div>
	</div>
	<hr/>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
						$(document).ready(function () {
							add_aircraft_rating_aircraft_type_other();
							add_aircraft_rating_license_authority_other();
							add_aircraft_rating_other_type_rating();
							$('#user_endorsement').on('change', function () {
								if ($(this).val() === 'Other') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
								if ($(this).val() === 'Unit') {
									$(this).closest('.form-group').next().next('div').show();
								} else {
									$(this).closest('.form-group').next().next('div').hide();
								}
							});
							$("#user_endorsement").each(function (i, v) {
								if ($(this).val() === 'Other') {
									$(this).closest('.form-group').next('div').show();
								}
								if ($(this).val() === 'Unit') {
									$(this).closest('.form-group').next().next('div').show();
								}
							});
							$(".aircraft_rating_aircraft-other-select").each(function (i, v) {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								}
							});
							$(".aircraft_rating_license_authority-other-select").each(function (i, v) {
								$(".aircraft_rating_license_authority-other-select option:selected").each(function (i, v) {
									if ($(this).val() === '0') {
										$(this).closest('.form-group').next('div').show();
									}
								});
							});
							$("#type_ratings_id").each(function (i, v) {
								$("#type_ratings_id option:selected").each(function (i, v) {
									if ($(this).val() === '0') {
										$(this).closest('.form-group').next('div').show();
									}
								});
							});
<?php foreach ($user_aircraft_rating_array as $key => $aircraft_rating) { ?>
								var aircraft_rating_training_uploader = new plupload.Uploader({
									runtimes: 'html5,flash,html4',
									browse_button: 'aircraft_rating_training_uploader' + <?php echo $key; ?>,
									container: 'aircraft_rating_training_upload_container' + <?php echo $key; ?>,
									url: base_url + 'user/upload_files',
									chunk_size: '1mb',
									unique_names: true,
									flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
									silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
										mime_types: [
											{title: "Document files", extensions: "pdf,doc,docx"}
										]
									},
									init: {
										FilesAdded: function (up, files) {
											setTimeout(function () {
												up.start();
												$(window).block({message: 'Please wait...'});
											}, 1);
										},
										FileUploaded: function (up, file) {
											var file_extension_array = file.target_name.split('.');
											var file_extension = file_extension_array[file_extension_array.length - 1];
											var file_icon = '';
											switch (file_extension) {
												case 'pdf':
													var file_icon = 'fa-file-pdf-o';
													break;
												case 'doc':
												case 'docx':
													var file_icon = 'fa-file-word-o';
													break;
												default :
													var file_icon = 'fa-file-word-o';
													break;
											}
											$("#user_aircraft_rating_training_file" + <?php echo $key; ?>).val(file.target_name);
											$("#user_aircraft_rating_training_original_file" + <?php echo $key; ?>).val(file.name);
											$("#user_aircraft_rating_training_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_aircraft_rating_training_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
										},
										UploadComplete: function () {
											$(window).unblock();
										},
										Error: function (up, err) {
											$(window).unblock();
											bootbox.alert(err.message);
										}
									}
								});
								aircraft_rating_training_uploader.init();
<?php } ?>
							var aircraft_rating_training1 = new plupload.Uploader({
								runtimes: 'html5,flash,html4',
								browse_button: 'aircraft_rating_training_uploader',
								container: 'aircraft_rating_training_upload_container',
								url: base_url + 'user/upload_files',
								chunk_size: '1mb',
								unique_names: true,
								flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
								silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
									mime_types: [
										{title: "Document files", extensions: "pdf,doc,docx"}
									]
								},
								init: {
									FilesAdded: function (up, files) {
										setTimeout(function () {
											up.start();
											$(window).block({message: 'Please wait...'});
										}, 1);
									},
									FileUploaded: function (up, file) {
										var file_extension_array = file.target_name.split('.');
										var file_extension = file_extension_array[file_extension_array.length - 1];
										var file_icon = '';
										switch (file_extension) {
											case 'pdf':
												var file_icon = 'fa-file-pdf-o';
												break;
											case 'doc':
											case 'docx':
												var file_icon = 'fa-file-word-o';
												break;
											default :
												var file_icon = 'fa-file-word-o';
												break;
										}
										$("#user_aircraft_rating_training_file").val(file.target_name);
										$("#user_aircraft_rating_training_original_file").val(file.target_name);
										$("#user_aircraft_rating_training_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_aircraft_rating_training_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
									},
									UploadComplete: function () {
										$(window).unblock();
									},
									Error: function (up, err) {
										$(window).unblock();
										bootbox.alert(err.message);
									}
								}
							});
							aircraft_rating_training1.init();
						});
						function remove_aircraft_rating_training_file() {
							$("#user_aircraft_rating_training_file").val('');
						}
						function remove_aircraft_rating_training_file1(aircraft_rating_training_file_id) {
							$("#user_aircraft_rating_training_file" + aircraft_rating_training_file_id).val('');
						}
						function add_aircraft_rating_aircraft_type_other() {
							$(".aircraft_rating_aircraft-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
						function add_aircraft_rating_license_authority_other() {
							$(".aircraft_rating_license_authority-other-select").on('change', function () {
								$(".aircraft_rating_license_authority-other-select option").each(function () {
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
						}
						function add_aircraft_rating_other_type_rating() {
							$("#type_ratings_id").on('change', function () {
								if ($("#type_ratings_id option:selected").length > 0) {
									$("#type_ratings_id option:selected").each(function () {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										} else {
											$(this).closest('.form-group').next('div').hide();
										}
									});
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
</script>