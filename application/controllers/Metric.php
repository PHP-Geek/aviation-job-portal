<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Metric extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Metric_model');
	}

	function page_views($from_date = '-', $to_date = '-', $page_view_title = '-') {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'metric/page_views/' . $from_date . '/' . $to_date . '/' . $page_view_title;
		if ($from_date !== '-' && $to_date !== '-') {
			$from_date = $from_date . ' ' . date('H:i:s');
			$to_date = $to_date . ' ' . date('H:i:s');
			$config["uri_segment"] = 6;
			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		} else {
			$config["uri_segment"] = 6;
			$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		}
		if ($from_date !== '-' && $to_date === '-') {
			$from_date = $from_date . ' ' . date('H:i:s');
			$to_date = date('Y-m-d H:i:s');
		}

		$data['total_rows'] = $this->Metric_model->count_page_views($from_date, $to_date, str_replace('%20', ' ', $page_view_title));
		$config["total_rows"] = $data['total_rows'];
		$config["per_page"] = 20;
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
		$data['page_view_array'] = $this->Metric_model->get_page_views($config['per_page'], $page, $from_date, $to_date, str_replace('%20', ' ', $page_view_title));
		$data['page_titles'] = $this->Metric_model->get_grouped_page_views();
		parent::render_view($data, '');
	}

	function jobs_history() {
		parent::allow(array('administrator'));
		$this->load->model('Job_model');
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'metric/jobs_history';
		$total_rows = $this->Job_model->count_total_jobs();
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
		$data['job_array'] = $this->Job_model->get_jobs($config['per_page'], $page);
		foreach ($data['job_array'] as $key => $jobs) {
			$data['job_array'][$key]['no_of_applicants'] = $this->Job_model->count_job_applicants_by_job_id($jobs['job_id']);
		}
		parent::render_view($data, '');
	}

	function job_share_datatable($job_id = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		if ($job_id !== '') {
			$this->datatables->where('jobs.job_id', $job_id);
		}
		$this->datatables->join('job_types', 'job_types.job_type_id=jobs.job_types_id', 'left');
		$this->datatables->select('job_id,job_title,job_type_name,job_facebook_share_count,job_twitter_share_count,job_googleplus_share_count,job_linkedin_share_count,job_pinterest_share_count', FALSE)->from('jobs');
		echo $this->datatables->generate();
	}

	function job_shares($job_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['job_id'] = $job_id;
		parent::render_view($data, '');
	}

}
