<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Charter Content <small>Edit Charter Content</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Charter Content</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Charter Content</h3>
                    </div>
                    <form id="aircraft_charter_edit_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="aircraft_charter_title">Title</label>
								<input type="text" class="form-control" name="aircraft_charter_title" id="aircraft_charter_title" placeholder="Title" value="<?php echo $aircraft_charter_array['aircraft_charter_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="aircraft_charter_content">Content</label>
								<textarea id="aircraft_charter_content" name="aircraft_charter_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />','<br>','<br/>'), '', $aircraft_charter_array['aircraft_charter_content']); ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="aircraft_charter_image"> Change Image <abbr>(*.jpg, .png)(194 x 189)</abbr></label>
								<input type="hidden" name="aircraft_charter_image" value="<?php echo $aircraft_charter_array['aircraft_charter_image']; ?>" id="aircraft_charter_image">
								<a href="<?php echo base_url() . 'uploads/pages/charter' . date('/Y/m/d/H/i/s/', strtotime($aircraft_charter_array['aircraft_charter_created'])) . $aircraft_charter_array['aircraft_charter_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/pages/charter' . date('/Y/m/d/H/i/s/', strtotime($aircraft_charter_array['aircraft_charter_created'])) . $aircraft_charter_array['aircraft_charter_image']; ?>" style="max-width: 100px;max-height: 100px" id="aircraft_charter_image_show"/>
								</a>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>aircraft/list_charter" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_aircraft_charter_button" type="button" class="btn btn-primary pull-right" onclick="edit_aircraft_charter();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
								function edit_aircraft_charter() {
									$("edit_aircraft_charter_button").button('loading');
									$.post('', $("#aircraft_charter_edit_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'aircraft/list_charter';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_aircraft_charter_button").button('reset');
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
													$('#aircraft_charter_edit_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#aircraft_charter_image").val(file.target_name);
												$("#aircraft_charter_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#aircraft_charter_edit_form').unblock();
											},
											Error: function (up, err) {
												$('#aircraft_charter_edit_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>
