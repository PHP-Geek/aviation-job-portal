<div class="row">    
	<div class="col-md-12 col-lg-12">
		<div class="well-white">
            <h4>Medical</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<div class="row">
						<div class="form-group">
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label for="user_medical_height">Height : </label>
									</div>
									<div class="col-md-6 col-sm-6">
										<?php echo $user_details_array['user_medical_height']; ?>
										<?php echo $user_details_array['user_medical_height_unit']; ?>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label for="user_medical_height">Weight : </label>
									</div>
									<div class="col-md-6 col-sm-6">
										<?php echo $user_details_array['user_medical_weight']; ?>
										<?php echo $user_details_array['user_medical_weight_unit']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<?php if ($user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Medical Certificates</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_medical_array) > 0) {
							foreach ($user_medical_array as $key => $user_medical) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Authority: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_medical['license_authorities_id'] === '0' ? 'Other(' . $user_medical['user_medical_certificate_authority_other']['user_medical_certificate_authority_other_name'] . ')' : $user_medical['license_authority_name']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Class: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_medical['user_medical_certificate_class']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class= "col-md-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Exam Date: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_medical['user_medical_certificate_exam_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_medical['user_medical_certificate_exam_date'])) : ''; ?>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Medical Certificate : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php
													if (is_file(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical['user_medical_certificate_file'])) {
														$ext = pathinfo($user_medical['user_medical_certificate_file'], PATHINFO_EXTENSION);
														$font_icon = 'docx';
														switch ($ext) {
															case 'pdf':
																$font_icon = 'fa-file-pdf-o';
																break;
															default:
																$font_icon = 'fa-file-word-o';
														}
														?>
														<a title="Click to View Certificate" href="<?php echo base_url(); ?>uploads/users/medical_certificates<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical['user_medical_certificate_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $user_medical['user_medical_certificate_original_file']; ?></span>
															<?php
														} else {
															echo 'File Not Uploaded';
														}
														?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								if ($key !== count($user_medical_array) - 1) {
									echo '<hr/>';
								}
							}
						} else {
							?>
							<span>No Medical Examination Available.
							<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php } ?>