<style>
	.background_white {
		background-color: white;
	}
	.search_license_type{
		padding:0px 0px !important;
		height:27px !important;
		border:0px;
	}
	.pdf_upload1{
		padding:10px;
		background-color:#F5F5F5;
	}
	.pdf_upload{
		padding:30px 62px;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Email Setup : Other <small>listing of other setup</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Email Setup</li>
			<li class="active">Other</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
					<div class="box-body">
						<form id="add_conditional_email_form" method="post">
							<div class="form-group">
								<label for="conditional_email_subject" class="control-label">Subject</label>
								<input type="text" id="conditional_email_subject" name="conditional_email_subject" value="<?php echo $conditional_email_array['conditional_email_subject']; ?>" class="form-control" placeholder="Email Setup Subject"/>
							</div>
							<div class="form-group">
								<label for="conditional_email_purpose" class="control-label">Purpose</label>
								<input type="text" id="conditional_email_purpose" name="conditional_email_purpose" value="<?php echo $conditional_email_array['conditional_email_purpose']; ?>" class="form-control" placeholder="Email Setup Purpose"/>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="conditional_email_scheduled" class="control-label">Schedule</label>
										<select class="form-control search_license_type" name="conditional_email_scheduled" id="conditional_email_scheduled" data-placeholder="Schedule Time">
											<option></option>
											<option value="1" <?php if ($conditional_email_array['conditional_email_scheduled'] == '1') echo ' selected="selected"'; ?>>Every Day</option>
											<option value="7" <?php if ($conditional_email_array['conditional_email_scheduled'] == '7') echo ' selected="selected"'; ?>>Every Week</option>
											<option value="30" <?php if ($conditional_email_array['conditional_email_scheduled'] == '30') echo ' selected="selected"'; ?>>Every Month</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="conditional_email_scheduled_on" class="control-label">On</label>
										<input type="hidden" id="conditional_email_scheduled_on1" value="<?php echo ucwords($conditional_email_array['conditional_email_scheduled_on']); ?>"/>
										<select class="form-control search_license_type" name="conditional_email_scheduled_on" id="conditional_email_scheduled_on" data-placeholder="Schedule Time">
											<option></option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="conditional_email_body">Content</label>
								<textarea name="conditional_email_body" id="conditional_email_body" ><?php echo $conditional_email_array['conditional_email_body']; ?></textarea>
							</div>
							<br/>
							<div class="form-group" id="pdf-container">
								<a title="" id="pdf_uploader" href="javascript:;" class="btn btn-md btn-success"><i class="fa fa-upload"></i> Upload File</a>
								<label> Attachment (*.pdf , *.doc(x) , *.xls)</label>
							</div>
							<div id="uploaded_pdf">
								<?php if (is_file(FCPATH . 'uploads/emails/newsletters' . date('/Y/m/d/H/i/s/', strtotime($conditional_email_array['conditional_email_created'])) . $conditional_email_array['conditional_email_attachment'])) { ?>
									<div class="row">
										<div class="col-md-3  col-md-offset-4">
											<div class="pdf_upload1">
												<a title="remove pdf" class="pull-right remove_image_button" onclick="$(this).parent().remove();">
													<i class="fa fa-2x fa-times-circle"></i>
												</a>
												<input type="hidden" name="conditional_email_attachment" id="conditional_email_attachment" value="<?php echo $conditional_email_array['conditional_email_attachment']; ?>">
												<div class="pdf_upload">
													<a href="<?php echo base_url() . 'uploads/emails/newsletters' . date('/Y/m/d/H/i/s/', strtotime($conditional_email_array['conditional_email_created'])) . $conditional_email_array['conditional_email_attachment']; ?>" target="_blank">
														<?php
														$file_icon = '';
														switch (pathinfo($conditional_email_array['conditional_email_attachment'])['extension']) {
															case 'pdf':
																$file_icon = 'fa-file-pdf-o';
																break;
															case 'doc':
															case 'docx':
																$file_icon = 'fa-file-word-o';
																	break;
															case 'xls':
															case 'xlsx':
																$file_icon = 'fa-file-excel-o';
																break;
															default :
																$file_icon = 'fa-file-word-o';
																break;
														}
														?>
														<i class="fa <?php echo $file_icon; ?> fa-4x"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<br/>
							<div class="box-footer text-center">
								<button id="add_conditional_email_button" type="button" class="btn btn-primary pull-right">Update Email <i class="fa fa-angle-right"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.min.js"></script>
<script type="text/javascript">
													$(function () {
														$("select").select2({allowClear: true});
													});
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script type="text/javascript">
													$(function () {
														CKEDITOR.replace('conditional_email_body');
													});
													$("#add_conditional_email_button").click(function () {
														$("#add_conditional_email_button").button("loading");
														var tab_content = CKEDITOR.instances.conditional_email_body.getData();
														$.post('', {conditional_email_subject: $("#conditional_email_subject").val(), conditional_email_purpose: $("#conditional_email_purpose").val(), conditional_email_attachment: $("#conditional_email_attachment").val(), conditional_email_scheduled: $("#conditional_email_scheduled").val(), conditional_email_scheduled_on: $("#conditional_email_scheduled_on").val(), conditional_email_body: tab_content}, function (data) {
															if (data === '1') {
																bootbox.alert("Email Updated Successfully !!!", function () {
																	document.location.href = base_url + 'email/others';
																});
															} else if (data === '0') {
																bootbox.alert("Error Saving Data !!!");
															} else {
																bootbox.alert(data);
															}
															$("#add_conditional_email_button").button("reset");
														});
													});
													$("#conditional_email_scheduled").on('change', function () {
														$("#conditional_email_scheduled_on").empty();
														$('#conditional_email_scheduled_on').select2().select2('val', null);
														var days_of_weeks = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
														switch ($("#conditional_email_scheduled").val()) {
															case '1':
															{
																for (var i = 1; i < 25; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + i + '">' + i + ':00</option>');
																}
																break;
															}
															case '7' :
															{
																for (var i = 0; i < days_of_weeks.length; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + days_of_weeks[i] + '">' + days_of_weeks[i] + '</option>');
																}
																break;
															}
															case '30':
															{
																for (var i = 1; i < 29; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + i + '">' + i + '</option>');
																}
																break;
															}
															default :
															{
																$("#conditional_email_scheduled_on").append('<option></option>');
															}
														}

													});
													$(document).ready(function () {
														$("#conditional_email_scheduled_on").empty();
														var days_of_weeks = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
														switch ($("#conditional_email_scheduled").val()) {
															case '1':
															{
																for (var i = 1; i < 25; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + i + '">' + i + ':00</option>');
																}
																$('#conditional_email_scheduled_on').select2().select2('val', $('#conditional_email_scheduled_on1').val());
																break;
															}
															case '7' :
															{
																for (var i = 0; i < days_of_weeks.length; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + days_of_weeks[i] + '">' + days_of_weeks[i] + '</option>');
																}
																$('#conditional_email_scheduled_on').select2().select2('val', $('#conditional_email_scheduled_on1').val());
																break;
															}
															case '30':
															{
																for (var i = 1; i < 29; i++) {
																	$("#conditional_email_scheduled_on").append('<option value="' + i + '">' + i + '</option>');
																}
																$('#conditional_email_scheduled_on').select2().select2('val', $('#conditional_email_scheduled_on1').val());
																break;
															}
															default :
															{
																$("#conditional_email_scheduled_on").append('<option></option>');
															}
														}

													});
													$(function () {
														var pdf_uploader = new plupload.Uploader({
															runtimes: 'html5,flash,html4',
															browse_button: "pdf_uploader",
															container: "pdf-container",
															url: base_url + 'aircraft/upload_files',
															chunk_size: '1mb',
															unique_names: true,
															flash_swf_url: base_url + 'assets/js/plugins/plupload/js/Moxie.swf',
															silverlight_xap_url: base_url + 'assets/js/plugins/plupload/js/Moxie.xap',
															multi_selection: false,
															filters: {
																max_file_size: '5mb',
																mime_types: [
																	{title: "files", extensions: "pdf,doc,docx,xls,xlsx"}
																]
															},
															init: {
																FilesAdded: function (up, files) {
																	if (up.files.length > 1) {
																		up.removeFile(up.files[0]);
																		$("#uploaded_pdf").empty();
																	}
																	setTimeout(function () {
																		up.start();
																		$('#add_conditional_email_form').block({message: 'Please wait...'});
																	}, 1);
																},
																FileUploaded: function (up, file) {
																	$("#uploaded_pdf").empty();
																	var file_extension_array = file.target_name.split('.');
																	var file_extension = file_extension_array[file_extension_array.length - 1];
																	var file_icon = '';
																	switch (file_extension) {
																		case 'pdf':
																			var file_icon = 'fa-file-pdf-o';
																			break;
																		case 'doc':
																		case 'docx':
																			var file_icon = 'fa-file-word-o';
																			break;
																		case 'xls':
																		case 'xlsx':
																			var file_icon = 'fa-file-excel-o';
																			break;
																		default :
																			var file_icon = 'fa-file-word-o';
																			break;
																	}
																	$("#uploaded_pdf").append('<div class="row"><div class="col-md-3  col-md-offset-4"><div class="pdf_upload1"><a title="remove pdf" class="pull-right remove_image_button" onclick="$(this).parent().remove();" style="cursor:pointer"><i class="fa fa-2x fa-times-circle"></i></a><input type="hidden" name="conditional_email_attachment" id="conditional_email_attachment" value="' + file.target_name + '"><div class="pdf_upload"><a href="' + base_url + 'uploads/' + file.target_name + '" target="_blank"><i class="fa ' + file_icon + ' fa-4x"></i></a></div></div></div></div>');
																},
																UploadComplete: function () {
																	$('#add_conditional_email_form').unblock();
																},
																Error: function (up, err) {
																	$('#add_conditional_email_form').unblock();
																	bootbox.alert(err.message);
																}
															}
														});
														pdf_uploader.init();

													});
</script>