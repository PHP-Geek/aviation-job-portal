<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public $public_methods = array();

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function index() {
		$data = array();
		$this->load->model('User_model');
		$this->load->model('Job_model');
		$this->load->model('Auth_model');
		$data['job_locations'] = $this->Auth_model->get_countries();
		$data['profile_view_count'] = $this->User_model->count_employer_seen_by_employee_id($_SESSION['user']['user_id']);
		$data['job_type_array'] = $this->Job_model->get_active_job_types();
		$data['job_alert_array'] = $this->User_model->get_job_alert_by_user_id($_SESSION['user']['user_id']);
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($_SESSION['user']['user_id']);
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($_SESSION['user']['user_id'], '0');
		$data['user_experience_array'] = $this->User_model->get_user_experience_by_user_id($_SESSION['user']['user_id'], '0');
		$data['user_license_authority_array'] = $this->User_model->get_user_license_authority_by_user_id($_SESSION['user']['user_id']);
		$data['user_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($_SESSION['user']['user_id'], '0');
		$data['user_countries_of_experience_array'] = $this->User_model->get_user_countries_of_experience_by_user_id($_SESSION['user']['user_id']);
		foreach ($data['user_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_aircraft_rating_array'][$key]['user_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_aircraft_type_others', $aircraft_rating['user_aircraft_rating_id']);
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_coverages'] = $this->User_model->get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating['user_aircraft_rating_id']);
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_type_rating_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		$data['user_rating_array'] = $this->User_model->get_user_rating_by_user_id($_SESSION['user']['user_id']);
		foreach ($data['user_rating_array'] as $key => $type_rating) {
			$data['user_rating_array'][$key]['user_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_ratings_id', 'user_rating_others', $type_rating['user_rating_id']);
		}
		$data['user_skill_array'] = $this->User_model->get_user_skill_by_user_id($_SESSION['user']['user_id']);
		foreach ($data['user_skill_array'] as $key => $user_skill) {
			$data['user_skill_array'][$key]['user_skill_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_skills_id', 'user_skill_others', $user_skill['user_skill_id']);
		}
		$data['user_details_array'] = $_SESSION['user'];
		$data['next_job_expiry'] = $this->Job_model->get_job_count_details('1', $_SESSION['user']['user_id'])['expire_date'];
		$data['posted_jobs_count'] = $this->Job_model->get_job_count_details('2', $_SESSION['user']['user_id'])['posted_jobs_count'];
		$data['no_of_applicant'] = $this->Job_model->get_job_application_count($_SESSION['user']['user_id'])['job_application_count'];
		$data['new_applicant'] = $this->User_model->get_user_new_applicants($_SESSION['user']['user_id'])['new_application_count'];
		if ($_SESSION['user']['group_slug'] === 'employer') {
			$data['title'] = 'Employer Dashboard';
		}
		if ($_SESSION['user']['group_slug'] === 'employee') {
			$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($_SESSION['user']['user_id']);
			$data['title'] = 'Employee Dashboard';
		}
		if ($_SESSION['user']['group_slug'] === 'administrator') {
			$data['title'] = 'Admin Dashboard';
		}
		foreach ($data['user_license_array'] as $key => $user_license) {
			$data['user_license_array'][$key]['user_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $user_license['user_license_id']);
			$data['user_license_array'][$key]['user_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $user_license['user_license_id']);
		}
		parent::render_view($data, '', 'dashboard/' . $_SESSION['user']['group_slug']);
	}

	function update_image() {
		parent::allow(array('employee'));
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_profile_image', 'Profile Image', 'trim|required');
		if ($this->form_validation->run()) {
			$user_details_array = $_SESSION['user'];
			$user_image_file = $this->input->post('user_profile_image');
			$user_thumb_image = pathinfo($user_image_file, PATHINFO_FILENAME) . '_thumb.' . pathinfo($user_image_file, PATHINFO_EXTENSION);
			if (is_file(FCPATH . 'uploads/' . $user_image_file)) {
				$image_upload_directory = FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s', strtotime($user_details_array ['user_created']));
				if (!is_dir($image_upload_directory)) {
					mkdir($image_upload_directory, 0777, TRUE);
				} $image_size_array = getimagesize(FCPATH . 'uploads/' . $user_image_file);
				$image_x_size = $image_size_array [0];
				$image_y_size = $image_size_array[1];
				$crop_measure = min($image_x_size, $image_y_size);
				if ($image_x_size > $image_y_size) {
					$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
					$crop_image_y_size = '0';
				} else {
					$crop_image_y_size = ( $image_y_size - $image_x_size ) / 2;
					$crop_image_x_size = '0';
				}
				if (parent::crop_image(FCPATH . 'uploads/' . $user_image_file, $image_upload_directory . '/' . $user_image_file, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
					if (parent ::resize_image($image_upload_directory . '/' . $user_image_file, $image_upload_directory . '/' . $user_image_file, 250, 250) && parent::resize_image($image_upload_directory . '/' . $user_image_file, $image_upload_directory . '/' . $user_thumb_image, 150, 150)) {
						unlink(FCPATH . 'uploads/' . $user_image_file);
					}
				}
			}
			if ($this->User_model->edit_user_by_user_id($_SESSION['user']['user_id'], array(
						'user_profile_image' => $user_image_file,
						'user_profile_thumb' => $user_thumb_image,
					))) {
				parent::regenerate_session();
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

}
