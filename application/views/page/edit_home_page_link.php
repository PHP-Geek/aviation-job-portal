<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Home Page Link <small>Edit Home Page Link</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Home Page Link</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Home Page Link</h3>
                    </div>
                    <form id="edit_home_page_link_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="page_link_image"> Change Image (Icon Image) <abbr>(*.jpg, .png)(60 x 60)</abbr></label>
								<input type="hidden" name="home_page_link_image" value="<?php echo $home_page_link_array['home_page_link_image']; ?>" id="home_page_link_image">
								<div class="image-upload text-center">
									<a href="<?php echo base_url() . 'uploads/pages/home/icons' . date('/Y/m/d/H/i/s/', strtotime($home_page_link_array['home_page_link_created'])) . $home_page_link_array['home_page_link_image']; ?>" target="_blank" title="click to view" id="image_link">
										<img src="<?php echo base_url() . 'uploads/pages/home/icons' . date('/Y/m/d/H/i/s/', strtotime($home_page_link_array['home_page_link_created'])) . $home_page_link_array['home_page_link_image']; ?>" style="max-width: 100px;max-height: 100px" id="page_banner_image_show"/>
									</a>
								</div>
							</div>
							<div class="form-group">
								<label for="home_page_link_title">Title</label>
								<input type="text" class="form-control" name="home_page_link_title" id="home_page_link_title" placeholder="Title" value="<?php echo $home_page_link_array['home_page_link_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="home_page_link_content">Content</label>
								<textarea id="home_page_link_content" name="home_page_link_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $home_page_link_array['home_page_link_content']); ?></textarea>
							</div>
							<div class="form-group">
								<label for="home_page_link_url">Link</label>
								<input type="text" class="form-control" name="home_page_link_url" id="home_page_link_url" placeholder="Title" value="<?php echo $home_page_link_array['home_page_link_url']; ?>"/>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_home_page_links" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_home_page_link_button" type="button" class="btn btn-primary pull-right" onclick="edit_home_page_link();" data-loading-text="Please Wait..">Update <i class="fa fa-chevron-right"></i></button>
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
								$(document).ready(function () {
									$(".show-icon").html('<i class="' + $("#home_page_link_icon").val() + '"></i>');
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
													$('#page_link_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#home_page_link_image").val(file.target_name);
												$("#page_banner_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#page_link_form').unblock();
											},
											Error: function (up, err) {
												$('#page_link_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
								$("#home_page_link_icon").keyup(function () {
									$(".show-icon").html('<i class="' + $("#home_page_link_icon").val() + '"></i>');
								});
								function edit_home_page_link() {
									$("edit_home_page_link_button").button('loading');
									$.post('', $("#edit_home_page_link_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/list_home_page_links';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_home_page_link_button").button('reset');
									});
								}
</script>