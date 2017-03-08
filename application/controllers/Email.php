<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
set_time_limit(0);

class Email extends MY_Controller {

	public $public_methods = array('cron', 'send_email_to_subscribed_users', 'scheduled_alerts', 'send_scheduled_emails');

	function __construct() {
		parent::__construct();
		$this->load->model('Email_model');
	}

	function cron($email_id = 0) {
		$email_details_array = $this->Email_model->get_queued_email($email_id);
		$success_flag = TRUE;
		if ($email_id === 0 && count($email_details_array) > 0) {
			foreach ($email_details_array as $email_details) {
				if ($success_flag === TRUE) {
					$email_mandrill_id = parent::send_email($email_details['email_from'], $email_details['email_from_name'], $email_details['email_to'], $email_details['email_subject'], $email_details['email_body'], json_decode($email_details['email_cc']), json_decode($email_details['email_bcc']));
					if ($email_mandrill_id !== '') {
						$email_update_array = array(
							'email_mandrill_id' => $email_mandrill_id,
							'email_status' => '1',
							'email_modified' => date('Y-m-d H:i:s')
						);
						if ($this->Email_model->update_email_status($email_details['email_id'], $email_update_array)) {
							$success_flag = TRUE;
						} else {
							$success_flag = FALSE;
						}
					}
				}
			}
			if ($success_flag === TRUE) {
				die('1');
			}
			die('0');
		}
		if ($email_id !== 0 && count($email_details_array) > 0) {
			$email_mandrill_id = parent::send_email($email_details_array['email_from'], $email_details_array['email_from_name'], $email_details_array['email_to'], $email_details_array['email_subject'], $email_details_array['email_body'], json_decode($email_details_array['email_cc']), json_decode($email_details_array['email_bcc']));
			if ($email_mandrill_id !== '') {
				$email_update_array = array(
					'email_mandrill_id' => $email_mandrill_id,
					'email_status' => '1',
					'email_modified' => date('Y-m-d H:i:s')
				);
				if ($this->Email_model->update_email_status($email_details_array['email_id'], $email_update_array)) {
					die('1');
				}
			}
		}
		die('0');
	}

	function scheduled_emails() {
		$data = array();
		$this->load->model('User_model');
		$user_licenses_array = $this->User_model->get_active_users_licences();
		if (count($user_licenses_array) > 0) {
			$users_details_array = $this->User_model->get_all_users();
			foreach ($user_licenses_array as $user_license) {
				
			}
		}
	}

	function contact_list() {
		parent::allow(array('administrator'));
		$data = array();
//		$emails = $this->Email_model->get_all_emails();
		$sales_interest_emails = $this->Email_model->get_sales_interest_emails();
		$aircraft_quote_emails = $this->Email_model->get_aircraft_quote_emails();
		$crew_support_emails = $this->Email_model->get_crew_support_emails();
		$invitaition_emails = $this->Email_model->get_invitation_recipients();
		$contact_us_emails = $this->Email_model->get_contact_us_feeds_emails();
//		$email_to = array();
		$aircraft_sales_interest_email = array();
		$aircraft_quote_email = array();
		$crew_support_email = array();
		$invitation_email_recipient = array();
		$contact_us_email = array();
//		foreach ($emails as $email) {
//			array_push($email_to, strtolower($email['email_to']));
//		}
		foreach ($sales_interest_emails as $email) {
			array_push($aircraft_sales_interest_email, strtolower($email['aircraft_sales_interest_email']));
		}
		foreach ($aircraft_quote_emails as $email) {
			array_push($aircraft_quote_email, strtolower($email['aircraft_quote_email']));
		}
		foreach ($crew_support_emails as $email) {
			array_push($crew_support_email, strtolower($email['crew_support_email']));
		}
		foreach ($invitaition_emails as $email) {
			array_push($invitation_email_recipient, strtolower($email['invitation_email']));
		}
		foreach ($contact_us_emails as $email) {
			array_push($contact_us_email, strtolower($email['contact_us_feed_email']));
		}
		$data['aircraft_sales_interest_email'] = array_unique($aircraft_sales_interest_email);
		$data['aircraft_quote_email'] = array_unique($aircraft_quote_email);
		$data['crew_support_email'] = array_unique($crew_support_email);
		$data['invitation_email_recipient'] = array_unique($invitation_email_recipient);
		$data['contact_us_feed_email'] = array_unique($contact_us_email);
		parent::render_view($data, '');
	}

