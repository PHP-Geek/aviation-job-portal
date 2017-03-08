
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Charter Page Main Image<small>Change charter page main image</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Charter Page Image</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
				<div class="text-center well">
					<label>Charter Page Main Image : </label>
					<img src="<?php
					if (is_file(FCPATH . 'uploads/pages/charter/banner_image/' . $charter_image_array['configuration_value'])) {
						echo base_url() . 'uploads/pages/charter/banner_image/' . $charter_image_array['configuration_value'];
					} else {
						echo base_url() . 'assets/img/charter.jpg';
					}
					?>" class="img-responsive center-block" id="image_view" style="max-width: 300px;max-height: 320px"/>
				</div>
				<div class="text-center" id="thumbnail-container">
					<input type="hidden" name="charter_image" id="charter_image"/>
					<a title="" id="thumbnail_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Change Image</a> <label>Charter Image (1920 x 900)(jpg,png 10 MB max)</label><br><br>
					<a href="<?php echo base_url(); ?>aircraft/list_charter" class="btn btn-default">Cancel</a>
					<button role="button" type="button" id="charter_image_upload_button" class="btn btn-primary">Update</button>
				</div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#charter_image_upload_button").click(function () {
		$("#charter_image_upload_button").button('loading');
		$.post('', {charter_image: $("#charter_image").val()}, function (data) {
			if (data === '1') {
				bootbox.alert('Image Updated Successfully.', function () {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert('Error Updating Image');
			} else {
				bootbox.alert(data);
			}
			$("#charter_image_upload_button").button('reset');
		});
	});
	var thumbnail_uploader = new plupload.Uploader({
		runtimes: 'html5,flash,html4',
		browse_button: "thumbnail_uploader",
		container: "thumbnail-container",
		url: base_url + 'aircraft/upload_files',
		resize: {
			width: 1920,
			height: 900
		},
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
		multi_selection: true,
		filters: {
			max_file_size: '10mb',
			min_width: 1920,
			min_height: 900,
			mime_types: [
				{title: "Image files", extensions: "jpg,jpeg,png"}
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
					$('.box-body').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#image_view").attr('src', base_url + 'uploads/' + file.target_name);
				$("#charter_image").val(file.target_name);
			},
			UploadComplete: function () {
				$('.box-body').unblock();
			},
			Error: function (up, err) {
				$('.box-body').unblock();
				bootbox.alert(err.message);
			}
		}
	});
	thumbnail_uploader.init();
	plupload.addFileFilter('min_width', function (minwidth, file, cb) {
		var self = this, img = new o.Image();
		function finalize(result) {
			img.destroy();
			img = null;
			// if rule has been violated in one way or another, trigger an error
			if (!result) {
				self.trigger('Error', {
					code: plupload.IMAGE_DIMENSIONS_ERROR,
					message: "Image width should be atleast " + minwidth + " pixels.",
					file: file
				});
			}
			cb(result);
		}
		img.onload = function () {
			// check if resolution cap is not exceeded
			finalize(img.width >= minwidth);
		};
		img.onerror = function () {
			finalize(false);
		};
		img.load(file.getSource());
	});
	plupload.addFileFilter('min_height', function (minheight, file, cb) {
		var self = this, img = new o.Image();
		function finalize(result) {
			img.destroy();
			img = null;

			// if rule has been violated in one way or another, trigger an error
			if (!result) {
				self.trigger('Error', {
					code: plupload.IMAGE_DIMENSIONS_ERROR,
					message: "Image height should be atleast " + minheight + " pixels.",
					file: file
				});
			}
			cb(result);
		}
		img.onload = function () {
			// check if resolution cap is not exceeded
			finalize(img.height >= minheight);
		};
		img.onerror = function () {
			finalize(false);
		};
		img.load(file.getSource());
	});
</script>