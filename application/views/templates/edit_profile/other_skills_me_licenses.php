<div id="me_license_div">
	<?php if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') { ?>
		<!-- License Details -->
		<div class="register">
			<?php
			if (count($user_me_license_array) > 0) {
				foreach ($user_me_license_array as $key => $license_array) {
					?>
					<div class="clone_component_14">
						<div class="row">
							<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_license_authorities_id">License Authority</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile me_license_authority-other-select" data-placeholder="&nbsp;License Authority" id="user_me_license_authorities_id" name="user_me_license_authorities_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($license_authority_array as $license_authority) {
												if ($license_array['license_authorities_id'] === '0') {
													$other_selected = true;
												}
												?>
												<option <?php echo $license_array['license_authorities_id'] === $license_authority['license_authority_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group me_license_authority_other form-other-input" style="display:none">
									<label for="user_me_license_authority_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_me_license_authority_other_name[]" id="user_me_license_authority_other_name" class="form-control" placeholder="Other License Authority" value="<?php echo isset($license_array['user_me_license_authority_other_position']['user_license_authority_other_name']) && $license_array['user_me_license_authority_other_position']['user_license_authority_other_name'] !== '' ? $license_array['user_me_license_authority_other_position']['user_license_authority_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label for="user_me_licenses_id" class="col-sm-4 control-label">License Type</label>
									<div class="col-sm-8">
										<select class="form-control select2_edit_profile me_license_type-other-select" data-placeholder="License Type" id="user_me_licenses_id" name="user_me_licenses_id[]">
											<option></option>
											<?php
											$other_selected = false;
											foreach ($me_license_array as $license) {
												if ($license_array['licenses_id'] === '0') {
													$other_selected = TRUE;
												}
												?>
												<option <?php echo $license['license_id'] === $license_array['licenses_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] !== '' ? $license['license_type_name'] . ' ' . $license['license_type'] : $license['license_type']; ?></option>
											<?php } ?>
											<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
										</select>
									</div>
								</div>
								<div class="form-group me_license_type_other form-other-input" style="display:none">
									<label for="user_me_license_type_other_name" class="col-sm-4 control-label">Other</label>
									<div class="col-sm-8">
										<input type="text" name="user_me_license_type_other_name[]" id="user_me_license_authority_type_name" class="form-control" placeholder="Other License Type" value="<?php echo isset($license_array['user_me_license_type_other_position']['user_license_type_other_name']) && $license_array['user_me_license_type_other_position']['user_license_type_other_name'] !== '' ? $license_array['user_me_license_type_other_position']['user_license_type_other_name'] : ''; ?>"/>
									</div>
								</div>
								<div class="form-group">
									<label for="user_me_license_expire_date" class="col-sm-4 control-label">Expiry</label>
									<div class="col-sm-8">
										<div class="input-group date edit_profile_date_picker">
											<input type="text" id="user_me_license_expire_date" class="form-control date-picker" name="user_me_license_expire_date[]" placeholder="License Expire Date" value="<?php echo $license_array['user_license_expire_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($license_array['user_license_expire_date'])) : ''; ?>">
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="user_me_license_file"></label>
									<div class="col-sm-8">
										<div id="me_license_upload_container<?php echo $key; ?>" class="me_license_upload">
											<a title="upload License" id="me_license_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload License</a> (doc,docx,pdf 25MB max )
											<input type="hidden" name="user_me_license_file[]" id="user_me_license_file<?php echo $key; ?>" value="<?php echo $license_array['user_license_file']; ?>" class="me_license_file"/>
											<input type="hidden" name="user_me_license_original_file[]" id="user_me_license_original_file<?php echo $key; ?>" value="<?php echo $license_array['user_license_original_file']; ?>" class="me_license_original_file"/>
											<div class="spacer9"></div>
											<span id="user_me_license_div<?php echo $key; ?>" class="show_file_div">
												<?php
												$font_icon = '';
												if ($license_array['user_license_file'] !== '' && is_file(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $license_array['user_license_file'])) {
													$ext = pathinfo($license_array['user_license_file'], PATHINFO_EXTENSION);
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
																				remove_me_license_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
															<a href="<?php echo base_url(); ?>uploads/users/licenses<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $license_array['user_license_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $license_array['user_license_original_file']; ?></span>
														</div>
													</div>
												<?php } ?>
											</span>
										</div>
									</div>
								</div>
								<div class="text-right">
									<?php if ($key === count($user_me_license_array) - 1) { ?>
										<a class="clone_component_button_14" href="javascript:;" onclick="clone_component(this, 14);"><i class="fa fa-plus-circle"></i> Add a Maintenance License</a>
									<?php } else { ?>
										<a class="clone_component_button_14" href="javascript:;" onclick="clone_component(this, 14);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Maintenance License</a>
									<?php } ?>
									<?php if (count($user_me_license_array) === 1) { ?>
										<a class="remove_component_button_14" href="javascript:;" onclick="remove_component(this, 14);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } else { ?>
										<a class="remove_component_button_14" href="javascript:;" onclick="remove_component(this, 14);"><i class="fa fa-minus-circle"></i> Remove</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="clone_component_14">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_license_authorities_id">License Authority</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile me_license_authority-other-select" data-placeholder="&nbsp;License Authority" id="user_me_license_authorities_id" name="user_me_license_authorities_id[]">
										<option></option>
										<?php foreach ($license_authority_array as $license_authority) { ?>
											<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group me_license_authority_other form-other-input" style="display:none">
								<label for="user_me_license_authority_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_me_license_authority_other_name[]" id="user_me_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_me_licenses_id" class="col-sm-4 control-label">License Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile me_license_type-other-select" data-placeholder="License Type" id="user_me_licenses_id" name="user_me_licenses_id[]">
										<option></option>
										<?php foreach ($me_license_array as $license) {
											?>
											<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type_name'] !== '' ? $license['license_type_name'] . ' ' . $license['license_type'] : $license['license_type']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group me_license_type_other form-other-input" style="display:none">
								<label for="user_me_license_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_me_license_type_other_name[]" id="user_me_license_type_other_name" class="form-control" placeholder="Other License Type"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_me_license_expire_date" class="col-sm-4 control-label">Expiry</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" id="user_me_license_expire_date" class="form-control date-picker" name="user_me_license_expire_date[]" placeholder="License Expire Date" value="">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_me_license_file"></label>
								<div class="col-sm-8">
									<div id="me_license_upload_container" class="me_license_upload">
										<a title="upload License" id="me_license_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload License</a> (doc,docx,pdf 25MB max )
										<input type="hidden" name="user_me_license_file[]" id="user_me_license_file" class="me_license_file"/>
										<input type="hidden" name="user_me_license_original_file[]" id="user_me_license_original_file" class="me_license_original_file"/>
										<div class="spacer9"></div>
										<span id="user_me_license_div" class="show_file_div"></span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<a class="clone_component_button_14" href="javascript:;" onclick="clone_component(this, 14);"><i class="fa fa-plus-circle"></i> Add a Maintenance License</a>
								<a class="remove_component_button_14" href="javascript:;" onclick="remove_component(this, 14);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php }
	?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
									$(document).ready(function () {
										add_me_license_authority_other();
										add_me_license_type_other();
										$(".me_license_authority-other-select").each(function (i, v) {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											}
										});
										$(".me_license_authority-other-select").each(function (i, v) {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											}
										});
										$(".me_license_type-other-select").each(function (i, v) {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											}
										});
<?php foreach ($user_me_license_array as $key => $license) { ?>
											var me_license_uploader = new plupload.Uploader({
												runtimes: 'html5,flash,html4',
												browse_button: 'me_license_uploader' + <?php echo $key; ?>,
												container: 'me_license_upload_container' + <?php echo $key; ?>,
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
														$("#user_me_license_file" + <?php echo $key; ?>).val(file.target_name);
														$("#user_me_license_original_file" + <?php echo $key; ?>).val(file.name);
														$("#user_me_license_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_me_license_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
											me_license_uploader.init();
<?php } ?>
										var me_license_uploader1 = new plupload.Uploader({
											runtimes: 'html5,flash,html4',
											browse_button: 'me_license_uploader',
											container: 'me_license_upload_container',
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
													$("#user_me_license_file").val(file.target_name);
													$("#user_me_license_original_file").val(file.name);
													$("#user_me_license_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_me_license_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
										me_license_uploader1.init();
									});
									function remove_me_license_file() {
										$("#user_me_license_file").val('');
									}
									function remove_me_license_file1(me_license_file_id) {
										$("#user_me_license_file" + me_license_file_id).val('');
									}
									function add_me_license_authority_other() {
										$(".me_license_authority-other-select").on('change', function () {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
									}
									function add_me_license_type_other() {
										$(".me_license_type-other-select").on('change', function () {
											if ($(this).val() === '0') {
												$(this).closest('.form-group').next('div').show();
											} else {
												$(this).closest('.form-group').next('div').hide();
											}
										});
									}
</script>