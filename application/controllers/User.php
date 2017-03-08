<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public $public_methods = array();
	public $maintainance_license_type_array = array('Engine and Airframes', 'Avionics', 'Electronics', 'Instrument', 'Radio');
	public $user_employment_type_array = array('ALL', 'Contract/Freelance', 'Full Time', 'Part Time', 'Casual', 'Other');
	public $notice_period_array = array('Immediate', 'Negotiable', '1 Week or Less', '2 Weeks', '1 Month', '2 Months', '3 Months or Greater', 'Other');
	public $relation_array = array('Friend', 'Colleague', 'Former Employer', 'Current Employer', 'Manager/Supervisor', 'Relative', 'Mentor', 'Teacher', 'Instructor', 'Coach', 'Acquaintance', 'Customer/Client', 'Supplier');
	public $endorsement_array = array('Air Control(AIR)', 'Ground Movement Control (GMC)', 'Tower Control (TWR)', 'Ground Movement Surveillance (GMS)', 'Aerodrome Radar Control (RAD)', 'Precision Approach Radar (PAR)', 'Surveillance Radar Approach (SRA)', 'Terminal Control (TCL)', 'Oceanic Control (OCN)', 'Trainer / Instructor', 'Examiner', 'Unit', 'Other');

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}

	function upload_files() {
		parent::upload_files();
	}

	function index($type = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['user_type'] = $type;
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function pilot_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('type_ratings', 'users.type_ratings_id=type_ratings.type_rating_id', 'left');
		$this->datatables->join('licenses', 'users.licenses_id=licenses.license_id', 'left');
		$this->datatables->where(array('job_types.job_type_slug=' => 'pilot', 'users.user_status !=' => '-1'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,IF(type_rating_name='','',type_rating_name) AS type_rating_name,license_type,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_email,user_primary_contact,user_hours_type_rating,user_total_hours,user_total_instructor,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function pilot() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('1');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data);
	}

	function maintenance_engineer_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.user_id', 'left');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('type_ratings', 'users.type_ratings_id=type_ratings.type_rating_id', 'left');
		$this->datatables->join('licenses', 'users.licenses_id=licenses.license_id', 'left');
		$this->datatables->where(array('job_types.job_type_slug=' => 'maintenance-engineer', 'users.user_status !=' => '-1'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,IF(type_rating_name='','',type_rating_name) AS type_rating_name,license_type,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_email,user_primary_contact,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function maintenance_engineer() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('2');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data);
	}

	function air_traffic_controller_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('type_ratings', 'users.type_ratings_id=type_ratings.type_rating_id', 'left');
		$this->datatables->join('licenses', 'users.licenses_id=licenses.license_id', 'left');
		$this->datatables->where(array('job_types.job_type_slug=' => 'air-traffic-controller', 'users.user_status !=' => '-1'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,IF(type_rating_name='','',type_rating_name) AS type_rating_name,license_type,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_email,user_primary_contact,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function air_traffic_controller() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('7');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data);
	}

	function flight_attendant_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status !=' => '-1', 'users.job_types_id' => '3'));
		$this->datatables->where(array('groups.group_slug' => 'employee'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,user_email,user_primary_contact,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_years_of_experience,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function flight_attendant() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('3');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data, '');
	}

	function operation_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->join('employee_roles', 'users.employee_roles_id=employee_roles.employee_role_id', 'left');
		$this->datatables->where(array('users.user_status !=' => '-1', 'users.job_types_id' => '4'));
		$this->datatables->where(array('groups.group_slug' => 'employee'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,employee_role_name,country_name,user_email,user_primary_contact,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_years_of_experience,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function operations() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('4');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data, '');
	}

	function executive_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->join('employee_roles', 'employee_roles.employee_role_id=users.employee_roles_id', 'left');
		$this->datatables->where(array('users.user_status !=' => '-1', 'users.job_types_id' => '5'));
		$this->datatables->where(array('groups.group_slug' => 'employee'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,user_email,user_primary_contact,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,employee_role_name,user_years_of_experience,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function executive() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees('5');
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data, '');
	}

	function corporate_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status !=' => '-1', 'users.job_types_id' => '7'));
		$this->datatables->where(array('groups.group_slug' => 'employee'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,user_email,user_primary_contact,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function employee_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('type_ratings', 'users.type_ratings_id=type_ratings.type_rating_id', 'left');
		$this->datatables->join('licenses', 'users.licenses_id=licenses.license_id', 'left');
		$this->datatables->join('employee_roles', 'employee_roles.employee_role_id=users.employee_roles_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '4'));
		$this->datatables->select("user_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,job_type_name,IF(type_rating_name='','',type_rating_name) AS type_rating_name,license_type,employee_role_name,user_hours_type_rating,user_total_hours,user_total_instructor,user_years_of_experience,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_email,user_primary_contact,'',DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,user_status,CONCAT(user_rating,'/5'),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function employee() {
		parent::allow(array('administrator'));
		$data = array();
		$data['users_array'] = $this->User_model->get_employees();
		$data['active_user_count'] = $this->User_model->count_active_users();
		$data['list_array'] = $this->User_model->get_active_lists();
		parent::render_view($data);
	}

	function airlines_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('operation_types', 'users.operation_types_id=operation_types.operation_type_id', 'left');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '3', 'users.employer_types_id' => '1'));
		$this->datatables->select("user_id,CONCAT(user_business_name,'(',user_business_legal_name,')') AS business_name,employer_type,user_skype_id,user_website_address,country_name,CONCAT(user_first_name,' ',user_last_name,'(',user_business_title,')') AS contact_person,user_email,user_primary_contact,user_status,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),CONCAT(user_first_name,'-',user_last_name,'/',user_id) AS profile_link", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function airlines() {
		parent::allow(array('administrator'));
		$data = array();
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function business_aviation_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('operation_types', 'users.operation_types_id=operation_types.operation_type_id', 'left');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '3', 'users.employer_types_id' => '2'));
		$this->datatables->select("user_id,CONCAT(user_business_name,'(',user_business_legal_name,')') AS business_name,employer_type,user_skype_id,user_website_address,country_name,CONCAT(user_first_name,' ',user_last_name,'(',user_business_title,')') AS contact_person,user_email,user_primary_contact,user_status,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),CONCAT(user_first_name,'-',user_last_name,'/',user_id) AS profile_link", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function business_aviation() {
		parent::allow(array('administrator'));
		$data = array();
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function general_aviation_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('operation_types', 'users.operation_types_id=operation_types.operation_type_id', 'left');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '3', 'users.employer_types_id' => '3'));
		$this->datatables->select("user_id,CONCAT(user_business_name,'(',user_business_legal_name,')') AS business_name,employer_type,user_skype_id,user_website_address,country_name,CONCAT(user_first_name,' ',user_last_name,'(',user_business_title,')') AS contact_person,user_email,user_primary_contact,user_status,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),CONCAT(user_first_name,'-',user_last_name,'/',user_id) AS profile_link", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function general_aviation() {
		parent::allow(array('administrator'));
		$data = array();
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function recruiter_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('operation_types', 'users.operation_types_id=operation_types.operation_type_id', 'left');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '3', 'users.employer_types_id' => '4'));
		$this->datatables->select("user_id,CONCAT(user_business_name,'(',user_business_legal_name,')') AS business_name,employer_type,user_skype_id,user_website_address,country_name,CONCAT(user_first_name,' ',user_last_name,'(',user_business_title,')') AS contact_person,user_email,user_primary_contact,IF(operation_type='both','Regional & International',operation_type),user_status,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),CONCAT(user_first_name,'-',user_last_name,'/',user_id) AS profile_link", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function recruiter() {
		parent::allow(array('administrator'));
		$data = array();
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function employer_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('operation_types', 'users.operation_types_id=operation_types.operation_type_id', 'left');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.countries_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '3'));
		$this->datatables->select("user_id,CONCAT(user_business_name,'(',user_business_legal_name,')') AS business_name,employer_type,user_skype_id,user_website_address,country_name,CONCAT(user_first_name,' ',user_last_name,'(',user_business_title,')') AS contact_person,user_email,user_primary_contact,IF(operation_type='both','Regional & International',operation_type),user_status,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),CONCAT(user_first_name,'-',user_last_name,'/',user_id) AS profile_link", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function employer() {
		parent::allow(array('administrator'));
		$data = array();
		$data['active_user_count'] = $this->User_model->count_active_users();
		parent::render_view($data);
	}

	function login_in_history_datatable($user_id, $filter_val = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('users', 'users.user_id=login_logs.users_id');
		$this->datatables->where('login_logs.users_id', $user_id);
		if ($filter_val !== '') {
			switch ($filter_val) {
				case 1:
					$this->datatables->where(array('login_logs.login_log_created <= ' => date('Y-m-d H:i:s'), 'login_logs.login_log_created >= ' => date('Y-m-d H:i:s', strtotime('-1 week'))));
					break;
				case 2:
					$this->datatables->where(array('login_logs.login_log_created <= ' => date('Y-m-d H:i:s'), 'login_logs.login_log_created >= ' => date('Y-m-d H:i:s', strtotime('-1 month'))));
					break;
				case 3:
					$this->datatables->where(array('login_logs.login_log_created <= ' => date('Y-m-d H:i:s'), 'login_logs.login_log_created >= ' => date('Y-m-d H:i:s', strtotime('-1 year'))));
					break;
				default :
					$this->datatables->where(array('login_logs.login_log_created <= ' => date('Y-m-d H:i:s')));
					break;
			}
		}
		$this->datatables->select("login_log_id,CONCAT(user_first_name,' ',user_last_name) AS user_name,user_email,login_log_ip_address,login_log_user_agent,DATE_FORMAT(login_log_created,'%b %d %Y %h:%i %p') AS login_log_created", FALSE)->from('login_logs');
		echo $this->datatables->generate();
	}

	function log_in_history($user_id = '', $filter_val = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['login_user_id'] = $user_id;
		$data['user_array'] = $this->User_model->get_user_by_id($user_id);
		if (count($data['user_array']) === 0) {
			redirect('dashboard', 'refresh');
		}
		$data['filter_val'] = $filter_val;
		parent::render_view($data, '');
	}

	function datatable($type = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id');
		$this->datatables->join('countries', 'countries.country_id=users.user_id');
		$this->datatables->join('employer_types', 'employer_types.employer_type_id=users.employer_types_id', 'left');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->where(array('users.groups_id!=' => '1', 'users.user_status !=' => '-1'));
		if ($type !== '') {
			$this->datatables->where(array('groups.group_slug' => $type));
		}
		$this->datatables->select("user_id,IF(user_business_name='',CONCAT(user_first_name,' ',user_last_name),CONCAT(user_business_name,'(',user_first_name,' ',user_last_name,')')) AS user_full_name,group_name,IF(job_types_id != '0',job_type_name,employer_type) as user_category,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,country_name,user_email,user_primary_contact,DATE_FORMAT(user_created,'%b %d %Y %h:%i %p'),DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_status,IF(group_slug='employer',CONCAT('" . base_url() . "user/employer_profile/',user_first_name,'-',user_last_name,'/',user_id),CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id)) AS profile_link,group_slug", FALSE)->from('users');
		echo $this->datatables->generate();
	}

	function change_password() {
		parent::allow(array('administrator', 'employer', 'employee'));
		$data = array();
		$data['user_details_array'] = $this->User_model->get_user_by_id($_SESSION['user']['user_id']);
		if ($data['user_details_array']['user_status'] === '-1') {
			redirect('auth/logout');
		}
		$this->load->library('encrypt');
		$this->load->helper('form');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_login_password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('user_confirm_password', 'Confirm Password ', 'trim|required|matches[user_login_password]');
			$this->form_validation->set_error_delimiters('', '<br />');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$user_details_array = array(
					'user_login_salt' => md5($time_now),
					'user_login_password' => md5(md5(md5($time_now) . $this->input->post('user_login_password'))),
					'user_password_hash' => $this->encrypt->encode($this->input->post('user_login_password'), md5(md5(md5($time_now) . $this->input->post('user_login_password')))),
					'force_change_password' => '0',
					'user_modified' => $time_now
				);
				if ($this->User_model->edit_user_by_user_id($_SESSION['user']['user_id'], $user_details_array)) {
					parent::regenerate_session();
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('Error Changing Password !!!');
		}
		$data['title'] = 'Change Password';
		parent::render_view($data);
	}

	function delete() {
		parent::allow(array('administrator'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('users_id', 'User Id', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_error_delimiters('', '<br />');
			if ($this->form_validation->run()) {
				$user_details_array = $this->User_model->get_user_by_id($this->input->post('users_id'));
				if (count($user_details_array) > 0) {
					if ($this->User_model->delete_user_by_user_id($this->input->post('users_id'))) {
						die('1');
					}
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		die('0');
	}

	function change_status() {
		parent::allow(array('administrator'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_id', 'User Id', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('user_status', 'User Status', 'trim|required');
			$this->form_validation->set_error_delimiters('', '<br />');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$user_details_array = array(
					'user_status' => ($this->input->post('user_status') === 'true') ? '1' : '0',
					'user_modified' => $time_now
				);
				if ($this->User_model->edit_user_by_user_id($this->input->post('user_id'), $user_details_array)) {
// Add Email to admin and user that account is blocked or activated.
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		die('0');
	}

	function edit_profile($user_id = '') {
		parent::allow(array('administrator', 'employee'));
		$this->load->model('Auth_model');
		$this->load->model('Aircraft_model');
		$data = array();
		if ($user_id === '') {
			$user_id = $_SESSION['user']['user_id'];
		}
		if ($_SESSION['user']['group_slug'] !== 'administrator' && $user_id !== $_SESSION['user']['user_id']) {
			redirect('dashboard', 'refresh');
		}
		$user_details_array = $this->User_model->get_user_by_id($user_id);
		if ($user_details_array['group_slug'] !== 'employee') {
			redirect('dashboard', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('user_last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('user_country_code', 'Country Code', 'trim');
			$this->form_validation->set_rules('user_primary_contact', 'Contact Number', 'trim');
			$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|edit_unique[users.user_email.user_id.' . $user_details_array['user_id'] . ']');
			$this->form_validation->set_rules('user_address', 'Address', 'trim');
			$this->form_validation->set_rules('countries_id', 'Country Name', 'trim');
			if ($this->form_validation->run()) {
				$user_profile_completeness = 5;
				$type_rating_array = array();
				$license_array = array();
				$validation_array = array();
				$passport_array = array();
				$visa_array = array();
				$previous_employment_array = array();
				$desired_position_array = array();
				$training_array = array();
				$user_medical_array = array();
				$desired_position_location_array = array();
				$experience_array = array();
				$reference_array = array();
				$me_license_array = array();
				$pilot_license_array = array();
				$management_experience_array = array();
				$pilot_flight_time_array = array();
				$pilot_medical_certificate_array = array();
				$retired_pilot_array = array();
//validation validation
				if ($user_details_array['job_type_slug'] === 'air-traffic-controller') {
					for ($i = 0; $i < count($this->input->post('user_validation_countries_id')); $i++) {
						if ($this->input->post('user_validation_countries_id')[$i] !== '' || $this->input->post('user_validation_expire_date')[$i] !== '' || $this->input->post('user_validation_file')[$i] !== '') {
							$validation_array[$i] = array(
								'users_id' => $user_details_array['user_id'],
								'countries_id' => $this->input->post('user_validation_countries_id')[$i],
								'user_validation_expire_date' => $this->input->post('user_validation_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_validation_expire_date')[$i]) : '0000-00-00',
								'user_validation_file' => $this->input->post('user_validation_file')[$i],
								'user_validation_original_file' => $this->input->post('user_validation_original_file')[$i],
								'user_validation_status' => '1'
							);
						}
					}
				} else if ($user_details_array['job_type_slug'] === 'pilot') {
					for ($i = 0; $i < count($this->input->post('user_validation_countries_id')); $i++) {
						if ($this->input->post('user_validation_countries_id')[$i] !== '' || $this->input->post('user_validation_my_aircrafts_id')[$i] !== '' || $this->input->post('user_validation_expire_date')[$i] !== '' || $this->input->post('user_validation_file')[$i] !== '') {
							$validation_array[$i] = array(
								'users_id' => $user_details_array['user_id'],
								'countries_id' => $this->input->post('user_validation_countries_id')[$i],
								'my_aircrafts_id' => $this->input->post('user_validation_my_aircrafts_id')[$i] !== '' ? $this->input->post('user_validation_my_aircrafts_id')[$i] : NULL,
								'user_validation_expire_date' => $this->input->post('user_validation_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_validation_expire_date')[$i]) : '0000-00-00',
								'user_validation_file' => $this->input->post('user_validation_file')[$i],
								'user_validation_original_file' => $this->input->post('user_validation_original_file')[$i],
								'user_validation_status' => '1'
							);
						}
					}
				} else if ($user_details_array['job_type_slug'] === 'maintenance-engineer') {
					for ($i = 0; $i < count($this->input->post('user_validation_countries_id')); $i++) {
						if ($this->input->post('user_validation_countries_id')[$i] !== '' || $this->input->post('user_validation_my_aircrafts_id')[$i] !== '' || $this->input->post('user_validation_expire_date')[$i] !== '' || $this->input->post('user_validation_licenses_id')[$i] !== '' || $this->input->post('user_validation_file')[$i] !== '') {
							$validation_array[$i] = array(
								'users_id' => $user_details_array['user_id'],
								'countries_id' => $this->input->post('user_validation_countries_id')[$i],
								'licenses_id' => $this->input->post('user_validation_licenses_id')[$i] !== '' ? $this->input->post('user_validation_licenses_id')[$i] : NULL,
								'my_aircrafts_id' => $this->input->post('user_validation_my_aircrafts_id')[$i] !== '' ? $this->input->post('user_validation_my_aircrafts_id')[$i] : NULL,
								'user_validation_expire_date' => $this->input->post('user_validation_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_validation_expire_date')[$i]) : '0000-00-00',
								'user_validation_file' => $this->input->post('user_validation_file')[$i],
								'user_validation_original_file' => $this->input->post('user_validation_original_file')[$i],
								'user_validation_status' => '1'
							);
						}
					}
				}
//user training validation
				for ($i = 0; $i < count($this->input->post('trainings_id')); $i++) {
					if ($this->input->post('trainings_id')[$i] !== '' || $this->input->post('user_training_completion_date')[$i] !== '') {
						$training_array[$i] = array(
							'users_id' => $user_details_array['user_id'],
							'trainings_id' => $this->input->post('trainings_id')[$i] !== '' ? $this->input->post('trainings_id')[$i] : NULL,
							'user_training_completion_date' => $this->input->post('user_training_completion_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_training_completion_date')[$i]) : '',
							'user_training_status' => '1'
						);
					}
				}
//User Medical certificate validation
				for ($i = 0; $i < count($this->input->post('user_medical_certificate_authorities_id')); $i++) {
					if ($this->input->post('user_medical_certificate_authorities_id')[$i] !== '' || $this->input->post('user_medical_certificate_class')[$i] !== '' || $this->input->post('user_medical_certificate_exam_date')[$i] !== '' || $this->input->post('user_medical_certificate_file')[$i] !== '') {
						$user_medical_array[$i] = array(
							'users_id' => $user_details_array['user_id'],
							'license_authorities_id' => $this->input->post('user_medical_certificate_authorities_id')[$i] !== '' ? $this->input->post('user_medical_certificate_authorities_id')[$i] : NULL,
							'user_medical_certificate_class' => $this->input->post('user_medical_certificate_class')[$i],
							'user_medical_certificate_exam_date' => $this->input->post('user_medical_certificate_exam_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_medical_certificate_exam_date')[$i]) : '0000-00-00',
							'user_medical_certificate_file' => $this->input->post('user_medical_certificate_file')[$i],
							'user_medical_certificate_original_file' => $this->input->post('user_medical_certificate_original_file')[$i],
							'user_medical_certificate_status' => '1'
						);
					}
				}
//passport validation
				for ($i = 0; $i < count($this->input->post('user_passport_number')); $i++) {
					if ($this->input->post('user_passport_number')[$i] !== '' || $this->input->post('user_passport_countries_id')[$i] !== '' || $this->input->post('user_passport_expire_date')[$i] !== '' || $this->input->post('user_passport_file')[$i] !== '') {
						$passport_array[$i] = array(
							'users_id' => $user_details_array['user_id'],
							'user_passport_number' => $this->input->post('user_passport_number')[$i],
							'countries_id' => $this->input->post('user_passport_countries_id')[$i],
							'user_passport_expire_date' => $this->input->post('user_passport_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_passport_expire_date')[$i]) : '0000-00-00',
							'user_passport_file' => $this->input->post('user_passport_file')[$i],
							'user_passport_original_file' => $this->input->post('user_passport_original_file')[$i],
							'user_passport_status' => '1'
						);
					}
				}
//visa validation
				for ($i = 0; $i < count($this->input->post('user_visa_countries_id')); $i++) {
					if ($this->input->post('user_visa_countries_id')[$i] !== '' || $this->input->post('user_visa_expire_date')[$i] !== '' || $this->input->post('user_visa_file')[$i] !== '') {
						$visa_array[$i] = array(
							'users_id' => $user_details_array['user_id'],
							'countries_id' => $this->input->post('user_visa_countries_id')[$i],
							'user_visa_expire_date' => $this->input->post('user_visa_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_visa_expire_date')[$i]) : '',
							'user_visa_file' => $this->input->post('user_visa_file')[$i],
							'user_visa_original_file' => $this->input->post('user_visa_original_file')[$i],
							'user_visa_status' => '1'
						);
					}
				}
//previous employment status
				for ($i = 0; $i < count($this->input->post('user_previous_employment_company')); $i++) {
					if ($this->input->post('user_previous_employment_company')[$i] !== '' || $this->input->post('user_previous_employment_positions_id')[$i] !== '' || $this->input->post('user_previous_employment_start_date')[$i] !== '' || $this->input->post('user_previous_employment_end_date')[$i] !== '') {
						$previous_employment_array[$i] = array(
							'users_id' => $user_id,
							'user_previous_employment_company' => $this->input->post('user_previous_employment_company')[$i],
							'positions_id' => $this->input->post('user_previous_employment_positions_id')[$i] !== '' ? $this->input->post('user_previous_employment_positions_id')[$i] : NULL,
							'user_previous_employment_start_date' => $this->input->post('user_previous_employment_start_date')[$i] != '' ? parent::input_date_to_mysql_date($this->input->post('user_previous_employment_start_date')[$i]) : '',
							'user_previous_employment_end_date' => $this->input->post('user_previous_employment_end_date')[$i] != '' ? parent::input_date_to_mysql_date($this->input->post('user_previous_employment_end_date')[$i]) : '',
							'user_previous_employment_status' => '1'
						);
					}
				}
//user references validation
				for ($i = 0; $i < count($this->input->post('user_reference_name')); $i++) {
					if ($this->input->post('user_reference_name')[$i] !== '' || $this->input->post('user_reference_company')[$i] !== '' || $this->input->post('user_reference_positions_id')[$i] !== '' || $this->input->post('user_reference_relation')[$i] !== '' || $this->input->post('user_reference_email')[$i] !== '' || $this->input->post('user_reference_country_code')[$i] !== '' || $this->input->post('user_reference_contact_number')[$i] !== '') {
						$reference_array[$i] = array(
							'users_id' => $user_id,
							'user_reference_name' => $this->input->post('user_reference_name')[$i],
							'user_reference_company' => $this->input->post('user_reference_company')[$i],
							'positions_id' => $this->input->post('user_reference_positions_id')[$i] !== '' ? $this->input->post('user_reference_positions_id')[$i] : NULL,
							'user_reference_email' => $this->input->post('user_reference_email')[$i],
							'user_reference_relation' => $this->input->post('user_reference_relation')[$i],
							'user_reference_country_code' => $this->input->post('user_reference_country_code')[$i],
							'user_reference_contact_number' => $this->input->post('user_reference_contact_number')[$i],
							'user_reference_status' => '1'
						);
					}
				}
				// validate pilot flight time
				if ($user_details_array['job_type_slug'] !== 'pilot') {
					if ($this->input->post('pilot_total_hours') !== '' || $this->input->post('pilot_total_pic') !== '' || $this->input->post('pilot_total_sic') !== '' || $this->input->post('pilot_total_jet') !== '' || $this->input->post('pilot_total_turboprop') !== '' || $this->input->post('pilot_total_night') !== '' || $this->input->post('pilot_total_instructor') !== '') {
						$pilot_flight_time_array = array(
							'users_id' => $user_details_array['user_id'],
							'user_flight_time_total_hour' => $this->input->post('pilot_total_hours'),
							'user_flight_time_total_pic' => $this->input->post('pilot_total_pic'),
							'user_flight_time_total_sic' => $this->input->post('pilot_total_sic'),
							'user_flight_time_total_jet' => $this->input->post('pilot_total_jet'),
							'user_flight_time_total_turboprop' => $this->input->post('pilot_total_turboprop'),
							'user_flight_time_total_night' => $this->input->post('pilot_total_night'),
							'user_flight_time_total_instructor' => $this->input->post('pilot_total_instructor'),
							'user_flight_time_status' => '1',
							'user_flight_time_created' => date('Y-m-d H:i:s')
						);
					}
				}
				//Other skills validation
				if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') {
					//validation maintenance license
					for ($i = 0; $i < count($this->input->post('user_me_license_authorities_id')); $i++) {
						if ($this->input->post('user_me_license_authorities_id')[$i] !== '' || $this->input->post('user_me_licenses_id')[$i] !== '' || $this->input->post('user_me_license_expire_date')[$i] !== '' || $this->input->post('user_me_license_file')[$i] !== '') {
							$me_license_array[$i] = array(
								'license_authorities_id' => $this->input->post('user_me_license_authorities_id')[$i] !== '' ? $this->input->post('user_me_license_authorities_id')[$i] : NULL,
								'users_id' => $user_details_array['user_id'],
								'licenses_id' => $this->input->post('user_me_licenses_id')[$i] !== '' ? $this->input->post('user_me_licenses_id')[$i] : NULL,
								'user_license_expire_date' => $this->input->post('user_me_license_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_me_license_expire_date')[$i]) : '',
								'user_license_file' => $this->input->post('user_me_license_file')[$i],
								'user_license_original_file' => $this->input->post('user_me_license_original_file')[$i],
								'user_license_status' => '1',
								'user_license_category' => '2',
								'user_license_is_other' => '1'
							);
						}
					}
				}
				//pilot license validation
				if ($user_details_array['job_type_slug'] !== 'pilot') {
					for ($i = 0; $i < count($this->input->post('pilot_license_authorities_id')); $i++) {
						if ($this->input->post('pilot_license_authorities_id')[$i] !== '' || $this->input->post('pilot_licenses_id')[$i] !== '' || $this->input->post('pilot_license_expire_date')[$i] !== '' || $this->input->post('pilot_license_file')[$i] !== '' || $this->input->post('pilot_license_approval_ratings_id')[$i] !== '') {
							$pilot_license_array[$i] = array(
								'license_authorities_id' => $this->input->post('pilot_license_authorities_id')[$i] !== '' ? $this->input->post('pilot_license_authorities_id')[$i] : NULL,
								'users_id' => $user_details_array['user_id'],
								'licenses_id' => $this->input->post('pilot_licenses_id')[$i] !== '' ? $this->input->post('pilot_licenses_id')[$i] : NULL,
								'user_license_expire_date' => $this->input->post('pilot_license_expire_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('pilot_license_expire_date')[$i]) : '',
								'approval_ratings_id' => $this->input->post('pilot_license_approval_ratings_id')[$i] !== '' ? $this->input->post('pilot_license_approval_ratings_id')[$i] : NULL,
								'user_license_file' => $this->input->post('pilot_license_file')[$i],
								'user_license_original_file' => $this->input->post('pilot_license_original_file')[$i],
								'user_license_status' => '1',
								'user_license_category' => '1',
								'user_license_is_other' => '1'
							);
						}
					}
				}
				//pilot medical certificate validation
				if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot' && $user_details_array['job_type_slug'] !== 'air-traffic-controller') {
					for ($i = 0; $i < count($this->input->post('pilot_medical_certificate_authorities_id')); $i++) {
						if ($this->input->post('pilot_medical_certificate_authorities_id')[$i] !== '' || $this->input->post('pilot_medical_certificate_class')[$i] !== '' || $this->input->post('pilot_medical_certificate_exam_date')[$i] !== '' || $this->input->post('pilot_medical_certificate_file')[$i] !== '') {
							$pilot_medical_certificate_array[$i] = array(
								'users_id' => $user_details_array['user_id'],
								'license_authorities_id' => $this->input->post('pilot_medical_certificate_authorities_id')[$i] !== '' ? $this->input->post('pilot_medical_certificate_authorities_id')[$i] : NULL,
								'user_medical_certificate_class' => $this->input->post('pilot_medical_certificate_class')[$i],
								'user_medical_certificate_exam_date' => $this->input->post('pilot_medical_certificate_exam_date')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('pilot_medical_certificate_exam_date')[$i]) : '',
								'user_medical_certificate_file' => $this->input->post('pilot_medical_certificate_file')[$i],
								'user_medical_certificate_original_file' => $this->input->post('pilot_medical_certificate_original_file')[$i],
								'user_medical_certificate_status' => '1',
								'user_medical_certificate_is_other' => '1'
							);
						}
					}
				}
				//pilot retired pilot validation
				if ($user_details_array ['job_type_slug'] === 'air-traffic-controller') {
					if ($this->input->post('user_retired_pilot_company') !== '' || $this->input->post('user_retired_pilot_positions_id') !== '' || $this->input->post('user_retired_pilot_total_hours') !== '') {
						$retired_pilot_array = array(
							'users_id' => $user_details_array['user_id'],
							'user_retired_pilot_company' => $this->input->post('user_retired_pilot_company'),
							'positions_id' => $this->input->post('user_retired_pilot_positions_id') !== '' ? $this->input->post('user_retired_pilot_positions_id') : NULL,
							'user_retired_pilot_total_hours' => $this->input->post('user_retired_pilot_total_hours'),
							'user_retired_pilot_status' => '1'
						);
					}
				}
				//medical validation
				if ($this->input->post('user_medical_height') !== '' || $this->input->post('user_medical_height_unit') !== '') {
					if ($this->input->post('user_medical_height') === '' || $this->input->post('user_medical_height_unit') === '') {
						echo "Please fill both height and units";
						die;
					}
				}
				if ($this->input->post('user_medical_weight') !== '' || $this->input->post('user_medical_weight_unit') !== '') {
					if ($this->input->post('user_medical_weight') === '' || $this->input->post('user_medical_weight_unit') === '') {
						echo "Please fill both weight and units";
						die;
					}
				}
				$user_resume_file = $this->input->post('user_resume');
				$user_image_file = $this->input->post('user_profile_image');
				$user_thumb_image = pathinfo($user_image_file, PATHINFO_FILENAME) . '_thumb.' . pathinfo($user_image_file, PATHINFO_EXTENSION);
				if (is_file(FCPATH . 'uploads/' . $user_resume_file)) {
					$resume_upload_directory = FCPATH . 'uploads/users/resumes' . date('/Y/m/d/H/i/s', strtotime($user_details_array['user_created']));
					if (!is_dir($resume_upload_directory)) {
						mkdir($resume_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $user_resume_file, $resume_upload_directory . '/' . $user_resume_file)) {
						unlink(FCPATH . 'uploads/' . $user_resume_file);
					}
				}
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
				if ($this->input->post('user_profile_image')) {
					$user_profile_completeness = $user_profile_completeness + 5;
				}
				if ($this->input->post('user_resume')) {
					$user_profile_completeness = $user_profile_completeness + 10;
				}
				$user_update_array = array(
					'user_skype_id' => $this->input->post('user_skype_id'),
					'user_first_name' => $this->input->post('user_first_name'),
					'user_last_name' => $this->input->post('user_last_name'),
					'user_country_code' => $this->input->post('user_country_code'),
					'user_email' => $this->input->post('user_email'),
					'user_login' => $this->input->post('user_email'),
					'user_primary_contact' => $this->input->post('user_primary_contact'),
					'user_dob' => $this->input->post('user_dob') != '' ? parent::input_date_to_mysql_date($this->input->post('user_dob')) : '',
					'user_gender' => $this->input->post('user_gender'),
					'user_linkedin_id' => $this->input->post('user_linkedin_id'),
					'user_address' => $this->input->post('user_address'),
					'countries_id' => $this->input->post('countries_id'),
					'user_city' => $this->input->post('user_city'),
					'user_state' => $this->input->post('user_state'),
					'user_zipcode' => $this->input->post('user_zipcode'),
					'user_total_hours' => $this->input->post('user_total_hours'),
					'user_total_jet' => $this->input->post('user_total_jet'),
					'user_total_pic' => $this->input->post('user_total_pic'),
					'user_total_sic' => $this->input->post('user_total_sic'),
					'user_total_turboprop' => $this->input->post('user_total_turboprop'),
					'user_total_night' => $this->input->post('user_total_night'),
					'user_total_instructor' => $this->input->post('user_total_instructor'),
					'user_atlantic_crossing' => $this->input->post('user_atlantic_crossing'),
					'user_pacific_crossing' => $this->input->post('user_pacific_crossing'),
					'user_polar_crossing' => $this->input->post('user_polar_crossing'),
					'user_resume' => $user_resume_file,
					'user_resume_original_file' => $this->input->post('user_resume_original_file'),
					'user_profile_image' => $user_image_file,
					'user_profile_thumb' => $user_thumb_image,
					'user_profile_image_original_name' => $this->input->post('user_profile_image_original_name'),
					'user_description' => nl2br($this->input->post('user_description')),
					'user_find_us' => $this->input->post('user_find_us'),
					'user_medical_height' => $this->input->post('user_medical_height'),
					'user_medical_height_unit' => $this->input->post('user_medical_height_unit'),
					'user_medical_weight' => $this->input->post('user_medical_weight'),
					'user_medical_weight_unit' => $this->input->post('user_medical_weight_unit'),
					'employee_roles_id' => $this->input->post('employee_roles_id'),
					'user_modified' => date('Y-m-d H:i:s'),
					'user_is_criminal_case' => $this->input->post('user_is_criminal_case') !== null ? '1' : '0',
					'user_is_accident_case' => $this->input->post('user_is_accident_case') !== null ? '1' : '0',
					'user_criminal_case_description' => $this->input->post('user_is_criminal_case') !== null ? $this->input->post('user_criminal_case_description') : '',
					'user_accident_case_description' => $this->input->post('user_is_accident_case') !== null ? $this->input->post('user_accident_case_description') : ''
				);
				if ($user_details_array['job_type_slug'] === 'pilot') {
					$user_update_array['user_total_flight'] = $this->input->post('user_total_flight');
				}
				if ($user_details_array['job_type_slug'] === 'maintenance-engineer') {
					$user_update_array['user_engine_airframe_type'] = $this->input->post('user_engine_airframe_type');
				}
//qualification
				if ($user_details_array['job_type_slug'] === 'pilot') {
					$user_update_array['license_authorities_id'] = $this->input->post('license_authorities_id');
					$user_update_array['user_total_hours'] = $this->input->post('user_total_hours');
					$user_update_array['type_ratings_id'] = $this->input->post('type_ratings_id');
				}
				if ($user_details_array['job_type_slug'] === 'air-traffic-controller') {
					$user_update_array['user_endorsement'] = $this->input->post('user_endorsement');
					$user_update_array['user_endorsement_other'] = $this->input->post('user_endorsement') === 'Other' ? $this->input->post('user_endorsement_other') : '';
					$user_update_array['user_endorsement_unit'] = $this->input->post('user_endorsement') === 'Unit' ? $this->input->post('user_endorsement_unit') : '';
					$user_update_array['user_airport_area'] = $this->input->post('user_airport_area');
					$user_update_array['user_last_check'] = $this->input->post('user_last_check') != '' ? parent::input_date_to_mysql_date($this->input->post('user_last_check')) : '';
					$user_update_array ['user_years_of_experience'] = $this->input->post('user_years_of_experience');
				}
				if ($user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'corporate') {
					$user_update_array['user_years_of_experience'] = $this->input->post('user_years_of_experience');
					$user_update_array['user_department'] = $this->input->post('user_department');
					$user_update_array['user_role_type'] = $this->input->post('user_role_type');
				}
				if ($user_details_array['job_type_slug'] === 'flight-attendant') {
					$user_update_array['user_years_of_experience'] = $this->input->post('user_years_of_experience');
					$user_update_array['my_aircrafts_id'] = $this->input->post('my_aircrafts_id');
					$user_update_array['positions_id'] = $this->input->post('positions_id') !== '' ? $this->input->post('positions_id') : NULL;
					$user_update_array['user_position_other'] = $this->input->post('positions_id') === '0' ? $this->input->post('user_position_other') : '';
					$user_update_array['user_aircraft_last_flight'] = $this->input->post('user_aircraft_last_flight') !== '' ? parent::input_date_to_mysql_date($this->input->post('user_aircraft_last_flight')) : '';
				}
				if ($this->User_model->edit_user_by_user_id($user_details_array ['user_id'], $user_update_array)) {
					if ($user_details_array['job_type_slug'] === 'operations' || $user_details_array['job_type_slug'] === 'executive' || $user_details_array['job_type_slug'] === 'corporate') {
						//add countries of expericences
						if ($this->User_model->edit_user_countries_experience_by_user_id($user_details_array['user_id'], array('user_countries_of_experience_status' => '-1'))) {
							if (count($this->input->post('user_countries_of_experience')) > 0) {
								foreach ($this->input->post('user_countries_of_experience') as $countries)
									$this->User_model->add_user_countries_experience(array(
										'users_id' => $user_details_array['user_id'],
										'countries_id' => $countries,
										'user_countries_of_experience_status' => '1'
									));
							}
						}
//add current positions
						if ($this->User_model->edit_user_current_position_by_user_id($user_details_array['user_id'], array('user_current_position_status' => '-1'))) {
							if (count($this->input->post('user_qualification_positions_id')) > 0) {
								foreach ($this->input->post('user_qualification_positions_id') as $position) {
									$user_current_position_id = $this->User_model->add_user_current_position(array(
										'users_id' => $user_id,
										'positions_id' => $position !== '' ? $position : NULL,
										'user_current_position_status' => '1'
									));
									if ($position === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_current_positions_id' => $user_current_position_id,
											'user_current_position_other_name' => $this->input->post('user_current_position_other_name'),
											'user_current_position_other_status' => '1'
												), 'user_current_position_others');
									}
								}
							}
						}
//add user skills
						if ($this->User_model->edit_user_skill_by_user_id($user_details_array['user_id'], array('user_skill_status' => '-1'))) {
							if (count($this->input->post('user_qualification_skills_id')) > 0) {
								foreach ($this->input->post('user_qualification_skills_id') as $skill) {
									$user_skill_id = $this->User_model->add_user_skill(array(
										'users_id' => $user_id,
										'skills_id' => $skill !== '' ? $skill : NULL,
										'user_skill_status' => '1'));
									if ($skill === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_skills_id' => $user_skill_id,
											'user_skill_other_name' => $this->input->post('user_skill_other_name'),
											'user_skill_other_status' => '1'
												), 'user_skill_others');
									}
								}
							}
						}
					}
					if ($user_details_array['job_type_slug'] === 'flight-attendant') {
						if ($this->User_model->edit_user_aircraft_experience_by_user_id($user_id, array('user_aircraft_experience_status' => '-1'))) {
							if (count($this->input->post('user_aircraft_experience_my_aircrafts_id')) > 0) {
								foreach ($this->input->post('user_aircraft_experience_my_aircrafts_id') as $aircraft_experience) {
									$user_aircraft_experience_id = $this->User_model->add_user_aircraft_experience(array(
										'users_id' => $user_id,
										'my_aircrafts_id' => $aircraft_experience !== '' ? $aircraft_experience : NULL,
										'user_aircraft_experience_status' => '1'
									));
									if ($aircraft_experience === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_aircraft_experiences_id' => $user_aircraft_experience_id,
											'user_aircraft_experience_aircraft_type_other_name' => $this->input->post('user_aircraft_experience_aircraft_type_other_name'),
											'user_aircraft_experience_aircraft_type_other_status' => '1'
												), 'user_aircraft_experience_aircraft_type_others');
									}
								}
							}
						}
					}
					if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'pilot') {
//add pilot licenses
						if ($this->User_model->edit_user_license_by_user_id($user_details_array['user_id'], array('user_license_status' => '-1'), '0')) {
							for ($i = 0; $i < count($this->input->post('user_license_authorities_id')); $i++) {
								if ($this->input->post('user_license_authorities_id')[$i] !== '' || $this->input->post('user_licenses_id')[$i] !== '' || count($this->input->post('user_license_positions_id')[$i]) > 0 || $this->input->post('user_license_expire_date')[$i] !== '' || $this->input->post('user_license_approval_ratings_id')[$i] !== '' || count($this->input->post('user_license_is_english_proficient')) > 0 || $this->input->post('user_license_file')[$i] !== '') {
									if (is_file(FCPATH . 'uploads/' . $this->input->post('user_license_file') [$i])) {
										if (!is_dir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $this->input->post('user_license_file') [$i], FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $this->input->post('user_license_file')[$i])) {
											unlink(FCPATH . 'uploads/' . $this->input->post('user_license_file')[$i]);
										}
									}
									$user_license_id = $this->User_model->add_user_licenses(array(
										'users_id' => $user_details_array['user_id'],
										'license_authorities_id' => $this->input->post('user_license_authorities_id') [$i] !== '' ? $this->input->post('user_license_authorities_id') [$i] : NULL,
										'licenses_id' => $this->input->post('user_licenses_id')[$i] !== '' ? $this->input->post('user_licenses_id')[$i] : NULL,
										'user_license_expire_date' => $this->input->post('user_license_expire_date')[$i] != null ? parent::input_date_to_mysql_date($this->input->post('user_license_expire_date')[$i]) : '',
										'approval_ratings_id' => $this->input->post('user_license_approval_ratings_id')[$i] !== '' ? $this->input->post('user_license_approval_ratings_id')[$i] : NULL,
										'user_license_is_english_proficient' => count($this->input->post('user_license_is_english_proficient')) > 0 ? (in_array($i, $this->input->post('user_license_is_english_proficient')) ? '1' : '0') : '0',
										'user_license_file' => $this->input->post('user_license_file')[$i],
										'user_license_original_file' => $this->input->post('user_license_original_file')[$i],
										'user_license_status' => '1'
									));
									//add other license authority
									if ($this->input->post('user_license_authorities_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name')[$i],
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
									//add other license type
									if ($this->input->post('user_licenses_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_type_other_name' => $this->input->post('user_license_type_other_name')[$i],
											'user_license_type_other_status' => '1'
												), 'user_license_type_others');
									}
									if (isset($this->input->post('user_license_positions_id')[$i]) && count($this->input->post('user_license_positions_id')[$i]) > 0) {
										foreach ($this->input->post('user_license_positions_id')[$i] as $license_position) {
											$user_license_position_id = $this->User_model->add_user_license_positions(array(
												'user_licenses_id' => $user_license_id,
												'positions_id' => $license_position !== '' ? $license_position : NULL
											));
											//add other license position
											if ($license_position === '0') {
												$this->User_model->add_user_other_data_lookup(array(
													'user_license_positions_id' => $user_license_position_id,
													'user_license_position_other_name' => $this->input->post('user_license_position_other_name')[$i],
													'user_license_position_other_status' => '1'
														), 'user_license_position_others');
											}
										}
									}
									//add other approval rating
									if ($this->input->post('user_license_approval_ratings_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_approval_rating_other_name' => $this->input->post('user_license_approval_rating_other_name')[$i],
											'user_license_approval_rating_other_status' => '1'
												), 'user_license_approval_rating_others');
									}
									if ($i === count($this->input->post('user_license_authorities_id')) - 1) {
										$user_profile_completeness = $user_profile_completeness + 10;
									}
								}
							}
						}
					}
					if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'maintenance-engineer') {
//add ME licenses
						if ($this->User_model->edit_user_license_by_user_id($user_details_array['user_id'], array('user_license_status' => '-1'))) {
							for ($i = 0; $i < count($this->input->post('user_license_authorities_id')); $i++) {
								if ($this->input->post('user_license_authorities_id')[$i] !== '' || $this->input->post('user_licenses_id')[$i] !== '' || $this->input->post('user_license_positions_id')[$i] !== '' || $this->input->post('user_license_expire_date')[$i] !== '' || $this->input->post('user_license_file')[$i] !== '') {
									if (is_file(FCPATH . 'uploads/' . $this->input->post('user_license_file') [$i])) {
										if (!is_dir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $this->input->post('user_license_file') [$i], FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $this->input->post('user_license_file')[$i])) {
											unlink(FCPATH . 'uploads/' . $this->input->post('user_license_file')[$i]);
										}
									}
									$user_license_id = $this->User_model->add_user_licenses(array(
										'users_id' => $user_details_array['user_id'],
										'license_authorities_id' => $this->input->post('user_license_authorities_id') [$i] !== '' ? $this->input->post('user_license_authorities_id') [$i] : NULL,
										'licenses_id' => $this->input->post('user_licenses_id')[$i] !== '' ? $this->input->post('user_licenses_id')[$i] : NULL,
										'user_license_expire_date' => $this->input->post('user_license_expire_date')[$i] != null ? parent::input_date_to_mysql_date($this->input->post('user_license_expire_date')[$i]) : '',
										'user_license_file' => $this->input->post('user_license_file')[$i],
										'user_license_original_file' => $this->input->post('user_license_original_file')[$i],
										'user_license_status' => '1'
									));
									//add other license authority
									if ($this->input->post('user_license_authorities_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name')[$i],
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
									//add other license type
									if ($this->input->post('user_licenses_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_type_other_name' => $this->input->post('user_license_type_other_name')[$i],
											'user_license_type_other_status' => '1'
												), 'user_license_type_others');
									}
									//Add other position
									if ($this->input->post('user_license_positions_id')[$i] !== '') {
										$user_license_position_id = $this->User_model->add_user_license_positions(array(
											'user_licenses_id' => $user_license_id,
											'positions_id' => $this->input->post('user_license_positions_id')[$i] !== '' ? $this->input->post('user_license_positions_id')[$i] : NULL
										));

										if ($this->input->post('user_license_positions_id')[$i] === '0') {
											$this->User_model->add_user_other_data_lookup(array(
												'user_license_positions_id' => $user_license_position_id,
												'user_license_position_other_name' => $this->input->post('user_license_position_other_name')[$i],
												'user_license_position_other_status' => '1'
													), 'user_license_position_others');
										}
									}
									if ($i === count($this->input->post('user_license_authorities_id')) - 1) {
										$user_profile_completeness = $user_profile_completeness + 10;
									}
								}
							}
						}
					}
					if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'air-traffic-controller') {
//add ATC licenses
						if ($this->User_model->edit_user_license_by_user_id($user_details_array['user_id'], array('user_license_status' => '-1'))) {
							for ($i = 0; $i < count($this->input->post('user_license_authorities_id')); $i++) {
								if ($this->input->post('user_license_authorities_id')[$i] !== '' || $this->input->post('user_license_positions_id')[$i] !== '' || $this->input->post('user_license_expire_date')[$i] !== '' || $this->input->post('user_license_file')[$i] !== '') {
									if (is_file(FCPATH . 'uploads/' . $this->input->post('user_license_file') [$i])) {
										if (!is_dir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $this->input->post('user_license_file') [$i], FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $this->input->post('user_license_file')[$i])) {
											unlink(FCPATH . 'uploads/' . $this->input->post('user_license_file')[$i]);
										}
									}
									$user_license_id = $this->User_model->add_user_licenses(array(
										'users_id' => $user_details_array ['user_id'],
										'license_authorities_id' => $this->input->post('user_license_authorities_id')[$i] !== '' ? $this->input->post('user_license_authorities_id')[$i] : NULL,
										'user_license_expire_date' => $this->input->post('user_license_expire_date')[$i] != null ? parent::input_date_to_mysql_date($this->input->post('user_license_expire_date')[$i]) : '',
										'user_license_file' => $this->input->post('user_license_file')[$i] !== null ? $this->input->post('user_license_file')[$i] : '',
										'user_license_original_file' => $this->input->post('user_license_original_file')[$i],
										'user_license_status' => '1'
									));
									//add other license authority
									if ($this->input->post('user_license_authorities_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $user_license_id,
											'user_license_authority_other_name' => $this->input->post('user_license_authority_other_name')[$i],
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
									if ($this->input->post('user_license_positions_id')[$i] !== '') {
										$user_license_position_id = $this->User_model->add_user_license_positions(array(
											'user_licenses_id' => $user_license_id,
											'positions_id' => $this->input->post('user_license_positions_id')[$i] !== '' ? $this->input->post('user_license_positions_id')[$i] : NULL
										));
										if ($this->input->post('user_license_positions_id')[$i] === '0') {
											$this->User_model->add_user_other_data_lookup(array(
												'user_license_positions_id' => $user_license_position_id,
												'user_license_position_other_name' => $this->input->post('user_license_position_other_name')[$i],
												'user_license_position_other_status' => '1'
													), 'user_license_position_others');
										}
									}
									if ($i === count($this->input->post('user_license_authorities_id')) - 1) {
										$user_profile_completeness = $user_profile_completeness + 10;
									}
								}
							}
						}
					}
					if ($user_details_array['job_type_slug'] === 'pilot') {
						//add pilot aircraft rating
						if ($this->User_model->edit_user_aircraft_rating_by_user_id($user_details_array['user_id'], array('user_aircraft_rating_status' => '-1'))) {
							for ($i = 0; $i < count($this->input->post('user_aircraft_rating_my_aircrafts_id')); $i++) {
								if ($this->input->post('user_aircraft_rating_my_aircrafts_id')[$i] !== '' || $this->input->post('user_aircraft_rating_last_flight')[$i] !== '' || $this->input->post('user_aircraft_rating_total_hours')[$i] !== '' || $this->input->post('user_aircraft_rating_pic_hours')[$i] !== '' || $this->input->post('user_aircraft_rating_sic_hours')[$i] !== '' || $this->input->post('user_aircraft_rating_recurrent')[$i] !== '' || isset($this->input->post('user_aircraft_rating_license_authorities_id')[$i]) || $this->input->post('user_aircraft_rating_training_file')[$i] !== '') {
									if (is_file(FCPATH . 'uploads/' . $this->input->post('user_aircraft_rating_training_file') [$i])) {
										if (!is_dir(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array ['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $this->input->post('user_aircraft_rating_training_file')[$i], FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $this->input->post('user_aircraft_rating_training_file')[$i])) {
											unlink(FCPATH . 'uploads/' . $this->input->post('user_aircraft_rating_training_file')[$i]);
										}
									}
									$aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
										'users_id' => $user_id,
										'my_aircrafts_id' => $this->input->post('user_aircraft_rating_my_aircrafts_id')[$i] !== '' ? $this->input->post('user_aircraft_rating_my_aircrafts_id')[$i] : NULL,
										'	user_aircraft_rating_last_flight' => $this->input->post('user_aircraft_rating_last_flight')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_aircraft_rating_last_flight')[$i]) : '',
										'user_aircraft_rating_total_hours' => $this->input->post('user_aircraft_rating_total_hours')[$i],
										'user_aircraft_rating_pic_hours' => $this->input->post('user_aircraft_rating_pic_hours')[$i],
										'user_aircraft_rating_sic_hours' => $this->input->post('user_aircraft_rating_sic_hours')[$i],
										'user_aircraft_rating_is_current' => count($this->input->post('user_aircraft_rating_is_current')) ? (in_array($i, $this->input->post('user_aircraft_rating_is_current')) ? '1' : '0') : '0',
										'user_aircraft_rating_recurrent' => $this->input->post('user_aircraft_rating_recurrent')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_aircraft_rating_recurrent') [$i]) : '',
										'user_aircraft_rating_training_file' => $this->input->post('user_aircraft_rating_training_file') [$i],
										'user_aircraft_rating_training_original_file' => $this->input->post('user_aircraft_rating_training_original_file') [$i],
										'user_aircraft_rating_status' => '1'
									));
									//add aircraft rating other aircraft type
									if ($this->input->post('user_aircraft_rating_my_aircrafts_id') [$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_aircraft_ratings_id' => $aircraft_rating_id,
											'user_aircraft_rating_aircraft_type_other_name' => $this->input->post('user_aircraft_rating_aircraft_type_other_name')[$i],
											'user_aircraft_rating_aircraft_type_other_status' => '1'
												), 'user_aircraft_rating_aircraft_type_others');
									}
									if ($aircraft_rating_id > 0) {
										if (isset($this->input->post('user_aircraft_rating_license_authorities_id')[$i]) && count($this->input->post('user_aircraft_rating_license_authorities_id')[$i]) > 0) {
											foreach ($this->input->post('user_aircraft_rating_license_authorities_id')[$i] as $license_authority) {
												$user_aircraft_rating_license_authority_id = $this->User_model->add_user_aircraft_rating_license_authority(array(
													'user_aircraft_ratings_id' => $aircraft_rating_id,
													'license_authorities_id' => $license_authority !== '' ? $license_authority : NULL
												));
												//add user aircraft rating other license authority
												if ($license_authority === '0') {
													$this->User_model->add_user_other_data_lookup(array(
														'user_aircraft_rating_license_authorities_id' => $user_aircraft_rating_license_authority_id,
														'user_aircraft_rating_license_authority_other_name' => $this->input->post('user_aircraft_rating_license_authority_other_name')[$i],
														'user_aircraft_rating_license_authority_other_status' => '1'
															), 'user_aircraft_rating_license_authority_others');
												}
											}
										}
									}
									if ($i === count($this->input->post('user_aircraft_rating_my_aircrafts_id')) - 1) {
										$user_profile_completeness = $user_profile_completeness + 10;
									}
								}
							}
						}
					} else if ($user_details_array['job_type_slug'] === 'maintenance-engineer') {
						//Maintenance Engineer aircraft rating
						if ($this->User_model->edit_user_aircraft_rating_by_user_id($user_details_array['user_id'], array('user_aircraft_rating_status' => '-1'), '0')) {
							for ($i = 0; $i < count($this->input->post('user_aircraft_rating_type_ratings_id')); $i++) {
								if ($this->input->post('user_aircraft_rating_type_ratings_id')[$i] !== '' || isset($this->input->post('user_aircraft_rating_coverage')[$i]) || $this->input->post('user_aircraft_rating_last_worked_on_ac')[$i] !== '' || $this->input->post('user_aircraft_rating_year_of_experience')[$i] !== '') {
									$aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
										'users_id' => $user_id,
										'type_ratings_id' => $this->input->post('user_aircraft_rating_type_ratings_id')[$i] !== '' ? $this->input->post('user_aircraft_rating_type_ratings_id')[$i] : NULL,
										'user_aircraft_rating_is_current' => count($this->input->post('user_aircraft_rating_is_current')) ? (in_array($i, $this->input->post('user_aircraft_rating_is_current')) ? '1' : '0') : '0',
										'user_aircraft_rating_year_of_experience' => $this->input->post('user_aircraft_rating_year_of_experience')[$i],
										'user_aircraft_rating_last_worked_on_ac' => $this->input->post('user_aircraft_rating_last_worked_on_ac')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_aircraft_rating_last_worked_on_ac')[$i]) : '',
										'user_aircraft_rating_is_other' => '0',
										'user_aircraft_rating_status' => '1'
									));
									if ($this->input->post('user_aircraft_rating_type_ratings_id')[$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_aircraft_ratings_id' => $aircraft_rating_id,
											'user_aircraft_rating_type_rating_other_name' => $this->input->post('user_aircraft_rating_type_rating_other_name')[$i],
											'user_aircraft_rating_type_rating_other_status' => '1'
												), 'user_aircraft_rating_type_rating_others');
									}
									if ($aircraft_rating_id > 0) {
										if (isset($this->input->post('user_aircraft_rating_coverage')[$i]) && count($this->input->post('user_aircraft_rating_coverage')[$i]) > 0) {
											foreach ($this->input->post('user_aircraft_rating_coverage')[$i] as $coverage) {
												$user_coverage_id = $this->User_model->add_user_aircraft_rating_coverages(array(
													'user_aircraft_ratings_id' => $aircraft_rating_id,
													'user_aircraft_rating_coverage_name' => $coverage
												));
												if ($coverage === 'Other') {
													$this->User_model->add_user_other_data_lookup(array(
														'user_aircraft_rating_coverages_id' => $user_coverage_id,
														'user_aircraft_rating_coverage_other_name' => $this->input->post('user_aircraft_rating_coverage_other_name')[$i]
															), 'user_aircraft_rating_coverage_others');
												}
											}
										}
									}
									if ($i === count($this->input->post('user_aircraft_rating_type_ratings_id')) - 1) {
										$user_profile_completeness = $user_profile_completeness + 10;
									}
								}
							}
						}
					}
					if (isset($user_details_array) && $user_details_array['job_type_slug'] === 'air-traffic-controller') {
						//add Ratings
						if ($this->User_model->edit_user_rating_by_user_id(array('user_rating_status' => '-1'), $user_details_array['user_id'])) {
							if (count($this->input->post('type_ratings_id')) > 0) {
								foreach ($this->input->post('type_ratings_id') as $ratings) {
									$user_rating_id = $this->User_model->add_user_rating(array(
										'users_id' => $user_id,
										'type_ratings_id' => $ratings !== '' ? $ratings : NULL,
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
								$user_profile_completeness = $user_profile_completeness + 10;
							}
						}
					}
					if ($this->User_model->edit_user_experience_by_user_id($user_details_array['user_id'], array('user_experience_status' => '-1'))) {
						if (count($this->input->post('user_experience_locations_id')) > 0) {
							foreach ($this->input->post('user_experience_locations_id') as $experience) {
								$this->User_model->add_user_experience(array(
									'users_id' => $user_details_array['user_id'],
									'locations_id' => $experience,
									'user_experience_status' => '1', 'user_experience_is_other' => '0'
								));
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
						if (count($this->input->post('user_experience_countries_id')) > 0) {
							foreach ($this->input->post('user_experience_countries_id') as $experience) {
								$this->User_model->add_user_experience(array(
									'users_id' => $user_details_array['user_id'],
									'countries_id' => $experience,
									'user_experience_status' => '1',
									'user_experience_is_other' => '0'
								));
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
					if ($user_details_array['job_type_slug'] === 'pilot') {
						if ($this->User_model->edit_user_type_rating_by_user_id($user_details_array['user_id'], array('user_type_rating_status' => '-1'))) {
							if (count($type_rating_array) > 0) {
								$this->User_model->add_user_type_rating($type_rating_array);
							}
						}
					}
					if ($user_details_array['job_type_slug'] === 'flight-attendant') {
						if ($this->User_model->edit_user_skill_by_user_id($user_details_array['user_id'], array('user_skill_status' => '-1'))) {
							if (count($this->input->post('user_skills_id')) > 0) {
								foreach ($this->input->post('user_skills_id') as $skill) {
									$user_skill_id = $this->User_model->add_user_skill(array(
										'users_id' => $user_details_array ['user_id'], 'skills_id' => $skill,
										'user_skill_status' => '1'
									));
									if ($skill === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_skills_id' => $user_skill_id,
											'user_skill_other_name' => $this->input->post('user_skill_other_name'),
											'user_skill_other_status' => '1'
												), 'user_skill_others');
									}
								}
							}
						}
					}
					if ($this->User_model->edit_user_training_by_user_id($user_details_array['user_id'], array('user_training_status' => '-1'))) {
						if (count($training_array) > 0) {
							foreach ($training_array as $key => $training) {
								$training_id = $this->User_model->add_user_training($training);
								if ($training_id > 0) {
									if ($training['trainings_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_trainings_id' => $training_id,
											'user_training_course_other_name' => $this->input->post('other_training')[$key]
												), 'user_training_course_others');
									}
								}
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
					if ($this->User_model->edit_user_validation_by_user_id($user_details_array['user_id'], array('user_validation_status' => '-1'))) {
						if (count($validation_array) > 0) {
							if (count($this->input->post('user_validation_file')) > 0) {
								foreach ($this->input->post('user_validation_file') as $user_validation_file) {
									if (is_file(FCPATH . 'uploads/' . $user_validation_file)) {
										if (!is_dir(FCPATH . 'uploads/users/validations' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/validations' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $user_validation_file, FCPATH . 'uploads/users/validations' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_validation_file)) {
											unlink(FCPATH . 'uploads/' . $user_validation_file);
										}
									}
								}
							}
							foreach ($validation_array as $key => $validation) {
								$user_validation_id = $this->User_model->add_user_validation($validation);
								//add other validation aircraft type
								if (isset($validation['my_aircrafts_id'])) {
									if ($validation['my_aircrafts_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_validations_id' => $user_validation_id,
											'user_validation_aircraft_type_other_name' => $this->input->post('user_validation_aircraft_type_other_name')[$key],
											'user_validation_aircraft_type_other_status' => '1'
												), 'user_validation_aircraft_type_others');
									}
								}
								if (isset($validation['licenses_id'])) {
									if ($validation['licenses_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_validations_id' => $user_validation_id,
											'user_validation_license_type_other_name' => $this->input->post('user_validation_license_type_other_name')[$key],
											'user_validation_license_type_other_status' => '1'
												), 'user_validation_license_type_others');
									}
								}
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
					if ($this->User_model->edit_user_passport_by_user_id($user_details_array['user_id'], array('user_passport_status' => '-1'))) {
						if (count($passport_array) > 0) {
							if (count($this->input->post('user_passport_file')) > 0) {
								foreach ($this->input->post('user_passport_file') as $user_passport_file) {
									if (is_file(FCPATH . 'uploads/' . $user_passport_file)) {
										if (!is_dir(FCPATH . 'uploads/users/passports' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/passports' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $user_passport_file, FCPATH . 'uploads/users/passports' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_passport_file)) {
											unlink(FCPATH . 'uploads/' . $user_passport_file);
										}
									}
								}
							}
							if ($this->User_model->add_user_passport($passport_array)) {
								$user_profile_completeness = $user_profile_completeness + 10;
							}
						}
					}
					if ($this->User_model->edit_user_visa_by_user_id($user_details_array['user_id'], array('user_visa_status' => '-1'))) {
						if (count($visa_array) > 0) {
							if (count($this->input->post('user_visa_file')) > 0) {
								foreach ($this->input->post('user_visa_file') as $user_visa_file) {
									if (is_file(FCPATH . 'uploads/' . $user_visa_file)) {
										if (!is_dir(FCPATH . 'uploads/users/visas' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/visas' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $user_visa_file, FCPATH . 'uploads/users/visas' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_visa_file)) {
											unlink(FCPATH . 'uploads/' . $user_visa_file);
										}
									}
								}
							}
							if ($this->User_model->add_user_visa($visa_array)) {
								$user_profile_completeness = $user_profile_completeness + 10;
							}
						}
					}
					if ($this->User_model->edit_user_medical_certificate_by_user_id($user_details_array['user_id'], array('user_medical_certificate_status' => '-1'), '0')) {
						if (count($user_medical_array) > 0) {
							if (count($this->input->post('user_medical_certificate_file')) > 0) {
								foreach ($this->input->post('user_medical_certificate_file') as $user_medical_certificate_file) {
									if (is_file(FCPATH . 'uploads/' . $user_medical_certificate_file)) {
										if (!is_dir(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
											mkdir(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
										}
										if (copy(base_url() . 'uploads/' . $user_medical_certificate_file, FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_medical_certificate_file)) {
											unlink(FCPATH . 'uploads/' . $user_medical_certificate_file);
										}
									}
								}
							}
							foreach ($user_medical_array as $key => $user_medical) {
								$user_medical_id = $this->User_model->add_user_medical_certificate($user_medical);
								if ($user_medical_id > 0) {
									if ($user_medical['license_authorities_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_medical_certificates_id' => $user_medical_id,
											'user_medical_certificate_authority_other_name' => $this->input->post('user_medical_other_authority')[$key]
												), 'user_medical_certificate_authority_others');
									}
								}
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
					if ($this->User_model->edit_user_previous_employment_by_user_id($user_details_array['user_id'], array('user_previous_employment_status' => '-1'))) {
						if (count($previous_employment_array) > 0) {
							foreach ($previous_employment_array as $key => $previous_employment) {
								$previous_employment_id = $this->User_model->add_user_previous_employment($previous_employment);
								if ($previous_employment_id > 0) {
									if ($previous_employment['positions_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_previous_employments_id' => $previous_employment_id,
											'user_previous_employment_position_other_name' => $this->input->post('user_previous_employment_other_position')[$key]
												), 'user_previous_employment_position_others');
									}
								}
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
					if ($this->User_model->edit_user_reference_by_user_id($user_details_array['user_id'], array('user_reference_status' => '-1'))) {
						if (count($reference_array) > 0) {
							foreach ($reference_array as $key => $reference) {
								$reference_id = $this->User_model->add_user_reference($reference);
								if ($reference_id > 0) {
									if ($reference['positions_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_references_id' => $reference_id,
											'user_reference_position_other_name' => $this->input->post('user_reference_other_position')[$key]
												), 'user_reference_position_others');
									}
								}
							}
							$user_profile_completeness = $user_profile_completeness + 5;
						}
					}
//add desired employment
					if ($this->User_model->edit_user_employment_by_user_id($user_details_array ['user_id'], array('user_employment_status' => '-1'))) {
						for ($i = 0; $i < count($this->input->post('user_employment_desired_position')); $i++) {
							if ($this->input->post('user_employment_desired_position')[$i] !== '' || count($this->input->post('user_employment_positions_id')[$i]) > 0 || $this->input->post('user_employment_preferred_company')[$i] !== '' || $this->input->post('user_employment_type')[$i] !== '' || $this->input->post('user_employment_willing_to_relocate')[$i] !== '' || count($this->input->post('user_employment_location')) > 0 || $this->input->post('user_employment_availability')[$i] !== '') {
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
								if (isset($this->input->post('user_employment_positions_id')[$i]) && count($this->input->post('user_employment_positions_id')[$i]) > 0) {
									foreach ($this->input->post('user_employment_positions_id') [$i] as $position) {
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
								if ($i === count($this->input->post('user_employment_desired_position')) - 1) {
									$user_profile_completeness = $user_profile_completeness + 5;
								}
							}
						}
					}
					//Other skill updation - ME license
					if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') {
						if ($this->User_model->edit_user_license_by_user_id($user_details_array['user_id'], array('user_license_status' => '-1'), '1', '2')) {
							if (count($me_license_array) > 0) {
								if (count($this->input->post('user_me_license_file')) > 0) {
									foreach ($this->input->post('user_me_license_file') as $user_me_license_file) {
										if (is_file(FCPATH . 'uploads/' . $user_me_license_file)) {
											if (!is_dir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
												mkdir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
											}
											if (copy(base_url() . 'uploads/' . $user_me_license_file, FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $user_me_license_file)) {
												unlink(FCPATH . 'uploads/' . $user_me_license_file);
											}
										}
									}
								}
								foreach ($me_license_array as $key => $me_license) {
									$me_license_id = $this->User_model->add_user_license($me_license);
									if ($me_license['license_authorities_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $me_license_id,
											'user_license_authority_other_name' => $this->input->post('user_me_license_authority_other_name')[$key],
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
									if ($me_license['licenses_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $me_license_id,
											'user_license_type_other_name' => $this->input->post('user_me_license_type_other_name')[$key],
											'user_license_type_other_status' => '1'
												), 'user_license_type_others');
									}
								}
							}
						}
					}
					//other skill add pilot license
					if ($user_details_array['job_type_slug'] !== 'pilot') {
						if ($this->User_model->edit_user_license_by_user_id($user_details_array['user_id'], array('user_license_status' => '-1'), '1', '1')) {
							if (count($pilot_license_array) > 0) {
								if (count($this->input->post('pilot_license_file')) > 0) {
									foreach ($this->input->post('pilot_license_file') as $pilot_license_file) {
										if (is_file(FCPATH . 'uploads/' . $pilot_license_file)) {
											if (!is_dir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
												mkdir(FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])), 0777, TRUE);
											}
											if (copy(base_url() . 'uploads/' . $pilot_license_file, FCPATH . 'uploads/users/licenses' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $pilot_license_file)) {
												unlink(FCPATH . 'uploads/' . $pilot_license_file);
											}
										}
									}
								}
								foreach ($pilot_license_array as $key => $pilot_license) {
									$pilot_license_id = $this->User_model->add_user_license($pilot_license);
									if ($pilot_license['license_authorities_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $pilot_license_id,
											'user_license_authority_other_name' => $this->input->post('user_pilot_license_authority_other_name')[$key],
											'user_license_authority_other_status' => '1'
												), 'user_license_authority_others');
									}
									if ($pilot_license['licenses_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $pilot_license_id,
											'user_license_type_other_name' => $this->input->post('user_pilot_license_type_other_name')[$key],
											'user_license_type_other_status' => '1'
												), 'user_license_type_others');
									}
									if ($pilot_license['approval_ratings_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_licenses_id' => $pilot_license_id,
											'user_license_approval_rating_other_name' => $this->input->post('user_pilot_license_approval_rating_other_name')[$key],
											'user_license_approval_rating_other_status' => '1'
												), 'user_license_approval_rating_others');
									}
								}
							}
						}
					}
					//add me aircraft rating
					if ($user_details_array['job_type_slug'] !== 'maintenance-engineer') {
						if ($this->User_model->edit_user_aircraft_rating_by_user_id($user_details_array['user_id'], array('user_aircraft_rating_status' => '-1'), '1', '2')) {
							for ($i = 0; $i < count($this->input->post('user_me_aircraft_rating_type_ratings_id')); $i++) {
								if ($this->input->post('user_me_aircraft_rating_type_ratings_id')[$i] !== '' || count($this->input->post('user_me_aircraft_rating_coverage')[$i]) > 0 || $this->input->post('user_me_aircraft_rating_last_worked_on_ac')[$i] !== '' || $this->input->post('user_me_aircraft_rating_year_of_experience')[$i] !== '') {
									$aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
										'users_id' => $user_id,
										'type_ratings_id' => $this->input->post('user_me_aircraft_rating_type_ratings_id')[$i] !== '' ? $this->input->post('user_me_aircraft_rating_type_ratings_id')[$i] : NULL,
										'user_aircraft_rating_is_current' => count($this->input->post('user_me_aircraft_rating_is_current')) ? (in_array($i, $this->input->post('user_me_aircraft_rating_is_current')) ? '1' : '0') : '0',
										'user_aircraft_rating_year_of_experience' => $this->input->post('user_me_aircraft_rating_year_of_experience')[$i],
										'user_aircraft_rating_last_worked_on_ac' => $this->input->post('user_me_aircraft_rating_last_worked_on_ac')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_me_aircraft_rating_last_worked_on_ac')[$i]) : '',
										'user_aircraft_rating_status' => '1',
										'user_aircraft_rating_category' => '2',
										'user_aircraft_rating_is_other' => '1'
									));
									if ($this->input->post('user_me_aircraft_rating_type_ratings_id')[$i] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_aircraft_ratings_id' => $aircraft_rating_id,
											'user_aircraft_rating_type_rating_other_name' => $this->input->post('user_me_aircraft_rating_type_rating_other_name')[$i],
											'user_aircraft_rating_type_rating_other_status' => '1'
												), 'user_aircraft_rating_type_rating_others');
									}
									if ($aircraft_rating_id > 0) {
										if (isset($this->input->post('user_me_aircraft_rating_coverage')[$i]) && count($this->input->post('user_me_aircraft_rating_coverage')[$i]) > 0) {
											foreach ($this->input->post('user_me_aircraft_rating_coverage')[$i] as $coverage) {
												$me_coverage_id = $this->User_model->add_user_aircraft_rating_coverages(array(
													'user_aircraft_ratings_id' => $aircraft_rating_id,
													'user_aircraft_rating_coverage_name' => $coverage
												));
												if ($coverage === 'Other') {
													$this->User_model->add_user_other_data_lookup(array(
														'user_aircraft_rating_coverages_id' => $me_coverage_id,
														'user_aircraft_rating_coverage_other_name' => $this->input->post('user_me_aircraft_rating_coverage_other_name')[$i]
															), 'user_aircraft_rating_coverage_others');
												}
											}
										}
									}
								}
							}
						}
					}
					//add pilot aircraft rating - other skills
					if ($user_details_array['job_type_slug'] !== 'pilot') {
						for ($i = 0; $i < count($this->input->post('pilot_aircraft_rating_my_aircrafts_id')); $i++) {
							if ($this->User_model->edit_user_aircraft_rating_by_user_id($user_details_array['user_id'], array('user_aircraft_rating_status' => '-1'), '1', '1')) {
								for ($i = 0; $i < count($this->input->post('pilot_aircraft_rating_my_aircrafts_id')); $i++) {
									if ($this->input->post('pilot_aircraft_rating_my_aircrafts_id')[$i] !== '' || $this->input->post('pilot_aircraft_rating_last_flight')[$i] !== '' || $this->input->post('pilot_aircraft_rating_recurrent')[$i] !== '' || isset($this->input->post('pilot_aircraft_rating_license_authorities_id')[$i]) || $this->input->post('pilot_aircraft_rating_training_file')[$i] !== '') {
										if (is_file(FCPATH . 'uploads/' . $this->input->post('pilot_aircraft_rating_training_file') [$i])) {
											if (!is_dir(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
												mkdir(FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array ['user_created'])), 0777, TRUE);
											}
											if (copy(base_url() . 'uploads/' . $this->input->post('pilot_aircraft_rating_training_file')[$i], FCPATH . 'uploads/users/ratings' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $this->input->post('pilot_aircraft_rating_training_file')[$i])) {
												unlink(FCPATH . 'uploads/' . $this->input->post('pilot_aircraft_rating_training_file')[$i]);
											}
										}
										$pilot_aircraft_rating_id = $this->User_model->add_user_aircraft_rating(array(
											'users_id' => $user_id,
											'my_aircrafts_id' => $this->input->post('pilot_aircraft_rating_my_aircrafts_id')[$i] !== '' ? $this->input->post('pilot_aircraft_rating_my_aircrafts_id')[$i] : NULL,
											'	user_aircraft_rating_last_flight' => $this->input->post('pilot_aircraft_rating_last_flight')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('pilot_aircraft_rating_last_flight')[$i]) : '',
											'user_aircraft_rating_recurrent' => $this->input->post('pilot_aircraft_rating_recurrent')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('pilot_aircraft_rating_recurrent') [$i]) : '',
											'user_aircraft_rating_training_file' => $this->input->post('pilot_aircraft_rating_training_file')[$i],
											'user_aircraft_rating_training_original_file' => $this->input->post('pilot_aircraft_rating_training_original_file')[$i],
											'user_aircraft_rating_status' => '1',
											'user_aircraft_rating_category' => '1',
											'user_aircraft_rating_is_other' => '1'
										));
										if ($this->input->post('pilot_aircraft_rating_my_aircrafts_id')[$i] === '0') {
											$this->User_model->add_user_other_data_lookup(array(
												'user_aircraft_ratings_id' => $pilot_aircraft_rating_id,
												'user_aircraft_rating_aircraft_type_other_name' => $this->input->post('pilot_aircraft_rating_aircraft_type_other_name')[$i],
												'user_aircraft_rating_aircraft_type_other_status' => '1'
													), 'user_aircraft_rating_aircraft_type_others');
										}
										if ($pilot_aircraft_rating_id > 0) {
											if (isset($this->input->post('pilot_aircraft_rating_license_authorities_id')[$i]) && count($this->input->post('pilot_aircraft_rating_license_authorities_id')[$i]) > 0) {
												foreach ($this->input->post('pilot_aircraft_rating_license_authorities_id')[$i] as $license_authority) {
													$pilot_aircraft_rating_license_authority_id = $this->User_model->add_user_aircraft_rating_license_authority(array(
														'user_aircraft_ratings_id' => $pilot_aircraft_rating_id,
														'license_authorities_id' => $license_authority
													));
													if ($license_authority === '0') {
														$this->User_model->add_user_other_data_lookup(array(
															'user_aircraft_rating_license_authorities_id' => $pilot_aircraft_rating_license_authority_id,
															'user_aircraft_rating_license_authority_other_name' => $this->input->post('pilot_aircraft_rating_license_authority_other_name')[$i],
															'user_aircraft_rating_license_authority_other_status' => '1'
																), 'user_aircraft_rating_license_authority_others');
													}
												}
											}
										}
									}
								}
							}
						}
					}
					//add pilot area experience
					if ($user_details_array['job_type_slug'] !== 'pilot') {
						if ($this->User_model->edit_user_experience_by_user_id($user_details_array['user_id'], array('user_experience_status' => '-1'), '1')) {
							if (count($this->input->post('pilot_experience_locations_id')) > 0) {
								foreach ($this->input->post('pilot_experience_locations_id') as $experience) {
									$this->User_model->add_user_experience(array(
										'users_id' => $user_details_array['user_id'],
										'locations_id' => $experience, 'user_experience_is_other' => '1',
										'user_experience_status' => '1'
									));
								}
							}
						}
						if ($this->User_model->edit_user_area_experience_by_user_id($user_details_array['user_id'], array('user_area_experience_status' => '-1'))) {
							if ($this->input->post('pilot_atlantic_crossing') !== '' || $this->input->post('pilot_pacific_crossing') !== '' || $this->input->post('pilot_polar_crossing') !== '') {
								$this->User_model->add_user_area_experience(array(
									'users_id' => $user_details_array['user_id'],
									'user_area_experience_atlantic_crossings' => $this->input->post('pilot_atlantic_crossing'),
									'user_area_experience_pacific_crossings' => $this->input->post('pilot_pacific_crossing'),
									'user_area_experience_polar_crossings' => $this->input->post('pilot_polar_crossing'),
									'user_area_experience_status' => '1',
								));
							}
						}
					}
					if ($user_details_array['job_type_slug'] !== 'pilot') {
//add pilot flight time
						if ($this->User_model->edit_pilot_flight_time_by_user_id($user_details_array['user_id'], array('user_flight_time_status' => '-1'))) {
							if (count($pilot_flight_time_array) > 0) {
								$this->User_model->add_pilot_flight_time($pilot_flight_time_array);
							}
						}
					}
					//add pilot medical certificate
					if (isset($user_details_array) && $user_details_array['job_type_slug'] !== 'pilot' && $user_details_array['job_type_slug'] !== 'air-traffic-controller') {
						if ($this->User_model->edit_user_medical_certificate_by_user_id($user_details_array['user_id'], array('user_medical_certificate_status' => '-1'), '1')) {
							if (count($pilot_medical_certificate_array) > 0) {
								if (count($this->input->post('pilot_medical_certificate_file')) > 0) {
									foreach ($this->input->post('pilot_medical_certificate_file') as $pilot_medical_certificate_file) {
										if (is_file(FCPATH . 'uploads/' . $pilot_medical_certificate_file)) {
											if (!is_dir(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])))) {
												mkdir(FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array ['user_created'])), 0777, TRUE);
											}
											if (copy(base_url() . 'uploads/' . $pilot_medical_certificate_file, FCPATH . 'uploads/users/medical_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created'])) . $pilot_medical_certificate_file)) {
												unlink(FCPATH . 'uploads/' . $pilot_medical_certificate_file);
											}
										}
									}
								}
								foreach ($pilot_medical_certificate_array as $key => $pilot_medical_certificate) {
									$pilot_medical_certificate_id = $this->User_model->add_user_medical_certificate($pilot_medical_certificate);
									if ($pilot_medical_certificate['license_authorities_id'] === '0') {
										$this->User_model->add_user_other_data_lookup(array(
											'user_medical_certificates_id' => $pilot_medical_certificate_id,
											'user_medical_certificate_authority_other_name' => $this->input->post('pilot_medical_certificate_license_authority_other_name')[$key],
												), 'user_medical_certificate_authority_others');
									}
								}
							}
						}
					}
					//add retired pilot
					if ($user_details_array['job_type_slug'] === 'air-traffic-controller') {
						if ($this->User_model->edit_user_retired_pilot_by_user_id($user_details_array['user_id'], array('user_retired_pilot_status' => '-1'))) {
							if (count($retired_pilot_array) > 0) {
								$retired_pilot_id = $this->User_model->add_user_retired_pilot($retired_pilot_array);
								if ($retired_pilot_array['positions_id'] === '0') {
									$this->User_model->add_user_other_data_lookup(array(
										'user_retired_pilots_id' => $retired_pilot_id,
										'user_retired_pilot_current_position_other_name' => $this->input->post('user_retired_pilot_current_position_other_name'),
										'user_retired_pilot_current_position_other_status' => '1'
											), 'user_retired_pilot_current_position_others');
								}
							}
						}
					}
					//add managment experience
					if ($user_details_array['job_type_slug'] !== 'executive' && $user_details_array['job_type_slug'] !== 'corporate') {
						if ($this->User_model->edit_user_management_experiences_by_user_id($user_details_array['user_id'], array('user_management_experience_status' => '-1'))) {
							if (count($this->input->post('user_management_experiences_id')) > 0 || $this->input->post('user_management_experience_company') !== '' || $this->input->post('user_management_experience_years_experience') !== '') {
								$management_experience_id = $this->User_model->add_user_management_experiences(array(
									'users_id' => $user_details_array['user_id'],
									'user_management_experience_company' => $this->input->post('user_management_experience_company'), 'user_management_experience_years_experience' => $this->input->post('user_management_experience_years_experience'),
									'user_management_experience_status' => '1',
									'user_management_experience_created' => date('Y-m-d H:i:s')
								));
								if (count($this->input->post('user_management_experiences_id')) > 0) {
									foreach ($this->input->post('user_management_experiences_id') as $user_management_experience) {
										$user_management_experience_type_id = $this->User_model->add_user_management_experience_type(array(
											'user_management_experiences_id' => $management_experience_id,
											'management_experiences_id' => $user_management_experience
										));
										if ($user_management_experience === '0') {
											$this->User_model->add_user_other_data_lookup(array(
												'user_management_experience_types_id' => $user_management_experience_type_id,
												'user_management_experience_type_other_name' => $this->input->post('user_management_experience_type_other_name'),
												'user_management_experience_type_other_status' => '1'
													), 'user_management_experience_type_others');
										}
									}
								}
							}
						}
					}
					if ($this->User_model->edit_user_by_user_id($user_details_array['user_id'], array('user_profile_completeness' => $user_profile_completeness))) {
						if ($this->regenerate_session()) {
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
		$data['position_array'] = $this->User_model->get_positions_by_job_type_id($user_details_array['job_type_id']);
		$data['user_countries_of_experience_array'] = $this->User_model->get_user_countries_of_experience_by_user_id($user_details_array['user_id']);
		$data['user_position_array'] = $this->User_model->get_user_current_positions_by_user_id($user_details_array['user_id']);
		foreach ($data['user_position_array'] as $key => $user_position) {
			$data['user_position_array'][$key]['user_current_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_current_positions_id', 'user_current_position_others', $user_position['user_current_position_id']);
		}
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['license_array'] = $this->User_model->get_licenses_by_job_type_id($user_details_array['job_type_id']);
		$data['me_license_array'] = $this->User_model->get_licenses_by_job_type_id('2');
		$data['pilot_license_array'] = $this->User_model->get_licenses_by_job_type_id('1');
		$data['skill_array'] = $this->User_model->get_skills_by_job_type_id($user_details_array['job_type_id']);
		$data['user_skill_array'] = $this->User_model->get_user_skill_by_user_id($user_details_array['user_id']);
		foreach ($data['user_skill_array'] as $key => $user_skill) {
			$data['user_skill_array'][$key]['user_skill_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_skills_id', 'user_skill_others', $user_skill['user_skill_id']);
		}
		//fetch all licenses and lookups
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_details_array['user_id'], '0');
		foreach ($data['user_license_array'] as $key => $user_license) {
			$data['user_license_array'][$key]['user_license_position_array'] = $this->User_model->get_user_license_position_by_user_license_id($user_license['user_license_id']);
			foreach ($data['user_license_array'][$key]['user_license_position_array'] as $key1 => $position) {
				$data['user_license_array'][$key]['user_license_position_array'][$key1]['user_license_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_license_positions_id', 'user_license_position_others', $position['user_license_position_id']);
			}
			$data['user_license_array'][$key]['user_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $user_license['user_license_id']);
			$data['user_license_array'][$key]['user_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $user_license['user_license_id']);
			$data['user_license_array'][$key]['user_license_approval_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_approval_rating_others', $user_license['user_license_id']);
		}
		$data['user_me_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_details_array['user_id'], '1', '2');
		foreach ($data['user_me_license_array'] as $key => $user_me_license) {
			$data['user_me_license_array'][$key]['user_me_license_authority_other_position'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $user_me_license['user_license_id']);
			$data['user_me_license_array'][$key]['user_me_license_type_other_position'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $user_me_license['user_license_id']);
		}
		$data['user_pilot_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_details_array['user_id'], '1', '1');
		foreach ($data['user_pilot_license_array'] as $key => $pilot_license) {
			$data['user_pilot_license_array'][$key]['user_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $pilot_license['user_license_id']);
			$data['user_pilot_license_array'][$key]['user_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $pilot_license['user_license_id']);
			$data['user_pilot_license_array'][$key]['user_license_approval_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_approval_rating_others', $pilot_license['user_license_id']);
		}
		//get aircraft rating data and lookup values
		$data['user_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_details_array['user_id'], '0');
		foreach ($data['user_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
				$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_license_authorities_id', 'user_aircraft_rating_license_authority_others', $license_authority['user_aircraft_rating_license_authority_id']);
			}
			$data['user_aircraft_rating_array'][$key]['user_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_aircraft_type_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		foreach ($data['user_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_coverages'] = $this->User_model->get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_aircraft_rating_array'][$key]['user_aircraft_rating_coverages'] as $key1 => $rating_coverage) {
				$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_coverages'][$key1]['user_aircraft_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_coverages_id', 'user_aircraft_rating_coverage_others', $rating_coverage['user_aircraft_rating_coverage_id']);
			}
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_type_rating_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		$data['user_me_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_details_array['user_id'], '1', '2');
		foreach ($data['user_me_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_me_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
		}
		foreach ($data['user_me_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_type_rating_others', $aircraft_rating['user_aircraft_rating_id']);
			$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'] = $this->User_model->get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'] as $key1 => $rating_coverage) {
				$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'][$key1]['user_aircraft_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_coverages_id', 'user_aircraft_rating_coverage_others', $rating_coverage['user_aircraft_rating_coverage_id']);
			}
		}
		$data['user_pilot_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_details_array['user_id'], '1', '1');
		foreach ($data['user_pilot_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
				$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_license_authorities_id', 'user_aircraft_rating_license_authority_others', $license_authority['user_aircraft_rating_license_authority_id']);
			}
			$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_aircraft_type_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		//get user references data and lookups
		$data['user_reference_array'] = $this->User_model->get_user_reference_by_user_id($user_details_array['user_id']);
		foreach ($data['user_reference_array'] as $key => $user_reference) {
			if ($user_reference['positions_id'] === '0') {
				$data['user_reference_array'][$key]['user_reference_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_references_id', 'user_reference_position_others', $user_reference['user_reference_id']);
			}
		}
		$data['approval_rating_array'] = $this->User_model->get_approval_ratings();
		$data['maintainance_license_type_array'] = $this->maintainance_license_type_array;
		$data['user_details_array'] = $user_details_array;
		//get user employment data and lookups
		$data['user_employment_array'] = $this->User_model->get_user_employment_by_user_id($user_details_array['user_id']);
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_locations'] = $this->User_model->get_user_employment_location_by_user_employment_id($user_employment['user_employment_id']);
		}
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_positions'] = $this->User_model->get_user_employment_position_by_user_employment_id($user_employment['user_employment_id']);
			foreach ($data['user_employment_array'][$key]['user_employment_positions'] as $key1 => $employment_position) {
				$data['user_employment_array'][$key]['user_employment_positions'][$key1]['user_employment_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_employment_positions_id', 'user_employment_position_others', $employment_position['user_employement_position_id']);
			}
		}
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data['me_type_rating_array'] = $this->User_model->get_active_type_ratings_by_job_type_id('2');
		$data['user_passport_array'] = $this->User_model->get_user_passports_by_user_id($user_details_array['user_id']);
		$data['type_rating_array'] = $this->User_model->get_active_type_ratings_by_job_type_id($data['user_details_array']['job_type_id'] === '7' ? '7' : '2');
		//get user previous employment data and lookups
		$data['user_previous_employment_array'] = $this->User_model->get_user_previous_employments_by_user_id($user_details_array['user_id']);
		foreach ($data['user_previous_employment_array'] as $key => $user_previous_employment) {
			if ($user_previous_employment['positions_id'] === '0') {
				$data['user_previous_employment_array'][$key]['user_previous_employment_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_previous_employments_id', 'user_previous_employment_position_others', $user_previous_employment['user_previous_employment_id']);
			}
		}
		//validation data get
		$data['user_validation_array'] = $this->User_model->get_user_validations_by_user_id($user_details_array['user_id']);
		foreach ($data['user_validation_array'] as $key => $validation) {
			$data['user_validation_array'][$key]['user_validation_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_validations_id', 'user_validation_aircraft_type_others', $validation['user_validation_id']);
			$data['user_validation_array'][$key]['user_validation_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_validations_id', 'user_validation_license_type_others', $validation['user_validation_id']);
		}
		$data['user_visa_array'] = $this->User_model->get_user_visas_by_user_id($user_details_array['user_id']);
		$data['training_array'] = $this->User_model->get_trainings_by_job_type_id($user_details_array['job_type_id']);
		//get training data and lookups
		$data['user_training_array'] = $this->User_model->get_user_training_by_user_id($user_details_array['user_id']);
		foreach ($data['user_training_array'] as $key => $user_training) {
			if ($user_training['trainings_id'] === '0') {
				$data['user_training_array'][$key]['user_training_course_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_trainings_id', 'user_training_course_others', $user_training['user_training_id']);
			}
		}
		$data['user_rating_array'] = $this->User_model->get_user_rating_by_user_id($user_id);
		foreach ($data['user_rating_array'] as $key => $type_rating) {
			$data['user_rating_array'][$key]['user_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_ratings_id', 'user_rating_others', $type_rating['user_rating_id']);
		}
		//user medical certificate get data and lookup
		$data['user_medical_array'] = $this->User_model->get_user_medical_certificate_by_user_id($user_details_array['user_id'], '0');
		foreach ($data['user_medical_array'] as $key => $user_medical) {
			if ($user_medical['license_authorities_id'] === '0') {
				$data['user_medical_array'][$key]['user_medical_certificate_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_medical_certificates_id', 'user_medical_certificate_authority_others', $user_medical['user_medical_certificate_id']);
			}
		}
		$data['pilot_medical_array'] = $this->User_model->get_user_medical_certificate_by_user_id($user_details_array['user_id'], '1');
		foreach ($data['pilot_medical_array'] as $key => $user_medical) {
			if ($user_medical['license_authorities_id'] === '0') {
				$data['pilot_medical_array'][$key]['user_medical_certificate_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_medical_certificates_id', 'user_medical_certificate_authority_others', $user_medical['user_medical_certificate_id']);
			}
		}
//        pr($data['pilot_medical_array']);
		$data['notice_period_array'] = $this->notice_period_array;
		$data['user_experience_array'] = $this->User_model->get_user_experience_by_user_id($user_details_array['user_id'], '0');
		$data['pilot_experience_array'] = $this->User_model->get_user_experience_by_user_id($user_details_array['user_id'], '1');
		$data['user_area_experience_array'] = $this->User_model->get_user_area_experience_by_user_id($user_details_array['user_id']);
		$data['model_array'] = $this->Aircraft_model->get_models();
		$data['location_array'] = $this->User_model->get_active_locations();
		$data['employee_role_array'] = $this->User_model->get_employee_roles_by_job_type_id($user_details_array['job_type_id']);
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($user_id);
		foreach ($data['user_aircraft_experience_array'] as $key => $aircraft_experience) {
			$data['user_aircraft_experience_array'][$key]['user_aircraft_experience_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_experiences_id', 'user_aircraft_experience_aircraft_type_others', $aircraft_experience['user_aircraft_experience_id']);
		}
		$data['license_authority_array'] = $this->User_model->get_active_license_authorities();
		$data['endorsement_array'] = $this->endorsement_array;
		$data['relation_array'] = $this->relation_array;
		$data['management_experience_array'] = $this->User_model->get_management_experience();
		$data['pilot_flight_time_array'] = $this->User_model->get_user_flight_time_by_user_id($user_details_array['user_id']);
		//get user management experience and lookups
		$data['user_management_experience_array'] = $this->User_model->get_user_management_experiences_by_user_id($user_details_array['user_id']);
		foreach ($data['user_management_experience_array'] as $key => $management_experience) {
			$data['user_management_experience_array'][$key]['management_experience_types'] = $this->User_model->get_user_management_experience_type_by_user_m_e_id($management_experience['user_management_experience_id']);
			foreach ($data['user_management_experience_array'][$key]['management_experience_types'] as $key1 => $management_experience_types) {
				$data['user_management_experience_array'][$key]['management_experience_types'][$key1]['user_management_experience_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_management_experience_types_id', 'user_management_experience_type_others', $management_experience_types['user_management_experience_type_id']);
			}
		}
		$data['user_retired_pilot_array'] = $this->User_model->get_user_retired_pilot_by_user_id($user_details_array['user_id']);
		if (count($data['user_retired_pilot_array']) > 0) {
			$data['user_retired_pilot_array']['user_retired_pilot_current_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_retired_pilots_id', 'user_retired_pilot_current_position_others', $data['user_retired_pilot_array']['user_retired_pilot_id']);
		}
		$data['pilot_position_array'] = $this->User_model->get_positions_by_job_type_id('1');
		$data['user_employment_type_array'] = $this->user_employment_type_array;
		$data['title'] = 'Employee Edit Profile';
		parent:: render_view($data, 'common');
	}

	function profile($user_first_name = '', $user_id = '') {
		parent::allow(array('administrator', 'employer', 'employee'));
		$data = array();
		$this->load->model('Aircraft_model');
		$this->load->model('Auth_model');
		if ($user_id === '') {
			$user_id = $_SESSION['user'] ['user_id'];
			$user_first_name = $_SESSION['user']['user_first_name'] . '-' . $_SESSION['user']['user_last_name'];
		}
		if (isset($_SESSION['user']) && isset($_SESSION['user']['group_slug']) && $_SESSION['user']['group_slug'] === 'employer') {
			$this->User_model->add_employer_seen(array(
				'employer_users_id' => $_SESSION ['user']['user_id'],
				'employee_users_id' => $user_id,
				'employer_seen_created' => date('Y-m-d H:i:s')));
		}
		$data['user_details_array'] = $this->User_model->get_user_by_id($user_id);
		$data['user_employment_array'] = $this->User_model->get_user_employment_by_user_id($user_id);
		$user_name = explode('-', $user_first_name);
		if ($data['user_details_array']['user_first_name'] !== $user_name[0] || $data['user_details_array']['user_last_name'] !== $user_name[1]) {
			redirect('dashboard', 'refresh');
		}
		if ($_SESSION['user']['group_slug'] !== 'administrator' && $_SESSION['user']['group_slug'] !== 'employer' && $user_id !== $_SESSION['user']['user_id']) {
			redirect('dashboard', 'refresh');
		} foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_locations'] = $this->User_model->get_user_employment_location_by_user_employment_id($user_employment['user_employment_id']);
		}
		if (count($data['user_details_array']) === 0 || $data['user_details_array']['group_slug'] !== 'employee') {
			redirect('dashboard', 'refresh');
		}
		$data['user_skill_array'] = $this->User_model->get_user_skill_by_user_id($user_id);
		foreach ($data['user_skill_array'] as $key => $user_skill) {
			$data['user_skill_array'][$key]['user_skill_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_skills_id', 'user_skill_others', $user_skill['user_skill_id']);
		}
		$data['user_countries_of_experience_array'] = $this->User_model->get_user_countries_of_experience_by_user_id($user_id);
		$data['user_license_authority_array'] = $this->User_model->get_user_license_authority_by_user_id($data['user_details_array']['user_id']);
		//fetch all licenses and lookups
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_id, '0');
		foreach ($data['user_license_array'] as $key => $user_license) {
			$data['user_license_array'][$key]['user_license_position_array'] = $this->User_model->get_user_license_position_by_user_license_id($user_license['user_license_id']);
			foreach ($data['user_license_array'][$key]['user_license_position_array'] as $key1 => $position) {
				$data['user_license_array'][$key]['user_license_position_array'][$key1]['user_license_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_license_positions_id', 'user_license_position_others', $position['user_license_position_id']);
			}
			$data['user_license_array'][$key]['user_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $user_license['user_license_id']);
			$data['user_license_array'][$key]['user_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $user_license['user_license_id']);
			$data['user_license_array'][$key]['user_license_approval_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_approval_rating_others', $user_license['user_license_id']);
		}

		$data['user_me_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_id, '1', '2');
		foreach ($data['user_me_license_array'] as $key => $user_me_license) {
			$data['user_me_license_array'][$key]['user_me_license_authority_other_position'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $user_me_license['user_license_id']);
			$data['user_me_license_array'][$key]['user_me_license_type_other_position'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $user_me_license['user_license_id']);
		}
		$data['user_pilot_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_id, '1', '1');
		foreach ($data['user_pilot_license_array'] as $key => $pilot_license) {
			$data['user_pilot_license_array'][$key]['user_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_authority_others', $pilot_license['user_license_id']);
			$data['user_pilot_license_array'][$key]['user_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_type_others', $pilot_license['user_license_id']);
			$data['user_pilot_license_array'][$key]['user_license_approval_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_licenses_id', 'user_license_approval_rating_others', $pilot_license['user_license_id']);
		}
		//get aircraft rating data and lookup values
		$data['user_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_id, '0');
		foreach ($data['user_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
				$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_license_authorities_id', 'user_aircraft_rating_license_authority_others', $license_authority['user_aircraft_rating_license_authority_id']);
			}
			$data['user_aircraft_rating_array'][$key]['user_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_aircraft_type_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		foreach ($data['user_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_coverages'] = $this->User_model->get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating['user_aircraft_rating_id']);
			$data['user_aircraft_rating_array'][$key]['user_aircraft_rating_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_type_rating_others', $aircraft_rating['user_aircraft_rating_id']);
		}
		$data['user_me_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_id, '1', '2');
		foreach ($data['user_me_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_me_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
		}
		foreach ($data['user_me_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'] = $this->User_model->get_user_aircraft_rating_coverage_by_user_aircraft_rating_id($aircraft_rating['user_aircraft_rating_id']);
			$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_type_rating_others', $aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'] as $key1 => $me_rating_coverage) {
				if ($me_rating_coverage['user_aircraft_rating_coverage_name'] === 'Other') {
					$data['user_me_aircraft_rating_array'][$key]['user_me_aircraft_rating_coverages'][$key1]['user_aircraft_rating_coverage_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_coverages_id', 'user_aircraft_rating_coverage_others', $me_rating_coverage['user_aircraft_rating_coverage_id']);
				}
			}
		}
		$data['user_pilot_aircraft_rating_array'] = $this->User_model->get_user_aircraft_rating_by_user_id($user_id, '1', '1');
		foreach ($data['user_pilot_aircraft_rating_array'] as $key => $aircraft_rating) {
			$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] = $this->User_model->get_user_aircraft_rating_license_authorities_by_user_id($aircraft_rating['user_aircraft_rating_id']);
			$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_ratings_id', 'user_aircraft_rating_aircraft_type_others', $aircraft_rating['user_aircraft_rating_id']);
			foreach ($data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'] as $key1 => $license_authority) {
				$data['user_pilot_aircraft_rating_array'][$key]['user_aircraft_rating_license_authorities'][$key1]['user_aircraft_rating_license_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_rating_license_authorities_id', 'user_aircraft_rating_license_authority_others', $license_authority['user_aircraft_rating_license_authority_id']);
			}
		}
//        pr($data['user_pilot_aircraft_rating_array']);
		//validation data get
		$data['user_validation_array'] = $this->User_model->get_user_validations_by_user_id($user_id);
		foreach ($data['user_validation_array'] as $key => $validation) {
			$data['user_validation_array'][$key]['user_validation_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_validations_id', 'user_validation_aircraft_type_others', $validation['user_validation_id']);
			$data['user_validation_array'][$key]['user_validation_license_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_validations_id', 'user_validation_license_type_others', $validation['user_validation_id']);
		}
		//get training data and lookups
		$data['user_training_array'] = $this->User_model->get_user_training_by_user_id($user_id);
		foreach ($data['user_training_array'] as $key => $user_training) {
			if ($user_training['trainings_id'] === '0') {
				$data['user_training_array'][$key]['user_training_course_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_trainings_id', 'user_training_course_others', $user_training['user_training_id']);
			}
		}
		//user medical certificate get data and lookup
		$data['user_medical_array'] = $this->User_model->get_user_medical_certificate_by_user_id($user_id, '0');
		foreach ($data['user_medical_array'] as $key => $user_medical) {
			if ($user_medical['license_authorities_id'] === '0') {
				$data['user_medical_array'][$key]['user_medical_certificate_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_medical_certificates_id', 'user_medical_certificate_authority_others', $user_medical['user_medical_certificate_id']);
			}
		}
		$data['pilot_medical_array'] = $this->User_model->get_user_medical_certificate_by_user_id($user_id, '1');
		foreach ($data['pilot_medical_array'] as $key => $user_medical) {
			if ($user_medical['license_authorities_id'] === '0') {
				$data['pilot_medical_array'][$key]['user_medical_certificate_authority_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_medical_certificates_id', 'user_medical_certificate_authority_others', $user_medical['user_medical_certificate_id']);
			}
		}
		//get user previous employment data and lookups
		$data['user_previous_employment_array'] = $this->User_model->get_user_previous_employments_by_user_id($user_id);
		foreach ($data['user_previous_employment_array'] as $key => $user_previous_employment) {
			if ($user_previous_employment['positions_id'] === '0') {
				$data['user_previous_employment_array'][$key]['user_previous_employment_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_previous_employments_id', 'user_previous_employment_position_others', $user_previous_employment['user_previous_employment_id']);
			}
		}
		//get user references data and lookups
		$data['user_reference_array'] = $this->User_model->get_user_reference_by_user_id($user_id);
		foreach ($data['user_reference_array'] as $key => $user_reference) {
			if ($user_reference['positions_id'] === '0') {
				$data['user_reference_array'][$key]['user_reference_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_references_id', 'user_reference_position_others', $user_reference['user_reference_id']);
			}
		}
		//get user employment data and lookups
		$data['user_employment_array'] = $this->User_model->get_user_employment_by_user_id($user_id);
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_locations'] = $this->User_model->get_user_employment_location_by_user_employment_id($user_employment['user_employment_id']);
		}
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_positions'] = $this->User_model->get_user_employment_position_by_user_employment_id($user_employment['user_employment_id']);
			foreach ($data['user_employment_array'][$key]['user_employment_positions'] as $key1 => $employment_position) {
				$data['user_employment_array'][$key]['user_employment_positions'][$key1]['user_employment_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_employment_positions_id', 'user_employment_position_others', $employment_position['user_employement_position_id']);
			}
		}
		$data['user_passport_array'] = $this->User_model->get_user_passports_by_user_id($user_id);
		$data['user_type_rating_array'] = $this->User_model->get_user_type_ratings_by_user_id($user_id);
		foreach ($data['user_type_rating_array'] as $key => $type_rating) {
			$data['user_type_rating_array'][$key]['user_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_type_ratings_id', 'user_type_rating_others', $type_rating['user_type_rating_id']);
		}
		$data['user_position_array'] = $this->User_model->get_user_current_positions_by_user_id($user_id);
		foreach ($data['user_position_array'] as $key => $user_position) {
			$data['user_position_array'][$key]['user_current_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_current_positions_id', 'user_current_position_others', $user_position['user_current_position_id']);
		}
		$data['user_visa_array'] = $this->User_model->get_user_visas_by_user_id($user_id);
		$data['user_experience_array'] = $this->User_model->get_user_experience_by_user_id($user_id, '0');
		$data['notice_period_array'] = $this->notice_period_array;
		$data['user_experience_array'] = $this->User_model->get_user_experience_by_user_id($user_id, '0');
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($user_id);
		$data['user_rating_array'] = $this->User_model->get_user_rating_by_user_id($user_id);
		foreach ($data['user_rating_array'] as $key => $type_rating) {
			$data['user_rating_array'][$key]['user_type_rating_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_ratings_id', 'user_rating_others', $type_rating['user_rating_id']);
		}
		$data['type_rating_array'] = $this->User_model->get_active_type_ratings_by_job_type_id($data['user_details_array']['job_type_id'] === '7' ? '7' : '2');
		$data['training_array'] = $this->User_model->get_trainings();
		$data['model_array'] = $this->Aircraft_model->get_models();
		$data ['location_array'] = $this->User_model->get_active_locations();
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($user_id);
		foreach ($data['user_aircraft_experience_array'] as $key => $aircraft_experience) {
			$data['user_aircraft_experience_array'][$key]['user_aircraft_experience_aircraft_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_aircraft_experiences_id', 'user_aircraft_experience_aircraft_type_others', $aircraft_experience['user_aircraft_experience_id']);
		}
		$data['user_management_experience_array'] = $this->User_model->get_user_management_experience_by_user_id($user_id);
		if ($data['user_details_array']['group_slug'] === 'administrator') {
			redirect(base_url() . 'dashboard');
		}
		$data['pilot_experience_array'] = $this->User_model->get_user_experience_by_user_id($user_id, '1');
		$data['user_area_experience_array'] = $this->User_model->get_user_area_experience_by_user_id($user_id);
		$data['pilot_flight_time_array'] = $this->User_model->get_user_flight_time_by_user_id($user_id);
		//get user management experience and lookups
		$data['user_management_experience_array'] = $this->User_model->get_user_management_experiences_by_user_id($user_id);
		foreach ($data['user_management_experience_array'] as $key => $management_experience) {
			$data['user_management_experience_array'][$key]['management_experience_types'] = $this->User_model->get_user_management_experience_type_by_user_m_e_id($management_experience['user_management_experience_id']);
			foreach ($data['user_management_experience_array'][$key]['management_experience_types'] as $key1 => $management_experience_types) {
				$data['user_management_experience_array'][$key]['management_experience_types'][$key1]['user_management_experience_type_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_management_experience_types_id', 'user_management_experience_type_others', $management_experience_types['user_management_experience_type_id']);
			}
		}
		$data['user_retired_pilot_array'] = $this->User_model->get_user_retired_pilot_by_user_id($user_id);
		if (count($data['user_retired_pilot_array']) > 0) {
			$data['user_retired_pilot_array']['user_retired_pilot_current_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_retired_pilots_id', 'user_retired_pilot_current_position_others', $data['user_retired_pilot_array']['user_retired_pilot_id']);
		}
		$data ['title'] = 'Employee Profile';
		parent::render_view($data, 'common');
	}

	function employer_edit_profile($user_id = '') {
		parent::allow(array('administrator', 'employer'));
		$data = array();
		$this->load->model('Auth_model');
		$this->load->model('Aircraft_model');
		if ($user_id === '') {
			$user_id = $_SESSION['user']['user_id'];
		}
		if ($_SESSION['user']['group_slug'] !== 'administrator' && $user_id !== $_SESSION['user']['user_id']) {
			redirect('dashboard', 'refresh');
		} $user_details_array = $this->User_model->get_user_by_id($user_id);
		if ($user_details_array ['group_slug'] !== 'employer') {
			redirect('dashboard', 'refresh');
		} if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_business_name', 'Company Trading Name', 'trim|required');
			$this->form_validation->set_rules('user_address', 'Company Address', 'trim|required');
			$this->form_validation->set_rules('user_city', 'City Name', 'trim|required');
			$this->form_validation->set_rules('user_state', 'State Name', 'trim|required');
			$this->form_validation->set_rules('countries_id', 'Country Name', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('user_business_legal_name', 'Company Legal Name', 'trim|required');
			$this->form_validation->set_rules('user_registered_countries_id', 'Registered Country', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('user_first_name', 'First Name of Contact Person', 'trim|required|callback_alpha_spaces');
			$this->form_validation->set_rules('user_last_name', 'Last Name of Contact Person', 'trim|required|callback_alpha_spaces');
			$this->form_validation->set_rules('user_business_description', 'Company Description', 'trim');
			$this->form_validation->set_rules('user_country_code', 'Country Code', 'trim|required');
			$this->form_validation->set_rules('user_primary_contact', 'Contact Number', 'trim|required|min_length[4]|is_numeric');
			$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|edit_unique[users.user_email.user_id.' . $user_id . ']');
			$this->form_validation->set_rules('user_website_address', 'Website URL', 'trim');
			$this->form_validation->set_rules('user_skype_id', 'Skype Name', 'trim');
			$this->form_validation->set_rules('user_business_title', 'Contact Perso n Title', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$license_array = array();
				$operation_array = array();
				$profile_completeness = 0;
				if ($user_details_array['employer_type_slug'] === 'recruiter') {
					for ($i = 0; $i < count($this->input->post('user_operation_type_number_of_staff')); $i++) {
						if ($this->input->post('user_operation_type_number_of_staff')[$i] !== '' || $this->input->post('user_operation_type_recruit_for')[$i] !== '' || $this->input->post('user_operation_type_logo')[$i] !== '') {
							if ($this->input->post('user_operation_type_number_of_staff')[$i] === '' || $this->input->post('user_operation_type_recruit_for')[$i] === '' || $this->input->post('user_operation_type_logo')[$i] === '') {
								echo 'Please fill all the fields in operation information';
								die;
							} else if (!is_numeric($this->input->post('user_operation_type_number_of_staff')[$i])) {
								echo 'Please fill valid number of staff';
								die;
							} else {
								$operation_array[$i] = array(
									'users_id' => $user_details_array['user_id'],
									'user_operation_type_number_of_staff' => $this->input->post('user_operation_type_number_of_staff')[$i],
									'user_operation_type_recruit_for' => $this->input->post('user_operation_type_recruit_for')[$i],
									'user_operation_type_logo' => $this->input->post('user_operation_type_logo')[$i],
									'user_operation_type_original_name' => $this->input->post('user_operation_type_original_name')[$i],
									'user_operation_type_status' => '1'
								);
							}
						}
					}
				}
				if ($user_details_array['employer_type_slug'] !== 'recruiter') {
					if (count($this->input->post('user_operation_types_id')) === 0) {
						echo 'Please select operation types';
						die;
					}
				}
				$logo_thumb = $user_details_array['user_profile_thumb'];
				$logo_upload_directory = FCPATH . 'uploads/users/images' . date('/Y/m/d/H/i/s/', strtotime($user_details_array['user_created']));
				$certificate_upload_directory = FCPATH . 'uploads/users/company_certificates' . date('/Y/m/d/H/i/s/', strtotime($user_details_array ['user_created']));
				$user_business_logo = $this->input->post('user_business_logo');
				$user_business_certificate = $this->input->post('user_business_certificate');
				if (is_file(FCPATH . 'uploads/' . $user_business_logo)) {
					if (!is_dir($logo_upload_directory)) {
						mkdir($logo_upload_directory, 0777, TRUE);
					}
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $user_business_logo);
					$image_x_size = $image_size_array [0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ( $image_x_size - $image_y_size ) / 2;
						$crop_image_y_size = '0';
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
						$crop_image_x_size = '0';
					} if (parent:: crop_image(FCPATH . 'uploads/' . $user_business_logo, $logo_upload_directory . '/' . $user_business_logo, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						$logo_thumb = pathinfo($user_business_logo, PATHINFO_FILENAME) . '_thumb.' . pathinfo($user_business_logo, PATHINFO_EXTENSION);
						if (parent::resize_image($logo_upload_directory . '/' . $user_business_logo, $logo_upload_directory . '/' . $logo_thumb, 250, 250) && parent::resize_image($logo_upload_directory . '/' . $user_business_logo, $logo_upload_directory . '/' . $logo_thumb, 150, 150)) {
							unlink(FCPATH . 'uploads/' . $user_business_logo);
						}
					}
				}
				if (is_file(FCPATH . 'uploads/' . $user_business_certificate)) {
					if (!is_dir($certificate_upload_directory)) {
						mkdir($certificate_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $user_business_certificate, $certificate_upload_directory . '/' . $user_business_certificate)) {
						unlink(FCPATH . 'uploads/' . $user_business_certificate);
					}
				}
				$user_update_array = array(
					'user_profile_image' => $user_business_logo,
					'user_profile_thumb' => $logo_thumb,
					'user_profile_image_original_name' => $this->input->post('user_profile_image_original_name') !== null ? $this->input->post('user_profile_image_original_name') : '',
					'user_business_name' => $this->input->post('user_business_name'),
					'user_business_legal_name' => $this->input->post('user_business_legal_name'),
					'user_business_number' => $this->input->post('user_business_number'),
					'user_registered_countries_id' => $this->input->post('user_registered_countries_id'),
					'user_website_address' => $this->input->post('user_website_address'),
					'user_address' => $this->input->post('user_address'),
					'user_business_description' => $this->input->post('user_business_description'),
					'user_city' => $this->input->post('user_city'),
					'user_state' => $this->input->post('user_state'),
					'user_zipcode' => $this->input->post('user_zipcode'),
					'countries_id' => $this->input->post('countries_id'),
					'user_first_name' => $this->input->post('user_first_name'),
					'user_last_name' => $this->input->post('user_last_name'),
					'user_email' => $this->input->post('user_email'),
					'user_login' => $this->input->post('user_email'),
					'user_country_code' => $this->input->post('user_country_code'),
					'user_primary_contact' => $this->input->post('user_primary_contact'),
					'user_fax' => $this->input->post('user_fax'),
					'user_business_certificate' => $user_business_certificate,
					'user_business_certificate_original_name' => $this->input->post('user_business_certificate_original_name') !== null ? $this->input->post('user_business_certificate_original_name') : '',
					'user_modified' => date('Y-m-d H:i:s'),
					'user_skype_id' => $this->input->post('user_skype_id'),
					'user_number_of_aircrafts' => $this->input->post('user_number_of_aircrafts'),
					'user_business_title' => $this->input->post('user_business_title'),
					'user_find_us' => $this->input->post('user_find_us')
				);
				if ($user_details_array['employer_type_slug'] !== 'recruiter') {
					$user_update_array['user_number_of_staff'] = $this->input->post('user_number_of_staff');
					if ($user_update_array['user_number_of_staff'] !== '') {
						$profile_completeness = $profile_completeness + 2;
					}
				}
				if ($this->User_model->edit_user_by_user_id($user_details_array['user_id'], $user_update_array)) {
					if ($user_update_array['user_business_name'] !== '' && $user_update_array['user_business_legal_name'] && $user_update_array['user_registered_countries_id'] > 0) {
						$profile_completeness = $profile_completeness + 8;
					}
					if ($user_update_array['user_address'] !== '' && $user_update_array['user_city'] && $user_update_array['user_state'] !== '' && $user_update_array['countries_id'] > 0 && $user_update_array['user_website_address'] !== '') {
						$profile_completeness = $profile_completeness + 10;
					}
					if ($user_update_array['user_first_name'] !== '' && $user_update_array['user_last_name'] && $user_update_array['user_primary_contact'] !== '') {
						$profile_completeness = $profile_completeness + 10;
					}
					if ($user_update_array['user_business_certificate'] !== '') {
						$profile_completeness = $profile_completeness + 20;
					}
					if ($user_update_array['user_profile_image'] !== '') {
						$profile_completeness = $profile_completeness + 10;
					}
					if ($user_update_array['user_business_description'] !== '') {
						$profile_completeness = $profile_completeness + 2;
					}
					if ($this->User_model->edit_employer_employment_location_by_user_id($user_details_array['user_id'], array('employer_employment_location_status' => '-1'))) {
						if (count($this->input->post('employer_locations_id')) > 0) {
							foreach ($this->input->post('employer_locations_id') as $location) {
								$this->User_model->add_employer_employment_location(array(
									'users_id' => $user_details_array['user_id'],
									'locations_id' => $location,
									'employer_employment_location_status' => '1'));
							}
						}
					}
					if ($this->User_model->edit_user_aircraft_by_user_id($user_details_array['user_id'], array('user_aircraft_status' => '-1'))) {
						if (count($this->input->post('user_my_aircrafts_id')) > 0) {
							$profile_completeness = $profile_completeness + 15;
							foreach ($this->input->post('user_my_aircrafts_id') as $user_aircraft) {
								$user_aircraft_id = $this->User_model->add_user_aircraft(array(
									'users_id' => $user_details_array ['user_id'],
									'my_aircrafts_id' => $user_aircraft, 'user_aircraft_status' => '1'
								));
								if ($user_aircraft === '0') {
									$this->User_model->add_user_aircraft_other(array(
										'user_aircrafts_id' => $user_aircraft_id,
										'user_aircraft_other_name' => $this->input->post('user_aircraft_other_name')
									));
								}
							}
						}
					}
					if ($this->User_model->edit_user_notification_by_user_id($user_details_array['user_id'], array('user_notification_status' => '-1'))) {
						if (count($this->input->post('user_notification_type')) > 0) {
							$profile_completeness = $profile_completeness + 5;
							foreach ($this->input->post('user_notification_type') as $user_notification) {
								$this->User_model->add_user_notification(array(
									'users_id' => $user_details_array['user_id'],
									'user_notification_type' => $user_notification,
									'user_notification_status' => '1'
								));
							}
						}
					}
					if ($user_details_array['employer_type_slug'] !== 'recruiter') {
						if ($this->User_model->edit_user_operation_type_by_user_id($user_id, array('user_operation_type_status' => '-1'))) {
							if ($this->input->post('user_operation_types_id') !== null && count($this->input->post('user_operation_types_id'))) {
								$profile_completeness = $profile_completeness + 18;
								foreach ($this->input->post('user_operation_types_id') as $operation_id) {
									$user_operation_type_id = $this->User_model->add_user_operation_type(array(
										'users_id' => $user_id,
										'operation_types_id' => $operation_id,
										'user_operation_type_status' => '1'
									));
									if ($operation_id === '0') {
										$this->User_model->add_user_operation_other_type(array(
											'user_operation_types_id' => $user_operation_type_id,
											'user_operation_type_other_name' => $this->input->post('user_operation_type_other_name')
										));
									}
								}
							}
						}
					} else {
						if ($this->User_model->edit_user_operation_type_by_user_id($user_id, array('user_operation_type_status' => '-1'))) {
							if (count($operation_array) > 0) {
								foreach ($operation_array as $operations) {
									$company_logo_directory = FCPATH . 'uploads/users/company_logos/' . date('Y/m/d/H/i/s', strtotime($user_details_array['user_created']));
									if (is_file(FCPATH . 'uploads/' . $operations['user_operation_type_logo'])) {
										if (!is_dir($company_logo_directory)) {
											mkdir($company_logo_directory, 0777, TRUE);
										}
										$image_size_array = getimagesize(FCPATH . 'uploads/' . $operations['user_operation_type_logo']);
										$image_x_size = $image_size_array[0];
										$image_y_size = $image_size_array[1];
										$crop_measure = min($image_x_size, $image_y_size);
										if ($image_x_size > $image_y_size) {
											$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
											$crop_image_y_size = '0';
										} else {
											$crop_image_y_size = ( $image_y_size - $image_x_size ) / 2;
											$crop_image_x_size = '0';
										}
										if (parent::crop_image(FCPATH . 'uploads/' . $operations['user_operation_type_logo'], $company_logo_directory . '/' . $operations['user_operation_type_logo'], $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
											if (parent::resize_image($company_logo_directory . '/' . $operations['user_operation_type_logo'], $company_logo_directory . '/' . $operations['user_operation_type_logo'], 200, 200)) {
												unlink(FCPATH . 'uploads/' . $operations['user_operation_type_logo']);
											}
										}
									}
									$this->User_model->add_user_operation_type($operations);
									$profile_completeness = $profile_completeness + 20;
								}
							}
						}
					}
					if ($this->User_model->edit_user_by_user_id($user_details_array['user_id'], array('user_profile_completeness' => $profile_completeness))) {
						parent::regenerate_session();
						die('1');
					}
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['user_details_array'] = $user_details_array;
		$data['user_operation_type_array'] = $this->User_model->get_user_operation_type_by_user_id($user_id);
		foreach ($data['user_operation_type_array'] as $key => $user_operation_type) {
			if ($user_operation_type['operation_types_id'] === '0') {
				$data['user_operation_type_other'] = $this->User_model->get_user_operation_other_type_by_user_operation_type_id($user_operation_type['user_operation_type_id']);
				break;
			}
		}
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['location_array'] = $this->User_model->get_active_locations();
		$data['operation_type_array'] = $this->User_model->get_operation_type_by_employer_type_id($user_details_array['employer_types_id']);
		$data['license_array'] = $this->User_model->get_licenses_by_job_type_id();
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['employer_employment_location_array'] = $this->User_model->get_employer_employment_location_by_user_id($user_details_array['user_id']);
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_details_array['user_id']);
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data ['user_notification_array'] = $this->User_model->get_user_notification_by_user_id($user_details_array['user_id']);
		$data['user_aircraft_array'] = $this->User_model->get_user_aircraft_by_user_id($user_details_array['user_id']);
		foreach ($data['user_aircraft_array'] as $key => $user_aircraft_type) {
			if ($user_aircraft_type['my_aircrafts_id'] === '0') {
				$data['user_aircraft_type_other'] = $this->User_model->get_user_aircraft_other_by_user_aircraft_id($user_aircraft_type['user_aircraft_id']);
				break;
			}
		}
		$data['user_company_array'] = $this->User_model->get_user_company_by_user_id($user_details_array['user_id']);
		foreach ($data['user_company_array'] as $key => $company_array) {
			$data ['user_company_array'][$key]['company_bases'] = $this->User_model->get_user_company_base_by_user_company_id($company_array['user_company_id']);
		}
		$data['title'] = 'Employer Edit Profile';
		parent::render_view($data, 'common');
	}

	function profile_views() {
		parent::allow(array('employee'));
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'user/profile_views';
		$total_rows = $this->User_model->count_employer_seen_by_employee_id($_SESSION['user']['user_id']);
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
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
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['employer_seen_array'] = $this->User_model->get_employer_seen_by_employee_id($_SESSION['user'] ['user_id'], $config['per_page'], $page);
		parent::render_view($data, 'common');
	}

	function get_employer() {
		parent::allow(array('employee'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id', 'User ID', 'required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$user_details_array = $this->User_model->get_user_by_id($this->input->post('user_id'));
			parent::json_output($user_details_array);
			return;
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function employer_profile($user_first_name = '', $user_id = '') {
		parent::allow(array('administrator', 'employer'));
		$data = array();
		$this->load->model('Aircraft_model');
		$this->load->model('Auth_model');
		$this->load->model('Job_model');
		if ($user_id === '') {
			$user_id = $_SESSION ['user']['user_id'];
			$user_first_name = $_SESSION['user']['user_first_name'] . '-' . $_SESSION ['user'] ['user_last_name'];
		}
		$data['user_details_array'] = $this->User_model->get_user_by_id($user_id);
		$user_name = explode('-', $user_first_name);
		if ($data['user_details_array'] ['group_slug'] !== 'employer') {
			redirect('dashboard', 'refresh');
		}
		if ($data['user_details_array']['user_first_name'] !== $user_name[0] || $data['user_details_array']['user_last_name'] !== $user_name[1]) {
			redirect('dashboard', 'refresh');
		}
		if (count($data['user_details_array']) === 0 || $data['user_details_array']['group_slug'] === 'employee') {
			redirect('dashboard', 'refresh');
		}
		$data['user_employment_array'] = $this->User_model->get_user_employment_by_user_id($user_id);
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($user_id);
		$data['user_employment_location_array'] = $this->User_model->get_employer_employment_location_by_user_id($user_id);
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_locations'] = $this->User_model->get_user_employment_location_by_user_employment_id($user_employment['user_employment_id']);
		}
		$data['user_operation_type_array'] = $this->User_model->get_user_operation_type_by_user_id($user_id);
		foreach ($data['user_operation_type_array'] as $key => $user_operation_type) {
			if ($user_operation_type['operation_types_id'] === '0') {
				$data['user_operation_type_array'][$key]['operation_type'] = $this->User_model->get_user_operation_other_type_by_user_operation_type_id($user_operation_type['user_operation_type_id'])['user_operation_type_other_name'];
				break;
			}
		}
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['location_array'] = $this->User_model->get_active_locations();
		$data['operation_type_array'] = $this->User_model->get_operation_type_by_employer_type_id($data['user_details_array']['employer_types_id']);
		$data['license_array'] = $this->User_model->get_licenses_by_job_type_id();
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['employer_employment_location_array'] = $this->User_model->get_employer_employment_location_by_user_id($data['user_details_array']['user_id']);
		$data['user_license_array'] = $this->User_model->get_user_licenses_by_user_id($data['user_details_array']['user_id']);
		$data['next_job_expiry'] = $this->Job_model->get_job_count_details('1', $data['user_details_array']['user_id'])['expire_date'];
		$data['posted_jobs_count'] = $this->Job_model->get_job_count_details('2', $data['user_details_array']['user_id'])['posted_jobs_count'];
		$data['no_of_applicant'] = $this->Job_model->get_job_application_count($_SESSION['user']['user_id'])['job_application_count'];
		$data['new_applicant'] = $this->User_model->get_user_new_applicants($_SESSION['user']['user_id'])['new_application_count'];
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data ['user_notification_array'] = $this->User_model->get_user_notification_by_user_id($data['user_details_array']['user_id']);
		$data['user_aircraft_array'] = $this->User_model->get_user_aircraft_by_user_id($data['user_details_array']['user_id']);
		foreach ($data['user_aircraft_array'] as $key => $user_aircraft_type) {
			if ($user_aircraft_type['my_aircrafts_id'] === '0') {
				$data['user_aircraft_array'][$key]['my_aircraft_name'] = $this->User_model->get_user_aircraft_other_by_user_aircraft_id($user_aircraft_type['user_aircraft_id'])['user_aircraft_other_name'];
				break;
			}
		}
		$data['title'] = 'Employer Profile';
		parent ::render_view($data, 'common');
	}

	function search($search_term = '', $license_type = '', $type_rating = '', $training = '', $medical = '', $experience = '', $location = '', $total_hours_condition = '', $job_type_name = '', $employee_role_name = '', $user_total_hours = '', $user_hours = '', $contact = '', $email = '', $user_rating = '', $passport = '', $visa = '', $validation = '', $operation_type = '', $total_instructor = '') {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			if (trim($this->input->post('search_term')) !== '') {
				$search_term = $this->input->post('search_term');
			}
			if (trim($this->input->post('user_license_type')) !== '') {
				$license_type = $this->input->post('user_license_type');
			}
			if (trim($this->input->post('user_type_rating')) !== '') {
				$type_rating = $this->input->post('user_type_rating');
			}
			if (trim($this->input->post('user_training')) !== '') {
				$training = $this->input->post('user_training');
			}
			if (trim($this->input->post('user_medical')) !== '') {
				$medical = $this->input->post('user_medical');
			}
			if (trim($this->input->post('user_experience')) !== '') {
				$experience = $this->input->post('user_experience');
			}
			if (trim($this->input->post('user_country')) !== '') {
				$location = $this->input->post('user_country');
			}
			if (trim($this->input->post('job_type_name')) !== '') {
				$job_type_name = $this->input->post('job_type_name');
			}
			if (trim($this->input->post('employee_role_name')) !== '') {
				$employee_role_name = $this->input->post('employee_role_name');
			}
			if (trim($this->input->post('user_hours_type_rating')) !== '') {
				$user_hours = $this->input->post('user_hours_type_rating');
			}
			if (trim($this->input->post('user_total_instructor')) !== '') {
				$total_instructor = $this->input->post('user_total_instructor');
			}
			if (trim($this->input->post('user_primary_contact')) !== '') {
				$contact = $this->input->post('user_primary_contact');
			}
			if (trim($this->input->post('user_email')) !== '') {
				$email = $this->input->post('user_email');
			}
			if (trim($this->input->post('user_rating')) !== '') {
				$user_rating = $this->input->post('user_rating');
			}
			if (trim($this->input->post('user_passport')) !== '') {
				$passport = $this->input->post('user_passport');
			}
			if (trim($this->input->post('user_visa')) !== '') {
				$visa = $this->input->post('user_visa');
			}
			if (trim($this->input->post('user_validation')) !== '') {
				$validation = $this->input->post('user_validation');
			}
			if (trim($this->input->post('operation_type')) !== '') {
				$operation_type = $this->input->post('operation_type');
			}
			if (trim($this->input->post('user_total_hours')) !== '') {
				$total_hours_condition = ($this->input->post('total_hours_condition') !== '') ? $this->input->post('total_hours_condition') : '';
				$user_total_hours = $this->input->post('user _total_h ours');
			}
			$data['search_array'] = $this->User_model->search($search_term, $license_type, $type_rating, $training, $medical, $experience, $location, $job_type_name, $employee_role_name, $user_hours, $contact, $email, $user_rating, $passport, $visa, $validation, $operation_type, $total_instructor, $total_hours_condition, $user_total_hours);
			foreach ($data['search_array'] as $key => $search) {
				$data['search_array'][$key]['user_passport'] = $this->User_model->get_user_passports_by_user_id($search['user_id']);
				$data['search_array'][$key]['user_visa'] = $this->User_model->get_user_visas_by_user_id($search['user_id']);
				$data['search_array'][$key]['user_validation'] = $this->User_model->get_user_validations_by_user_id($search['user_id']);
			}
		}
		$this->load->model('Configuration_model');
		$this->load->model('Job_model');
		$this->load->model('Auth_model');
		$data['license_array'] = $this->User_model->get_active_licenses();
		$data['type_rating_array'] = $this->Configuration_model->get_type_ratings();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		$data['training_array'] = $this->User_model->get_trainings();
		$data['medical_examination_array'] = $this->User_model->get_medical_examinations();
		$data['user_country_array'] = $this->Auth_model->get_countries();

		parent::render_view($data, '');
	}

	function list_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array(
			'list_status!=' => '-1'));
		$this->datatables->select('list_id,list_name')->from('lists');
		echo $this->datatables->generate();
	}

	function lists() {
		parent::allow(array('administrator'));
		$data = array();
		parent ::render_view($data, '');
	}

	function delete_list() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('list_id', 'List ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->User_model->edit_list_by_id($this->input->post('list_id'), array(
						'list_status' => '-1',
						'list_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function view_list_datatable($list_id = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('users', 'users.user_id=user_lists.users_id', 'left');
		$this->datatables->join('lists', 'lists.list_id=user_lists.lists_id', 'left');
		$this->datatables->join('job_types', 'users.job_types_id=job_types.job_type_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=users.user_id', 'left');
		$this->datatables->join('groups', 'users.groups_id=groups.group_id', 'left');
		$this->datatables->join('type_ratings', 'users.type_ratings_id=type_ratings.type_rating_id', 'left');
		$this->datatables->join('licenses', 'users.licenses_id=licenses.license_id', 'left');
		$this->datatables->join('employee_roles', 'employee_roles.employee_role_id=users.employee_roles_id', 'left');
		$this->datatables->where(array('users.user_status!=' => '-1', 'users.groups_id' => '4'));
		if ($list_id !== '') {
			$this->datatables->where(array('user_lists.lists_id' => $list_id, 'user_lists.user_list_status' => '1'));
		}
		$this->datatables->select("user_list_id,CONCAT(user_first_name,' ',user_last_name) AS user_full_name,country_name,job_type_name,IF(type_rating_name='','',type_rating_name) AS type_rating_name,license_type,employee_role_name,user_years_of_experience,IF(user_skype_id='','',CONCAT('skype: ',user_skype_id)) AS user_skype_id,user_email,user_primary_contact,DATE_FORMAT(user_last_logged_in,'%b %d %Y %h:%i %p'),user_profile_completeness,CONCAT('" . base_url() . "user/profile/',user_first_name,'-',user_last_name,'/',user_id) AS profile_link,user_id,CONCAT('job/applied_jobs/',user_id) AS job_page_link,CONCAT('user/log_in_history/',user_id) AS login_history_link", FALSE)->from('user_lists');
		echo $this->datatables->generate();
	}

	function view_list($list_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['list_array'] = $this->User_model->get_list_by_id($list_id);
		parent::render_view($data, '');
	}

	function add_list() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('list_name', 'list name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->User_model->add_list(array
						(
						'list_name' => $this->input->post('list_name'),
						'list_slug' => strtolower(str_replace(' ', '-', $this->input->post('user_list_name'))),
						'users_id' => $_SESSION['user'] ['user_id'],
						'list_created' => date('Y-m-d H:i:s'), 'list_status' => '1'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function remove_from_list() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_list_id', 'User List ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->User_model->edit_user_list_by_id($this->input->post('user_list_id'), array(
						'user_list_status' => '-1', 'user_list_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_list_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('list_id', 'List ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('list_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->User_model->edit_list_by_id($this->input->post('list_id'), array(
						'list_status' => $this->input->post('list_status') == 'true' ? '1' : '0',
						'list_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_user_to_list() {
		$this->load->helper('form');
		if (count($this->User_model->check_user_in_lists_by_id($this->input->post('users_id'), $this->input->post('lists_id'))) == 0) {
			$list_array = array(
				'users_id' => $this->input->post('users_id'), 'lists_id' => $this->input->post('lists_id'), 'user_list_status' => '1');
			if ($this->User_model->add_user_to_list($list_array) > 0) {
				die('1');
			}
			die;
		} else {
			die('2');
		}
		die;
	}

	function rate_user() {
		if ($this->User_model->edit_user_by_user_id($this->input->post('user_id'), array(
					'user_rating' => $this->input->post('user_rating'))) > 0) {
			die('1');
		}
		die;
	}

	function send_email_to_list_users() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('list_id', 'List ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('view_list_email_subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('view_list_email_message', 'Message Body', 'trim|required');
		if ($this->form_validation->run()) {
			$user_list_array = $this->User_model->get_user_list_by_list_id($this->input->post('list_id'));
			if (count($user_list_array) > 0) {
				foreach ($user_list_array as $user_list) {
					$user_list ['email_message'] = nl2br($this->input->post('view_list_email_message'));
					$email1 = parent::add_email_to_queue('', '', $user_list['user_email'], $user_list['user_id'], $this->input->post('view_list_email_subject'), $this->
											render_view($user_list, 'emails', 'emails/templates/miscellaneous', TRUE));
					if ($email1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $email1);
					}
				}
				die('1');
			} else {
				echo 'No Users';
				die;
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function setup_job_alert() {
		parent::allow(array('employee'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$company = $this->input->post('company');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			$this->form_validation->set_rules('position', 'Position', 'trim|required');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			if ($company == 'other') {
				$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			}
			if ($this->form_validation->run()) {
				if ($company == 'all') {
					$company_name = 'all';
				}
				if ($company == 'other') {
					$company_name = $this->input->post('company_name');
				}
				print_r($this->input->post());
				$this->User_model->add_job_alert(
						array(
							'users_id' => $_SESSION['user']['user_id'],
							'job_types_id' => $this->input->post('position'),
							'job_alert_keyword' => $this->input->post('keywords'),
							'positions_id' => $this->input->post('role'),
							'countries_id' => $this->input->post('location'),
							'job_alert_company' => $company_name,
							'job_alert_em ployment_type' => $this->input->post('employment_type'),
							'job_alert_status' => '1',
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

	function delete_user() {
		parent::allow(array('administrator'));
		if ($this->input->post()) {
			if (count($this->input->post('select_boxes'))) {
				foreach ($this->input->post('select_boxes') as $user_id) {
					$this->User_model->delete_user_by_user_id($user_id);
				}
				die('1');
			}
			die('0');
		}
		die;
	}

	function send_email_selected_users() {
		parent::allow(array('administrator'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email_subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('email_message', 'Message', 'trim|required');
			if ($this->form_validation->run()) {
				if (count($this->input->post('users'))) {
					foreach ($this->input->post('users') as $user) {
						$user_details_array = $this->User_model->get_user_by_id($user);
						$user_details_array ['email_message'] = $this->input->post('email_message');
						$email1 = parent::add_email_to_queue('', '', $user_details_array['user_email'], $user, $this->input->post('email_subject'), $this->render_view($user_details_array, 'emails', 'emails/templates/miscellaneous', TRUE));
						if ($email1 > 0) {
							@file_get_contents(base_url() . 'email/cron/' . $email1);
						}
					}
					die('1');
				}
				die('0');
			} else {
				echo validation_errors();
				die;
			}
		}
		die;
	}

	function desired_job() {
		parent::allow(array('employee'));
		$data = array();
		$this->load->model('Auth_model');
		$this->load->model('Job_model');
		if ($this->input->post()) {
//user desired employment
			if ($this->User_model->edit_user_employment_by_user_id($_SESSION['user']['user_id'], array('user_employment_status' => '-1'))) {
				for ($i = 0; $i < count($this->input->post('user_employment_desired_position')); $i++) {
					if ($this->input->post('user_employment_desired_position')[$i] !== '' || count($this->input->post('user_employment_positions_id')[$i]) > 0 || $this->input->post('user_employment_preferred_company')[$i] !== '' || $this->input->post('user_employment_type')[$i] !== '' || $this->input->post('user_employment_willing_to_relocate')[$i] !== '' || count($this->input->post('user_employment_location')) > 0 || $this->input->post('user_employment_availability')[$i] !== '') {
						$user_employment_insert_array = array(
							'users_id' => $_SESSION['user']['user_id'],
							'user_employment_desired_position' => $this->input->post('user_employment_desired_position')[$i],
							'user_employment_preferred_company' => $this->input->post('user_employment_preferred_company')[$i],
							'user_employment_type' => $this->input->post('user_employment_type')[$i],
							'user_employment_type_other' => $this->input->post('user_employment_type_other')[$i],
							'user_employment_type_next_availability' => $this->input->post('user_employment_type_next_availability')[$i] !== '' ? parent::input_date_to_mysql_date($this->input->post('user_employment_type_next_availability')[$i]) : '',
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
						if (isset($this->input->post('user_employment_positions_id')[$i]) && count($this->input->post('user_employment_positions_id')[$i]) > 0) {
							foreach ($this->input->post('user_employment_positions_id') [$i] as $position) {
								$user_employment_position_id = $this->User_model->add_user_employment_position(array(
									'users_id' => $_SESSION['user']['user_id'],
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
						die('1');
					}
				}
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
		$data['position_array'] = $this->User_model->get_positions_by_job_type_id($_SESSION['user']['job_type_id']);
		$data['user_employment_array'] = $this->User_model->get_user_employment_by_user_id($_SESSION['user']['user_id']);
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_locations'] = $this->User_model->get_user_employment_location_by_user_employment_id($user_employment['user_employment_id']);
		}
		foreach ($data['user_employment_array'] as $key => $user_employment) {
			$data['user_employment_array'][$key]['user_employment_positions'] = $this->User_model->get_user_employment_position_by_user_employment_id($user_employment['user_employment_id']);
			foreach ($data['user_employment_array'][$key]['user_employment_positions'] as $key1 => $employment_position) {
				$data['user_employment_array'][$key]['user_employment_positions'][$key1]['user_employment_position_other'] = $this->User_model->get_user_other_data_lookup_by_column_name_and_lookup_id('user_employment_positions_id', 'user_employment_position_others', $employment_position['user_employement_position_id']);
			}
		}
		$data['user_aircraft_experience_array'] = $this->User_model->get_user_aircraft_experience_by_user_id($_SESSION['user']['user_id']);
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['notice_period_array'] = $this->notice_period_array;
		$data['user_employment_type_array'] = $this->user_employment_type_array;
		$data['user_details_array'] = $_SESSION['user'];
		parent::render_view($data, '');
	}

	function print_users() {
		parent::allow(array('administrator'));
		$this->load->model('Aircraft_model');
		$data['user_id_array'] = $this->input->post('select_boxes');
		$data['notice_period_array'] = $this->notice_period_array;
		$this->load->view('templates/print_user', $data);
	}

}
