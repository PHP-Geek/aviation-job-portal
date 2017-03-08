<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
		<div class="form-horizontal">
			<h4>Contact Person</h4>
			<div class="form-group">
				<label for="user_first_name" class="col-sm-4 control-label">First Name <span class="required">*</span></label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_first_name" id="user_first_name" placeholder="First Name" class="form-control" value="<?php echo $user_details_array['user_first_name']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_first_name" class="col-sm-4 control-label">Last Name <span class="required">*</span></label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_last_name" id="user_last_name" placeholder="Last Name" class="form-control" value="<?php echo $user_details_array['user_last_name']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="user_business_title col-sm-4 control-label">Title</label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_business_title" id="user_business_title" value="<?php echo $user_details_array['user_business_title']; ?>" class="form-control" placeholder="Contact Person Title"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_first_name" class="col-sm-4 control-label">Email <span class="required">*</span></label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_email" id="user_email" placeholder="Email" class="form-control" value="<?php echo $user_details_array['user_email']; ?>" readonly="readonly"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_primary_contact" class="col-sm-4 control-label">Contact Number <span class="required">*</span></label>
				<div class="col-sm-8 place-error">
					<div class="input-group">
						<div class="input-group-addon" id="country_code" style="border:none;padding:0">
							<select name="user_country_code" class="select2_edit_profile" data-placeholder="Country Code" id="user_country_code">
								<option></option>
								<?php
								foreach ($country_array as $country) {
									if ($country['country_code'] != '') {
										?>
										<option <?php
										if ($user_details_array['user_country_code'] === $country['country_code']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $country['country_code']; ?>"><?php echo $country['country_name'] . '(' . $country['country_code'] . ')'; ?></option>
											<?php
										}
									}
									?>
							</select>
						</div>
						<input type="text" class="form-control" id="user_primary_contact" name="user_primary_contact" placeholder="Contact Number" value="<?php echo $user_details_array['user_primary_contact']; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="user_first_name" class="col-sm-4 control-label">Facsimile</label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_fax" id="user_fax" placeholder="Facsimile" class="form-control" value="<?php echo $user_details_array['user_fax']; ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="user_skype_id" class="col-sm-4 control-label">Skype Name</label>
				<div class="col-sm-8 place-error">
					<input type="text" name="user_skype_id" id="user_skype_id" class="form-control" value="<?php echo $user_details_array['user_skype_id']; ?>" placeholder="Skype Name"/>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<?php if ($user_details_array['employer_type_slug'] !== 'recruiter') { ?>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<div class="form-horizontal">
				<h4>Operation Information <span class="required">*</span></h4>
				<div class="form-group">
					<label for="user_skype_id" class="col-sm-4 control-label">Type of Operation</label>
					<div class="col-sm-8 place-error">
						<select class="form-control select2_edit_profile" data-placeholder="&nbsp;Type of Operation (may select multiple)" id="user_operation_types_id" name="user_operation_types_id[]" multiple="">
							<?php
							foreach ($operation_type_array as $operation_type) {
								$selected = false;
								$other_selected = false;
								foreach ($user_operation_type_array as $user_operation_type_id) {
									if ($user_operation_type_id['operation_types_id'] === $operation_type['operation_type_id']) {
										$selected = true;
									}
									if ($user_operation_type_id['operation_types_id'] === '0') {
										$other_selected = true;
									}
								}
								?>
								<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $operation_type['operation_type_id']; ?>"><?php echo $operation_type['operation_type']; ?></option>
							<?php } ?>
							<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
						</select>
					</div>
				</div>
				<div class="form-group" style="display:none" id="other_operation_type_div">
					<label for="user_skype_id" class="col-sm-4 control-label">Other Operation Type</label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_operation_type_other_name" id="user_operation_type_other_name" class="form-control" placeholder="Other Operation Type" value="<?php echo isset($user_operation_type_other['user_operation_type_other_name']) && $user_operation_type_other['user_operation_type_other_name'] !== '' ? $user_operation_type_other['user_operation_type_other_name'] : ''; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="user_skype_id" class="col-sm-4 control-label">Number of Staff</label>
					<div class="col-sm-8 place-error">
						<input type="text" name="user_number_of_staff" id="user_number_of_staff" class="form-control" value="<?php echo $user_details_array['user_number_of_staff']; ?>" placeholder="Number of Staff"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
	<?php
} else {
	if (count($user_operation_type_array) > 0) {
		foreach ($user_operation_type_array as $key => $user_operation_type) {
			?>
			<div class="clone_component_2">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<div class="form-horizontal">
							<h4>Operation Information <span class="required">*</span></h4>
							<div class="form-group">
								<label for="user_operation_type_number_of_staff" class="col-sm-4 control-label">Number of Staff</label>
								<div class="col-sm-8 place-error">
									<input type="text" name="user_operation_type_number_of_staff[]" id="user_operation_type_number_of_staff" class="form-control" value="<?php echo $user_operation_type['user_operation_type_number_of_staff']; ?>" placeholder="Number of Staff"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_operation_type_recruit_for" class="col-sm-4 control-label">Recruiter for</label>
								<div class="col-sm-8 place-error">
									<input type="text" name="user_operation_type_recruit_for[]" id="user_operation_type_recruit_for" class="form-control" value="<?php echo $user_operation_type['user_operation_type_recruit_for']; ?>" placeholder="Recruit for"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="user_operation_file"></label>
								<div class="col-sm-8">
									<div id="operation_type_upload_container<?php echo $key; ?>" class="operation_type_upload">
										<a title="Add Logo" id="operation_type_uploader<?php echo $key; ?>" href="javascript:;"><i class="fa fa-plus"></i> Add Logo (For Company) </a> (doc,docx,pdf 25MB max )
										<input type="hidden" name="user_operation_type_logo[]" id="user_operation_type_logo<?php echo $key; ?>" value="<?php echo $user_operation_type['user_operation_type_logo']; ?>" class="temp_name"/><div class="spacer9"></div>
										<input type="hidden" name="user_operation_type_original_name[]" id="user_operation_type_original_name<?php echo $key; ?>" value="<?php echo $user_operation_type['user_operation_type_original_name']; ?>" class="original_name"/><div class="spacer9"></div>
										<span id="user_operation_type_div<?php echo $key; ?>" class="show_file_div"><?php
											if (is_file(FCPATH . 'uploads/users/company_logos' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_operation_type['user_operation_type_logo'])) {
												?>
												<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove();
																		remove_operation_type_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><img src="<?php echo base_url() . 'uploads/users/company_logos' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_operation_type['user_operation_type_logo']; ?>" style="width:60px;height:60px"/><br/><span><?php echo $user_operation_type['user_operation_type_original_name']; ?></span></div></div><?php } ?>
										</span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_operation_type_array) - 1) { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add Another Company</a>
								<?php } else { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);" style="display:none"><i class="fa fa-plus-circle"></i> Add Another Company</a>
								<?php } ?>
								<?php if (count($user_operation_type_array) === 1) { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<?php
		}
	} else {
		?>			<div class="clone_component_2">
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
					<div class="form-horizontal">
						<h4>Operation Information <span class="required">*</span></h4>
						<div class="form-group">
							<label for="user_operation_type_number_of_staff" class="col-sm-4 control-label">Number of Staff</label>
							<div class="col-sm-8 place-error">
								<input type="text" name="user_operation_type_number_of_staff[]" id="user_operation_type_number_of_staff" class="form-control" placeholder="Number of Staff"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_operation_type_recruit_for" class="col-sm-4 control-label">Recruiter for</label>
							<div class="col-sm-8 place-error">
								<input type="text" name="user_operation_type_recruit_for[]" id="user_operation_type_recruit_for" class="form-control" placeholder="Recruit for"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="user_operation_type_logo"></label>
							<div class="col-sm-8">
								<div id="operation_type_upload_container" class="operation_type_upload">
									<a title="Upload Logo" id="operation_type_uploader" href="javascript:;"><i class="fa fa-plus"></i> Add Logo</a> (jpg,jpeg,png 10MB max )
									<input type="hidden" name="user_operation_type_logo[]" id="user_operation_type_logo" class="temp_name"/><div class="spacer9"></div>
									<input type="hidden" name="user_operation_type_original_name[]" id="user_operation_type_original_name" class="original_name"/><div class="spacer9"></div>
									<span id="user_operation_type_div" class="show_file_div"></span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add Another Company</a>
							<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
	<?php } ?>
