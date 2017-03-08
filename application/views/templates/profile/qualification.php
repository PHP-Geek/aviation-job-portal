<?php if ($user_details_array['job_type_slug'] === 'flight-attendant') { ?>

	<div class="row">        
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4><?php echo $user_details_array['job_type_name']; ?> Qualification</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Current Position : </label>
										</div>
										<div class="col-sm-6">
											<?php echo $user_details_array['positions_id'] === '0' ? 'Other(' . $user_details_array['user_position_other'] . ')' : $user_details_array['position_name']; ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Years of Experience : </label>
										</div>
										<div class="col-sm-6">
											<?php echo $user_details_array['user_years_of_experience']; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Skills : </label>
										</div>
										<div class="col-sm-6">
											<?php
											$user_skills = array();
											foreach ($user_skill_array as $key => $skills) {
												if ($skills['skills_id'] === '0') {
													$user_skills[] = 'Other(' . $skills['user_skill_other']['user_skill_other_name'] . ')';
												} else {
													$user_skills[] = $skills['skill_name'];
												}
											}
											echo implode(' , ', $user_skills);
											?>
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
<?php if ($user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'corporate') { ?>

	<div class="row">        
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4><?php echo $user_details_array['job_type_name']; ?> Qualification</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Current Position : </label>
										</div>
										<div class="col-sm-6">
											<?php
											$user_positions = array();
											foreach ($user_position_array as $key => $position) {
												if ($position['positions_id'] === '0') {
													$user_positions[] = 'Other(' . $user_position_array[$key]['user_current_position_other']['user_current_position_other_name'] . ')';
												} else {
													$user_positions[] = $position['position_name'];
												}
											}
											echo implode(' , ', $user_positions);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Department</label>
										</div>
										<div class="col-sm-6">
											<?php echo $user_details_array['user_department']; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_years_of_experience">Years of Experience</label>
										</div>
										<div class="col-sm-6">
											<?php echo $user_details_array['user_years_of_experience'] == 0 ? '' : $user_details_array['user_years_of_experience']; ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Country of Experience</label>
										</div>
										<div class="col-sm-6">
											<?php
											$country_experience_array = array();
											foreach ($user_countries_of_experience_array as $countries) {
												$country_experience_array[] = $countries['country_name'];
											}
											echo implode(' , ', $country_experience_array);
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-sm-6">
											<label for="user_medical_height">Skills : </label>
										</div>
										<div class="col-sm-6">
											<?php
											$user_skills = array();
											foreach ($user_skill_array as $key => $skills) {
												if ($skills['skills_id'] === '0') {
													$user_skills[] = 'Other(' . $user_skill_array[$key]['user_skill_other']['user_skill_other_name'] . ')';
												} else {
													$user_skills[] = $skills['skill_name'];
												}
											}
											echo implode(' , ', $user_skills);
											?>
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