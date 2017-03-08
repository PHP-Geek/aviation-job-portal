<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Job Category <small>Edit Job Category</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Job Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Job Category</h3>
                    </div>
                    <form id="edit_job_type_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="job_type_name" class="control-label">Category Name</label>
								<input type="text" name="job_type_name" placeholder="Job Category Title" class="form-control" id="job_type_name" value="<?php echo $job_type_array['job_type_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="job_type_name" class="control-label">Description</label>
								<textarea name="job_type_description" class="form-control" id="job_type_description" placeholder="Job Category Description" rows="6"><?php echo $job_type_array['job_type_description']; ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<label>Aircraft Image</label>
								<input type="hidden" name="job_type_image" value="<?php echo $job_type_array['job_type_image']; ?>" id="job_type_image">
								<a href="<?php echo base_url() . 'uploads/job_categories' . date('/Y/m/d/H/i/s/', strtotime($job_type_array['job_type_created'])) . $job_type_array['job_type_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/job_categories' . date('/Y/m/d/H/i/s/', strtotime($job_type_array['job_type_created'])) . $job_type_array['job_type_image']; ?>" style="max-width: 100px;max-height: 100px" id="job_type_image_show"/>
								</a>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="job_type_image"> Job Category Image <abbr>(*.jpg, .png)</abbr></label>
							</div>
							<ul id="uploaded_images" style="list-style-type: none;"></ul>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>/job/categories" class="btn btn-default">Cancel</a>
							<button id="edit_job_type_button" type="button" class="btn btn-primary">Update Job Category</button>
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
	$("#edit_job_type_button").click(function () {
		$("#edit_job_type_button").button("loading");
		$.post('', $("#edit_job_type_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.confirm("Job Category Edited Successfully !!!", function (result) {
					document.location.href = base_url + 'job/categories';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_job_type_button").button("reset");
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'job/upload_files',
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
						$('#edit_job_type_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#job_type_image").val(file.target_name);
					$("#job_type_image_show").attr("src", base_url + "uploads/" + file.target_name);
					$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
				},
				UploadComplete: function () {
					$('#edit_job_type_form').unblock();
				},
				Error: function (up, err) {
					$('#edit_job_type_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>
