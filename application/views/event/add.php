<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Event <small>Add Event</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li><li>Add Event</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Event</h3>
					</div>
                    <form id="add_event_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="event_title" class="control-label">Event Title</label>
								<input type="text" name="event_title" id="event_title" placeholder="Event Title" class="form-control">
							</div>
							<div class="form-group">
								<label for="event_name" class="control-label">Event Details </label>
								<textarea placeholder="Event Details Here" name="event_detail" class="form-control" id="event_detail" rows="6"></textarea>
							</div>
							<hr>
							<div class="form-group text-center" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="event_image"> Add Event Image(586 x 328) <abbr>(*.jpg, .png)</abbr></label>
							</div>
							<ul id="uploaded_images" style="list-style-type: none;"></ul>
						</div>
						<div class="box-footer text-center">
							<a href="<?php echo base_url(); ?>event/lists" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="add_event_button" type="button" class="btn btn-primary pull-right">Add Event <i class="fa fa-angle-right"></i></button>
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
	$("#add_event_button").click(function () {
		$("#add_event_button").button('loading');
		var tab_content = CKEDITOR.instances.event_detail.getData();
		$.post('', {event_title: $('#event_title').val(), event_detail: tab_content, event_image: $('#event_image').val()}, function (data) {
			if (data === '1') {
				bootbox.alert("Event Added Successfully", function () {
					document.location.href = base_url + 'event/lists';
				});
			} else if (data === '0') {
				bootbox.alert("Error Adding Event Type.");
			} else {
				bootbox.alert(data);
			}
			$("#add_event_button").button('reset');
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		var thumbnail_uploader = new plupload.Uploader({
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
					if (thumbnail_uploader.files.length > 1) {
						thumbnail_uploader.removeFile(thumbnail_uploader.files[0]);
						$("#uploaded_images").empty();
					}
					setTimeout(function () {
						up.start();
						$('#add_event_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#uploaded_images").append('<li class="col-md-6"><a title="" class="pull-right remove_image_button" style="cursor:pointer" onclick="$(this).parent().remove();"><i class="fa fa-2x fa-times-circle"></i></a><div class="panel panel-default"><div class="panel-body"><input type="hidden" id="event_image" name="event_image" value="' + file.target_name + '"><img alt="" class="img img-responsive" src="' + base_url + 'uploads/' + file.target_name + '" /></div></div></li>');
				},
				UploadComplete: function () {
					$('#add_event_form').unblock();
				},
				Error: function (up, err) {
					$('#add_event_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		thumbnail_uploader.init();
	});
</script>
