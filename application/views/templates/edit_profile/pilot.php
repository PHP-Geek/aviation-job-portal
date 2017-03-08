<?php if (isset($user_details_array['job_type_slug']) && $user_details_array['job_type_slug'] === 'pilot') { ?>	
	<div class="register">
		<?php
		if (count($user_type_rating_array) > 0) {
			foreach ($user_type_rating_array as $key => $type_rating) {
				?>
				<div class="clone_component_4">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Type Ratings</h4>
							<div class="form-group">
								<label for="models_id" class="col-sm-4 control-label">Model</label>
								<div class="col-sm-8">
									<select name="models_id[]" id="models_id" class="form-control select2_edit_profile" data-placeholder="Model">
										<option></option>
										<?php foreach ($model_array as $model) { ?>
											<option <?php
											if ($type_rating['models_id'] === $model['model_id']) {
												echo 'selected="selected"';
											}
											?> value="<?php echo $model['model_id']; ?>"><?php echo $model['model_name']; ?></option>
											<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="user_type_rating_aircraft_last_flown" class="col-sm-4 control-label">Last Flown On</label>
								<div class="col-sm-8">
									<div class="input-group date edit_profile_date_picker">
										<input type="text" id="user_type_rating_aircraft_last_flown" class="form-control" name="user_type_rating_aircraft_last_flown[]" placeholder="Last Flown On" value="<?php echo date('d/m/Y', strtotime($type_rating['user_type_rating_aircraft_last_flown'])); ?>">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="user_type_rating_total_ratings" class="col-sm-4 control-label">Total</label>
								<div class="col-sm-8">
									<input type="text" id="user_type_rating_total_ratings" class="form-control" name="user_type_rating_total_ratings[]" placeholder="Total Ratings" value="<?php echo $type_rating['user_type_rating_total_ratings']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="user_type_rating_pic" class="col-sm-4 control-label">PIC</label>
								<div class="col-sm-8">
									<input type="text" id="user_type_rating_pic" class="form-control" name="user_type_rating_pic[]" placeholder="PIC Ratings" value="<?php echo $type_rating['user_type_rating_pic']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="user_type_rating_sic" class="col-sm-4 control-label">SIC</label>
								<div class="col-sm-8">
									<input type="text" id="user_type_rating_sic" class="form-control" name="user_type_rating_sic[]" placeholder="SIC ratings" value="<?php echo $type_rating['user_type_rating_sic']; ?>">
								</div>
							</div>
							<div class="text-right">
								<?php if ($key == count($user_type_rating_array) - 1) { ?>
									<a class="clone_component_button_4" href="javascript:;" onclick="clone_component(this, 4);"><i class="fa fa-plus-circle"></i> Add Type Rating</a>
								<?php } else { ?>
									<a class="clone_component_button_4" href="javascript:;" onclick="clone_component(this, 4);" style="display:none"><i class="fa fa-plus-circle"></i> Add Type Rating</a>
								<?php } ?>
								<?php if (count($user_type_rating_array) === 1) { ?>
									<a class="remove_component_button_4" href="javascript:;" onclick="remove_component(this, 4);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_4" href="javascript:;" onclick="remove_component(this, 4);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_4">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Type Ratings</h4>
						<div class="form-group">
							<label for="models_id" class="col-sm-4 control-label">Model</label>
							<div class="col-sm-8">
								<select name="models_id[]" id="models_id" class="form-control select2_edit_profile" data-placeholder="Model">
									<option></option>
									<?php foreach ($model_array as $model) { ?>
										<option value="<?php echo $model['model_id']; ?>"><?php echo $model['model_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="user_type_rating_aircraft_last_flown" class="col-sm-4 control-label">Last Flown On</label>
							<div class="col-sm-8">
								<div class="input-group date edit_profile_date_picker">
									<input type="text" id="user_type_rating_aircraft_last_flown" class="form-control" name="user_type_rating_aircraft_last_flown[]" placeholder="Last Flown On">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="user_type_rating_total_ratings" class="col-sm-4 control-label">Total</label>
							<div class="col-sm-8">
								<input type="text" id="user_type_rating_total_ratings" class="form-control" name="user_type_rating_total_ratings[]" placeholder="Total Ratings">
							</div>
						</div>
						<div class="form-group">
							<label for="user_type_rating_pic" class="col-sm-4 control-label">PIC</label>
							<div class="col-sm-8">
								<input type="text" id="user_type_rating_pic" class="form-control" name="user_type_rating_pic[]" placeholder="PIC Ratings">
							</div>
						</div>
						<div class="form-group">
							<label for="user_type_rating_sic" class="col-sm-4 control-label">SIC</label>
							<div class="col-sm-8">
								<input type="text" id="user_type_rating_sic" class="form-control" name="user_type_rating_sic[]" placeholder="SIC Ratings">
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_4" href="javascript:;" onclick="clone_component(this, 4);"><i class="fa fa-plus-circle"></i> Add Type Rating</a>
							<a class="remove_component_button_4" href="javascript:;" onclick="remove_component(this, 4);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php }
		?>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
			<h4>Maintenance License </h4>
			<form class="form-inline">
				<div class="form-group">
					<label for="user_maintainance_license_type" class="col-sm-4 control-label">Type</label>
					<div class="col-sm-8">
						<select id="user_maintainance_license_type" name="user_maintainance_license_type" class="form-control select2_edit_profile" data-placeholder="Maintenance License Type">
							<option></option>
							<?php foreach ($maintainance_license_type_array as $type) { ?>
								<option <?php
								if ($type === $user_details_array['user_maintainance_license_type']) {
									echo 'selected="selected"';
								}
								?> value="<?php echo $type; ?>"><?php echo $type; ?></option>
								<?php } ?>
						</select>
					</div>
				</div>
		</div>
	</div>
	<hr/>
<?php } ?>
