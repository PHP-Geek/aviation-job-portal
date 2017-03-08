<style>
	button.close {
		color: #000000 !important;
	}
</style>
<!-- Modal -->
<div id="upload_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Change Profile Image</h4>
			</div>
			<div class="modal-body">
				<div id="action-result" class="text-center"></div>
				<div class="row">
					<div class="col-sm-3">

						<img src="<?php
						if (is_file(FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_image'])) {
							echo base_url() . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_profile_thumb'];
						} else {
							echo base_url() . 'assets/img/profile.png';
						}
						?>" class="img-responsive center-block" id="profile_image"/>
						<input type="hidden" name="user_profile_image" id="user_profile_image" value="<?php echo $user_details_array['user_profile_image']; ?>" class="form-control">
					</div>
					<div class="col-sm-9">
						<div class="form-group text-center upload-photo" id="photo_upload_container">
							<a title="upload photo" id="photo_uploader" href="javascript:;" class="btn"><i class="fa fa-image"></i> Upload Photo</a>
							<label for="photo">Profile Image (jpg,png 10MB max )</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="update_image();">Update <i class="fa fa-plane"></i></button>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script>
					var photo_uploader = new plupload.Uploader({
						runtimes: 'html5,flash,html4',
						browse_button: "photo_uploader",
						container: "photo_upload_container",
						url: base_url + 'user/upload_files',
						chunk_size: '10mb',
						unique_names: true,
						flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
						silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap', filters: {
							max_file_size: '11mb',
							mime_types: [
								{title: "Document files", extensions: "jpg,jpeg,png"}
							]
						},
						init: {
							FilesAdded: function (up, files) {
								if (up.files.length > 1) {
									photo_uploader.removeFile(photo_uploader.files[0]);
									$("#photo_upload_container img").remove();
								}
								setTimeout(function () {
									up.start();
									$("#upload_modal").block({message: 'Please wait...'});
								}, 1);
							},
							FileUploaded: function (up, file) {
								$("#user_profile_image").val(file.target_name);
								$("#profile_image").attr('src', base_url + 'uploads/' + file.target_name);
							},
							UploadComplete: function () {
								$("#upload_modal").unblock();
							},
							Error: function (up, err) {
								$("#upload_modal").unblock();
								bootbox.alert(err.message);
							}
						}
					});
					photo_uploader.init();
					function update_image() {
						$("#upload_modal").block({message: 'Please wait...'});
						$.post(base_url + 'dashboard/update_image', {user_profile_image: $("#user_profile_image").val()}, function (data) {
							if (data === '1') {
								$("#action-result").html('<span class="text-success"><b>Profile Photo Updated Successfully.</b></span>');
								setTimeout(function () {
									document.location.href = '';
								}, 200);
							} else if (data === '0') {
								bootbox.alert("Error updating photo");
							} else {
								bootbox.alert(data);
							}
							$("#upload_modal").unblock();
						});
					}
</script>