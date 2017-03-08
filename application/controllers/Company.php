<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Company_model');
	}

	function upload_files() {
		parent::upload_files();
	}

	function datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('company_status!=' => '-1'));
		$this->datatables->select("company_id,company_name,company_description,CONCAT('" . base_url() . "uploads/companies/',DATE_FORMAT(company_created,'%Y/%m/%d/%H/%i/%s/'),company_logo) as image_url,company_status", FALSE)->from('companies');
		echo $this->datatables->generate();
	}

	function index() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_status() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('company_id', 'Company ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('company_status', 'Company Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Company_model->edit_company_by_id($this->input->post('company_id'), array(
						'company_status' => $this->input->post('company_status') === 'true' ? '1' : '0',
						'company_modified' => date('Y-m-d H:i:s')
					))) {
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
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('company_logo', 'Company Logo', 'trim|required');
			$this->form_validation->set_rules('company_description', 'Description', 'trim|required|min_length[30]');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image_directory = FCPATH . 'uploads/companies' . date('/Y/m/d/H/i/s', strtotime($time_now));
				if (!is_dir($upload_image_directory)) {
					mkdir($upload_image_directory, 0777, TRUE);
				}
				$upload_image = $this->input->post('company_logo');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
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
					if (parent::crop_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image($upload_image_directory . '/' . $upload_image, $upload_image_directory . '/' . $upload_image, 200, 200)) {
							if ($this->Company_model->add(array(
										'company_name' => $this->input->post('company_name'),
										'company_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('company_name')))),
										'company_logo' => $upload_image,
										'company_description' => $this->input->post('company_description'),
										'company_status' => '1',
										'company_created' => $time_now
									))) {
								unlink(FCPATH . 'uploads/' . $upload_image);
								die('1');
							}
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

	function edit($company_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['company_array'] = $this->Company_model->get_company_by_id($company_id);
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|edit_unique[companies.company_name.company_id.' . $company_id . ']');
			$this->form_validation->set_rules('company_description', 'Company Description', 'trim|required|min_length[30]');
			$this->form_validation->set_rules('company_logo', 'Logo', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image_directory = FCPATH . 'uploads/companies' . date('/Y/m/d/H/i/s', strtotime($data['company_array']['company_created']));
				if (!is_dir($upload_image_directory)) {
					mkdir($upload_image_directory);
				}
				$upload_image = $this->input->post('company_logo');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_array = getimagesize(FCPATH . 'uploads/' . $upload_image);
					$image_x_size = $upload_image_array[0];
					$image_y_size = $upload_image_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size) / 2;
						$crop_image_y_size = 0;
					} else {
						$crop_image_x_size = 0;
						$crop_image_y_size = ($crop_image_y_size - $crop_image_x_size) / 2;
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 200, 200)) {
							unlink(FCPATH . 'uploads/' . $upload_image);
						}
					}
				}
				if ($this->Company_model->edit_company_by_id($company_id, array(
							'company_name' => $this->input->post('company_name'),
							'company_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('company_slug')))),
							'company_description' => $this->input->post('company_description'),
							'company_logo' => $this->input->post('company_logo'),
							'company_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		if (count($data['company_array']) === 0) {
			redirect(base_url() . 'company');
		}
		if ($this->input->post()) {

		}
		parent::render_view($data, '');
	}

}
