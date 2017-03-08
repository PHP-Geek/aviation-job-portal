<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {

	public $crew_support_duration_array = array('1 day', '2 days', '3-5 days', '10-20 days', '1 month', '2 Months', '3 Months', '4 Months', '5-8 Months', '8-12 Months', 'More than 1 Year');
	public $endorsement_array = array('Air Control(AIR)', 'Ground Movement Control (GMC)', 'Tower Control (TWR)', 'Ground Movement Surveillance (GMS)', 'Aerodrome Radar Control (RAD)', 'Precision Approach Radar (PAR)', 'Surveillance Radar Approach (SRA)', 'Terminal Control (TCL)', 'Oceanic Control (OCN)', 'Trainer / Instructor', 'Examiner', 'Unit', 'Other');

	function __construct() {
		parent::__construct();
		$this->load->model('Page_model');
	}

	function captcha_validate() {
		$this->load->library('form_validation');
		if ($this->input->post('user_captcha') !== '') {
			if ($this->input->post('captcha_image_text')) {
				$this->form_validation->set_rules('captcha_image_text', 'Catcha image', 'trim|required|callback_validate_captcha');
			}
			if ($this->form_validation->run()) {
				die('true');
			}
		}
		die('false');
	}

	function index() {
		$data = array();
		$this->load->model('Configuration_model');
		$data['slider_images'] = $this->Page_model->get_active_slider_images();
		$data['page_content_array'] = $this->Page_model->get_page_content_by_id('1');
		$data['home_page_link_array'] = $this->Page_model->home_page_links();
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('5');
		$data['home_page_testimonial_array'] = $this->Page_model->get_active_home_page_testimonials();
		$data['page_blue_box_array'] = $this->Page_model->get_page_blue_boxes_by_blue_box_id('1');
		$data['configuration_testimonial_array'] = $this->Configuration_model->get_configuration_by_id('12');
		$data['title'] = 'InCrew Home';
		parent::render_view($data, 'common');
	}

	function home_page_background_image() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('5');
		if ($this->input->post()) {
			if ($this->input->post('home_background_image') !== '') {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('home_background_image'))) {
					$home_background_image = $this->input->post('home_background_image');
					$upload_image_directory = FCPATH . 'uploads/pages/home/background_image';
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $home_background_image, $upload_image_directory . '/' . $home_background_image, 1370, 645)) {
						if ($this->Configuration_model->edit_configuration_by_id('5', array(
									'configuration_value' => $home_background_image
								))) {
							unlink(FCPATH . 'uploads/' . $home_background_image);
							die('1');
						}
					}
				}
			} else {
				echo 'Please upload new background image';
				die;
			}
			die('0');
		}
		parent::render_view($data, '');
	}

	function accept_cookies() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('success', '', 'trim|required');
		if ($this->form_validation->run()) {
			$_SESSION['cookies_accept'] = '1';
			die('1');
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function home_page_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where('page_contents.page_content_id', '1');
		$this->datatables->select("page_content_id,page_content_title,page_content", FALSE)->from('page_contents');
		echo $this->datatables->generate();
	}

	function list_home_page() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function edit_home_page($page_content_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['page_content_array'] = $this->Page_model->get_page_content_by_id($page_content_id);
		if (count($data['page_content_array']) === 0) {
			redirect(base_url() . 'page/list_home_page', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_content_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_home_page_by_id($page_content_id, array(
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
		parent::render_view($data, '');
	}

	function home_page_testimonial_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where('home_page_testimonial_category', '1');
		$this->datatables->select("home_page_testimonial_id,home_page_testimonial_content,home_page_testimonial_person,CONCAT('" . base_url() . 'uploads/page_testimonials/home_page/' . "',DATE_FORMAT(home_page_testimonial_created,'%Y/%m/%d/%H/%i/%s/'),home_page_testimonial_image) AS image_url,home_page_testimonial_status", FALSE)->from('home_page_testimonials');
		echo $this->datatables->generate();
	}

	function home_page_testimonial() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_home_page_testimonial_status() {
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

	function add_home_page_testimonial() {
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

	function edit_home_page_testimonial($home_page_testimonial_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['home_page_testimonial_array'] = $this->Page_model->get_home_page_testimonial_by_id($home_page_testimonial_id);
		if (count($data['home_page_testimonial_array']) === 0) {
			redirect('page/home_page_testimonial', 'refresh');
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

	function home_page_link_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->select("home_page_link_id,home_page_link_title,home_page_link_content,home_page_link_url", FALSE)->from('home_page_links');
		echo $this->datatables->generate();
	}

	function list_home_page_links() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function edit_home_page_link($home_page_link_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['home_page_link_array'] = $this->Page_model->get_home_page_link_by_id($home_page_link_id);
		if (count($data['home_page_link_array']) === 0) {
			redirect(base_url() . 'page/list_home_page', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('home_page_link_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('home_page_link_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('home_page_link_image', 'Icon Image', 'trim|required');
			$this->form_validation->set_rules('home_page_link_url', 'Link URL', 'trim|required|prep_url');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('home_page_link_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/home/icons' . date('/Y/m/d/H/i/s', strtotime($data['home_page_link_array']['home_page_link_created']));
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
						if (parent::resize_image($upload_image_directory . '/' . $upload_image, $upload_image_directory . '/' . $upload_image, 60, 60)) {
							unlink(FCPATH . 'uploads/' . $upload_image);
						}
					}
				}
				if ($this->Page_model->edit_home_page_link_by_id($home_page_link_id, array(
							'home_page_link_title' => $this->input->post('home_page_link_title'),
							'home_page_link_content' => nl2br($this->input->post('home_page_link_content')),
							'home_page_link_url' => prep_url($this->input->post('home_page_link_url')),
							'home_page_link_image' => $this->input->post('home_page_link_image'),
							'home_page_link_modified' => date('Y-m-d H:i:s')
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

	function slider_images_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->select("slider_image_id,slider_image_title,slider_image_content,CONCAT('" . base_url() . 'uploads/pages/home/slider_images/' . "',DATE_FORMAT(slider_image_created,'%Y/%m/%d/%H/%i/%s/'),slider_image_name) AS image_url,slider_image_link_text,slider_image_link", FALSE)->from('slider_images');
		echo $this->datatables->generate();
	}

	function list_slider_image() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_slider_image() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('slider_image_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('slider_image_content', 'Content On Image', 'trim|required|max_length[350]');
			$this->form_validation->set_rules('slider_image_name', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('slider_image_name');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$time_now = date('Y-m-d H:i:s');
					$upload_image_directory = FCPATH . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 1920, 940)) {
						if ($this->Page_model->add_slider_image(array(
									'slider_image_title' => $this->input->post('slider_image_title'),
									'slider_image_content' => nl2br($this->input->post('slider_image_content')),
									'slider_image_name' => $upload_image,
									'slider_image_status' => '1',
									'slider_image_created' => $time_now
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
			die('0');
		}
		parent::render_view($data, '');
	}

	function edit_slider_image($slider_image_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['slider_image_array'] = $this->Page_model->get_slider_image_by_id($slider_image_id);
		if (count($data['slider_image_array']) === 0) {
			redirect(base_url() . 'page/list_slider_image', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('slider_image_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('slider_image_content', 'Content On Image', 'trim|required|max_length[350]');
			$this->form_validation->set_rules('slider_image_name', 'Image', 'trim|required');
			$this->form_validation->set_rules('slider_image_link_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('slider_image_link', 'Button Text', 'trim|required|prep_url');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('slider_image_name');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/home/slider_images' . date('/Y/m/d/H/i/s', strtotime($data['slider_image_array']['slider_image_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 1920, 940)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_slider_image_by_id($slider_image_id, array(
							'slider_image_title' => $this->input->post('slider_image_title'),
							'slider_image_content' => nl2br($this->input->post('slider_image_content')),
							'slider_image_name' => $upload_image,
							'slider_image_link_text' => $this->input->post('slider_image_link_text'),
							'slider_image_link' => prep_url($this->input->post('slider_image_link')),
							'slider_image_modified' => date('Y-m-d H:i:s')
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

	function contact_office_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->select("contact_office_id,contact_office_name,contact_office_phone,contact_office_email,contact_office_address,contact_office_status", FALSE)->from('contact_offices');
		echo $this->datatables->generate();
	}

	function contact_office() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_contact_office() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_office_name', 'Office Type', 'trim|required');
		$this->form_validation->set_rules('contact_office_phone', 'Office Phone', 'trim|required');
		$this->form_validation->set_rules('contact_office_email', 'Office Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact_office_address', 'Office address', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->add_contact_office(array(
						'contact_office_name' => $this->input->post('contact_office_name'),
						'contact_office_phone' => $this->input->post('contact_office_phone'),
						'contact_office_email' => $this->input->post('contact_office_email'),
						'contact_office_address' => nl2br($this->input->post('contact_office_address')),
						'contact_office_status' => '1',
						'contact_office_created' => date('Y-m-d H:i;s'),
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function edit_contact_office($contact_office_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contact_office_name', 'Office Type', 'trim|required');
			$this->form_validation->set_rules('contact_office_phone', 'Office Phone', 'trim|required');
			$this->form_validation->set_rules('contact_office_email', 'Office Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_office_address', 'Office address', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_contact_office_by_id($contact_office_id, array(
							'contact_office_name' => $this->input->post('contact_office_name'),
							'contact_office_phone' => $this->input->post('contact_office_phone'),
							'contact_office_email' => $this->input->post('contact_office_email'),
							'contact_office_address' => nl2br($this->input->post('contact_office_address')),
							'contact_office_status' => '1',
							'contact_office_created' => date('Y-m-d H:i;s'),
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['contact_office_array'] = $this->Page_model->get_contact_office_by_id($contact_office_id);
		parent::render_view($data, '');
	}

	function change_contact_office_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_office_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('contact_office_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_contact_office_by_id($this->input->post('contact_office_id'), array(
						'contact_office_status' => $this->input->post('contact_office_status') === 'true' ? '1' : '0',
						'contact_office_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function contact_us() {
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contact_us_feed_name', 'Contact Name', 'trim|required');
			$this->form_validation->set_rules('contact_us_feed_email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_us_feed_subject', 'Message Subject', 'trim|required');
			$this->form_validation->set_rules('contact_us_feed_message', 'Message', 'trim|required');
			$this->form_validation->set_rules('captcha_image_text', 'Image Text', 'trim|required|exact_length[6]|numeric|callback_validate_captcha');
			if ($this->form_validation->run()) {
				if ($this->Page_model->add_contact_us_feeds(array(
							'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
							'contact_us_feed_email' => $this->input->post('contact_us_feed_email'),
							'contact_us_feed_subject' => $this->input->post('contact_us_feed_subject') === 'Other' ? $this->input->post('contact_us_feed_subject1') : $this->input->post('contact_us_feed_subject'),
							'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
							'contact_us_feed_ip' => $this->input->server('REMOTE_ADDR'),
							'contact_us_feed_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'contact_us_feed_created' => date('Y-m-d H:i:s')
						))) {
					$email_details_array = array(
						'user_email' => $this->input->post('contact_us_feed_email'),
						'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
						'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
						'request_type' => $this->input->post('contact_us_feed_subject') === 'Other' ? $this->input->post('contact_us_feed_subject1') : $this->input->post('contact_us_feed_subject')
					);
					$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], '0', 'Request for contact', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/person', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '0', 'Request for contact', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/admin', TRUE));
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
		$data['captcha_image'] = parent::create_captcha();
		$data['title'] = 'Contact Us';
		$data['contact_office_array'] = $this->Page_model->get_contact_offices();
		$data['social_media_array'] = $this->Page_model->get_social_media_links();
		$data['page_blue_box_array'] = $this->Page_model->get_page_blue_boxes_by_blue_box_id('2');
		parent::render_view($data, 'common');
	}

	function contact_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('contact_us_feeds.contact_us_feed_status!=' => '-1'));
		$this->datatables->select("contact_us_feed_id,contact_us_feed_name,contact_us_feed_email,contact_us_feed_subject,contact_us_feed_message,DATE_FORMAT(contact_us_feed_created,'%d %M %Y %h:%i %p') AS contact_us_feed_create,contact_us_feed_status", FALSE)->from('contact_us_feeds');
		echo $this->datatables->generate();
	}

	function contact() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function contacts_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('contact_us_feeds.contact_us_feed_status!=' => '-1', 'contact_us_feeds.contact_us_feed_category' => '0'));
		$this->datatables->select("contact_us_feed_id,contact_us_feed_name,contact_us_feed_email,contact_us_feed_subject,contact_us_feed_message,DATE_FORMAT(contact_us_feed_created,'%d %M %Y %h:%i %p') AS contact_us_feed_create,contact_us_feed_status", FALSE)->from('contact_us_feeds');
		echo $this->datatables->generate();
	}

	function contacts() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function entry_into_service_requests_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('contact_us_feeds.contact_us_feed_status!=' => '-1', 'contact_us_feeds.contact_us_feed_category' => '1'));
		$this->datatables->select("contact_us_feed_id,contact_us_feed_name,contact_us_feed_email,contact_us_feed_subject,contact_us_feed_message,DATE_FORMAT(contact_us_feed_created,'%d %M %Y %h:%i %p') AS contact_us_feed_create,contact_us_feed_status", FALSE)->from('contact_us_feeds');
		echo $this->datatables->generate();
	}

	function entry_into_service_requests() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function aircraft_sales_acquisition_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('contact_us_feeds.contact_us_feed_status!=' => '-1', 'contact_us_feeds.contact_us_feed_category' => '2'));
		$this->datatables->select("contact_us_feed_id,contact_us_feed_name,contact_us_feed_email,contact_us_feed_subject,contact_us_feed_message,DATE_FORMAT(contact_us_feed_created,'%d %M %Y %h:%i %p') AS contact_us_feed_create,contact_us_feed_status", FALSE)->from('contact_us_feeds');
		echo $this->datatables->generate();
	}

	function aircraft_sales_acquisition_requests() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_contact_feed_status() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_us_feed_id', 'Contact Feed ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('contact_us_feed_status', 'Contact Feed Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_contact_us_feed_by_id($this->input->post('contact_us_feed_id'), array('contact_us_feed_status' => $this->input->post('contact_us_feed_status')))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function delete_contact_feed() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_us_feed_id', 'Contact Feed ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_contact_us_feed_by_id($this->input->post('contact_us_feed_id'), array(
						'contact_us_feed_status' => '-1'
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function about_us() {
		$data = array();
		$data['about_increw_array'] = $this->Page_model->get_about_increw();
		$data['page_testimonial_array'] = $this->Page_model->get_page_testimonial_by_id('3');
		$data['about_increw_footer_array'] = $this->Page_model->get_active_about_increw_footer();
		$data['title'] = 'About InCrew';
		parent::render_view($data, 'common');
	}

	function about_us_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('about_increw_status!=' => '-1'));
		$this->datatables->select("about_increw_id,about_increw_title,about_increw_content,CONCAT('" . base_url() . 'uploads/pages/about_increw/' . "',DATE_FORMAT(about_increw_created,'%Y/%m/%d/%H/%i/%s/'),about_increw_image) AS image_url,about_increw_status")->from('about_increw');
		echo $this->datatables->generate();
	}

	function upload_files() {
		parent::upload_files();
	}

	function list_about_us() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function edit_about_us($about_increw_id) {
		parent::allow(array('administrator'));
		$data = array();
		$data['about_increw_array'] = $this->Page_model->about_increw_by_id($about_increw_id);
		if (count($data['about_increw_array']) === 0) {
			redirect(base_url() . 'page/list_about_us');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('about_increw_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('about_increw_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('about_increw_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('about_increw_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/about_increw' . date('/Y/m/d/H/i/s', strtotime($data['about_increw_array']['about_increw_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_about_increw_by_id($about_increw_id, array(
							'about_increw_title' => $this->input->post('about_increw_title'),
							'about_increw_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $this->input->post('about_increw_content')),
							'about_increw_image' => $upload_image,
							'about_increw_modified' => date('Y-m-d H:i:s')
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

	function change_about_us_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('about_increw_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('about_increw_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_about_increw_by_id($this->input->post('about_increw_id'), array(
						'about_increw_status' => $this->input->post('about_increw_status') === 'true' ? '1' : '0',
						'about_increw_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function add_about_us() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('about_increw_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('about_increw_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('about_increw_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('about_increw_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/about_increw' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->add_about_increw(array(
							'about_increw_title' => $this->input->post('about_increw_title'),
							'about_increw_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $this->input->post('about_increw_content')),
							'about_increw_image' => $upload_image,
							'about_increw_status' => '1',
							'about_increw_created' => $time_now
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

	function about_increw_footer_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('about_increw_footer_status!=' => '-1'));
		$this->datatables->select("about_increw_footer_id,about_increw_footer_title,about_increw_footer_content,about_increw_footer_link,about_increw_footer_status")->from('about_increw_footer');
		echo $this->datatables->generate();
	}

	function list_about_us_footer() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_about_us_footer_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('about_increw_footer_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('about_increw_footer_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_about_increw_footer_by_id($this->input->post('about_increw_footer_id'), array(
						'about_increw_footer_status' => $this->input->post('about_increw_footer_status') === 'true' ? '1' : '0',
						'about_increw_footer_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function edit_about_us_footer($about_increw_footer_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['about_increw_footer_array'] = $this->Page_model->get_about_increw_footer_by_id($about_increw_footer_id);
		if (count($data['about_increw_footer_array']) === 0) {
			redirect(base_url() . 'page/list_about_us_footer');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('about_increw_footer_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('about_increw_footer_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_about_increw_footer_by_id($about_increw_footer_id, array(
							'about_increw_footer_title' => $this->input->post('about_increw_footer_title'),
							'about_increw_footer_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $this->input->post('about_increw_footer_content')),
							'about_increw_footer_link' => $this->input->post('about_increw_footer_link'),
							'about_increw_footer_modified' => date('Y-m-d H:i:s')
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

	function add_about_us_footer() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('about_increw_footer_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('about_increw_footer_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->add_about_increw_footer(array(
							'about_increw_footer_title' => $this->input->post('about_increw_footer_title'),
							'about_increw_footer_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $this->input->post('about_increw_footer_content')),
							'about_increw_footer_link' => $this->input->post('about_increw_footer_link'),
							'about_increw_footer_status' => '1',
							'about_increw_footer_created' => date('Y-m-d H:i:s')
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

	function our_services() {
		$data = array();
		$data['increw_service_array'] = $this->Page_model->get_active_increw_services();
		$meta_desc = parent::get_page_meta_keywords_by_url('our-services');
		$data['meta_keywords'] = $meta_desc['page_keyword'];
		$data['meta_description'] = $meta_desc['page_description'];
		$data['title'] = $meta_desc['page_title'];
		parent::render_view($data, 'common');
	}

	function list_our_services() {
		parent::allow(array('administrator'));
		$data = array();
		$data['increw_services_array'] = $this->Page_model->get_increw_services('1');
		parent::render_view($data, '');
	}

	function update_our_service_order() {
		parent::allow(array('administrator'));
		foreach ($this->input->post('increw_service_id') as $key => $increw_service_id)
			$this->Page_model->edit_increw_service_by_id($increw_service_id, array(
				'increw_service_order' => $key + 1,
				'increw_service_modified' => date('Y-m-d H:i:s')
			));
		die('1');
	}

	function edit_our_service($increw_service_id) {
		parent::allow(array('administrator'));
		$data['increw_service_array'] = $this->Page_model->get_increw_service_by_id($increw_service_id);
		if (count($data['increw_service_array']) === 0) {
			redirect(base_url() . 'page/list_our_services');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('increw_service_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('increw_service_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('increw_service_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('increw_service_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/increw_services' . date('/Y/m/d/H/i/s', strtotime($data['increw_service_array']['increw_service_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 535, 124)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_increw_service_by_id($increw_service_id, array(
							'increw_service_title' => $this->input->post('increw_service_title'),
							'increw_service_content' => nl2br($this->input->post('increw_service_content')),
							'increw_service_image' => $upload_image,
							'increw_service_modified' => date('Y-m-d H:i:s')
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

	function change_increw_service_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('increw_service_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('increw_service_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_increw_service_by_id($this->input->post('increw_service_id'), array(
						'increw_service_status' => $this->input->post('increw_service_status') === 'true' ? '1' : '0',
						'increw_service_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function user_login_apply_job() {
		$data = array();
		parent::render_view($data, 'common');
	}

	function entry_into_service() {
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
							'contact_us_feed_subject' => 'Request for entry into service',
							'contact_us_feed_category' => '1',
							'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
							'contact_us_feed_ip' => $this->input->server('REMOTE_ADDR'),
							'contact_us_feed_user_agent' => $this->input->server('HTTP_USER_AGENT'),
							'contact_us_feed_created' => date('Y-m-d H:i:s')
						))) {
					$email_details_array = array(
						'user_email' => $this->input->post('contact_us_feed_email'),
						'contact_us_feed_name' => $this->input->post('contact_us_feed_name'),
						'contact_us_feed_message' => $this->input->post('contact_us_feed_message'),
						'request_type' => 'entry into service'
					);
					$emailid1 = parent::add_email_to_queue('', '', $email_details_array['user_email'], '0', 'Request for entry into service', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/person', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent::add_email_to_queue('', '', $this->config->item('email_from'), '0', 'Request for entry into service', $this->render_view($email_details_array, 'emails', 'emails/templates/entry_into_service/admin', TRUE));
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
		$data['entry_into_service_array'] = $this->Page_model->get_entry_into_services();
		$data['title'] = 'Entry Into Services';
		parent::render_view($data, 'common');
	}

	function entry_into_service_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('entry_into_service_status!=' => '-1'));
		$this->datatables->select("entry_into_service_id,entry_into_service_title,entry_into_service_content,CONCAT('" . base_url() . 'uploads/pages/entry_into_services/' . "',DATE_FORMAT(entry_into_service_created,'%Y/%m/%d/%H/%i/%s/'),entry_into_service_image) AS image_url,entry_into_service_status")->from('entry_into_services');
		echo $this->datatables->generate();
	}

	function list_entry_into_service() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function add_entry_into_service() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('entry_into_service_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('entry_into_service_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('entry_into_service_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('entry_into_service_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/entry_into_services' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->add_entry_into_service(array(
							'entry_into_service_title' => $this->input->post('entry_into_service_title'),
							'entry_into_service_content' => nl2br($this->input->post('entry_into_service_content')),
							'entry_into_service_image' => $upload_image,
							'entry_into_service_status' => '1',
							'entry_into_service_created' => $time_now
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

	function edit_entry_into_service($entry_into_service_id) {
		parent::allow(array('administrator'));
		$data['entry_into_service_array'] = $this->Page_model->get_entry_into_service_by_id($entry_into_service_id);
		if (count($data['entry_into_service_array']) === 0) {
			redirect(base_url() . 'page/list_entry_into_service');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('entry_into_service_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('entry_into_service_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('entry_into_service_image', 'Title', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('entry_into_service_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/entry_into_services' . date('/Y/m/d/H/i/s', strtotime($data['entry_into_service_array']['entry_into_service_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 584, 327)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_entry_into_service_by_id($entry_into_service_id, array(
							'entry_into_service_title' => $this->input->post('entry_into_service_title'),
							'entry_into_service_content' => nl2br($this->input->post('entry_into_service_content')),
							'entry_into_service_image' => $upload_image,
							'entry_into_service_modified' => date('Y-m-d H:i:s')
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

	function change_entry_into_service_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('entry_into_service_id', 'ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('entry_into_service_status', 'Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_entry_into_service_by_id($this->input->post('entry_into_service_id'), array(
						'entry_into_service_status' => $this->input->post('entry_into_service_status') === 'true' ? '1' : '0',
						'entry_into_service_modified' => date('Y-m-d H:i:s')
					))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function crew_request_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'job_types.job_type_id=crew_support.job_types_id', 'left');
		$this->datatables->join('licenses', 'licenses.license_id=crew_support.licenses_id', 'left');
		$this->datatables->join('positions', 'positions.position_id=crew_support.positions_id', 'left');
		$this->datatables->join('license_authorities', 'license_authorities.license_authority_id=crew_support.license_authorities_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=crew_support.countries_id', 'left');
		$this->datatables->join('approval_ratings', 'approval_ratings.approval_rating_id = crew_support.approval_ratings_id', 'left');
		$this->datatables->join('skills', 'skills.skill_id = crew_support.skills_id', 'left');
		$this->datatables->join('crew_support_aircrafts', 'crew_support.crew_support_id = crew_support_aircrafts.crew_supports_id', 'left');
		$this->datatables->join('my_aircrafts', 'crew_support_aircrafts.my_aircrafts_id = my_aircrafts.my_aircraft_id', 'left');
		$this->datatables->select("crew_support_id,IF(crew_support.job_types_id != '0',job_type_name,crew_support_job_type) as job_type,IF(positions_id != '0',position_name,crew_support_job_category1) as job_position,crew_support_duration,IF(crew_support_duration_is_extendable='1','Yes','No') AS extendable_duration,DATE_FORMAT(crew_support_start_date,'%d %b %Y') AS crew_support_start_date,DATE_FORMAT(crew_support_completion_date,'%d %b %Y') AS crew_support_completion_date,crew_support_no_of_crew,country_name,crew_support_city,IF(license_authorities_id=0,crew_support_license_authority_other,license_authority_name) AS license_authority,IF(approval_ratings_id = 0,crew_support_approval_rating_other,approval_rating_name) AS approval_rating,IF(licenses_id = 0,crew_support_license_type_other,license_type) AS license_type,GROUP_CONCAT(IF(my_aircrafts_id = '0',crew_support_aircraft_type_other,CONCAT(my_aircraft_category,' ',my_aircraft_name)) SEPARATOR ', ') AS aircraft_types,IF(crew_support_type_rated = '1','Type Rated','Non Type Rated') AS aircraft_type_rated,IF(skills_id!='0',skill_name,crew_support_skills),crew_support_year_of_experience,crew_support_endorsement,crew_support_company,crew_support_name,CONCAT(crew_support_country_code,'-',crew_support_contact_number),crew_support_email,crew_support_additional_request,DATE_FORMAT(crew_support_created,'%d %b %Y %h:%i %p') AS date_created,crew_support_status", FALSE)->group_by('crew_support_id')->from('crew_support');
		echo $this->datatables->generate();
	}

	function crew_requests() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_crew_status() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('crew_support_id', 'Crew Support ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('crew_support_status', 'Crew Notes', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_crew_support_by_id($this->input->post('crew_support_id'), array(
						'crew_support_status' => $this->input->post('crew_support_status'),
						'crew_support_modified' => date('Y-m-d H:i:s')
					)) && $this->crew_request_log($this->input->post('crew_support_id'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function crew_request_form($job_type_slug = '') {
		$data = array();
		$this->load->model('Job_model');
		$this->load->model('Auth_model');
		$this->load->model('User_model');
		$this->load->model('Aircraft_model');
		$this->config->load('email');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_types_id', 'Type', 'trim|required');
			$this->form_validation->set_rules('crew_support_duration', 'Duration', 'trim|required');
			$this->form_validation->set_rules('countries_id', 'Location', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('crew_support_city', 'City', 'trim|required');
			$this->form_validation->set_rules('crew_support_company', 'Position', 'trim');
			$this->form_validation->set_rules('crew_support_name', 'Contact Name', 'trim|required');
			$this->form_validation->set_rules('crew_support_contact_number', 'Contact Number', 'trim|required|is_numeric');
			$this->form_validation->set_rules('crew_support_email', 'Contact Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('captcha_image_text', 'Captcha Image', 'trim|required|exact_length[6]|callback_validate_captcha');
			if ($this->form_validation->run()) {
				$crew_support_insert_array = array(
					'job_types_id' => $this->input->post('job_types_id'),
					'crew_support_job_type' => $this->input->post('crew_support_job_type'),
					'positions_id' => $this->input->post('positions_id'),
					'crew_support_job_category1' => $this->input->post('crew_support_job_category1') != null ? $this->input->post('crew_support_job_category1') : '',
					'crew_support_no_of_crew' => $this->input->post('crew_support_is_more_staff') !== null ? $this->input->post('crew_support_no_of_crew') : '1',
					'crew_support_duration' => $this->input->post('crew_support_duration') === 'other' ? $this->input->post('crew_support_other_duration') : $this->input->post('crew_support_duration'),
					'crew_support_duration_is_extendable' => $this->input->post('crew_support_duration_is_extendable') != NULL ? $this->input->post('crew_support_duration_is_extendable') : '',
					'crew_support_start_date' => $this->input->post('crew_support_start_date') !== '' ? parent::input_date_to_mysql_date($this->input->post('crew_support_start_date')) : '',
					'crew_support_completion_date' => $this->input->post('crew_support_completion_date') !== '' ? parent::input_date_to_mysql_date($this->input->post('crew_support_completion_date')) : '',
					'countries_id' => $this->input->post('countries_id'),
					'crew_support_city' => $this->input->post('crew_support_city'),
					'licenses_id' => $this->input->post('licenses_id') !== null ? $this->input->post('licenses_id') : 0,
					'crew_support_license_type_other' => $this->input->post('licenses_id') === '0' ? $this->input->post('crew_support_license_type_other') : '',
					'crew_support_type_rated' => $this->input->post('crew_support_type_rated'),
					'license_authorities_id' => $this->input->post('license_authorities_id'),
					'crew_support_license_authority_other' => $this->input->post('license_authorities_id') === '0' ? $this->input->post('crew_support_license_authority_other') : '',
					'approval_ratings_id' => $this->input->post('approval_ratings_id'),
					'crew_support_approval_rating_other' => $this->input->post('approval_ratings_id') === '0' ? $this->input->post('crew_support_approval_rating_other') : '',
					'crew_support_year_of_experience' => $this->input->post('crew_support_year_of_experience'),
					'crew_support_endorsement' => $this->input->post('crew_support_endorsement') != 'Other' ? $this->input->post('crew_support_endorsement') : $this->input->post('crew_support_endorsement1'),
					'skills_id' => $this->input->post('skills_id') != 'Other' ? $this->input->post('skills_id') : '0',
					'crew_support_skills' => $this->input->post('crew_support_skills'),
					'crew_support_company' => $this->input->post('crew_support_company'),
					'crew_support_name' => $this->input->post('crew_support_name'),
					'crew_support_country_code' => $this->input->post('crew_support_country_code'),
					'crew_support_contact_number' => $this->input->post('crew_support_contact_number'),
					'crew_support_email' => $this->input->post('crew_support_email'),
					'crew_support_additional_request' => $this->input->post('crew_support_additional_request'),
					'crew_support_created' => date('Y-m-d H:i:s')
				);
				$crew_support_id = $this->Page_model->add_crew_support($crew_support_insert_array);
				if ($crew_support_id > 0) {
					if (count($this->input->post('my_aircrafts_id')) > 0) {
						foreach ($this->input->post('my_aircrafts_id') as $my_aircraft) {
							$this->Page_model->add_crew_support_aircraft(array(
								'crew_supports_id' => $crew_support_id,
								'my_aircrafts_id' => $my_aircraft,
								'crew_support_aircraft_type_other' => $my_aircraft === '0' ? $this->input->post('crew_support_aircraft_type_other') : ''
							));
						}
					}
					$crew_support_insert_array ['job_type_name'] = $this->Job_model->get_job_type_by_id($this->input->post('job_types_id'))['job_type_name'];
					$emailid1 = parent:: add_email_to_queue('', '0', $this->input->post('crew_support_email'), '', 'Request for Get Crew Request', $this->render_view($crew_support_insert_array, 'emails', 'emails/templates/crew_request/user', TRUE));
					if ($emailid1 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid1);
					}
					$emailid2 = parent:: add_email_to_queue('', '', $this->config->item('email_from'), '', 'Request for Get Crew Request', $this->render_view($crew_support_insert_array, 'emails', 'emails/templates/crew_request/admin', TRUE));
					if ($emailid2 > 0) {
						@file_get_contents(base_url() . 'email/cron/' . $emailid2);
					}
					die('1');
				} else {
					die('Unsuccess');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['crew_support_duration_array'] = $this->crew_support_duration_array;
		$data['job_types_array'] = $this->Job_model->get_active_job_types();
		$data['type_rating_array'] = $this->User_model->get_approval_ratings();
		$this->User_model->get_active_type_ratings();
		$data['my_aircraft_array'] = $this->Aircraft_model->get_my_aircrafts();
		$data['captcha_image'] = parent::create_captcha();
		$data['country_array'] = $this->Auth_model->get_countries();
		$data['crew_support_job_type_array'] = $this->Job_model->get_job_type_by_slug($job_type_slug);
		$data['crew_support_license_authority_array'] = $this->User_model->get_active_license_authorities();
		$data['license_array'] = $this->User_model->get_licenses_by_job_type_id($data['crew_support_job_type_array']['job_type_id']);
		$data['endorsement_array'] = $this->endorsement_array;
		parent::render_view($data, 'common');
	}

	function get_license_by_job_types_id() {
		$this->load->library('form_validation');
		$this->load->model('User_model');
		$this->form_validation->set_rules('job_types_id', 'Job Type ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			parent::json_output($this->User_model->get_licenses_by_job_type_id($this->input->post('job_types_id')));
			return;
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function get_all_job_types() {
		$this->load->model('Job_model');
		parent::json_output($this->Job_model->get_active_job_types());
	}

	function get_positions_by_job_types_id() {
		$this->load->library('form_validation');
		$this->load->model('User_model');
		$this->form_validation->set_rules('job_types_id', 'Job Type ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->input->post('job_types_id') === '5' || $this->input->post('6')) {
				$job_types_id = '5';
			} else {
				$job_types_id = $this->input->post('job_types_id');
			}
			parent::json_output($this->User_model->get_positions_by_job_type_id($job_types_id));
			return;
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function get_skills_by_job_type_id() {
		$this->load->library('form_validation');
		$this->load->model('Job_model');
		$this->form_validation->set_rules('job_types_id');
		$this->form_validation->set_rules('job_types_id', 'Job Type ID', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run()) {
			if ($this->input->post('job_types_id') == '5' || $this->input->post('job_types_id') == '6') {
				$job_types_id = '5';
			} else {
				$job_types_id = $this->input->post('job_types_id');
			}
			$skill_array = $this->Job_model->get_skills_by_job_type_id($job_types_id);
		} else {
			echo validation_errors();
			die;
		}
		parent::json_output($skill_array);
	}

	private function crew_request_log($crew_support_id) {
		$crew_support_array = $this->Page_model->get_crew_support_by_id($crew_support_id);
		$crew_support_insert_array = array(
			'crew_support_id' => $crew_support_id,
			'job_types_id' => $crew_support_array['job_types_id'],
			'crew_support_history_job_type' => $crew_support_array['crew_support_job_type'],
			'crew_support_history_duration' => $crew_support_array['crew_support_duration'],
			'crew_support_history_start_date' => $crew_support_array['crew_support_start_date'],
			'crew_support_history_completion_date' => $crew_support_array['crew_support_completion_date'],
			'countries_id' => $crew_support_array['countries_id'],
			'licenses_id' => $crew_support_array ['licenses_id'],
			'crew_support_history_company' => $crew_support_array['crew_support_company'],
			'crew_support_history_name' => $crew_support_array['crew_support_name'],
			'crew_support_history_country_code' => $crew_support_array['crew_support_country_code'],
			'crew_support_history_contact_number' => $crew_support_array['crew_support_contact_number'],
			'crew_support_history_email' => $crew_support_array['crew_support_email'],
			'crew_support_history_status' => $this->input->post(
					'crew_support_status'),
			'crew_support_history_modified' => date('Y-m-d H:i:s')
		);
		if ($this->Page_model->add_crew_support_log($crew_support_insert_array) > 0) {
			die('1');
		}
		die;
	}

	function crew_history_datatable($crew_support_id = '') {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->join('job_types', 'job_types.job_type_id=crew_support_history.job_types_id', 'left');
		$this->datatables->join('licenses', 'licenses.license_id=crew_support_history.licenses_id', 'left');
		$this->datatables->join('countries', 'countries.country_id=crew_support_history.countries_id', 'left');
		if ($crew_support_id !== '') {
			$this->datatables->where('crew_support_history.crew_support_id', $crew_support_id);
		}
		$this->datatables->select("crew_support_history_id,IF(job_types_id != '0',job_type_name,crew_support_history_job_type) AS job_type,crew_support_history_duration,DATE_FORMAT(crew_support_history_start_date,'%d %b %Y') AS start_date,DATE_FORMAT(crew_support_history_completion_date,'%d %b %Y') AS end_date,country_name,license_type,crew_support_history_company,crew_support_history_name,CONCAT(crew_support_history_country_code,'-',crew_support_history_contact_number),crew_support_history_email,crew_support_history_status,DATE_FORMAT(crew_support_history_modified,'%d %b %Y %h:%i %p') AS modified_date", FALSE)->from('crew_support_history');
		echo $this->datatables->generate();
	}

	function crew_history($crew_support_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['crew_support_id'] = $crew_support_id;
		parent::render_view($data, '');
	}

	function contract_crew_request() {
		$data = array();
		$data['contract_crew_support_array'] = $this->Page_model->get_active_contract_crew_supports();
		$data['title'] = 'Crew Request';
		parent::render_view($data, 'common');
	}

	function page_not_found() {
		$data = array();
		$data['title'] = '404 Page Not Found';
		parent::render_view(
				$data, 'common', 'page/page_not_found');
	}

	function staff_recruitment() {
		$data = array();
		$data['title'] = 'Staff Recruitment';
		$data['staff_recruitment_array'] = $this->Page_model->get_active_staff_recruitement();
		parent::render_view($data, 'common');
	}

	function invite_colleague() {
		parent::allow(array('employee'));
		$data = array();
		if ($this->input->post()) {
			if (count($this->input->post('invite_colleague_recipient')) > 0) {
				$email_array = array();
				foreach ($this->input->post('invite_colleague_recipient') as $recipient) {
					if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
						echo 'Email must be valid !';
						die;
					}
				}
				foreach ($this->input->post('invite_colleague_recipient') as $recipient) {
					$email_details_array = array(
						'users_id' => $_SESSION['user']['user_id'],
						'invitation_email' => $recipient,
						'invitation_email_subject' => 'Invitation to join InCrew',
						'invitation_email_status' => '1',
						'invitation_email_created' => date('Y-m-d H:i:s')
					);
					$email_insert_id = $this->Page_model->add_invitation_email($email_details_array);
					if ($email_insert_id > 0) {
						$emailid = parent::add_email_to_queue('', '', $recipient, '0', 'Invitation to join InCrew', $this->render_view($email_details_array, 'emails', 'emails/templates/invitation_email', TRUE));
						if ($emailid > 0) {
							@file_get_contents(base_url() . 'email/cron/' . $emailid);
						}
					}
				}
				die('1');
			} else {
				echo 'Please fill email of your colleague!';
				die;
			}
			die('0');
		}
		$data['title'] = 'Invite Collegue';
		parent::render_view($data, 'common');
	}

	function about_increw_testimonial() {
		parent::allow(array('administrator'));
		$data = array();
		$data['page_testimonial_array'] = $this->Page_model->get_page_testimonial_by_id('3');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_testimonial_content', 'Testimonial Content', 'trim|required');
			$this->form_validation->set_rules('page_testimonial_person', 'Person Name', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_page_testimonial_by_id('3', array(
							'page_testimonial_content' => $this->input->post('page_testimonial_content'),
							'page_testimonial_person' => $this->input->post('page_testimonial_person'),
							'page_testimonial_modified'
							=> date('Y-m-d H:i:s')
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

	function refresh_captcha() {
		echo parent::create_captcha();
	}

	function social_media_setup() {
		parent::allow(array('administrator'));
		$data = array();
		$data['social_media_link_array'] = $this->Page_model->get_social_media_links();
		if ($this->input->post()) {
			if (count($this->input->post('social_media_link_id')) > 0) {
				for ($i = 0; $i < count($this->input->post('social_media_link_id')); $i++) {
					$social_links_array = array();
					$social_links_array = array('social_media_link_url' => $this->input->post('social_media_link_url')[$i]);
					$social_links_array['social_media_link_title'] = $this->input->post('social_media_link_title')[$i];
					if (in_array($i, array('1'))) {
						$social_links_array['social_media_link_url1'] = $this->input->post('social_media_link_url1')[0];
						$social_links_array['social_media_link_title1'] = $this->input->post('social_media_link_title1')[0];
						$social_links_array['social_media_link_url2'] = $this->input->post('social_media_link_url2')[0];
						$social_links_array['social_media_link_title2'] = $this->input->post('social_media_link_title2')[0];
					}
					array_merge($social_links_array, array('social_media_link_modified' => date('Y-m-d H:i:s')
					));
					$this->Page_model->edit_social_media_link_by_id($this->input->post('social_media_link_id')[$i], $social_links_array);
				}
				die('1');
			} else {
				die('-1');
			}
			die('0');
		}
		parent::render_view($data, '');
	}

	function entry_into_service_brochure() {
		parent::allow(array('administrator'));
		$data = array();
		$this->load->model('Configuration_model');
		$data['configuration_array'] = $this->Configuration_model->get_configuration_by_id('8');
		$data['entry_into_service_brochure_array'] = $this->Configuration_model->get_configuration_by_id('9');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('configuration_value', 'Brochure File', 'trim|required');
			if ($this->form_validation->run()) {
				if (is_file(FCPATH . 'uploads/' . $this->input->post('configuration_value'))) {
					$file_upload_directory = FCPATH . 'uploads/brochures/entry_into_service';
					if (!is_dir($file_upload_directory)) {
						mkdir($file_upload_directory, 0777, TRUE);
					}
					if (copy(FCPATH . 'uploads/' . $this->input->post('configuration_value'), $file_upload_directory . '/' . $this->input->post('configuration_value'))) {
						if ($this->Configuration_model->edit_configuration_by_id('8', array(
									'configuration_value' => $this->input->post('configuration_value')
								))) {
							unlink(FCPATH . 'uploads/' . $this->input->
											post('configuration_value'));
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

	function download_entry_into_service_brochure() {
		$this->load->model('Configuration_model');
		$brochure_array = $this->Configuration_model->get_configuration_by_id('8');
		if (is_file(FCPATH . 'uploads/brochures/entry_into_service/' . $brochure_array ['configuration_value'])) {
			$entry_into_service_brochure_array = $this->Configuration_model->get_configuration_by_id('9');
			if (count($entry_into_service_brochure_array) > 0) {
				if ($this->Configuration_model->edit_configuration_by_id('9', array(
							'configuration_value' => $entry_into_service_brochure_array ['configuration_value'] + 1
						))) {
					$this->load->helper('download');
					$file = file_get_contents(FCPATH . 'uploads/brochures/entry_into_service/' . $brochure_array[
							'configuration_value']);
					$name = 'InCrew_entry_into_service_brochure.pdf';
					force_download($name, $file);
				}
			}
		}
		redirect('aircraft-charter', 'refresh');
	}

	function page_banner_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('page_banner_status!=' => '-1'));
		$this->datatables->select("page_banner_id,page_banner_title,page_banner_content,CONCAT('" . base_url() .
				'uploads/pages/banner_images/' . "',DATE_FORMAT(page_banner_created,'%Y/%m/%d/%H/%i/%s/'),page_banner_image) AS image_url")->from('page_banners');
		echo $this->datatables->generate();
	}

	function page_banner() {
		parent::allow(array('administrator'));
		$data = array(
		);
		parent::render_view($data, '');
	}

	function edit_page_banner($page_banner_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['page_banner_array'] = $this->Page_model->get_page_banner_by_id($page_banner_id);
		if (count($data['page_banner_array']) === 0) {
			redirect(base_url() . 'page/page_banner');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_banner_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('page_banner_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('page_banner_image', 'Image', 'trim|required');
			if ($this->form_validation->run()) {
				$banner_image = $this->input->post('page_banner_image');
				if (is_file(FCPATH . 'uploads/' . $banner_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/banner_images' . date('/Y/m/d/H/i/s', strtotime($data['page_banner_array'] ['page_banner_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $banner_image, $upload_image_directory . '/' . $banner_image, 1920, 360)) {
						unlink(FCPATH . 'uploads/' . $banner_image);
					}
				}
				if ($this->Page_model->edit_page_banner_by_id($page_banner_id, array(
							'page_banner_title' => $this->input->post('page_banner_title'),
							'page_banner_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $this->input->post('page_banner_content')),
							'page_banner_image' => $banner_image,
							'page_banner_modified' => date('Y-m-d H:i:s')
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

	function edit_page_blue_box($page_blue_box_id) {
		parent::allow(array('administrator'));
		$data = array();
		$data ['page_blue_box_array'] = $this->Page_model->get_page_blue_boxes_by_blue_box_id($page_blue_box_id);
		if (count($data['page_blue_box_array']) === 0) {
			redirect(base_url() . 'page/page_blue_box', 'refresh');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_blue_box_title', 'Title', 'trim');
			$this->form_validation->set_rules('page_blue_box_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('page_blue_box_button_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('page_blue_box_button_link', 'Button Link', 'trim|required|prep_url');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_page_blue_boxes_by_blue_box_id($page_blue_box_id, array(
							'page_blue_box_title' => $this->input->post('page_blue_box_title'),
							'page_blue_box_content' => nl2br(str_replace('<p></p>', '', $this->input->post('page_blue_box_content'))),
							'page_blue_box_button_text' => $this->input->post('page_blue_box_button_text'),
							'page_blue_box_button_link' => prep_url($this->input->post('page_blue_box_button_link')),
							'page_blue_box_modified' => date('Y-m-d H:i:s')
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

	function page_blue_box_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->select("page_blue_box_id,page_blue_box_page,page_blue_box_title,page_blue_box_content,page_blue_box_button_text,page_blue_box_button_link", FALSE)->from('page_blue_boxes');
		echo $this->datatables->generate();
	}

	function page_blue_box() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function privacy_policy() {
		$data = array();
		$data['title'] = 'Privacy Policy';
		$data['privacy_policy_array'] = $this->Page_model->get_page_by_id('1');
		parent::render_view($data, 'common');
	}

	function privacy_policy_setup() {
		parent::allow(array('administrator'));
		$data = array();
		$data['privacy_policy_array'] = $this->Page_model->get_page_by_id('1');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_page_by_id('1', array(
							'page_content' => $this->input->post('page_content'),
							'page_modified' => date('Y-m-d H:i:s')
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

	function employee_terms_and_conditions() {
		$data = array();
		$data['terms_array'] = $this->Page_model->get_page_by_id('2');
		$data['title'] = 'InCrew Terms & Conditins';
		parent::render_view($data, 'common');
	}

	function employer_terms_and_conditions() {
		$data = array();
		$data['terms_array'] = $this->Page_model->get_page_by_id('3');
		$data['title'] = 'InCrew Terms & Conditins';
		parent::render_view($data, 'common');
	}

	function terms_setup() {
		parent::allow(array('administrator'));
		$data = array();
		$data['terms_array'] = $this->Page_model->get_page_by_id('2');
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_id', 'Page', 'trim|required');
			$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
			if ($this->form_validation->run()) {
				if ($this->Page_model->edit_page_by_id($this->input->post('page_id'), array(
							'page_content' => $this->input->post('page_content'),
							'page_modified' => date('Y-m-d H:i:s')
						))) {
					die('1');
				}
			} else {
				echo validation_errors();
				die;
			}
			die('0');
		}
		$data['all_term_array'] = $this->Page_model->get_terms_and_condition_page();
		parent::render_view($data, '');
	}

	function get_term_and_condition_by_page_id() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_id', 'Page ID', 'trim|required');
			if ($this->form_validation->run()) {
				parent::json_output($this->Page_model->get_page_by_id($this->input->post('page_id')));
				return;
			} else {
				echo validation_errors();
				die;
			}
		}
		die('0');
	}

	function list_contract_crew_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('contract_crew_support_status!=' => '-1'));
		$this->datatables->select("contract_crew_support_id,contract_crew_support_title,contract_crew_support_content,CONCAT('" . base_url() . "uploads/pages/contract_crew/',DATE_FORMAT(contract_crew_support_created,'/%Y/%m/%d/%H/%i/%s/'),contract_crew_support_image) as image_url,contract_crew_support_button_text,contract_crew_support_button_link,contract_crew_support_status", FALSE)->from('contract_crew_supports');
		echo $this->datatables->generate();
	}

	function list_contract_crew() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_contract_crew_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contract_crew_support_id', 'Contract Crew Support ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('contract_crew_support_status', 'Contract Crew Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_contract_crew_support_by_id($this->input->post('contract_crew_support_id'), array('contract_crew_support_status' => $this->input->post('contract_crew_support_status') == 'true' ? '1' : '0'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function edit_contract_crew($contract_crew_support_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['contract_crew_array'] = $this->Page_model->get_contract_crew_support_by_id($contract_crew_support_id);
		if (count($data['contract_crew_array']) === 0) {
			redirect(base_url() . 'page/list_contract_crew');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contract_crew_support_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_image', 'Image', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_button_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_button_link', 'Button Link', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('contract_crew_support_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/contract_crew' . date('/Y/m/d/H/i/s', strtotime($data['contract_crew_array']['contract_crew_support_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_contract_crew_support_by_id($contract_crew_support_id, array(
							'contract_crew_support_title' => $this->input->post('contract_crew_support_title'),
							'contract_crew_support_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', str_replace('<p></p>', '', $this->input->post('contract_crew_support_content'))),
							'contract_crew_support_image' => $upload_image,
							'contract_crew_support_button_text' => $this->input->post('contract_crew_support_button_text'),
							'contract_crew_support_button_link' => $this->input->post('contract_crew_support_button_link'),
							'contract_crew_support_modified' => date('Y-m-d H:i:s')
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

	function add_contract_crew() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contract_crew_support_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_image', 'Image', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_button_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('contract_crew_support_button_link', 'Button Link', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('contract_crew_support_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/contract_crew' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->add_contract_crew_support(array(
							'contract_crew_support_title' => $this->input->post('contract_crew_support_title'),
							'contract_crew_support_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', str_replace('<p></p>', '', $this->input->post('contract_crew_support_content'))),
							'contract_crew_support_image' => $upload_image,
							'contract_crew_support_button_text' => $this->input->post('contract_crew_support_button_text'),
							'contract_crew_support_button_link' => $this->input->post('contract_crew_support_button_link'),
							'contract_crew_support_status' => '1',
							'contract_crew_support_created' => $time_now
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

	function list_staff_recruitment_datatable() {
		parent::allow(array('administrator'));
		$this->load->library('Datatables');
		$this->datatables->where(array('staff_recruitment_status!=' => '-1'));
		$this->datatables->select("staff_recruitment_id,staff_recruitment_title,staff_recruitment_content,CONCAT('" . base_url() . "uploads/pages/staff_recruitment',DATE_FORMAT(staff_recruitment_created,'/%Y/%m/%d/%H/%i/%s/'),staff_recruitment_image) as image_url,staff_recruitment_button_text,staff_recruitment_button_link,staff_recruitment_status", FALSE)->from('staff_recruitments');
		echo $this->datatables->generate();
	}

	function list_staff_recruitment() {
		parent::allow(array('administrator'));
		$data = array();
		parent::render_view($data, '');
	}

	function change_staff_recruitment_status() {
		parent::allow(array('administrator'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('staff_recruitment_id', 'Staff Recruitment ID', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('staff_recruitment_status', 'Staff Recruitment Status', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->Page_model->edit_staff_recruitment_by_id($this->input->post('staff_recruitment_id'), array('staff_recruitment_status' => $this->input->post('staff_recruitment_status') == 'true' ? '1' : '0'))) {
				die('1');
			}
		} else {
			echo validation_errors();
			die;
		}
		die('0');
	}

	function edit_staff_recruitment($staff_recruitment_id = '') {
		parent::allow(array('administrator'));
		$data = array();
		$data['staff_recruitment_array'] = $this->Page_model->get_staff_recruitment_by_id($staff_recruitment_id);
		if (count($data['staff_recruitment_array']) === 0) {
			redirect(base_url() . 'page/list_staff_recruitment');
		}
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('staff_recruitment_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_image', 'Image', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_button_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_button_link', 'Button Link', 'trim|required');
			if ($this->form_validation->run()) {
				$upload_image = $this->input->post('staff_recruitment_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/staff_recruitment' . date('/Y/m/d/H/i/s', strtotime($data['staff_recruitment_array']['staff_recruitment_created']));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->edit_staff_recruitment_by_id($staff_recruitment_id, array(
							'staff_recruitment_title' => $this->input->post('staff_recruitment_title'),
							'staff_recruitment_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', str_replace('<p></p>', '', $this->input->post('staff_recruitment_content'))),
							'staff_recruitment_image' => $upload_image,
							'staff_recruitment_button_text' => $this->input->post('staff_recruitment_button_text'),
							'staff_recruitment_button_link' => $this->input->post('staff_recruitment_button_link'),
							'staff_recruitment_modified' => date('Y-m-d H:i:s')
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

	function add_staff_recruitment() {
		parent::allow(array('administrator'));
		$data = array();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('staff_recruitment_title', 'Title', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_content', 'Content', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_image', 'Image', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_button_text', 'Button Text', 'trim|required');
			$this->form_validation->set_rules('staff_recruitment_button_link', 'Button Link', 'trim|required');
			if ($this->form_validation->run()) {
				$time_now = date('Y-m-d H:i:s');
				$upload_image = $this->input->post('staff_recruitment_image');
				if (is_file(FCPATH . 'uploads/' . $upload_image)) {
					$upload_image_directory = FCPATH . 'uploads/pages/staff_recruitment' . date('/Y/m/d/H/i/s', strtotime($time_now));
					if (!is_dir($upload_image_directory)) {
						mkdir($upload_image_directory, 0777, TRUE);
					}
					if (parent::resize_image(FCPATH . 'uploads/' . $upload_image, $upload_image_directory . '/' . $upload_image, 586, 328)) {
						unlink(FCPATH . 'uploads/' . $upload_image);
					}
				}
				if ($this->Page_model->add_staff_recruitment(array(
							'staff_recruitment_title' => $this->input->post('staff_recruitment_title'),
							'staff_recruitment_content' => preg_replace('/^(\<p\>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', str_replace('<p></p>', '', $this->input->post('staff_recruitment_content'))),
							'staff_recruitment_image' => $upload_image,
							'staff_recruitment_button_text' => $this->input->post('staff_recruitment_button_text'),
							'staff_recruitment_button_link' => $this->input->post('staff_recruitment_button_link'),
							'staff_recruitment_status' => '1',
							'staff_recruitment_created' => $time_now
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

}
