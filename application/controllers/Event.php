<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {

	public $public_methods = array('index', 'view');

	function __construct() {
		parent::__construct();
		$this->load->model('Event_model');
	}

	function upload_files() {
		parent::upload_files();
	}

	function index($data_limit = 0) {
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'news-and-events';
		$total_rows = $this->Event_model->count_active_events();
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 7;
		$config["uri_segment"] = 2;
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
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data['event_array'] = $this->Event_model->get_active_events($config['per_page'], $page);
		$data['title'] = 'News and Events';
		parent::render_view($data, 'common');
	}

	function datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('events.event_status!=' => '-1'));
		$this->datatables->select('event_id,event_title,event_detail,event_status')->from('events');
		echo $this->datatables->generate();
	}

	function lists() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function view($event_slug = '', $event_id = '') {
		$data = array();
		$data['event_array'] = $this->Event_model->get_event_by_id($event_id, $event_slug);
		$data['title'] = $data['event_array']['event_title'];
		parent::render_view($data, 'common');
	}

	function change_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('event_id', 'Event ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('event_status', 'Event Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Event_model->edit_event_by_id($this->input->post('event_id'), array(
						'event_status' => $this->input->post('event_status') === 'true' ? '1' : '0',
						'event_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function delete() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('event_id', 'Event ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Event_model->edit_event_by_id($this->input->post('event_id'), array('event_status' => '-1'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
			$this->form_validation->set_rules('event_detail', 'Event Detail', 'trim|required');
			$this->form_validation->set_rules('event_image', 'Event Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image_directory = FCPATH . 'uploads/events' . date('/Y/m/d/H/i/s', strtotime($time_now));
				if (!is_dir($upload_image_directory)) {
					mkdir($upload_image_directory, 0777, TRUE);
				}
				$image_file = $this->input->post('event_image');
				if (is_file(FCPATH . 'uploads/' . $image_file)) {
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $image_file);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size) / 2;
						$crop_image_y_size = 0;
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size) / 2;
						$crop_image_x_size = 0;
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $image_file, $upload_image_directory . '/' . $image_file, 586, 328)) {
						$event_insert_array = array(
							'event_title' => $this->input->post('event_title'),
							'event_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', str_replace(array('&', '@', '+'), ' ', $this->input->post('event_title'))))),
							'event_detail' => nl2br($this->input->post('event_detail')),
							'event_image' => $image_file,
							'users_id' => $_SESSION['user']['user_id'],
							'event_status' => '1',
							'event_created' => $time_now
						);
						if ($this->Event_model->add($event_insert_array)) {
							unlink(FCPATH . 'uploads/' . $image_file);
							die('1');
						}
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

	function edit($event_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['event_array'] = $this->Event_model->get_event_by_id($event_id);
		if (count($data['event_array']) === 0) {
			redirect(base_url() . 'event/lists');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('event_title', 'Event Title', 'trim|required');
			$this->form_validation->set_rules('event_detail', 'Event Detail', 'trim|required');
			$this->form_validation->set_rules('event_image', 'Event Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image_directory = FCPATH . 'uploads/events' . date('/Y/m/d/H/i/s', strtotime($data['event_array']['event_created']));
				if (!is_dir($upload_image_directory)) {
					mkdir($upload_image_directory, 0777, TRUE);
				}
				$image_file = $this->input->post('event_image');
				if (is_file(FCPATH . 'uploads/' . $image_file)) {
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $image_file);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size) / 2;
						$crop_image_y_size = '0';
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size) / 2;
						$crop_image_x_size = '0';
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $image_file, $upload_image_directory . '/' . $image_file, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $image_file);
					}
				}
				$event_update_array = array(
					'event_title' => $this->input->post('event_title'),
					'event_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', str_replace(array('&', '@', '+'), ' ', $this->input->post('event_title'))))),
					'event_detail' => nl2br($this->input->post('event_detail')),
					'event_image' => $image_file,
					'event_modified' => date('Y-m-d H:i:s')
				);
				if ($this->Event_model->edit_event_by_id($event_id, $event_update_array)) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		parent::render_view($data, '');
	}

}
