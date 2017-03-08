<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Contract Crew Support Page <small>Edit Contract Crew Support Page</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Contract Crew Support Page</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Contract Crew Support Page</h3>
                    </div>
                    <form id="contract_crew_support_edit_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="contract_crew_support_title">Title</label>
								<input type="text" class="form-control" name="contract_crew_support_title" id="contract_crew_support_title" placeholder="Title" value="<?php echo $contract_crew_array['contract_crew_support_title']; ?>"/>
							</div>
							<div class="form-group">
								<label for="contract_crew_support_content">Content</label>
								<textarea id="contract_crew_support_content" name="contract_crew_support_content" placeholder="Content" class="form-control" rows="7"><?php echo str_replace(array('<br />', '<br>', '<br/>'), '', $contract_crew_array['contract_crew_support_content']); ?></textarea>
							</div>
							<div class="form-group">
								<label for="contract_crew_support_button_text">Button Text</label>
								<input type="text" class="form-control" name="contract_crew_support_button_text" id="contract_crew_support_button_text" placeholder="Title" value="<?php echo $contract_crew_array['contract_crew_support_button_text']; ?>"/>
							</div>
							<div class="form-group">
								<label for="contract_crew_support_button_link">Button Link</label>
								<input type="text" class="form-control" name="contract_crew_support_button_link" id="contract_crew_support_button_link" placeholder="Title" value="<?php echo $contract_crew_array['contract_crew_support_button_link']; ?>"/>
							</div>
							<div class="form-group" id="image-container">
								<a title="Select Image" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="contract_crew_support_image"> Change Image <abbr>(*.jpg, .png)(586 x 328)</abbr></label>
								<input type="hidden" name="contract_crew_support_image" value="<?php echo $contract_crew_array['contract_crew_support_image']; ?>" id="contract_crew_support_image">
								<a href="<?php echo base_url() . 'uploads/pages/contract_crew_support' . date('/Y/m/d/H/i/s/', strtotime($contract_crew_array['contract_crew_support_created'])) . $contract_crew_array['contract_crew_support_image']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/pages/contract_crew' . date('/Y/m/d/H/i/s/', strtotime($contract_crew_array['contract_crew_support_created'])) . $contract_crew_array['contract_crew_support_image']; ?>" style="max-width: 100px;max-height: 100px" id="contract_crew_support_image_show"/>
								</a>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>page/list_contract_crew" class="btn btn-default pull-left"><i class="fa fa-chevron-left"></i> Cancel</a>
							<button id="edit_contract_crew_button" type="button" class="btn btn-primary pull-right" onclick="edit_contract_crew_support();">Update <i class="fa fa-chevron-right"></i></button>
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
									CKEDITOR.replace('contract_crew_support_content');
								});
								function edit_contract_crew_support() {
									$("#edit_contract_crew_button").button('loading');
									var contract_crew_support_content = CKEDITOR.instances.contract_crew_support_content.getData();
									$.post('', {contract_crew_support_title: $("#contract_crew_support_title").val(), contract_crew_support_content: contract_crew_support_content, contract_crew_support_image: $("#contract_crew_support_image").val(), contract_crew_support_button_text: $("#contract_crew_support_button_text").val(), contract_crew_support_button_link: $("#contract_crew_support_button_link").val()}, function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = base_url + 'page/list_contract_crew';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("#edit_contract_crew_button").button('reset');
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
													$('#contract_crew_support_edit_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#contract_crew_support_image").val(file.target_name);
												$("#contract_crew_support_image_show").attr("src", base_url + "uploads/" + file.target_name);
												$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#contract_crew_support_edit_form').unblock();
											},
											Error: function (up, err) {
												$('#contract_crew_support_edit_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									image_uploader.init();
								});
</script>