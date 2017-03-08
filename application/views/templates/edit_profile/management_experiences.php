<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot' || $user_details_array['job_type_slug'] === 'maintenance-engineer' || $user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'flight-attendant' || $user_details_array['job_type_slug'] === 'air-traffic-controller') { ?>
	<!-- Management Experience Details -->
	<div class="register">
		<?php
		if (count($user_management_experience_array) > 0) {
			foreach ($user_management_experience_array as $key => $user_management_experience) {
				?>
				<div class="clone_component_10">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Management Experiences</h4>
							<div class="form-group">
								<label for="user_management_experience_type" class="col-sm-4 control-label">Type</label>
								<div class="col-sm-8">
									<input type="text" name="user_management_experience_type[]" id="user_management_experience_type" placeholder="Organization/Company" class="form-control" value="<?php echo $user_management_experience['user_management_experience_type']; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_company" class="col-sm-4 control-label">Organization/Company</label>
								<div class="col-sm-8">
									<input type="text" name="user_management_experience_company[]" id="user_management_experience_company" placeholder="Organization/Company" class="form-control" value="<?php echo $user_management_experience['user_management_experience_company']; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_start_date" class="col-sm-4 control-label">From</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" placeholder="License Expire Date" name="user_management_experience_start_date[]" class="form-control date-picker" id="user_management_experience_start_date" value="<?php echo date('d/m/Y', strtotime($user_management_experience['user_management_experience_start_date'])); ?>"/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_end_date" class="col-sm-4 control-label">To</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" placeholder="License Expire Date" name="user_management_experience_end_date[]" class="form-control date-picker" id="user_management_experience_end_date" value="<?php echo $user_management_experience['user_management_experience_end_date'] !== '0000-00-00' ? date('d/m/Y', strtotime($user_management_experience['user_management_experience_end_date'])) : ''; ?>"/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_management_experience_array) - 1) { ?>
									<a class="clone_component_button_10" href="javascript:;" onclick="clone_component(this, 10);"><i class="fa fa-plus-circle"></i> Add Management Experience</a>
								<?php } else { ?>
									<a class="clone_component_button_10" href="javascript:;" onclick="clone_component(this, 10);" style="display:none"><i class="fa fa-plus-circle"></i> Add Management Experience</a>
								<?php } ?>
								<?php if (count($user_management_experience_array) === 1) { ?>
									<a class="remove_component_button_10" href="javascript:;" onclick="remove_component(this, 10);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_10" href="javascript:;" onclick="remove_component(this, 10);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_10">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Management Experiences</h4>
						<div class="form-group">
							<label for="user_management_experience_type" class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<input type="text" name="user_management_experience_type[]" id="user_management_experience_type" placeholder="Organization/Company" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_management_experience_company" class="col-sm-4 control-label">Organization/Company</label>
							<div class="col-sm-8">
								<input type="text" name="user_management_experience_company[]" id="user_management_experience_company" placeholder="Organization/Company" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label for="user_management_experience_start_date" class="col-sm-4 control-label">From</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" placeholder="License Expire Date" name="user_management_experience_start_date[]" class="form-control date-picker" id="user_management_experience_start_date">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="user_management_experience_end_date" class="col-sm-4 control-label">To</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" placeholder="License Expire Date" name="user_management_experience_end_date[]" class="form-control date-picker" id="user_management_experience_end_date">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_10" href="javascript:;" onclick="clone_component(this, 10);"><i class="fa fa-plus-circle"></i> Add Maintenance Experience</a>
							<a class="remove_component_button_10" href="javascript:;" onclick="remove_component(this, 10);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php }
		?>
	</div>
	<hr/>
<?php }
?>