<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Event <small>Edit Event</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li><li>Edit Event</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Event</h3>
					</div>
                    <form id="edit_event_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="event_title" class="control-label">Event Title</label>
								<input type="text" name="event_title" id="event_title" placeholder="Event Title" class="form-control" value="<?php echo $event_array['event_title']; ?>">
							</div>
							<div class="form-group">
								<label for="event_detail" class="control-label">Event Details </label>
								<textarea placeholder="Event Details Here" name="event_detail" class="form-control" id="event_detail" rows="6"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $event_array['event_detail']); ?></textarea>
							</div>
							<hr/>
							<div class="form-group text-center">
								<input type="hidden" name="event_image" id="event_image" value="<?php echo $event_array['event_image']; ?>">
								<label>Image</label>
								<a href="<?php echo base_url() . 'uploads/events/' . date('Y/m/d/H/i/s/', strtotime($event_array['event_created'])) . $event_array['event_image']; ?>" title="click here to view image" target="_blank" id="image_link">
									<img src="<?php echo base_url() . 'uploads/events/' . date('Y/m/d/H/i/s/', strtotime($event_array['event_created'])) . $event_array['event_image']; ?>" style="max-width: 100px;max-height: 100px" id="event_image_show"/></a>
							</div>
							<div class="form-group text-center" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="event_image"> Change Image (586 x 328)<abbr>(*.jpg, .png)</abbr></label>
							</div>
							<ul id="uploaded_images" style="list-style-type: none;"></ul>
						</div>
						<div class="box-footer text-center">
							<a href="<?php echo base_url(); ?>event/lists" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_event_button" type="button" class="btn btn-primary pull-right">Update Event <i class="fa fa-angle-right"></i></button>
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
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">
	$(function () {
		CKEDITOR.replace('event_detail');
	});
	$("#edit_event_button").click(function () {
		$("#edit_event_button").button('loading');
		var tab_content = CKEDITOR.instances.event_detail.getData();
		$.post('', {event_title: $('#event_title').val(), event_detail: tab_content, event_image: $('#event_image').val()}, function (data) {
			if (data === '1') {
				bootbox.alert("Event Updated Successfully", function () {
					document.location.href = base_url + 'event/lists';
				});
			} else if (data === '0') {
				bootbox.alert("Error Editing Event Type.");
			} else {
				bootbox.alert(data);
			}
			$("#edit_event_button").button('reset');
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'event/upload_files',
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
						$('#edit_event_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#event_image").val(file.target_name);
					$("#event_image_show").attr("src", base_url + "uploads/" + file.target_name);
					$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
				},
				UploadComplete: function () {
					$('#edit_event_form').unblock();
				},
				Error: function (up, err) {
					$('#edit_event_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>
