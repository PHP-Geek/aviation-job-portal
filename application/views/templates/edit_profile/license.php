<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<!-- License Details -->
	<div class="register">
		<?php
		if (count($user_license_array) > 0) {
			foreach ($user_license_array as $key => $user_license) {
				?>
				<div class="clone_component_1">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4><?php
								switch ($user_details_array['job_type_slug']) {
									case 'pilot':
										echo 'Pilot Licenses';
										break;
									case 'maintenance-engineer':
										echo 'Mechanic Licenses';
										break
										;
									case 'air-traffic-controller':
										echo 'ATC Licenses';
										break;
									default:
										echo 'Licenses';
										break;
								}
								?>
							</h4>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_authorities_id">License Authority</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile license_authority-other-select" data-placeholder="&nbsp;License Authority" id="user_license_authorities_id" name="user_license_authorities_id[]">
										<option></option>
										<?php
										$other_selected = false;
										foreach ($license_authority_array as $license_authority) {
											if ($user_license['license_authorities_id'] === '0') {
												$other_selected = true;
											}
											?>
											<option <?php echo $license_authority['license_authority_id'] === $user_license['license_authorities_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
										<?php } ?>
										<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
									</select>
								</div>
							</div>
							<div class="form-group license_other_license_authority form-other-input" style="display:none">
								<label for="user_license_authority_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_authority_other_name[]" id="user_license_authority_other_name" class="form-control" placeholder="Other License Authority" value="<?php echo isset($user_license['user_license_authority_other']['user_license_authority_other_name']) && $user_license['user_license_authority_other']['user_license_authority_other_name'] !== '' ? $user_license['user_license_authority_other']['user_license_authority_other_name'] : ''; ?>"/>
								</div>
							</div>
							<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
								<div class="form-group">
									<label for="user_licenses_id" class="col-sm-4 control-label">License Type</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile license_type-other-select" data-placeholder="License Type" id="user_licenses_id" name="user_licenses_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($license_array as $license) {
												if ($user_license['licenses_id'] === '0') {
													$other_selected = true;
												}
												?>
												<option <?php
												if ($license['license_id'] === $user_license['licenses_id']) {
													echo 'selected="selected"';
												}
												?> value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] !== '' ? $license['license_type_name'] . ' ' . $license['license_type'] : $license['license_type']; ?></option>
												<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group license_other_license_type form-other-input" style="display:none">
									<label for="user_license_type_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_license_type_other_name[]" id="user_license_type_other_name" class="form-control" placeholder="Other License Type" value="<?php echo isset($user_license['user_license_type_other']['user_license_type_other_name']) && $user_license['user_license_type_other']['user_license_type_other_name'] !== '' ? $user_license['user_license_type_other']['user_license_type_other_name'] : ''; ?>"/>
									</div>
								</div>
							<?php } ?>
							<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_license_positions_id">Current Position</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile select2_edit_profile_multiple_license_position license_position-other-select" data-placeholder="&nbsp; Current Position (may select multiple)" id="user_license_positions_id" name="user_license_positions_id[<?php echo $key; ?>][]" multiple="multiple">
											<?php
											$other_selected = false;
											$position_key = '';
											foreach ($position_array as $position) {
												$selected = false;
												foreach ($user_license['user_license_position_array'] as $key1 => $user_license_position) {
													if ($user_license_position['positions_id'] === '0') {
														$position_key = $key1;
														$other_selected = true;
													}
													if ($user_license_position['positions_id'] === $position['position_id']) {
														$selected = true;
													}
												}
												?>
												<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group license_other_position form-other-input" style="display:none">
									<label for="user_license_position_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_license_position_other_name[]" id="user_license_position_other_name" class="form-control" placeholder="Other Position" value="<?php echo isset($user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name']) && $user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name'] !== '' ? $user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name'] : ''; ?>"/>
									</div>
								</div>
							<?php } ?>
							<?php if ($user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_license_positions_id">Current Position</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile license_position-other-select" data-placeholder="&nbsp;Current Position <?php $user_details_array['job_type_slug'] === 'pilot' ? '(may select multiple)' : ''; ?>" id="user_license_positions_id" name="user_license_positions_id[]">
											<option></option>
											<?php
											$other_selected = false;
											$position_key = '';
											foreach ($position_array as $position) {
												$selected = false;
												foreach ($user_license['user_license_position_array'] as $key1 => $user_license_position) {
													if ($user_license_position['positions_id'] === '0') {
														$position_key = $key1;
														$other_selected = true;
													}
													if ($user_license_position['positions_id'] === $position['position_id']) {
														$selected = true;
													}
												}
												?>
												<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group license_other_position form-other-input" style="display:none">
									<label for="user_license_position_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_license_position_other_name[]" id="user_license_position_other_name" class="form-control" placeholder="Other Position" value="<?php echo isset($user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name']) && $user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name'] !== '' ? $user_license['user_license_position_array'][$position_key]['user_license_position_other']['user_license_position_other_name'] : ''; ?>"/>
									</div>
								</div>
							<?php } ?>
							<div class="form-group">
								<label for="user_license_expire_date" class="col-sm-4 control-label">Expiry Date</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" id="user_license_expire_date" class="form-control date-picker" name="user_license_expire_date[]" placeholder="License Expire Date" value="<?php echo $user_license['user_license_expire_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_license['user_license_expire_date'])) : ''; ?>">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot') { ?>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_license_approval_ratings_id">Approvals/Ratings</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile approval_rating-other-select" data-placeholder="&nbsp; Approvals/Ratings" id="user_license_approval_ratings_id" name="user_license_approval_ratings_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($approval_rating_array as $approval_rating) {
												if ($user_license['approval_ratings_id'] === '0') {
													$other_selected = true;
												}
												?>
												<option <?php echo $approval_rating['approval_rating_id'] === $user_license['approval_ratings_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $approval_rating['approval_rating_id']; ?>"><?php echo $approval_rating['approval_rating_name']; ?></option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group license_other_approval_rating form-other-input" style="display:none">
									<label for="user_license_approval_rating_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_license_approval_rating_other_name[]" id="user_license_approval_rating_other_name" class="form-control" placeholder="Other Approval Rating" value="<?php echo isset($user_license['user_license_approval_rating_other']['user_license_approval_rating_other_name']) && $user_license['user_license_approval_rating_other']['user_license_approval_rating_other_name'] !== '' ? $user_license['user_license_approval_rating_other']['user_license_approval_rating_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_license_is_english_proficient">English Proficient</label>
									<div class="col-sm-8">
										<input type="checkbox" name="user_license_is_english_proficient[]" id="user_license_is_english_proficient" <?php echo $user_license['user_license_is_english_proficient'] === '1' ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" class="user_license_english_proficient_box"/>
									</div>
								</div>
							<?php } ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_file"></label>
								<div class="col-sm-8">
									<div id="license_upload_container<?php echo $key; ?>" class="license_upload">
										<a title="upload License" id="license_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload License</a> (doc,docx,pdf 25MB max )
										<input type="hidden" name="user_license_file[]" id="user_license_file<?php echo $key; ?>" value="<?php echo $user_license['user_license_file']; ?>" class="license_file"/>
										<input type="hidden" name="user_license_original_file[]" id="user_license_original_file<?php echo $key; ?>" value="<?php echo $user_license['user_license_original_file']; ?>" class="license_original_file"/>
										<div class="spacer9"></div>
										<span id="user_license_div<?php echo $key; ?>" class="show_file_div">
											<?php
											$font_icon = '';
											if ($user_license['user_license_file'] !== '' && is_file(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_license['user_license_file'])) {
												$ext = pathinfo($user_license['user_license_file'], PATHINFO_EXTENSION);
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
															remove_license_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
														<a href="<?php echo base_url(); ?>uploads/users/licenses<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_license['user_license_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $user_license['user_license_original_file']; ?></span>
													</div>
												</div>
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_license_array) - 1) { ?>
									<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);"><i class="fa fa-plus-circle"></i>
										<?php
										switch ($user_details_array['job_type_slug']) {
											case 'pilot':
												echo 'Add a License';
												break;
											case 'maintenance-engineer':
												echo 'Add a Maintenance License';
												break;
											default:
												echo 'Add a License';
										}
										?></a>
								<?php } else { ?>
									<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);" style="display:none"><i class="fa fa-plus-circle"></i> <?php
										switch ($user_details_array['job_type_slug']) {
											case 'pilot':
												echo 'Add a License';
												break;
											case 'maintenance-engineer':
												echo 'Add a Maintenance License';
												break;
											default:
												echo 'Add a License';
										}
										?></a>
								<?php } ?>
								<?php if (count($user_license_array) === 1) { ?>
									<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_1">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4><?php
							switch ($user_details_array['job_type_slug']) {
								case 'pilot':
									echo 'Pilot Licenses';
									break;
								case 'maintenance-engineer':
									echo 'Mechanic Licenses';
									break
									;
								case 'air-traffic-controller':
									echo 'ATC Licenses';
									break;
								default:
									echo 'Licenses';
									break;
							}
							?></h4>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_license_authorities_id">License Authority</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile license_authority-other-select" data-placeholder="&nbsp;License Authority" id="user_license_authorities_id" name="user_license_authorities_id[]">
									<option></option>
									<?php foreach ($license_authority_array as $license_authority) { ?>
										<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
									<?php } ?>                                        
									<option value="0">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group license_other_license_authority form-other-input" style="display:none">
							<label for="user_license_authority_other_name" class="col-sm-4 control-label">Other</label>
							<div class="col-sm-8">
								<input type="text" name="user_license_authority_other_name[]" id="user_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
							</div>
						</div>
						<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
							<div class="form-group" id="license_div">
								<label for="user_licenses_id" class="col-sm-4 control-label">License Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile license_type-other-select" data-placeholder="License Type" id="user_licenses_id" name="user_licenses_id[]">
										<option></option>
										<?php foreach ($license_array as $license) {
											?>
											<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] !== '' ? $license['license_type_name'] . ' ' . $license['license_type'] : $license['license_type']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group license_other_license_type form-other-input" style="display:none">
								<label for="user_license_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_type_other_name[]" id="user_license_type_other_name" class="form-control" placeholder="Other License Type"/>
								</div>
							</div>
						<?php } ?>
						<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_positions_id">Current Position</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile select2_edit_profile_multiple_license_position license_position-other-select" data-placeholder="&nbsp; Current Position (may select multiple)" id="user_license_positions_id" name="user_license_positions_id[0][]" multiple="multiple">
										<?php
										foreach ($position_array as $position) {
											?>
											<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group license_position form-other-input" style="display:none">
								<label for="user_license_position_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_position_other_name[]" id="user_license_position_other_name" class="form-control" placeholder="Other License Positions"/>
								</div>
							</div>
						<?php } ?>
						<?php if ($user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_positions_id">Current Position</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile license_position_me-other-select" data-placeholder="&nbsp;Current Position" id="user_license_positions_id" name="user_license_positions_id[]">
										<option></option>
										<?php
										foreach ($position_array as $position) {
											?>
											<option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group license_position form-other-input" style="display:none">
								<label for="user_license_position_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_position_other_name[]" id="user_license_position_other_name" class="form-control" placeholder="Other License Positions"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="user_license_expire_date" class="col-sm-4 control-label">Expiry Date</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" id="user_license_expire_date" class="form-control date-picker" name="user_license_expire_date[]" placeholder="License Expire Date" value="">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot') { ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_approval_ratings_id">Approvals/Ratings</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile approval_rating-other-select" data-placeholder="&nbsp; Approvals/Ratings" id="user_license_approval_ratings_id" name="user_license_approval_ratings_id[]">
										<option></option>
										<?php foreach ($approval_rating_array as $approval_rating) { ?>
											<option value="<?php echo $approval_rating['approval_rating_id']; ?>"><?php echo $approval_rating['approval_rating_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group license_approval_rating form-other-input" style="display:none">
								<label for="user_license_approval_rating_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_license_approval_rating_other_name[]" id="user_license_approval_rating_other_name" class="form-control" placeholder="Other Approval Ratings"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_license_is_english_proficient">English Proficient</label>
								<div class="col-sm-8">
									<input type="checkbox" name="user_license_is_english_proficient[]" id="user_license_is_english_proficient" value="0" class="user_license_english_proficient_box"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_license_file"></label>
							<div class="col-sm-8">
								<div id="license_upload_container" class="license_upload">
									<a title="upload License" id="license_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload License</a> (doc,docx,pdf 25MB max )
									<input type="hidden" name="user_license_file[]" id="user_license_file" class="license_file"/>
									<input type="hidden" name="user_license_original_file[]" id="user_license_original_file" class="license_original_file"/>
									<div class="spacer9"></div>
									<span id="user_license_div" class="show_file_div"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);"><i class="fa fa-plus-circle"></i> <?php
								switch ($user_details_array['job_type_slug']) {
									case 'pilot':
										echo 'Add a License';
										break;
									case 'maintenance-engineer':
										echo 'Add a Maintenance License';
										break;
									default:
										echo 'Add a License';
								}
								?></a>
							<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php }
		?>
	</div>
	<hr/>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
						$(document).ready(function () {
							add_license_authority_other();
							add_license_type_other();
							add_approval_rating_other();
							add_position_other();
							add_license_position_other();
							$(".license_authority-other-select").each(function (i, v) {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								}
							});
							$(".license_type-other-select").each(function (i, v) {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								}
							});
							$(".approval_rating-other-select").each(function (i, v) {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								}
							});
							$(".license_position-other-select").each(function (i, v) {
								$(".license_position-other-select option:selected").each(function (i, v) {
									if ($(this).val() === '0') {
										$(this).closest('.form-group').next('div').show();
									}
								});
							});
<?php foreach ($user_license_array as $key => $license) { ?>
								var license_uploader = new plupload.Uploader({
									runtimes: 'html5,flash,html4',
									browse_button: 'license_uploader' + <?php echo $key; ?>,
									container: 'license_upload_container' + <?php echo $key; ?>,
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
											$("#user_license_file" + <?php echo $key; ?>).val(file.target_name);
											$("#user_license_original_file" + <?php echo $key; ?>).val(file.name);
											$("#user_license_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_license_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
								license_uploader.init();
<?php } ?>
							var license_uploader1 = new plupload.Uploader({
								runtimes: 'html5,flash,html4',
								browse_button: 'license_uploader',
								container: 'license_upload_container',
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
										$("#user_license_original_file").val(file.name);
										$("#user_license_file").val(file.target_name);
										$("#user_license_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_license_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a> <br/><span>' + file.name + '</span></div></div>');
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
							license_uploader1.init();
						});
						function remove_license_file() {
							$("#user_license_file").val('');
						}
						function remove_license_file1(license_file_id) {
							$("#user_license_file" + license_file_id).val('');
						}

						function add_license_authority_other() {
							$(".license_authority-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
						function add_license_type_other() {
							$(".license_type-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
						function add_approval_rating_other() {
							$(".approval_rating-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
						function add_position_other() {
							$(".license_position-other-select").on('change', function () {
								$(".license_position-other-select option").each(function () {
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
						function add_license_position_other() {
							$(".license_position_me-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
</script>