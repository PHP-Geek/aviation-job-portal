<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Sale & Acquisition Page <small>Add Sale & Acquisition Page</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Sale & Acquisition Page</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Sale & Acquisition Page</h3>
                    </div>
                    <form id="sales_and_acquisition_add_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="sales_and_acquisition_title">Title</label>
								<input type="text" class="form-control" name="sales_and_acquisition_title" id="sales_and_acquisition_title" placeholder="Title" />
							</div>
							<div class="form-group">
								<label for="sales_and_acquisition_content">Content</label>
								<textarea id="sales_and_acquisition_content" name="sales_and_acquisition_content" placeholder="Content" class="form-control" rows="7"></textarea>
							</div>
							<div class="form-group">
								<label for="sales_and_acquisition_button_text">Button Text</label>
								<input type="text" class="form-control" name="sales_and_acquisition_button_text" id="sales_and_acquisition_button_text" placeholder="Button Text" />
							</div>
							<div class="form-group">
								<label for="sales_and_acquisition_button_link">Button Link</label>
								<input type="text" class="form-control" name="sales_and_acquisition_button_link" id="sales_and_acquisition_button_link" placeholder="Button Link"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="sales_and_acquisition_image"> Change Image <abbr>(*.jpg, .png)(586 x 328)</abbr></label>
								<input type="hidden" name="sales_and_acquisition_image" id="sales_and_acquisition_image">

							</div>

						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_about_us" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="add_about_us_button" type="button" class="btn btn-primary pull-right" onclick="add_sales_and_acquisition();">Add Post <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">$(function () {
									CKEDITOR.replace('sales_and_acquisition_content');
								});
								function add_sales_and_acquisition() {
									$("add_about_us_button").button('loading');
									var sales_and_acquisition_content = CKEDITOR.instances.sales_and_acquisition_content.getData();
									$.post('', {sales_and_acquisition_title: $("#sales_and_acquisition_title").val(), sales_and_acquisition_content: sales_and_acquisition_content, sales_and_acquisition_image: $("#sales_and_acquisition_image").val(), sales_and_acquisition_button_text: $("#sales_and_acquisition_button_text").val(), sales_and_acquisition_button_link: $("#sales_and_acquisition_button_link").val()}, function (data) {
										if (data === '1') {
											bootbox.alert('Added Successfully.', function () {
												document.location.href = base_url + 'aircraft/list_sales_and_acquisitions';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("add_about_us_button").button('reset');
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
												}
												setTimeout(function () {
													up.start();
													$('#sales_and_acquisition_add_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#sales_and_acquisition_image").val(file.target_name);
												$("#image-container").append('<div class="form-group"><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:120px;height:80px" class="img-responsive center-block"/></div>');
											},
											UploadComplete: function () {
												$('#sales_and_acquisition_add_form').unblock();
											},
											Error: function (up, err) {
												$('#sales_and_acquisition_add_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>