<div id="pilot_medical_div">
	<?php
	if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot' && $user_details_array['job_type_slug'] !== 'air-traffic-controller') {
		if (count($pilot_medical_array) > 0) {
			foreach ($pilot_medical_array as $key => $user_medical_certificate) {
				?>
				<div class="clone_component_19">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Medical Certificate</h4>
							<div class="form-group">
								<label for="pilot_medical_certificate_authorities_id" class="control-label col-sm-4">Authority</label>
								<div class="col-sm-8">
									<select class="form-control pilot_medical_certificate_license_authority-other-select" name="pilot_medical_certificate_authorities_id[]" id="pilot_medical_certificate_authorities_id" data-placeholder="Authority">
										<option></option>
										<?php
										$other_selected = false;
										foreach ($license_authority_array as $license_authority) {
											if ($user_medical_certificate['license_authorities_id'] === '0') {
												$other_selected = true;
											}
											?>
											<option <?php echo $license_authority['license_authority_id'] === $user_medical_certificate['license_authorities_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
										<?php } ?>
										<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
									</select>
								</div>
							</div>
							<div class="form-group pilot_medical_certificate_license_authority_other form-other-input" style="display:none">
								<label for="pilot_medical_certificate_license_authority_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="pilot_medical_certificate_license_authority_other_name[]" id="pilot_medical_certificate_license_authority_other_name" class="form-control" placeholder="Other License Authority" value="<?php echo isset($user_medical_certificate['user_medical_certificate_authority_other']['user_medical_certificate_authority_other_name']) && $user_medical_certificate['user_medical_certificate_authority_other']['user_medical_certificate_authority_other_name'] !== '' ? $user_medical_certificate['user_medical_certificate_authority_other']['user_medical_certificate_authority_other_name'] : ''; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="pilot_medical_certificate_class" class="control-label col-sm-4">Class</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile" name="pilot_medical_certificate_class[]" id="pilot_medical_certificate_class" data-placeholder="Class">
										<option></option>
										<option <?php
										if ($user_medical_certificate['user_medical_certificate_class'] === 'First') {
											echo 'selected="selected"';
										}
										?> value = "First">First</option>
										<option <?php
										if ($user_medical_certificate['user_medical_certificate_class'] === 'Second') {
											echo 'selected="selected"';
										}
										?> value = "Second">Second</option>
										<option <?php
										if ($user_medical_certificate['user_medical_certificate_class'] === 'Third') {
											echo 'selected="selected"';
										}
										?> value = "Third">Third</option>

									</select>
								</div>
							</div>
							<div class = "form-group">
								<label for = "pilot_medical_certificate_exam_date" class="control-label col-sm-4">Exam Date</label>
								<div class="col-sm-8">
									<div class = "input-group date edit_profile_date_picker">
										<input type = "text" id = "pilot_medical_certificate_exam_date" class = "form-control" placeholder = "Exam Date" name = "pilot_medical_certificate_exam_date[]" value="<?php echo $user_medical_certificate['user_medical_certificate_exam_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_medical_certificate['user_medical_certificate_exam_date'])) : ''; ?>">
										<span class = "input-group-addon">
											<i class = "fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="pilot_medical_certificate_certificate_file"></label>
								<div class="col-sm-8">
									<div id="pilot_medical_certificate_upload_container<?php echo $key; ?>" class="pilot_medical_certificate_upload">
										<a title="upload Medical Certificate" id="pilot_medical_certificate_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload Medical</a> (doc,docx,pdf 25MB max )
										<input type="hidden" name="pilot_medical_certificate_file[]" id="pilot_medical_certificate_file<?php echo $key; ?>" value="<?php echo $user_medical_certificate['user_medical_certificate_file']; ?>" class="pilot_medical_certificate_file"/>
										<input type="hidden" name="pilot_medical_certificate_original_file[]" id="pilot_medical_certificate_original_file<?php echo $key; ?>" value="<?php echo $user_medical_certificate['user_medical_certificate_original_file']; ?>" class="pilot_medical_certificate_original_file"/>
										<div class="spacer9"></div>
										<span id="pilot_medical_certificate_div<?php echo $key; ?>" class="show_file_div">
											<?php
											if (is_file(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical_certificate['user_medical_certificate_file'])) {
												$ext = pathinfo($user_medical_certificate['user_medical_certificate_file'], PATHINFO_EXTENSION);
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
															remove_pilot_medical_certificate_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
														<a href="<?php echo base_url(); ?>uploads/users/medical_certificates<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical_certificate['user_medical_certificate_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_medical_certificate['user_medical_certificate_original_file']; ?></span>
													</div>
												</div>
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
							<div class = "text-right">
								<?php if ($key === count($pilot_medical_array) - 1) {
									?>
									<a class="clone_component_button_19" href="javascript:;" onclick="clone_component(this, 19);"><i class="fa fa-plus-circle"></i> Add a Medical Certificate</a>
								<?php } else { ?>
									<a class="clone_component_button_19" href="javascript:;" onclick="clone_component(this, 19);" style="display:none"><i class="fa fa-plus-circle"></i> Add a Medical Certificate</a>
								<?php } ?>
								<?php if (count($pilot_medical_array) === 1) { ?>
									<a class="remove_component_button_19" href="javascript:;" onclick="remove_component(this, 19);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_19" href="javascript:;" onclick="remove_component(this, 19);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_19">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Medical Certificate</h4>
						<div class="form-group">
							<label for="pilot_medical_certificate_authorities_id" class="control-label col-sm-4">Authority</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile pilot_medical_certificate_license_authority-other-select" name="pilot_medical_certificate_authorities_id[]" id="pilot_medical_certificate_authorities_id" data-placeholder="Authority">
									<option></option>
									<?php foreach ($license_authority_array as $license_authority) { ?>
										<option value="<?php echo $license_authority['license_authority_id']; ?>"><?php echo $license_authority['license_authority_name']; ?></option>
									<?php } ?>
									<option value="0">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group pilot_medical_certificate_license_authority_other form-other-input" style="display:none">
							<label for="pilot_medical_certificate_license_authority_other_name" class="col-sm-4 control-label">Other</label>
							<div class="col-sm-8">
								<input type="text" name="pilot_medical_certificate_license_authority_other_name[]" id="pilot_medical_certificate_license_authority_other_name" class="form-control" placeholder="Other License Authority"/>
							</div>
						</div>
						<div class="form-group">
							<label for="pilot_medical_certificate_class" class="control-label col-sm-4">Class</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile" name="pilot_medical_certificate_class[]" id="pilot_medical_certificate_class" data-placeholder="Class">
									<option></option>
									<option value="First">First</option>
									<option value="Second">Second</option>
									<option value="Third">Third</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="pilot_medical_certificate_exam_date" class="control-label col-sm-4">Exam Date</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" id="pilot_medical_certificate_exam_date" class="form-control" placeholder="Exam Date" name="pilot_medical_certificate_exam_date[]">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="pilot_medical_certificate_file"></label>
							<div class="col-sm-8">
								<div id="pilot_medical_certificate_upload_container" class="pilot_medical_certificate_upload">
									<a title="upload Medical Certificate" id="pilot_medical_certificate_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload Medical</a> (doc,docx,pdf 25MB max )
									<input type="hidden" name="pilot_medical_certificate_file[]" id="pilot_medical_certificate_file" class="pilot_medical_certificate_file"/>
									<input type="hidden" name="pilot_medical_certificate_original_file[]" id="pilot_medical_certificate_original_file" class="pilot_medical_certificate_original_file"/>
									<div class="spacer9"></div>
									<span id="pilot_medical_certificate_div" class="show_file_div"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_19" href="javascript:;" onclick="clone_component(this, 19);"><i class="fa fa-plus-circle"></i> Add a Medical Certificate</a>
							<a class="remove_component_button_19" href="javascript:;" onclick="remove_component(this, 19);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<hr/>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
						$(document).ready(function () {
							add_pilot_medical_certificat_license_authority_other();
							$(".pilot_medical_certificate_license_authority-other-select").each(function (i, v) {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								}
							});
<?php foreach ($pilot_medical_array as $key => $medical_certificate) { ?>
								var pilot_medical_certificate_uploader = new plupload.Uploader({
									runtimes: 'html5,flash,html4',
									browse_button: 'pilot_medical_certificate_uploader' + <?php echo $key; ?>,
									container: 'pilot_medical_certificate_upload_container' + <?php echo $key; ?>,
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
											$("#pilot_medical_certificate_file" + <?php echo $key; ?>).val(file.target_name);
											$("#pilot_medical_certificate_original_file" + <?php echo $key; ?>).val(file.name);
											$("#pilot_medical_certificate_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_medical_certificate_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
								pilot_medical_certificate_uploader.init();
<?php } ?>
							var pilot_medical_certificate_uploader1 = new plupload.Uploader({
								runtimes: 'html5,flash,html4',
								browse_button: 'pilot_medical_certificate_uploader',
								container: 'pilot_medical_certificate_upload_container',
								url: base_url + 'user/upload_files',
								chunk_size: '1mb',
								unique_names: true,
								flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
								silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
									mime_types: [
										{title: "Document files", extensions: "pdf,doc,docx"}]
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
										$("#pilot_medical_certificate_file").val(file.target_name);
										$("#pilot_medical_certificate_original_file").val(file.name);
										$("#pilot_medical_certificate_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_pilot_medical_certificate_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
							pilot_medical_certificate_uploader1.init();
						});
						function remove_pilot_medical_certificate_file() {
							$("#pilot_medical_certificate_file").val('');
						}
						function remove_pilot_medical_certificate_file1(pilot_medical_certificate_file_id) {
							$("#pilot_medical_certificate_file" + pilot_medical_certificate_file_id).val('');
						}
						function add_pilot_medical_certificat_license_authority_other() {
							$(".pilot_medical_certificate_license_authority-other-select").on('change', function () {
								if ($(this).val() === '0') {
									$(this).closest('.form-group').next('div').show();
								} else {
									$(this).closest('.form-group').next('div').hide();
								}
							});
						}
</script>