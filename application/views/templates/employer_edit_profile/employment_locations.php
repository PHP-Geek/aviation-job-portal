<div class="row">
	<div class="col-md-7 col-lg-7 col-sm-10 col-md-offset-2 col-lg-offset-2">
		<h4>Location of Employment</h4>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-11">
				<?php foreach ($location_array as $location) { ?>
					<div class="form-group col-md-4 col-lg-4">
						<?php
						$selected = false;
						foreach ($employer_employment_location_array as $locations) {
							if ($location['location_id'] === $locations['locations_id']) {
								$selected = true;
								break;
							}
						}
						?>
						<input type="checkbox" name="employer_locations_id[]" id="employer_locations_id" value="<?php echo $location['location_id']; ?>" <?php echo $selected ? 'checked="checked"' : ''; ?>> <?php echo $location['location_name']; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<hr/>