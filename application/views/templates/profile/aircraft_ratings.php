<?php if ($user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer') { ?>
	<div class="">
		<div class="row">			
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
					<h4>Aircraft Ratings </h4>
					<div class="row">
						<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
							<?php
							if ($user_details_array['job_type_slug'] === 'pilot') {
								if (count($user_aircraft_rating_array) > 0) {
									foreach ($user_aircraft_rating_array as $key => $user_aircraft_rating) {
										?>

										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Aircraft Type</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['my_aircrafts_id'] === '0' ? 'Other(' . $user_aircraft_rating['user_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] . ')' : $user_aircraft_rating['my_aircraft_category'] !== '' ? $user_aircraft_rating['my_aircraft_category'] . ' ' . $user_aircraft_rating['my_aircraft_name'] : $user_aircraft_rating['my_aircraft_name']; ?></div>
													</div>

												</div>
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Last Flight</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['user_aircraft_rating_last_flight'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_last_flight'])) : ''; ?></div>
													</div>

												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3 col-lg-3"><label>Hours on Type</label></div>
												<div class="col-md-3 col-lg-3"><?php echo $user_aircraft_rating['user_aircraft_rating_total_hours'] !== '' ? 'Total : ' . $user_aircraft_rating['user_aircraft_rating_total_hours'] : ''; ?></div>
												<div class="col-md-3 col-lg-3"><?php echo $user_aircraft_rating['user_aircraft_rating_pic_hours'] !== '' ? 'PIC : ' . $user_aircraft_rating['user_aircraft_rating_pic_hours'] : ''; ?></div>
												<div class="col-md-3 col-lg-3"><?php echo $user_aircraft_rating['user_aircraft_rating_sic_hours'] ? 'SIC : ' . $user_aircraft_rating['user_aircraft_rating_sic_hours'] : ''; ?></div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Current</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['user_aircraft_rating_is_current'] ? 'Yes' : 'No'; ?></div>
													</div>

												</div>
												<div class="col-md-6 col-lg-6">
													<div class="row">


														<div class="col-md-6 col-sm-6"><label>Recurrent</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['user_aircraft_rating_recurrent'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_recurrent'])) : ''; ?></div>

													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3 col-sm-3"><label>License Authority</label></div>
												<div class="col-md-9 col-sm-9"><?php
													$license_authority_array = array();
													foreach ($user_aircraft_rating['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
														if ($license_authority['license_authorities_id'] === '0') {
															$license_authority_array[] = 'Other(' . $user_aircraft_rating['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] . ')';
														} else {
															$license_authority_array[] = $license_authority['license_authority_name'];
														}
													}
													echo implode(' , ', $license_authority_array);
													?></div>
											</div>
										</div>
										<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 col-lg-6 col-sm-6">

														<div class="row">
															<div class="col-md-6 col-sm-6">
																<label>Training Records: </label>
															</div>
															<div class="col-md-6 col-sm-6">
																<?php
																if (is_file(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_aircraft_rating['user_aircraft_rating_training_file'])) {
																	$ext = pathinfo($user_aircraft_rating['user_aircraft_rating_training_file'], PATHINFO_EXTENSION);
																	$font_icon = 'docx';
																	switch ($ext) {
																		case 'pdf':
																			$font_icon = 'fa-file-pdf-o';
																			break;
																		default:
																			$font_icon = 'fa-file-word-o';
																	}
																	?>
																	<a title="Click to View Training Records" href="<?php echo base_url(); ?>uploads/users/ratings<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_aircraft_rating['user_aircraft_rating_training_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $user_aircraft_rating['user_aircraft_rating_training_original_file']; ?></span>
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
										<?php } ?>
										<?php
									}
								} else {
									?>
									<div>No Aircraft Rating Available.</div>

									<?php
								}
							} else if ($user_details_array['job_type_slug'] === 'maintenance-engineer') {
								if (count($user_aircraft_rating_array) > 0) {
									foreach ($user_aircraft_rating_array as $key => $user_aircraft_rating) {
										?>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Aircraft Rating:</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['type_ratings_id'] === '0' ? 'Other(' . $user_aircraft_rating['user_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name'] . ')' : $user_aircraft_rating['type_rating_name']; ?></div>
													</div>

												</div>
												<div class="col-md-6 col-sm-6"><div class="row">

														<div class="col-md-6 col-sm-6"><label>Years Experience:</label></div>
														<div class="col-md-6 col-sm-6"><?php
															echo $user_aircraft_rating['user_aircraft_rating_year_of_experience'];
															?></div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Current:</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['user_aircraft_rating_is_current'] ? 'Yes' : 'No'; ?></div>
													</div>

												</div>
												<div class="col-md-6 col-sm-6">

													<div class="row">
														<div class="col-md-6 col-sm-6"><label>Last Worked on A/C:</label></div>
														<div class="col-md-6 col-sm-6"><?php echo $user_aircraft_rating['user_aircraft_rating_last_worked_on_ac'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_last_worked_on_ac'])) : ''; ?></div>
													</div>

												</div>
											</div>
										</div>

										<div class="row">

											<div class="col-md-6 col-sm-6">

												<div class="row">
													<div class="col-md-6 col-sm-6"><label>Coverage:</label></div>
													<div class="col-md-6 col-sm-6"><?php
														$user_coverage_array = array();
														foreach ($user_aircraft_rating['user_aircraft_rating_coverages'] as $coverage) {
															$user_coverage_array[] = $coverage['user_aircraft_rating_coverage_name'];
														}
														echo implode(' , ', $user_coverage_array);
														?></div>
												</div>
											</div>
										</div>
										<?php
										if ($key !== count($user_aircraft_rating_array) - 1) {
											echo '<hr/>';
										}
									}
								} else {
									?>
									<div>No Aircraft Rating Available.</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
?>
<?php if ($user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<div class="">
		<div class="row">			
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
					<h4>Aircraft Ratings </h4>
					<div class="row">
						<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6"><label>Ratings:</label></div>
											<div class="col-md-6 col-sm-6"><?php
												$rating_array = array();
												foreach ($user_rating_array as $key => $user_rating) {
													if ($user_rating['type_ratings_id'] === '0') {
														$rating_array[] = 'Other(' . $user_rating_array[$key]['user_type_rating_other']['user_rating_other_name'] . ')';
													} else {
														$rating_array[] = $user_rating['type_rating_name'];
													}
												}
												echo implode(' , ', $rating_array);
												?></div>
										</div>

									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6"><label>Endorsement:</label></div>
											<div class="col-md-6 col-sm-6"><?php
												switch ($user_details_array['user_endorsement']) {
													case 'Other':
														echo 'Other(' . $user_details_array['user_endorsement_other'];
														break;
													case 'Unit':
														echo $user_details_array['user_endorsement'] . ' - ' . $user_details_array['user_endorsement_unit'];
														break;
													default:
														$user_details_array['user_endorsement'];
												}
												?></div>
										</div>

									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">

											<div class="col-md-6 col-sm-6"><label>Location/Area/Airport/Unit:</label></div>
											<div class="col-md-6 col-sm-6"><?php echo $user_details_array['user_airport_area']; ?></div>

										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6"><label>Last Check:</label></div>
											<div class="col-md-6 col-sm-6"><?php echo $user_details_array['user_last_check'] !== '0000-00-00' ? date('d M Y', strtotime($user_details_array['user_last_check'])) : ''; ?></div>
										</div>

									</div>
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6"><label>Year of Experience:</label></div>
											<div class="col-md-6 col-sm-6"><?php echo $user_details_array['user_years_of_experience']; ?></div>
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
<?php } ?>
