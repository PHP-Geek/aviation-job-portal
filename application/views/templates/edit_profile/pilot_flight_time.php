<div id="pilot_flight_time_div">
	<?php
	if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot') {
		if (count($pilot_flight_time_array) > 0) {
			?>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
					<h4>Flight Time</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-3">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_hours">Total Hours</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_hours" id="pilot_total_hours" placeholder="Total Hours" value="<?php echo $pilot_flight_time_array['user_flight_time_total_hour']; ?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_pic">Total PIC</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_pic" id="pilot_total_pic" placeholder="Total PIC" value="<?php echo $pilot_flight_time_array['user_flight_time_total_pic']; ?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_sic">Total SIC</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_sic" id="pilot_total_sic" placeholder="Total SIC" value="<?php echo $pilot_flight_time_array['user_flight_time_total_sic']; ?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_jet">Total Jet</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_jet" id="pilot_total_jet" placeholder="Total Jet" value="<?php echo $pilot_flight_time_array['user_flight_time_total_jet']; ?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_turboprop">Total Turboprop</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_turboprop" id="pilot_total_turboprop" placeholder="Total Turboprop" value="<?php echo $pilot_flight_time_array['user_flight_time_total_turboprop']; ?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_night">Total Night</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_night" id="pilot_total_night" placeholder="Total Night" value="<?php echo $pilot_flight_time_array['user_flight_time_total_night']; ?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_instructor">Total Instructor</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_instructor" id="pilot_total_instructor" placeholder="Total Instructor" value="<?php echo $pilot_flight_time_array['user_flight_time_total_instructor']; ?>"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr/>
		<?php } else {
			?>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
					<h4>Flight Time</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-3">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_hours">Total Hours</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_hours" id="pilot_total_hours" placeholder="Total Hours" value=""/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_pic">Total PIC</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_pic" id="pilot_total_pic" placeholder="Total PIC" value=""/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_sic">Total SIC</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_sic" id="pilot_total_sic" placeholder="Total SIC" value=""/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_jet">Total Jet</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_jet" id="pilot_total_jet" placeholder="Total Jet" value=""/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_turboprop">Total Turboprop</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_turboprop" id="pilot_total_turboprop" placeholder="Total Turboprop" value=""/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_night">Total Night</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_night" id="pilot_total_night" placeholder="Total Night" value=""/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-5 control-label" for="pilot_total_instructor">Total Instructor</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pilot_total_instructor" id="pilot_total_instructor" placeholder="Total Instructor" value=""/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<?php
		}
	}
	?>
</div>