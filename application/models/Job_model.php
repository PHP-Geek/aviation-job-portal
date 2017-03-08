<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Job_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($job_insert_array) {
		if ($this->db->insert('jobs', $job_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_job_type($job_type_insert_array) {
		return $this->db->insert('job_types', $job_type_insert_array);
	}

	function get_active_job_types() {
		return $this->db->where('job_type_status', '1')->order_by('job_type_order', 'ASC')->get('job_types')->result_array();
	}

	function get_all_job_types() {
		return $this->db->where('job_type_status', '1')->get('job_types')->result_array();
	}

	function get_job_type_by_slug($job_type_slug) {
		return $this->db->where('job_type_slug', $job_type_slug)->get('job_types')->row_array();
	}

	function get_job_type_by_id($job_type_id) {
		return $this->db->where('job_type_id', $job_type_id)->get('job_types')->row_array();
	}

	function count_jobs_by_job_type_id($job_type_id) {
		$this->db->join('countries', 'countries.country_id=jobs.countries_id');
		$this->db->where('job_types_id = ' . $job_type_id . ' AND job_status = 1');
		return $this->db->order_by('job_post_date', 'desc')->get('jobs')->num_rows();
	}

	function get_jobs_by_job_type_id($job_type_id, $limit, $offset) {
		$this->db->join('countries', 'countries.country_id=jobs.countries_id');
		$this->db->where('job_types_id = ' . $job_type_id . ' AND job_status = 1');
		$this->db->limit($limit, $offset);
		return $this->db->order_by('job_post_date', 'desc')->get('jobs')->result_array();
	}

	function get_all_jobs() {
		return $this->db->where('job_status', '1')->get('jobs')->result_array();
	}

	function get_job_by_id($job_id) {
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=jobs.my_aircrafts_id', 'left');
		$this->db->join('licenses', 'licenses.license_id=jobs.licenses_id', 'left');
		$this->db->join('countries', 'countries.country_id = jobs.countries_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id');
		return $this->db->where('job_id', $job_id)->get('jobs')->row_array();
	}

	function add_job_application($job_application_insert_array) {
		return $this->db->insert('job_applications', $job_application_insert_array);
	}

	function get_active_companies() {
		return $this->db->where('company_status', '1')->get('companies')->result_array();
	}

	function get_job_categories() {
		return $this->db->where('job_type_status', '1')->get('job_types')->result_array();
	}

	function edit_job_by_id($job_update_array, $job_id) {
		return $this->db->where('job_id', $job_id)->update('jobs', $job_update_array);
	}

	function edit_job_type_by_id($job_type_id, $job_type_update_array) {
		return $this->db->update('job_types', $job_type_update_array, array('job_type_id' => $job_type_id));
	}

	function get_job_by_user_id($is_expired = '') {
		if ($is_expired === 'true') {
			$this->db->where("job_expire_date < CURDATE()");
		} else {
			$this->db->where("job_expire_date >= CURDATE()");
		}
		$this->db->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		$this->db->join('licenses', 'licenses.license_id=jobs.licenses_id', 'left');
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=jobs.my_aircrafts_id', 'left');
		if ($_SESSION['user']['group_slug'] !== 'administrator') {
			$this->db->where('users_id', $_SESSION['user']['user_id']);
		}
		$this->db->where("job_status != -1");
		return $this->db->order_by('job_post_date', 'desc')->get('jobs')->result_array();
	}

	function get_job_applications() {
		$this->db->join('jobs', 'jobs.job_id=job_applications.jobs_id');
		$this->db->join('users', 'users.user_id=job_applications.users_id', 'left');
		$this->db->join('countries', 'countries.country_id=jobs.countries_id');
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=jobs.my_aircrafts_id', 'left');
		if (isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] !== 'administrator') {
			$this->db->where('jobs.users_id', $_SESSION['user']['user_id']);
		}
		$this->db->order_by('jobs.job_post_date', 'desc');
		$this->db->order_by('job_applications.job_application_created', 'asc');
		$this->db->where('jobs.job_status', '1');
		return $this->db->get('job_applications')->result_array();
	}

	function get_job_application_by_id($job_application_id) {
		$this->db->join('jobs', 'jobs.job_id=job_applications.jobs_id', 'left');
		$this->db->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		return $this->db->where(array('job_application_id' => $job_application_id, 'jobs.job_status' => '1'))->get('job_applications')->row_array();
	}

	function get_job_application_by_job_id_and_user_id($job_id, $user_id) {
		return $this->db->where(array('jobs_id' => $job_id, 'users_id' => $user_id))->get('job_applications')->result_array();
	}

	function get_job_application_by_user_id($user_id, $limit = '', $offset = '', $show_inactive = '') {
		$this->db->join('users', 'users.user_id=job_applications.users_id', 'left');
		$this->db->join('jobs', 'jobs.job_id=job_applications.jobs_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		$this->db->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		if ($show_inactive !== '') {
			$this->db->where("job_application_status != '-1'");
		}
		return $this->db->where(array('job_applications.users_id' => $user_id, 'jobs.job_status' => '1'))->get('job_applications')->result_array();
	}

	function count_job_applications_by_job_id($job_id, $user_id = '') {
		$this->db->join('jobs', 'jobs.job_id = job_applications.jobs_id', 'left');
		if ($user_id !== '') {
			$this->db->where('users_id', $user_id);
		}
		return $this->db->where(array('jobs_id' => $job_id, 'jobs.job_status' => '1', 'job_applications.job_application_status' => '1'))->get('job_applications')->num_rows();
	}

	function get_job_applications_by_job_id($job_id, $user_id = '', $limit = '', $offset = '') {
		$this->db->join('jobs', 'jobs.job_id=job_applications.jobs_id', 'left');
		$this->db->join('users', 'users.user_id=job_applications.users_id', 'left');
		$this->db->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=jobs.my_aircrafts_id', 'left');
		if ($user_id !== '') {
			$this->db->where('job_applications.users_id', $user_id);
		}
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		return $this->db->where(array('jobs_id' => $job_id, 'jobs.job_status' => '1'))->get('job_applications')->result_array();
	}

	function get_expired_job() {
		if (isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] !== 'administrator') {
			$this->db->where('users_id', $_SESSION['user']['user_id']);
		}
		$this->db->where('jobs.job_status', '1');
		return $this->db->where('job_expire_date < NOW()')->get('jobs')->result_array();
	}

	function count_job_applicants_by_job_id($job_id) {
		return $this->db->where('jobs_id', $job_id)->get('job_applications')->num_rows();
	}

	function get_jobs($limit, $offset) {
		$this->db->join('countries', 'countries.country_id=jobs.countries_id');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id');
		$this->db->join('licenses', 'licenses.license_id=jobs.licenses_id', 'left');
		$this->db->join('my_aircrafts', 'my_aircrafts.my_aircraft_id=jobs.my_aircrafts_id', 'left');
		return $this->db->limit($limit, $offset)->order_by('job_post_date', 'desc')->get('jobs')->result_array();
	}

	function count_total_jobs() {
		return $this->db->get('jobs')->num_rows();
	}

	function get_country_by_id($country_id) {
		return $this->db->where('country_id', $country_id)->get('countries')->row_array();
	}

	function add_job_view_log($job_view_log_array) {
		return $this->db->insert('job_view_logs', $job_view_log_array);
	}

	function edit_job_application_by_id($job_application_id, $job_application_array) {
		return $this->db->update('job_applications', $job_application_array, array('job_application_id' => $job_application_id));
	}

	function count_job_application_by_user_id($user_id) {
		return $this->db->where('users_id', $user_id)->get('job_applications')->num_rows();
	}

	function add_saved_job($saved_job_array) {
		return $this->db->insert('saved_jobs', $saved_job_array);
	}

	function get_saved_job_by_user_id_and_job_id($job_id, $user_id) {
		$this->db->join('jobs', 'jobs.job_id=saved_jobs.jobs_id', 'left');
		return $this->db->where(array('jobs_id' => $job_id, 'saved_jobs.users_id' => $user_id, 'saved_job_status' => '1', 'jobs.job_status' => '1'))->get('saved_jobs')->row_array();
	}

	function get_saved_job_by_user_id($user_id) {
		$this->db->join('jobs', 'jobs.job_id=saved_jobs.jobs_id', 'left');
		$this->db->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->db->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		return $this->db->where(array('saved_jobs.saved_job_status' => '1', 'saved_jobs.users_id' => $user_id, 'jobs.job_status' => '1'))->get('saved_jobs')->result_array();
	}

	function edit_saved_job_by_id($saved_job_array, $saved_job_id) {
		return $this->db->update('saved_jobs', $saved_job_array, array('saved_job_id' => $saved_job_id));
	}

	function get_skills_by_job_type_id($job_type_id) {
		return $this->db->where(array('skill_status' => '1', 'job_types_id' => $job_type_id))->get('skills')->result_array();
	}

	function add_job_alert($job_alert_array) {
		return $this->db->insert('job_alerts', $job_alert_array);
	}

	function get_job_alert_by_job_id($job_alert_id) {
		return $this->db->where('job_alert_id', $job_alert_id)->get('job_alerts')->row_array();
	}

	function edit_job_alert_by_id($job_alert_update_array, $job_alert_id) {
		return $this->db->where('job_alert_id', $job_alert_id)->update('job_alerts', $job_alert_update_array);
	}

	function get_job_count_details($type = '', $user_id = '') {
		if ($type === '1') {
			$this->db->select('min(job_expire_date) AS expire_date');
			$this->db->where("jobs.job_expire_date >= now()");
		}
		if ($type === '2') {
			$this->db->select('count(job_id) AS posted_jobs_count');
		}
		if ($user_id !== '') {
			$this->db->where('jobs.users_id', $user_id);
		}
		return $this->db->where('jobs.job_status', '1')->get('jobs')->row_array();
	}

	function get_job_application_count($user_id = '') {
		$this->db->join('jobs', 'jobs.job_id = job_applications.jobs_id', 'left');
		$this->db->select('count(job_application_id) AS job_application_count');
		if ($user_id !== '') {
			$this->db->where('jobs.users_id', $user_id);
		}
		return $this->db->where("job_applications.job_application_status = '1' AND jobs.job_status = '1' AND jobs.job_expire_date >= CURDATE()")->get('job_applications')->row_array();
	}

}

?>