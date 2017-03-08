<div class="row">    
	<div class="col-md-12 col-lg-12">
		<div class="well-white">
            <h4>Previous Employment</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<?php
					if (count($user_previous_employment_array) > 0) {
						foreach ($user_previous_employment_array as $key => $user_previous_employment) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Organization : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_previous_employment['user_previous_employment_company']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Position : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_previous_employment['positions_id'] === '0' ? 'Other(' . $user_previous_employment['user_previous_employment_position_other']['user_previous_employment_position_other_name'] . ')' : $user_previous_employment['position_name']; ?>
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
												<label>Start Date : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_previous_employment['user_previous_employment_start_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_previous_employment['user_previous_employment_start_date'])) : ''; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Completion Date : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_previous_employment['user_previous_employment_end_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_previous_employment['user_previous_employment_end_date'])) : ''; ?>
											</div>
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
						<span>No Previous Employment Available.
						<?php }
						?>
				</div>
			</div>
        </div>
    </div>

</div>