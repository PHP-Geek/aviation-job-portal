<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller {

	public $public_methods = array('careers', 'careers_open', 'view', 'update_social_media_share', 'count_views', 'save');
	public $employee_type_array = array('1' => 'Full Time', '2' => 'Contract Basis');
	public $job_pay_tenor_array = array('Weekly', 'Fortnightly', 'Monthly', 'Anually', 'Per Contract');
	public $job_pay_currency = array('USD', 'INR');
	public $job_alert_company_array = array('1' => 'All', '2' => 'Other');
	public $job_alert_employment_array = array('1' => 'Full Time', '2' => 'Contract');

	function __construct() {
		parent::__construct();
		$this->load->model('Job_model');
	}

	function upload_files() {
		parent::upload_files();
	}

	function active_job_datatable() {
		parent::allow(array('employer', 'administrator'));
		$this->load->library('datatables');
		if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'administrator') {
			$this->datatables->where('jobs.users_id=' . $_SESSION['user']['user_id']);
		}
		$this->datatables->where(array('jobs.job_status!=' => '-1', 'jobs.job_expire_date>=' => date('Y-m-d')));
		$this->datatables->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->datatables->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		$this->datatables->join('job_applications', 'job_applications.jobs_id=jobs.job_id', 'left');
		$this->datatables->order_by('job_post_date', 'desc');
		$this->datatables->select("job_id,CONCAT('<h4><a class=active_job_title href=" . base_url() . "job/view/',job_slug,'/',job_id,' target=_blank>',job_title,'</a></h4>',job_company_name) AS job_desc,job_type_name,country_name,IF(job_employee_type = 1,'Full Time','Contract Basis') AS employee_type,DATE_FORMAT(job_post_date,'%d %M %Y') AS post_date,IF(count(job_application_id)=0,'-',count(job_application_id)) AS job_application_count", FALSE)->group_by('job_id')->from('jobs');
		echo $this->datatables->generate();
	}

	function expired_job_datatable() {
		parent::allow(array('employer', 'administrator'));
		$this->load->library('datatables');
		if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'administrator') {
			$this->datatables->where('jobs.users_id=' . $_SESSION['user']['user_id']);
		}
		$this->datatables->where(array('jobs.job_status!=' => '-1', 'jobs.job_expire_date<' => date('Y-m-d')));
		$this->datatables->join('countries', 'countries.country_id=jobs.countries_id', 'left');
		$this->datatables->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		$this->datatables->join('job_applications', 'job_applications.jobs_id=jobs.job_id', 'left');
		$this->datatables->order_by('job_post_date', 'desc');
		$this->datatables->select("job_id,CONCAT('<h4><a class=active_job_title href=" . base_url() . "job/view/',job_slug,'/',job_id,' target=_blank>',job_title,'</a></h4>',job_company_name) AS job_desc,job_type_name,country_name,IF(job_employee_type = 1,'Full Time','Contract Basis') AS employee_type,DATE_FORMAT(job_post_date,'%d %M %Y') AS post_date,IF(count(job_application_id)=0,'-',count(job_application_id)) AS job_application_count", TRUE)->group_by('job_id')->from('jobs');
		echo $this->datatables->generate();
	}

	function index() {
		parent::allow(array('employer', 'administrator'));
		$data = array();
		$data['active_job_array'] = $this->Job_model->get_job_by_user_id();
		foreach ($data['active_job_array'] as $key => $job_details) {
			$data['active_job_array'][$key]['job_employee_type'] = $this->employee_type_array[$job_details['job_employee_type']];
			$data['active_job_array'][$key]['licenses_id'] = $job_details['licenses_id'];
			$data['active_job_array'][$key]['job_applicant_count'] = $this->Job_model->count_job_applications_by_job_id($job_details['job_id']);
		}
		$data['expired_job_array'] = $this->Job_model->get_job_by_user_id('true');
		foreach ($data['expired_job_array'] as $key => $job_details) {
			$data['expired_job_array'][$key]['job_employee_type'] = $this->employee_type_array[$job_details['job_employee_type']];
			$data['expired_job_array'][$key]['job_applicant_count'] = $this->Job_model->count_job_applications_by_job_id($job_details['job_id']);
		}
		$data['title'] = 'View Job';
		parent::render_view($data, 'common');
	}

	function request_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'job_types.job_type_id=jobs.job_types_id');
		$this->datatables->where('jobs.job_status', '0');
		$this->datatables->select("job_id, CONCAT('" . base_url() . "uploads/jobs/company_logos', DATE_FORMAT(job_created, '/%Y/%m/%d/%H/%i/%s/'), job_company_logo) as image_url, job_type_name, job_title, job_contact_email, job_company_name, IF(job_employee_type = '1', 'Full Time', 'Contract Basis') as employee_type, job_details", FALSE)->from('jobs');
		echo $this->datatables->generate();
	}

	function requests() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('1');
		parent::render_view($data, '');
	}

	function response() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->load->model('Configuration_model');
		$this->load->model('User_model');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('job_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			$job_array = $this->Job_model->get_job_by_id($this->input->post('job_id'));
			if (count($job_array) > 0) {
				$subject = 'Job Approved';
				$job_array['job_state'] = '1';
				if ($this->input->post('job_status') === '0') {
					$subject = 'Job Rejected';
					$job_array['job_state'] = '0';
					$job_array['job_rejected_reason'] = $this->input->post('job_reject_reason');
				} else {
					//Send job alert notification to subscribed users
					$job_alert_array = $this->User_model->get_job_alert_by_job_type_id($job_array['job_types_id']);
					if (count($job_alert_array) > 0) {
						foreach ($job_alert_array as $job_alert) {
							$email_details_array['user_first_name'] = $job_alert['user_first_name'];
							$email_details_array['job_title'] = $job_array['job_title'];
							$email_details_array['job_slug'] = $job_array['job_slug'];
							$email_details_array['job_id'] = $job_array['job_id'];
							$email_details_array['job_location'] = $job_array['country_name'];
							$email_details_array['job_type'] = $job_array['job_type_name'];
							$email_details_array['job_employee_type'] = $job_array['job_employee_type'];
							$email_id = parent::add_email_to_queue('', '', $job_alert['user_email'], $job_alert['user_id'], 'InCrew Job Alert', $this->render_view($email_details_array, 'emails', 'emails/templates/job_alert', TRUE));
							if ($email_id > 0) {
								@file_get_contents(base_url() . 'email/cron/' . $email_id);
							}
						}
					}
				}
				//Send conditional emails to employer between specified times
				$configuration = $this->Configuration_model->get_configuration_by_id('3');
				if ($configuration['configuration_email_status'] === '1') {
					if (strtotime($configuration['configuration_email_from']) >= strtotime(date('H:i:s'))) {
						$emailid1 = parent::add_email_to_queue('', '', $job_array['job_contact_email'], $_SESSION['user']['user_id'], $subject, $this->render_view($job_array, 'emails', 'emails/templates/job_approve', TRUE), array(), array(), array(), date('Y-m-d ') . $configuration['configuration_email_from']);
					} else if (strtotime($configuration['configuration_email_to']) <= strtotime(date('H:i:s'))) {
						$emailid1 = parent::add_email_to_queue('', '', $job_array['job_contact_email'], $_SESSION['user']['user_id'], $subject, $this->render_view($job_array, 'emails', 'emails/templates/job_approve', TRUE), array(), array(), array(), date('Y-m-d', strtotime("+1 day")) . ' ' . $configuration['configuration_email_from']);
					} else {
						$emailid1 = parent::add_email_to_queue('', '', $job_array['job_contact_email'], $_SESSION['user']['user_id'], $subject, $this->render_view($job_array, 'emails', 'emails/templates/job_approve', TRUE));
						if ($emailid1 > 0) {
							@file_get_contents(base_url() . 'email/cron/' . $email_id);
						}
					}
					die('1');
				} else {
					$emailid1 = parent::add_email_to_queue('', '', $job_array['job_contact_email'], $_SESSION['user']['user_id'], $subject, $this->render_view($job_array, 'emails', 'emails/templates/job_approve', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $email_id);
						die('1');
					}
				}
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_status() {
		parent::allow(array('employer', 'administrator'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('job_status', 'Job Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Job_model->edit_job_by_id(array(
						'job_status' => $this->input->post('job_status'),
						'job_modified' => date('Y-m-d H:i:s')
							), $this->input->post('job_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function application_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('jobs', 'jobs.job_id=job_applications.jobs_id');
		$this->datatables->join('job_types', 'job_types.job_type_id=jobs.job_types_id');
		$this->datatables->join('users', 'users.user_id=job_applications.users_id');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id');
		$this->datatables->where('job_applications.job_application_status', '0');
		$this->datatables->select("job_application_id, CONCAT('" . base_url() . "uploads/jobs/company_logos', DATE_FORMAT(job_created, '/%Y/%m/%d/%H/%i/%s/'), job_company_logo) as image_url, job_title, job_type_name, job_company_name, job_post_date, job_expire_date, job_start_date, job_details, CONCAT(user_first_name, ' ', user_last_name) as user_name, country_name, CONCAT(user_first_name, '-', user_last_name, '/', user_id) as user_url", FALSE)->from('job_applications');
		echo $this->datatables->generate();
	}

	function applications() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_application_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_application_id', 'Job Application ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('job_application_status', 'Application Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Job_model->edit_job_application_by_id($this->input->post('job_application_id'), array('job_application_status' => $this->input->post('job_application_status')))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function get_job() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_application_id', 'Job Application ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$job_application_array = $this->Job_model->get_job_application_by_id($this->input->post('job_application_id'));
			parent::json_output($job_application_array);
		}
	}

	function careers() {
		$data = array();
		$data['job_type_array'] = $this->Job_model->get_active_job_types();
		$data['title'] = 'Careers';
		parent::render_view($data, 'common');
	}

	function careers_open($job_type_slug = '', $data_limit = 0) {
		$data = array();
		$this->load->model('Configuration_model');
		$this->load->model('Advertisement_model');
		$job_type_array = $this->Job_model->get_job_type_by_slug($job_type_slug);
		if (count($job_type_array) < 1) {
			redirect(base_url() . 'careers');
		}
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'job/careers_open/' . $job_type_slug;
		$total_rows = $this->Job_model->count_jobs_by_job_type_id($job_type_array['job_type_id']);
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = "<ul class = 'pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class = 'disabled'><li class = 'active'><a href = '#'>";
		$config['cur_tag_close'] = "<span class = 'sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['page_links'] = $this->pagination->create_links();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['jobs_array'] = $this->Job_model->get_jobs_by_job_type_id($job_type_array['job_type_id'], $config['per_page'], $page);
		if (isset($_SESSION['user'])) {
			foreach ($data['jobs_array'] as $key => $job) {
				$job_apply_array = $this->Job_model->get_job_applications_by_job_id($job['job_id'], $_SESSION['user']['user_id']);
				if (count($job_apply_array) > 0) {
					$data['jobs_array'][$key]['job_applied_status'] = '1';
				}
			}
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
			if ($this->form_validation->run()) {
				if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
					$job_application_array = $this->Job_model->get_job_application_by_job_id_and_user_id($this->input->post('job_id'), $_SESSION['user']['user_id']);
					if (count($job_application_array) === 0) {
						if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee') {
							if (isset($_SESSION['user']) && $_SESSION['user']['user_verified'] === '1') {
								if (isset($_SESSION['user']) && isset($_SESSION['user']['user_profile_completeness']) && $_SESSION['user']['user_profile_completeness'] >= 15) {
									if ($this->Job_model->add_job_application(array(
												'jobs_id' => $this->input->post('job_id'),
												'users_id' => $_SESSION['user']['user_id'],
												'job_application_status' => '0',
												'job_application_created' => date('Y-m-d H:i:s')
											))) {
										$job_array = $this->Job_model->get_job_by_id($this->input->post('job_id'));
										$job_array['user_name'] = $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name'];
										$email_id = parent::add_email_to_queue('', '', $_SESSION['user']['user_email'], $_SESSION['user']['user_id'], 'Job Applied', $this->render_view($job_array, 'emails', 'emails/templates/job_applied', TRUE));
										if ($email_id > 0) {
											@file_get_contents(base_url() . 'email/cron/' . $email_id);
											die('1');
										}
									}
								} else {
									$this->session->set_flashdata('profile_complete_warning', 'Your profile is only ' . $_SESSION['user']['user_profile_completeness'] . '% completed. Please update your profile to take advantage of the best opportunities around.');
									die('-1');
								}
							} else {
								die('3');
							}
						}
					} else {
						die('2');
					}
				} else {
					$_SESSION['redirect_url'] = base_url(uri_string());
					die;
				}
				die('0');
			} else {
				echo validation_errors();
				die;
			}
		}
		$data['title'] = $job_type_array['job_type_name'] . ' Jobs';
		$data['job_type'] = $job_type_array['job_type_name'];
		$result_array = array();
		if ($this->Configuration_model->get_configuration_by_id('6')['configuration_value'] === '1') {
			$current_page = ($data_limit / 10) + 1;
			$ads_per_page = 3;
			$ads_array = $this->Advertisement_model->get_active_advertisements();
			$count = count($ads_array);
			$start = ((($current_page - 1 ) * $ads_per_page) % $count);
			$end = $start + $ads_per_page - 1;
			$x = 0;
			for ($i = 0; $i <= $end; $i++, $x++) {
				if ($i >= $start && $i <= $end) {
					if ($x >= $count) {
						$x = 0;
					}
					$result_array[] = $ads_array[$x];
				}
			}
		}
		$data['advertisement_array'] = $result_array;
		parent::render_view($data, 'common');
	}

	function view($job_slug = '', $job_id = '') {
		$data = array();
		$data['job_detail_array'] = $this->Job_model->get_job_by_id($job_id);
		if (count($data['job_detail_array']) === 0 || $job_slug != $data['job_detail_array']['job_slug']) {
			redirect(base_url() . 'careers');
		}
		if ($this->Job_model->add_job_view_log(array(
					'jobs_id' => $job_id,
					'users_id' => isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : '0',
					'job_view_log_ip_address' => $this->input->server('REMOTE_ADDR'),
					'job_view_log_user_agent' => $this->input->server('HTTP_USER_AGENT'),
					'job_view_log_created' => date('Y-m-d H:i:s')
				))) {
			if ($this->Job_model->edit_job_by_id(array(
						'job_view_count' => $data['job_detail_array']['job_view_count'] + 1,
						'job_modified' => date('Y-m-d H:i:s')
							), $job_id)) {
				if (isset($_SESSION['user'])) {
					$job_apply_array = $this->Job_model->get_job_applications_by_job_id($job_id, $_SESSION['user']['user_id']);
					if (count($job_apply_array) > 0) {
						$data['job_detail_array']['job_applied_status'] = '1';
					}
				}
			}
			if ($this->input->post()) {
				if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
					$job_application_array = $this->Job_model->get_job_application_by_job_id_and_user_id($job_id, $_SESSION['user']['user_id']);
					if (count($job_application_array) === 0) {
						if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee') {
							if (isset($_SESSION['user']) && $_SESSION['user']['user_verified'] === '1') {
								if (isset($_SESSION['user']) && isset($_SESSION['user']['user_profile_completeness']) && $_SESSION['user']['user_profile_completeness'] >= 15) {
									if ($this->Job_model->add_job_application(array(
												'jobs_id' => $job_id,
												'users_id' => $_SESSION['user']['user_id'],
												'job_application_status' => '0',
												'job_application_created' => date('Y-m-d H:i:s')
											))) {
										$job_array = $this->Job_model->get_job_by_id($this->input->post('job_id'));
										$job_array['user_name'] = $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name'];
										$email_id = parent::add_email_to_queue('', '', $_SESSION['user']['user_email'], $_SESSION['user']['user_id'], 'Job Applied', $this->render_view($job_array, 'emails', 'emails/templates/job_applied', TRUE));
										if ($email_id > 0) {
											@file_get_contents(base_url() . 'email/cron/' . $email_id);
											die('1');
										}
									}
								} else {
									$this->session->set_flashdata('profile_complete_warning', 'Your profile is only ' . $_SESSION['user']['user_profile_completeness'] . '% completed. Please update your profile to take advantage of the best opportunities around.');
									die('-1');
								}
							} else {
								die('3');
							}
						}
					} else {
						die('2');
					}
				} else {
					$_SESSION['redirect_url'] = base_url(uri_string());
					die;
				}
				die('0');
			}
		}
		$data['job_detail_array']['job_saved_status'] = '0';
		if (isset($_SESSION['user']) && count($_SESSION['user']) > 0 && $_SESSION['user']['group_slug'] === 'employee') {
			$user_saved_job_array = $this->Job_model->get_saved_job_by_user_id_and_job_id($job_id, $_SESSION['user']['user_id']);
			if (count($user_saved_job_array) > 0) {
				$data['job_detail_array']['job_saved_status'] = '1';
			}
		}
		$data['title'] = $data['job_detail_array']['job_title'] . ' in ' . $data['job_detail_array']['country_name'];
		parent::render_view($data, 'common');
	}

	function save() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('job_slug', 'Job slug', 'trim|required');
		if ($this->form_validation->run()) {
			if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
				if (isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee') {
					$user_saved_job_array = $this->Job_model->get_saved_job_by_user_id_and_job_id($this->input->post('job_id'), $_SESSION['user']['user_id']);
					if (count($user_saved_job_array) === 0) {
						if ($this->Job_model->add_saved_job(array(
									'users_id' => $_SESSION['user']['user_id'],
									'jobs_id' => $this->input->post('job_id'),
									'saved_job_status' => '1',
									'saved_job_created' => date('Y-m-d H:i:s')
								))) {
							die('1');
						}
					} else {
						echo 'Job already saved.';
						die;
					}
				} else {
					die('-2');
				}
			} else {
				$_SESSION['redirect_url'] = base_url() . 'job/view/' . $this->input->post('job_slug') . '/' . $this->input->post('job_id');
				die('-1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function post() {
		parent::allow(array('employer', 'administrator'));
		$data = array();
		$this->load->model('Aircraft_model');
		$this->load->model('Auth_model');
		$this->load->model('User_model');
		$this->load->model('Configuration_model');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_contact_email', 'Contact Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('job_contact_number', 'Contact number', 'trim|required');
			$this->form_validation->set_rules('job_company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('job_company_description', 'Comany Description', 'trim|required');
			$this->form_validation->set_rules('job_post_date', 'Job Post Date', 'required');
			$this->form_validation->set_rules('job_expire_date', 'Job Expire Date', 'required');
			$this->form_validation->set_rules('job_types_id', 'Job Category', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('job_title', 'Job Title', 'trim|required');
			$this->form_validation->set_rules('job_employee_type', 'Employee Type', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('job_start_date', 'Job Start Date', 'required');
			if ($this->input->post('job_types_id') === '1' || $this->input->post('job_types_id') === '2') {
				$this->form_validation->set_rules('my_aircrafts_id', 'Aircraft', 'required|is_natural_no_zero');
				$this->form_validation->set_rules('licenses_id', 'license Type', 'required');
			}
			$this->form_validation->set_rules('countries_id', 'Job Location', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('job_pay_currency', 'Currency', 'trim|required');
			$this->form_validation->set_rules('job_pay_amount', 'Job Pay', 'is_numeric|required');
			$this->form_validation->set_rules('job_pay_tenor', 'Tenor', 'trim|required');
			$this->form_validation->set_rules('job_details', 'Job Details', 'trim|required');
			$this->form_validation->set_rules('job_notification', 'Notification Type', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('job_benifit_package', 'Employee Benifit Package', 'trim|required');
			$this->form_validation->set_rules('job_requirements', 'Job Requirements', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$image_upload_directory = FCPATH . 'uploads/jobs/company_logos' . date('/Y/m/d/H/i/s', strtotime($time_now));
				if (!is_dir($image_upload_directory)) {
					mkdir($image_upload_directory, 0777, TRUE);
				}
				$company_logo = $this->input->post('job_company_logo');
				if (is_file(FCPATH . 'uploads/' . $company_logo)) {
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $company_logo);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size) / 2;
						$crop_image_y_size = 0;
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size) / 2;
						$crop_image_x_size = 0;
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $company_logo, $image_upload_directory . '/' . $company_logo, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image($image_upload_directory . '/' . $company_logo, $image_upload_directory . '/' . $company_logo, 260, 250)) {
							$job_insert_array = array(
								'job_types_id' => $this->input->post('job_types_id'),
								'users_id' => $_SESSION['user']['user_id'],
								'job_contact_email' => $this->input->post('job_contact_email'),
								'job_contact_number' => $this->input->post('job_contact_number'),
								'job_company_name' => $this->input->post('job_company_name'),
								'job_company_description' => nl2br($this->input->post('job_company_description')),
								'job_company_logo' => $company_logo,
								'job_company_logo_original_name' => $this->input->post('job_company_logo_original_name'),
								'job_post_date' => parent::input_date_to_mysql_date($this->input->post('job_post_date')),
								'job_expire_date' => parent::input_date_to_mysql_date($this->input->post('job_expire_date')),
								'job_title' => $this->input->post('job_title'),
								'job_slug' => strtolower($this->change_spec_char($this->input->post('job_title'))),
								'job_employee_type' => $this->input->post('job_employee_type'),
								'job_start_date' => parent::input_date_to_mysql_date($this->input->post('job_start_date')),
								'my_aircrafts_id' => $this->input->post('my_aircrafts_id'),
								'job_company_website' => $this->input->post('job_company_website'),
								'licenses_id' => $this->input->post('licenses_id'),
								'countries_id' => $this->input->post('countries_id'),
								'job_pay_currency' => $this->input->post('job_pay_currency'),
								'job_pay_amount' => $this->input->post('job_pay_amount'),
								'job_pay_tenor' => $this->input->post('job_pay_tenor'),
								'job_details' => nl2br($this->input->post('job_details')),
								'job_benifit_package' => nl2br($this->input->post('job_benifit_package')),
								'job_requirements' => nl2br($this->input->post('job_requirements')),
								'job_notification' => $this->input->post('job_notification'),
								'job_created' => $time_now
							);
							$this->load->model('Configuration_model');
							$job_to_approve = $this->Configuration_model->get_configuration_by_id('1');
							if ($job_to_approve['configuration_value'] === '1' && $_SESSION['user']['group_slug'] !== 'administrator') {
								$job_insert_array['job_status'] = '0';
							} else {
								$job_insert_array['job_status'] = '1';
							}
							$job_insert_id = $this->Job_model->add($job_insert_array);
							if ($job_insert_id > 0) {
								$email_details_array = array(
									'job_contact_email' => $this->input->post('job_contact_email'),
									'job_title' => $this->input->post('job_title'),
									'job_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('job_title')))),
									'job_location' => $this->Job_model->get_country_by_id($this->input->post('countries_id'))['country_name'],
									'job_type' => $this->Job_model->get_job_type_by_id($this->input->post('job_types_id'))['job_type_name'],
									'job_employee_type' => $this->input->post('job_employee_type')
								);
								$email_details_array['job_id'] = $job_insert_id;
								//Send email notification to subscribed users if approval process is off.
								if ($job_insert_array['job_status'] === '1') {
									$this->load->model('User_model');
									$job_alert_array = $this->User_model->get_job_alert_by_job_type_id($this->input->post('job_types_id'));
									if (count($job_alert_array) > 0) {
										foreach ($job_alert_array as $job_alert) {
											$email_details_array['user_first_name'] = $job_alert['user_first_name'];
											$email_id = parent::add_email_to_queue('', '', $job_alert['user_email'], $job_alert['user_id'], 'InCrew Job Alert', $this->render_view($email_details_array, 'emails', 'emails/templates/job_alert', TRUE));
											if ($email_id > 0) {
												@file_get_contents(base_url() . 'email/cron/' . $email_id);
											}
										}
									}
								}
								//Send conditional emails to employer between selected times.
								$configuration = $this->Configuration_model->get_configuration_by_id('3');
								if ($configuration['configuration_email_status'] === '1') {
									if (strtotime($configuration['configuration_email_from']) >= strtotime(date('H:i:s'))) {
										$emailid1 = parent::add_email_to_queue('', '', $email_details_array['job_contact_email'], $_SESSION['user']['user_id'], 'New Job Posted', $this->render_view($email_details_array, 'emails', 'emails/templates/job_post', TRUE), array(), array(), array(), date('Y-m-d ') . $configuration['configuration_email_from']);
									} else if (strtotime($configuration['configuration_email_to']) <= strtotime(date('H:i:s'))) {
										$emailid1 = parent::add_email_to_queue('', '', $email_details_array['job_contact_email'], $_SESSION['user']['user_id'], 'New Job Posted', $this->render_view($email_details_array, 'emails', 'emails/templates/job_post', TRUE), array(), array(), array(), date('Y-m-d', strtotime("+1 day")) . ' ' . $configuration['configuration_email_from']);
									} else {
										$emailid1 = parent::add_email_to_queue('', '', $email_details_array['job_contact_email'], $_SESSION['user']['user_id'], 'New Job Posted', $this->render_view($email_details_array, 'emails', 'emails/templates/job_post', TRUE));
										if ($emailid1 > 0) {
											@file_get_contents(base_url() . 'email/cron/' . $emailid1);
										}
									}
								} else {
									$emailid1 = parent::add_email_to_queue('', '', $email_details_array['job_contact_email'], $_SESSION['user']['user_id'], 'New Job Posted', $this->render_view($email_details_array, 'emails', 'emails/templates/job_post', TRUE));
									if ($emailid1 > 0) {
										@file_get_contents(base_url() . 'email/cron/' . $emailid1);
									}
								}
								//send email to admin
								$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), $_SESSION['user']['user_id'], 'New Job Posted', $this->render_view($email_details_array, 'emails', 'emails/templates/job_post', TRUE));
								if ($emailid2 > 0) {
									@file_get_contents(base_url() . 'email/cron/' . $emailid1);
								}
								unlink(FCPATH . 'uploads/' . $company_logo);
								if ($job_to_approve['configuration_value'] === '1' && $_SESSION['user']['group_slug'] !== 'administrator') {
									die('1');
								} else {
									die('0');
								}
							}
						}
					}
				}
			} else {
				echo validation_errors();
				die;
			}
			die('-1');
		}
		$data['job_pay_tenor_array'] = $this->job_pay_tenor_array;
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['job_category_array'] = $this->Job_model->get_job_categories();
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['employee_type_array'] = $this->employee_type_array;
		$data['license_array'] = $this->User_model->get_active_licenses();
		$data['repost_job_array'] = $this->Job_model->get_expired_job();
		$data['currency_array'] = $this->job_pay_currency;
		$data['user_details_array'] = $this->User_model->get_user_by_id($_SESSION['user']['user_id']);
		$data['title'] = 'Post Job';
		parent::render_view($data, 'common');
	}

	function edit($job_id = '') {
		parent::allow(array('employer', 'administrator'));
		$data = array();
		$this->load->model('Aircraft_model');
		$this->load->model('Auth_model');
		$this->load->model('User_model');
		$data['job_array'] = $this->Job_model->get_job_by_id($job_id);
		if ($job_id != '' && count($data['job_array']) > 0 && ($data['job_array']['users_id'] === $_SESSION['user']['user_id'] || $_SESSION['user']['group_slug'] === 'administrator')) {
			if ($this->input->post()) {
				$this->load->library('form_validation');
				$this->load->library('form_validation');
				$this->form_validation->set_rules('job_contact_email', 'Contact Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('job_contact_number', 'Contact number', 'trim|required');
				$this->form_validation->set_rules('job_company_name', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('job_company_description', 'Comany Description', 'trim|required');
				$this->form_validation->set_rules('job_post_date', 'Job Post Date', 'required');
				$this->form_validation->set_rules('job_expire_date', 'Job Expire Date', 'required');
				$this->form_validation->set_rules('job_types_id', 'Job Category', 'required|is_natural_no_zero');
				$this->form_validation->set_rules('job_title', 'Job Title', 'trim|required');
				$this->form_validation->set_rules('job_employee_type', 'Employee Type', 'required|is_natural_no_zero');
				$this->form_validation->set_rules('job_start_date', 'Job Start Date', 'required');
				if ($this->input->post('job_types_id') === '1' || $this->input->post('job_types_id') === '2') {
					$this->form_validation->set_rules('my_aircrafts_id', 'Aircraft', 'required|is_natural_no_zero');
					$this->form_validation->set_rules('licenses_id', 'license Type', 'required');
				}
				$this->form_validation->set_rules('countries_id', 'Job Location', 'trim|required|is_natural_no_zero');
				$this->form_validation->set_rules('job_pay_currency', 'Currency', 'trim|required');
				$this->form_validation->set_rules('job_pay_amount', 'Job Pay', 'is_numeric|required');
				$this->form_validation->set_rules('job_pay_tenor', 'Tenor', 'trim|required');
				$this->form_validation->set_rules('job_details', 'Job Details', 'trim|required');
				$this->form_validation->set_rules('job_notification', 'Notification Type', 'required|is_natural_no_zero');
				$this->form_validation->set_rules('job_benifit_package', 'Employee Benifit Package', 'trim|required');
				$this->form_validation->set_rules('job_requirements', 'Job Requirements', 'trim|required');
				if ($this->form_validation->run()) {
					$image_upload_directory = FCPATH . 'uploads/jobs/company_logos' . date('/Y/m/d/H/i/s/', strtotime($data['job_array']['job_created']));
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, TRUE);
					}
					$company_logo = $this->input->post('job_company_logo');
					if (is_file(FCPATH . 'uploads/' . $company_logo)) {
						$image_size_array = getimagesize(FCPATH . 'uploads/' . $company_logo);
						$image_x_size = $image_size_array[0];
						$image_y_size = $image_size_array[1];
						$crop_measure = min($image_x_size, $image_y_size);
						if ($image_x_size > $image_y_size) {
							$crop_image_x_size = ($image_x_size - $image_y_size) / 2;
							$crop_image_y_size = 0;
						} else {
							$crop_image_y_size = ($image_y_size - $image_x_size) / 2;
							$crop_image_x_size = 0;
						}
						if (parent::crop_image(FCPATH . 'uploads/' . $company_logo, $image_upload_directory . '/' . $company_logo, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
							if (parent::resize_image($image_upload_directory . '/' . $company_logo, $image_upload_directory . '/' . $company_logo, 260, 250)) {
								unlink(FCPATH . 'uploads/' . $company_logo);
							}
						}
					}
					$job_update_array = array(
						'job_types_id' => $this->input->post('job_types_id'),
						'job_contact_email' => $this->input->post('job_contact_email'),
						'job_contact_number' => $this->input->post('job_contact_number'),
						'job_company_name' => $this->input->post('job_company_name'),
						'job_company_description' => nl2br($this->input->post('job_company_description')),
						'job_company_logo' => $company_logo,
						'job_company_logo_original_name' => $this->input->post('job_company_logo_original_name'),
						'job_post_date' => parent::input_date_to_mysql_date($this->input->post('job_post_date')),
						'job_expire_date' => parent::input_date_to_mysql_date($this->input->post('job_expire_date')),
						'job_title' => $this->input->post('job_title'),
						'job_slug' => strtolower($this->change_spec_char($this->input->post('job_title'))),
						'job_employee_type' => $this->input->post('job_employee_type'),
						'job_start_date' => parent::input_date_to_mysql_date($this->input->post('job_start_date')),
						'my_aircrafts_id' => $this->input->post('my_aircrafts_id'),
						'job_company_website' => $this->input->post('job_company_website'),
						'licenses_id' => $this->input->post('licenses_id'),
						'countries_id' => $this->input->post('countries_id'),
						'job_pay_currency' => $this->input->post('job_pay_currency'),
						'job_pay_amount' => $this->input->post('job_pay_amount'),
						'job_pay_tenor' => $this->input->post('job_pay_tenor'),
						'job_details' => nl2br($this->input->post('job_details')),
						'job_requirements' => nl2br($this->input->post('job_requirements')),
						'job_benifit_package' => nl2br($this->input->post('job_benifit_package')),
						'job_notification' => $this->input->post('job_notification'),
						'job_modified' => date('Y-m-d H:i:s')
					);
					if ($this->Job_model->edit_job_by_id($job_update_array, $job_id)) {
						die('1');
					}
				} else {
					echo validation_errors();
					die;
				}
				die('0');
			}
		} else {
			redirect(base_url() . 'dashboard');
		}
		$data['job_pay_tenor_array'] = $this->job_pay_tenor_array;
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['job_category_array'] = $this->Job_model->get_job_categories();
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['employee_type_array'] = $this->employee_type_array;
		$data['license_array'] = $this->User_model->get_active_licenses();
		$data['currency_array'] = $this->job_pay_currency;
		$data['title'] = 'Edit Job';
		parent::render_view($data, 'common');
	}

	function delete() {
		parent::allow(array('employer'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Job_model->edit_job_by_id(array('job_status' => '-1'), $this->input->post('job_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function view_applicants($job_id = '') {
		parent::allow(array('employer', 'administrator'));
		$data = array();
		if ($job_id !== '') {
			$data['job_details_array'] = $this->Job_model->get_job_by_id($job_id);
			$data['job_application_array'] = $this->Job_model->get_job_applications_by_job_id($job_id);
		} else {
			redirect('job');
		}
		parent::render_view($data, 'common');
	}

	function job_applied_datatable() {
		parent::allow(array('employee', 'administrator'));
		$data = array();
		$this->load->library('Datatables');
		$this->datatables->join('jobs', 'jobs.job_id=job_applications.jobs_id');
		$this->datatables->join('countries', 'countries.country_id=jobs.countries_id');
		$this->datatables->join('users', 'users.user_id=job_applications.users_id');
		$this->datatables->where('job_applications.users_id', $_SESSION['user']['user_id']);
		$this->datatables->order_by('job_application_created', 'desc');
		$this->datatables->select("job_id, CONCAT('" . base_url() . "uploads/jobs/company_logos', DATE_FORMAT(job_created, '/%Y/%m/%d/%H/%i/%s/'), job_company_logo) as image_url, job_title, job_company_name, country_name, DATE_FORMAT(job_application_created, '%m-%b-%Y')", FALSE)->from('job_applications');
		echo $this->datatables->generate();
	}

	function jobs_applied_dashboard() {
		parent::allow(array('employee'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_application_id', 'Job Application ID', 'trim|required|is_natural_no_zero');
			if ($this->form_validation->run()) {
				if ($this->Job_model->edit_job_application_by_id($this->input->post('job_application_id'), array('job_application_status' => '-1'))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
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
		$data['applied_job_array'] = $this->Job_model->get_job_application_by_user_id($_SESSION['user']['user_id'], '', '', '1');
		$data['saved_job_array'] = $this->Job_model->get_saved_job_by_user_id($_SESSION['user']['user_id']);
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($_SESSION['user']['user_id']);
		foreach ($data['saved_job_array'] as $key => $saved_job) {
			$data['saved_job_array'][$key]['job_applied'] = '0';
			if (count($this->Job_model->get_job_application_by_job_id_and_user_id($saved_job['job_id'], $_SESSION['user']['user_id'])) > 0) {
				$data['saved_job_array'][$key]['job_applied'] = '1';
			}
		}
		$data['user_details_array'] = $_SESSION['user'];
		parent::render_view($data, 'common');
	}

	function delete_saved_job() {
		parent::allow(array('employee'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('saved_job_id', 'Saved Job ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Job_model->edit_saved_job_by_id(array('saved_job_status' => '-1'), $this->input->post('saved_job_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function apply() {
		parent::allow(array('employee'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if (isset($_SESSION['user']) && count($_SESSION['user']) > 0) {
				$job_application_array = $this->Job_model->get_job_application_by_job_id_and_user_id($this->input->post('job_id'), $_SESSION['user']['user_id']);
				if (count($job_application_array) === 0) {
					if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employee') {
						if (isset($_SESSION['user']) && $_SESSION['user']['user_verified'] === '1') {
							if (isset($_SESSION['user']) && isset($_SESSION['user']['user_profile_completeness']) && $_SESSION['user']['user_profile_completeness'] >= 15) {
								if ($this->Job_model->add_job_application(array(
											'jobs_id' => $this->input->post('job_id'),
											'users_id' => $_SESSION['user']['user_id'],
											'job_application_status' => '0',
											'job_application_created' => date('Y-m-d H:i:s')
										))) {
									$job_array = $this->Job_model->get_job_by_id($this->input->post('job_id'));
									$job_array['user_name'] = $_SESSION['user']['user_first_name'] . ' ' . $_SESSION['user']['user_last_name'];
									$email_id = parent::add_email_to_queue('', '', $_SESSION['user']['user_email'], $_SESSION['user']['user_id'], 'Job Applied', $this->render_view($job_array, 'emails', 'emails/templates/job_applied', TRUE));
									if ($email_id > 0) {
										@file_get_contents(base_url() . 'email/cron/' . $email_id);
										die('1');
									}
								}
							} else {
								$this->session->set_flashdata('profile_complete_warning', 'Your profile is only ' . $_SESSION['user']['user_profile_completeness'] . '% completed. Please update your profile to take advantage of the best opportunities around.');
								die('-1');
							}
						} else {
							die('3');
						}
					}
				} else {
					die('2');
				}
			} else {
				$_SESSION['redirect_url'] = base_url(uri_string());
				die;
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function update_social_media_share() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_id', 'Job ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('social_media_service', 'Social Media Service', 'trim|required');
		$this->form_validation->set_rules('share_count', 'Share Count', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Job_model->edit_job_by_id(array(
						'job_' . $this->input->post('social_media_service') . '_share_count' => $this->input->post('share_count'),
						'job_modified' => date('Y-m-d H:i:s')
							), $this->input->post('job_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function applied_jobs($user_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('User_model');
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'job/applied_jobs';
		$total_rows = $this->Job_model->count_job_application_by_user_id($user_id);
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 15;
		$config["uri_segment"] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = "<ul class = 'pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class = 'disabled'><li class = 'active'><a href = '#'>";
		$config['cur_tag_close'] = "<span class = 'sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['page_links'] = $this->pagination->create_links();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['job_application_array'] = $this->Job_model->get_job_application_by_user_id($user_id);
		$data['user_array'] = $this->User_model->get_user_by_id($user_id);
		parent::render_view($data, '');
	}

	function view_applicant($job_id = '') {
		parent::allow(array('administrator', 'employer'));
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'job/view_applicant/' . $job_id;
		$total_rows = $this->Job_model->count_job_applications_by_job_id($job_id);
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = "<ul class = 'pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class = 'disabled'><li class = 'active'><a href = '#'>";
		$config['cur_tag_close'] = "<span class = 'sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['page_links'] = $this->pagination->create_links();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['job_array'] = $this->Job_model->get_job_by_id($job_id);
		if (count($data['job_array']) === 0) {
			redirect(base_url() . 'job', 'refresh');
		}
		if (isset($_SESSION['user']) && $_SESSION['user']['group_slug'] !== 'administrator' && $_SESSION['user']['user_id'] !== $data['job_array']['users_id']) {
			redirect('dashboard', 'refresh');
		}
		$data['job_application_array'] = $this->Job_model->get_job_applications_by_job_id($job_id, '', $config['per_page'], $page);
		parent::render_view($data, 'common');
	}

	function change_spec_char($aircraft_name) {
		return str_replace(" ", "-", preg_replace("/\s+/", " ", str_replace(array('?', ';', '(', ')', '[', ']', '#', '{', '}', '.'), ' ', preg_replace("/[\/\&%#\$]/", " ", preg_replace("/[\"\']/", " ", $aircraft_name)))));
	}

	function setup_job_alert() {
		parent::allow(array('employee'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$company = $this->input->post('company');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			$this->form_validation->set_rules('position', 'Position', 'trim|required');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			if ($company == '2') {
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			}
			if ($this->form_validation->run()) {
				$this->Job_model->add_job_alert(
						array(
							'users_id' => $_SESSION['user']['user_id'],
							'job_types_id' => $this->input->post('position'),
							'job_alert_keyword' => $this->input->post('keywords'),
							'positions_id' => $this->input->post('role') ? $this->input->post('role') : '',
							'countries_id' => $this->input->post('location'),
							'job_alert_company' => $this->input->post('company'),
							'job_alert_other_company' => $this->input->post('company_name') ? $this->input->post('company_name') : '',
							'job_alert_employment_type' => $this->input->post('employment_type'),
							'job_alert_status' => '1',
							'job_alert_email_status' => '0',
							'job_alert_created' => date('Y-m-d H:i:s')
				));
				die('1');
			} else {
				echo validation_errors();
				die;
			}
		}
		die;
	}

	function job_alerts_datatable() {
		parent::allow(array('employee'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'job_types.job_type_id=job_alerts.job_types_id', 'left');
		$this->datatables->join('positions', 'positions.position_id=job_alerts.positions_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=job_alerts.countries_id', 'left');
		$this->datatables->where('job_alert_status!=', '-1');
		$this->datatables->where('users_id', $_SESSION['user']['user_id']);
		$this->datatables->select("job_alert_id,job_alert_keyword,IF(job_alert_company = 1,'All',job_alert_other_company),job_type_name,country_name,job_alert_employment_type,job_alert_email_status", FALSE)->from('job_alerts');
		echo $this->datatables->generate();
	}

	function alert() {
		parent::allow(array('employee'));
		$data = array();
		$this->load->model('Job_model');
		$this->load->model('Auth_model');
		$this->load->model('User_model');
		$data['job_locations'] = $this->Auth_model->get_countries();
		$data['job_type_array'] = $this->Job_model->get_active_job_types();
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($_SESSION['user']['user_id']);
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
		$data['user_details_array'] = $_SESSION['user'];
		parent::render_view($data, 'common');
	}

	function edit_job_alert($job_alert_id = '') {
		parent::allow(array('employee'));
		$this->load->model('User_model');
		$data = array();
		if ($this->input->post()) {
			$company = $this->input->post('company');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			$this->form_validation->set_rules('position', 'Position', 'trim|required');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			if ($company == '2') {
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			}
			if ($this->form_validation->run()) {
				$job_alert_update_array = array(
					'job_types_id' => $this->input->post('position'),
					'job_alert_keyword' => $this->input->post('keywords'),
					'positions_id' => $this->input->post('role') ? $this->input->post('role') : '',
					'countries_id' => $this->input->post('location'),
					'job_alert_company' => $this->input->post('company'),
					'job_alert_other_company' => $this->input->post('company_name') ? $this->input->post('company_name') : '',
					'job_alert_employment_type' => $this->input->post('employment_type'),
					'job_alert_created' => date('Y-m-d H:i:s')
				);
				if ($this->Job_model->edit_job_alert_by_id($job_alert_update_array, $job_alert_id)) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die;
		}
		$this->load->model('Auth_model');
		$this->load->model('User_model');
		$this->load->model('Job_model');
		$data['job_locations'] = $this->Auth_model->get_countries();
		$data['job_type_array'] = $this->Job_model->get_active_job_types();
		$data['job_alert_array'] = $this->Job_model->get_job_alert_by_job_id($job_alert_id);
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($_SESSION['user']['user_id']);
		$data['job_alert_company_array'] = $this->job_alert_company_array;
		$data['job_alert_employment_array'] = $this->job_alert_employment_array;
		parent::render_view($data, 'common');
	}

	function get_role_by_position() {
		$data = array();
		$this->load->model('User_model');
		parent::json_output($this->User_model->get_positions_by_job_type_id($this->input->post('position')));
	}

	function delete_job_alert($job_alert_id = '') {
		parent::allow(array('employee'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_alert_id', 'job_alert_id', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$job_alert_update_array = array(
				'job_alert_status' => '-1',
				'job_alert_modified' => date('Y-m-d H:i:s')
			);
			if ($this->Job_model->edit_job_alert_by_id($job_alert_update_array, $this->input->post('job_alert_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_job_alert_email_status() {
		parent::allow(array('employee'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_alert_id', 'job_alert_id', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$job_alert_update_array = array(
				'job_alert_email_status' => $this->input->post('job_alert_email_status') === 'true' ? '1' : '0',
				'job_alert_modified' => date('Y-m-d H:i:s')
			);
			if ($this->Job_model->edit_job_alert_by_id($job_alert_update_array, $this->input->post('job_alert_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

}
