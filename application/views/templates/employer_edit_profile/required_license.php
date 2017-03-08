
<div class="form-horizontal">
	<?php
	if (count($user_license_array) > 0) {
		foreach ($user_license_array as $key => $user_license) {
			?>
			<div class="clone_component_1">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">						<h4>Required Licenses</h4>
						<div class="form-group">
							<label for="user_license_type" class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select class="form-control select2_edit_profile" data-placeholder="License Type" id="licenses_id" name="licenses_id[]">
									<option></option>
									<?php foreach ($license_array as $license) {
										?>
										<option <?php
										if ($license['license_id'] === $user_license['licenses_id']) {
											echo 'selected="selected"';
										}
										?> value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type']; ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="text-right">
							<?php if ($key === count($user_license_array) - 1) { ?>
								<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);"><i class="fa fa-plus-circle"></i> Add Another License</a>
							<?php } else { ?>
								<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);" style="display:none"><i class="fa fa-plus-circle"></i> Add Another License</a>
							<?php } ?>
							<?php if (count($user_license_array) === 1) { ?>
								<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
							<?php } else { ?>
								<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);"><i class="fa fa-minus-circle"></i> Remove</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		?>
		<div class="clone_component_1">
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">						<h4>Required Licenses</h4>
					<div class="form-group">
						<label for="user_license_type" class="col-sm-4 control-label">Type</label>
						<div class="col-sm-8">
							<select class="form-control select2_edit_profile" data-placeholder="License Type" id="licenses_id" name="licenses_id[]">
								<option></option>
								<?php foreach ($license_array as $license) {
									?>
									<option value="<?php echo $license['license_id']; ?>"><?php echo $license['license_type']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="text-right">
						<a class="clone_component_button_1" href="javascript:;" onclick="clone_component(this, 1);"><i class="fa fa-plus-circle"></i> Add Another License</a>
						<a class="remove_component_button_1" href="javascript:;" onclick="remove_component(this, 1);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>