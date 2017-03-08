<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Advertisement_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function get_all_advertisements() {
		$this->db->where("advertisement_status != -1");
		return $this->db->order_by('advertisement_order', 'ASC')->get('advertisements')->result_array();
	}

	function get_last_advertisement() {
		return $this->db->limit(1, 0)->order_by('advertisement_order', 'desc')->get('advertisements')->row_array();
	}

	function add($advertisement_array) {
		return $this->db->insert('advertisements', $advertisement_array);
	}

	function get_advertisement_by_id($advertisement_id) {
		return $this->db->where('advertisement_id', $advertisement_id)->get('advertisements')->row_array();
	}

	function get_active_advertisements($limit = '', $offset = '') {
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		return $this->db->order_by('advertisement_order', 'asc')->where('advertisement_status', '1')->get('advertisements')->result_array();
	}

	function edit_advertisement_by_id($advertisement_id, $advertisement_array) {
		return $this->db->update('advertisements', $advertisement_array, array('advertisement_id' => $advertisement_id));
	}

	function add_popup_ad($popup_ad_array) {
		return $this->db->insert('popup_ads', $popup_ad_array);
	}

	function edit_popup_ad_by_id($popup_ad_id, $popup_ad_array) {
		return $this->db->update('popup_ads', $popup_ad_array, array('popup_ad_id' => $popup_ad_id));
	}

	function get_popup_ad_by_id($popup_ad_id) {
		return $this->db->where('popup_ad_id', $popup_ad_id)->get('popup_ads')->row_array();
	}

	function get_popup_ad_url_by_popup_id($pop_ad_id) {
		return $this->db->where(array('popup_ad_url_status' => '1', 'popup_ads_id' => $pop_ad_id))->get('popup_ad_urls')->result_array();
	}

	function add_popup_ad_url($popup_ad_url_array) {
		return $this->db->insert('popup_ad_urls', $popup_ad_url_array);
	}

	function edit_popup_ad_url_by_id($popup_ad_url_id, $popup_ad_url_array) {
		return $this->db->update('popup_ad_urls', $popup_ad_url_array, array('popup_ad_url_id' => $popup_ad_url_id));
	}

	function get_popup_ad_url_by_url($popup_ad_url) {
		$this->db->join('popup_ads', 'popup_ads.popup_ad_id=popup_ad_urls.popup_ads_id', 'left');
		return $this->db->where(array('popup_ad_url_status' => '1', 'popup_ads.popup_ad_status' => '1', 'popup_ad_url' => $popup_ad_url))->get('popup_ad_urls')->row_array();
	}

}
