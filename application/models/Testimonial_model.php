<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Testimonial_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function add($testimonial_insert_array) {
		return $this->db->insert('testimonials', $testimonial_insert_array);
	}

	function edit_testimonial_by_id($testimonial_id, $testimonial_update_array) {
		return $this->db->update('testimonials', $testimonial_update_array, array('testimonial_id' => $testimonial_id));
	}

	function get_testimonials() {
		$this->db->order_by('testimonial_created', 'desc');
		return $this->db->limit(10, 0)->where('testimonial_status', '1')->get('testimonials')->result_array();
	}

	function get_testimonial_by_id($testimonial_id) {
		return $this->db->where(array('testimonial_id' => $testimonial_id, 'testimonial_status' => '1'))->get('testimonials')->row_array();
	}

}
