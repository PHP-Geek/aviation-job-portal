<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Position <small>Edit Position</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Position</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Position</h3>
                    </div>
                    <form id="edit_job_type_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="job_type_name" class="control-label">Position Name</label>
								<input type="text" name="job_type_name" id="job_type_name" class="form-control" placeholder="Position name" value="<?php echo $job_type_array['job_type_name']; ?>" readonly="readonly"/>
							</div>
							<div class="form-group">
								<label for="job_type_description" class="control-label">Description</label>
								<textarea rows="6" name="job_type_description" id="job_type_description" class="form-control" placeholder="Edit Position Description"><?php echo str_replace(array('<br />','<br>','<br/>'), '', $job_type_array['job_type_description']); ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="job_type_image"> Position Image <abbr>(*.jpg, .png)(480 x 244)</abbr></label>
								<a href="<?php echo base_url(); ?>uploads/job_types<?php echo date('/Y/m/d/H/i/s/', strtotime($job_type_array['job_type_created'])) . $job_type_array['job_type_image']; ?>" target="_blank" id="job_type_image_link"><img src="<?php echo base_url(); ?>uploads/job_types<?php echo date('/Y/m/d/H/i/s/', strtotime($job_type_array['job_type_created'])) . $job_type_array['job_type_image']; ?>" style="max-width:100px;max-height: 100px" id="job_type_image_view"/></a>
								<input type="hidden" id="job_type_image" name="job_type_image" value="<?php echo $job_type_array['job_type_image']; ?>"/>
							</div>
						</div>
						<div class="box-footer text-center">
							<a href="<?php echo base_url(); ?>configuration/positions" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_job_type_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#edit_job_type_button").click(function () {
		$("#edit_job_type_button").button('loading');
		$.post('', $("#edit_job_type_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Position Edited Successfully", function () {
					document.location.href = base_url + 'configuration/positions';
				});
			} else if (data === '0') {
				bootbox.alert("Error! Please try again.");
			} else {
				bootbox.alert(data);
			}
			$("#edit_job_type_button").button('reset');
		});
	});
	$(function () {
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'configuration/upload_files',
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
						$("#uploaded_images").empty();
					}
					setTimeout(function () {
						up.start();
						$('#add_job_type_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#job_type_image").val(file.target_name);
					$("#job_type_image_view").attr('src', base_url + 'uploads/' + file.target_name);
					$("#job_type_image_link").attr('href', base_url + 'uploads/' + file.target_name);
				},
				UploadComplete: function () {
					$('#add_job_type_form').unblock();
				},
				Error: function (up, err) {
					$('#add_job_type_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>
