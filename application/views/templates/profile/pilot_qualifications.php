<?php if ($user_details_array['job_type_slug'] !== 'pilot') { ?>
	<?php if ($user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
		<div class="row">			
			<div class="col-md-12  col-lg-12">
				<div class="well-white">
					<h4>Retired Pilot</h4>
					<div class="row">
						<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
							<?php if (count($user_retired_pilot_array) > 0) { ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-4 col-sm-4">
													<label for="user_total_flight">Last Company: </label>
												</div>
												<div class="col-md-8 col-sm-8">
													<?php echo $user_retired_pilot_array['user_retired_pilot_company']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-4 col-sm-4">
													<label for="user_total_pic">Position: </label>
												</div>
												<div class="col-md-8 col-sm-8">
													<?php echo $user_retired_pilot_array['positions_id'] === '0' ? 'Other(' . $user_retired_pilot_array['user_retired_pilot_current_position_other']['user_retired_pilot_current_position_other_name'] . ')' : $user_retired_pilot_array['position_name']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-4 col-sm-4">
													<label for="user_total_jet">Total Hours: </label>
												</div>
												<div class="col-md-8 col-sm-8">
													<?php echo $user_retired_pilot_array['user_retired_pilot_total_hours']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							} else {
								echo '<span>No retired pilot information available.</span>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Pilot Licenses</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_pilot_license_array) > 0) {
							foreach ($user_pilot_license_array as $key => $user_license) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Authority: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['license_authorities_id'] === '0' ? 'Other(' . $user_license['user_license_authority_other']['user_license_authority_other_name'] . ')' : $user_license['license_authority_name']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Type: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['licenses_id'] === '0' ? 'Other(' . $user_license['user_license_type_other']['user_license_type_other_name'] . ')' : $user_license['license_type_name'] . ' ' . $user_license['license_type']; ?>
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
													<label>Approval/Ratings: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['approval_ratings_id'] === '0' ? 'Other(' . $user_license['user_license_approval_rating_other']['user_license_approval_rating_other_name'] . ')' : $user_license['approval_rating_name']; ?>
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
								<?php if ($key !== count($user_pilot_license_array) - 1) { ?>
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
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Pilot Aircraft Ratings</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_pilot_aircraft_rating_array) > 0) {
							foreach ($user_pilot_aircraft_rating_array as $key => $user_aircraft_rating) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Aircraft Type: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_aircraft_rating['my_aircrafts_id'] === '0' ? 'Other(' . $user_aircraft_rating['user_aircraft_rating_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] . ')' : $user_aircraft_rating['my_aircraft_category'] !== '' ? $user_aircraft_rating['my_aircraft_category'] . ' ' . $user_aircraft_rating['my_aircraft_name'] : $user_aircraft_rating['my_aircraft_name']; ?>
												</div>
											</div>

										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Last Flight: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_aircraft_rating['user_aircraft_rating_last_flight'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_last_flight'])) : '';
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
													<label>Recurrent: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_aircraft_rating['user_aircraft_rating_recurrent'] !== '0000-00-00' ? date('d M Y', strtotime($user_aircraft_rating['user_aircraft_rating_recurrent'])) : '';
													?>
												</div>

											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Authority: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php
													$license_authority_array = array();
													foreach ($user_aircraft_rating['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
														if ($license_authority['license_authorities_id'] === '0') {
															$license_authority_array[] = 'Other(' . $user_aircraft_rating['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other']['user_aircraft_rating_license_authority_other_name'] . ')';
														} else {
															$license_authority_array[] = $license_authority['license_authority_name'];
														}
													}
													echo implode(' , ', $license_authority_array);
													?>
												</div>
											</div>

										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Training Record: </label></div>
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
														<a title="Click to View License" href="<?php echo base_url(); ?>uploads/users/ratings<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_aircraft_rating['user_aircraft_rating_training_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br><span><?php echo $user_aircraft_rating['user_aircraft_rating_training_original_file']; ?></span>
														<?php
													} else {
														echo 'File Not Uploaded';
													}
													?>
												</div>
											</div>

										</div>
										<div class="col-md-6 col-sm-6"></div>

									</div>
								</div>
								<?php if ($key !== count($user_pilot_aircraft_rating_array) - 1) { ?>
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
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Pilot Area Experience</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($pilot_experience_array) > 0) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-lg-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Continent: </label></div>
											<div class="col-md-6 col-sm-6">
												<?php
												$continent_array = array();
												foreach ($pilot_experience_array as $key => $pilot_experience) {
													$continent_array[] = $pilot_experience['location_name'];
												}
												echo implode(' , ', $continent_array);
												?>
											</div>
										</div>

									</div>
									<div class="col-md-6 col-sm-6"></div>
								</div>
							</div>
							<?php
						} else {
							echo '<div>No Continents.</div>';
						}
						if (count($user_area_experience_array) > 0) {
							foreach ($user_area_experience_array as $area_experience) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Atlantic Crossing: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $area_experience['user_area_experience_atlantic_crossings'];
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Pacific Crossings: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $area_experience['user_area_experience_pacific_crossings'];
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Polar Crossings: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $area_experience['user_area_experience_polar_crossings'];
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Flight Times</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php if (count($pilot_flight_time_array) > 0) { ?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_flight">Total Hours: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_hour']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_pic">Total PIC : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_pic']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_jet">Total SIC: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_sic']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_instructor">Total Jet: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_jet']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_jet">Total Turboprop: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_turboprop']; ?>
											</div>
										</div>

									</div>
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_instructor">Total Night: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_night']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">

										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label for="user_total_jet">Total Instructor: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $pilot_flight_time_array['user_flight_time_total_instructor']; ?>
											</div>
										</div>

									</div>
								</div>
							</div>
							<?php
						} else {
							echo '<span>Flight Time not added.</span>';
						}
						?>					
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php if ($user_details_array['job_type_slug'] !== 'pilot' && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Medical Certificates</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($pilot_medical_array) > 0) {
							foreach ($pilot_medical_array as $key => $user_medical) {
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
													<label>Class : </label>
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
												<div class="col-md-5 col-sm-5">
													<label>Medical Certificate: </label>
												</div>
												<div class="col-md-7 col-sm-7">
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
														<a title="Click to View Certificate" href="<?php echo base_url(); ?>uploads/users/medical_certificates<?php echo date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical['user_medical_certificate_file']; ?>" target="_blank"><i class="fa <?php echo $font_icon; ?> fa-3x"></i></a><br/><span><?php echo $user_medical['user_medical_certificate_original_file']; ?></span>
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
								if ($key !== count($pilot_medical_array) - 1) {
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