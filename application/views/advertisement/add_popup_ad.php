<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Popup Ads <small>Add Popup Ads</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Popup Ads</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Popup Ads</h3>
                    </div>
                    <form id="add_popup_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="popup_ad_label" class="control-label">Label</label>
								<input type="text" name="popup_ad_label" id="popup_ad_label" class="form-control" placeholder="Popup Ad Label"/>
							</div>
							<div class="form-group">
								<label for="popup_ad_link" class="control-label">Link</label>
								<input type="text" name="popup_ad_link" id="popup_ad_link" class="form-control" placeholder="Link to navigate"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="popup_ad_image"> Select Popup Image <abbr>(*.jpg, .png)(600 x 500)</abbr></label>
								<input type="hidden" name="popup_ad_image" id="popup_ad_image">

							</div>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>advertisement/popup_ads" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="add_popup_button" type="button" class="btn btn-primary">Add Popup Ad <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script><script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#add_popup_button").click(function () {
		$("#add_popup_button").button("loading");
		$.post('', $("#add_popup_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Popup Ad Added Successfully !!!", function () {
					document.location.href = base_url + 'advertisement/popup_ads';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#add_popup_button").button("reset");
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
			multi_selection: false,
			filters: {
				max_file_size: '5mb',
				mime_types: [
					{title: "Image files", extensions: "jpg,jpeg,gif,png"}
				]
			},
			init: {
				FilesAdded: function (up, files) {
					if (image_uploader.files.length > 1) {
						image_uploader.removeFile(image_uploader.files[0]);
					}
					setTimeout(function () {
						up.start();
						$('#add_popup_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#popup_ad_image").val(file.target_name);
					$("#image-container").append('<div class="form-group"><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:120px;height:80px" class="img-responsive center-block"/></div>');
				},
				UploadComplete: function () {
					$('#add_popup_form').unblock();
				},
				Error: function (up, err) {
					$('#add_popup_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>

