<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Metric_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function get_grouped_page_views() {
		$this->db->where("page_view_title != '404 Page Not Found' AND page_view_title != ''");
		return $this->db->group_by('page_view_title')->get('page_views')->result_array();
	}

	function count_page_views($from_date = '', $to_date = '', $page_view_title = '') {
		if ($from_date !== '-' && $to_date !== '-') {
			$this->db->where("page_view_created >= '" . $from_date . "' AND page_view_created <= '" . $to_date . "'");
		}
		if ($page_view_title !== '-') {
			$this->db->where("page_view_title = '" . $page_view_title . "'");
		}
		$this->db->where("page_views.page_view_title != '' AND page_view_title != '404 Page Not Found'");
		return $this->db->get('page_views')->num_rows();
	}

	function get_page_views($limit = '', $offset = '', $from_date = '', $to_date = '', $page_view_title = '') {
		$this->db->join('users', 'users.user_id=page_views.users_id', 'left');
		if ($from_date !== '-' && $to_date !== '-') {
			$this->db->where("page_view_created >= '" . $from_date . "' AND page_view_created <= '" . $to_date . "'");
		}
		if ($page_view_title !== '-') {
			$this->db->where("page_view_title = '" . $page_view_title . "'");
		}
		$this->db->where("page_views.page_view_title != '' AND page_view_title != '404 Page Not Found'");
		if ($limit !== '' && $offset !== '') {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get('page_views')->result_array();
	}

	function get_monthly_page_views_by_page_link($page_view_link) {
		$this->db->select('page_view_link,sum(page_view_count) as monthly_views');
		$this->db->where("page_view_date >= '" . date('Y-m-d', strtotime('-30 days')) . "' AND page_view_date <= '" . date('Y-m-d') . "' AND page_view_link = '" . $page_view_link . "'");
		return $this->db->group_by('page_view_link')->get('page_views')->row_array();
	}

	function get_today_page_views_by_page_link($page_view_link) {
		$this->db->select('page_view_link,sum(page_view_count) as today_views');
		$this->db->where("page_view_date = '" . date('Y-m-d') . "' AND page_view_link = '" . $page_view_link . "'");
		return $this->db->group_by('page_view_link')->get('page_views')->row_array();
	}

}
