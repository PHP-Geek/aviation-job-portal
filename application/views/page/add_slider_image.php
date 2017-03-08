<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Slider Image <small>Add Slider Image</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Slider Image</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Slider Image</h3>
                    </div>
                    <form id="add_slider_image_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="slider_image_title">Title</label>
								<input type="text" class="form-control" name="slider_image_title" id="slider_image_title" placeholder="Title" value=""/>
							</div>
							<div class="form-group">
								<label for="slider_image_content">Content (max 350 chars)</label>
								<textarea id="slider_image_content" name="slider_image_content" placeholder="Content" class="form-control" rows="7"></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="slider_image_name"> Change Image <abbr>(*.jpg, .png)(1920 x 940)</abbr></label>
								<input type="hidden" name="slider_image_name" id="slider_image_name">
								<ul id="uploaded_image"></ul>

							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_slider_image" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="add_slider_image_button" type="button" class="btn btn-primary pull-right" onclick="add_slider_image();" data-loading-text="Please Wait..">Add Image <i class="fa fa-chevron-right"></i></button>
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
								function add_slider_image() {
									$("add_slider_image_button").button('loading');
									$.post('', $("#add_slider_image_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Image Added Successfully.', function () {
												document.location.href = base_url + 'page/list_slider_image';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("add_slider_image_button").button('reset');
									});
								}
								$(function () {
									var image_uploader = new plupload.Uploader({
										runtimes: 'html5,flash,html4',
										browse_button: "image_uploader",
										container: "image-container",
										url: base_url + 'page/upload_files',
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
													$("#uploaded_image").empty();
												}
												setTimeout(function () {
													up.start();
													$('#add_slider_image_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#slider_image_name").val(file.target_name);
												$("#uploaded_image").append('<a href="' + base_url + 'uploads/' + file.target_name + '"><img src="' + base_url + 'uploads/' + file.target_name + '" style="max-width:100px;max-height:100px" class="img-responsive center-block"/></a>');
											},
											UploadComplete: function () {
												$('#add_slider_image_form').unblock();
											},
											Error: function (up, err) {
												$('#add_slider_image_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>