<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Page_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function get_page_blue_boxes_by_blue_box_id($blue_box_id = '') {
		return $this->db->where(array('page_blue_box_id' => $blue_box_id, 'page_blue_box_status' => '1'))->get('page_blue_boxes')->row_array();
	}

	function edit_page_blue_boxes_by_blue_box_id($page_blue_box_id, $page_blue_box_array) {
		return $this->db->update('page_blue_boxes', $page_blue_box_array, array('page_blue_box_id' => $page_blue_box_id));
	}

	function edit_contact_us_feed_by_id($contact_us_feed_id, $contact_us_feed_array) {
		return $this->db->update('contact_us_feeds', $contact_us_feed_array, array('contact_us_feed_id' => $contact_us_feed_id));
	}

	function get_contact_offices() {
		return $this->db->where('contact_office_status', '1')->get('contact_offices')->result_array();
	}

	function get_contact_office_by_id($contact_office_id) {
		return $this->db->where('contact_office_id', $contact_office_id)->get('contact_offices')->row_array();
	}

	function add_contact_office($contact_office_array) {
		return $this->db->insert('contact_offices', $contact_office_array);
	}

	function edit_contact_office_by_id($contact_office_id, $contact_office_array) {
		return $this->db->update('contact_offices', $contact_office_array, array('contact_office_id' => $contact_office_id));
	}

	function add_contact_us_feeds($contact_us_feeds_insert_array) {
		return $this->db->insert('contact_us_feeds', $contact_us_feeds_insert_array);
	}

	function add_crew_support($crew_support_insert_array) {
		if ($this->db->insert('crew_support', $crew_support_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_crew_support_aircraft($crew_support_aircraft_array) {
		return $this->db->insert('crew_support_aircrafts', $crew_support_aircraft_array);
	}

	function add_crew_support_log($crew_support_insert_array) {
		if ($this->db->insert('crew_support_history', $crew_support_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_crew_support_by_id($crew_support_id) {
		return $this->db->where('crew_support_id', $crew_support_id)->get('crew_support')->row_array();
	}

	function edit_crew_support_by_id($crew_support_id, $crew_support_array) {
		return $this->db->update('crew_support', $crew_support_array, array('crew_support_id' => $crew_support_id));
	}

	function get_about_increw() {
		return $this->db->where('about_increw_status', '1')->get('about_increw')->result_array();
	}

	function about_increw_by_id($about_increw_id) {
		return $this->db->where('about_increw_id', $about_increw_id)->get('about_increw')->row_array();
	}

	function edit_about_increw_by_id($about_increw_id, $about_increw_array) {
		return $this->db->update('about_increw', $about_increw_array, array('about_increw_id' => $about_increw_id));
	}

	function add_about_increw($about_increw_array) {
		if ($this->db->insert('about_increw', $about_increw_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_entry_into_services() {
		return $this->db->where('entry_into_service_status', '1')->get('entry_into_services')->result_array();
	}

	function get_entry_into_service_by_id($entry_into_service_id) {
		return $this->db->where('entry_into_service_id', $entry_into_service_id)->get('entry_into_services')->row_array();
	}

	function edit_entry_into_service_by_id($entry_into_service_id, $entry_into_service_array) {
		return $this->db->update('entry_into_services', $entry_into_service_array, array('entry_into_service_id' => $entry_into_service_id));
	}

	function add_entry_into_service($entry_into_service_array) {
		if ($this->db->insert('entry_into_services', $entry_into_service_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function get_increw_services($order = '') {
		if ($order !== '') {
			$this->db->order_by('increw_service_order', 'ASC');
		}
		return $this->db->where("increw_service_status != -1")->get('increw_services')->result_array();
	}

	function get_active_increw_services() {
		return $this->db->order_by('increw_service_order', 'ASC')->where('increw_service_status', '1')->get('increw_services')->result_array();
	}

	function get_increw_service_by_id($increw_service_id) {
		return $this->db->where('increw_service_id', $increw_service_id)->get('increw_services')->row_array();
	}

	function edit_increw_service_by_id($increw_service_id, $increw_service_array) {
		return $this->db->update('increw_services', $increw_service_array, array('increw_service_id' => $increw_service_id));
	}

	function get_active_slider_images() {
		return $this->db->where('slider_image_status', '1')->get('slider_images')->result_array();
	}

	function get_slider_image_by_id($slider_image_id) {
		return $this->db->where('slider_image_id', $slider_image_id)->get('slider_images')->row_array();
	}

	function edit_slider_image_by_id($slider_image_id, $slider_image_array) {
		return $this->db->update('slider_images', $slider_image_array, array('slider_image_id' => $slider_image_id));
	}

	function add_slider_image($slider_image_array) {
		return $this->db->insert('slider_images', $slider_image_array);
	}

	function get_page_content() {
		return $this->db->get('page_contents')->result_array();
	}

	function get_page_content_by_id($page_content_id) {
		return $this->db->where('page_content_id', $page_content_id)->get('page_contents')->row_array();
	}

	function edit_home_page_by_id($page_content_id, $home_page_array) {
		return $this->db->update('page_contents', $home_page_array, array('page_content_id' => $page_content_id));
	}

	function home_page_links() {
		return $this->db->where('home_page_link_status', '1')->get('home_page_links')->result_array();
	}

	function get_home_page_link_by_id($home_page_link_id) {
		return $this->db->where('home_page_link_id', $home_page_link_id)->get('home_page_links')->row_array();
	}

	function edit_home_page_link_by_id($home_page_link_id, $home_page_link_array) {
		return $this->db->update('home_page_links', $home_page_link_array, array('home_page_link_id' => $home_page_link_id));
	}

	function add_invitation_email($invitation_email_array) {
		if ($this->db->insert('invitation_emails', $invitation_email_array)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_invitation_email_recipients($invitation_email_recipient_array) {
		return $this->db->insert('invitation_email_recipients', $invitation_email_recipient_array);
	}

	function get_page_testimonial_by_id($page_testimonial_id) {
		return $this->db->where('page_testimonial_id', $page_testimonial_id)->get('page_testimonials')->row_array();
	}

	function get_page_testimonial() {
		return $this->db->get('page_testimonials')->result_array();
	}

	function edit_page_testimonial_by_id($page_testimonial_id, $page_testimonial_array) {
		return $this->db->update('page_testimonials', $page_testimonial_array, array('page_testimonial_id' => $page_testimonial_id));
	}

	function edit_home_page_testimonial_by_id($home_page_testimonial_id, $home_page_testimonial_array) {
		return $this->db->update('home_page_testimonials', $home_page_testimonial_array, array('home_page_testimonial_id' => $home_page_testimonial_id));
	}

	function get_home_page_testimonial_by_id($home_page_testimonial_id) {
		return $this->db->where('home_page_testimonial_id', $home_page_testimonial_id)->get('home_page_testimonials')->row_array();
	}

	function add_home_page_testimonial($home_page_testimonial_array) {
		return $this->db->insert('home_page_testimonials', $home_page_testimonial_array);
	}

	function get_active_home_page_testimonials($testimonial_category = '1') {
		return $this->db->where(array('home_page_testimonial_status' => '1', 'home_page_testimonial_category' => $testimonial_category))->get('home_page_testimonials')->result_array();
	}

	function get_social_media_links() {
		return $this->db->get('social_media_links')->result_array();
	}

	function edit_social_media_link_by_id($social_media_link_id, $social_medial_link_array) {
		return $this->db->update('social_media_links', $social_medial_link_array, array('social_media_link_id' => $social_media_link_id));
	}

	function get_active_about_increw_footer() {
		return $this->db->where('about_increw_footer_status', '1')->get('about_increw_footer')->result_array();
	}

	function edit_about_increw_footer_by_id($about_increw_footer_id, $about_increw_footer_array) {
		return $this->db->update('about_increw_footer', $about_increw_footer_array, array('about_increw_footer_id' => $about_increw_footer_id));
	}

	function add_about_increw_footer($about_increw_footer_array) {
		return $this->db->insert('about_increw_footer', $about_increw_footer_array);
	}

	function get_about_increw_footer_by_id($about_increw_footer_id) {
		return $this->db->where('about_increw_footer_id', $about_increw_footer_id)->get('about_increw_footer')->row_array();
	}

	function get_page_banner_by_id($page_banner_id) {
		return $this->db->where('page_banner_id', $page_banner_id)->get('page_banners')->row_array();
	}

	function edit_page_banner_by_id($page_banner_id, $page_banner_array) {
		return $this->db->update('page_banners', $page_banner_array, array('page_banner_id' => $page_banner_id));
	}

	function get_terms_and_condition_page() {
		return $this->db->where("page_id = '2' OR page_id = '3'")->get('pages')->result_array();
	}

	function get_page_by_id($page_id) {
		return $this->db->where('page_id', $page_id)->get('pages')->row_array();
	}

	function edit_page_by_id($page_id, $page_array) {
		return $this->db->update('pages', $page_array, array('page_id' => $page_id));
	}

	function edit_contract_crew_support_by_id($contract_crew_support_id, $contract_crew_support_array) {
		return $this->db->update('contract_crew_supports', $contract_crew_support_array, array('contract_crew_support_id' => $contract_crew_support_id));
	}

	function get_contract_crew_support_by_id($contract_crew_support_id) {
		return $this->db->where(array('contract_crew_support_status' => '1', 'contract_crew_support_id' => $contract_crew_support_id))->get('contract_crew_supports')->row_array();
	}

	function add_contract_crew_support($contract_crew_array) {
		return $this->db->insert('contract_crew_supports', $contract_crew_array);
	}

	function get_active_contract_crew_supports() {
		return $this->db->where('contract_crew_support_status', '1')->get('contract_crew_supports')->result_array();
	}

	function add_staff_recruitment($staff_recruitment_array) {
		return $this->db->insert('staff_recruitments', $staff_recruitment_array);
	}

	function get_staff_recruitment_by_id($staff_recruitment_id) {
		return $this->db->where(array('staff_recruitment_id' => '1', 'staff_recruitment_id' => $staff_recruitment_id))->get('staff_recruitments')->row_array();
	}

	function edit_staff_recruitment_by_id($staff_recruitment_id, $staff_recruitment_array) {
		return $this->db->update('staff_recruitments', $staff_recruitment_array, array('staff_recruitment_id' => $staff_recruitment_id));
	}

	function get_active_staff_recruitement() {
		return $this->db->where('staff_recruitment_status', '1')->get('staff_recruitments')->result_array();
	}

}
