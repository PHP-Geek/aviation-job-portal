<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public $public_methods = array();
	public $notice_period_array = array('Immediate', 'Negotiable', '1 Week or Less', '2 Weeks', '1 Month', '2 Months', '3 Months or Greater', 'Other');
	public $user_employment_type_array = array('ALL', 'Contract/Freelance', 'Full Time', 'Part Time', 'Casual', 'Other');
	public $endorsement_array = array('Air Control(AIR)', 'Ground Movement Control (GMC)', 'Tower Control (TWR)', 'Ground Movement Surveillance (GMS)', 'Aerodrome Radar Control (RAD)', 'Precision Approach Radar (PAR)', 'Surveillance Radar Approach (SRA)', 'Terminal Control (TCL)', 'Oceanic Control (OCN)', 'Trainer / Instructor', 'Examiner', 'Unit', 'Other');

	function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
	}

	function index() {
		redirect('login', 'refresh');
	}

	function register($type = 'employee', $role = '') {
		$data = array();
		$this->load->model('Job_model');
		$this->load->model('User_model');
		$this->load->model('Aircraft_model');
		if ($type === 'employer') {
			$employer_type_array = $this->Auth_model->get_employer_type_by_role_slug($role);
			$data['role'] = $employer_type_array['employer_type'];
			if (count($employer_type_array) > 0) {
				$employer_type_id = $employer_type_array['employer_type_id'];
			} else {
				redirect(base_url() . 'login');
			}
		} else {
			$data['employee_category'] = $role;
			$job_type_array = $this->Job_model->get_job_type_by_slug($role);
			if (count($job_type_array) > 0) {
				$job_type_id = $job_type_array['job_type_id'];
				$data['job_type'] = $job_type_array['job_type_name'];
			} else {
				redirect(base_url() . 'login');
			}
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->load->library('encrypt');
			$this->load->model('User_model');
			$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]');
			$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('user_confirm_password', 'Cofirm Password', 'trim|required|matches[user_password]');
			$this->form_validation->set_rules('user_address', 'Address', 'trim');
			$this->form_validation->set_rules('countries_id', 'Country', 'trim');
			$this->form_validation->set_rules('user_primary_contact', 'Telephone No', 'trim|min_length[4]');
			$this->form_validation->set_rules('terms_accepted', 'Agreement', 'trim|required');
			$this->form_validation->set_rules('user_captcha', 'Captcha Image Text', 'trim|required|exact_length[6]|numeric|callback_validate_captcha');
			$this->form_validation->set_rules('user_years_of_experience', 'Experience', 'is_numeric');
			if ($type === 'employer') {
				$this->form_validation->set_rules('user_website_address', 'Website Address', 'trim|prep_url');
				$this->form_validation->set_rules('user_business_name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('user_skype_id', 'Skype Name', 'trim');
			}
			if ($this->form_validation->run()) {
				$flag = 0;
				$time_now = date('Y-m-d H:i:s');
				if ($type === 'employee') {
					if ($role === 'air-traffic-controller') {
						if ($this->input->post('user_endorsement') === 'Other') {
							echo 'Please fill the endorsement';
							die;
						}
					}
				}
				$password = $this->input->post('user_password');
				$user_insert_array = array(
					'user_login' => $this->input->post('user_email'),
					'user_login_salt' => md5($time_now),
					'user_login_password' => md5(md5(md5($time_now) . $password)),
					'user_password_hash' => $this->encrypt->encode($password, md5(md5(md5($time_now) . $password))),
					'user_security_hash' => md5($time_now . $password),
					'user_first_name' => $this->input->post('user_first_name'),
					'user_last_name' => $this->input->post('user_last_name'),
					'user_email' => $this->input->post('user_email'),
					'user_address' => $this->input->post('user_address'),
					'countries_id' => $this->input->post('countries_id'),
					'user_city' => $this->input->post('user_city'),
					'user_state' => $this->input->post('user_state'),
					'user_zipcode' => $this->input->post('user_zipcode'),
					'user_country_code' => $this->input->post('user_country_code'),
					'user_primary_contact' => $this->input->post('user_primary_contact'),
					'terms_accepted' => $this->input->post('terms_accepted'),
					'user_is_subscribed' => $this->input->post('subscribe_newsletters') == '1' ? '1' : '0',
					'user_description' => '',
					'user_profile_completeness' => '5',
					'user_verified' => '0',
					'user_status' => '1',
					'user_created' => $time_now
				);
				if ($type === 'employer') {
					$user_insert_array['groups_id'] = '3';
					$user_insert_array['user_business_name'] = $this->input->post('user_business_name');
					$user_insert_array['user_skype_id'] = $this->input->post('user_skype_id');
					$user_insert_array['employer_types_id'] = $employer_type_id;
					$user_insert_array['user_website_address'] = $this->input->post('user_website_address');
				}
				if ($type === 'employee') {
					$user_insert_array['groups_id'] = '4';
					$user_insert_array['job_types_id'] = $job_type_id;
					if ($role === 'pilot') {
						$user_insert_array['user_total_hours'] = $this->input->post('user_total_hours');
						$user_insert_array['user_total_hours_on_type'] = $this->input->post('user_total_hours_on_type');
						$user_insert_array['user_pic_on_type'] = $this->input->post('user_pic_on_type');
						$user_insert_array['user_sic_on_type'] = $this->input->post('user_sic_on_type');
					} else if ($role === 'executive' || $role === 'operations' || $role === 'corporate') {
						$user_insert_array['user_years_of_experience'] = $this->input->post('user_years_of_experience');
						$user_insert_array['user_countries_of_experience'] = $this->input->post('user_countries_of_experience');
					} else if ($role === 'flight-attendant') {
						$user_insert_array['user_years_of_experience'] = $this->input->post('user_years_of_experience');
						$user_insert_array['my_aircrafts_id'] = $this->input->post('my_aircrafts_id');
						$user_insert_array['my_aircraft_other'] = $this->input->post('my_aircraft_other');
						$user_insert_array['positions_id'] = $this->input->post('positions_id');
						$user_insert_array['user_position_other'] = $this->input->post('user_position_other');
					} else if ($role === 'air-traffic-controller') {
						$user_insert_array['user_years_of_experience'] = $this->input->post('user_years_of_experience');
						$user_insert_array['user_endorsement'] = $this->input->post('user_endorsement') != 'Other' ? $this->input->post('user_endorsement') : $this->input->post('user_endorsement1');
						$user_insert_array['user_airport_area'] = $this->input->post('user_airport_area');
					}
				}
				$user_id = $this->User_model->add($user_insert_array);
				$license_authority_array = array();
				$license_array = array();
				if ($user_id > 0) {
					if ($type === 'employee') {
						if ($role === 'pilot') {
							//add license authorities
							if (count($this->input->post('license_authorities_id')) > 0) {
								foreach ($this->input->post('license_authorities_id') as $license_authority) {
									$license_authority_array[] = $license_authority;
								}
							}
							//add license types
							if (count($this->input->post('licenses_id')) > 0) {
								foreach ($this->input->post('licenses_id') as $license) {
									$license_array[] = $license;
								}
							}
							$user_license_array = array();
							for ($i = 0; $i < count($license_array) || $i < count($license_authority_array); $i++) {
								$user_license_array[] = array(
									'licenses_id' => isset($license_array[$i]) ? $license_array[$i] : NULL,
									'license_authorities_id' => isset($license_authority_array[$i]) ? $license_authority_array[$i] : NULL
								);
							}
							if (count($user_license_array) > 0) {
								foreach ($user_license_array as $user_license) {
									$user_license_id = $this->User_model->add_user_licenses(array(
										'users_id' => $user_id,
										'licenses_id' => $user_license['licenses_id'],
										'license_authorities_id' => $user_license['license_authorities_id'],
										'user_license_expire_date' => '0000-00-00',
										'user_license_status' => '1'
									));
									if ($user_license['licenses_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_type_other_name' => $this->input->post('user_license_type_other_name'),
											'user_license_type_other_status' => '1'
												), 'user_license_type_others');
									}
									if ($user_license['license_authorities_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name'),
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
								}
							}
							//add current positions
							if (count($this->input->post('positions_id')) > 0) {
								foreach ($this->input->post('positions_id') as $position) {
									$current_position_id = $this->User_model->add_user_current_position(array(
										'users_id' => $user_id,
										'positions_id' => $position,
										'user_current_position_status' => '1'
									));
									if ($position === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_current_positions_id' => $current_position_id,
											'user_current_position_other_name' => $this->input->post('user_current_position_other_name'),
											'user_current_position_other_status' => '1'
												), 'user_current_position_others');
									}
								}
							}
							// add current type ratings
							if (count($this->input->post('my_aircrafts_id')) > 0) {
								foreach ($this->input->post('my_aircrafts_id') as $my_aircraft) {
									$user_aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
										'users_id' => $user_id,
										'my_aircrafts_id' => $my_aircraft,
										'user_aircraft_rating_status' => '1'
									));
									if ($my_aircraft === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_aircraft_ratings_id' => $user_aircraft_rating_id,
											'user_aircraft_rating_aircraft_type_other_name' => $this->input->post('user_aircraft_rating_aircraft_type_other_name'),
											'user_aircraft_rating_aircraft_type_other_status' => '1'
												), 'user_aircraft_rating_aircraft_type_others');
									}
								}
							}
						}
						if ($role === 'maintenance-engineer') {
							$user_license_id = $this->User_model->add_user_licenses(array(
								'users_id' => $user_id,
								'licenses_id' => $this->input->post('licenses_id'),
								'license_authorities_id' => $this->input->post('license_authorities_id'),
								'user_license_expire_date' => '0000-00-00',
								'user_license_status' => '1'
							));
							if ($this->input->post('positions_id') !== '') {
								$user_license_position_id = $this->User_model->add_user_license_positions(array(
									'user_licenses_id' => $user_license_id,
									'positions_id' => $this->input->post('positions_id')
								));
							}
							if ($this->input->post('positions_id') === '0') {
								$this->User_model->add_user_other_data_lookup(array(
									'user_license_positions_id' => $user_license_position_id,
									'user_license_position_other_name' => $this->input->post('user_license_position_other_name'),
									'user_license_position_other_status' => '1'
										), 'user_license_position_others');
							}
							if ($this->input->post('licenses_id') === '0') {
								$this->User_model->add_user_other_data_lookup(array(
									'user_licenses_id' => $user_license_id,
									'user_license_type_other_name' => $this->input->post('user_license_type_other_name'),
									'user_license_type_other_status' => '1'
										), 'user_license_type_others');
							}
							if ($this->input->post('license_authorities_id') === '0') {
								$this->User_model->add_user_other_data_lookup(array(
									'user_licenses_id' => $user_license_id,
									'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name'),
									'user_license_authority_other_status' => '1'
										), 'user_license_authority_others');
							}
							// add aircraft rating
							for ($i = 0; $i < count($this->input->post('type_ratings_id')); $i++) {
								$user_aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
									'users_id' => $user_id,
									'type_ratings_id' => $this->input->post('type_ratings_id')[$i],
									'user_aircraft_rating_is_current' => $this->input->post('user_aircraft_rating_is_current') !== null ? in_array($i, $this->input->post('user_aircraft_rating_is_current')) ? '1' : '0' : '0',
									'user_aircraft_rating_year_of_experience' => $this->input->post('user_aircraft_rating_year_of_experience')[$i],
									'user_aircraft_rating_status' => '1'
								));
								if ($this->input->post('type_ratings_id')[$i] === '0') {
									$this->User_model->add_user_other_data_lookup(array(
										'user_aircraft_ratings_id' => $user_aircraft_rating_id,
										'user_aircraft_rating_type_rating_other_name' => $this->input->post('user_aircraft_rating_type_rating_other_name')[$i],
										'user_aircraft_rating_type_rating_other_status' => '1'
											), 'user_aircraft_rating_type_rating_others');
								}
								if ($this->input->post('user_aircraft_rating_coverage')[$i]) {
									foreach ($this->input->post('user_aircraft_rating_coverage')[$i] as $rating_coverage) {
										$this->User_model->add_user_aircraft_rating_coverage(array(
											'user_aircraft_ratings_id' => $user_aircraft_rating_id,
											'user_aircraft_rating_coverage_name' => $rating_coverage
										));
									}
								}
							}
						}
						if ($role === 'operations' || $role === 'executive' || $role === 'corporate') {
							//add current positions
							if (count($this->input->post('positions_id')) > 0) {
								foreach ($this->input->post('positions_id') as $position) {
									$user_position_id = $this->User_model->add_user_current_position(array(
										'users_id' => $user_id,
										'positions_id' => $position,
										'user_current_position_status' => '1'
									));
									if ($position === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_current_positions_id' => $user_position_id,
											'user_current_position_other_name' => $this->input->post('user_current_position_other_name'),
											'user_current_position_other_status' => '1'
												), 'user_current_position_others');
									}
								}
							}
							//add user skills
							if (count($this->input->post('skills_id')) > 0) {
								foreach ($this->input->post('skills_id') as $skill) {
									$skills_id = $this->User_model->add_user_skill(array(
										'users_id' => $user_id,
										'skills_id' => $skill,
										'user_skill_status' => '1'
									));
									if ($skill === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_skills_id' => $skills_id,
											'user_skill_other_name' => $this->input->post('user_skill_other_name'),
											'user_skill_other_status' => '1'
												), 'user_skill_others');
									}
								}
							}
						}
						if ($role === 'air-traffic-controller') {
							//add license authorities
							$user_license_id = $this->User_model->add_user_licenses(array(
								'users_id' => $user_id,
								'license_authorities_id' => $this->input->post('license_authorities_id'),
								'user_license_expire_date' => '0000-00-00',
								'user_license_status' => '1'
							));
							if ($this->input->post('license_authorities_id') === '0') {
								$this->User_model->add_user_other_data_lookup(array(
									'user_licenses_id' => $user_license_id,
									'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name'),
									'user_license_authority_other_status' => '1'
										), 'user_license_authority_others');
							}
							if ($this->input->post('positions_id') !== '') {
								$user_license_position_id = $this->User_model->add_user_license_positions(array(
									'user_licenses_id' => $user_license_id,
									'positions_id' => $this->input->post('positions_id')
								));
							}
							if ($this->input->post('positions_id') === '0') {
								$this->User_model->add_user_other_data_lookup(array(
									'user_license_positions_id' => $user_license_position_id,
									'user_license_position_other_name' => $this->input->post('user_license_position_other_name'),
									'user_license_position_other_status' => '1'
										), 'user_license_position_others');
							}
							//add Ratings
							if (count($this->input->post('type_ratings_id')) > 0) {
								foreach ($this->input->post('type_ratings_id') as $ratings) {
									$user_rating_id = $this->User_model->add_user_rating(array(
										'users_id' => $user_id,
										'type_ratings_id' => $ratings,
										'user_rating_status' => '1'
									));
									if ($ratings === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_ratings_id' => $user_rating_id,
											'user_rating_other_name' => $this->input->post('user_rating_other_name'),
											'user_rating_other_status' => '1'
												), 'user_rating_others');
									}
								}
							}
						}
						for ($i = 0; $i < count($this->input->post('user_employment_desired_position')); $i++) {
							$user_employment_insert_array = array(
								'users_id' => $user_id,
								'user_employment_desired_position' => $this->input->post('user_employment_desired_position')[$i],
								'user_employment_preferred_company' => $this->input->post('user_employment_preferred_company')[$i],
								'user_employment_type' => $this->input->post('user_employment_type')[$i],
								'user_employment_type_other' => $this->input->post('user_employment_type_other')[$i],
								'user_employment_willing_to_relocate' => $this->input->post('user_employment_willing_to_relocate')[$i],
								'user_employment_availability' => $this->input->post('user_employment_availability') [$i],
								'user_employment_availability_other' => $this->input->post('user_employment_availability_other'),
								'user_employment_status' => '1'
							);
							$user_employment_return_id = $this->User_model->add_user_employment($user_employment_insert_array);
							if (isset($this->input->post('user_employment_location')[$i]) && count($this->input->post('user_employment_location')[$i]) > 0) {
								foreach ($this->input->post('user_employment_location')[$i] as $country_id) {
									$this->User_model->add_user_employment_location(array(
										'user_employments_id' => $user_employment_return_id,
										'countries_id' => $country_id
									));
								}
							}
							if (isset($this->input->post('user_positions_id')[$i]) && count($this->input->post('user_positions_id')[$i]) > 0) {
								foreach ($this->input->post('user_positions_id')[$i] as $position) {
									$user_employment_position_id = $this->User_model->add_user_employment_position(array(
										'users_id' => $user_id,
										'user_employments_id' => $user_employment_return_id,
										'positions_id' => $position,
										'user_employment_position_status' => '1'
									));
									if ($position === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_employment_positions_id' => $user_employment_position_id,
											'user_employment_position_other_name' => $this->input->post('user_employment_position_other_name')[$i],
											'user_employment_position_other_status' => '1'
												), 'user_employment_position_others');
									}
								}
							}
						}
					}
					if ($type === 'employee') {
						$email_details_array = array(
							'user_id' => $user_id,
							'user_first_name' => $this->input->post('user_first_name'),
							'user_last_name' => $this->input->post('user_last_name'),
							'user_email' => $this->input->post('user_email'),
							'user_security_hash' => $user_insert_array['user_security_hash'],
							'user_type' => $type,
							'user_employer_type' => ''
						);
						$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], $user_id, 'Verify Your Email Address', $this->render_view($email_details_array, 'emails', 'emails/templates/employee/register', TRUE));
					} else if ($type === 'employer') {
						$email_details_array = array(
							'user_id' => $user_id,
							'user_first_name' => $this->input->post('user_business_name'),
							'user_last_name' => '',
							'user_type' => $type,
							'user_email' => $this->input->post('user_email'),
							'user_security_hash' => $user_insert_array['user_security_hash'],
							'user_employer_type' => $role
						);
						$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], $user_id, 'Verify Your Email Address', $this->render_view($email_details_array, 'emails', 'emails/templates/employer/register', TRUE));
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), $user_id, 'New User Registration', $this->render_view($email_details_array, 'emails', 'emails/templates/admin_register', TRUE));
					if ($emailid1 > 0 && $emailid2 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
						@file_get_contents(base_url() . 'email/cron/' . $emailid2);
						$user_details_array = $this->Auth_model->login($this->input->post('user_email'));
						$_SESSION['user'] = $user_details_array;
						$this->Auth_model->update_user_login($user_details_array['user_id']);
						$this->Auth_model->add_login_log(array(
							'users_id' => $user_id,
							'login_log_from' => '1',
							'login_log_mode' => 'email',
							'login_log_ip_address' => $this->input->server('REMOTE_ADDR'),
							'login_log_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'login_log_created' => date('Y-m-d H:i:s')
						));
						die('1');
					}
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		if ($type === 'employee') {
			$data['employee_role_array'] = $this->User_model->get_employee_roles_by_job_type_id($job_type_array['job_type_id']);
		}
		$data['notice_period_array'] = $this->notice_period_array;
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['captcha_image'] = parent::create_captcha();
		$data['country_array'] = $this->Auth_model->get_countries();
		if ($type === 'employee') {
			$data['license_authority_array'] = $this->User_model->get_active_license_authorities();
			$data['license_array'] = $this->User_model->get_licenses_by_job_type_id($job_type_array['job_type_id']);
			$data['position_array'] = $this->User_model->get_positions_by_job_type_id($job_type_array['job_type_id']);
			$data['skill_array'] = $this->Job_model->get_skills_by_job_type_id($job_type_array['job_type_id']);
		}
		$data['endorsement_array'] = $this->endorsement_array;
		if ($type === 'employee') {
			$data['type_rating_array'] = $this->User_model->get_active_type_ratings_by_job_type_id($job_type_array['job_type_id'] === '7' ? '7' : '2');
		}
		$data['location_array'] = $this->User_model->get_active_locations();
		$data['user_employment_type_array'] = $this->user_employment_type_array;
		$data['title'] = $role . ' Registration';
		$data['breadcrumb_text'] = $role;
		switch ($type) {
			case 'employee':
				parent::render_view($data, 'common');
				break;
			case 'employer':
				parent::render_view($data, 'common', 'auth/employer_registration');
				break;
			default:
				redirect(base_url() . 'login');
		}
	}

	function verify($user_id, $user_security_hash) {
		$data = array();
		$user_details_array = $this->Auth_model->get_user_by_id_and_security_hash($user_id, $user_security_hash);
		$data['error_message'] = 'Error while verifying email address.';
		if (count($user_details_array) > 0) {
			if ($user_details_array['user_verified'] == '0') {
				$time_now = date('Y-m-d H:i:s');
				$this->load->library('encrypt');
				$password = $this->encrypt->decode($user_details_array['user_password_hash'], $user_details_array['user_login_password']);
				$user_update_array = array(
					'user_security_hash' => md5($time_now . $password),
					'user_verified' => '1',
					'user_status' => '1',
					'user_verified_on' => date('Y-m-d H:i:s'),
					'user_modified' => date('Y-m-d H:i:s'),
				);
				$this->load->model('User_model');
				if ($this->User_model->edit_user_by_user_id($user_id, $user_update_array)) {
					$_SESSION['user'] = $user_details_array;
					$this->Auth_model->update_user_login($user_details_array['user_id']);
					$this->Auth_model->add_login_log(array(
						'users_id' => $user_details_array['user_id'],
						'login_log_from' => '1',
						'login_log_mode' => 'email',
						'login_log_ip_address' => $this->input->server('REMOTE_ADDR'),
						'login_log_user_agent' => $this->input->server('HTTP_USER_AGENT'),
						'login_log_created' => date('Y-m-d H:i:s')
					));
					$user_details_array['password'] = $password;
					if (isset($_SESSION['user'])) {
						parent::regenerate_session();
					}
					if ($user_details_array['group_slug'] === 'employer') {
						$emailid1 = parent::add_email_to_queue('', '', $user_details_array['user_email'], $user_id, 'Welcome to InCrew', $this->render_view($user_details_array, 'emails', 'emails/templates/employer/welcome_email', TRUE));
					} else {
						$emailid1 = parent::add_email_to_queue('', '', $user_details_array['user_email'], $user_id, 'Welcome to InCrew', $this->render_view($user_details_array, 'emails', 'emails/templates/employee/welcome_email', TRUE));
					}
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
						$data['success_message'] = 'Your email address has been verified. Please ensure your profile is complete to be considered for upcoming roles.';
						unset($data['error_message']);
					}
				}
			}
		}
		$data['title'] = 'Email Verification';
		parent::render_view($data);
	}

	function send_verify_link() {
		if (isset($_SESSION['user'])) {
			$emailid1 = parent::add_email_to_queue('', '', $_SESSION['user']['user_email'], $_SESSION['user']['user_id'], 'Verify Your Email Address', $this->render_view($_SESSION['user'], 'emails', 'emails/templates/employee/register', TRUE));
			if ($emailid1 > 0) {
				@file_get_contents(base_url() . 'email/cron/' . $emailid1);
				die('1');
			}
		} else {
			echo 'Please login to your account.';
			die;
		}
		die('0');
	}

	private function user_login() {
		$this->load->helper('cookie');
		if (isset($_SESSION['user']['user_id'])) {
			redirect('dashboard', 'refresh');
			return;
		}
		if (isset($_COOKIE['auto_login'])) {
			$this->load->model('User_model');
			$auto_login = json_decode($_COOKIE['auto_login']);
			$user_details_array = $this->User_model->get_user_by_id($auto_login->user_id);
			if ($user_details_array['user_security_hash'] === $auto_login->user_security_hash) {
				$_SESSION['user'] = $user_details_array;
				$this->Auth_model->update_user_login($user_details_array['user_id']);
				$this->Auth_model->add_login_log(array(
					'users_id' => $user_details_array['user_id'],
					'login_log_from' => '1',
					'login_log_mode' => 'email',
					'login_log_ip_address' => $this->input->server('REMOTE_ADDR'),
					'login_log_user_agent' => $this->input->server('HTTP_USER_AGENT'),
					'login_log_created' => date('Y-m-d H:i:s')
				));
				redirect('dashboard', 'refresh');
			}
		}
		$data = array();
		$this->load->helper('form');
		if ($this->input->post()) {
			if (!isset($_SESSION['login_failed_count'])) {
				$_SESSION['login_failed_count'] = 0;
			}
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_login', 'Email', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('user_login_password', 'Password', 'trim|required');
			if ($_SESSION['login_failed_count'] > 2) {
				$this->form_validation->set_rules('user_captcha', 'Secure Image', 'trim|required|exact_length[6]|numeric|callback_validate_captcha');
			}
			$this->form_validation->set_error_delimiters('<span class = "help-block">', '</span>');
			if ($this->form_validation->run()) {
				$user_details_array = $this->Auth_model->login(base64_decode(base64_decode(trim($this->input->post('user_login')))));
				$this->load->library('encrypt');
				if (count($user_details_array) > 0) {
					if (
							count($user_details_array) > 0 &&
							strtolower(base64_decode(base64_decode($this->input->post('user_login_password')))) === md5(md5(strtolower($this->encrypt->decode($user_details_array['user_password_hash'], $user_details_array['user_login_password']))))
					) {
						if ($this->input->post('login_remember') !== null && $this->input->post('login_remember') == 'true') {
							$autologin = array(
								'user_id' => $user_details_array['user_id'],
								'user_security_hash' => $user_details_array['user_security_hash']
							);
							setcookie('auto_login', json_encode($autologin), time() + (86400 * 15), '/');
						}
						$_SESSION['user'] = $user_details_array;
						$this->Auth_model->update_user_login($user_details_array['user_id']);
						$this->Auth_model->add_login_log(array(
							'users_id' => $user_details_array['user_id'],
							'login_log_from' => '1',
							'login_log_mode' => 'email',
							'login_log_ip_address' => $this->input->server('REMOTE_ADDR'),
							'login_log_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'login_log_created' => date('Y-m-d H:i:s')
						));
						unset($_SESSION['login_failed_count']);
						if (isset($_SESSION['redirect_url']) && $_SESSION['redirect_url'] !== '') {
							$redirect_url = $_SESSION['redirect_url'];
							unset($_SESSION['redirect_url']);
							die($redirect_url);
						}
						die('1');
					} else {
						$_SESSION['login_failed_count'] ++;
						if ($_SESSION['login_failed_count'] > 2) {
							$_SESSION['login_error']['invalid_password'] = TRUE;
							die('-1');
						}
						die('-2');
					}
				} else {
					$_SESSION['login_failed_count'] ++;
					if ($_SESSION['login_failed_count'] > 2) {
						$_SESSION['login_error']['invalid_email'] = TRUE;
						die('-1');
					}
					die('-3');
				}
			} else {
				echo validation_errors();
				die;
			}
			$_SESSION['login_failed_count'] ++;
			if ($_SESSION['login_failed_count'] % 3 === 0) {
				die('-1');
			}
			die('0');
		}
	}

	function login() {
		$this->user_login();
		if (isset($_SESSION['login_failed_count']) && $_SESSION['login_failed_count'] > 2) {
			$data['captcha_image'] = parent::create_captcha();
		}
		$data['title'] = 'Login';
		parent::render_view($data);
	}

	function employee_login() {
		$data = array();
		$this->load->model('Job_model');
		$this->user_login();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		$data['title'] = 'Employee Login';
		if (isset($_SESSION['login_failed_count']) && $_SESSION['login_failed_count'] > 2) {
			$data['captcha_image'] = parent::create_captcha();
		}
		parent::render_view($data);
	}

	function employer_login() {
		$this->user_login();
		$data['title'] = 'Employer Login';
		$this->load->model('Auth_model');
		$data['employer_types_array'] = $this->Auth_model->get_active_employer_types();
		$data['title'] = 'Employer Login';
		if (isset($_SESSION['login_failed_count']) && $_SESSION['login_failed_count'] > 2) {
			$data['captcha_image'] = parent::create_captcha();
		}
		parent::render_view($data);
	}

	function logout() {
		if (isset($_COOKIE['auto_login'])) {
			setcookie('auto_login', NULL, -1, '/');
		}
		$this->load->model('User_model');
		if (isset($_SESSION['user'])) {
			$this->User_model->edit_user_by_user_id($_SESSION['user']['user_id'], array('user_last_logged_out' => date('Y-m-d H:i:s')));
		}
		if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employer') {
			unset($_SESSION['user']);
			redirect('employer-login', 'refresh');
		} else if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] === 'employee') {
			unset($_SESSION['user']);
			redirect('employee-login', 'refresh');
		} else {
			unset($_SESSION['user']);
			redirect('login', 'refresh');
		}
	}

	function validate_email() {
		$this->load->library('form_validation');
		if ($this->input->post('user_email') !== '') {
			if ($this->input->post('user_email')) {
				$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]');
			}
			if ($this->form_validation->run()) {
				die('true');
			}
		}
		die('false');
	}

	function captcha_validate() {
		$this->load->library('form_validation');
		if ($this->input->post('user_captcha') !== '') {
			if ($this->input->post('user_captcha')) {
				$this->form_validation->set_rules('user_captcha', 'Email', 'trim|required|callback_validate_captcha');
			}
			if ($this->form_validation->run()) {
				die('true');
			}
		}
		die('false');
	}

	function recover() {
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email_address', 'email', 'trim|required');
			$this->form_validation->set_rules('user_captcha', 'secure image', 'trim|required|exact_length[6]|numeric|callback_validate_captcha');
			$this->form_validation->set_error_delimiters("", "<br/>");
			if ($this->form_validation->run()) {
				$user_details_array = $this->Auth_model->get_user_by_username_or_email($this->input->post('email_address'));
				if (count($user_details_array) > 0) {
					$new_password = parent::generate_random_string();
					$time_now = date('Y-m-d H:i:s');
					$this->load->library('encrypt');
					$user_update_array = array(
						'user_login_salt' => md5($time_now),
						'user_login_password' => md5(md5(md5($time_now) . $new_password)),
						'user_password_hash' => $this->encrypt->encode($new_password, md5(md5(md5($time_now) . $new_password))),
						'user_security_hash' => md5($time_now . $new_password),
						'user_modified' => $time_now,
						'user_status' => '1',
						'user_verified' => '1',
						'force_change_password' => '1'
					);
					$this->load->model('User_model');
					if ($this->User_model->edit_user_by_user_id($user_details_array['user_id'], $user_update_array)) {
						$email_details_array = array(
							'user_first_name' => $user_details_array['user_first_name'],
							'user_last_name' => $user_details_array['user_last_name'],
							'user_email' => $user_details_array['user_email'],
							'user_login_password' => $new_password
						);
						$email_id = parent::add_email_to_queue('', '', $user_details_array['user_email'], $user_details_array['user_id'], 'Your Account Password', parent::render_view($email_details_array, 'emails', 'emails/templates/forgot_password', TRUE));
						if ($email_id > 0) {
							$file_contents = @file_get_contents(base_url() . 'email/cron/' . $email_id);
							if ($file_contents === '1') {
								die('1');
//								$data['success'] = 'We have sent you an email with your new password.';
							}
						}
					}
				} else {
//					$data['error'] = 'Invalid Email ID!!!';
					die('-1');
				}
			} else {
//				$data['error'] = validation_errors();
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['captcha_image'] = parent::create_captcha();
		$data['title'] = 'Recover Password';
		parent::render_view($data);
	}

	function credentials() {
		parent::allow(array('administrator'));
		$this->load->library('encrypt');
		$this->load->database();
		$this->db->join('job_types', 'job_types.job_type_id = users.job_types_id', 'left');
		$this->db->join('employer_types', 'employer_types.employer_type_id = users.employer_types_id', 'left');
		$this->db->join('groups', 'groups.group_id = users.groups_id', 'left');
		$user_details_array = $this->db->get('users')->result_array();
		$print_array = array();
		foreach ($user_details_array as $key => $user_detail) {
			$print_array[$key] = $user_detail;
			$print_array[$key]['password'] = $this->encrypt->decode($user_detail['user_password_hash'], $user_detail['user_login_password']);
		}
		?>
		<table>
			<tr>
				<th>Username</th>
				<th>Type</th>
				<th>Category</th>
				<th>Email</th>
				<th>Password</th>
			</tr>
			<?php foreach ($print_array as $value) { ?>
				<tr>
					<td><?php echo $value['user_login']; ?></td>
					<td><?php echo $value['group_name']; ?></td>
					<td><?php echo $value['job_type_name'] != '' ? $value['job_type_name'] : $value['employer_type']; ?></td>
					<td><?php echo $value['user_email']; ?></td>
					<td><?php echo $value['password']; ?></td>
				</tr>
			<?php }
			?>
		</table>
		<?php
		die;
	}

}
