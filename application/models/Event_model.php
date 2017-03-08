<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Event_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($event_insert_array) {
		return $this->db->insert('events', $event_insert_array);
	}

	function count_active_events() {
		return $this->db->where('event_status', '1')->get('events')->num_rows();
	}

	function get_active_events($limit = '', $offset = '') {
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		return $this->db->where('event_status', '1')->order_by('event_created', 'desc')->get('events')->result_array();
	}

	function get_event_by_id($event_id, $event_slug = '') {
		if ($event_slug !== '') {
			$this->db->where('event_slug', $event_slug);
		}
		return $this->db->where('event_id', $event_id)->get('events')->row_array();
	}

	function edit_event_by_id($event_id, $event_update_array) {
		return $this->db->update('events', $event_update_array, array('event_id' => $event_id));
	}

}