	function send_email_to_subscribed_users() {
		$this->load->model('User_model');
		$email_details_array = $this->Email_model->get_all_emails_contents();
		if (count($email_details_array) > 0) {
			$user_details_array = $this->User_model->get_users_by_active_subscription('1');
			if (count($user_details_array) > 0) {
				$template = 'others';
				$current_date = date('Y-m-d');
				$date = date('d');
				$time = date('H');
				$day = date('l');
				foreach ($email_details_array as $email_detail) {
					switch ($email_detail['conditional_email_id']) {
						case '1':
							$template = 'weekly_newsletters';
							break;
						case '2':
							$template = 'updates';
							break;
						case '3':
							$template = 'marketting';
							break;
						case '4':
							$template = 'others';
							break;
					}
					if ($email_detail['conditional_email_scheduled'] == '1' && $email_detail['conditional_email_last_send_on'] != $current_date) {
						foreach ($user_details_array as $user) {
							$email1 = parent::add_email_to_queue('', '', $user['user_email'], $user['user_id'], 'InCrew Newsletter', $this->render_view($email_detail, 'emails', 'emails/templates/' . $template, TRUE), array(), array(), array(), $current_date . ' ' . $email_detail['conditional_email_scheduled_on'] . ':00:00');
						}
						$email_update_array = array(
							'conditional_email_last_send_on' => $current_date
						);
						$this->Email_model->edit_conditional_email_by_id($email_detail['conditional_email_id'], $email_update_array);
					}

					if ($email_detail['conditional_email_scheduled'] == '7' && $email_detail['conditional_email_scheduled_on'] == $day && $email_detail['conditional_email_last_send_on'] != $current_date) {
						foreach ($user_details_array as $user) {
							$email1 = parent::add_email_to_queue('', '', $user['user_email'], $user['user_id'], 'InCrew Newsletter', $this->render_view($email_detail, 'emails', 'emails/templates/' . $template, TRUE), array(), array(), array(), $current_date . ' 00:00:00');
						}
						$email_update_array = array(
							'conditional_email_last_send_on' => $current_date
						);
						$this->Email_model->edit_conditional_email_by_id($email_detail['conditional_email_id'], $email_update_array);
					}
					if ($email_detail['conditional_email_scheduled'] == '30' && $email_detail['conditional_email_scheduled_on'] == $date && $email_detail['conditional_email_last_send_on'] != $current_date) {
						foreach ($user_details_array as $user) {
							$email1 = parent::add_email_to_queue('', '', $user['user_email'], $user['user_id'], 'InCrew Newsletter', $this->render_view($email_detail, 'emails', 'emails/templates/' . $template, TRUE), array(), array(), array(), $current_date . ' 00:00:00');
						}
						$email_update_array = array(
							'conditional_email_last_send_on' => $current_date
						);
						$this->Email_model->edit_conditional_email_by_id($email_detail['conditional_email_id'], $email_update_array);
					}
				}
			}
		}
		die;
	}

