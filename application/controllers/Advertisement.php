<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends MY_Controller {

	public $public_methods = array('count_popup_ad_click');

	function __construct() {
		parent::__construct();
		$this->load->model('Advertisement_model');
	}

	function upload_files() {
		parent::upload_files();
	}

	function index() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		if ($this->input->post()) {
			foreach ($this->input->post('advertisement_id') as $key => $advertisement_id) {
				$this->Advertisement_model->edit_advertisement_by_id($advertisement_id, array(
					'advertisement_order' => $key + 1,
					'advertisement_modified' => date('Y-m-d H:i:s')
				));
			}
			die('1');
		}
		$data['advertisement_array'] = $this->Advertisement_model->get_all_advertisements();
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('6');
		parent::render_view($data, '');
	}

	function add() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('advertisement_name', 'Advertisement Name', 'trim|required');
			$this->form_validation->set_rules('advertisement_link', 'Advertisement Link', 'trim|required');
			$this->form_validation->set_rules('advertisement_image', 'Advertisement Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$image_upload_directory = FCPATH . 'uploads/advertisements/' . date('Y/m/d/H/i/s', strtotime($time_now));
				$advertisement_image = $this->input->post('advertisement_image');
				if (is_file(FCPATH . 'uploads/' . $advertisement_image)) {
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, true);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $advertisement_image, $image_upload_directory . '/' . $advertisement_image, 1170, 150)) {
						$advertisement_array = $this->Advertisement_model->get_last_advertisement();
						if ($this->Advertisement_model->add(array(
									'advertisement_name' => $this->input->post('advertisement_name'),
									'advertisement_order' => '0',
									'advertisement_image' => $advertisement_image,
									'advertisement_link' => $this->input->post('advertisement_link'),
									'advertisement_order' => count($advertisement_array) > 0 ? $advertisement_array['advertisement_order'] + 1 : '1',
									'advertisement_status' => '1',
									'advertisement_created' => $time_now
								))) {
							unlink(FCPATH . 'uploads/' . $advertisement_image);
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

	function edit($advertisement_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['advertisement_array'] = $this->Advertisement_model->get_advertisement_by_id($advertisement_id);
		if (count($data['advertisement_array']) === 0) {
			redirect('advertisement', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('advertisement_name', 'Advertisement Name', 'trim|required');
			$this->form_validation->set_rules('advertisement_link', 'Advertisement Link', 'trim|required');
			$this->form_validation->set_rules('advertisement_image', 'Advertisement Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$image_upload_directory = FCPATH . 'uploads/advertisements/' . date('Y/m/d/H/i/s', strtotime($data['advertisement_array']['advertisement_created']));
				$advertisement_image = $this->input->post('advertisement_image');
				if (is_file(FCPATH . 'uploads/' . $advertisement_image)) {
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, true);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $advertisement_image, $image_upload_directory . '/' . $advertisement_image, 1170, 150)) {
						unlink(FCPATH . 'uploads/' . $advertisement_image);
					}
				}
				if ($this->Advertisement_model->edit_advertisement_by_id($advertisement_id, array(
							'advertisement_name' => $this->input->post('advertisement_name'),
							'advertisement_image' => $advertisement_image,
							'advertisement_link' => $this->input->post('advertisement_link'),
							'advertisement_modified' => date('Y-m-d H:i:s')
						))) {
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

	function change_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('advertisement_id', 'Advertisement ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('advertisement_status', 'Advertisement Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Advertisement_model->edit_advertisement_by_id($this->input->post('advertisement_id'), array(
						'advertisement_status' => $this->input->post('advertisement_status') == 'true' ? '1' : '0',
						'advertisement_modified' => date('Y-m-d H:i:s')
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
		$this->form_validation->set_rules('advertisement_id', 'Advertisement ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Advertisement_model->edit_advertisement_by_id($this->input->post('advertisement_id'), array('advertisement_status' => '-1', 'advertisement_modified' => date('Y-m-d H:i:s')))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function popup_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('popup_ad_status!=' => '-1'));
		$this->datatables->select("popup_ad_id,popup_ad_label,popup_ad_link,CONCAT('" . base_url() . "uploads/advertisements/popup_ads/',DATE_FORMAT(popup_ad_created,'%Y/%m/%d/%H/%i/%s/'),popup_ad_image) as image_url,popup_ad_click_count,popup_ad_status", FALSE)->from('popup_ads');
		echo $this->datatables->generate();
	}

	function popup_ads() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_popup_ad_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('popup_ad_id', 'Popup Ad ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('popup_ad_status', 'Popup Ad Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Advertisement_model->edit_popup_ad_by_id($this->input->post('popup_ad_id'), array(
						'popup_ad_status' => $this->input->post('popup_ad_status') == 'true' ? '1' : '0',
						'popup_ad_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function delete_popup_ad() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('popup_ad_id', 'Popup Ad ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Advertisement_model->edit_popup_ad_by_id($this->input->post('popup_ad_id'), array(
						'popup_ad_status' => '-1',
						'popup_ad_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_popup_ad() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('popup_ad_label', 'Label', 'trim|required|is_unique[popup_ads.popup_ad_label]');
			$this->form_validation->set_rules('popup_ad_image', 'Popup Ad Image', 'trim|required');
			$this->form_validation->set_rules('popup_ad_link', 'Popup Ad Link', 'trim|prep_url');
			$this->form_validation->set_rules('popup_ad_link', 'Popup Ad  Link', 'trim|prep_url');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$image_upload_directory = FCPATH . 'uploads/advertisements/popup_ads' . date('/Y/m/d/H/i/s', strtotime($time_now));
				$popup_ad_image = $this->input->post('popup_ad_image');
				if (is_file(FCPATH . 'uploads/' . $popup_ad_image)) {
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, true);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $popup_ad_image, $image_upload_directory . '/' . $popup_ad_image, 600, 500)) {
						if ($this->Advertisement_model->add_popup_ad(array(
									'popup_ad_label' => $this->input->post('popup_ad_label'),
									'popup_ad_link' => prep_url($this->input->post('popup_ad_link')),
									'popup_ad_image' => $this->input->post('popup_ad_image'),
									'popup_ad_status' => '1',
									'popup_ad_click_count' => '0',
									'popup_ad_created' => $time_now
								))) {
							unlink(FCPATH . 'uploads/' . $popup_ad_image);
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

	function edit_popup_ad($popup_ad_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['popup_ad_array'] = $this->Advertisement_model->get_popup_ad_by_id($popup_ad_id);
		if (count($data['popup_ad_array']) === 0) {
			redirect('advertisement/popup_ads', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('popup_ad_label', 'Label', 'trim|required');
			$this->form_validation->set_rules('popup_ad_image', 'Popup Ad Image', 'trim|required');
			$this->form_validation->set_rules('popup_ad_link', 'Popup Ad  Link', 'trim|prep_url');
			if ($this->form_validation->run()) {
				$popup_ad_image = $this->input->post('popup_ad_image');
				if (is_file(FCPATH . 'uploads/' . $popup_ad_image)) {
					$image_upload_directory = FCPATH . 'uploads/advertisements/popup_ads' . date('/Y/m/d/H/i/s', strtotime($data['popup_ad_array']['popup_ad_created']));
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $popup_ad_image, $image_upload_directory . '/' . $popup_ad_image, 600, 500)) {
						unlink(FCPATH . 'uploads/' . $popup_ad_image);
					}
				}
				if ($this->Advertisement_model->edit_popup_ad_by_id($popup_ad_id, array(
							'popup_ad_label' => $this->input->post('popup_ad_label'),
							'popup_ad_link' => prep_url($this->input->post('popup_ad_link')),
							'popup_ad_image' => $popup_ad_image,
							'popup_ad_status' => '1',
							'popup_ad_modified' => date('Y-m-d H:i:s')
						))) {
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

	function manage_url($popup_ad_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['popup_ad_array'] = $this->Advertisement_model->get_popup_ad_by_id($popup_ad_id);
		if (count($data['popup_ad_array']) === 0) {
			redirect('advertisement/popup_ads', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('popup_ad_url', 'URL', 'trim|required|prep_url');
			if ($this->form_validation->run()) {
				$popup_ad_url_array = $this->Advertisement_model->get_popup_ad_url_by_url($this->input->post('popup_ad_url'));
				if (count($popup_ad_url_array) < 1) {
					if ($this->Advertisement_model->add_popup_ad_url(array(
								'popup_ads_id' => $popup_ad_id,
								'popup_ad_url' => prep_url($this->input->post('popup_ad_url')),
								'popup_ad_url_status' => '1',
								'popup_ad_url_created' => date('Y-m-d H:i:s')
							))) {
						die('1');
					}
				} else {
					echo 'A Popup Ad is already Added for the URL.';
					die;
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['pop_ad_url_array'] = $this->Advertisement_model->get_popup_ad_url_by_popup_id($popup_ad_id);
		parent::render_view($data, '');
	}

	function delete_popup_ad_url() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('popup_ad_url_id', 'Popup Ad URL ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Advertisement_model->edit_popup_ad_url_by_id($this->input->post('popup_ad_url_id'), array(
						'popup_ad_url_status' => '-1'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function count_popup_ad_click() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('popup_ad_id', 'PopUp Ad ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$popup_ad_array = $this->Advertisement_model->get_popup_ad_by_id($this->input->post('popup_ad_id'));
			if ($this->Advertisement_model->edit_popup_ad_by_id($this->input->post('popup_ad_id'), array(
						'popup_ad_click_count' => $popup_ad_array['popup_ad_click_count'] + 1,
						'popup_ad_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

}
