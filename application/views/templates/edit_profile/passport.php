<div class="register">
	<?php
	if (count($user_passport_array) > 0) {
		foreach ($user_passport_array as $key => $user_passport) {
			?>
			<div class="clone_component_5">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Passport</h4>
						<div class="form-group">
							<label for="user_passport_number" class="col-sm-4 control-label">Number</label>
							<div class="col-sm-8">
								<input type="text" id="user_passport_number" name="user_passport_number[]" placeholder="Passport Number" class="form-control" value="<?php echo $user_passport['user_passport_number']; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_passport_countries_id" class="col-sm-4 control-label">Country</label>
							<div class="col-sm-8">
								<select name="user_passport_countries_id[]" class="form-control select2_edit_profile" id="user_passport_countries_id" data-placeholder="Country">
									<option></option>
									<?php
									foreach ($country_array as $country) {
										?>
										<option <?php
										if ($country['country_id'] === $user_passport['countries_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
											<?php
										}
										?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="user_passport_expire_date" class="col-sm-4 control-label">Expire On</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" id="user_passport_expire_date" name="user_passport_expire_date[]" class="form-control" placeholder="Expire On" value="<?php echo $user_passport['user_passport_expire_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_passport['user_passport_expire_date'])) : ''; ?>">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_passport_file"></label>
							<div class="col-sm-8">
								<div id="passport_upload_container<?php echo $key; ?>" class="passport_upload">
									<a title="upload Passport" id="passport_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Upload Passport</a> (doc,docx,pdf 25MB max )
									<input type="hidden" name="user_passport_file[]" id="user_passport_file<?php echo $key; ?>" value="<?php echo $user_passport['user_passport_file']; ?>" class="passport_file"/>
									<input type="hidden" name="user_passport_original_file[]" id="user_passport_original_file<?php echo $key; ?>" value="<?php echo $user_passport['user_passport_original_file']; ?>" class="passport_original_file"/>
									<div class="spacer9"></div>
									<span id="user_passport_div<?php echo $key; ?>" class="show_file_div"><?php
										if (is_file(FCPATH . 'uploads/users/passports' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_passport['user_passport_file'])) {
											$ext = pathinfo($user_passport['user_passport_file'], PATHINFO_EXTENSION);
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
														remove_passport_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
													<a href="<?php echo base_url(); ?>uploads/users/passports<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_passport['user_passport_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_passport['user_passport_original_file']; ?></span>
												</div>
											</div><?php } ?>
									</span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<?php if ($key == count($user_passport_array) - 1) { ?>
								<a class="clone_component_button_5" href="javascript:;" onclick="clone_component(this, 5);"><i class="fa fa-plus-circle"></i> Add a Passport</a>
							<?php } else { ?>
								<a class="clone_component_button_5" href="javascript:;" onclick="clone_component(this, 5);" style="display: none"><i class="fa fa-plus-circle"></i> Add a Passport</a>
							<?php } ?>
							<?php if (count($user_passport_array) === 1) { ?>
								<a class="remove_component_button_5" href="javascript:;" onclick="remove_component(this, 5);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
							<?php } else { ?>
								<a class="remove_component_button_5" href="javascript:;" onclick="remove_component(this, 5);"><i class="fa fa-minus-circle"></i> Remove</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		?>
		<div class="register clone_component_5">
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
					<h4>Passport</h4>
					<div class="form-group">
						<label for="user_passport_number" class="col-sm-4 control-label">Number</label>
						<div class="col-sm-8">
							<input type="text" id="user_passport_number" name="user_passport_number[]" placeholder="Passport Number" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label for="user_passport_countries_id" class="col-sm-4 control-label">Country</label>
						<div class="col-sm-8">
							<select name="user_passport_countries_id[]" class="form-control select2_edit_profile" id="user_passport_countries_id" data-placeholder="Country">
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
					<div class="form-group">
						<label for="user_passport_expire_date" class="col-sm-4 control-label">Expire On</label>
						<div class="col-sm-8">
							<div class="input-group date edit_profile_date_picker">
								<input type="text" id="user_passport_expire_date" name="user_passport_expire_date[]" class="form-control" placeholder="Expire On">
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label" for="user_passport_file"></label>
						<div class="col-sm-8">
							<div id="passport_upload_container" class="passport_upload">
								<a title="upload Passport" id="passport_uploader" href="javascript:;"><i class="fa fa-plus"></i> Upload Passport</a> (doc,docx,pdf 25MB max )
								<input type="hidden" name="user_passport_file[]" id="user_passport_file"/>
								<input type="hidden" name="user_passport_original_file[]" id="user_passport_original_file"/>
								<div class="spacer9"></div>
								<span id="user_passport_div" class="show_file_div"></span>
							</div>
						</div>
					</div>
					<div class="text-right">
						<a class="clone_component_button_5" href="javascript:;" onclick="clone_component(this, 5);"><i class="fa fa-plus-circle"></i> Add a Passport</a>
						<a class="remove_component_button_5" href="javascript:;" onclick="remove_component(this, 5);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
					</div>
				</div>
			</div>
		</div>
	<?php }
	?>
</div>
<hr/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
						$(document).ready(function () {
<?php foreach ($user_passport_array as $key => $passport) { ?>
								var passport_uploader = new plupload.Uploader({
									runtimes: 'html5,flash,html4',
									browse_button: 'passport_uploader' + <?php echo $key; ?>,
									container: 'passport_upload_container' + <?php echo $key; ?>,
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
											$("#user_passport_file" + <?php echo $key; ?>).val(file.target_name);
											$("#user_passport_original_file" + <?php echo $key; ?>).val(file.name);
											$("#user_passport_div" + <?php echo $key; ?>).html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_passport_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
								passport_uploader.init();
<?php } ?>
							var uploader = new plupload.Uploader({
								runtimes: 'html5,flash,html4',
								browse_button: 'passport_uploader',
								container: 'passport_upload_container',
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
										$("#user_passport_file").val(file.target_name);
										$("#user_passport_original_file").val(file.name);
										$("#user_passport_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_passport_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><a href = "' + base_url + 'uploads/' + file.target_name + '" target = "_blank" title="Click Here"><i class="fa ' + file_icon + ' fa-3x"></i></a><br/><span>' + file.name + '</span></div></div>');
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
							uploader.init();
						});
						function remove_passport_file() {
							$("#user_passport_file").val('');
						}
						function remove_passport_file1(passport_file_id) {
							$("#user_passport_file" + passport_file_id).val('');
						}
</script>