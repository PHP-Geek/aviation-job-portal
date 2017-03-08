<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Configuration_model');
	}

	function license_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('licenses.license_status!=' => '-1'));
		$this->datatables->join('license_types', 'license_types.license_type_id = licenses.license_types_id', 'left');
		$this->datatables->join('job_types', 'job_types.job_type_id = license_types.job_types_id', 'left');
		$this->datatables->select("license_id,license_type_name,job_type_name,license_type,license_status", FALSE)->from('licenses');
		echo $this->datatables->generate();
	}

	function licenses() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Job_model');
		$this->load->model('Configuration_model');
		$data['license_type_array'] = $this->Configuration_model->get_license_types();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function add_license() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		if ($this->input->post()) {
			$this->form_validation->set_rules('license_type', 'License Type', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('license_name', 'License Name', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Configuration_model->add_license(array(
							'license_types_id' => $this->input->post('license_type'),
							'license_type' => $this->input->post('license_name'),
							'license_status' => '1',
							'license_created' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		die('0');
	}

	function add_license_type() {
		parent::allow(array('administrator'));
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('position', 'Select Position', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('license_type_name', 'License Type', 'trim|required');
			if ($this->form_validation->run()) {
				//pr($this->input->post());
				$license_type_insert_array = array(
					'job_types_id' => $this->input->post('position'),
					'license_type_name' => $this->input->post('license_type_name'),
					'license_type_status' => '1',
					'license_type_created' => date('Y-m-d H:i:s')
				);
				if ($this->Configuration_model->add_license_type($license_type_insert_array)) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
		}
		die('0');
	}

	function change_license_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('license_id', 'License ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('license_status', 'License Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_license_by_id($this->input->post('license_id'), array(
						'license_status' => $this->input->post('license_status') === 'true' ? '1' : '0',
						'license_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function location_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('location_status!=' => '-1'));
		$this->datatables->select("location_id,location_name,location_status", FALSE)->from('locations');
		echo $this->datatables->generate();
	}

	function locations() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_location() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_location(array(
						'location_name' => $this->input->post('location_name'),
						'location_status' => '1',
						'location_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_location_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('location_id', 'Location ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('location_status', 'Location Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_location_by_id($this->input->post('location_id'), array(
						'location_status' => $this->input->post('location_status') === 'true' ? '1' : '0',
						'location_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function country_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('country_status!=' => '-1'));
		$this->datatables->select("country_id,country_code,country_name,country_status", FALSE)->from('countries');
		echo $this->datatables->generate();
	}

	function countries() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_country() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_name', 'Country Name', 'trim|required');
		$this->form_validation->set_rules('country_code', 'Country Code', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_country(array(
						'country_code' => '+' . $this->input->post('country_code'),
						'country_name' => $this->input->post('country_name'),
						'country_status' => '1',
						'country_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_country_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Location ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('country_status', 'Country Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_country_by_id($this->input->post('country_id'), array(
						'country_status' => $this->input->post('country_status') === 'true' ? '1' : '0',
						'country_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function get_country_by_id() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country ID', 'trim|required');
		if ($this->form_validation->run()) {
			$data = $this->Configuration_model->get_country_by_id($this->input->post('country_id'));
			return parent::json_output($data);
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function edit_country() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('country_code', 'Country Status', 'trim|required');
		$this->form_validation->set_rules('country_name', 'Country Code', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_country_by_id($this->input->post('country_id'), array(
						'country_code' => $this->input->post('country_code'),
						'country_name' => $this->input->post('country_name'),
						'country_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function employer_category_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('employer_type_status!=' => '-1'));
		$this->datatables->select("employer_type_id,employer_type,employer_type_status", FALSE)->from('employer_types');
		echo $this->datatables->generate();
	}

	function employer_categories() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_employer_category() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('employer_type', 'Employer Type', 'trim|required|is_unique[employer_types.employer_type]');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_employer_type(array(
						'employer_type' => ucwords($this->input->post('employer_type')),
						'employer_type_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('employer_type')))),
						'employer_type_status' => '1',
						'employer_type_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_employer_type_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('employer_type_id', 'Employer Type ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('employer_type_status', 'Employer Type Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_employer_type_by_id($this->input->post('employer_type_id'), array(
						'employer_type_status' => $this->input->post('employer_type_status') === 'true' ? '1' : '0',
						'employer_type_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function position_datatables() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('job_type_status!=' => '-1'));
		$this->datatables->select("job_type_id,job_type_name,job_type_description,job_type_status", FALSE)->from('job_types');
		echo $this->datatables->generate();
	}

	function positions() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_position_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_type_id', 'Position ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('job_type_status', 'Position Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_job_type_by_id($this->input->post('job_type_id'), array(
						'job_type_status' => $this->input->post('job_type_status') === 'true' ? '1' : '0',
						'job_type_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function upload_files() {
		parent::upload_files();
	}

	function add_position() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_type_name', 'Position Name', 'trim|required|is_unique[job_types.job_type_name]');
			$this->form_validation->set_rules('job_type_description', 'Position Description', 'trim|required|max_length[500]');
			$this->form_validation->set_rules('job_type_image', 'Position Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$image_upload_directory = FCPATH . 'uploads/job_types' . date('/Y/m/d/H/i/s', strtotime($time_now));
				$image_file = $this->input->post('job_type_image');
				if (is_file(FCPATH . 'uploads/' . $image_file)) {
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, TRUE);
					}
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
					if (parent::resize_image(FCPATH . 'uploads/' . $image_file, $image_upload_directory . '/' . $image_file, 480, 244)) {
						$job_type_insert_array = array(
							'job_type_name' => ucwords($this->input->post('job_type_name')),
							'job_type_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('job_type_name')))),
							'job_type_description' => nl2br($this->input->post('job_type_description')),
							'job_type_image' => $image_file,
							'job_type_status' => '1',
							'job_type_created' => $time_now
						);
						if ($this->Configuration_model->add_job_type($job_type_insert_array)) {
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

	function edit_position($job_type_id) {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Job_model');
		$data['job_type_array'] = $this->Job_model->get_job_type_by_id($job_type_id);
		if (count($data['job_type_array']) === 0) {
			redirect(base_url() . 'configuration/positions');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_type_name', 'Position Name', 'trim|required|edit_unique[job_types.job_type_name.job_type_id.' . $job_type_id . ']');
			$this->form_validation->set_rules('job_type_description', 'Position Description', 'trim|required|max_length[500]');
			$this->form_validation->set_rules('job_type_image', 'Position Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time = $data['job_type_array']['job_type_created'];
				$image_upload_directory = FCPATH . 'uploads/job_types' . date('/Y/m/d/H/i/s', strtotime($time));
				$image_file = $this->input->post('job_type_image');
				if (is_file(FCPATH . 'uploads/' . $image_file)) {
					if (!is_dir($image_upload_directory)) {
						mkdir($image_upload_directory, 0777, TRUE);
					}
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
					if (parent::resize_image(FCPATH . 'uploads/' . $image_file, $image_upload_directory . '/' . $image_file, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $image_file);
					}
				}
				$job_type_update_array = array(
					'job_type_name' => ucwords($this->input->post('job_type_name')),
					'job_type_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('job_type_name')))),
					'job_type_description' => nl2br($this->input->post('job_type_description')),
					'job_type_image' => $image_file,
					'job_type_modified' => date('Y-m-d H:i:s')
				);
				if ($this->Configuration_model->edit_job_type_by_id($job_type_id, $job_type_update_array)) {
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

	function category_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('position_status !=' => '-1'));
		$this->datatables->join('job_types', 'job_types.job_type_id = positions.job_types_id', 'left');
		$this->datatables->select("position_id,job_type_name,position_name,position_status", FALSE)->from('positions');
		echo $this->datatables->generate();
	}

	function categories() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Job_model');
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function add_category() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_types_id', 'Position', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('position_name', 'Category Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_position(array(
						'job_types_id' => ucwords($this->input->post('job_types_id')),
						'position_name' => ucwords($this->input->post('position_name')),
						'position_status' => '1',
						'position_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_category_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('position_id', 'Position ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('position_status', 'Position Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_position_by_id($this->input->post('position_id'), array(
						'position_status' => $this->input->post('position_status') === 'true' ? '1' : '0',
						'position_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function aircraft_datatables() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'job_types.job_type_id=my_aircrafts.job_types_id', 'left');
		$this->datatables->where(array('my_aircraft_status!=' => '-1'));
		$this->datatables->select("my_aircraft_id,my_aircraft_name,my_aircraft_category,job_type_name,my_aircraft_status", FALSE)->from('my_aircrafts');
		echo $this->datatables->generate();
	}

	function aircrafts() {
		parent::allow(array('administrator'));
		$this->load->model('Job_model');
		$data = array();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function add_aircraft() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('my_aircraft_name', 'Aircraft Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_my_aircraft(array(
						'my_aircraft_name' => ucwords($this->input->post('my_aircraft_name')),
						'job_types_id' => '0',
						'my_aircraft_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('my_aircraft_name')))),
						'my_aircraft_category' => $this->input->post('my_aircraft_category'),
						'my_aircraft_status' => '1',
						'my_aircraft_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
			die('0');
		}
		echo validation_errors();
		die;
	}

	function change_aircraft_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('my_aircraft_id', 'Aircraft ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('my_aircraft_status', 'Aircraft Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_my_aircraft_by_id($this->input->post('my_aircraft_id'), array(
						'my_aircraft_status' => $this->input->post('my_aircraft_status') === 'true' ? '1' : '0',
						'my_aircraft_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function training_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('training_status!=' => '-1'));
		$this->datatables->join('job_types', 'job_types.job_type_id = trainings.job_types_id', 'left');
		$this->datatables->select("training_id,job_type_name,training_name,training_status", FALSE)->from('trainings');
		echo $this->datatables->generate();
	}

	function training() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Job_model');
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function change_training_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('training_id', 'Training ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('training_status', 'Training Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_training_by_id($this->input->post('training_id'), array(
						'training_status' => $this->input->post('training_status') === 'true' ? '1' : '0',
						'training_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_training() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('training_name', 'Training Name', 'trim|required');
		$this->form_validation->set_rules('job_types_id', 'Job Position', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_training(array(
						'training_name' => ucwords($this->input->post('training_name')),
						'training_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('training_slug')))),
						'job_types_id' => $this->input->post('job_types_id'),
						'training_status' => '1',
						'training_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function employee_role_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('employee_role_status!=' => '-1'));
		$this->datatables->join('job_types', 'job_types.job_type_id=employee_roles.job_types_id', 'left');
		$this->datatables->select("employee_role_id,job_type_name,employee_role_name,employee_role_status", FALSE)->from('employee_roles');
		echo $this->datatables->generate();
	}

	function employee_roles() {
		parent::allow(array('administrator'));
		$this->load->model('Job_model');
		$data = array();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function change_employee_role_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('employee_role_id', 'Employee role ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('employee_role_status', 'Employee Role Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_employee_role_by_id($this->input->post('employee_role_id'), array(
						'employee_role_status' => $this->input->post('employee_role_status') === 'true' ? '1' : '0',
						'employee_role_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_employee_role() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_types_id', 'Position', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('employee_role_name', 'User Role/Postion', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_employee_role(array(
						'job_types_id' => ucwords($this->input->post('job_types_id')),
						'employee_role_name' => ucwords($this->input->post('employee_role_name')),
						'employee_role_slug' => strtolower(str_replace(' ', '-', preg_replace('/\s+/', ' ', $this->input->post('employee_role_name')))),
						'employee_role_status' => '1',
						'employee_role_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function type_rating_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('type_ratings.type_rating_status!=' => '-1'));
		$this->datatables->join('job_types', 'job_types.job_type_id=type_ratings.job_types_id', 'left');
		$this->datatables->select("type_rating_id,type_rating_name,job_type_name,type_rating_status", FALSE)->from('type_ratings');
		echo $this->datatables->generate();
	}

	function type_ratings() {
		parent::allow(array('administrator'));
		$this->load->model('Job_model');
		$data = array();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function add_type_rating() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_types_id', 'Position', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('type_rating_name', 'Type Rating Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_type_rating(array(
						'job_types_id' => $this->input->post('job_types_id'),
						'type_rating_name' => ucwords($this->input->post('type_rating_name')),
						'type_rating_status' => '1',
						'type_rating_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function type_rating_change_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type_rating_id', 'Type Rating ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('type_rating_status', 'Type Rating Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_type_rating_by_id($this->input->post('type_rating_id'), array(
						'type_rating_status' => $this->input->post('type_rating_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_configuration() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('configuration_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('configuration_value', 'Value', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_configuration_by_id($this->input->post('configuration_id'), array('configuration_value' => $this->input->post('configuration_value')))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function change_configuration_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('configuration_id', 'Configuration ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('configuration_status', 'Configuration Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_configuration_by_id($this->input->post('configuration_id'), array(
						'configuration_status' => $this->input->post('configuration_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function license_authorities_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('license_authorities.license_authority_status !=' => '-1'));
		$this->datatables->select("license_authority_id,license_authority_name,license_authority_status", FALSE)->from('license_authorities');
		echo $this->datatables->generate();
	}

	function license_authorities() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_license_authorities_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('license_authority_id', 'License Authority ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('license_authority_status', 'License Authority Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_license_authority_by_id($this->input->post('license_authority_id'), array(
						'license_authority_status' => $this->input->post('license_authority_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_license_authorities() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('license_authority_name', 'Medical Examination Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_license_authority(array(
						'license_authority_name' => $this->input->post('license_authority_name'),
						'license_authority_status' => '1',
						'license_authority_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function skill_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('skills.skill_status!=' => '-1'));
		$this->datatables->join('job_types', 'job_types.job_type_id=skills.job_types_id', 'left');
		$this->datatables->select("skill_id,skill_name,job_type_name,skill_status", FALSE)->from('skills');
		echo $this->datatables->generate();
	}

	function skills() {
		parent::allow(array('administrator'));
		$this->load->model('Job_model');
		$data = array();
		$data['job_type_array'] = $this->Job_model->get_all_job_types();
		parent::render_view($data, '');
	}

	function skill_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('skill_id', 'Skill ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('skill_status', 'Skill Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_skill_by_id($this->input->post('skill_id'), array(
						'skill_status' => $this->input->post('skill_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_skill() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_types_id', 'Position', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('skill_name', 'Skill Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_skill(array(
						'job_types_id' => $this->input->post('job_types_id'),
						'skill_name' => ucwords($this->input->post('skill_name')),
						'skill_status' => '1',
						'skill_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function management_experience_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('management_experiences.management_experience_status!=' => '-1'));
		$this->datatables->select("management_experience_id,management_experience_name,management_experience_status", FALSE)->from('management_experiences');
		echo $this->datatables->generate();
	}

	function management_experience() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function management_experience_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('management_experience_id', 'Management Experience ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('management_experience_status', 'Management Experience Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_management_experience_by_id($this->input->post('management_experience_id'), array(
						'management_experience_status' => $this->input->post('management_experience_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_management_experience() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('management_experience_name', 'Management Experience Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_management_experience(array(
						'job_types_id' => '0',
						'management_experience_name' => ucwords($this->input->post('management_experience_name')),
						'management_experience_status' => '1',
						'management_experience_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function approval_rating_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('approval_ratings.approval_rating_status!=' => '-1'));
		$this->datatables->select("approval_rating_id,approval_rating_name,approval_rating_status", FALSE)->from('approval_ratings');
		echo $this->datatables->generate();
	}

	function approval_rating() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function approval_rating_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('approval_rating_id', 'Approval Rating ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('approval_rating_status', 'Approval Rating Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_approval_rating_by_id($this->input->post('approval_rating_id'), array(
						'approval_rating_status' => $this->input->post('approval_rating_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_approval_rating() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('approval_rating_name', 'Approval Rating Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_approval_rating(array(
						'approval_rating_name' => ucwords($this->input->post('approval_rating_name')),
						'approval_rating_status' => '1',
						'approval_rating_created' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function charter_aircraft_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('charter_aircrafts.charter_aircraft_status!=' => '-1'));
		$this->datatables->select("charter_aircraft_id,charter_aircraft_name,charter_aircraft_status", FALSE)->from('charter_aircrafts');
		echo $this->datatables->generate();
	}

	function charter_aircrafts() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function charter_aircraft_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('charter_aircraft_id', 'Aircraft Choice ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('charter_aircraft_status', 'Aircraft Choice Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->edit_charter_aircraft_by_id($this->input->post('charter_aircraft_id'), array(
						'charter_aircraft_status' => $this->input->post('charter_aircraft_status') === 'true' ? '1' : '0'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_charter_aircraft() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('charter_aircraft_name', 'Aircraft Choice Name', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Configuration_model->add_charter_aircraft(array(
						'charter_aircraft_name' => ucwords($this->input->post('charter_aircraft_name')),
						'charter_aircraft_status' => '1',
						'charter_aircraft_created' => date('Y-m-d H:i:s')
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

?>
