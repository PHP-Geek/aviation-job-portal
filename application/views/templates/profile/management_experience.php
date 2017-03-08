<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'executive' && $user_details_array['job_type_slug'] !== 'corporate') { ?>
	<div class="row">        
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Management / Corporate / Other Experience</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_management_experience_array) > 0) {
							foreach ($user_management_experience_array as $key => $management_experience) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-12 col-lg-12 col-sm-12">
											<div class="row">
												<div class="col-md-3 col-sm-3">
													<label>Type: </label></div>
												<div class="col-md-9 col-sm-9">
													<?php
													$experience_type_array = array();
													foreach ($management_experience['management_experience_types'] as $key1 => $experience_type) {
														if ($experience_type['management_experiences_id'] === '0') {
															$experience_type_array[] = 'Other(' . $management_experience['management_experience_types'][$key1]['user_management_experience_type_other']['user_management_experience_type_other_name'] . ')';
														} else {
															$experience_type_array[] = $experience_type['management_experience_name'];
														}
													}
													echo implode(' , ', $experience_type_array);
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
													<label>Organization/Company: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $management_experience['user_management_experience_company']; ?>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Years Experience: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $management_experience['user_management_experience_years_experience']; ?>
												</div>
											</div>
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
							<span>No Management Experience Available.
							<?php }
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>