	function marketing_email_setup() {
		parent::allow(array('administrator'));
		$this->load->config('email');
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('marketing_email_template', 'Email template', 'trim|required');
			$this->form_validation->set_rules('send_to', 'Email send to', 'trim|required');
			if ($this->input->post('send_to') == '2') {
				$this->form_validation->set_rules('marketing_email_send_to', 'Category', 'trim|required');
			} else if ($this->input->post('send_to') === '1') {
				$this->form_validation->set_rules('marketing_email_sent_to_user', 'User email', 'trim|required|valid_email');
			}
			if ($this->input->post('marketing_email_schedule') === '2') {
				$this->form_validation->set_rules('marketing_email_date', 'Date', 'trim|required');
				$this->form_validation->set_rules('marketing_email_month', 'Month', 'trim|required');
				$this->form_validation->set_rules('marketing_email_year', 'Year', 'trim|required');
			}
			if ($this->form_validation->run()) {
				$send_time = date('Y-m-d H:i:s');
				if ($this->input->post('marketing_email_send_to_admin') != null && $this->input->post('marketing_email_send_to_admin') === '1') {
					$admin_email = parent::add_email_to_queue('', '', $this->config->item('email_from'), $_SESSION['user']['user_id'], 'Career with InCrew', $this->load->view('emails/templates/marketing/template1', '', true));
					if ($admin_email > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $admin_email);
					}
				}
				if ($this->input->post('marketing_email_schedule') === '2') {
					$send_time = $this->input->post('marketing_email_year') . '-' . $this->input->post('marketing_email_month') . '-' . $this->input->post('marketing_email_date') . ' ' . $this->input->post('marketing_email_hour') . ':' . $this->input->post('marketing_email_minute') . ':' . $this->input->post('marketing_email_second');
				}
				if ($this->input->post('send_to') === '1') {
					$emailid = parent::add_email_to_queue('', '', $this->input->post('marketing_email_sent_to_user'), '0', 'Career with InCrew', $this->load->view('emails/templates/marketing/template1', '', true), array(), array(), array(), $send_time);
					if ($emailid > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid);
						die('1');
					}
				} else {
					if (count($this->input->post('select_email')) > 0) {
						foreach ($this->input->post('select_email') as $email) {
							$emailid = parent::add_email_to_queue('', '', $email, '0', 'Career with InCrew', $this->load->view('emails/templates/marketing/template1', '', true), array(), array(), array(), $send_time);
							@file_get_contents(base_url() . 'email/cron/' . $emailid);
						}
						die('1');
					}
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		parent::render_view($data, '');
	}

	function get_emails_by_form_categories($user_type = '') {
		parent::allow(array('administrator'));
		parent::json_output($this->Email_model->get_users_by_table_name($user_type));
	}

	function email_timing($from = '12', $to = '12') {
		parent::allow(array('administrator'));
		$this->load->model('Configuration_model');
		$this->load->helper('form');
		$data = array();
		$data = $this->Configuration_model->get_configuration_by_id('3');
		if ($this->input->post()) {
			if ($this->input->post('configuration_email_from_hour') && $this->input->post('configuration_email_from_min') && $this->input->post('configuration_email_from')) {
				if (intval($this->input->post('configuration_email_from')) == '2') {
					if (intval($this->input->post('configuration_email_from_hour')) == '12') {
						$from = intval($this->input->post('configuration_email_from_hour'));
					} else {
						$from = intval($this->input->post('configuration_email_from_hour')) + 12;
					}
				} else {
					if (intval($this->input->post('configuration_email_from_hour')) == '12') {
						$from = "00";
					} else {
						$from = $this->input->post('configuration_email_from_hour');
					}
				}
				$from = $from . $this->input->post('configuration_email_from_min') . "00";
			}
			if ($this->input->post('configuration_email_to_hour') && $this->input->post('configuration_email_to_min') && $this->input->post('configuration_email_to')) {
				if (intval($this->input->post('configuration_email_to')) == '2') {
					if (intval($this->input->post('configuration_email_to_hour')) == '12') {
						$to = intval($this->input->post('configuration_email_to_hour'));
					} else {
						$to = intval($this->input->post('configuration_email_to_hour')) + 12;
					}
				} else {
					if (intval($this->input->post('configuration_email_to_hour')) == '12') {
						$to = "00";
					} else {
						$to = $this->input->post('configuration_email_to_hour');
					}
				}
				$to = $to . $this->input->post('configuration_email_to_min') . "01";
			}
			if ($this->Configuration_model->edit_configuration_by_id('3', array('configuration_email_from' => $from, 'configuration_email_to' => $to))) {
				die('1');
			}
			die;
		}
		parent::render_view($data);
	}

