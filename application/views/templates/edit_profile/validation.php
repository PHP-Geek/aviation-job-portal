<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<!-- Validation details -->
	<?php // if (isset($user_details_array['job_type_slug']) && $user_details_array['job_type_slug'] === 'pilot') { ?>
	<div class="register">
		<?php
		if (count($user_validation_array) > 0) {
			foreach ($user_validation_array as $key => $user_validation) {
				?>
				<div class="clone_component_2">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Validations</h4>
							<div class="form-group">
								<div class="form-group">
									<label for="user_validation_countries_id" class="col-sm-4 control-label">Country</label>
									<div class="col-sm-8">
										<select name="user_validation_countries_id[]" class="form-control select2_edit_profile" id="user_validation_countries_id" data-placeholder="Country">
											<option></option>
											<?php
											foreach ($country_array as $country) {
												?>
												<option <?php
												if ($country['country_id'] === $user_validation['countries_id']) {
													echo 'selected="selected"';
												}
												?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
													<?php
												}
												?>
										</select>
									</div>
								</div>
								<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer') { ?>
									<div class="form-group">
										<label for="user_validation_type" class="col-sm-4 control-label">Type</label>
										<div class="col-sm-8">
											<select name="user_validation_licenses_id[]" class="form-control select2_edit_profile user_validation_license_type-other-select" id="user_validation_licenses_id" data-placeholder="Type">
												<option></option>
												<?php
												$other_selected = false;
												foreach ($license_array as $license) {
													if ($user_validation['licenses_id'] === '0') {
														$other_selected = true;
													}
													?>
													<option <?php echo $license['license_id'] === $user_validation['licenses_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] . ' ' . $license['license_type']; ?></option>
												<?php } ?>
												<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
											</select>
										</div>
									</div>
									<div class="form-group validation_license_type_other form-other-input" style="display:none">
										<label for="user_validation_license_type_other_name" class="col-sm-4 control-label">Other</label>
										<div class="col-sm-8">
											<input type="text" name="user_validation_license_type_other_name[]" id="user_validation_license_type_other_name" class="form-control" placeholder="Other License Type" value="<?php echo isset($user_validation['user_validation_license_type_other']['user_validation_license_type_other_name']) && $user_validation['user_validation_license_type_other']['user_validation_license_type_other_name'] !== '' ? $user_validation['user_validation_license_type_other']['user_validation_license_type_other_name'] : ''; ?>"/>
										</div>
									</div>
								<?php } ?>
								<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
									<div class="form-group">
										<label for="user_validation_my_aircrafts_id" class="col-sm-4 control-label">Aircraft Type</label>
										<div class="col-sm-8">
											<select name="user_validation_my_aircrafts_id[]" class="form-control select2_edit_profile user_validation_my_aircraft-other-select" id="user_validation_my_aircrafts_id" data-placeholder="Aircraft Type">
												<option></option>
												<?php
												$other_selected = false;
												foreach ($my_aircraft_array as $my_aircraft) {
													if ($user_validation['my_aircrafts_id'] === '0') {
														$other_selected = true;
													}
													?>
													<option <?php echo $my_aircraft['my_aircraft_id'] === $user_validation['my_aircrafts_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $my_aircraft['my_aircraft_id']; ?>">
														<?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?>
													</option>
												<?php } ?>
												<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
											</select>
										</div>
									</div>
									<div class="form-group validation_aircraft_other form-other-input" style="display:none">
										<label for="user_validation_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
										<div class="col-sm-8">
											<input type="text" name="user_validation_aircraft_type_other_name[]" id="user_validation_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type" value="<?php echo isset($user_validation['user_validation_aircraft_type_other']['user_validation_aircraft_type_other_name']) && $user_validation['user_validation_aircraft_type_other']['user_validation_aircraft_type_other_name'] !== '' ? $user_validation['user_validation_aircraft_type_other']['user_validation_aircraft_type_other_name'] : ''; ?>"/>
										</div>
									</div>
								<?php } ?>
								<div class="form-group">
									<label for="user_validation_expire_date" class="col-sm-4 control-label">Expiry Date</label>
									<div class="col-sm-8">
										<div class="input-group date edit_profile_date_picker">
											<input type="text" id="user_validation_expire_date" name="user_validation_expire_date[]" class="form-control" placeholder="Expiry Date" value="<?php echo $user_validation['user_validation_expire_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_validation['user_validation_expire_date'])) : ''; ?>">
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_validation_file"></label>
									<div class="col-sm-8">
										<div id="validation_upload_container<?php echo $key; ?>" class="validation_upload">
											<a title="upload Validation" id="validation_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload Validation</a> (doc,docx,pdf 25MB max )
											<input type="hidden" name="user_validation_file[]" id="user_validation_file<?php echo $key; ?>" value="<?php echo $user_validation['user_validation_file']; ?>" class="validation_file"/>
											<input type="hidden" name="user_validation_original_file[]" id="user_validation_original_file<?php echo $key; ?>" value="<?php echo $user_validation['user_validation_original_file']; ?>" class="validation_original_file"/>
											<div class="spacer9"></div>
											<span id="user_validation_div<?php echo $key; ?>"  class="show_file_div">
												<?php
												if (is_file(FCPATH . 'uploads/users/validations' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_validation['user_validation_file'])) {
													$ext = pathinfo($user_validation['user_validation_file'], PATHINFO_EXTENSION);
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
																				remove_validation_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
															<a href="<?php echo base_url(); ?>uploads/users/validations<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_validation['user_validation_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_validation['user_validation_original_file']; ?></span>
														</div>
													</div>
												<?php } ?>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key == count($user_validation_array) - 1) { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add a Validation</a>
								<?php } else { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Validation</a>
								<?php } ?>
								<?php if (count($user_validation_array) === 1) { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class = "clone_component_2">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Validations</h4>
						<div class = "form-group">
							<label for = "user_validation_countries_id" class="col-sm-4 control-label">Country</label>
							<div class="col-sm-8">
								<select name = "user_validation_countries_id[]" class = "form-control select2_edit_profile" id = "user_validation_countries_id" data-placeholder = "Country">
									<option></option>
									<?php
									foreach ($country_array as $country) {
										?>
										<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer') { ?>
							<div class="form-group">
								<label for="user_validation_type" class="col-sm-4 control-label">Type</label>
								<div class="col-sm-8">
									<select name="user_validation_licenses_id[]" class="form-control select2_edit_profile user_validation_license_type-other-select" id="user_validation_licenses_id" data-placeholder="Type">
										<option></option>
										<?php foreach ($license_array as $license) { ?>
											<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] . ' ' . $license['license_type']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group validation_license_type_other form-other-input" style="display:none">
								<label for="user_validation_license_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_validation_license_type_other_name[]" id="user_validation_license_type_other_name" class="form-control" placeholder="Other License Type"/>
								</div>
							</div>
						<?php } ?>
						<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
							<div class="form-group">
								<label for="user_validation_my_aircrafts_id" class="col-sm-4 control-label">Aircraft Type</label>
								<div class="col-sm-8">
									<select name="user_validation_my_aircrafts_id[]" class="form-control select2_edit_profile user_validation_my_aircraft-other-select" id="user_validation_my_aircrafts_id" data-placeholder="Aircraft Type">
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
							<div class="form-group validation_aircraft_other form-other-input" style="display:none">
								<label for="user_validation_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_validation_aircraft_type_other_name[]" id="user_validation_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type"/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group">
							<label for="user_validation_expire_date" class="col-sm-4 control-label">Expiry Date</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" id="user_validation_expire_date" name="user_validation_expire_date[]" class="form-control" placeholder="Expiry Date">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_validation_file"></label>
							<div class="col-sm-8">
								<div id="validation_upload_container" class="validation_upload">
									<a title="upload Validation" id="validation_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload Validation</a> (doc,docx,pdf 25MB max )
									<input type="hidden" name="user_validation_file[]" id="user_validation_file" class="validation_file"/>
									<input type="hidden" name="user_validation_original_file[]" id="user_validation_original_file" class="validation_original_file"/>
									<div class="spacer9"></div>
									<span id="user_validation_div" class="show_file_div"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add a Validation</a>
							<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php }
		?>
	</div>
	<hr/>
	<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot') { ?>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
				<h4>Flight Time</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-3">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_hours">Total Hours</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_hours" id="user_total_hours" placeholder="Total Hours" value="<?php echo $user_details_array['user_total_hours']; ?>"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_pic">Total PIC</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_pic" id="user_total_pic" placeholder="Total PIC" value="<?php echo $user_details_array['user_total_pic']; ?>"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_sic">Total SIC</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_sic" id="user_total_sic" placeholder="Total SIC" value="<?php echo $user_details_array['user_total_sic']; ?>"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_jet">Total Jet</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_jet" id="user_total_jet" placeholder="Total Jet" value="<?php echo $user_details_array['user_total_jet']; ?>"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_tuboprop">Total Turboprop</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_turboprop" id="user_total_turboprop" placeholder="Total Turboprop" value="<?php echo $user_details_array['user_total_turboprop']; ?>"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_night">Total Night</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_night" id="user_total_night" placeholder="Total Night" value="<?php echo $user_details_array['user_total_night']; ?>"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="user_total_instructor">Total Instructor</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="user_total_instructor" id="user_total_instructor" placeholder="Total Instructor" value="<?php echo $user_details_array['user_total_instructor']; ?>"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<?php
	}
}
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
								$(document).ready(function () {
									add_other_validation_aircraft();
									add_other_validation_license_type();
									$(".user_validation_my_aircraft-other-select").each(function (i, v) {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										}
									});
									$(".user_validation_license_type-other-select").each(function (i, v) {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										}
									});
