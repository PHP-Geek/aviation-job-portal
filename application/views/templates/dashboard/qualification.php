<style>
    .employer-font{
        font-weight:500;
    }
</style>
<?php
if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot') {
	?>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>License Authority </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
				$license_array = array();
				foreach ($user_license_array as $user_license) {
					if ($user_license['license_authorities_id'] === '0') {
						$license_array[] = 'Other(' . $user_license['user_license_authority_other']['user_license_authority_other_name'] . ')';
					} else {
						if ($user_license['license_authority_name'] != '') {
							$license_array[] = $user_license['license_authority_name'];
						}
					}
				}
				echo count($license_array) > 0 ? implode(' , ', array_unique($license_array)) : '-';
				?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>License Type </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
				$license_array = array();
				foreach ($user_license_array as $user_license) {
					if ($user_license['licenses_id'] === '0') {
						$license_array[] = 'Other(' . $user_license['user_license_type_other']['user_license_type_other_name'] . ')';
					} else {
						if ($user_license['license_type'] != '') {
							$license_array[] = $user_license['license_type_name'] . ' ' . $user_license['license_type'];
						}
					}
				}
				echo count($license_array) > 0 ? implode(' , ', array_unique($license_array)) : '-';
				?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Total Hours </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php echo $user_details_array['user_total_hours'] != '' ? $user_details_array['user_total_hours'] : '-';
				?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Current Aircraft Rating </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
				$aircraft_rating_array = array();
				foreach ($user_aircraft_rating_array as $user_aircraft_rating) {
					if ($user_aircraft_rating['my_aircrafts_id'] === '0') {
						$aircraft_rating_array[] = 'Other(' . $user_aircraft_rating['user_aircraft_type_other']['user_aircraft_rating_aircraft_type_other_name'] . ')';
					} else {
						if ($user_aircraft_rating['my_aircraft_name'] != '') {
							$aircraft_rating_array[] = $user_aircraft_rating['my_aircraft_category'] !== '' ? $user_aircraft_rating['my_aircraft_category'] . ' ' . $user_aircraft_rating['my_aircraft_name'] : $user_aircraft_rating['my_aircraft_name'];
						}
					}
				}
				echo count($aircraft_rating_array) > 0 ? implode(' , ', array_unique($aircraft_rating_array)) : '-';
				?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Hours on Type </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
				$aircraft_rating_array = array();
				$string = '';
				foreach ($user_aircraft_rating_array as $user_aircraft_rating) {
					$string = array();
					if ($user_aircraft_rating['user_aircraft_rating_total_hours'] != '') {
						$string[] = ' Hours : ' . $user_aircraft_rating['user_aircraft_rating_total_hours'];
					}
					if ($user_aircraft_rating['user_aircraft_rating_pic_hours'] != '') {
						$string[] = ' PIC : ' . $user_aircraft_rating['user_aircraft_rating_pic_hours'];
					}
					if ($user_aircraft_rating['user_aircraft_rating_sic_hours'] != '') {
						$string[] = ' SIC : ' . $user_aircraft_rating['user_aircraft_rating_sic_hours'];
					}
				}if (count($string) > 0) {
					echo implode(' | ', $string);
				} else {
					echo '-';
				}
				?>
			</p>
		</div>
	</div>
	<?php
}
if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer') {
	?>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>License Authority </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
	$license_array = array();
	foreach ($user_license_array as $key => $user_license) {
		if ($user_license['license_authorities_id'] === '0') {
			$license_array[] = 'Other(' . $user_license['user_license_authority_other']['user_license_authority_other_name'] . ')';
		} else {
			if ($user_license['license_authority_name'] != '') {
				$license_array[] = $user_license['license_authority_name'];
			}
		}
	}
	echo count($license_array) > 0 ? implode(' , ', array_unique($license_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>License Type </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
			$license_array = array();
			foreach ($user_license_array as $user_license) {
				if ($user_license['licenses_id'] === '0') {
					$license_array[] = 'Other(' . $user_license['user_license_type_other']['user_license_type_other_name'] . ')';
				} else {
					if ($user_license['license_type'] != '') {
						$license_array[] = $user_license['license_type_name'] . ' ' . $user_license['license_type'];
					}
				}
			}
			echo count($license_array) > 0 ? implode(' , ', array_unique($license_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Aircraft Rating </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
			$aircraft_rating_array = array();
			foreach ($user_aircraft_rating_array as $user_aircraft_rating) {
				if ($user_aircraft_rating['type_ratings_id'] === '0') {
					$aircraft_rating_array[] = 'Other(' . $user_aircraft_rating['user_aircraft_rating_type_rating_other']['user_aircraft_rating_type_rating_other_name'] . ')';
				} else {
					if ($user_aircraft_rating['type_rating_name'] != '') {
						$aircraft_rating_array[] = $user_aircraft_rating['type_rating_name'];
					}
				}
			}
			echo count($aircraft_rating_array) > 0 ? implode(' , ', array_unique($aircraft_rating_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Coverage </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
			$aircraft_rating_array = array();
			foreach ($user_aircraft_rating_array as $user_aircraft_rating) {
				foreach ($user_aircraft_rating['user_aircraft_rating_coverages'] as $coverage) {
					if ($coverage['user_aircraft_rating_coverage_name'] != '') {
						$aircraft_rating_array[] = $coverage['user_aircraft_rating_coverage_name'];
					}
				}
			}
			echo count($aircraft_rating_array) > 0 ? implode(' , ', array_unique($aircraft_rating_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Years Experience </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
			$year_of_experience = 0;
			foreach ($user_aircraft_rating_array as $user_aircraft_rating) {
				if ($user_aircraft_rating['user_aircraft_rating_year_of_experience'] > $year_of_experience) {
					$year_of_experience = $user_aircraft_rating['user_aircraft_rating_year_of_experience'];
				}
			}
			echo $year_of_experience !== 0 ? $year_of_experience : '-';
	?></p>
		</div>
	</div>
	<?php
}
if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'flight-attendant' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'operations') {
	?>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Years of Experience </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php echo $user_details_array['user_years_of_experience'] != '' ? $user_details_array['user_years_of_experience'] : '-';
	?></p>
		</div>
	</div>
	<?php if ($user_details_array['job_type_slug'] === 'flight-attendant') { ?>
		<div class = "row">
			<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
				<div class="dashboard-title">
					<p class = "text-left"><strong>Area Experience </strong></p>
				</div>
			</div>
			<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
				<p><?php
		$location_array = array();
		foreach ($user_experience_array as $locations) {
			$location_array[] = $locations['location_name'];
		}
		echo count($location_array) > 0 ? implode(' , ', $location_array) : '-';
		?></p>
			</div>
		</div>
	<?php } else { ?>
		<div class = "row">
			<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
				<div class="dashboard-title">
					<p class = "text-left"><strong>Countries of Experience </strong></p>
				</div>
			</div>
			<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
				<p><?php
		$country_experience_array = array();
		foreach ($user_countries_of_experience_array as $countries) {
			$country_experience_array[] = $countries['country_name'];
		}
		echo count($country_experience_array) > 0 ? implode(' , ', $country_experience_array) : '-';
		?></p>
			</div>
		</div>
	<?php } ?>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Skills </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
	$skill_array = array();
	foreach ($user_skill_array as $user_skill) {
		if ($user_skill['skills_id'] === '0') {
			$skill_array[] = 'Other(' . $user_skill['user_skill_other']['user_skill_other_name'] . ')';
		} else {
			if ($user_skill['skill_name'] != '') {
				$skill_array[] = $user_skill['skill_name'];
			}
		}
	}
	echo count($skill_array) > 0 ? implode(' , ', array_unique($skill_array)) : '-';
	?></p>
		</div>
	</div>
	<?php
}
//Air traffic controller qualifications
if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'air-traffic-controller') {
	?>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>License Authority </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
	$license_array = array();
	foreach ($user_license_array as $user_license) {
		if ($user_license['license_authorities_id'] === '0') {
			$license_array[] = 'Other(' . $user_license['user_license_authority_other']['user_license_authority_other_name'] . ')';
		} else {
			if ($user_license['license_authority_name'] != '') {
				$license_array[] = $user_license['license_authority_name'];
			}
		}
	}
	echo count($license_array) > 0 ? implode(' , ', array_unique($license_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Ratings </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php
			$rating_array = array();
			foreach ($user_rating_array as $user_rating) {
				if ($user_rating['type_ratings_id'] === '0') {
					$rating_array[] = 'Other(' . $user_rating['user_type_rating_other']['user_rating_other_name'] . ')';
				} else {
					if ($user_rating['type_rating_name'] != '') {
						$rating_array[] = $user_rating['type_rating_name'];
					}
				}
			}
			echo count($rating_array) > 0 ? implode(' , ', array_unique($rating_array)) : '-';
	?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Endorsements </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php echo $user_details_array['user_endorsement'] != '' ? $user_details_array['user_endorsement'] === 'Other' ? 'Other(' . $user_details_array['user_endorsement_other'] . ')' : $user_details_array['user_endorsement'] : '-';
			?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Location/Airport/Area/Unit </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php echo $user_details_array['user_airport_area'] != '' ? $user_details_array['user_airport_area'] : '-';
			?></p>
		</div>
	</div>
	<div class = "row">
		<div class = "col-xs-6 col-sm-6 col-md-7 col-lg-7">
			<div class="dashboard-title">
				<p class = "text-left"><strong>Years of Experience    </strong></p>
			</div>
		</div>
		<div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
			<p><?php echo $user_details_array['user_years_of_experience'] ? $user_details_array['user_years_of_experience'] : '-';
			?></p>
		</div>
	</div>
<?php } ?>