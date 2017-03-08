<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Configuration_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add_license($license_insert_array) {
		return $this->db->insert('licenses', $license_insert_array);
	}

	function add_license_type($license_type_insert_array) {
		return $this->db->insert('license_types', $license_type_insert_array);
	}

	function get_license_types() {
		return $this->db->where('license_type_status', '1')->get('license_types')->result_array();
	}

	function edit_license_by_id($license_id, $license_update_array) {
		return $this->db->update('licenses', $license_update_array, array('license_id' => $license_id));
	}

	function add_country($counrty_insert_array) {
		return $this->db->insert('countries', $counrty_insert_array);
	}

	function edit_country_by_id($country_id, $country_update_array) {
		return $this->db->update('countries', $country_update_array, array('country_id' => $country_id));
	}

	function edit_location_by_id($location_id, $location_update_array) {
		return $this->db->update('locations', $location_update_array, array('location_id' => $location_id));
	}

	function add_location($location_insert_array) {
		return $this->db->insert('locations', $location_insert_array);
	}

	function get_country_by_id($country_id) {
		return $this->db->where('country_id', $country_id)->get('countries')->row_array();
	}

	function add_employer_type($employer_type_array) {
		return $this->db->insert('employer_types', $employer_type_array);
	}

	function edit_employer_type_by_id($employer_type_id, $employer_type_array) {
		return $this->db->update('employer_types', $employer_type_array, array('employer_type_id' => $employer_type_id));
	}

	function add_job_type($job_type_array) {
		return $this->db->insert('job_types', $job_type_array);
	}

	function get_job_type_by_id($job_type_id) {
		return $this->db->where('job_type_id', $job_type_id)->get('job_types')->row_array();
	}

	function edit_job_type_by_id($job_type_id, $job_type_array) {
		return $this->db->update('job_types', $job_type_array, array('job_type_id' => $job_type_id));
	}

	function add_my_aircraft($aircraft_array) {
		return $this->db->insert('my_aircrafts', $aircraft_array);
	}

	function edit_my_aircraft_by_id($aircraft_id, $aircraft_array) {
		return $this->db->update('my_aircrafts', $aircraft_array, array('my_aircraft_id' => $aircraft_id));
	}

	function add_training($training_array) {
		return $this->db->insert('trainings', $training_array);
	}

	function edit_training_by_id($training_id, $training_update_array) {
		return $this->db->update('trainings', $training_update_array, array('training_id' => $training_id));
	}

	function edit_employee_role_by_id($employee_role_id, $employee_role_array) {
		return $this->db->update('employee_roles', $employee_role_array, array('employee_role_id' => $employee_role_id));
	}

	function add_employee_role($employee_role_array) {
		return $this->db->insert('employee_roles', $employee_role_array);
	}

	function add_type_rating($type_rating_array) {
		return $this->db->insert('type_ratings', $type_rating_array);
	}

	function edit_type_rating_by_id($type_rating_id, $type_rating_array) {
		return $this->db->update('type_ratings', $type_rating_array, array('type_rating_id' => $type_rating_id));
	}

	function get_configuration_by_id($configuration_id) {
		$this->db->where('configuration_status', '1');
		return $this->db->where('configuration_id', $configuration_id)->get('configurations')->row_array();
	}

	function edit_configuration_by_id($congiruation_id, $configuration_array) {
		return $this->db->update('configurations', $configuration_array, array('configuration_id' => $congiruation_id));
	}

	function get_type_ratings() {
		return $this->db->where('type_rating_status', '1')->get('type_ratings')->result_array();
	}

	function edit_license_authority_by_id($license_authority_id, $license_authority_array) {
		return $this->db->update('license_authorities', $license_authority_array, array('license_authority_id' => $license_authority_id));
	}

	function add_license_authority($license_authority_array) {
		return $this->db->insert('license_authorities', $license_authority_array);
	}

	function add_position($position_array) {
		return $this->db->insert('positions', $position_array);
	}

	function edit_position_by_id($position_id, $position_array) {
		return $this->db->update('positions', $position_array, array('position_id' => $position_id));
	}

	function edit_skill_by_id($skill_id, $skill_array) {
		return $this->db->update('skills', $skill_array, array('skill_id' => $skill_id));
	}

	function add_skill($skill_array) {
		return $this->db->insert('skills', $skill_array);
	}

	function add_management_experience($managment_experience_array) {
		return $this->db->insert('management_experiences', $managment_experience_array);
	}

	function edit_management_experience_by_id($management_experience_id, $management_experience_array) {
		return $this->db->update('management_experiences', $management_experience_array, array('management_experience_id' => $management_experience_id));
	}

	function edit_approval_rating_by_id($approval_rating_id, $approval_rating_array) {
		return $this->db->update('approval_ratings', $approval_rating_array, array('approval_rating_id' => $approval_rating_id));
	}

	function add_approval_rating($approval_rating_array) {
		return $this->db->insert('approval_ratings', $approval_rating_array);
	}

	function edit_charter_aircraft_by_id($charter_aircraft_id, $charter_aircraft_array) {
		return $this->db->update('charter_aircrafts', $charter_aircraft_array, array('charter_aircraft_id' => $charter_aircraft_id));
	}

	function add_charter_aircraft($charter_aircraft_array) {
		return $this->db->insert('charter_aircrafts', $charter_aircraft_array);
	}

}

?>
