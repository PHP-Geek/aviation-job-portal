<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<div class="row">        
		<div class="col-md-12  col-lg-12">
			<div class="well-white">
				<h4>Validations</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_validation_array) > 0) {
							foreach ($user_validation_array as $key => $user_validation) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Country : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_validation['country_name']; ?>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Expire On : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_validation['user_validation_expire_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_validation['user_validation_expire_date'])) : ''; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Aircraft Type : </label>
													</div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_validation['my_aircrafts_id'] === '0' ? 'Other(' . $user_validation['user_validation_aircraft_type_other']['user_validation_aircraft_type_other_name'] . ')' : $user_validation['my_aircraft_category'] !== '' ? $user_validation['my_aircraft_category'] . ' ' . $user_validation['my_aircraft_name'] : $user_validation['my_aircraft_name']; ?>
													</div>
												</div>
											</div>
											<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer') { ?>
												<div class="col-sm-6 col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<label>Type : </label>
														</div>
														<div class="col-md-6 col-sm-6">
															<?php echo $user_validation['licenses_id'] === '0' ? 'Other(' . $user_validation['user_validation_license_type_other']['user_validation_license_type_other_name'] . ')' : $user_validation['license_type_name'] . ' ' . $user_validation['license_type']; ?>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Validation File : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php
													if (is_file(FCPATH . 'uploads/users/validations' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_validation['user_validation_file'])) {
														$ext = pathinfo($user_validation['user_validation_file'], PATHINFO_EXTENSION);
														$font_icon = 'docx';
														switch ($ext) {
															case 'pdf':
																$font_icon = 'fa-file-pdf-o';
																break;
															default:
																$font_icon = 'fa-file-word-o';
														}
														?>
														<a title="Click to View Validation" href="<?php echo base_url(); ?>uploads/users/validations<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_validation['user_validation_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_validation['user_validation_original_file']; ?></span>
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
								<?php if ($key !== count($user_validation_array) - 1) { ?>
									<hr/>
									<?php
								}
							}
						} else {
							?>
							<span>No Validation Available.
							<?php }
							?>
					</div>
				</div>
			</div>
		</div>


	</div>
<?php } ?>