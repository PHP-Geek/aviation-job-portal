
<div class="row">    
	<div class="col-md-12 col-lg-12">
		<div class="well-white">
            <h4>Area Experience</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<?php if ($user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'flight-attendant') { ?>
										<div class="col-md-3 col-sm-3">
											<label>Continent : </label>
										</div>
										<div class="col-md-9 col-sm-9">
											<?php
											if (count($user_experience_array) > 0) {
												$location_array = array();
												foreach ($user_experience_array as $key => $experience) {
													$location_array[] = $experience['location_name'];
												}
												echo implode(' , ', $location_array);
											} else {
												echo 'No Locations';
											}
											?>
										</div>
									<?php } ?>
									<?php if ($user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'corporate' || $user_details_array['job_type_slug'] === 'air-traffic-controller' || $user_details_array['job_type_slug'] === 'operations') {
										?>
										<div class="col-md-3 col-sm-3">
											<label>Countries : </label>
										</div>
										<div class="col-md-9 col-sm-9">
											<?php
											if (count($user_experience_array) > 0) {
												$location_array = array();
												foreach ($user_experience_array as $key => $experience) {
													$location_array[] = $experience['country_name'];
												}
												echo implode(' , ', $location_array);
											} else {
												echo 'No Countries';
											}
											?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="row">
										<div class="col-md-6 col-lg-6"><label>Atlantic Crossings : </label></div>
										<div class="col-md-6 col-lg-6"><?php echo $user_details_array['user_atlantic_crossing']; ?></div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="row">
										<div class="col-md-6 col-lg-6"><label>Pacific Crossings : </label></div>
										<div class="col-md-6 col-lg-6"><?php echo $user_details_array['user_pacific_crossing']; ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="row">
										<div class="col-md-6 col-lg-6"><label>Polar Crossings : </label></div>
										<div class="col-md-6 col-lg-6"><?php echo $user_details_array['user_polar_crossing']; ?></div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
        </div>
	</div>
</div>