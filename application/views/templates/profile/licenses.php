<?php if ($user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>

	<div class="row">        
		<div class="col-md-12  col-lg-12">
			<div class="well-white">
				<h4><?php
					switch ($user_details_array['job_type_slug']) {
						case 'pilot':
							echo 'Pilot';
							break;
						case 'maintenance-engineer':
							echo 'Mechanic';
							break;
						case 'air-traffic-controller':
							echo 'ATC';
							break;
					}
					?> Licenses</h4>
				<div class="row">
					<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
						<?php
						if (count($user_license_array) > 0) {
							foreach ($user_license_array as $key => $user_license) {
								?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6  col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>License Authority: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['license_authorities_id'] === '0' ? 'Other(' . $user_license['user_license_authority_other']['user_license_authority_other_name'] . ')' : $user_license['license_authority_name']; ?>
												</div>
											</div>

										</div>
										<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'air-traffic-controller') { ?>
											<div class="col-md-6 col-sm-6">

												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>License Type: </label>
													</div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_license['licenses_id'] === '0' ? 'Other(' . $user_license['user_license_type_other']['user_license_type_other_name'] . ')' : $user_license['license_type_name'] . ' ' . $user_license['license_type']; ?>
													</div>
												</div>

											</div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6  col-sm-6">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Current Positions: </label></div>
												<div class="col-md-6 col-sm-6">
													<?php
													$position_array = array();
													foreach ($user_license['user_license_position_array'] as $key1 => $positions) {
														if ($positions['positions_id'] === '0') {
															$position_array[] = 'Other(' . $user_license['user_license_position_array'][$key1]['user_license_position_other']['user_license_position_other_name'] . ')';
														} else {
															$position_array[] = $positions['position_name'];
														}
													}
													echo implode(' , ', $position_array);
													?>
												</div>
											</div>

										</div>
										<div class="col-md-6 col-sm-6">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Expiry Date: </label>
												</div>
												<div class="col-md-6 col-sm-6">
													<?php echo $user_license['user_license_expire_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_license['user_license_expire_date'])) : ''; ?>
												</div>
											</div>

										</div>
									</div>
								</div>
								<?php if ($user_details_array['job_type_slug'] === 'pilot') { ?>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6  col-sm-6">

												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>Approval/Ratings: </label></div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_license['approval_ratings_id'] === '0' ? 'Other(' . $user_license['user_license_approval_rating_other']['user_license_approval_rating_other_name'] . ')' : $user_license['approval_rating_name']; ?>
													</div>
												</div>

											</div>
											<div class="col-md-6  col-sm-6">

												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>English Proficient: </label>
													</div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_license['user_license_is_english_proficient'] ? 'Yes' : 'No'; ?>
													</div>
												</div>

											</div>
										</div>
									</div>
								<?php } ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
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
								</div>
								<?php if ($key !== count($user_license_array) - 1) { ?>
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
<?php } ?>