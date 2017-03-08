<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot' && $user_details_array['job_type_slug'] !== 'maintenance-engineer' && $user_details_array['job_type_slug'] !== 'flight-attendant') { ?>
	<!-- Management Experience Details -->
	<div class="register">
		<?php
		if (count($user_maintenance_experience_array) > 0) {
			foreach ($user_maintenance_experience_array as $key => $user_maintenance_experience) {
				?>
				<div class="clone_component_11">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Management Experiences</h4>
							<div class="form-group">
								<label for="user_maintenance_experience_type" class="col-sm-4 control-label">Type</label>
								<div class="col-sm-8">
									<input type="text" name="user_maintenance_experience_type[]" id="user_maintenance_experience_type" placeholder="Organization/Company" class="form-control" value="<?php echo $user_maintenance_experience['user_maintenance_experience_type']; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_maintenance_experience_company" class="col-sm-4 control-label">Organization/Company</label>
								<div class="col-sm-8">
									<input type="text" name="user_maintenance_experience_company[]" id="user_maintenance_experience_company" placeholder="Organization/Company" class="form-control" value="<?php echo $user_maintenance_experience['user_maintenance_experience_company']; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_maintenance_experience_start_date" class="col-sm-4 control-label">From</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" placeholder="License Expire Date" name="user_maintenance_experience_start_date[]" class="form-control date-picker" id="user_maintenance_experience_start_date" value="<?php echo date('d/m/Y', strtotime($user_maintenance_experience['user_maintenance_experience_start_date'])); ?>"/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-111"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="user_maintenance_experience_end_date" class="col-sm-4 control-label">To</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" placeholder="License Expire Date" name="user_maintenance_experience_end_date[]" class="form-control date-picker" id="user_maintenance_experience_end_date" value="<?php echo $user_maintenance_experience['user_maintenance_experience_end_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_maintenance_experience['user_maintenance_experience_end_date'])) : ''; ?>"/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-111"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_maintenance_experience_array) - 1) { ?>
									<a class="clone_component_button_11" href="javascript:;" onclick="clone_component(this, 11);"><i class="fa fa-plus-circle"></i> Add Management Experience</a>
								<?php } else { ?>
									<a class="clone_component_button_11" href="javascript:;" onclick="clone_component(this, 11);" style="display:none"><i class="fa fa-plus-circle"></i> Add Management Experience</a>
								<?php } ?>
								<?php if (count($user_maintenance_experience_array) === 1) { ?>
									<a class="clone_component_button_11" href="javascript:;" onclick="remove_component(this, 11);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="clone_component_button_11" href="javascript:;" onclick="remove_component(this, 11);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_11">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Management Experiences</h4>
						<div class="form-group">
							<label for="user_maintenance_experience_type" class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<input type="text" name="user_maintenance_experience_type[]" id="user_maintenance_experience_type" placeholder="Organization/Company" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_maintenance_experience_company" class="col-sm-4 control-label">Organization/Company</label>
							<div class="col-sm-7">
								<input type="text" name="user_maintenance_experience_company[]" id="user_maintenance_experience_company" placeholder="Organization/Company" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_maintenance_experience_start_date" class="col-sm-4 control-label">From</label>
							<div class="col-sm-7">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" placeholder="License Expire Date" name="user_maintenance_experience_start_date[]" class="form-control date-picker" id="user_maintenance_experience_start_date">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-111"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="user_maintenance_experience_end_date" class="col-sm-4 control-label">To</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" placeholder="License Expire Date" name="user_maintenance_experience_end_date[]" class="form-control date-picker" id="user_maintenance_experience_end_date">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-111"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_11" href="javascript:;" onclick="clone_component(this, 11);"><i class="fa fa-plus-circle"></i> Add Maintenance Experience</a>
							<a class="clone_component_button_11" href="javascript:;" onclick="remove_component(this, 11);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
					?>
				</div>
			</div>
		<?php } ?>
	</div>
	<hr/>
<?php } ?>