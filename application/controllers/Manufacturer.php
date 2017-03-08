<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Manufacturer_model');
	}

	function datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('manufacturer_status !=' => '-1'));
		$this->datatables->select('manufacturer_id,manufacturer_name,manufacturer_status', FALSE)->from('manufacturers');
		echo $this->datatables->generate();
	}

	function index() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('manufacturer_id', 'Manufacturer ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('manufacturer_status', 'Manufacturer Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Manufacturer_model->edit_manufacturer_by_id($this->input->post('manufacturer_id'), array(
						'manufacturer_status' => ($this->input->post('manufacturer_status') === 'true') ? '1' : '0',
						'manufacturer_modified' => date('Y-m-d H:i:s')
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
		$this->form_validation->set_rules('manufacturer_id', 'Manufacturer ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Manufacturer_model->edit_manufacturer_by_id($this->input->post('manufacturer_id'), array(
						'manufacturer_status' => '-1',
						'manufacturer_modified' => date('Y-m-d H:i:s')
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
			$this->form_validation->set_rules('manufacturer_name', 'Manufacturer Name', 'trim|required|is_unique[manufacturers.manufacturer_name]');
			if ($this->form_validation->run()) {
				$manufacturer_insert_array = array(
					'manufacturer_name' => $this->input->post('manufacturer_name'),
					'manufacturer_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('manufacturer_name')))),
					'manufacturer_status' => '1',
					'manufacturer_created' => date('Y-m-d H:i:s')
				);
				if ($this->Manufacturer_model->add($manufacturer_insert_array) > 0) {
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

	function edit($manufaturer_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['manufacturer_array'] = $this->Manufacturer_model->get_manufacturer_by_id($manufaturer_id);
		if (count($data['manufacturer_array']) === 0) {
			redirect(base_url() . 'manufacturer');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('manufacturer_name', 'Manufacturer Name', 'trim|required|edit_unique[manufacturers.manufacturer_name.manufacturer_id.' . $manufaturer_id . ']');
			if ($this->form_validation->run()) {
				$manufacturer_update_array = array(
					'manufacturer_name' => $this->input->post('manufacturer_name'),
					'manufacturer_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('manufacturer_name')))),
					'manufacturer_modified' => date('Y-m-d H:i:s')
				);
				if ($this->Manufacturer_model->edit_manufacturer_by_id($manufaturer_id, $manufacturer_update_array)) {
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

?>