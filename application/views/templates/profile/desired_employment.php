<div class="row">    
	<div class="col-md-12 col-lg-12">
		<div class="well-white">
            <h4>Desired Employments</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<?php
					if (count($user_employment_array) > 0) {
						foreach ($user_employment_array as $key => $user_employment) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Desired Position : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_employment['user_employment_desired_position']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Position Type: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php
												$position_array = array();
												foreach ($user_employment['user_employment_positions'] as $key1 => $position) {
													if ($position['positions_id'] === '0') {
														$position_array[] = 'Other(' . $user_employment['user_employment_positions'][$key1]['user_employment_position_other']['user_employment_position_other_name'] . ')';
													} else {
														$position_array[] = $position['position_name'];
													}
												}
												echo implode(' , ', $position_array);
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
												<label>Preferred Company : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_employment['user_employment_preferred_company']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Employment Type : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_employment['user_employment_type'] !== '' ? $user_employment['user_employment_type'] : ''; ?>
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
												<label>Willing to Locate : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_employment['user_employment_willing_to_relocate'] === '1' ? 'Yes' : 'No'; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Locations: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php
												if (count($user_employment['user_employment_locations']) > 0) {
													foreach ($user_employment['user_employment_locations'] as $key1 => $employment_location) {
														echo $employment_location['country_name'];
														if ($key1 !== count($user_employment['user_employment_locations']) - 1) {
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
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Notice Period : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_employment['user_employment_availability']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							if ($key !== count($user_employment_array) - 1) {
								?>
								<hr/>
								<?php
							}
						}
					} else {
						?>
						<span>No Desired Employment Available.</span>
					<?php }
					?>
				</div>
			</div>
        </div>
    </div>

</div>