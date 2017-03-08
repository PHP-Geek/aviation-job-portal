<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Aircraft Charter Testimonial <small>edit aircraft charter page testimonial</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Aircraft Charter Testimonial</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Aircraft Charter Testimonial</h3>
                    </div>
                    <form id="edit_home_page_testimonial_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="home_page_testimonial_title">Content</label>
								<textarea class="form-control" id="home_page_testimonial_content" name="home_page_testimonial_content" rows="7"><?php echo $home_page_testimonial_array['home_page_testimonial_content']; ?></textarea>
							</div>
							<div class="form-group">
								<label for="home_page_testimonial_content">Person</label>
								<input type="text" name="home_page_testimonial_person" id="home_page_testimonial_person" class="form-control" value="<?php echo $home_page_testimonial_array['home_page_testimonial_person']; ?>"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="slider_image_name"> Change Image <abbr>(*.jpg, .png)(150 x 150)</abbr></label>
								<input type="hidden" name="home_page_testimonial_image" value="<?php echo $home_page_testimonial_array['home_page_testimonial_image']; ?>" id="home_page_testimonial_image">
								<a href="<?php echo base_url() . 'uploads/page_testimonials/home_page' . date('/Y/m/d/H/i/s/', strtotime($home_page_testimonial_array['home_page_testimonial_created'])) . $home_page_testimonial_array['home_page_testimonial_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/page_testimonials/home_page' . date('/Y/m/d/H/i/s/', strtotime($home_page_testimonial_array['home_page_testimonial_created'])) . $home_page_testimonial_array['home_page_testimonial_image']; ?>" style="max-width: 100px;max-height: 100px" id="home_page_testimonial_image_show"/>
								</a>
							</div>
						</div>
						<hr/>
						<div class="box-footer text-center">
							<button id="edit_home_page_testimonial_button" type="button" class="btn btn-primary" onclick="edit_home_page_testimonial();" data-loading-text="Please Wait..">Update </button>
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
								function edit_home_page_testimonial() {
									$("edit_home_page_testimonial_button").button('loading');
									$.post('', $("#edit_home_page_testimonial_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'aircraft/charter_testimonial';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_home_page_testimonial_button").button('reset');
									});
								}
								$(function () {
									var image_uploader = new plupload.Uploader({runtimes: 'html5,flash,html4',
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
											mime_types: [{title: "Image files", extensions: "jpg,jpeg,gif,png"}
											]
										}, init: {
											FilesAdded: function (up, files) {
												if (image_uploader.files.length > 1) {
													image_uploader.removeFile(image_uploader.files[0]);
												}
												setTimeout(function () {
													up.start();
													$('#edit_home_page_testimonial_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#home_page_testimonial_image").val(file.target_name);
												$("#home_page_testimonial_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#edit_home_page_testimonial_form').unblock();
											},
											Error: function (up, err) {
												$('#edit_home_page_testimonial_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>