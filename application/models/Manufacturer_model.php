<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Manufacturer_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($manufacturer_insert_array) {
		return $this->db->insert('manufacturers', $manufacturer_insert_array);
	}

	function edit_manufacturer_by_id($manufacturer_id, $manufacturer_update_array) {
		return $this->db->update('manufacturers', $manufacturer_update_array, array('manufacturer_id' => $manufacturer_id));
	}

	function get_manufacturer_by_id($manufacturer_id) {
		return $this->db->where('manufacturer_id', $manufacturer_id)->get('manufacturers')->row_array();
	}

	function get_manufacturers() {
		return $this->db->where('manufacturer_status', '1')->get('manufacturers')->result_array();
	}

}