<?php }
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script>
								$(document).ready(function () {
<?php foreach ($user_operation_type_array as $key => $operation_type) { ?>
										var operation_type_uploader = new plupload.Uploader({
											runtimes: 'html5,flash,html4',
											browse_button: 'operation_type_uploader<?php echo $key; ?>',
											container: 'operation_type_upload_container<?php echo $key; ?>',
											url: base_url + 'user/upload_files',
											chunk_size: '1mb',
											unique_names: true,
											flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
											silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
												mime_types: [
													{title: "Image files", extensions: "jpg,png,jpeg"}
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
													$("#user_operation_type_logo<?php echo $key; ?>").val(file.target_name);
													$("#user_operation_type_original_name<?php echo $key; ?>").val(file.name);
													$("#user_operation_type_div<?php echo $key; ?>").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_operation_type_file1(<?php echo $key; ?>);" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:70px;height:70px"/><br/><span>' + file.name + '</span></div></div>');
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
										operation_type_uploader.init();
<?php } ?>
									var operation_type_uploader1 = new plupload.Uploader({
										runtimes: 'html5,flash,html4',
										browse_button: 'operation_type_uploader',
										container: 'operation_type_upload_container',
										url: base_url + 'user/upload_files',
										chunk_size: '1mb',
										unique_names: true,
										flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
										silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {max_file_size: '26mb',
											mime_types: [
												{title: "Image files", extensions: "jpg,png,jpeg"}
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
												$("#user_operation_type_logo").val(file.target_name);
												$("#user_operation_type_original_name").val(file.name);
												$("#user_operation_type_div").html('<div class="text-center"><div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove(); remove_operation_type_file();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:70px;height:70px"/><br/><span>' + file.name + '</span></div></div>');
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
									operation_type_uploader1.init();
								});
								function remove_operation_type_file() {
									$("#user_operation_type_logo").val('');
								}
								function remove_operation_type_file1(operation_type_file_id) {
									$("#user_operation_type_logo" + operation_type_file_id).val('');
								}
</script>
<script>
	$(function () {
		$("#user_operation_types_id option:selected").each(function () {
			if ($(this).val() === '0') {
				$("#other_operation_type_div").show();
				return;
			} else {
				$("#other_operation_type_div").hide();
			}
		});
		$("#user_operation_types_id").on('change', function () {
			$("#user_operation_types_id option:selected").each(function () {
				if ($(this).val() === '0') {
					$("#other_operation_type_div").show();
					return;
				} else {
					$("#other_operation_type_div").hide();
				}
			});
		});
	});

</script>