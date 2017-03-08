<?php if ($user_details_array['job_type_slug'] === 'flight-attendant') { ?>
	<div class="row">        
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Aircraft Experience</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="user_medical_height">Aircraft Type : </label>
								</div>
								<div class="col-md-9 col-sm-8">
									<?php
									$user_aircraft_array = array();
									foreach ($user_aircraft_experience_array as $key => $user_aircraft_experience) {
										if ($user_aircraft_experience['my_aircrafts_id'] === '0') {
											$user_aircraft_array[] = 'Other(' . $user_aircraft_experience_array[$key]['user_aircraft_experience_aircraft_type_other']['user_aircraft_experience_aircraft_type_other_name'] . ')';
										} else {
											$user_aircraft_array[] = $user_aircraft_experience['my_aircraft_name'];
										}
									}
									echo implode(' , ', $user_aircraft_array);
									?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="user_medical_height">Last Flight : </label>
								</div>
								<div class="col-md-9 col-sm-8">
									<?php echo $user_details_array['user_aircraft_last_flight'] !== '0000-00-00' ? date('d M Y', strtotime($user_details_array['user_aircraft_last_flight'])) : ''; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
