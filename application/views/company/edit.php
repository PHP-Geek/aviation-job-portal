<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Company <small>Edit Company</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Company</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Company</h3>
                    </div>
                    <form id="edit_company_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group">
								<label for="company_name" class="control-label">Company Name</label>
								<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name" value="<?php echo $company_array['company_name']; ?>"/>
							</div>
							<div class="form-group">
								<label for="company_description" class="control-label">Description</label>
								<textarea rows="6" name="company_description" id="company_description" class="form-control" placeholder="Edit Company Description"><?php echo $company_array['company_description']; ?></textarea>
							</div>
							<div class="form-group" id="image-container">
								<label class="col-md-6">Company Logo</label>
								<input type="hidden" name="company_logo" value="<?php echo $company_array['company_logo']; ?>" id="company_logo">
								<a href="<?php echo base_url() . 'uploads/companies' . date('/Y/m/d/H/i/s/', strtotime($company_array['company_created'])) . $company_array['company_logo']; ?>" target="_blank" title="click to view" id="image_link">
									<img src="<?php echo base_url() . 'uploads/companies' . date('/Y/m/d/H/i/s/', strtotime($company_array['company_created'])) . $company_array['company_logo']; ?>" style="max-width: 100px;max-height: 100px" id="company_image_show"/>
								</a>
							</div>
							<div class="form-group" id="image-container">
								<a title="" id="image_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-photo"></i> Select Image</a>
								<label for="company_logo"> Company Logo <abbr>(*.jpg, .png)</abbr></label>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url(); ?>company" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Cancel</a>
							<button id="edit_company_button" type="button" class="btn btn-primary pull-right">Update <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
	$("#edit_company_button").click(function () {
		$("#edit_company_button").button('loading');
		$.post('', $("#edit_company_form").serialize(), function (data) {
			if (data === '1') {
				bootbox.alert("Company Updated Successfully", function () {
					document.location.href = base_url + 'company';
				});
			} else if (data === '0') {
				bootbox.alert("Error! Please try again.");
			} else {
				bootbox.alert(data);
			}
			$("#edit_company_button").button('reset');
		});
	});
	$(function () {
		var image_uploader = new plupload.Uploader({
			runtimes: 'html5,flash,html4',
			browse_button: "image_uploader",
			container: "image-container",
			url: base_url + 'company/upload_files',
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
						$('#edit_company_form').block({message: 'Please wait...'});
					}, 1);
				},
				FileUploaded: function (up, file) {
					$("#company_logo").val(file.target_name);
					$("#company_image_show").attr("src", base_url + "uploads/" + file.target_name);
					$("#image_link").attr("href", base_url + "uploads/" + file.target_name);
				},
				UploadComplete: function () {
					$('#edit_company_form').unblock();
				},
				Error: function (up, err) {
					$('#edit_company_form').unblock();
					bootbox.alert(err.message);
				}
			}
		});
		image_uploader.init();
	});
</script>
