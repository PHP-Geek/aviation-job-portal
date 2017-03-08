<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Popup Ads <small>Edit Popup Ads</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Popup Ads</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Popup Ads</h3>
                    </div>
                    <form id="edit_popup_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="popup_ad_label" class="control-label">Label</label>
								<input type="text" name="popup_ad_label" id="popup_ad_label" class="form-control" placeholder="Popup Ad Label" value="<?php echo $popup_ad_array['popup_ad_label']; ?>"/>
							</div>
							<div class="form-group">
								<label for="popup_ad_link" class="control-label">Link</label>
								<input type="text" name="popup_ad_link" id="popup_ad_link" class="form-control" placeholder="Link to navigate" value="<?php echo $popup_ad_array['popup_ad_link']; ?>"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="popup_ad_image"> Select Popup Image <abbr>(*.jpg, .png)(600 x 500)</abbr></label>
								<input type="hidden" name="popup_ad_image" id="popup_ad_image" value="<?php echo $popup_ad_array['popup_ad_image']; ?>">

							</div>
							<div class="form-group">
								<img id="image_view" src="<?php echo base_url() . 'uploads/advertisements/popup_ads/' . date('Y/m/d/H/i/s/', strtotime($popup_ad_array['popup_ad_created'])) . $popup_ad_array['popup_ad_image']; ?>" class="img-responsive center-block" style="max-width:80px;max-height:80px" alt="Popup Ad"/>
							</div>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>advertisement/popup_ads" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_popup_button" type="button" class="btn btn-primary">Update Popup Ad <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#edit_popup_button").click(function () {
		$("#edit_popup_button").button("loading");
		$.post('', $("#edit_popup_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Popup Ad Updated Successfully !!!", function () {
					document.location.href = base_url + 'advertisement/popup_ads';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_popup_button").button("reset");
		});
	});
	$(function () {
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'advertisement/upload_files',
			chunk_size: '1mb',
			unique_names: true,
			flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
			silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
			multi_selection: true,
			filters: {
				max_file_size: '10mb',
				mime_types: [
					{title: "Image files", extensions: "jpg,jpeg,gif,png"}
				]
			},
			init: {
				FilesAdded: function (up, files) {
					if (up.files.length > 1) {
						up.removeFile(up.files[0]);
						$("#uploaded_thumbnail").empty();
					}
					setTimeout(function () {
						up.start();
						$('#edit_popup_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#image_view").attr("src", base_url + "uploads/" + file.target_name);
					$("#popup_ad_image").val(file.target_name);
				},
				UploadComplete: function () {
					$('#edit_popup_form').unblock();
				},
				Error: function (up, err) {
					$('#edit_popup_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>

