<style>
	.checkbox-space-left{
		margin:0px 19px;
	}
</style>
<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
		<h4>Notification Settings</h4>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-11">
				<div class="form-group">
					<?php
					$val1 = '';
					$val2 = '';
					$val3 = '';
					foreach ($user_notification_array as $user_notification) {
						if ($user_notification['user_notification_type'] === '1') {
							$val1 = 'checked="checked"';
						}if ($user_notification['user_notification_type'] === '2') {
							$val2 = 'checked="checked"';
						}if ($user_notification['user_notification_type'] === '3') {
							$val3 = 'checked="checked"';
						}
					}
					?>
					<div class="checkbox checkbox-space-left">
						<label>
							<input type="checkbox" name="user_notification_type[]" id="user_job_notification" value="1" <?php echo $val1; ?>> Job Applications
						</label>
					</div>
					<div class="checkbox checkbox-space-left">
						<label>
							<input type="checkbox" name="user_notification_type[]" id="user_job_notification" value="2" <?php echo $val2; ?>> InCrew Communications
						</label>
					</div>
					<div class="checkbox checkbox-space-left">	
						<label>
							<input type="checkbox" name="user_notification_type[]" id="user_job_notification" value="3" <?php echo $val3; ?>> 3rd Party Marketing
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>