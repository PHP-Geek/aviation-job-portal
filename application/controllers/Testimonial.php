<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {

	public $public_methods = array('index');

	function __construct() {
		parent::__construct();
		$this->load->model('Testimonial_model');
	}

	function datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('testimonials.testimonial_status!=' => '-1'));
		$this->datatables->select("testimonial_id,testimonial_user_name,testimonial_content,testimonial_status")->from('testimonials');
		echo $this->datatables->generate();
	}

	function index() {
		$data = array();
		$data['testimonial_array'] = $this->Testimonial_model->get_testimonials();
		$data['title'] = 'Testimonials';
		parent::render_view($data, 'common');
	}

	function lists() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('testimonial_id', 'Testimonial Id', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('testimonial_status', 'Testimonial Status', 'trim|required');
		$this->form_validation->set_error_delimiters('', '<br />');
		if ($this->form_validation->run()) {
			$testimonial_update_array = array(
				'testimonial_status' => $this->input->post('testimonial_status') === 'true' ? '1' : '0',
				'testimonial_modified' => date('Y-m-d H:i:s')
			);
			if ($this->Testimonial_model->edit_testimonial_by_id($this->input->post('testimonial_id'), $testimonial_update_array)) {
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
			$this->form_validation->set_rules('testimonial_user_name', 'Person Name', 'trim|required');
			$this->form_validation->set_rules('testimonial_content', 'Message', 'trim|required');
			$this->form_validation->set_rules('testimonial_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image_directory = FCPATH . 'uploads/testimonials' . date('/Y/m/d/H/i/s', strtotime($time_now));
				$upload_image = $this->input->post('testimonial_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $upload_image);
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
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 480, 244)) {
						if ($this->Testimonial_model->add(array(
									'testimonial_user_name' => $this->input->post('testimonial_user_name'),
									'testimonial_content' => nl2br($this->input->post('testimonial_content')),
									'testimonial_image' => $this->input->post('testimonial_image'),
									'testimonial_status' => '1',
									'testimonial_created' => $time_now
								))) {
							unlink(FCPATH . 'uploads/' . $upload_image);
							die('1');
						}
					}
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		parent::render_view($data, '');
	}

	function edit($testimonial_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['testimonial_array'] = $this->Testimonial_model->get_testimonial_by_id($testimonial_id);
		if (count($data['testimonial_array']) === 0) {
			redirect(base_url() . 'testimonial/lists');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('testimonial_user_name', 'Person Name', 'trim|required');
			$this->form_validation->set_rules('testimonial_content', 'Message', 'trim|required');
			$this->form_validation->set_rules('testimonial_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time = $data['testimonial_array']['testimonial_created'];
				$upload_image_directory = FCPATH . 'uploads/testimonials' . date('/Y/m/d/H/i/s', strtotime($time));
				$image_file = $this->input->post('testimonial_image');
				if (is_file(FCPATH . 'uploads/' . $image_file)) {
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
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
					if (parent::resize_image(FCPATH . 'uploads/' . $image_file, $upload_image_directory . '/' . $image_file, 480, 244)) {
						unlink(FCPATH . 'uploads/' . $image_file);
					}
				}
				if ($this->Testimonial_model->edit_testimonial_by_id($testimonial_id, array(
							'testimonial_user_name' => $this->input->post('testimonial_user_name'),
							'testimonial_content' => $this->input->post('testimonial_content'),
							'testimonial_image' => $image_file,
							'testimonial_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			}
		}
		parent::render_view($data, '');
	}

	function title_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('configurations.configuration_id=' => '12', 'configurations.configuration_status!=' => '-1'));
		$this->datatables->select("configuration_id,configuration_name,configuration_status")->from('configurations');
		echo $this->datatables->generate();
	}

	function title() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function edit_title() {
		parent::allow(array('administrator'));
		$this->load->model('Configuration_model');
		$data = array();
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('12');
		if (count($data['configuration_array']) === 0) {
			redirect(base_url() . 'testimonial/title');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('configuration_name', 'title', 'trim');
			if ($this->form_validation->run()) {
				if ($this->Configuration_model->edit_configuration_by_id('12', array(
							'configuration_name' => $this->input->post('configuration_name'),
							'configuration_value' => $this->input->post('configuration_name')
						))) {
					die('1');
				}
			}
		}
		parent::render_view($data, '');
	}

}
