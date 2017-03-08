<div class="content-wrapper">
    <section class="content-header">
        <h1 style="display:inline-block">Home Page Background Image</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Page Background Image</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
			<div class="text-center">
				<div class="text-center well">
					<label>Home page background image: </label>
					<img src="<?php
					if (is_file(FCPATH . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'])) {
						echo base_url() . 'uploads/pages/home/background_image/' . $configuration_array['configuration_value'];
					} else {
						echo base_url() . 'assets/img/banner-middle.jpg';
					}
					?>" class="img-responsive center-block" id="image_view" style="max-width: 300px;max-height: 320px"/>
				</div>
				<div class="text-center" id="thumbnail-container">
					<input type="hidden" name="home_background_image" id="home_background_image"/>
					<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Change Image</a> <label>Home Page Background Image (1370 x 645)(jpg,png 10 MB Max)</label><br><br>
					<button role="button" type="button" id="home_page_background_button" class="btn btn-primary">Update</button>
				</div>
			</div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#home_page_background_button").click(function () {
		$("#home_page_background_button").button('loading');
		$.post('', {home_background_image: $("#home_background_image").val()}, function (data) {
			if (data === '1') {
				bootbox.alert('Image Updated Successfully.', function (data) {
					document.location.href = '';
				});
			} else if (data === '0') {
				bootbox.alert('Error Updating Image');
			} else {
				bootbox.alert(data);
			}
			$("#home_page_background_button").button('reset');
		});
	});
	var image_uploader = new plupload.Uploader({
		runtimes: 'html5, flash, html4',
		browse_button: "image_uploader",
		container: "thumbnail-container",
		url: base_url + 'page/upload_files',
		resize: {
			width: 1370,
			height: 645
		},
		chunk_size: '1mb',
		unique_names: true,
		flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
		silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
		multi_selection: true,
		filters: {
			max_file_size: '10mb',
			min_width: 1370,
			min_height: 645,
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
					$('.box-body').block({message: 'Please wait...'});
				}, 1);
			},
			FileUploaded: function (up, file) {
				$("#image_view").attr('src', base_url + 'uploads/' + file.target_name);
				$("#home_background_image").val(file.target_name);
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
	image_uploader.init();
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