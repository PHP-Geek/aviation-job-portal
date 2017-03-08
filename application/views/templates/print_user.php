<!doctype html>
<html>
    <head><title>Print User</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<style type="text/css">
			@media all {
				.page-break	{ display: none; }
			}

			@media print {
				.page-break	{ display: block; page-break-before: always; }
			}
		</style>
	</head>
	<body>
		<?php
		if (count($user_id_array) > 0) {
			foreach ($user_id_array as $user_id) {
				$user_details_array = $this->User_model->get_user_by_id($user_id);
				$user_license_array = $this->User_model->get_user_licenses_by_user_id($user_id);
				$user_passport_array = $this->User_model->get_user_passports_by_user_id($user_id);
				$user_type_rating_array = $this->User_model->get_user_type_ratings_by_user_id($user_id);
				$user_previous_employment_array = $this->User_model->get_user_previous_employments_by_user_id($user_id);
				$user_validation_array = $this->User_model->get_user_validations_by_user_id($user_id);
				$user_visa_array = $this->User_model->get_user_visas_by_user_id($user_id);
				$user_training_array = $this->User_model->get_user_training_by_user_id($user_id);
				$user_medical_array = $this->User_model->get_user_medical_certificate_by_user_id($user_id);
				$medical_examination_array = $this->User_model->get_medical_examinations();
				$user_experience_array = $this->User_model->get_user_experience_by_user_id($user_id);
				$training_array = $this->User_model->get_trainings();
				$model_array = $this->Aircraft_model->get_models();
				$location_array = $this->User_model->get_active_locations();
				$user_aircraft_experience_array = $this->User_model->get_user_aircraft_experience_by_user_id($user_id);
				$user_management_experience_array = $this->User_model->get_user_management_experience_by_user_id($user_id);
				$user_employment_array = $this->User_model->get_user_employment_by_user_id($user_id);
				?>
				<div class="container" id="bodydiv">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="text-center">
								<h4><?php echo $user_details_array['user_first_name'] . ' ' . $user_details_array['user_last_name'] . '(' . $user_details_array['job_type_name'] . ')'; ?></h4>
								<label>Email : </label><?php echo $user_details_array['user_email']; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Personal Details</h4>
							<div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label>Contact Number : </label>
									</div>
									<div class="col-md-8 col-sm-4">
										<?php echo $user_details_array['user_country_code'] . '-' . $user_details_array['user_primary_contact']; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label>Skype Name : </label>
									</div>
									<div class="col-md-8 col-sm-8">
										<?php echo $user_details_array['user_skype_id']; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label>Address : </label>
									</div>
									<div class="col-md-8 col-sm-8">
										<?php echo $user_details_array['user_address'] . ' ' . $user_details_array['user_city'] . ' ' . $user_details_array['user_state'] . ' , ' . $user_details_array['country_name'] . ' - ' . $user_details_array['user_zipcode']; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label>Type of Position/Specific Role : </label>
									</div>
									<div class="col-md-8 col-sm-8"><?php echo $user_details_array['employee_role_name']; ?></div>
								</div>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Qualification</h4>
							<div>
								<?php if ($user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label>Type Ratings : </label>
										</div>
										<div class="col-md-4 col-sm-4">
											<?php echo $user_details_array['type_rating_name']; ?>
										</div>
									</div>
								<?php } ?>
								<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label for="user_total_hours">Total Hours : </label>
										</div>
										<div class="col-md-8 col-sm-4">
											<?php echo $user_details_array['user_total_hours']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label for="user_current_rating">Current Ratings : </label>
										</div>
										<div class="col-md-8 col-sm-8">
											<?php echo $user_details_array['type_rating_name']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label for="user_hours_type_rating">Hours on Type Rating : </label>
										</div>
										<div class="col-md-8 col-sm-8">
											<?php echo $user_details_array['user_hours_type_rating']; ?>
										</div>
									</div>
								<?php } ?>
								<?php if ($user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'corporate') { ?>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label for="user_year_of_experience">Years of Experience: </label>
										</div>
										<div class="col-md-8 col-sm-8">
											<?php echo $user_details_array['user_years_of_experience']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label  for="user_role_type">Current Position : </label>
										</div>
										<div class="col-md-8 col-sm-4">
											<?php echo $user_details_array['user_role_type']; ?>
										</div>
									</div>
								<?php } ?>
								<?php if ($user_details_array['job_type_slug'] === 'flight-attendant') { ?>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label for="user_years_of_experience">Years of Experience : </label>
										</div>
										<div class="col-md-8 col-sm-8">
											<?php echo $user_details_array['user_years_of_experience']; ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<hr/>
					<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<h4>Flight Times</h4>
								<div>
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-6 col-sm-4">
													<label for="user_total_flight">Total Flights : </label>
												</div>
												<div class="col-md-6 col-sm-8">
													<?php echo $user_details_array['user_total_flight']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-6 col-sm-4">
													<label for="user_total_pic">Total PIC : </label>
												</div>
												<div class="col-md-6 col-sm-8">
													<?php echo $user_details_array['user_total_pic']; ?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-6 col-sm-4">
													<label for="user_total_jet">Total Jets : </label>
												</div>
												<div class="col-md-6 col-sm-8">
													<?php echo $user_details_array['user_total_jet']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="row">
												<div class="col-md-7 col-sm-4">
													<label for="user_total_instructor">Total Instructors : </label>
												</div>
												<div class="col-md-5 col-sm-8">
													<?php echo $user_details_array['user_total_instructor']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr/>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<h4>Type Ratings</h4>
								<div>
									<?php
									if (count($user_type_rating_array) > 0) {
										foreach ($user_type_rating_array as $key => $type_rating) {
											?>
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-4 col-sm-4">
															<label>Model : </label>
														</div>
														<div class="col-md-8 col-sm-8">
															<?php echo $type_rating['model_name']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-6 col-sm-4">
															<label>Last Flown On : </label>
														</div>
														<div class="col-md-6 col-sm-8">
															<?php echo date('d M Y', strtotime($type_rating['user_type_rating_aircraft_last_flown'])); ?>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-8 col-sm-4">
															<label>Total Ratings : </label>
														</div>
														<div class="col-md-4 col-sm-8">
															<?php echo $type_rating['user_type_rating_total_ratings']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-lg-3">
													<div class="row">
														<div class="col-md-6 col-sm-4">
															<label>PIC : </label>
														</div>
														<div class="col-md-6 col-sm-8">
															<?php echo $type_rating['user_type_rating_pic']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-lg-3">
													<div class="row">
														<div class="col-md-6 col-sm-4">
															<label>SIC : </label>
														</div>
														<div class="col-md-6 col-sm-8">
															<?php echo $type_rating['user_type_rating_sic']; ?>
														</div>
													</div>
												</div>
											</div>
											<?php
											if ($key !== count($user_type_rating_array) - 1) {
												echo '<hr/>';
											}
										}
									} else {
										?>
										<span class="text-info">No Type Rating Available.
										<?php }
										?>
								</div>
							</div>
						</div>
						<hr/>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<h4>Maintenance License </h4>
								<div>
									<div class="form-group">
										<label>Type : </label>
										<?php echo $user_details_array['user_maintainance_license_type']; ?>
									</div>
								</div>
							</div>
						</div>
						<hr/>
					<?php } ?>
					<?php if (isset($user_details_array['job_type_slug']) && $user_details_array['job_type_slug'] === 'flight-attendant') { ?>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<h4>Aircraft Experience</h4>
								<div>
									<div class="form-group">
										<?php
										if (count($user_aircraft_experience_array) > 0) {
											$aircraft_experience_location_array = array();
											foreach ($user_aircraft_experience_array as $aircraft_experience_location) {
												array_push($aircraft_experience_location_array, $aircraft_experience_location['location_name']);
											}
											echo implode(' , ', $aircraft_experience_location_array);
										} else {
											echo '<span class="text-info">No Aircraft Experience Available.';
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<hr/>
					<?php } ?>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Trainings</h4>
							<div>
								<?php
								if (count($user_training_array) > 0) {
									foreach ($user_training_array as $key => $user_training) {
										?>
										<div class="row">
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Course/Training : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo $user_training['training_name']; ?></div>
												</div>
											</div>
											<div class="col-md-5 col-lg-5">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Expire On : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo date('d M Y', strtotime($user_training['user_training_completion_date'])); ?>
													</div>
												</div>
											</div>
										</div><?php if ($key !== count($user_training_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No Training Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Management Experiences</h4>
							<div>
								<?php
								if (count($user_management_experience_array) > 0) {
									foreach ($user_management_experience_array as $key => $user_management_experience) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-4 col-sm-4">
														<label>Type : </label></div>
													<div class="col-md-8 col-sm-8">
														<?php echo $user_management_experience['user_management_experience_type']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="col-md-6 col-sm-6">
													<label>Company/ Organization : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_management_experience['user_management_experience_company']; ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-4 col-sm-4">
														<label>From : </label></div>
													<div class="col-md-8 col-sm-8">
														<?php echo $user_management_experience['user_management_experience_start_date']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="col-md-6 col-sm-6">
													<label>To : </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_management_experience['user_management_experience_end_date'] !== '0000-00-00' ? $user_management_experience['user_management_experience_end_date'] : ''; ?>
												</div>
											</div>
										</div>
										<?php if ($key !== count($user_management_experience_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No Management Experience Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Licenses</h4>
							<div>
								<?php
								if (count($user_license_array) > 0) {
									foreach ($user_license_array as $key => $user_license) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="row">
													<div class="col-md-4 col-sm-4">
														<label>Type : </label></div>
													<div class="col-md-8 col-sm-8">
														<?php echo $user_license['license_type']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6 col-sm-6">
												<div class="col-md-5 col-sm-5">
													<label>Expire On : </label>
												</div>
												<div class="col-md-7 col-sm-7">
													<?php echo date('d M Y', strtotime($user_license['user_license_expire_date'])); ?>
												</div>
											</div>
										</div>
										<?php if ($key !== count($user_license_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No License Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Passports</h4>
							<div>
								<?php
								if (count($user_passport_array) > 0) {
									foreach ($user_passport_array as $key => $user_passport) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-4 col-sm-4">
														<label>Country : </label>
													</div>
													<div class="col-md-8 col-sm-8">
														<?php echo $user_passport['country_name']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-5 col-sm-5">
														<label>Expire On : </label>
													</div>
													<div class="col-md-7 col-sm-7">
														<?php echo date('d M Y', strtotime($user_passport['user_passport_expire_date'])); ?>
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
									<span class="text-info">No Passport Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<h4>Validations</h4>
								<div>
									<?php
									if (count($user_validation_array) > 0) {
										foreach ($user_validation_array as $key => $user_validation) {
											?>
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-4 col-sm-4">
															<label>Country : </label>
														</div>
														<div class="col-md-8 col-sm-8">
															<?php echo $user_validation['country_name']; ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<div class="col-md-5 col-sm-5">
															<label>Expire On : </label>
														</div>
														<div class="col-md-7 col-sm-7">
															<?php echo date('d M Y', strtotime($user_validation['user_validation_expire_date'])); ?>
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
										<span class="text-info">No Validation Available.
										<?php }
										?>
								</div>
							</div>
						</div>
					<?php } ?>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Visa</h4>
							<div>
								<?php
								if (count($user_visa_array) > 0) {
									foreach ($user_visa_array as $key => $user_visa) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-4 col-sm-4">
														<label>Country : </label>
													</div>
													<div class="col-md-8 col-sm-8">
														<?php echo $user_visa['country_name']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-5 col-sm-4">
														<label>Expire On : </label>
													</div>
													<div class="col-md-7 col-sm-8">
														<?php echo date('d M Y', strtotime($user_visa['user_visa_expire_date'])); ?>
													</div>
												</div>
											</div>
										</div><?php if ($key !== count($user_visa_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No Visa Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Medical</h4>
							<div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label for="user_medical_height">Height : </label>
									</div>
									<div class="col-md-8 col-sm-8">
										<?php echo $user_details_array['user_medical_height']; ?>
										<?php echo $user_details_array['user_medical_height_unit']; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<label for="user_medical_height">Weight : </label>
									</div>
									<div class="col-md-8 col-sm-8">
										<?php echo $user_details_array['user_medical_weight']; ?>
										<?php echo $user_details_array['user_medical_weight_unit']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div>
								<?php
								if (count($user_medical_array) > 0) {
									foreach ($user_medical_array as $key => $user_medical) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Exam : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo $user_medical['medical_examination_name']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Class : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo $user_medical['user_medical_class']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class= "col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Exam Date : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo date('d M Y', strtotime($user_medical['user_medical_exam_date'])); ?>
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
									<span class="text-info">No Medical Examination Available.
									<?php } ?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Previous Employment</h4>
							<div>
								<?php
								if (count($user_previous_employment_array) > 0) {
									foreach ($user_previous_employment_array as $key => $user_previous_employment) {
										?>
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Company/Organization : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo $user_previous_employment['user_previous_employment_company']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Start Date : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo date('d M Y', strtotime($user_previous_employment['user_previous_employment_start_date'])); ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="col-md-6 col-sm-4">
														<label>Completion Date : </label>
													</div>
													<div class="col-md-6 col-sm-8">
														<?php echo date('d M Y', strtotime($user_previous_employment['user_previous_employment_end_date'])); ?>
													</div>
												</div>
											</div>
										</div>
										<?php if ($key !== count($user_previous_employment_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No Previous Employment Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Flying Experience</h4>
							<div>
								<div class="row">
									<div class="col-md-6 col-sm-4">
										<label>Atlantic Crossing : </label>
									</div>
									<div class="col-md-6 col-sm-8">
										<?php echo $user_details_array['atlantic_aircraft_name']; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-4">
										<label>Pacific Crossing : </label>
									</div>
									<div class="col-md-6 col-sm-8">
										<?php echo $user_details_array['pacific_aircraft_name']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Experiences</h4>
							<div>
								<?php if (count($user_experience_array) > 0) { ?>
									<?php
									foreach ($user_experience_array as $key => $user_experience) {
										?>
										<?php echo $user_experience['location_name']; ?>
										<?php
										if ($key !== count($user_experience_array) - 1) {
											echo ' , ';
										}
									}
									?>
									<?php
								} else {
									?>
									<span class="text-info">No Experiences Available.
									<?php }
									?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<h4>Desired Employments</h4>
							<div>
								<?php
								if (count($user_employment_array) > 0) {
									foreach ($user_employment_array as $key => $user_employment) {
										?>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Position : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_position']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Preferred Company : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_preferred_company']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Position Type : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_position_type']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Employment Type : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_type']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Willing To Relocate : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_willing_to_relocate'] === '1' ? 'Yes' : 'No'; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Availability : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php echo $user_employment['user_employment_availability']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<div class="row">
													<div class="com-md-6 col-sm-4">
														<label>Locations To Relocate : </label>
													</div>
													<div class="com-md-6 col-sm-8">
														<?php
														if (count($user_employment['user_employment_locations']) > 0) {
															foreach ($user_employment['user_employment_locations'] as $key => $employment_location) {
																echo $employment_location['country_name'];
																if ($key !== count($user_employment['user_employment_locations']) - 1) {
																	echo ' , ';
																}
															}
														} else {
															echo 'n/a';
														}
														?>
													</div>
												</div>
											</div>
										</div>
										<?php if ($key !== count($user_employment_array) - 1) { ?>
											<hr/>
											<?php
										}
									}
								} else {
									?>
									<span class="text-info">No Desired Employment Available.
									<?php }
									?>
							</div>
						</div>
					</div>
				</div>
				<div class="page-break"></div>
				<?php
			}
		}
		?>
		<script type="text/javascript">
			window.onload = function () {
				window.print();
				window.close();
			}
		</script>
	</body>
</html>