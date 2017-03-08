
<div class="row">    
	<div class="col-md-12  col-lg-12">
		<div class="well-white">
            <h4>Passports</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<?php
					if (count($user_passport_array) > 0) {
						foreach ($user_passport_array as $key => $user_passport) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Number : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_passport['user_passport_number']; ?>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Country : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_passport['country_name']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Expire On : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_passport['user_passport_expire_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_passport['user_passport_expire_date'])) : ''; ?>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Passport File : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php
												if (is_file(FCPATH . 'uploads/users/passports' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_passport['user_passport_file'])) {
													$ext = pathinfo($user_passport['user_passport_file'], PATHINFO_EXTENSION);
													$font_icon = 'docx';
													switch ($ext) {
														case 'pdf':
															$font_icon = 'fa-file-pdf-o';
															break;
														default:
															$font_icon = 'fa-file-word-o';
													}
													?>
													<a title="Click to View Passport" href="<?php echo base_url(); ?>uploads/users/passports<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_passport['user_passport_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_passport['user_passport_original_file']; ?></span>
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
							<?php if ($key !== count($user_passport_array) - 1) { ?>
								<hr/>
								<?php
							}
						}
					} else {
						?>
	                    <span>No Passport Available.
						<?php }
						?>
				</div>
			</div>
        </div>
    </div>

</div>