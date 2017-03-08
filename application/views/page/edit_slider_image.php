<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Slider Image <small>Edit Slider Image</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Slider Image</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Slider Image</h3>
                    </div>
                    <form id="edit_slider_image_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="slider_image_title">Title</label>
								<input type="text" class="form-control" name="slider_image_title" id="slider_image_title" placeholder="Title" value="<?php echo $slider_image_array['slider_image_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="slider_image_content">Content</label>
								<textarea id="slider_image_content" name="slider_image_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $slider_image_array['slider_image_content']); ?></textarea>
							</div>
							<div class="form-group">
								<label for="slider_image_title">Title</label>
								<input type="text" class="form-control" name="slider_image_link_text" id="slider_image_link_text" placeholder="Title" value="<?php echo $slider_image_array['slider_image_link_text']; ?>"/>
							</div>
							<div class="form-group">
								<label for="slider_image_link">Link</label>
								<input type="text" class="form-control" name="slider_image_link" id="slider_image_link" placeholder="Link URL" value="<?php echo $slider_image_array['slider_image_link']; ?>"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="slider_image_name"> Change Image <abbr>(*.jpg, .png)(1920 x 940)</abbr></label>
								<input type="hidden" name="slider_image_name" value="<?php echo $slider_image_array['slider_image_name']; ?>" id="slider_image_name">
								<a href="<?php echo base_url() . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s/', strtotime($slider_image_array['slider_image_created'])) . $slider_image_array['slider_image_name']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s/', strtotime($slider_image_array['slider_image_created'])) . $slider_image_array['slider_image_name']; ?>" style="max-width: 100px;max-height: 100px" id="slider_image_name_show"/>
								</a>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_slider_image" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_slider_image_button" type="button" class="btn btn-primary pull-right" onclick="edit_slider_image();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
								function edit_slider_image() {
									$("edit_slider_image_button").button('loading');
									$.post('', $("#edit_slider_image_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/list_slider_image';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_slider_image_button").button('reset');
									});
								}
								$(function () {
									var image_uploader = new plupload.Uploader({
										runtimes: 'html5,flash,html4',
										browse_button: "image_uploader",
										container: "image-container",
										url: base_url + 'page/upload_files',
										resize: {
											height: 940,
											width: 1920
										},
										chunk_size: '1mb',
										unique_names: true,
										flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
										silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
										multi_selection: false,
										filters: {
											max_file_size: '5mb',
											min_width: 1920,
											max_width: 940,
											mime_types: [
												{title: "Image files", extensions: "jpg,jpeg,gif,png"}
											]
										}, init: {
											FilesAdded: function (up, files) {
												if (image_uploader.files.length > 1) {
													image_uploader.removeFile(image_uploader.files[0]);
												}
												setTimeout(function () {
													up.start();
													$('#edit_slider_image_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#slider_image_name").val(file.target_name);
												$("#slider_image_name_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#edit_slider_image_form').unblock();
											},
											Error: function (up, err) {
												$('#edit_slider_image_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
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