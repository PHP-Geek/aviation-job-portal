<div class="row">    
	<div class="col-md-12  col-lg-12">
		<div class="well-white">
			<h4>Background Check</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3"><label>
									Any accident or incidents: </label></div>
							<div class="col-sm-9"><?php echo $user_details_array['user_accident_case_description'] !== '' ? $user_details_array['user_accident_case_description'] : 'n/a'; ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3"><label>
									Any Criminal History: </label></div>
							<div class="col-sm-9"><?php echo $user_details_array['user_criminal_case_description'] !== '' ? $user_details_array['user_criminal_case_description'] : 'n/a'; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">    
	<div class="col-md-12 col-lg-12">
		<div class="well-white">
            <h4>References</h4>
			<div class="row">
				<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
					<?php
					if (count($user_reference_array) > 0) {
						foreach ($user_reference_array as $key => $user_reference) {
							?>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Name : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_reference['user_reference_name']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Company: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php
												echo $user_reference['user_reference_company'];
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Position : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_reference['positions_id'] === '0' ? 'Other(' . $user_reference['user_reference_position_other']['user_reference_position_other_name'] . ')' : $user_reference['position_name']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Relationship : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_reference['user_reference_relation']; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Email : </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php echo $user_reference['user_reference_email']; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-6">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<label>Contact Number: </label>
											</div>
											<div class="col-md-6 col-sm-6">
												<?php
												echo $user_reference['user_reference_country_code'] . ' - ' . $user_reference['user_reference_contact_number'];
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if ($key !== count($user_reference_array) - 1) { ?>
								<hr/>
								<?php
							}
						}
					} else {
						?>
						<span>No Reference.</span>
					<?php }
					?>
				</div>
			</div>
        </div>
    </div>

</div>