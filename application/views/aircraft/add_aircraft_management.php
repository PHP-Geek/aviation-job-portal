<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Aircraft Management <small>Add Aircraft Management</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Aircraft Management</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Aircraft Management</h3>
                    </div>
                    <form id="aircraft_management_add_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="aircraft_management_title">Title</label>
								<input type="text" class="form-control" name="aircraft_management_title" id="aircraft_management_title" placeholder="Title" />
							</div>
							<div class="form-group">
								<label for="aircraft_management_content">Content</label>
								<textarea id="aircraft_management_content" name="aircraft_management_content" placeholder="Content" class="form-control" rows="7"></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="aircraft_management_image"> Change Image <abbr>(*.jpg, .png)(586 x 328)</abbr></label>
								<input type="hidden" name="aircraft_management_image" id="aircraft_management_image">
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>aircraft/list_aircraft_management" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="add_aircraft_management_button" type="button" class="btn btn-primary pull-right" onclick="add_aircraft_management();">Add <i class="fa fa-chevron-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
								$(function () {
									CKEDITOR.replace('aircraft_management_content');
								});
								function add_aircraft_management() {
									$("#add_aircraft_management_button").button('loading');
									var content = CKEDITOR.instances.aircraft_management_content.getData();
									$.post('', {aircraft_management_title: $("#aircraft_management_title").val(), aircraft_management_image: $("#aircraft_management_image").val(), aircraft_management_content: content}, function (data) {
										if (data === '1') {
											bootbox.alert('Added Successfully.', function () {
												document.location.href = base_url + 'aircraft/list_aircraft_management';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("#add_aircraft_management_button").button('reset');
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
													$('#aircraft_management_add_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#aircraft_management_image").val(file.target_name);
												$("#image-container").append('<div class="form-group"><img src="' + base_url + 'uploads/' + file.target_name + '" style="width:120px;height:80px" class="img-responsive"/></div>');
											},
											UploadComplete: function () {
												$('#aircraft_management_add_form').unblock();
											},
											Error: function (up, err) {
												$('#aircraft_management_add_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>