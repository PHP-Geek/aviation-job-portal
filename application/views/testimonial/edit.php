<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit testimonial <small>Edit Testimonial</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Testimonial</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Testimonial</h3>
					</div>
                    <form id="edit_testimonial_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="testimonial_user_name" class="control-label">Person Name</label>
								<input type="text" name="testimonial_user_name" id="testimonial_user_name" class="form-control" placeholder="Person Name" value="<?php echo $testimonial_array['testimonial_user_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="testimonial_content">Message</label>
								<textarea name="testimonial_content" class="form-control" id="testimonial_content" rows="5" placeholder="User views here..."><?php echo str_replace(array('<br />','<br>','<br/>'), '', $testimonial_array['testimonial_content']); ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="testimonial_image"> Testimonial Image <abbr> (480 x 244) (*.jpg, .png)</abbr></label>
								<a href="<?php echo base_url(); ?>uploads/testimonials<?php echo date('/Y/m/d/H/i/s/', strtotime($testimonial_array['testimonial_created'])) . $testimonial_array['testimonial_image']; ?>" target="_blank" id="testimonial_image_link">
									<img src="<?php echo base_url(); ?>uploads/testimonials<?php echo date('/Y/m/d/H/i/s/', strtotime($testimonial_array['testimonial_created'])) . $testimonial_array['testimonial_image']; ?>" style="max-height: 90px;max-width:90px" id="testimonial_image_view"/>
								</a>
								<input type="hidden" name="testimonial_image" id="testimonial_image" value="<?php echo $testimonial_array['testimonial_image']; ?>"/>
							</div>
						</div>
						<div class="box-footer text-center">
							<a href="<?php echo base_url(); ?>testimonial/lists" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel </a>
							<button id="edit_testimonial_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-angle-right"></i></button>
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
	$("#edit_testimonial_button").click(function () {
		$("#edit_testimonial_button").button("loading");
		$.post('', $("#edit_testimonial_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Testimonial Updated Successfully !!!", function () {
					document.location.href = base_url + 'testimonial/lists';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#edit_testimonial_button").button("reset");
		});
	});
</script>
<script type="text/javascript"> 	var image_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "image_uploader",
		container: "image-container",
		url: base_url + 'testimonial/upload_files',
		chunk_size: '1mb',
		unique_names: true, flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
		multi_selection: true, filters: {
			max_file_size: '5mb',
			mime_types: [{title: "Image files", extensions: "jpg,jpeg,gif,png"}
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
					$('#add_testimonial_form').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#testimonial_image").val(file.target_name);
				$("#testimonial_image_view").attr('src', base_url + 'uploads/' + file.target_name);
				$("#testimonial_image_link").attr('href', base_url + 'uploads/' + file.target_name);
			},
			UploadComplete: function () {
				$('#add_testimonial_form').unblock();
			},
			Error: function (up, err) {
				$('#add_testimonial_form').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	image_uploader.init();
</script>
