<div id="pilot_rating_div">
    <!-- Aircraft Ratings Details -->
	<?php if ($user_details_array['job_type_slug'] !== 'pilot') { ?>
		<div class="register">
			<?php
			if (count($user_pilot_aircraft_rating_array) > 0) {
				foreach ($user_pilot_aircraft_rating_array as $key => $pilot_aircraft_rating) {
					?>
					<div class="clone_component_18">
						<div class="row">
							<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
								<h4>Pilot Ratings</h4>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="pilot_aircraft_rating_my_aircrafts_id">Aircraft Type</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile pilot_aircraft_rating_license_type-other-select" data-placeholder="&nbsp;Aircraft Type" id="pilot_aircraft_rating_my_aircrafts_id" name="pilot_aircraft_rating_my_aircrafts_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($my_aircraft_array as $my_aircraft) {
												if ($pilot_aircraft_rating['my_aircrafts_id'] === '0') {
													$other_selected = true;
												}
												?>
												<option <?php echo $my_aircraft['my_aircraft_id'] === $pilot_aircraft_rating['my_aircrafts_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $my_aircraft['my_aircraft_id']; ?>">
													<?php echo $my_aircraft['my_aircraft_category'] !== '' ? $my_aircraft['my_aircraft_category'] . ' ' . $my_aircraft['my_aircraft_name'] : $my_aircraft['my_aircraft_name']; ?>
												</option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group pilot_aircraft_rating_aircraft_type_other form-other-input" style="display:none">
									<label for="pilot_aircraft_rating_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="pilot_aircraft_rating_aircraft_type_other_name[]" id="pilot_aircraft_rating_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type" value="<?php echo isset($pilot_aircraft_rating['user_aircraft_rating_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name']) && $pilot_aircraft_rating['user_aircraft_rating_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] !== '' ? $pilot_aircraft_rating['user_aircraft_rating_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Last Flight</label>
									<div class="col-sm-8 place-error">
										<span class="input-group date edit_profile_date_picker">
											<input type="text" id="pilot_aircraft_rating_last_flight" name="pilot_aircraft_rating_last_flight[]" class="form-control" placeholder="Last Flight" value="<?php echo $pilot_aircraft_rating['user_aircraft_rating_last_flight'] !== '0000-00-00' ? date('d/m/Y', strtotime($pilot_aircraft_rating['user_aircraft_rating_last_flight'])) : ''; ?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Recurrent</label>
									<div class="col-sm-8 place-error">
										<span class="input-group date edit_profile_date_picker">
											<input type="text" id="pilot_aircraft_rating_recurrent" name="pilot_aircraft_rating_recurrent[]" class="form-control" placeholder="Recurrent" value="<?php echo $pilot_aircraft_rating['user_aircraft_rating_recurrent'] !== '0000-00-00' ? date('d/m/Y', strtotime($pilot_aircraft_rating['user_aircraft_rating_recurrent'])) : ''; ?>"/>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="pilot_aircraft_rating_license_authorities_id">License Authority</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile select2_edit_profile_multiple_pilot_license_authority pilot_aircraft_rating_license_authority-other-select" data-placeholder="&nbsp;License Authority(may select multiple)" id="pilot_aircraft_rating_license_authorities_id" name="pilot_aircraft_rating_license_authorities_id[<?php echo $key; ?>][]" multiple="multiple">
											<?php
											$other_selected = false;
											$pilot_license_authority_key = '';
											foreach ($license_authority_array as $license_authority) {
												$selected = false;
												foreach ($pilot_aircraft_rating['user_aircraft_rating_license_authorities'] as $key1 => $user_license_authority) {
													if ($user_license_authority['license_authorities_id'] === '0') {
														$pilot_license_authority_key = $key1;
														$other_selected = true;
													}
													if ($license_authority['license_authority_id'] === $user_license_authority['license_authorities_id']) {
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
										<input type="text" name="pilot_aircraft_rating_license_authority_other_name[]" id="pilot_aircraft_rating_license_authority_other_name" class="form-control" placeholder="Other License Authority" value="<?php echo isset($pilot_aircraft_rating['user_aircraft_rating_license_authorities'][$pilot_license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name']) && $pilot_aircraft_rating['user_aircraft_rating_license_authorities'][$pilot_license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] !== '' ? $pilot_aircraft_rating['user_aircraft_rating_license_authorities'][$pilot_license_authority_key]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="pilot_aircraft_rating_file"></label>
									<div class="col-sm-8">
										<div id="pilot_aircraft_rating_training_upload_container<?php echo $key; ?>" class="pilot_aircraft_rating_upload">
											<a title="upload training file" id="pilot_aircraft_rating_training_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload Training Records</a>  (doc,docx,pdf 25MB max )
											<input type="hidden" name="pilot_aircraft_rating_training_file[]" id="pilot_aircraft_rating_training_file<?php echo $key; ?>" value="<?php echo $pilot_aircraft_rating['user_aircraft_rating_training_file']; ?>" class="pilot_training_file"/>
											<input type="hidden" name="pilot_aircraft_rating_training_original_file[]" id="pilot_aircraft_rating_training_original_file<?php echo $key; ?>" value="<?php echo $pilot_aircraft_rating['user_aircraft_rating_training_original_file']; ?>" class="pilot_training_original_file"/>
											<div class="spacer9"></div>
											<span id="pilot_aircraft_rating_training_div<?php echo $key; ?>" class="show_file_div">
												<?php
												if (is_file(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $pilot_aircraft_rating['user_aircraft_rating_training_file'])) {
													$ext = pathinfo($pilot_aircraft_rating['user_aircraft_rating_training_file'], PATHINFO_EXTENSION);
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
																remove_pilot_rating_training_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
															<a href="<?php echo base_url(); ?>uploads/users/ratings<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $pilot_aircraft_rating['user_aircraft_rating_training_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $pilot_aircraft_rating['user_aircraft_rating_training_original_file']; ?></span>
														</div>
													</div>
												<?php } ?>
											</span>
										</div>
									</div>
								</div>
								<div class="text-right">
									<?php if ($key === count($user_pilot_aircraft_rating_array) - 1) { ?>
										<a class="clone_component_button_18" href="javascript:;" onclick="clone_component(this, 18);"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
									<?php } else { ?>
										<a class="clone_component_button_18" href="javascript:;" onclick="clone_component(this, 18);" style="display:none"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
									<?php } ?>
									<?php if (count($user_pilot_aircraft_rating_array) === 1) { ?>
										<a class="remove_component_button_18" href="javascript:;" onclick="remove_component(this, 18);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } else { ?>
										<a class="remove_component_button_18" href="javascript:;" onclick="remove_component(this, 18);"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="clone_component_18">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Pilot Ratings</h4>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pilot_aircraft_rating_my_aircrafts_id">Aircraft Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile pilot_aircraft_rating_license_type-other-select" data-placeholder="&nbsp;Aircraft Type" id="pilot_aircraft_rating_my_aircrafts_id" name="pilot_aircraft_rating_my_aircrafts_id[]">
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
							<div class="form-group pilot_aircraft_rating_aircraft_type_other form-other-input" style="display:none">
								<label for="pilot_aircraft_rating_aircraft_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="pilot_aircraft_rating_aircraft_type_other_name[]" id="pilot_aircraft_rating_aircraft_type_other_name" class="form-control" placeholder="Other Aircraft Type"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Last Flight</label>
								<div class="col-sm-8 place-error">
									<span class="input-group date edit_profile_date_picker">
										<input type="text" id="pilot_aircraft_rating_last_flight" name="pilot_aircraft_rating_last_flight[]" class="form-control" placeholder="Last Flight" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Recurrent</label>
								<div class="col-sm-8 place-error">
									<span class="input-group date edit_profile_date_picker">
										<input type="text" id="pilot_aircraft_rating_recurrent" name="pilot_aircraft_rating_recurrent[]" class="form-control" placeholder="Recurrent"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pilot_aircraft_rating_license_authorities_id">License Authority</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile select2_edit_profile_multiple_pilot_license_authority pilot_aircraft_rating_license_authority-other-select" data-placeholder="&nbsp;License Authority(may select multiple)" id="pilot_aircraft_rating_license_authorities_id" name="pilot_aircraft_rating_license_authorities_id[0][]" multiple="multiple">
										<?php foreach ($license_authority_array as $license_authority) { ?>
											<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group pilot_aircraft_rating_license_authority_other form-other-input" style="display:none">
								<label for="pilot_aircraft_rating_license_authority_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="pilot_aircraft_rating_license_authority_other_name[]" id="pilot_aircraft_rating_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pilot_aircraft_rating_training_file"></label>
								<div class="col-sm-8">
									<div id="pilot_aircraft_rating_training_upload_container" class="pilot_aircraft_rating_upload">
										<a title="upload Training Records" id="pilot_aircraft_rating_training_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload Training Records</a>  (doc,docx,pdf 25MB max )
										<input type="hidden" name="pilot_aircraft_rating_training_file[]" id="pilot_aircraft_rating_training_file" class="pilot_training_file"/>
										<input type="hidden" name="pilot_aircraft_rating_training_original_file[]" id="pilot_aircraft_rating_training_original_file" class="pilot_training_original_file"/>
										<div class="spacer9"></div>
										<span id="pilot_aircraft_rating_training_div" class="show_file_div"></span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<a class="clone_component_button_18" href="javascript:;" onclick="clone_component(this, 18);"><i class="fa fa-plus-circle"></i> Add Another Aircraft Rating</a>
								<a class="remove_component_button_18" href="javascript:;" onclick="remove_component(this, 18);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<hr/>
	<?php }
	?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
							$(document).ready(function () {
								add_pilot_aircraft_rating_other_aircraft_type();
								add_pilot_aircraft_rating_other_license_authority();
								$(".pilot_aircraft_rating_license_type-other-select").each(function (i, v) {
									if ($(this).val() === '0') {
										$(this).closest('.form-group').next('div').show();
									}
								});
								$(".pilot_aircraft_rating_license_authority-other-select").each(function (i, v) {
									$(".pilot_aircraft_rating_license_authority-other-select option:selected").each(function (i, v) {
										if ($(this).val() === '0') {
											$(this).closest('.form-group').next('div').show();
										}
									});
								});
<?php foreach ($user_pilot_aircraft_rating_array as $key => $aircraft_rating) { ?>
									var pilot_aircraft_rating_training_uploader = new plupload.Uploader({
										runtimes: 'html5,flash,html4',
										browse_button: 'pilot_aircraft_rating_training_uploader' + <?php echo $key; ?>,
										container: 'pilot_aircraft_rating_training_upload_container' + <?php echo $key; ?>,
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
												$("#pilot_aircraft_rating_training_file" + <?php echo $key; ?>).val(file.target_name);
												$("#pilot_aircraft_rating_training_original_file" + <?php echo $key; ?>).val(file.name);
												$("#pilot_aircraft_rating_training_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_rating_training_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
									pilot_aircraft_rating_training_uploader.init();
<?php } ?>
								var pilot_aircraft_rating_training1 = new plupload.Uploader({
									runtimes: 'html5,flash,html4',
									browse_button: 'pilot_aircraft_rating_training_uploader',
									container: 'pilot_aircraft_rating_training_upload_container',
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
											$("#pilot_aircraft_rating_training_file").val(file.target_name);
											$("#pilot_aircraft_rating_training_original_file").val(file.name);
											$("#pilot_aircraft_rating_training_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_rating_training_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
								pilot_aircraft_rating_training1.init();
							});
							function remove_pilot_rating_training_file() {
								$("#pilot_aircraft_rating_training_file").val('');
							}
							function remove_pilot_rating_training_file1(pilot_rating_training_file_id) {
								$("#pilot_aircraft_rating_training_file" + pilot_rating_training_file_id).val('');
							}
							function add_pilot_aircraft_rating_other_aircraft_type() {
								$(".pilot_aircraft_rating_license_type-other-select").on('change', function () {
									if ($(this).val() === '0') {
										$(this).closest('.form-group').next('div').show();
									} else {
										$(this).closest('.form-group').next('div').hide();
									}
								});
							}
							function add_pilot_aircraft_rating_other_license_authority() {
								$(".pilot_aircraft_rating_license_authority-other-select").on('change', function () {
									$(".pilot_aircraft_rating_license_authority-other-select option").each(function () {
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
</script>