	function change_configuration() {
		parent::allow(array('administrator'));
		$this->load->model('Configuration_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('configuration_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('configuration_email_status', 'Value', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_configuration_by_id($this->input->post('configuration_id'), array('configuration_email_status' => $this->input->post('configuration_email_status')))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function scheduled_alerts() {
		$this->load->model('User_model');
		//license alert for expiry
		$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('5');
		if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
			$user_license_array = $this->User_model->get_user_licenses_by_expire_date(date('Y-m-d', strtotime("+30 days")));
			$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('5');
			if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
				if ($this->Email_model->edit_conditional_email_by_id('5', array('conditional_email_last_send_on' => date('Y-m-d')))) {
					if (count($user_license_array) > 0) {
						foreach ($user_license_array as $user_detail) {
							parent::add_email_to_queue('', '', $user_detail['user_email'], $user_detail['user_id'], 'License Expiration Alert', $this->render_view($user_detail, 'emails', 'emails/templates/license_alert', TRUE), array(), array(), array(), date('Y-m-d H:i:s'));
						}
					}
				}
			}
		}
		//validation alert for expiry
		$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('6');
		if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
			$user_validation_array = $this->User_model->get_user_validations_by_expire_date(date('Y-m-d', strtotime('+30 days')));
			$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('6');
			if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
				if ($this->Email_model->edit_conditional_email_by_id('6', array('conditional_email_last_send_on' => date('Y-m-d')))) {
					if (count($user_validation_array) > 0) {
						foreach ($user_validation_array as $user_detail) {
							parent::add_email_to_queue('', '', $user_detail['user_email'], $user_detail['user_id'], 'Validation Expiration Alert', $this->render_view($user_detail, 'emails', 'emails/templates/validation_alert', TRUE), array(), array(), array(), date('Y-m-d H:i:s'));
						}
					}
				}
			}
		}
		$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('7');
		if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
			if ($this->Email_model->edit_conditional_email_by_id('7', array('conditional_email_last_send_on' => date('Y-m-d')))) {
				$user_passport_array = $this->User_model->get_user_passports_by_expire_date(date('Y-m-d', strtotime('+30 days')));
				if (count($user_passport_array) > 0) {
					foreach ($user_passport_array as $user_detail) {
						parent::add_email_to_queue('', '', $user_detail['user_email'], $user_detail['user_id'], 'Passport Expiration Alert', $this->render_view($user_detail, 'emails', 'emails/templates/passport_alert', TRUE), array(), array(), array(), date('Y-m-d H:i:s'));
					}
				}
			}
		}
		//visa alert for expiry
		$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('8');
		if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
			$user_visa_array = $this->User_model->get_user_visa_by_expire_date(date('Y-m-d', strtotime("+30 days")));
			$conditional_email_array = $this->Email_model->get_conditional_emails_by_id('8');
			if ($conditional_email_array['conditional_email_last_send_on'] !== date('Y-m-d')) {
				if ($this->Email_model->edit_conditional_email_by_id('8', array('conditional_email_last_send_on' => date('Y-m-d')))) {
					if (count($user_visa_array) > 0) {
						foreach ($user_visa_array as $user_detail) {
							parent::add_email_to_queue('', '', $user_detail['user_email'], $user_detail['user_id'], 'Visa Expiration Alert', $this->render_view($user_detail, 'emails', 'emails/templates/visa_alert', TRUE), array(), array(), array(), date('Y-m-d H:i:s'));
						}
					}
				}
			}
		}
	}

	function send_scheduled_emails() {
		$email_array = $this->Email_model->get_email_by_scheduled_date_and_status();
		if (count($email_array) > 0) {
			foreach ($email_array as $email) {
				@file_get_contents(base_url() . 'email/cron/' . $email['email_id']);
			}
		}
	}

}
