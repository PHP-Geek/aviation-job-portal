<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Increw Service <small>Edit Increw Service</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Increw Service</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Increw Service</h3>
                    </div>
                    <form id="increw_service_edit_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="increw_service_title">Title</label>
								<input type="text" class="form-control" name="increw_service_title" id="increw_service_title" placeholder="Title" value="<?php echo $increw_service_array['increw_service_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="increw_service_content">Content</label>
								<textarea id="increw_service_content" name="increw_service_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />','<br>','<br/>'), '', $increw_service_array['increw_service_content']); ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="increw_service_image"> Change Image <abbr>(*.jpg, .png)(535 x 124)</abbr></label>
								<input type="hidden" name="increw_service_image" value="<?php echo $increw_service_array['increw_service_image']; ?>" id="increw_service_image">
								<a href="<?php echo base_url() . 'uploads/pages/increw_services' . date('/Y/m/d/H/i/s/', strtotime($increw_service_array['increw_service_created'])) . $increw_service_array['increw_service_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/pages/increw_services' . date('/Y/m/d/H/i/s/', strtotime($increw_service_array['increw_service_created'])) . $increw_service_array['increw_service_image']; ?>" style="max-width: 100px;max-height: 100px" id="increw_service_image_show"/>
								</a>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_our_services" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_increw_service_button" type="button" class="btn btn-primary pull-right" onclick="edit_increw_service();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
								function edit_increw_service() {
									$("edit_increw_service_button").button('loading');
									$.post('', $("#increw_service_edit_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/list_our_services';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_increw_service_button").button('reset');
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
													$('#increw_service_edit_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#increw_service_image").val(file.target_name);
												$("#increw_service_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#increw_service_edit_form').unblock();
											},
											Error: function (up, err) {
												$('#increw_service_edit_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>