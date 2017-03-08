<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Page Banner Content <small>Edit Page Banner Content</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page Banner Content</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Page Banner Content</h3>
                    </div>
                    <form id="page_banner_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="page_banner_title">Title</label>
								<input type="text" class="form-control" name="page_banner_title" id="page_banner_title" placeholder="Title" value="<?php echo $page_banner_array['page_banner_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="page_banner_content">Content</label>
								<textarea id="page_banner_content" name="page_banner_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $page_banner_array['page_banner_content']); ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="page_banner_image"> Change Image <abbr>(*.jpg, .png)(480 x 245)</abbr></label>
								<input type="hidden" name="page_banner_image" value="<?php echo $page_banner_array['page_banner_image']; ?>" id="page_banner_image">
								<a href="<?php echo base_url() . 'uploads/pages/banner_images' . date('/Y/m/d/H/i/s/', strtotime($page_banner_array['page_banner_created'])) . $page_banner_array['page_banner_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/pages/banner_images' . date('/Y/m/d/H/i/s/', strtotime($page_banner_array['page_banner_created'])) . $page_banner_array['page_banner_image']; ?>" style="max-width: 100px;max-height: 100px" id="page_banner_image_show"/>
								</a>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/page_banner" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_about_us_button" type="button" class="btn btn-primary pull-right" onclick="edit_page_banner();">Update <i class="fa fa-chevron-right"></i></button>
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
<script type="text/javascript">
								$(function () {
									CKEDITOR.replace('page_banner_content');
								});
								function edit_page_banner() {
									$("edit_about_us_button").button('loading');
									var page_banner_content = CKEDITOR.instances.page_banner_content.getData();
									$.post('', {page_banner_title: $("#page_banner_title").val(), page_banner_content: page_banner_content, page_banner_image: $("#page_banner_image").val()}, function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/page_banner';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("edit_about_us_button").button('reset');
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
													$('#page_banner_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#page_banner_image").val(file.target_name);
												$("#page_banner_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#page_banner_form').unblock();
											},
											Error: function (up, err) {
												$('#page_banner_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>