<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aircraft extends MY_Controller {

	public $public_methods = array('sales', 'sales_open', 'charter', 'request_quote',
		'get_aircrafts', 'get_aircraft_by_aircraft_type_id', 'search', 'sales_sheet_download', 'download_charter_brochure', 'download_dangerous_good_pdf', 'sales_and_acquisitions', 'aircraft_management');

	function __construct() {
		parent::__construct();
		$this->load->model('Aircraft_model');
	}

	function index() {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_all_aircrafts();
		parent::render_view($data, '');
	}

	function change_aircraft_order() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		foreach ($this->input->post('aircraft_id') as $key => $aircraft_id) {
			$this->Aircraft_model->edit_aircraft_by_id($aircraft_id, array(
				'aircraft_order' => $key + 1,
				'aircraft_modified' => date('Y-m-d H:i:s')
			));
		}
		die('1');
	}

	function highlights($aircraft_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircraft_by_id($aircraft_id);
		if (count($data['aircraft_array']) === 0) {
			redirect('aircraft', 'refresh');
		}
		if ($this->input->post()) {
			if ($this->Aircraft_model->edit_aircraft_highlight_by_aircraft_id($aircraft_id, array(
						'aircraft_highlight_status' => '-1'
					))) {
				if (count($this->input->post('aircraft_highlight')) > 0) {
					foreach ($this->input->post('aircraft_highlight') as $highlight) {
						if (isset($highlight) && $highlight !== '') {
							$this->Aircraft_model->add_aircraft_hightlight(array(
								'aircrafts_id' => $aircraft_id,
								'aircraft_highlight_value' => $highlight,
								'aircraft_highlight_status' => '1',
								'aircraft_highlight_created' => date('Y-m-d H:i:s')
							));
						}
					}
					die('1');
				}
			}
			die('0');
		}
		$data['aircraft_highlight_array'] = $this->Aircraft_model->get_aircraft_highlight_by_aircraft_id($aircraft_id);
		parent::render_view($data, '');
	}

	function upload_files() {
		parent::upload_files();
	}

	function update_social_media_share() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('social_media_service', 'Social Media Service', 'trim|required');
		$this->form_validation->set_rules('share_count', 'Share Count', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_by_id($this->input->post('aircraft_id'), array(
						'aircraft_' . $this->input->post('social_media_service') . '_share_count' => $this->input->post('share_count'),
						'aircraft_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function count_upload_images() {
		if (count($this->input->post('aircraft_images')) > 0) {
			if (count($this->input->post('aircraft_images')) > 3 && count($this->input->post('aircraft_images')) <= 12) {
				return true;
			} else {
				$this->form_validation->set_message('count_upload_images', 'You must upload atleast 4 images or maximum 12 images');
				return false;
			}
		}
		$this->form_validation->set_message('count_upload_images', 'Please upload aircraft images.');
		return false;
	}

	function change_status() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_status', 'Aircraft ID', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_by_id($this->input->post('aircraft_id'), array(
						'aircraft_status' => ($this->input->post('aircraft_status') === 'true') ? '1' : '0',
						'aircraft_modified' => date('Y-m-d H:i:s')
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
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->detete_aircraft_by_id($this->input->post('aircraft_id'))) {
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
		$this->load->model('Manufacturer_model');
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_types_id', 'Aircraft Type', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_name', 'Aircraft Name', 'trim|required');
			$this->form_validation->set_rules('models_id', 'Model', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_year', 'Aircraft Year', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_detail', 'About Aircraft', 'trim|required');
			$this->form_validation->set_rules('aircraft_images', 'Aircraft Images', 'callback_count_upload_images');
			$this->form_validation->set_rules('aircraft_image', 'Aircraft Thumbnail Image', 'trim|required');
			$this->form_validation->set_rules('aircraft_price', 'Aircraft Price', 'trim|required');
			$this->form_validation->set_rules('aircraft_origination_date', 'Date of Origination', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				if (count($this->input->post('aircraft_images')) > 0) {
					$upload_image_directory = FCPATH . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s', strtotime($time_now));
					$upload_pdf_directory = FCPATH . 'uploads/aircrafts/sales_sheets' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					$upload_thumbnail = $this->input->post('aircraft_image');
					if (is_file(FCPATH . 'uploads/' . $upload_thumbnail)) {
						$image_size_array = getimagesize(FCPATH . 'uploads/' . $upload_thumbnail);
						$image_x_size = $image_size_array[0];
						$image_y_size = $image_size_array[1];
						$crop_measure = min($image_x_size, $image_y_size);
						if ($image_x_size > $image_y_size) {
							$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
							$crop_image_y_size = '0';
						} else {
							$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
							$crop_image_x_size = '0';
						}
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $upload_thumbnail, $upload_image_directory . '/' . $upload_thumbnail, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image(FCPATH . 'uploads/' . $upload_thumbnail, $upload_image_directory . '/' . $upload_thumbnail, 646, 366)) {
							$max_order_val = $this->Aircraft_model->get_aircraft_max_order_by_aircraft_id();
							$aircraft_insert_array = array(
								'aircraft_types_id' => $this->input->post('aircraft_types_id'),
								'aircraft_name' => $this->input->post('aircraft_name'),
								'aircraft_slug' => strtolower($this->change_spec_char($this->input->post('aircraft_name'))),
								'models_id' => $this->input->post('models_id'),
								'aircraft_year' => $this->input->post('aircraft_year'),
								'aircraft_detail' => nl2br($this->input->post('aircraft_detail')),
								'aircraft_image' => $this->input->post('aircraft_image'),
								'aircraft_price' => $this->input->post('aircraft_price'),
								'aircraft_sales_sheet' => ($this->input->post('aircraft_sales_sheet') !== NULL) ? $this->input->post('aircraft_sales_sheet') : '',
								'aircraft_sales_sheet_download_count' => '0',
								'aircraft_status' => '1',
								'aircraft_order' => isset($max_order_val['aircraft_order']) ? $max_order_val['aircraft_order'] + 1 : '1',
								'aircraft_origination_date' => $this->input->post('aircraft_origination_date') !== '' ? parent::input_date_to_mysql_date($this->input->post('aircraft_origination_date')) : '',
								'aircraft_created' => $time_now
							);
							$aircraft_id = $this->Aircraft_model->add($aircraft_insert_array);
							if ($aircraft_id > 0) {
								if (!is_dir($upload_pdf_directory)) {
									mkdir($upload_pdf_directory, 0777, TRUE);
								}
								if (is_file(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'))) {
									if (copy(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'), $upload_pdf_directory . '/' . $this->input->post('aircraft_sales_sheet'))) {
										unlink(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'));
									}
								}
								if (count($this->input->post('aircraft_images')) > 0) {
									foreach ($this->input->post('aircraft_images') as $key => $aircraft_image) {
										if (is_file(FCPATH . 'uploads/' . $aircraft_image)) {
											if (parent::resize_image(FCPATH . 'uploads/' . $aircraft_image, $upload_image_directory . '/' . $aircraft_image, 646, 366)) {
												if ($this->Aircraft_model->add_aircraft_image(array(
															'aircrafts_id' => $aircraft_id,
															'aircraft_image_name' => $aircraft_image,
															'aircraft_image_status' => '1'
														))) {
													unlink(FCPATH . 'uploads/' . $aircraft_image);
												}
											}
										}
									}
								}
								unlink(FCPATH . 'uploads/' . $upload_thumbnail);
							}
						}
						die('1');
					}
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data['manufacturer_array'] = $this->Manufacturer_model->get_manufacturers();
		parent::render_view($data, '');
	}

	function edit($aircraft_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircraft_by_id($aircraft_id);
		$data['aircraft_array']['aircraft_images'] = $this->Aircraft_model->get_aircraft_images_by_aircraft_id($aircraft_id);
		if (count($data['aircraft_array']) === 0) {
			redirect(base_url() . 'aircraft');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_types_id', 'Aircraft Type', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_name', 'Aircraft Name', 'trim|required');
			$this->form_validation->set_rules('models_id', 'Model', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_year', 'Aircraft Year', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('aircraft_detail', 'About Aircraft', 'trim|required');
			$this->form_validation->set_rules('aircraft_images', 'Aircraft Images', 'callback_count_upload_images');
			$this->form_validation->set_rules('aircraft_image', 'Aircraft Thumbnail Image', 'trim|required');
			$this->form_validation->set_rules('aircraft_price', 'Aircraft Price', 'trim|required');
			$this->form_validation->set_rules('aircraft_origination_date', 'Date of Origination', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_pdf_directory = FCPATH . 'uploads/aircrafts/sales_sheets' . date('/Y/m/d/H/i/s', strtotime($data['aircraft_array']['aircraft_created']));
				if (is_file(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'))) {
					if (!is_dir($upload_pdf_directory)) {
						mkdir($upload_pdf_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'), $upload_pdf_directory . '/' . $this->input->post('aircraft_sales_sheet'))) {
						unlink(FCPATH . 'uploads/' . $this->input->post('aircraft_sales_sheet'));
					}
				}
				$upload_image_directory = FCPATH . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s', strtotime($data['aircraft_array']['aircraft_created']));
				$aircraft_image = $this->input->post('aircraft_image');
				if (is_file(FCPATH . 'uploads/' . $aircraft_image)) {
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $aircraft_image);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
						$crop_image_y_size = '0';
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
						$crop_image_x_size = '0';
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $aircraft_image, $upload_image_directory . '/' . $aircraft_image, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image(FCPATH . 'uploads/' . $aircraft_image, $upload_image_directory . '/' . $aircraft_image, 646, 366)) {
							unlink(FCPATH . 'uploads/' . $aircraft_image);
						}
					}
				}
				//update aircraft images
				if (count($this->input->post('aircraft_images')) > 0) {
					if ($this->Aircraft_model->edit_aircraft_images_by_id($aircraft_id, array(
								'aircraft_image_status' => '-1'
							))) {
						foreach ($this->input->post('aircraft_images') as $key => $aircraft_images) {
							$this->Aircraft_model->add_aircraft_image(array(
								'aircrafts_id' => $aircraft_id,
								'aircraft_image_name' => $aircraft_images,
								'aircraft_image_status' => '1'
							));
							if (is_file(FCPATH . 'uploads/' . $aircraft_images)) {
								$image_size_array = getimagesize(FCPATH . 'uploads/' . $aircraft_images);
								$image_x_size = $image_size_array[0];
								$image_y_size = $image_size_array[1];
								$crop_measure = min($image_x_size, $image_y_size);
								if ($image_x_size > $image_y_size) {
									$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
									$crop_image_y_size = '0';
								} else {
									$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
									$crop_image_x_size = '0';
								}
								if (parent::crop_image(FCPATH . 'uploads/' . $aircraft_images, $upload_image_directory . '/' . $aircraft_images, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
									if (parent::resize_image(FCPATH . 'uploads/' . $aircraft_images, $upload_image_directory . '/' . $aircraft_images, 646, 366)) {
										unlink(FCPATH . 'uploads/' . $aircraft_images);
									}
								}
							}
						}
					}
				}
				$aircraft_update_array = array(
					'aircraft_types_id' => $this->input->post('aircraft_types_id'),
					'aircraft_name' => $this->input->post('aircraft_name'),
					'aircraft_slug' => strtolower($this->change_spec_char($this->input->post('aircraft_name'))),
					'models_id' => $this->input->post('models_id'),
					'aircraft_detail' => nl2br($this->input->post('aircraft_detail')),
					'aircraft_year' => $this->input->post('aircraft_year'),
					'aircraft_image' => $aircraft_image,
					'aircraft_price' => $this->input->post('aircraft_price'),
					'aircraft_sales_sheet' => ($this->input->post('aircraft_sales_sheet') !== NULL) ? $this->input->post('aircraft_sales_sheet') : '',
					'aircraft_origination_date' => $this->input->post('aircraft_origination_date') !== '' ? parent::input_date_to_mysql_date($this->input->post('aircraft_origination_date')) : '',
					'aircraft_modified' => date('Y-m-d H:i:s')
				);
				if ($this->Aircraft_model->edit_aircraft_by_id($aircraft_id, $aircraft_update_array)) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data['model_array'] = $this->Aircraft_model->get_models();
		parent::render_view($data, '');
	}

	function add_type() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_type_name', 'Aircraft Type Name', 'trim|required|is_unique[aircraft_types. aircraft_type_name ]');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->add_aircraft_type(array(
						'aircraft_type_name' => $this->input->post('aircraft_type_name'),
						'aircraft_type_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('aircraft_type_name')))),
						'aircraft_type_status' => '1',
						'aircraft_type_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function sales($search_text = '') {
		$data = array();
		$data['manufacturer_array'] = $this->Aircraft_model->get_active_manufacturer();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircrafts('', '', '', '');
		if ($search_text != '') {
			$search_text = urldecode(str_replace('-', ' ', str_replace('_', '/', $search_text)));
			$data['aircraft_array'] = $this->Aircraft_model->get_aircrafts('', '', '', '', $search_text);
			$data['search_text'] = $search_text;
		}
		foreach ($data['aircraft_array'] as $key => $aircraft) {
			$data['aircraft_array'][$key]['aicraft_highlights'] = $this->Aircraft_model->get_aircraft_highlight_by_aircraft_id($aircraft['aircraft_id']);
		}
		$data['model_array'] = $this->Aircraft_model->get_active_models();
		$data['aircraft_year_array'] = $this->Aircraft_model->get_aircraft_years();
		$data['title'] = 'Aircraft Sales';
		parent::render_view($data, 'common');
	}

	function get_aircrafts() {
		$this->load->library('form_validation');
		$aircraft_array = $this->Aircraft_model->get_aircrafts($this->input->post('aircraft_order'), $this->input->post('manufacturers_id'), $this->input->post('models_id'), $this->input->post('aircraft_year'));
		$data['model_array'] = $this->Aircraft_model->get_models_by_manufacturer_id($this->input->post('manufacturers_id'));
		$data['aircraft_years'] = $this->Aircraft_model->get_aircraft_years($this->input->post('models_id'));
		$data['aircraft_year_array'] = $this->Aircraft_model->get_aircraft_year_by_manufacturer_id($this->input->post('manufacturers_id'));
		$string = '';
		if (count($aircraft_array) > 0) {
			foreach ($aircraft_array as $key => $aircraft) {
				if ($key === 0 || $key % 3 === 0) {
					$string.='<div class="row">';
				}
				$string.='<div class="col-md-4 col-lg-4"><div class="sale-sheet">';
				$string.='<div class = "new-image">';
				if ($aircraft['aircraft_is_new'] === '1') {
					$string.='<img src="' . base_url() . 'assets/img/new-plane.png" alt="pilot" class="img-responsive"/>';
				}
				if ($aircraft['aircraft_is_sold'] === '1') {
					$string.='<img src="' . base_url() . 'assets/img/sold-plane.png" alt="pilot" class="img-responsive"/>';
				}
				$string.='</div>';
				$string.= '<a href="' . base_url() . 'aircraft-sales-open/' . $aircraft['aircraft_slug'] . '/' . $aircraft['aircraft_id'] . '">'
						. '<img src="' . base_url() . 'uploads/aircrafts/images' . date('/Y/m/d/H/i/s/', strtotime($aircraft['aircraft_created'])) . $aircraft['aircraft_image'] . '" alt="image" style="height:188px" class="img-responsive center-block"/></a>'
						. '<h4 class="text-center"><a href="' . base_url() . 'aircraft-sales-open/' . $aircraft['aircraft_slug'] . '/' . $aircraft['aircraft_id'] . '">' . $aircraft['aircraft_name'] . '</a></h4>';
				$aircraft_highlight_array = $this->Aircraft_model->get_aircraft_highlight_by_aircraft_id($aircraft['aircraft_id']);
				if (count($aircraft_highlight_array) > 0) {
					$string.='<ul>';
					foreach ($aircraft_highlight_array as $highlight) {
						$string.='<li>' . $highlight['aircraft_highlight_value'] . '</li>';
					}
					$string.='</ul>';
				}
				$string.='</div></div>';
				if ($key === count($aircraft_array) - 1 || ($key + 1) % 3 === 0) {
					$string.='</div>';
				}
			}
		} else {
			$string = '<div class="col-md-12"><div class="well">Presently we have no Aircraft that are on market matching your request. Please contact us to find out what off market Aircraft we have available. It is highly likely that we have the perfect Aircraft available for you, but it is not listed at the request of the seller.</div>'
					. '<div class="text-center"><a href="' . base_url() . 'contact-us" class="btn btn-success">Contact Us <i class="fa fa-plane"></i></div>'
					. '</div>';
		}
		$string.='</div>';
		$data['string'] = $string;
		parent::json_output($data);
	}

	function aircraft_add_remove_new_symbol() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_is_new', 'New Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_by_id($this->input->post('aircraft_id'), array(
						'aircraft_is_new' => ($this->input->post('aircraft_is_new') === 'true') ? '1' : '0',
						'aircraft_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function aircraft_add_remove_sold_symbol() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_is_sold', 'Sold Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_by_id($this->input->post('aircraft_id'), array(
						'aircraft_is_sold' => ($this->input->post('aircraft_is_sold') === 'true') ? '1' : '0',
						'aircraft_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function sales_interest_datatable($aircraft_id = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('aircrafts', 'aircrafts.aircraft_id = aircraft_sales_interests.aircrafts_id');
		if ($aircraft_id !== '') {
			$this->datatables->where(array('aircraft_sales_interests.aircrafts_id' => $aircraft_id));
		}
		$this->datatables->where(array('aircraft_sales_interests.aircraft_sales_interest_status!=' => '-1'));
		$this->datatables->select("aircraft_sales_interest_id,aircraft_name,aircraft_sales_interest_name,aircraft_sales_interest_email,aircraft_sales_interest_company,aircraft_sales_interest_contact,aircraft_sales_interest_subject,aircraft_sales_interest_message,DATE_FORMAT(aircraft_sales_interest_created,'%d %b %Y %h:%i %p') AS aircraft_sales_interest_create,aircraft_sales_interest_status", FALSE)->from('aircraft_sales_interests');
		echo $this->datatables->generate();
	}

	function sale_interests($aircraft_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_id'] = $aircraft_id;
		parent::render_view($data, '');
	}

	function change_sales_interest_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_sales_interest_id', 'Sales Interest ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_sales_interest_status', 'Sales Interest Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_sales_interest_by_id($this->input->post('aircraft_sales_interest_id'), array(
						'aircraft_sales_interest_status' => $this->input->post('aircraft_sales_interest_status'),
						'aircraft_sales_interest_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function sales_sheet_download($aircraft_slug = '', $aircraft_id = '') {
		$aircraft_array = $this->Aircraft_model->get_aircraft_by_id($aircraft_id, $aircraft_slug);
		if (count($aircraft_array) > 0 && $aircraft_array['aircraft_sales_sheet'] !== '') {
			if (is_file(FCPATH . 'uploads/aircrafts/sales_sheets/' . date('Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_sales_sheet'])) {
				if ($this->Aircraft_model->edit_aircraft_by_id($aircraft_id, array('aircraft_sales_sheet_download_count' => $aircraft_array['aircraft_sales_sheet_download_count'] + 1))) {
					$this->load->helper('download');
					$file = file_get_contents(FCPATH . 'uploads/aircrafts/sales_sheets/' . date('Y/m/d/H/i/s/', strtotime($aircraft_array['aircraft_created'])) . $aircraft_array['aircraft_sales_sheet']);
					$name = $aircraft_array['aircraft_slug'] . '.pdf';
					force_download($name, $file);
				}
			}
		}
		redirect('aircraft-sales', 'refresh');
	}

	function sale_tabs($aircraft_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircraft_by_id($aircraft_id);
		if (count($data['aircraft_array']) === 0) {
			redirect('aircraft', 'refresh');
		}
		$data['aircraft_tab_array'] = $this->Aircraft_model->get_aircracft_sale_tabs_by_aircraft_id($aircraft_id, '1');
		parent::render_view($data, '');
	}

	function change_tab_order() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		foreach ($this->input->post('aircraft_sale_tab_id') as $key => $sale_tab_id) {
			$this->Aircraft_model->edit_aircraft_sale_tab_by_id($sale_tab_id, array(
				'aircraft_sale_tab_order' => $key + 1,
				'aircraft_sale_tab_modified' => date('Y-m-d H:i:s')
			));
		}
		die('1');
	}

	function add_sale_tab($aircraft_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircraft_by_id($aircraft_id);
		if (count($data['aircraft_array']) === 0) {
			redirect('aircraft', 'refresh');
		}
		$max_order_val = $this->Aircraft_model->get_aircraft_sale_tab_max_order_by_aircraft_id($aircraft_id);
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircrafts_id', 'Aircraft', 'trim|required');
			$this->form_validation->set_rules('aircraft_sale_tab_name', 'Tab Header', 'trim|required');
			$this->form_validation->set_rules('aircraft_sale_tab_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Aircraft_model->add_sale_tab(array(
							'aircrafts_id' => $this->input->post('aircrafts_id'),
							'aircraft_sale_tab_name' => $this->input->post('aircraft_sale_tab_name'),
							'aircraft_sale_tab_content' => $this->input->post('aircraft_sale_tab_content'),
							'aircraft_sale_tab_order' => $max_order_val['aircraft_sale_tab_order'] !== '' ? $max_order_val['aircraft_sale_tab_order'] + 1 : '1',
							'aircraft_sale_tab_status' => '1',
							'aircraft_sale_tab_created' => date('Y-m-d H:i:s')
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

	function edit_sale_tab($aircraft_sale_tab_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_tab_array'] = $this->Aircraft_model->get_aircraft_sale_tab_by_id($aircraft_sale_tab_id);
		if (count($data['aircraft_tab_array']) === 0) {
			redirect('aircraft', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_sale_tab_name', 'Tab Header', 'trim|required');
			$this->form_validation->set_rules('aircraft_sale_tab_content', 'Tab Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Aircraft_model->edit_aircraft_sale_tab_by_id($aircraft_sale_tab_id, array(
							'aircraft_sale_tab_name' => $this->input->post('aircraft_sale_tab_name'),
							'aircraft_sale_tab_content' => $this->input->post('aircraft_sale_tab_content'),
							'aircraft_sale_tab_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				} else {
					echo validation_errors();
					die;
				}
				die('0');
			}
		}
		parent::render_view($data, '');
	}

	function change_sale_tab_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_sale_tab_id', 'Sale Tab ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_sale_tab_status', 'Sale Tab Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_sale_tab_by_id($this->input->post('aircraft_sale_tab_id'), array(
						'aircraft_sale_tab_status' => $this->input->post('aircraft_sale_tab_status') === 'true' ? '1' : '0',
						'aircraft_sale_tab_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function delete_sale_tab() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_sale_tab_id', 'Sale Tab ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_sale_tab_by_id($this->input->post('aircraft_sale_tab_id'), array(
						'aircraft_sale_tab_status' => '-1',
						'aircraft_sale_tab_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function sales_open($aircraft_slug = '', $aircraft_id = '') {
		$this->load->model('Auth_model');
		$data = array();
		$data['aircraft_array'] = $this->Aircraft_model->get_aircraft_by_id($aircraft_id, $aircraft_slug);
		$data['aircraft_image_array'] = $this->Aircraft_model->get_aircraft_images_by_aircraft_id($aircraft_id);
		$data['aircraft_highlight_array'] = $this->Aircraft_model->get_aircraft_highlight_by_aircraft_id($aircraft_id);
		$data['user_country_array'] = $this->Auth_model->get_countries();
		if (count($data['aircraft_array']) === 0) {
			redirect(base_url() . 'aircraft-sales');
		}
		$this->Aircraft_model->edit_aircraft_by_id($aircraft_id, array(
			'aircraft_view_count' => $data['aircraft_array']['aircraft_view_count'] + 1,
			'aircraft_modified' => date('Y-m-d H:i:s')
		));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_sales_interest_name', 'Contact Name', 'trim|required');
			$this->form_validation->set_rules('aircraft_sales_interest_company', 'Company Name', 'trim');
			$this->form_validation->set_rules('aircraft_sales_interest_contact', 'Contact Number', 'trim|required');
			$this->form_validation->set_rules('aircraft_sales_interest_subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('aircraft_sales_interest_email', 'Email', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Aircraft_model->add_aircraft_sales_interest(array(
							'aircrafts_id' => $aircraft_id,
							'aircraft_sales_interest_name' => $this->input->post('aircraft_sales_interest_name'),
							'aircraft_sales_interest_company' => $this->input->post('aircraft_sales_interest_company'),
							'aircraft_sales_interest_contact' => $this->input->post('aircraft_sales_interest_country_code') . '-' . $this->input->post('aircraft_sales_interest_contact'),
							'aircraft_sales_interest_subject' => $this->input->post('aircraft_sales_interest_subject'),
							'aircraft_sales_interest_message' => ($this->input->post('aircraft_sales_interest_message') !== '') ? $this->input->post('aircraft_sales_interest_message') : '',
							'aircraft_sales_interest_email' => $this->input->post('aircraft_sales_interest_email'),
							'aircraft_sales_interest_status' => '1',
							'aircraft_sales_interest_created' => date('Y-m-d H:i:s')
						))) {
					$email_details_array = array(
						'user_email' => $this->input->post('aircraft_sales_interest_email'),
						'user_name' => $this->input->post('aircraft_sales_interest_name'),
						'message' => $this->input->post('aircraft_sales_interest_message'),
						'subject' => $this->input->post('aircraft_sales_interest_subject'),
						'aircraft_type' => $data['aircraft_array']['aircraft_name']
					);
					$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], '0', 'Request for aircraft', $this->render_view($email_details_array, 'emails', 'emails/templates/aircraft_sales/person', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '0', 'Request for aircraft', $this->render_view($email_details_array, 'emails', 'emails/templates/aircraft_sales/admin', TRUE));
					if ($emailid2 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid2);
					}
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		$data['aircraft_tabs'] = $this->Aircraft_model->get_aircracft_sale_tabs_by_aircraft_id($aircraft_id, '1', '1');
		$data['title'] = $data['aircraft_array']['aircraft_name'];
		parent::render_view($data, 'common');
	}

	function charter() {
		$this->load->model('Configuration_model');
		$data = array();
		$data['aircraft_type_array'] = $this->Aircraft_model->get_aircraft_types();
		$data['aircraft_charter_array'] = $this->Aircraft_model->get_aircraft_charter();
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('4');
		$this->load->model('Page_model');
		$data['page_testimonial_array'] = $this->Page_model->get_page_testimonial_by_id('2');
		$data['home_page_testimonial_array'] = $this->Page_model->get_active_home_page_testimonials('2');
		$data['page_content_array'] = $this->Page_model->get_page_content_by_id('2');
		$data['title'] = 'Aircraft Charter';
		parent::render_view($data, 'common');
	}

	function charter_content() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Page_model');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_content_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_home_page_by_id('2', array(
							'page_content_title' => $this->input->post('page_content_title'),
							'page_content' => nl2br($this->input->post('page_content')),
							'page_content_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['page_content_array'] = $this->Page_model->get_page_content_by_id('2');
		parent::render_view($data, '');
	}

	function charter_testimonial_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where('home_page_testimonial_category', '2');
		$this->datatables->select("home_page_testimonial_id,home_page_testimonial_content,home_page_testimonial_person,CONCAT('" . base_url() . 'uploads/page_testimonials/home_page/' . "',DATE_FORMAT(home_page_testimonial_created,'%Y/%m/%d/%H/%i/%s/'),home_page_testimonial_image) AS image_url,home_page_testimonial_status", FALSE)->from('home_page_testimonials');
		echo $this->datatables->generate();
	}

	function charter_testimonial() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_charter_testimonial() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('home_page_testimonial_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('home_page_testimonial_person', 'Person Name', 'trim|required');
			$this->form_validation->set_rules('home_page_testimonial_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_thumbnail = $this->input->post('home_page_testimonial_image');
				if (is_file(FCPATH . 'uploads/' . $upload_thumbnail)) {
					$upload_image_directory = FCPATH . 'uploads/page_testimonials/home_page/' . date('Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_thumbnail, $upload_image_directory . '/' . $upload_thumbnail, 150, 150)) {
						if ($this->Page_model->add_home_page_testimonial(array(
									'home_page_testimonial_content' => $this->input->post('home_page_testimonial_content'),
									'home_page_testimonial_person' => $this->input->post('home_page_testimonial_person'),
									'home_page_testimonial_image' => $upload_thumbnail,
									'home_page_testimonial_category' => '2',
									'home_page_testimonial_status' => '1',
									'home_page_testimonial_created' => $time_now
								))) {
							unlink(FCPATH . 'uploads/' . $upload_thumbnail);
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

	function edit_charter_testimonial($home_page_testimonial_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['home_page_testimonial_array'] = $this->Page_model->get_home_page_testimonial_by_id($home_page_testimonial_id);
		if (count($data['home_page_testimonial_array']) === 0) {
			redirect('aircraft/charter_testimonial', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('home_page_testimonial_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('home_page_testimonial_person', 'Person Name', 'trim|required');
			$this->form_validation->set_rules('home_page_testimonial_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_thumbnail = $this->input->post('home_page_testimonial_image');
				if (is_file(FCPATH . 'uploads/' . $upload_thumbnail)) {
					$upload_image_directory = FCPATH . 'uploads/page_testimonials/home_page/' . date('Y/m/d/H/i/s', strtotime($data['home_page_testimonial_array']['home_page_testimonial_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_thumbnail, $upload_image_directory . '/' . $upload_thumbnail, 150, 150)) {
						unlink(FCPATH . 'uploads/' . $upload_thumbnail);
					}
				}
				if ($this->Page_model->edit_home_page_testimonial_by_id($home_page_testimonial_id, array(
							'home_page_testimonial_content' => $this->input->post('home_page_testimonial_content'),
							'home_page_testimonial_person' => $this->input->post('home_page_testimonial_person'),
							'home_page_testimonial_image' => $upload_thumbnail,
							'home_page_testimonial_modified' => date('Y-m-d H:i:s')
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

	function change_aircraft_charter_testimonial_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('home_page_testimonial_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('home_page_testimonial_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_home_page_testimonial_by_id($this->input->post('home_page_testimonial_id'), array(
						'home_page_testimonial_status' => $this->input->post('home_page_testimonial_status') === 'true' ? '1' : '0',
						'home_page_testimonial_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function charter_brochure() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('7');
		$data['charter_brochure_array'] = $this->Configuration_model->get_configuration_by_id('2');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('configuration_value', 'Brochure File', 'trim|required');
			if ($this->form_validation->run()) {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('configuration_value'))) {
					$file_upload_directory = FCPATH . 'uploads/brochures/charter';
					if (!is_dir($file_upload_directory)) {
						mkdir($file_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $this->input->post('configuration_value'), $file_upload_directory . '/' . $this->input->post('configuration_value'))) {
						if ($this->Configuration_model->edit_configuration_by_id('7', array(
									'configuration_value' => $this->input->post('configuration_value')
								))) {
							unlink(FCPATH . 'uploads/' . $this->input->post('configuration_value'));
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

	function download_charter_brochure() {
		$this->load->model('Configuration_model');
		$brochure_array = $this->Configuration_model->get_configuration_by_id('7');
		if (is_file(FCPATH . 'uploads/brochures/charter/' . $brochure_array['configuration_value'])) {
			$charter_brochure_array = $this->Configuration_model->get_configuration_by_id('2');
			if (count($charter_brochure_array) > 0) {
				if ($this->Configuration_model->edit_configuration_by_id('2', array(
							'configuration_value' => $charter_brochure_array['configuration_value'] + 1
						))) {
					$this->load->helper('download');
					$file = file_get_contents(FCPATH . 'uploads/brochures/charter/' . $brochure_array['configuration_value']);
					$name = 'InCrew_charter_brochure.pdf';
					force_download($name, $file);
				}
			}
		}
		redirect('aircraft-charter', 'refresh');
	}

	function charter_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->select("aircraft_charter_id,aircraft_charter_title,aircraft_charter_content,CONCAT('" . base_url() . 'uploads/pages/charter/' . "',DATE_FORMAT(aircraft_charter_created,'%Y/%m/%d/%H/%i/%s/'),aircraft_charter_image) AS image_url,aircraft_charter_status")->from('aircraft_charter');
		echo $this->datatables->generate();
	}

	function list_charter() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		parent::render_view($data, '');
	}

	function charter_image() {
		parent::allow(array('administrator'));
		$this->load->model('Configuration_model');
		$data['charter_image_array'] = $this->Configuration_model->get_configuration_by_id('4');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('charter_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('charter_image'))) {
					$charter_image = $this->input->post('charter_image');
					$upload_image_directory = FCPATH . 'uploads/pages/charter/banner_image';
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $charter_image);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
						$crop_image_y_size = '0';
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
						$crop_image_x_size = '0';
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $charter_image, $upload_image_directory . '/' . $charter_image, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image(FCPATH . 'uploads/' . $charter_image, $upload_image_directory . '/' . $charter_image, 1920, 900)) {
							if ($this->Configuration_model->edit_configuration_by_id('4', array(
										'configuration_value' => $charter_image
									))) {
								unlink(FCPATH . 'uploads/' . $charter_image);
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

	function edit_charter($aircraft_charter_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_charter_array'] = $this->Aircraft_model->get_aircraft_charter_by_id($aircraft_charter_id);
		if (count($data['aircraft_charter_array']) === 0) {
			redirect(base_url() . 'aircraft/list_charter');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_charter_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('aircraft_charter_content', 'Content', 'trim|required|max_length[800]');
			$this->form_validation->set_rules('aircraft_charter_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('aircraft_charter_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/charter' . date('/Y/m/d/H/i/s', strtotime($data['aircraft_charter_array']['aircraft_charter_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					$image_size_array = getimagesize(FCPATH . 'uploads/' . $upload_image);
					$image_x_size = $image_size_array[0];
					$image_y_size = $image_size_array[1];
					$crop_measure = min($image_x_size, $image_y_size);
					if ($image_x_size > $image_y_size) {
						$crop_image_x_size = ($image_x_size - $image_y_size ) / 2;
						$crop_image_y_size = '0';
					} else {
						$crop_image_y_size = ($image_y_size - $image_x_size ) / 2;
						$crop_image_x_size = '0';
					}
					if (parent::crop_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, $crop_measure, $crop_measure, $crop_image_x_size, $crop_image_y_size)) {
						if (parent::resize_image($upload_image_directory . '/' . $upload_image, $upload_image_directory . '/' . $upload_image, 194, 189)) {
							unlink(FCPATH . 'uploads/' . $upload_image);
						}
					}
				}
				if ($this->Aircraft_model->edit_aircraft_charter_by_id($aircraft_charter_id, array(
							'aircraft_charter_title' => $this->input->post('aircraft_charter_title'),
							'aircraft_charter_content' => nl2br($this->input->post('aircraft_charter_content')),
							'aircraft_charter_image' => $upload_image,
							'aircraft_charter_link' => 'aircraft/request_quote/' . strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('aircraft_charter_title')))),
							'aircraft_charter_modified' => date('Y-m-d H:i:s')
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

	function change_charter_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_charter_id', 'Charter ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_charter_status', 'Charter Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_charter_by_id($this->input->post('aircraft_charter_id'), array(
						'aircraft_charter_status' => $this->input->post('aircraft_charter_status') === 'true' ? '1' : '0',
						'aircraft_charter_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function quote_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('charter_aircrafts', 'charter_aircrafts.charter_aircraft_id = aircraft_quotes.charter_aircrafts_id', 'left');
		$this->datatables->join('my_aircrafts', 'my_aircrafts.my_aircraft_id = aircraft_quotes.my_aircrafts_id', 'left');
		$this->datatables->where(array('aircraft_quotes.aircraft_quote_status!=' => '-1'));
		$this->datatables->select("aircraft_quote_id,aircraft_quote_company_name,CONCAT(aircraft_quote_first_name,' ',aircraft_quote_last_name) AS full_name,aircraft_quote_email,aircraft_quote_phone,aircraft_quote_passengers,aircraft_quote_departure_city,aircraft_quote_arrival_city,DATE_FORMAT(aircraft_quote_departure_date,'%d %b %Y') AS departure_date,DATE_FORMAT(aircraft_quote_return_date,'%d %b %Y') AS return_date,aircraft_quote_cargo_size,aircraft_quote_cargo_weight,aircraft_quote_dangerous_good,charter_aircraft_name,my_aircraft_name,aircraft_quote_charter_type,aircraft_quote_requirements,DATE_FORMAT(aircraft_quote_created,'%d %b %Y %h:%i %p') AS aircraft_quote_create,aircraft_quote_status", FALSE)->from('aircraft_quotes');
		echo $this->datatables->generate();
	}

	function quotes() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_quote_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quote_id', 'Quote ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('quote_status', 'Quote Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_quote_by_id($this->input->post('quote_id'), array(
						'aircraft_quote_status' => $this->input->post('quote_status'),
						'aircraft_quote_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function request_quote($charter_type = '') {
		$data = array();
		$this->config->load('email');
		$this->load->library('user_agent');
		if ($this->input->post()) {
			if ($this->agent->referrer() === base_url() . 'aircraft-charter') {
				$data['aircraft_charter_array'] = array(
					'aircraft_passengers' => $this->input->post('aircraft_passengers'),
					'aircraft_departure_city' => $this->input->post('aircraft_departure_city'),
					'aircraft_destination_city' => $this->input->post('aircraft_destination_city'),
					'aircraft_departure_date' => $this->input->post('aircraft_departure_date')
				);
			} else {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('aircraft_quote_first_name', 'First Name', 'trim');
				$this->form_validation->set_rules('aircraft_quote_last_name', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('aircraft_quote_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('aircraft_quote_country_code', 'Country Code', 'trim|required');
				$this->form_validation->set_rules('aircraft_quote_phone', 'Phone No ', 'trim|required|is_numeric');
				$this->form_validation->set_rules('aircraft_quote_departure_city', 'Departure City', 'trim|required');
				$this->form_validation->set_rules('aircraft_quote_arrival_city', 'Arrival City', 'trim|required');
				$this->form_validation->set_rules('aircraft_quote_departure_date', 'Departure Date', 'trim|required');
				if ($this->form_validation->run()) {
					$aircraft_quote_insert_array = array(
						'aircraft_quote_company_name' => $this->input->post('aircraft_quote_company_name'),
						'aircraft_quote_first_name' => $this->input->post('aircraft_quote_first_name'),
						'aircraft_quote_last_name' => $this->input->post('aircraft_quote_last_name'),
						'aircraft_quote_email' => $this->input->post('aircraft_quote_email'),
						'aircraft_quote_phone' => $this->input->post('aircraft_quote_country_code') . '-' . $this->input->post('aircraft_quote_phone'),
						'aircraft_quote_passengers' => $this->input->post('aircraft_quote_passengers'),
						'aircraft_quote_departure_city' => $this->input->post('aircraft_quote_departure_city'),
						'aircraft_quote_arrival_city' => $this->input->post('aircraft_quote_arrival_city'),
						'aircraft_quote_departure_date' => parent::input_date_to_mysql_date($this->input->post('aircraft_quote_departure_date')),
						'aircraft_quote_return_date' => $this->input->post('aircraft_quote_return_date') !== '' ? parent::input_date_to_mysql_date($this->input->post('aircraft_quote_return_date')) : '',
						'charter_aircrafts_id' => $this->input->post('charter_aircrafts_id'),
						'my_aircrafts_id' => $this->input->post('my_aircrafts_id'),
						'aircraft_quote_charter_type' => ucwords(str_replace('-', ' ', $charter_type)),
						'aircraft_quote_cargo_size' => $this->input->post('aircraft_quote_cargo_size') !== null ? $this->input->post('aircraft_quote_cargo_size') : '',
						'aircraft_quote_cargo_weight' => $this->input->post('aircraft_quote_cargo_weight') !== null ? $this->input->post('aircraft_quote_cargo_weight') : '',
						'aircraft_quote_dangerous_good' => $this->input->post('aircraft_quote_dangerous_good'),
						'aircraft_quote_requirements' => nl2br($this->input->post('aircraft_quote_requirements')),
						'aircraft_quote_status' => '1',
						'aircraft_quote_created' => date('Y-m-d H:i:s')
					);
					if ($this->Aircraft_model->add_aircraft_quote($aircraft_quote_insert_array) > 0) {
						$emailid1 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '', 'Request for Get Quote of Aircraft Charter', $this->render_view($aircraft_quote_insert_array, 'emails', 'emails/templates/charter_request/request_quote', TRUE));
						if ($emailid1 > 0) {
							@file_get_contents(base_url() . 'email/cron/' . $emailid1);
						}
						$emailid2 = parent::add_email_to_queue('', '', $this->input->post('aircraft_quote_email'), '', 'Request for Get Quote of Aircraft Charter', $this->render_view($aircraft_quote_insert_array, 'emails', 'emails/templates/charter_request/user', TRUE));
						if ($emailid2 > 0) {
							@file_get_contents(base_url() . 'email/cron/' . $emailid2);
						}
						die('1');
					}
				} else {
					echo validation_errors();
					die;
				}
				die('0');
			}
		}
		if ($this->session->userdata('aircraft_charter_array') !== null) {
			$data['aircraft_charter_array'] = $this->session->userdata('aircraft_charter_array');
			$this->session->unset_userdata('aircraft_charter_array');
		}
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['charter_aircraft_array'] = $this->Aircraft_model->get_charter_aircrafts();
		$data['title'] = 'Charter Request';
		$data['form_title'] = 'Charter';
		if ($charter_type !== '') {
			if (!in_array($charter_type, array('private-charter', 'airline-charter', 'cargo-charter'))) {
				redirect('aircraft-charter', 'refresh');
			}
			$data['form_title'] = ucwords(str_replace('-', ' ', $charter_type));
			$data['title'] = ucwords(str_replace('-', ' ', $charter_type)) . ' Request';
		}
		$this->load->model('Auth_model');
		$data['country_array'] = $this->Auth_model->get_countries();
		parent::render_view($data, 'common');
	}

	function download_dangerous_good_pdf() {
		$this->load->model('Configuration_model');
		$dg_pdf_array = $this->Configuration_model->get_configuration_by_id('13');
		if (is_file(FCPATH . 'uploads/brochures/dangerous_goods_pdf/' . $dg_pdf_array['configuration_value'])) {
			$this->load->helper('download');
			$file = file_get_contents(FCPATH . 'uploads/brochures/dangerous_goods_pdf/' . $dg_pdf_array['configuration_value']);
			$name = 'InCrew_dangerous_good_list.pdf';
			force_download($name, $file);
		}
		redirect('aircraft-charter', 'refresh');
	}

	function dangerous_good_doc() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('13');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('configuration_value', 'Brochure File', 'trim|required');
			if ($this->form_validation->run()) {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('configuration_value'))) {
					$file_upload_directory = FCPATH . 'uploads/brochures/dangerous_goods_pdf';
					if (!is_dir($file_upload_directory)) {
						mkdir($file_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $this->input->post('configuration_value'), $file_upload_directory . '/' . $this->input->post('configuration_value'))) {
						if ($this->Configuration_model->edit_configuration_by_id('13', array(
									'configuration_value' => $this->input->post('configuration_value')
								))) {
							unlink(FCPATH . 'uploads/' . $this->input->post('configuration_value'));
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

	function model_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('models.model_status!=' => '-1'));
		$this->datatables->join('manufacturers', 'manufacturers.manufacturer_id = models.manufacturers_id');
		$this->datatables->select('model_id, model_name, manufacturer_name, model_status', FALSE)->from('models');
		echo $this->datatables->generate();
	}

	function models() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_model_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('model_id', 'Model ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('model_status', 'Model Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_model_by_id($this->input->post('model_id'), array(
						'model_status' => $this->input->post('model_status') === 'true' ? '1' : '0',
						'model_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_model() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Manufacturer_model');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('manufacturers_id', 'Manufacturer', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('model_name', 'Model Name', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Aircraft_model->add_model(array(
							'manufacturers_id' => $this->input->post('manufacturers_id'),
							'model_name' => $this->input->post('model_name'),
							'model_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('model_name')))),
							'model_status' => '1',
							'model_created' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['manufacturer_array'] = $this->Manufacturer_model->get_manufacturers();
		parent::render_view($data, '');
	}

	function edit_model($model_id) {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Manufacturer_model');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('manufacturers_id', 'Manufacturer ID', 'trim|required');
			$this->form_validation->set_rules('model_name', 'Model Name', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Aircraft_model->edit_model_by_id($model_id, array(
							'manufacturers_id' => $this->input->post('manufacturers_id'),
							'model_name' => $this->input->post('model_name'),
							'model_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['model_array'] = $this->Aircraft_model->get_model_by_id($model_id);
		$data['manufacturer_array'] = $this->Manufacturer_model->get_manufacturers();
		parent::render_view($data, '');
	}

	function get_aircraft_by_aircraft_type_id() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_types_id', 'Aircraft Type', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$data = $this->Aircraft_model->get_aircraft_by_aircraft_type_id($this->input->post('aircraft_types_id'));
		} else {
			$data = array();
			die;
		}
		parent::json_output($data);
	}

	function get_models_by_aircraft_id() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('manufacturers_id', 'Manufacturer ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			$model_array = $this->Aircraft_model->get_models_by_manufacturer_id($this->input->post('manufacturers_id'));
		}
		return parent::json_output($model_array);
	}

	function charter_page($cat = 'page_pictures') {
		parent::allow(array('administrator'));
		$data = array();
		if ($cat === 'page_pictures') {
			parent::render_view($data, '', 'aircraft/charter_page_pictures');
		} else {
			parent::render_view($data, '', 'aircraft/charter_page_writings');
		}
	}

	function sales_and_acquisitions() {
		$data = array();
		if ($this->input->post()) {
			$this->load->model('Page_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contact_us_feed_name', 'Contact Name', 'trim|required');
			$this->form_validation->set_rules('contact_us_feed_email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_us_feed_message', 'Message', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->add_contact_us_feeds(array(
							'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
							'contact_us_feed_email' => $this->input->post('contact_us_feed_email'),
							'contact_us_feed_subject' => 'Request for sales and acquisitions',
							'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
							'contact_us_feed_category' => '2',
							'contact_us_feed_ip' => $this->input->server('REMOTE_ADDR'),
							'contact_us_feed_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'contact_us_feed_created' => date('Y-m-d H:i:s')
						))) {
					$email_details_array = array(
						'user_email' => $this->input->post('contact_us_feed_email'),
						'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
						'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
						'request_type' => 'aircraft sales & acquisitions'
					);
					$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], '0', 'Request for sales & acquisitions', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/person', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '0', 'Request for sales & acquisitions', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/admin', TRUE));
					if ($emailid2 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid2);
					}
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['sales_and_acquisition_array'] = $this->Aircraft_model->get_active_sales_and_acquisitions();
		$data['title'] = 'Sales And Acquisition';
		parent::render_view($data, 'common');
	}

	function list_sales_and_acquisitions() {
		parent::allow(array('administrator'));
		$data = array();
		$data['sales_and_acquisition_array'] = $this->Aircraft_model->get_sales_and_acquisitions();
		parent::render_view($data, '');
	}

	function edit_sales_and_acquisitions($sales_and_acquisition_id) {
		parent::allow(array('administrator'));
		$data['sales_and_acquisition_array'] = $this->Aircraft_model->get_sales_and_acquisitions_by_id($sales_and_acquisition_id);
		if (count($data['sales_and_acquisition_array']) === 0) {
			redirect(base_url() . 'aircraft/list_sales_and_acquisitions');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('sales_and_acquisition_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('sales_and_acquisition_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('sales_and_acquisition_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('sales_and_acquisition_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s', strtotime($data['sales_and_acquisition_array']['sales_and_acquisition_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Aircraft_model->edit_sales_and_acquisitions_by_id($sales_and_acquisition_id, array(
							'sales_and_acquisition_title' => $this->input->post('sales_and_acquisition_title'),
							'sales_and_acquisition_content' => nl2br($this->input->post('sales_and_acquisition_content')),
							'sales_and_acquisition_button_text' => $this->input->post('sales_and_acquisition_button_text'),
							'sales_and_acquisition_button_link' => $this->input->post('sales_and_acquisition_button_link'),
							'sales_and_acquisition_image' => $upload_image,
							'sales_and_acquisition_modified' => date('Y-m-d H:i:s')
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

	function add_sales_and_acquisition() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('sales_and_acquisition_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('sales_and_acquisition_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('sales_and_acquisition_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('sales_and_acquisition_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/sales_and_acquisitions' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Aircraft_model->add_sales_and_acquisitions(array(
							'sales_and_acquisition_title' => $this->input->post('sales_and_acquisition_title'),
							'sales_and_acquisition_content' => nl2br($this->input->post('sales_and_acquisition_content')),
							'sales_and_acquisition_button_text' => $this->input->post('sales_and_acquisition_button_text'),
							'sales_and_acquisition_button_link' => $this->input->post('sales_and_acquisition_button_link'),
							'sales_and_acquisition_image' => $upload_image,
							'sales_and_acquisition_status' => '1',
							'sales_and_acquisition_created' => $time_now
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

	function change_sales_and_acquisitions_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sales_and_acquisition_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('sales_and_acquisition_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_sales_and_acquisitions_by_id($this->input->post('sales_and_acquisition_id'), array(
						'sales_and_acquisition_status' => $this->input->post('sales_and_acquisition_status') === 'true' ? '1' : '0',
						'sales_and_acquisition_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function aircraft_management() {
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contact_us_feed_name', 'Contact Name', 'trim|required');
			$this->form_validation->set_rules('contact_us_feed_email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_us_feed_message', 'Message', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->add_contact_us_feeds(array(
							'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
							'contact_us_feed_email' => $this->input->post('contact_us_feed_email'),
							'contact_us_feed_subject' => 'Request for aircraft management',
							'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
							'contact_us_feed_ip' => $this->input->server('REMOTE_ADDR'),
							'contact_us_feed_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'contact_us_feed_created' => date('Y-m-d H:i:s')
						))) {
					$email_details_array = array(
						'user_email' => $this->input->post('contact_us_feed_email'),
						'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
						'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
						'request_type' => 'Aviation Management Service'
					);
					$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], '0', 'Request for Aviation Management', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/person', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '0', 'Request for for Aviation Management', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/admin', TRUE));
					if ($emailid2 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid2);
					}
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['aircraft_management_array'] = $this->Aircraft_model->get_active_aircraft_management();
		$data['title'] = 'Aircraft Management';
		parent::render_view($data, 'common');
	}

	function aircraft_management_brochure() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('10');
		$data['aircraft_management_brochure_array'] = $this->Configuration_model->get_configuration_by_id('11');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('configuration_value', 'Brochure File', 'trim|required');
			if ($this->form_validation->run()) {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('configuration_value'))) {
					$file_upload_directory = FCPATH . 'uploads/brochures/aircraft_management';
					if (!is_dir($file_upload_directory)) {
						mkdir($file_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $this->input->post('configuration_value'), $file_upload_directory . '/' . $this->input->post('configuration_value'))) {
						if ($this->Configuration_model->edit_configuration_by_id('10', array(
									'configuration_value' => $this->input->post('configuration_value')
								))) {
							unlink(FCPATH . 'uploads/' . $this->input->post('configuration_value'));
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

	function download_aircraft_management_brochure() {
		$this->load->model('Configuration_model');
		$brochure_array = $this->Configuration_model->get_configuration_by_id('10');
		if (is_file(FCPATH . 'uploads/brochures/aircraft_management/' . $brochure_array['configuration_value'])) {
			$charter_brochure_array = $this->Configuration_model->get_configuration_by_id('11');
			if (count($charter_brochure_array) > 0) {
				if ($this->Configuration_model->edit_configuration_by_id('11', array(
							'configuration_value' => $charter_brochure_array['configuration_value'] + 1
						))) {
					$this->load->helper('download');
					$file = file_get_contents(FCPATH . 'uploads/brochures/aircraft_management/' . $brochure_array['configuration_value']);
					$name = 'InCrew_aircraft_management_brochure.pdf';
					force_download($name, $file);
				}
			}
		}
		redirect('aircraft-charter', 'refresh');
	}

	function list_aircraft_management() {
		parent::allow(array('administrator'));
		$data = array();
		$data['aircraft_management_array'] = $this->Aircraft_model->get_aircraft_management('1');
		parent::render_view($data, '');
	}

	function add_aircraft_management() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_management_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('aircraft_management_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('aircraft_management_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('aircraft_management_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Aircraft_model->add_aircraft_management(array(
							'aircraft_management_title' => $this->input->post('aircraft_management_title'),
							'aircraft_management_content' => nl2br($this->input->post('aircraft_management_content')),
							'aircraft_management_image' => $upload_image,
							'aircraft_management_status' => '1',
							'aircraft_management_created' => $time_now
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

	function update_aircraft_management_order() {
		parent::allow(array('administrator'));
		foreach ($this->input->post('aircraft_management_id') as $key => $aircraft_management_id)
			$this->Aircraft_model->edit_aircraft_management_by_id($aircraft_management_id, array(
				'aircraft_management_order' => $key + 1,
				'aircraft_management_modified' => date('Y-m-d H:i:s')
			));
		die('1');
	}

	function edit_aircraft_management($aircraft_management_id) {
		parent::allow(array('administrator'));
		$data['aircraft_management_array'] = $this->Aircraft_model->get_aircraft_management_by_id($aircraft_management_id);
		if (count($data['aircraft_management_array']) === 0) {
			redirect(base_url() . 'aircraft/list_aircraft_management');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('aircraft_management_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('aircraft_management_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('aircraft_management_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('aircraft_management_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/aircraft_management' . date('/Y/m/d/H/i/s', strtotime($data['aircraft_management_array']['aircraft_management_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Aircraft_model->edit_aircraft_management_by_id($aircraft_management_id, array(
							'aircraft_management_title' => $this->input->post('aircraft_management_title'),
							'aircraft_management_content' => nl2br($this->input->post('aircraft_management_content')),
							'aircraft_management_image' => $upload_image,
							'aircraft_management_modified' => date('Y-m-d H:i:s')
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

	function change_aircraft_management_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('aircraft_management_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('aircraft_management_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Aircraft_model->edit_aircraft_management_by_id($this->input->post('aircraft_management_id'), array(
						'aircraft_management_status' => $this->input->post('aircraft_management_status') === 'true' ? '1' : '0',
						'aircraft_management_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_spec_char($aircraft_name) {
		return str_replace(" ", "-", preg_replace("/\s+/", " ", str_replace(array('?', ';', '(', ')', '[', ']', '#', '{', '}', '.'), ' ', preg_replace("/[\/\&%#\$]/", " ", preg_replace("/[\"\']/", " ", $aircraft_name)))));
	}

}
