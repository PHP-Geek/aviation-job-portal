<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Testimonial <small>Add Testimonial</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Testimonial</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Testimonial</h3>
					</div>
                    <form id="add_testimonial_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="testimonial_user_name" class="control-label">Person Name</label>
								<input type="text" name="testimonial_user_name" id="testimonial_user_name" class="form-control" placeholder="Person Name"/>
							</div>
							<div class="form-group">
								<label for="testimonial_content">Message</label>
								<textarea name="testimonial_content" class="form-control" id="testimonial_content" rows="5" placeholder="User views here..."></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="testimonial_image"> Testimonial Image <abbr> (480 x 244) (*.jpg, .png)</abbr></label>
							</div>
							<ul id="uploaded_images" style="list-style-type: none;"></ul>
						</div>
						<div class="box-footer text-center">
							<a href="<?php echo base_url(); ?>testimonial/lists" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="add_testimonial_button" type="button" class="btn btn-primary pull-right">Add testimonial <i class="fa fa-angle-right"></i></button>
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
	$("#add_testimonial_button").click(function () {
		$("#add_testimonial_button").button("loading");
		$.post('', $("#add_testimonial_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.confirm("Testimonial Added Successfully !!!", function (result) {
					document.location.href = base_url + 'testimonial/lists';
				});
			} else if (data === '0') {
				bootbox.alert("Error Saving Data !!!");
			} else {
				bootbox.alert(data);
			}
			$("#add_testimonial_button").button("reset");
		});
	});</script>
<script type="text/javascript">
	var image_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "image_uploader",
		container: "image-container",
		url: base_url + 'testimonial/upload_files',
		chunk_size: '1mb',
		unique_names: true, flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
		multi_selection: true, filters: {
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
					$('#add_testimonial_form').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#uploaded_images").append('<li class="col-md-6"><a title="" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><div class="panel panel-default"><div class="panel-body"><input type="hidden" name="testimonial_image" value="' + file.target_name + '"><img alt="" class="img img-responsive" src="' + base_url + 'uploads/' + file.target_name + '" /></div></div></li>');
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
