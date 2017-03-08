
<div class="row">    
	<div class="col-md-12  col-lg-12">
		<div class="well-white">
            <h4>Trainings</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<?php
					if (count($user_training_array) > 0) {
						foreach ($user_training_array as $key => $user_training) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Course/Training : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_training['trainings_id'] === '0' ? 'Other(' . $user_training['user_training_course_other']['user_training_course_other_name'] . ')' : $user_training['training_name']; ?></div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Completion Date : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_training['user_training_completion_date'] !== '0000-00-00' ? date('d M Y', strtotime($user_training['user_training_completion_date'])) : ''; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if ($key !== count($user_training_array) - 1) { ?>
								<hr/>
								<?php
							}
						}
					} else {
						?>
						<span>No Training Available.
						<?php }
						?>
				</div>
			</div>
        </div>
    </div>

</div>