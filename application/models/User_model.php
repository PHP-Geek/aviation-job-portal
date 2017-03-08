<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($user_insert_array) {
		if ($this->db->insert('users', $user_insert_array)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_user_by_id($user_id) {
		$this->db->join('operation_types', 'operation_types.operation_type_id=users.operation_types_id', 'left');
		$this->db->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->db->join('countries as c', 'c.country_id=users.user_countries_of_experience', 'left');
		$this->db->join('countries as rc', 'rc.country_id = users.user_registered_countries_id', 'left');
		$this->db->join('groups', 'groups.group_id = users.groups_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=users.job_types_id', 'left');
		$this->db->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->db->join('type_ratings', 'type_ratings.type_rating_id=users.type_ratings_id', 'left');
		$this->db->join('licenses', 'licenses.license_id=users.licenses_id', 'left');
		$this->db->join('employee_roles', 'employee_roles.employee_role_id=users.employee_roles_id', 'left');
		$this->db->join('positions', 'positions.position_id = users.positions_id', 'left');
		$this->db->select('users.*,rc.country_name AS user_registered_country_name,c.country_name as country_experience,countries.*,groups.*,job_types.*,employer_types.*,licenses.*,type_ratings.*,employee_roles.*,positions.*,operation_types.operation_type');
		return $this->db->get_where('users', array('user_id' => $user_id))->row_array();
	}

	function get_active_user_by_id_and_security_hash($user_id, $user_security_hash) {
		$this->db->join('groups', 'groups.group_id = users.groups_id', 'left');
		return $this->db->get_where('users', array('user_id' => $user_id, 'user_security_hash' => $user_security_hash, 'user_status' => '1'))->row_array();
	}

	function edit_user_by_user_id($user_id, $user_details_array) {
		return $this->db->where('user_id', $user_id)->update('users', $user_details_array);
	}

	function delete_user_by_user_id($user_id) {
		return $this->db->delete('users', array('user_id' => $user_id));
	}

	function get_all_users() {
		return $this->db->get_where('users', array('groups_id' => 3))->result_array();
	}

	function get_user_licenses_by_user_id($user_id, $is_other = '', $category = '0') {
		$this->db->join('license_authorities', 'license_authorities.license_authority_id=user_licenses.license_authorities_id', 'left');
		$this->db->join('licenses', 'licenses.license_id = user_licenses.licenses_id', 'left');
		$this->db->join('license_types', 'license_types.license_type_id = licenses.license_types_id', 'left');
		$this->db->join('approval_ratings', 'approval_ratings.approval_rating_id=user_licenses.approval_ratings_id', 'left');
		$this->db->where('user_license_is_other', $is_other);
		$this->db->where('user_license_category', $category);
		return $this->db->where(array('users_id' => $user_id, 'user_license_status' => '1'))->get('user_licenses')->result_array();
	}

	function get_user_license_position_by_user_license_id($user_license_id) {
		$this->db->join('positions', 'positions.position_id=user_license_positions.positions_id', 'left');
		return $this->db->where('user_licenses_id', $user_license_id)->get('user_license_positions')->result_array();
	}

	function add_user_licenses($user_license_insert_array) {
		if ($this->db->insert('user_licenses', $user_license_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_user_license_authority_by_user_id($user_id) {
		$this->db->join('license_authorities', 'license_authorities.license_authority_id = user_license_authorities.license_authorities_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_license_authority_status' => '1'))->get('user_license_authorities')->result_array();
	}

	function add_user_license($user_license_insert_array) {
		if ($this->db->insert('user_licenses', $user_license_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function add_user_license_positions($user_license_position_array) {
		if ($this->db->insert('user_license_positions', $user_license_position_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function edit_user_license_by_user_id($user_id, $user_license_update_array, $is_other = '', $category = '0') {
		return $this->db->update('user_licenses', $user_license_update_array, array('users_id' => $user_id, 'user_license_is_other' => $is_other, 'user_license_category' => $category));
	}

	function get_user_validations_by_user_id($user_id) {
		$this->db->join('countries', 'countries.country_id=user_validations.countries_id', 'left');
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=user_validations.my_aircrafts_id', 'left');
		$this->db->join('licenses', 'licenses.license_id=user_validations.licenses_id', 'left');
		$this->db->join('license_types', 'license_types.license_type_id=licenses.license_types_id', 'left');
		return $this->db->where(array('user_validation_status' => '1', 'users_id' => $user_id))->get('user_validations')->result_array();
	}

	function add_user_validation($user_validation_array) {
		if ($this->db->insert('user_validations', $user_validation_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function edit_user_validation_by_user_id($user_id, $user_validation_update_array) {
		return $this->db->update('user_validations', $user_validation_update_array, array('users_id' => $user_id));
	}

	function get_user_visas_by_user_id($user_id) {
		$this->db->join('countries', 'countries.country_id=user_visas.countries_id', 'left');
		return $this->db->where(array('user_visa_status' => '1', 'users_id' => $user_id))->get('user_visas')->result_array();
	}

	function add_user_visa($user_visa_insert_array) {
		return $this->db->insert_batch('user_visas', $user_visa_insert_array);
	}

	function edit_user_visa_by_user_id($user_id, $user_visa_update_array) {
		return $this->db->update('user_visas', $user_visa_update_array, array('users_id' => $user_id));
	}

	function get_user_passports_by_user_id($user_id) {
		$this->db->join('countries', 'countries.country_id=user_passports.countries_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_passport_status' => '1'))->get('user_passports')->result_array();
	}

	function add_user_passport($passport_insert_array) {
		return $this->db->insert_batch('user_passports', $passport_insert_array);
	}

	function edit_user_passport_by_user_id($user_id, $user_passport_update_array) {
		return $this->db->update('user_passports', $user_passport_update_array, array('users_id' => $user_id));
	}

	function get_user_previous_employments_by_user_id($user_id) {
		$this->db->join('positions', 'positions.position_id=user_previous_employments.positions_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_previous_employment_status' => '1'))->get('user_previous_employments')->result_array();
	}

	function add_user_previous_employment($user_previous_employment_array) {
		if ($this->db->insert('user_previous_employments', $user_previous_employment_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function edit_user_previous_employment_by_user_id($user_id, $user_previous_employment_update_array) {
		return $this->db->update('user_previous_employments', $user_previous_employment_update_array, array('users_id' => $user_id));
	}

	function get_user_type_ratings_by_user_id($user_id) {
		$this->db->join('models', 'user_type_ratings.models_id=models.model_id', 'left');
		return $this->db->where(array('user_type_rating_status' => '1', 'users_id' => $user_id))->get('user_type_ratings')->result_array();
	}

	function add_user_type_rating($user_type_rating_insert_array) {
		return $this->db->insert_batch('user_type_ratings', $user_type_rating_insert_array);
	}

	function edit_user_type_rating_by_user_id($user_id, $user_type_rating_update_array) {
		return $this->db->update('user_type_ratings', $user_type_rating_update_array, array('users_id' => $user_id));
	}

	function get_user_employment_by_user_id($user_id) {
		return $this->db->where(array('user_employment_status' => '1', 'users_id' => $user_id))->get('user_employments')->result_array();
	}

	function add_user_employment($user_employment_insert_array) {
		if ($this->db->insert('user_employments', $user_employment_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_user_employment_location($user_employment_location_insert_array) {
		return $this->db->insert('user_employment_locations', $user_employment_location_insert_array);
	}

	function edit_user_employment_by_user_id($user_id, $user_employment_update_array) {
		return $this->db->update('user_employments', $user_employment_update_array, array('users_id' => $user_id));
	}

	function get_user_employment_location_by_user_employment_id($user_employment_id) {
		$this->db->join('countries', 'user_employment_locations.countries_id=countries.country_id', 'left');
		return $this->db->where('user_employments_id', $user_employment_id)->get('user_employment_locations')->result_array();
	}

	function get_user_employment_position_by_user_employment_id($user_employment_id) {
		$this->db->join('positions', 'user_employment_positions.positions_id=positions.position_id', 'left');
		return $this->db->where('user_employments_id', $user_employment_id)->get('user_employment_positions')->result_array();
	}

	function get_user_training_by_user_id($user_id) {
		$this->db->join('trainings', 'trainings.training_id=user_trainings.trainings_id', 'left');
		return $this->db->where(array('user_training_status' => '1', 'users_id' => $user_id))->get('user_trainings')->result_array();
	}

	function add_user_training($user_training_insert_array) {
		if ($this->db->insert('user_trainings', $user_training_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function edit_user_training_by_user_id($user_id, $user_training_update_array) {
		return $this->db->update('user_trainings', $user_training_update_array, array('users_id' => $user_id));
	}

	function get_user_medical_certificate_by_user_id($user_id, $is_other = '') {
		$this->db->join('license_authorities', 'license_authorities.license_authority_id=user_medical_certificates.license_authorities_id', 'left');
		if ($is_other !== '') {
			$this->db->where('user_medical_certificate_is_other', $is_other);
		}
		return $this->db->where(array('user_medical_certificate_status' => '1', 'users_id' => $user_id))->get('user_medical_certificates')->result_array();
	}

	function add_user_medical_certificate($user_medical_certificate_insert_array) {
		if ($this->db->insert('user_medical_certificates', $user_medical_certificate_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function edit_user_medical_certificate_by_user_id($user_id, $user_medical_certificate_update_array, $is_other = '') {
		return $this->db->update('user_medical_certificates', $user_medical_certificate_update_array, array('users_id' => $user_id, 'user_medical_certificate_is_other' => $is_other));
	}

	function get_medical_examinations() {
		return $this->db->where('medical_examination_status', '1')->get('medical_examinations')->result_array();
	}

	function get_user_experience_by_user_id($user_id, $is_other = '') {
		$this->db->join('locations', 'locations.location_id=user_experiences.locations_id', 'left');
		$this->db->join('countries', 'countries.country_id=user_experiences.countries_id', 'left');
		if ($is_other !== '') {
			$this->db->where('user_experience_is_other', $is_other);
		}
		return $this->db->where(array('user_experience_status' => '1', 'users_id' => $user_id))->get('user_experiences')->result_array();
	}

	function add_user_experience($user_experience_insert_array) {
		return $this->db->insert('user_experiences', $user_experience_insert_array);
	}

	function edit_user_experience_by_user_id($user_id, $user_experience_update_array, $is_other = '') {
		return $this->db->update('user_experiences', $user_experience_update_array, array('users_id' => $user_id, 'user_experience_is_other' => $is_other));
	}

	function add_user_area_experience($area_experience_array) {
		return $this->db->insert('user_area_experiences', $area_experience_array);
	}

	function edit_user_area_experience_by_user_id($user_id, $area_experience_array) {
		return $this->db->update('user_area_experiences', $area_experience_array, array('users_id' => $user_id));
	}

	function get_user_area_experience_by_user_id($user_id) {
		return $this->db->where(array('users_id' => $user_id, 'user_area_experience_status' => '1'))->get('user_area_experiences')->result_array();
	}

	function get_trainings() {
		return $this->db->where('training_status', '1')->get('trainings')->result_array();
	}

	function get_employer_employment_location_by_user_id($user_id) {
		$this->db->join('locations', 'employer_employment_locations.locations_id=locations.location_id');
		return $this->db->where(array('users_id' => $user_id, 'employer_employment_location_status' => '1'))->get('employer_employment_locations')->result_array();
	}

	function add_employer_employment_location($employer_employment_location_insert_array) {
		return $this->db->insert('employer_employment_locations', $employer_employment_location_insert_array);
	}

	function edit_employer_employment_location_by_user_id($user_id, $employer_employment_location_update_array) {
		return $this->db->update('employer_employment_locations', $employer_employment_location_update_array, array('users_id' => $user_id));
	}

	function add_user_notification($user_notification_insert_array) {
		return $this->db->insert('user_notifications', $user_notification_insert_array);
	}

	function get_user_notification_by_user_id($user_id) {
		return $this->db->where(array('users_id' => $user_id, 'user_notification_status' => '1'))->get('user_notifications')->result_array();
	}

	function edit_user_notification_by_user_id($user_id, $user_notification_update_array) {
		return $this->db->update('user_notifications', $user_notification_update_array, array('users_id' => $user_id));
	}

	function get_user_employee_base_by_user_id($user_id) {
		return $this->db->where(array('users_id' => $user_id, 'user_employee_base_status' => '1'))->get('user_employee_bases')->result_array();
	}

	function edit_user_employee_base_by_user_id($user_id, $employee_base_update_array) {
		return $this->db->update('user_employee_bases', $employee_base_update_array, array('users_id' => $user_id));
	}

	function add_user_employee_base($employee_base_insert_array) {
		return $this->db->insert('user_employee_bases', $employee_base_insert_array);
	}

	function add_user_aircraft($aircraft_type_insert_array) {
		if ($this->db->insert('user_aircrafts', $aircraft_type_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_user_aircraft_other($user_aircraft_other) {
		return $this->db->insert('user_aircraft_others', $user_aircraft_other);
	}

	function get_user_aircraft_other_by_user_aircraft_id($user_aircraft_id) {
		return $this->db->where('user_aircrafts_id', $user_aircraft_id)->get('user_aircraft_others')->row_array();
	}

	function get_user_aircraft_by_user_id($user_id) {
		$this->db->join('my_aircrafts', 'user_aircrafts.my_aircrafts_id=my_aircrafts.my_aircraft_id', 'left');
		return $this->db->where(array('user_aircraft_status' => '1', 'users_id' => $user_id))->get('user_aircrafts')->result_array();
	}

	function edit_user_aircraft_by_user_id($user_id, $aircraft_type_update_array) {
		return $this->db->update('user_aircrafts', $aircraft_type_update_array, array('users_id' => $user_id));
	}

	function get_operation_type_by_employer_type_id($employer_type_id) {
		if ($employer_type_id === '5') {
			$employer_type_id = '3';
		}
		return $this->db->where(array('operation_type_status' => '1', 'employer_types_id' => $employer_type_id))->get('operation_types')->result_array();
	}

	function get_user_operation_type_by_user_id($user_id) {
		$this->db->join('operation_types', 'operation_types.operation_type_id = user_operation_types.operation_types_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_operation_type_status' => '1'))->get('user_operation_types')->result_array();
	}

	function edit_user_operation_type_by_user_id($user_id, $operation_type_array) {
		return $this->db->update('user_operation_types', $operation_type_array, array('users_id' => $user_id));
	}

	function add_user_operation_type($operation_type_array) {
		if ($this->db->insert('user_operation_types', $operation_type_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_user_operation_other_type($operation_type_other_array) {
		return $this->db->insert('user_operation_type_others', $operation_type_other_array);
	}

	function get_user_operation_other_type_by_user_operation_type_id($operation_type_id) {
		return $this->db->where('user_operation_types_id', $operation_type_id)->get('user_operation_type_others')->row_array();
	}

	function add_user_company($user_recruitment_company_insert_array) {
		if ($this->db->insert('user_companies', $user_recruitment_company_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function edit_user_company_by_user_id($user_id, $user_recruitment_company_array) {
		return $this->db->update('user_companies', $user_recruitment_company_array, array('users_id' => $user_id));
	}

	function get_user_company_by_user_id($user_id) {
		return $this->db->where(array('	user_company_status' => '1', 'users_id' => $user_id))->get('user_companies')->result_array();
	}

	function add_user_company_base($user_company_base_array) {
		return $this->db->insert('user_company_bases', $user_company_base_array);
	}

	function get_user_company_base_by_user_company_id($user_company_id) {
		return $this->db->where('user_companies_id', $user_company_id)->get('user_company_bases')->result_array();
	}

	function get_active_licenses() {
		return $this->db->where('license_status', '1')->get('licenses')->result_array();
	}

	function get_active_type_ratings_by_job_type_id($job_type_id) {
		return $this->db->where(array('type_rating_status' => '1', 'job_types_id' => $job_type_id))->get('type_ratings')->result_array();
	}

	function get_active_type_ratings() {
		return $this->db->where(array('type_rating_status' => '1'))->get('type_ratings')->result_array();
	}

	function get_active_locations() {
		return $this->db->where('location_status', '1')->get('locations')->result_array();
	}

	function get_employee_roles_by_job_type_id($job_type_id) {
		return $this->db->where(array('employee_role_status' => '1', 'job_types_id' => $job_type_id))->get('employee_roles')->result_array();
	}

	function add_user_aircraft_experience($user_aircraft_experience_array) {
		if ($this->db->insert('user_aircraft_experiences', $user_aircraft_experience_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function edit_user_aircraft_experience_by_user_id($user_id, $user_aircraft_experience_array) {
		return $this->db->update('user_aircraft_experiences', $user_aircraft_experience_array, array('users_id' => $user_id));
	}

	function get_user_aircraft_experience_by_user_id($user_id) {
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id = user_aircraft_experiences.my_aircrafts_id', 'left');
		return $this->db->where(array('user_aircraft_experience_status' => '1', 'users_id' => $user_id))->get('user_aircraft_experiences')->result_array();
	}

	function get_user_management_experience_by_user_id($user_id) {
		return $this->db->where(array('user_management_experience_status' => '1', 'users_id' => $user_id))->get('user_management_experiences')->result_array();
	}

	function add_user_management_experience($management_experience_array) {
		return $this->db->insert_batch('user_management_experiences', $management_experience_array);
	}

	function edit_user_management_experience_by_user_id($user_id, $management_experience_array) {
		return $this->db->update('user_management_experiences', $management_experience_array, array('users_id' => $user_id));
	}

	function search($search_term = '', $license_type = '', $type_rating = '', $training = '', $medical = '', $experience = '', $location = '', $job_type_name = '', $employee_role_name = '', $user_hours = '', $contact = '', $email = '', $user_rating = '', $passport = '', $visa = '', $validation = '', $operation_type = '', $total_instructor = '', $total_hours_condition = '', $user_total_hours = '') {
		$query = "SELECT *from users LEFT JOIN countries ON users.countries_id = countries.country_id LEFT JOIN job_types ON job_types.job_type_id = users.job_types_id LEFT JOIN type_ratings ON users.type_ratings_id = type_ratings.type_rating_id LEFT JOIN user_licenses ON user_licenses.users_id = users.user_id LEFT JOIN licenses ON licenses.license_id = user_licenses.licenses_id LEFT JOIN user_trainings ON user_trainings.users_id = users.user_id LEFT JOIN trainings ON trainings.training_id = user_trainings.trainings_id LEFT JOIN user_type_ratings ON user_type_ratings.users_id = users.user_id LEFT JOIN employer_types ON users.employer_types_id = employer_types.employer_type_id LEFT JOIN user_medical_certificate_certificates ON users.user_id=user_medical_certificate_certificates.users_id LEFT JOIN groups ON users.groups_id=groups.group_id LEFT JOIN employee_roles ON users.employee_roles_id=employee_roles.employee_role_id LEFT JOIN user_passports ON user_passports.countries_id=countries.country_id LEFT JOIN operation_types ON users.operation_types_id=operation_types.operation_type_id LEFT JOIN user_visas ON user_visas.countries_id=countries.country_id LEFT JOIN medical_examinations ON medical_examinations.medical_examination_id=user_medical_certificate_certificates.medical_examinations_id ";
		$query.=" WHERE ";
		if ($license_type !== '') {
			$query.="licenses.license_type LIKE '%" . $license_type . "%' AND user_licenses.user_license_status = '1' AND ";
		}
		if ($training !== '') {
			$query.="trainings.training_name LIKE '%" . $training . "%' AND user_trainings.user_training_status = '1' AND ";
		}

		if ($type_rating !== '') {
			$query.="type_ratings.type_rating_name LIKE '%" . $type_rating . "%' AND user_type_ratings.user_type_rating_status = '1' AND ";
		}
		if ($medical !== '') {
			$query.="medical_examinations.medical_examination_name LIKE '%" . $medical . "%' AND user_medical_certificate_certificates.user_medical_certificate_status = '1' AND ";
		}
		if ($experience !== '') {
			$query.="users.user_years_of_experience = '" . $experience . "' AND ";
		}
		if ($location !== '') {
			$query.="countries.country_name LIKE '%" . $location . "%' AND users.countries_id=countries.country_id AND countries.country_status = '1' AND ";
		}
		if ($job_type_name !== '') {
			$query.="job_types.job_type_name LIKE '%" . $job_type_name . "%' AND job_types.job_type_status = '1' AND ";
		}
		if ($employee_role_name !== '') {
			$query.="employee_roles.employee_role_name LIKE '%" . $employee_role_name . "%' AND employee_roles.employee_role_status = '1' AND ";
		}
		if ($user_hours !== '') {
			$query.="users.user_hours_type_rating = '" . $user_hours . "' AND ";
		}
		if ($total_instructor !== '') {
			$query.="users.user_total_instructor = '" . $total_instructor . "' AND ";
		}
		if ($contact !== '') {
			$query.="users.user_primary_contact = '" . $contact . "' AND ";
		}
		if ($email !== '') {
			$query.="users.user_email = '" . $email . "' AND ";
		}
		if ($user_rating !== '') {
			$query.="users.user_rating = '" . $user_rating . "' AND ";
		}
		if ($passport !== '') {
			$counter = 1;
			if (count($this->get_users_id_by_search_name($passport, 'passport'))) {
				foreach ($this->get_users_id_by_search_name($passport, 'passport') as $user) {
					if ($counter == 1) {
						$query.="(";
					}
					$query.="users.user_id='" . $user['users_id'] . "'";
					if (count($this->get_users_id_by_search_name($passport, 'passport')) > $counter) {
						$query.=" OR ";
					}
					if (count($this->get_users_id_by_search_name($passport, 'passport')) == $counter) {
						$query.=") AND ";
					}
					$counter++;
				}
			} else {
				$query.="users.user_id='0' AND ";
			}
		}
		if ($visa !== '') {
			$counter = 1;
			if (count($this->get_users_id_by_search_name($visa, 'visa'))) {
				foreach ($this->get_users_id_by_search_name($visa, 'visa') as $user) {
					if ($counter == 1) {
						$query.="(";
					}
					$query.="users.user_id='" . $user['users_id'] . "'";
					if (count($this->get_users_id_by_search_name($visa, 'visa')) > $counter) {
						$query.=" OR ";
					}
					if (count($this->get_users_id_by_search_name($visa, 'visa')) == $counter) {
						$query.=") AND ";
					}
					$counter++;
				}
			} else {
				$query.="users.user_id='0' AND ";
			}
		}
		if ($validation !== '') {
			$counter = 1;
			if (count($this->get_users_id_by_search_name($validation, 'validation'))) {
				foreach ($this->get_users_id_by_search_name($validation, 'validation') as $user) {
					if ($counter == 1) {
						$query.="(";
					}
					$query.="users.user_id='" . $user['users_id'] . "'";
					if (count($this->get_users_id_by_search_name($validation, 'validation')) > $counter) {
						$query.=" OR ";
					}
					if (count($this->get_users_id_by_search_name($validation, 'validation')) == $counter) {
						$query.=") AND ";
					}
					$counter++;
				}
			} else {
				$query.="users.user_id='0' AND ";
			}
		}
		if ($operation_type !== '') {
			$query.="operation_types.operation_type LIKE '%" . $operation_type . "%' AND operation_types.operation_type_status = '1' AND ";
		}
		if ($user_total_hours !== '') {
			switch ($total_hours_condition) {
				case '1':
					$query.="users.user_total_hours BETWEEN 1 AND " . (intval($user_total_hours) - 1) . " AND ";
					break;
				case '2':
					$query.="users.user_total_hours = " . intval($user_total_hours) . " AND ";
					break;
				case '3':
					$query.="users.user_total_hours > " . intval($user_total_hours) . " AND ";
					break;
				default:
					$query.="users.user_total_hours = " . intval($user_total_hours) . " AND ";
					break;
			}
		}
		if ($search_term !== '') {
			$query.="(users.user_first_name LIKE '%" . $search_term . "%' OR users.user_last_name LIKE '%" . $search_term . "%' OR CONCAT(users.user_first_name,' ',users.user_last_name) LIKE '%" . $search_term . "%' OR users.user_email='" . $search_term . "') AND ";
		}
		$query.="(users.groups_id = '4' OR users.groups_id = '3') AND users.user_status = 1 GROUP BY user_id";
		return $this->db->query($query)->result_array();
	}

	function get_users_id_by_search_name($search_name, $require = '') {
		switch ($require) {
			case 'passport' : {
					$this->db->join('countries', 'countries.country_id=user_passports.countries_id');
					return $this->db->where(array('country_name' => $search_name, 'user_passport_status' => '1'))->get('user_passports')->result_array();
				}
			case 'visa' : {
					$this->db->join('countries', 'countries.country_id=user_visas.countries_id');
					return $this->db->where(array('country_name' => $search_name, 'user_visa_status' => '1'))->get('user_visas')->result_array();
				}
			case 'validation' : {
					$this->db->join('countries', 'countries.country_id=user_pvalidations.countries_id');
					return $this->db->where(array('country_name' => $search_name, 'user_validation_status' => '1'))->get('user_validations')->result_array();
				}
		}
	}

	function get_active_users_licences() {
		$this->db->join('user_licenses', 'user_licenses.users_id=users.user_id', 'LEFT JOIN');
		$this->db->where('user_license_status', '1')->get('user_licenses')->result_array();
	}

	function get_users_by_active_subscription($user_is_subscribed = '0') {
		return $this->db->where('user_is_subscribed', $user_is_subscribed)->get('users')->result_array();
	}

	function get_user_licenses_by_expire_date($user_license_expire_date) {
		$this->db->join('users', 'users.user_id=user_licenses.users_id');
		$this->db->join('licenses', 'licenses.license_id=user_licenses.licenses_id');
		return $this->db->where("user_license_expire_date = '" . $user_license_expire_date . "' AND user_license_status = '1'")->get('user_licenses')->result_array();
	}

	function get_user_validations_by_expire_date($user_validation_expire_date) {
		$this->db->join('users', 'users.user_id=user_validations.users_id');
		$this->db->join('countries', 'countries.country_id=user_validations.countries_id');
		return $this->db->where("user_validation_expire_date = '" . $user_validation_expire_date . "'")->get('user_validations')->result_array();
	}

	function get_user_passports_by_expire_date($user_passport_expire_date) {
		$this->db->join('users', 'users.user_id=user_passports.users_id');
		$this->db->join('countries', 'countries.country_id=user_passports.countries_id');
		return $this->db->where("user_passport_expire_date = '" . $user_passport_expire_date . "'")->get('user_passports')->result_array();
	}

	function get_user_visa_by_expire_date($user_visa_expire_date) {
		$this->db->join('users', 'users.user_id=user_visas.users_id');
		$this->db->join('countries', 'countries.country_id=user_visas.countries_id');
		return $this->db->where("user_visa_expire_date = '" . $user_visa_expire_date . "'")->get('user_visas')->result_array();
	}

	function count_active_users() {
		return $this->db->where("user_last_activity >= '" . date('Y-m-d H:i:s', strtotime('-5 minutes')) . "'")->get('users')->num_rows();
	}

	function add_employer_seen($employer_seen_array) {
		return $this->db->insert('employer_seens', $employer_seen_array);
	}

	function count_employer_seen_by_employee_id($employee_user_id) {
		return $this->db->order_by('employer_seen_created', 'desc')->where(" employee_users_id = '" . $employee_user_id . "' AND employer_seen_created >= '" . date('Y-m-d H:i:s', strtotime('-30 days')) . "'")->get('employer_seens')->num_rows();
	}

	function get_employer_seen_by_employee_id($employee_user_id, $limit = '', $offset = '') {
		$this->db->join('users', 'users.user_id=employer_seens.employer_users_id', 'left');
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		return $this->db->order_by('employer_seen_created', 'desc')->where(" employee_users_id = '" . $employee_user_id . "' AND employer_seen_created >= '" . date('Y-m-d H:i:s', strtotime('-30 days')) . "'")->get('employer_seens')->result_array();
	}

	function add_list($list_array) {
		return $this->db->insert('lists', $list_array);
	}

	function edit_list_by_id($list_id, $list_array) {
		return $this->db->update('lists', $list_array, array('list_id' => $list_id));
	}

	function get_list_by_id($list_id) {
		return $this->db->where('list_id', $list_id)->get('lists')->row_array();
	}

	function get_active_lists() {
		return $this->db->where('list_status', '1')->get('lists')->result_array();
	}

	function add_user_to_list($list_array) {
		return $this->db->insert('user_lists', $list_array);
	}

	function check_user_in_lists_by_id($user_id, $list_id) {
		$this->db->where('users_id', $user_id);
		return $this->db->where(array('lists_id' => $list_id, 'user_list_status' => '1'))->get('user_lists')->result_array();
	}

	function edit_user_list_by_id($user_list_id, $user_list_array) {
		return $this->db->update('user_lists', $user_list_array, array('user_list_id' => $user_list_id));
	}

	function get_user_list_by_list_id($list_id) {
		$this->db->join('users', 'users.user_id=user_lists.users_id');
		return $this->db->where(array('lists_id' => $list_id, 'user_list_status' => '1'))->get('user_lists')->result_array();
	}

	function add_job_alert($job_alert_array) {
		return $this->db->insert('job_alerts', $job_alert_array);
	}

	function edit_job_alert_by_user_id($user_id, $job_alert_array) {
		return $this->db->update('job_alerts', $job_alert_array, array('users_id' => $user_id));
	}

	function get_job_alert_by_user_id($user_id) {
		return $this->db->where(array('users_id' => $user_id, 'job_alert_status' => '1'))->get('job_alerts')->result_array();
	}

	function get_job_alert_by_job_type_id($job_type_id) {
		$this->db->join('users', 'users.user_id=job_alerts.users_id');
		return $this->db->where(array('job_alerts.job_types_id' => $job_type_id, 'job_alert_status' => '1'))->get('job_alerts')->result_array();
		;
	}

	function get_employees($job_type_id = '') {
		$query = "SELECT
				users.*,
				user_country.country_name AS user_country_name,
				type_ratings.type_rating_name,
				job_types.job_type_name,
				employee_roles.employee_role_name,
				GROUP_CONCAT(DISTINCT user_passport_country.country_name SEPARATOR ', ') AS user_passport_countries,
				GROUP_CONCAT(DISTINCT IF(user_lic.license_type!='',user_lic.license_type,other_lic.user_license_type_other_name) SEPARATOR ', ') AS user_license_type,
				GROUP_CONCAT(DISTINCT IF(user_training.training_name!='',user_training.training_name,user_training_course_other_name) SEPARATOR ', ') AS user_training_name,
				GROUP_CONCAT(DISTINCT user_validation_country.country_name SEPARATOR ', ') AS user_validation_countries,
				GROUP_CONCAT(DISTINCT user_visa_country.country_name SEPARATOR ', ') AS user_visa_countries,
				GROUP_CONCAT(DISTINCT IF(user_medical_license_authorities.license_authority_name!='',user_medical_license_authorities.license_authority_name,other_medical_authority.user_medical_certificate_authority_other_name) SEPARATOR ', ') AS user_medical_certificate_examinations,
				GROUP_CONCAT(DISTINCT user_current_position.position_name SEPARATOR ', ') AS user_current_position_names,
				GROUP_CONCAT(DISTINCT IF(user_skill.skill_name!='',user_skill.skill_name,other_skills.user_skill_other_name) SEPARATOR ', ') AS user_skill_names
				FROM users
				LEFT JOIN countries user_country ON users.countries_id = user_country.country_id
				LEFT JOIN type_ratings ON type_ratings.type_rating_id = users.type_ratings_id
				LEFT JOIN job_types ON job_types.job_type_id = users.job_types_id
				LEFT JOIN employee_roles ON employee_roles.employee_role_id = users.employee_roles_id
				LEFT JOIN user_passports ON user_passports.users_id = users.user_id
				LEFT JOIN countries user_passport_country ON user_passports.countries_id = user_passport_country.country_id
				LEFT JOIN user_licenses ON user_licenses.users_id = users.user_id
				LEFT JOIN licenses user_lic ON user_licenses.licenses_id = user_lic.license_id
				LEFT JOIN user_license_type_others other_lic ON user_licenses.user_license_id = other_lic.user_licenses_id
				LEFT JOIN user_trainings ON user_trainings.users_id = users.user_id
				LEFT JOIN user_training_course_others other_courses ON other_courses.user_trainings_id = user_trainings.user_training_id
				LEFT JOIN trainings user_training ON user_training.training_id = user_trainings.trainings_id
				LEFT JOIN user_validations ON user_validations.users_id = users.user_id
				LEFT JOIN countries user_validation_country ON user_validations.countries_id = user_validation_country.country_id
				LEFT JOIN user_visas ON user_visas.users_id = users.user_id
				LEFT JOIN countries user_visa_country ON user_visas.countries_id = user_visa_country.country_id
				LEFT JOIN user_medical_certificates ON user_medical_certificates.users_id = users.user_id
				LEFT JOIN user_medical_certificate_authority_others other_medical_authority ON other_medical_authority.user_medical_certificates_id = user_medical_certificates.user_medical_certificate_id
				LEFT JOIN license_authorities user_medical_license_authorities ON user_medical_license_authorities.license_authority_id = user_medical_certificates.license_authorities_id
				LEFT JOIN user_current_positions ON user_current_positions.users_id = users.user_id
				LEFT JOIN positions user_current_position ON user_current_position.position_id = user_current_positions.positions_id
				LEFT JOIN user_skills ON user_skills.users_id = users.user_id
				LEFT JOIN user_skill_others other_skills ON  other_skills.user_skills_id = user_skills.user_skill_id
				LEFT JOIN skills user_skill ON user_skill.skill_id = user_skills.skills_id
				WHERE users.user_status != '-1'
				AND users.groups_id = 4
				AND (user_passports.user_passport_status IS NULL OR user_passports.user_passport_status = 1)
				AND (user_licenses.user_license_status IS NULL OR user_licenses.user_license_status = 1)
				AND (user_trainings.user_training_status IS NULL OR user_trainings.user_training_status = 1)
				AND (user_validations.user_validation_status IS NULL OR user_validations.user_validation_status = 1)
				AND (user_visas.user_visa_status IS NULL OR user_visas.user_visa_status = 1)
				AND (user_medical_certificates.user_medical_certificate_status IS NULL OR user_medical_certificates.user_medical_certificate_status = 1)
				AND (user_current_positions.user_current_position_status IS NULL OR user_current_positions.user_current_position_status = 1)";
		if ($job_type_id !== '') {
			$query.=" AND users.job_types_id='" . $job_type_id . "'";
		}
		$query.=" GROUP BY users.user_id";
		return $this->db->query($query)->result_array();
	}

	function get_active_license_authorities() {
		return $this->db->where('license_authority_status', '1')->get('license_authorities')->result_array();
	}

	function get_positions_by_job_type_id($job_type_id) {
		if ($job_type_id === '5' || $job_type_id === '6') {
			$job_type_id = '5';
		}
		$this->db->where('job_types_id', $job_type_id);
		return $this->db->where('position_status', '1')->get('positions')->result_array();
	}

	function get_user_current_positions_by_user_id($user_id) {
		$this->db->join('positions', 'positions.position_id = user_current_positions.positions_id', 'left');
		return $this->db->where(array('user_current_position_status' => '1', 'users_id' => $user_id))->get('user_current_positions')->result_array();
	}

	function edit_user_current_position_by_user_id($user_id, $position_array) {
		return $this->db->update('user_current_positions', $position_array, array('users_id' => $user_id));
	}

	function add_user_license_authority($license_authority_id) {
		if ($this->db->insert('user_license_authorities', $license_authority_id) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function add_user_current_position($user_current_position_array) {
		if ($this->db->insert('user_current_positions', $user_current_position_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function add_current_type_rating($current_type_rating_array) {
		return $this->db->insert('user_current_type_ratings', $current_type_rating_array);
	}

	function add_user_employment_position($user_employment_position_array) {
		if ($this->db->insert('user_employment_positions', $user_employment_position_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function add_user_current_type_rating($user_rating_array) {
		return $this->db->insert('user_current_type_ratings', $user_rating_array);
	}

	function add_user_aircraft_rating_coverage($user_aircraft_rating_coverage_array) {
		return $this->db->insert('user_aircraft_rating_coverages', $user_aircraft_rating_coverage_array);
	}

	function edit_user_skill_by_user_id($user_id, $skill_array) {
		return $this->db->update('user_skills', $skill_array, array('users_id' => $user_id));
	}

	function get_skills_by_job_type_id($job_type_id) {
		if ($job_type_id === '5' || $job_type_id === '6') {
			$job_type_id = '5';
		}
		return $this->db->where(array('skill_status' => '1', 'job_types_id' => $job_type_id))->get('skills')->result_array();
	}

	function add_user_skill($user_skill_array) {
		if ($this->db->insert('user_skills', $user_skill_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_skill_by_user_id($user_id) {
		$this->db->join('skills', 'skills.skill_id = user_skills.skills_id', 'left');
		return $this->db->where(array('user_skill_status' => '1', 'users_id' => $user_id))->get('user_skills')->result_array();
	}

	function add_user_rating($user_rating_array) {
		if ($this->db->insert('user_ratings', $user_rating_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_rating_by_user_id($user_id) {
		$this->db->join('type_ratings', 'type_ratings.type_rating_id = user_ratings.type_ratings_id', 'left');
		return $this->db->where(array('user_rating_status' => '1', 'users_id' => $user_id))->get('user_ratings')->result_array();
	}

	function edit_user_rating_by_user_id($user_rating_array, $user_id) {
		return $this->db->update('user_ratings', $user_rating_array, array('users_id' => $user_id));
	}

	function get_licenses_by_job_type_id($job_type_id = '') {
		$this->db->join('license_types', 'license_types.license_type_id=licenses.license_types_id', 'left');
		if ($job_type_id !== '') {
			$this->db->where('license_types.job_types_id', $job_type_id);
		}
		return $this->db->where(array('license_status' => '1', 'license_type_status' => '1'))->get('licenses')->result_array();
	}

	function get_approval_ratings() {
		return $this->db->where(array('approval_rating_status' => '1'))->get('approval_ratings')->result_array();
	}

	function edit_user_reference_by_user_id($user_id, $user_reference_array) {
		return $this->db->update('user_references', $user_reference_array, array('users_id' => $user_id));
	}

	function add_user_reference($user_reference_array) {
		if ($this->db->insert('user_references', $user_reference_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_user_reference_by_user_id($user_id) {
		$this->db->join('positions', 'positions.position_id=user_references.positions_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_reference_status' => '1'))->get('user_references')->result_array();
	}

	function get_trainings_by_job_type_id($job_type_id) {
		if ($job_type_id === '4' || $job_type_id === '5' || $job_type_id === '6') {
			$job_type_id = '4';
		}
		if ($job_type_id === '1' || $job_type_id === '7') {
			$job_type_id = '1';
		}
		return $this->db->where(array('job_types_id' => $job_type_id, 'training_status' => '1'))->get('trainings')->result_array();
	}

	function edit_user_aircraft_rating_by_user_id($user_id, $aircraft_rating_array, $is_other = '', $category = '0') {
		return $this->db->update('user_aircraft_ratings', $aircraft_rating_array, array('users_id' => $user_id, 'user_aircraft_rating_is_other' => $is_other, 'user_aircraft_rating_category' => $category));
	}

	function add_user_aircraft_rating($aircraft_rating_array) {
		if ($this->db->insert('user_aircraft_ratings', $aircraft_rating_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_user_aircraft_rating_license_authority($aircraft_rating_license_authority_array) {
		if ($this->db->insert('user_aircraft_rating_license_authorities', $aircraft_rating_license_authority_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_aircraft_rating_by_user_id($user_id, $is_other = '', $category = '0') {
		if ($is_other !== '') {
			$this->db->where('user_aircraft_rating_is_other', $is_other);
		}
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=user_aircraft_ratings.my_aircrafts_id', 'left');
		$this->db->join('type_ratings', 'type_ratings.type_rating_id=user_aircraft_ratings.type_ratings_id', 'left');
		$this->db->where('user_aircraft_rating_category', $category);
		return $this->db->where(array('user_aircraft_rating_status' => '1', 'users_id' => $user_id))->get('user_aircraft_ratings')->result_array();
	}

	function get_user_aircraft_rating_license_authorities_by_user_id($user_aircraft_rating_id) {
		$this->db->join('license_authorities', 'license_authorities.license_authority_id=user_aircraft_rating_license_authorities.license_authorities_id', 'left');
		return $this->db->where('user_aircraft_ratings_id', $user_aircraft_rating_id)->get('user_aircraft_rating_license_authorities')->result_array();
	}

	function add_user_aircraft_rating_coverages($aircraft_rating_coverage_array) {
		if ($this->db->insert('user_aircraft_rating_coverages', $aircraft_rating_coverage_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating_id) {
		return $this->db->where('user_aircraft_ratings_id', $aircraft_rating_id)->get('user_aircraft_rating_coverages')->result_array();
	}

	function get_management_experience($job_type_id = '0') {
		if ($job_type_id !== '0') {
			$this->db->where('job_types_id', $job_type_id);
		}
		return $this->db->get('management_experiences')->result_array();
	}

	function add_user_management_experiences($management_experience_array) {
		if ($this->db->insert('user_management_experiences', $management_experience_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_user_management_experiences_by_user_id($user_id) {
		return $this->db->where(array('user_management_experience_status' => '1', 'users_id' => $user_id))->get('user_management_experiences')->result_array();
	}

	function add_user_management_experience_type($user_management_experience_type_array) {
		if ($this->db->insert('user_management_experience_types', $user_management_experience_type_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_management_experience_type_by_user_m_e_id($user_management_experience_id) {
		$this->db->join('management_experiences', 'user_management_experience_types.management_experiences_id = management_experiences.management_experience_id', 'left');
		return $this->db->where('user_management_experiences_id', $user_management_experience_id)->get('user_management_experience_types')->result_array();
	}

	function edit_user_management_experiences_by_user_id($user_id, $management_experience_array) {
		return $this->db->update('user_management_experiences', $management_experience_array, array('users_id' => $user_id));
	}

	function edit_pilot_flight_time_by_user_id($user_id, $pilot_flight_time_array) {
		return $this->db->update('user_flight_times', $pilot_flight_time_array, array('users_id' => $user_id));
	}

	function add_pilot_flight_time($pilot_flight_time_insert_array) {
		return $this->db->insert('user_flight_times', $pilot_flight_time_insert_array);
	}

	function get_user_flight_time_by_user_id($user_id) {
		return $this->db->where(array('user_flight_time_status' => '1', 'users_id' => $user_id))->get('user_flight_times')->row_array();
	}

	function edit_user_retired_pilot_by_user_id($user_id, $retired_pilot_array) {
		return $this->db->update('user_retired_pilots', $retired_pilot_array, array('users_id' => $user_id));
	}

	function add_user_retired_pilot($retired_pilot_array) {
		if ($this->db->insert('user_retired_pilots', $retired_pilot_array) > 0) {
			return $this->db->insert_id();
		}
		return '0';
	}

	function get_user_retired_pilot_by_user_id($user_id) {
		$this->db->join('positions', 'positions.position_id = user_retired_pilots.positions_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_retired_pilot_status' => '1'))->get('user_retired_pilots')->row_array();
	}

	function get_user_new_applicants($user_id = '') {
		$this->db->join('jobs', 'jobs.job_id = job_applications.jobs_id', 'left');
		if ($user_id !== '') {
			$this->db->where('jobs.users_id', $user_id);
		}
		$this->db->select('count(job_application_id) AS new_application_count');
		return $this->db->where("job_application_status = 1 AND job_application_created > '" . $_SESSION['user']['user_last_logged_out'] . "'")->get('job_applications')->row_array();
	}

	function get_user_countries_of_experience_by_user_id($user_id) {
		$this->db->join('countries', 'countries.country_id = user_countries_of_experiences.countries_id', 'left');
		return $this->db->where(array('users_id' => $user_id, 'user_countries_of_experience_status' => '1'))->get('user_countries_of_experiences')->result_array();
	}

	function edit_user_countries_experience_by_user_id($user_id, $country_experience_array) {
		return $this->db->update('user_countries_of_experiences', $country_experience_array, array('users_id' => $user_id));
	}

	function add_user_countries_experience($country_experience_array) {
		return $this->db->insert('user_countries_of_experiences', $country_experience_array);
	}

	function add_user_other_data_lookup($lookup_array, $lookup_table) {
		return $this->db->insert($lookup_table, $lookup_array);
	}

	function get_user_other_data_lookup_by_column_name_and_lookup_id($column_name, $lookup_table, $lookup_id = '') {
		return $this->db->where($column_name, $lookup_id)->get($lookup_table)->row_array();
	}

	function delete_user_data_lookup_by_user_and_lookup_id($user_lookup_id, $user_id, $lookup_table) {
		return $this->db->delete($lookup_table, array('users_id' => $user_id, 'user_lookups_id' => $user_lookup_id));
	}

}
