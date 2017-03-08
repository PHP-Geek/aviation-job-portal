<?php if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'executive' && $user_details_array['job_type_slug'] !== 'corporate') { ?>
	<!-- License Details -->
	<div class="register">
		<?php
		if (count($user_management_experience_array) > 0) {
			foreach ($user_management_experience_array as $management_experiences) {
				?>
				<div class="">
					<div class="row">
						<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
							<h4 style="display: inline-block">Management / Corporate / Other Experience</h4> ( Please only fill out if you want to utilize these skills. )
							<div class="spacer9"></div>
							<div class="spacer9"></div>
							<div class="form-group">
								<label for="user_management_experiences_id" class="col-sm-4 control-label">Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile other_skill_management_experience-other-select" data-placeholder="Type (may select multiple)" id="user_management_experiences_id" name="user_management_experiences_id[]" multiple="multiple">
										<?php
										$other_selected = false;
										$management_experience_key = '';
										foreach ($management_experience_array as $management_experience) {
											$selected = false;
											foreach ($management_experiences['management_experience_types'] as $key1 => $experience) {
												if ($experience['management_experiences_id'] === '0') {
													$management_experience_key = $key1;
													$other_selected = true;
												}
												if ($experience['management_experiences_id'] === $management_experience['management_experience_id']) {
													$selected = true;
												}
											}
											?>
											<option <?php echo $selected ? 'selected="selected"' : ''; ?> value="<?php echo $management_experience['management_experience_id']; ?>"><?php echo $management_experience['management_experience_name']; ?></option>
										<?php } ?>
										<option value="0" <?php echo $other_selected ? 'selected="selected"' : ''; ?>>Other</option>
									</select>
								</div>
							</div>
							<div class="form-group managment_experience_type_other form-other-input" style="display:none">
								<label for="user_management_experience_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_management_experience_type_other_name" id="user_management_experience_type_other_name" class="form-control" placeholder="Other Type" value="<?php echo isset($management_experiences['management_experience_types'][$management_experience_key]['user_management_experience_type_other']['user_management_experience_type_other_name']) && $management_experiences['management_experience_types'][$management_experience_key]['user_management_experience_type_other']['user_management_experience_type_other_name'] !== '' ? $management_experiences['management_experience_types'][$management_experience_key]['user_management_experience_type_other']['user_management_experience_type_other_name'] : ''; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_company" class="col-sm-4 control-label">Organization/Company</label>
								<div class="col-sm-8">
									<input type="text" id="user_management_experience_company" class="form-control date-picker" name="user_management_experience_company" placeholder="Organization/Company" value="<?php echo $management_experiences['user_management_experience_company']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_years_experience" class="col-sm-4 control-label">Years Experience</label>
								<div class="col-sm-8">
									<input type="text" id="user_management_experience_years_experience" class="form-control date-picker" name="user_management_experience_years_experience" placeholder="Years Experience" value="<?php echo $management_experiences['user_management_experience_years_experience']; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		} else {
			?>
			<div class="">
				<div class="row">
					<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
						<h4 style="display: inline-block">Management / Corporate / Other Experience</h4> ( Please only fill out if you want to utilize these skills. )
						<div class="row">
							<div class="text-right">
								<a class="" href="javascript:;" id="show_management_exp"><i class="fa fa-plus-circle"></i> Add Management Experience</a>
							</div>
						</div>
						<div id="management_exp_div">
							<div class="form-group">
								<label for="user_management_experiences_id" class="col-sm-4 control-label">Type</label>
								<div class="col-sm-8">
									<select class="form-control select2_edit_profile other_skill_management_experience-other-select" data-placeholder="Type (may select multiple)" id="user_management_experiences_id" name="user_management_experiences_id[]" multiple="multiple">
										<?php foreach ($management_experience_array as $management_experiences) {
											?>
											<option value="<?php echo $management_experiences['management_experience_id']; ?>"><?php echo $management_experiences['management_experience_name']; ?></option>
										<?php } ?>
										<option value="0">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group management_type_other form-other-input" style="display:none">
								<label for="user_management_experience_type_other_name" class="col-sm-4 control-label">Other</label>
								<div class="col-sm-8">
									<input type="text" name="user_management_experience_type_other_name" id="user_management_experience_type_other_name" class="form-control" placeholder="Other Type"/>
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_company" class="col-sm-4 control-label">Organization/Company</label>
								<div class="col-sm-8">
									<input type="text" id="user_management_experience_company" class="form-control date-picker" name="user_management_experience_company" placeholder="Organization/Company" value="">
								</div>
							</div>
							<div class="form-group">
								<label for="user_management_experience_years_experience" class="col-sm-4 control-label">Years Experience</label>
								<div class="col-sm-8">
									<input type="text" id="user_management_experience_years_experience" class="form-control date-picker" name="user_management_experience_years_experience" placeholder="Years Experience">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<hr/>
<?php }
?>
<script>
	$(function () {
		add_other_management_skills();
		$(".other_skill_management_experience-other-select").each(function (i, v) {
			$(".other_skill_management_experience-other-select option:selected").each(function (i, v) {
				if ($(this).val() === '0') {
					$(this).closest('.form-group').next('div').show();
				}
			});
		});
		setTimeout(function () {
			$("#management_exp_div").hide();
		}, 100);
		$("#show_management_exp").click(function () {
			$(this).hide();
			$("#management_exp_div").show();
		});
	});
	function add_other_management_skills() {
		$(".other_skill_management_experience-other-select").on('change', function () {
			$(".other_skill_management_experience-other-select option").each(function () {
				if ($(this).is(':selected')) {
					if ($(this).val() === '0') {
						$(this).closest('.form-group').next('div').show();
					} else {
						$(this).closest('.form-group').next('div').hide();
					}
				} else {
					$(this).closest('.form-group').next('div').hide();
				}
			});
		});
	}
</script>