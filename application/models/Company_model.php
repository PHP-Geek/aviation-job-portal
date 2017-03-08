<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Company_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($company_insert_array) {
		return $this->db->insert('companies', $company_insert_array);
	}

	function edit_company_by_id($company_id, $company_update_array) {
		return $this->db->update('companies', $company_update_array, array('company_id' => $company_id));
	}

	function get_company_by_id($company_id) {
		return $this->db->where('company_id', $company_id)->get('companies')->row_array();
	}

}
