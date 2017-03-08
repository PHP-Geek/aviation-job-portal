<?php if ($user_details_array['employer_type_slug'] === 'recruiter') { ?>
	<div class="form-horizontal">
		<?php
		if (count($user_company_array) > 0) {
			foreach ($user_company_array as $key => $company) {
				?>
				<div class="clone_component_2">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4>Companies Recruit For</h4>
							<div class="form-group">
								<label for="user_company_name" class="col-sm-4 control-label">Company Name</label>
								<div class="col-sm-8">
									<input type="text" id="user_company_name" class="form-control" name="user_company_name[]" placeholder="Company Name" value="<?php echo $company['user_company_name']; ?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label for="user_company_description" class="col-sm-4 control-label">Company Details</label>
								<div class="col-sm-8">
									<textarea placeholder="Company Details" name="user_company_description[]" id="user_company_description" rows="3" class="form-control"><?php echo $company['user_company_description']; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="user_company_base" class="col-sm-4 control-label">Bases</label>
								<div class="col-sm-8">
									<select name="user_company_base[<?php echo $key; ?>][]" class="form-control select2_edit_profile_multiple select2_edit_profile" data-placeholder="Bases (You may select multiple)"  id="user_company_base" multiple="multiple">
										<?php
										foreach ($country_array as $country) {
											$selected = false;
											foreach ($company['company_bases'] as $bases) {
												if ($bases['countries_id'] === $country['country_id']) {
													$selected = TRUE;
												}
											}
											?>
											<option <?php echo $selected === TRUE ? 'selected="selected"' : ''; ?> value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
										<?php }
										?>
									</select>
								</div>
							</div>
							<div class="text-right">
								<?php if ($key === count($user_company_array) - 1) { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add Company</a>
								<?php } else { ?>
									<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);" style="display:none"><i class="fa fa-plus-circle"></i> Add Company</a>
								<?php } ?>
								<?php if (count($user_company_array) === 1) { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display:none"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } else { ?>
									<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);"><i class="fa fa-minus-circle"></i> Remove</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="clone_component_2">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4>Companies Recruit For</h4>
						<div class="form-group">
							<label for="user_company_name" class="col-sm-4 control-label">Company Name</label>
							<div class="col-sm-8">
								<input type="text" id="user_company_name" class="form-control" name="user_company_name[]" placeholder="Company Name" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="user_company_description" class="col-sm-4 control-label">Company Details</label>
							<div class="col-sm-8">
								<textarea placeholder="Company Details" name="user_company_description[]" id="user_company_description" rows="3" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="user_company_base" class="col-sm-4 control-label">Bases</label>
							<div class="col-sm-8">
								<select name="user_company_base[0][]" class="form-control select2_edit_profile_multiple select2_edit_profile" data-placeholder="Bases (You may select multiple)"  id="user_company_base" multiple="multiple">
									<?php foreach ($country_array as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
									<?php }
									?>
								</select>
							</div>
						</div>
						<div class="text-right">
							<a class="clone_component_button_2" href="javascript:;" onclick="clone_component(this, 2);"><i class="fa fa-plus-circle"></i> Add Company</a>
							<a class="remove_component_button_2" href="javascript:;" onclick="remove_component(this, 2);" style="display: none;"><i class="fa fa-minus-circle"></i> Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>
	<hr/>
<?php } ?>