<?php foreach ($user_validation_array as $key => $validation) { ?>
										var validation_uploader = new plupload.Uploader({
											runtimes: 'html5,flash,html4',
											browse_button: 'validation_uploader' + <?php echo $key; ?>,
											container: 'validation_upload_container' + <?php echo $key; ?>,
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
													$("#user_validation_file" + <?php echo $key; ?>).val(file.target_name);
													$("#user_validation_original_file" + <?php echo $key; ?>).val(file.name);
													$("#user_validation_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_validation_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
										validation_uploader.init();
<?php } ?>
									var validation_uploader1 = new plupload.Uploader({
										runtimes: 'html5,flash,html4',
										browse_button: 'validation_uploader',
										container: 'validation_upload_container',
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
												$("#user_validation_file").val(file.target_name);
												$("#user_validation_original_file").val(file.name);
												$("#user_validation_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_validation_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
									validation_uploader1.init();
								});
								function remove_validation_file() {
									$("#user_validation_file").val('');
								}
								function remove_validation_file1(validation_file_id) {
									$("#user_validation_file" + validation_file_id).val('');
								}
								function add_other_validation_aircraft() {
									$(".user_validation_my_aircraft-other-select").on('change', function () {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										} else {
											$(this).closest('.form-group').next('div').hide();
										}
									});
								}
								function add_other_validation_license_type() {
									$(".user_validation_license_type-other-select").on('change', function () {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										} else {
											$(this).closest('.form-group').next('div').hide();
										}
									});
								}

</script>