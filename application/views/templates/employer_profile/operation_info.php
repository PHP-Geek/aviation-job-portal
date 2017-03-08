<?php if (isset($user_details_array) && $user_details_array['employer_type_slug'] === 'recruiter') { ?>
	<div class="row">		
		<div class="col-md-12 col-lg-12">
			<div class="well-white">
				<h4>Operation Information</h4>
				<div class="row">
					<div class="col-md-offset-2 col-sm-offset-1 col-xs-offset-2">
						<div class="col-md-12 col-sm-12">
							<?php
							if (count($user_operation_type_array) > 0) {
								foreach ($user_operation_type_array as $key => $user_operation) {
									?>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>
															Number of Staff :
														</label>
													</div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_operation['user_operation_type_number_of_staff']; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<label>
															Recruit for :
														</label>
													</div>
													<div class="col-md-6 col-sm-6">
														<?php echo $user_operation['user_operation_type_recruit_for']; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3 col-sm-3">
												<label>
													Logo :
												</label>
											</div>
											<div class="col-md-9 col-sm-9">
												<?php
												if (is_file(FCPATH . 'uploads/users/company_logos' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_operation['user_operation_type_logo'])) {
													?>
													<img src="<?php echo base_url() . 'uploads/users/company_logos' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_operation['user_operation_type_logo']; ?>" style="width:60px;height:60px"/><br/>
													<?php echo $user_operation['user_operation_type_original_name']; ?>
													<?php
												} else {
													echo 'No Logo Available.';
												}
												?>
											</div>
										</div>
									</div>
									<?php
									if ($key !== count($user_operation_type_array) - 1) {
										echo '<hr/>';
									}
								}
							} else {
								echo '<div>No Operation Information Available.</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="row">		
			<div class="col-md-12 col-lg-12">
				<div class="well-white">
				<h4>Operation Information</h4>
				<div class="row">
					<div class="col-md-offset-2 col-sm-offset-1 col-xs-offset-2">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label>
											Type of Operation :
										</label>
									</div>
									<div class="col-md-6 col-sm-6">
										<?php
										if (count($user_operation_type_array) > 0) {
											$operation_type_array = array();
											foreach ($user_operation_type_array as $operation_type) {
												$operation_type_array[] = $operation_type['operation_type'];
											}
											echo implode(' , ', $operation_type_array);
										} else {
											echo 'No Operation Information Available.';
										}
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<label>
											Number of Staff :
										</label>
									</div>
									<div class="col-md-6 col-sm-6">
										<?php echo $user_details_array['user_number_of_staff']; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
