<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit New Advertisement</h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Advertisement</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Advertisement</h3>
                    </div>
                    <form id="edit_advertisement_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label>Advertisement Name</label>
								<input type="text" class="form-control" name="advertisement_name" id="advertisement_name" placeholder="Unique name for advertisement" value="<?php echo $advertisement_array['advertisement_name']; ?>"/>
							</div>
							<div class="form-group">
								<label>Advertisement Link</label>
								<input type="text" class="form-control" name="advertisement_link" id="advertisement_link" placeholder="Advertisement Link" value="<?php echo $advertisement_array['advertisement_link']; ?>"/>
							</div>
							<div class="form-group">
								<div id="thumbnail-container">
									<a href="javascript:;" id="thumbnail_uploader" class="btn btn-primary btn-md"/><i class="fa fa-image"></i> Chanage Image</a> <label>Advertisement Image (jpg,png)(1170 x 130)</label>
								</div>
								<input type="hidden" name="advertisement_image" id="advertisement_image" value="<?php echo $advertisement_array['advertisement_image']; ?>"/>
								<img src="<?php echo base_url() . 'uploads/advertisements/' . date('Y/m/d/H/i/s/', strtotime($advertisement_array['advertisement_created'])) . $advertisement_array['advertisement_image']; ?>" class="img-responsive center-block" style="max-width:400px" id="image_view"/>
							</div>
						</div>
						<div class="box-footer text-right">
							<a href="<?php echo base_url(); ?>advertisement" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_advertisement_button" type="button" class="btn btn-primary btn-md"> Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#edit_advertisement_button").click(function () {
		$("#edit_advertisement_button").button('loading');
		$.post('', $("#edit_advertisement_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert('Advertisement Updated Successfully.', function () {
					document.location.href = base_url + 'advertisement';
				});
			} else if (data === '0') {
				bootbox.alert('Error Updating Image');
			} else {
				bootbox.alert(data);
			}
			$("#edit_advertisement_button").button('reset');
		});
	});
	var thumbnail_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "thumbnail_uploader",
		container: "thumbnail-container",
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
					$('#edit_advertisement_form').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#image_view").attr("src", base_url + "uploads/" + file.target_name);
				$("#advertisement_image").val(file.target_name);
			},
			UploadComplete: function () {
				$('#edit_advertisement_form').unblock();
			},
			Error: function (up, err) {
				$('#edit_advertisement_form').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	thumbnail_uploader.init();
</script>