<?php if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') { ?>
	<div class="row">        
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Machenic Licenses</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_me_license_array) > 0) {
							foreach ($user_me_license_array as $key => $user_license) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Authority: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['license_authorities_id'] === '0' ? 'Other(' . $user_license['user_me_license_authority_other_position']['user_license_authority_other_name'] . ')' : $user_license['license_authority_name']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Type: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['licenses_id'] === '0' ? 'Other(' . $user_license['user_me_license_type_other_position']['user_license_type_other_name'] . ')' : $user_license['license_type_name'] . ' ' . $user_license['license_type']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Expire Date: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['user_license_expire_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_license['user_license_expire_date'])) : ''; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License File: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php
													if (is_file(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_license['user_license_file'])) {
														$ext = pathinfo($user_license['user_license_file'], PATHINFO_EXTENSION);
														$font_icon = 'docx';
														switch ($ext) {
															case 'pdf':
																$font_icon = 'fa-file-pdf-o';
																break;
															default:
																$font_icon = 'fa-file-word-o';
														}
														?>
														<a title="Click to View License" href="<?php echo base_url(); ?>uploads/users/licenses<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_license['user_license_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $user_license['user_license_original_file']; ?></span>
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
								<?php if ($key !== count($user_me_license_array) - 1) { ?>
									<hr/>
									<?php
								}
							}
						} else {
							?>
							<span>No License Available.
							<?php }
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="">
		<div class="row">			
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
					<h4>Machenic Aircraft Ratings</h4>
					<div class="row">
						<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
							<?php
							if (count($user_me_aircraft_rating_array) > 0) {
								foreach ($user_me_aircraft_rating_array as $key => $user_aircraft_rating) {
									?>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Aircraft Ratings: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_aircraft_rating['type_ratings_id'] === '0' ? 'Other(' . $user_aircraft_rating['user_me_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name'] . ')' : $user_aircraft_rating['type_rating_name']; ?>
													</div>
												</div>
											</div >
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Current: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_aircraft_rating['user_aircraft_rating_is_current'] === '1' ? 'Yes' : 'No';
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="row">
													<div class="col-md-3 col-sm-3">
														<label>Coverage: </label></div>
													<div class="col-md-9 col-sm-9">
														<?php
														$rating_array = array();
														foreach ($user_aircraft_rating['user_me_aircraft_rating_coverages'] as $key => $rating_coverages) {
															if ($rating_coverages['user_aircraft_rating_coverage_name'] === 'Other') {
																$rating_array[] = 'Other(' . $rating_coverages['user_aircraft_rating_coverage_other']['user_aircraft_rating_coverage_other_name'] . ')';
															} else {
																$rating_array[] = $rating_coverages['user_aircraft_rating_coverage_name'];
															}
														}
														echo implode(' , ', $rating_array);
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Last Worked on A/C: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_aircraft_rating['user_aircraft_rating_last_worked_on_ac'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_last_worked_on_ac'])) : '';
														?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Years Experience: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_aircraft_rating['user_aircraft_rating_year_of_experience']; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php if ($key !== count($user_me_aircraft_rating_array) - 1) { ?>
										<hr/>
										<?php
									}
								}
							} else {
								?>
								<span>No Aircraft Rating Available.
								<?php }
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>