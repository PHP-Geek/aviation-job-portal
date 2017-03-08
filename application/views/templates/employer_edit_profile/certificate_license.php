<div id="certificate_upload_div">
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4>Company Certificate of Registration</h4>
			<div class="form-horizontal col-md-offset-3 col-sm-offset-2">
				<div class="form-group" id="upload_certificate_container">
					<a class="btn btn-upload" title="Upload Certificate" id="certificate_uploader" href="javascript:;"><i class="fa fa-file-o"></i> Upload File</a><label> Registration Certificate (doc,pdf 25 MB max)</label>
					<input type="hidden" name="user_business_certificate" id="user_business_certificate" value="<?php echo $user_details_array['user_business_certificate']; ?>"/>
					<input type="hidden" name="user_business_certificate_original_name" id="user_business_certificate_original_name" value="<?php echo $user_details_array['user_business_certificate_original_name']; ?>"/>
					<div id="uploaded_certificate">
						<?php
						if (is_file(FCPATH . 'uploads/users/company_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_business_certificate'])) {
							$ext = pathinfo($user_details_array['user_business_certificate'], PATHINFO_EXTENSION);
							$file_icon = '';
							switch ($ext) {
								case 'doc':
								case 'docx':
									$file_icon = 'fa-file-word-o';
									break;
								case 'pdf':
									$file_icon = 'fa-file-pdf-o';
									break;
								default :
									$file_icon = 'fa-file-doc-o';
							}
							?>
							<div class="text-center">
								<div class="pdf_close"><a title="remove" class="pdf_close_location remove_image_button" onclick="$(this).parent().remove();
										certificate_remove();" style="cursor:pointer;left:41px;top:-9px"><i class="fa fa-2x fa-times-circle"></i></a>
									<a href="<?php echo base_url() . 'uploads/users/company_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_details_array['user_business_certificate']; ?>" title="click to view or download" target="_blank"> <i class="fa <?php echo $file_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_details_array['user_business_certificate_original_name']; ?></span>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">					
		<h4>Company Description</h4>
		<div class="row">
			<div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
				<div class="form-horizontal checkbox-space-left">
					<div class="form-group">
						<div class="place-error">
							<textarea class="form-control" name="user_business_description" id="user_business_description" rows="4" placeholder="Company Description Here"><?php echo $user_details_array['user_business_description']; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>