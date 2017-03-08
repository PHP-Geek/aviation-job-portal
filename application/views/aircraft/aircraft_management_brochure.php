<style>
	.select2-container .select2-selection--single  {
		height:34px !important;
		border:1px solid #ccc !important;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Charter Brochure <small>Update Charter Brochure</small></h1>
        <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Charter Brochure</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Charter Brochure</h3>
                    </div>
					<div class="well text-center">
						<h4><span class="text-info">Total Number of Downloads</span> : <?php echo $aircraft_management_brochure_array['configuration_value']; ?></h4>
					</div>
                    <form id="update_charter_brochure_form" method="post" enctype="multipart/form-data" role="form">
                        <div class="box-body">
							<div class="form-group text-center" id="file-containter">
								<?php
								if (is_file(FCPATH . 'uploads/brochures/aircraft_management/' . $configuration_array['configuration_value'])) {
									?>
									<a href="<?php echo base_url() . 'uploads/brochures/aircraft_management/' . $configuration_array['configuration_value']; ?>" title="click to view" id="pdf_link" target="_blank"><i class="fa fa-file-pdf-o fa-5x"></i></a>
									<br><a href="<?php echo base_url() . 'uploads/brochures/aircraft_management/' . $configuration_array['configuration_value']; ?>" title="click to view" id="pdf_link" target="_blank">Click to view brochure</a><?php } ?><br><hr>
								<a title="Select Image" id="file_uploader" href="javascript:;" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Select File</a>
								<label for="file_name"> Change Charter Brochure <abbr>(.pdf , 100MB max)</abbr></label>
								<input type="hidden" name="configuration_value" id="configuration_value">
							</div>
						</div>
						<hr/>
						<div class="box-footer text-center">
							<button id="update_charter_brochure_button" type="button" class="btn btn-primary" onclick="update_charter_brochure();" data-loading-text="Please Wait..">Update </button>
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
								function update_charter_brochure() {
									$("update_charter_brochure_button").button('loading');
									$.post('', $("#update_charter_brochure_form").serialize(), function (data) {
										if (data === '1') {
											bootbox.alert('Updated Successfully.', function () {
												document.location.href = '';
											});
										} else if (data === '0') {
											bootbox.alert('Error Saving Data');
										} else {
											bootbox.alert(data);
										}
										$("update_charter_brochure_button").button('reset');
									});
								}
								$(function () {
									var file_uploader = new plupload.Uploader({runtimes: 'html5,flash,html4',
										browse_button: "file_uploader",
										container: "file-containter",
										url: base_url + 'aircraft/upload_files',
										chunk_size: '1mb',
										unique_names: true,
										flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
										silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
										multi_selection: false,
										filters: {
											max_file_size: '101mb',
											mime_types: [{title: "Pdf files", extensions: "pdf"}
											]
										}, init: {
											FilesAdded: function (up, files) {
												if (file_uploader.files.length > 1) {
													file_uploader.removeFile(file_uploader.files[0]);
												}
												setTimeout(function () {
													up.start();
													$('#update_charter_brochure_form').block({message: 'Please wait...'});
												}, 1);
											},
											FileUploaded: function (up, file) {
												$("#configuration_value").val(file.target_name);
												$("#pdf_link").attr("href", base_url + "uploads/" + file.target_name);
											},
											UploadComplete: function () {
												$('#update_charter_brochure_form').unblock();
											},
											Error: function (up, err) {
												$('#update_charter_brochure_form').unblock();
												bootbox.alert(err.message);
											}
										}
									});
									file_uploader.init();
								});
</script>