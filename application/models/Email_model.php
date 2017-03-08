<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Email_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add_email_to_queue($email_insert_array) {
		if ($this->db->insert('emails', $email_insert_array)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_queued_email($email_id) {
		if ($email_id !== 0) {
			return $this->db->get_where('emails', array('email_status' => '0', 'email_id' => $email_id))->row_array();
		} else {
			return $this->db->get_where('emails', array('email_status' => '0'), '20', '0')->result_array();
		}
	}

	function update_email_status($email_id, $email_update_array) {
		if (is_numeric($email_id)) {
			$this->db->where('email_id', $email_id);
		} else {
			$this->db->where('email_mandrill_id', $email_id);
		}
		return $this->db->update('emails', $email_update_array);
	}

	function get_email_by_id($email_id) {
		return $this->db->get_where('emails', array('email_id' => $email_id))->row_array();
	}

	function get_all_emails() {
		return $this->db->get('emails')->result_array();
	}

	function get_sales_interest_emails() {
		return $this->db->get('aircraft_sales_interests')->result_array();
	}

	function get_aircraft_quote_emails() {
		return $this->db->get('aircraft_quotes')->result_array();
	}

	function get_crew_support_emails() {
		return $this->db->get('crew_support')->result_array();
	}

	function get_invitation_recipients() {
		return $this->db->get('invitation_emails')->result_array();
	}

	function get_contact_us_feeds_emails() {
		return $this->db->get('contact_us_feeds')->result_array();
	}

	function get_conditional_emails_by_id($email_id) {
		$this->db->where('conditional_email_id', $email_id);
		return $this->db->get('conditional_emails')->row_array();
	}

	function edit_conditional_email_by_id($email_id, $email_update_array) {
		$this->db->where('conditional_email_id', $email_id);
		return $this->db->update('conditional_emails', $email_update_array);
	}

	function get_all_emails_contents() {
		return $this->db->where('conditional_email_status', '1')->get('conditional_emails')->result_array();
	}

	function get_email_by_scheduled_date_and_status($date = '') {
		$where = '';
		if ($date !== '') {
			$where.="email_scheduled_on <= '" . $date . "' AND email_scheduled_on != '0000-00-00'";
		}
		$where.="email_status = 0";
		return $this->db->where($where)->get('emails')->result_array();
	}

	function get_users_by_table_name($table_name) {
		switch ($table_name) {
			case 'users':
				$this->db->select('users.user_email AS email');
				break;
			case 'crew_support':
				$this->db->select('crew_support.crew_support_email AS email');
				break;
			case 'aircraft_quotes':
				$this->db->select('aircraft_quotes.aircraft_quote_email AS email');
				break;
			case 'contact_us_feeds':
				$this->db->select('contact_us_feeds.contact_us_feed_email AS email');
				break;
			default:
				$this->db->select('users.user_email AS email');
				break;
		}
		$this->db->group_by('email');
		return $this->db->get($table_name)->result_array();
	}

}

?>