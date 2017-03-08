<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Seo_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function get_page_by_id($page_id) {
		return $this->db->where('page_id', $page_id)->get('pages')->row_array();
	}

	function edit_page_by_id($page_id, $page_update_array) {
		return $this->db->update('pages', $page_update_array, array('page_id' => $page_id));
	}

	function get_page_by_url($page_url) {
		return $this->db->where('page_url', $page_url)->get('pages')->row_array();
	}

}
