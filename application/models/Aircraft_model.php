<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Aircraft_model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

	function get_all_aircrafts() {
		$this->db->join('aircraft_types', 'aircraft_types.aircraft_type_id = aircrafts.aircraft_types_id', 'left');
		$this->db->join('models', 'models.model_id = aircrafts.models_id', 'left');
		$this->db->select("aircrafts.*,aircraft_types.*,models.*, (SELECT GROUP_CONCAT( aircraft_highlight_value SEPARATOR ' , ') FROM aircraft_highlights WHERE aircrafts_id = aircrafts.aircraft_id AND aircraft_highlight_status = 1) AS highlight");
		return $this->db->where("aircraft_status != -1")->order_by('aircraft_order')->get('aircrafts')->result_array();
	}

	function get_aircraft_max_order_by_aircraft_id() {
		return $this->db->select_max('aircraft_order')->get('aircrafts')->row_array();
	}

	function add($aircraft_insert_array) {
		if ($this->db->insert('aircrafts', $aircraft_insert_array) > 0) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function add_aircraft_type($aircraft_type_insert_array) {
		return $this->db->insert('aircraft_types', $aircraft_type_insert_array);
	}

	function get_aircraft_highlight_by_aircraft_id($aircraft_id) {
		return $this->db->where(array('aircraft_highlight_status' => '1', 'aircrafts_id' => $aircraft_id))->get('aircraft_highlights')->result_array();
	}

	function edit_aircraft_highlight_by_aircraft_id($aircraft_id, $aircraft_highlight_array) {
		return $this->db->update('aircraft_highlights', $aircraft_highlight_array, array('aircrafts_id' => $aircraft_id));
	}

	function add_aircraft_hightlight($aircraft_highlight_array) {
		return $this->db->insert('aircraft_highlights', $aircraft_highlight_array);
	}

	function add_model($model_insert_array) {
		return $this->db->insert('models', $model_insert_array);
	}

	function add_sales_and_acquisition($acquisition_array) {
		return $this->db->insert('sales_and_acquisitions', $acquisition_array);
	}

	function get_aircraft_types() {
		return $this->db->where('aircraft_type_status', '1')->get('aircraft_types')->result_array();
	}

	function get_active_manufacturer() {
		return $this->db->where('manufacturer_status', '1')->get('manufacturers')->result_array();
	}

	function get_aircrafts_year() {
		$this->db->group_by('aircraft_year');
		return $this->db->where('aircraft_status', '1')->get('aircrafts')->result_array();
	}

	function count_total_aircrafts() {
		return $this->db->where(array('aircrafts.aircraft_status' => '1'))->get('aircrafts')->num_rows();
	}

	function search($search_text = '', $order = '') {
		$this->db->join('aircraft_highlights', 'aircrafts.aircraft_id=aircraft_highlights.aircrafts_id', 'left');
		$this->db->join('models', 'models.model_id=aircrafts.models_id', 'left');
		$this->db->join('manufacturers', 'manufacturers.manufacturer_id=models.manufacturers_id');
		$this->db->like('aircrafts.aircraft_name', $search_text)->or_like('aircrafts.aircraft_year', $search_text)->or_like('manufacturers.manufacturer_name', $search_text)->or_like('models.model_name', $search_text)->or_like('aircraft_highlights.aircraft_highlight_value', $search_text);
		if ($order !== '') {
			switch ($order) {
				case '2':
					$this->db->order_by('aircraft_name', 'desc');
					break;
				case '3':
					$this->db->order_by('aircraft_price', 'asc');
					break;
				case '4':
					$this->db->order_by('aircraft_price', 'desc');
					break;
				case '5':
					$this->db->order_by('aircraft_year', 'desc');
					break;
				case '6':
					$this->db->order_by('aircraft_year', 'asc');
					break;
				default:
					$this->db->order_by('aircraft_order', 'asc');
			}
		}
		$this->db->group_by('aircraft_id');
		return $this->db->where(array('aircrafts.aircraft_status' => '1'))->get('aircrafts')->result_array();
	}

	function get_aircrafts($order, $manufacturer_id, $model_id, $aircraft_year, $search_text = '') {
		$this->db->join('models', 'models.model_id = aircrafts.models_id', 'left');
		$this->db->join('manufacturers', 'models.manufacturers_id = manufacturers.manufacturer_id', 'left');
		$this->db->where("aircraft_status = 1");
		if ($search_text !== '') {
			$this->db->join('aircraft_highlights', 'aircrafts.aircraft_id = aircraft_highlights.aircrafts_id', 'left');
			$this->db->like('aircrafts.aircraft_name', $search_text)->or_like('aircrafts.aircraft_year', $search_text)->or_like('manufacturers.manufacturer_name', $search_text)->or_like('models.model_name', $search_text)->or_like('aircraft_highlights.aircraft_highlight_value', $search_text);
			$this->db->group_by('aircraft_id', 'ASC');
		}
		if ($model_id !== '') {
			$this->db->where('aircrafts.models_id', $model_id);
		}
		if ($aircraft_year !== '') {
			$this->db->where('aircrafts.aircraft_year', $aircraft_year);
		}
		if ($manufacturer_id !== '') {
			$this->db->where('manufacturers.manufacturer_id', $manufacturer_id);
		}
		if ($order !== '') {
			switch ($order) {
				case '2':
					$this->db->order_by('aircraft_name', 'desc');
					break;
				case '3':
					$this->db->order_by('aircraft_price', 'asc');
					break;
				case '4':
					$this->db->order_by('aircraft_price', 'desc');
					break;
				case '5':
					$this->db->order_by('aircraft_year', 'desc');
					break;
				case '6':
					$this->db->order_by('aircraft_year', 'asc');
					break;
				default:
					$this->db->order_by('aircraft_name', 'asc');
			}
		} else {
			$this->db->order_by('aircraft_order', 'asc');
		}
		return $this->db->get('aircrafts')->result_array();
	}

	function detete_aircraft_by_id($aicraft_id) {
		return $this->db->delete('aircrafts', array('aircraft_id' => $aicraft_id));
	}

	function get_aircraft_sale_tab_max_order_by_aircraft_id($aircraft_id) {
		return $this->db->select_max('aircraft_sale_tab_order')->where('aircrafts_id', $aircraft_id)->get('aircraft_sale_tabs')->row_array();
	}

	function get_aircraft_by_id($aircraft_id, $aircraft_slug = '') {
		$this->db->join('models', 'models.model_id=aircrafts.models_id');
		if ($aircraft_slug !== '') {
			$this->db->where('aircraft_slug', $aircraft_slug);
		}
		return $this->db->where('aircraft_id', $aircraft_id)->get('aircrafts')->row_array();
	}

	function get_aircracft_sale_tabs_by_aircraft_id($aircraft_id, $order = '', $get_active = '') {
		if ($order !== '') {
			$this->db->order_by('aircraft_sale_tab_order', 'ASC');
		}
		if ($get_active === '1') {
			$this->db->where('aircraft_sale_tab_status', '1');
		} else {
			$this->db->where("aircraft_sale_tab_status != -1");
		}
		$this->db->where('aircrafts_id', $aircraft_id);
		return $this->db->get('aircraft_sale_tabs')->result_array();
	}

	function add_sale_tab($aircraft_sale_tab_array) {
		return $this->db->insert('aircraft_sale_tabs', $aircraft_sale_tab_array);
	}

	function edit_aircraft_sale_tab_by_id($aircraft_sale_tab_id, $aircraft_sale_tab_array) {
		return $this->db->update('aircraft_sale_tabs', $aircraft_sale_tab_array, array('aircraft_sale_tab_id' => $aircraft_sale_tab_id));
	}

	function get_aircraft_sale_tab_by_id($aircraft_sale_tab_id) {
		$this->db->join('aircrafts', 'aircrafts.aircraft_id=aircraft_sale_tabs.aircrafts_id');
		return $this->db->where('aircraft_sale_tab_id', $aircraft_sale_tab_id)->get('aircraft_sale_tabs')->row_array();
	}

	function get_aircraft_images_by_aircraft_id($aircraft_id) {
		return $this->db->where(array('aircraft_image_status' => '1', 'aircrafts_id' => $aircraft_id))->get('aircraft_images')->result_array();
	}

	function get_aircraft_by_aircraft_type_id($aircraft_type_id) {
		return $this->db->where(array('aircraft_types_id' => $aircraft_type_id, 'aircraft_status' => '1'))->get('aircrafts')->result_array();
	}

	function add_aircraft_quote($aircraft_quote_insert_array) {
		return $this->db->insert('aircraft_quotes', $aircraft_quote_insert_array);
	}

	function add_aircraft_sales_interest($aircraft_sales_interest_array) {
		return $this->db->insert('aircraft_sales_interests', $aircraft_sales_interest_array);
	}

	function get_active_models() {
		return $this->db->where('models.model_status', '1')->get('models')->result_array();
	}

	function get_aircraft_years($models_id = '') {
//		$this->db->join('models', 'models.model_id=aircrafts.models_id');
//		$this->db->join('manufacturers', 'manufacturers.manufacturer_id=models.manufacturers_id');
//		if ($manufacturer_id !== '') {
//			$this->db->where('manufacturers.manufacturer_id', $manufacturer_id);
//		}
		if ($models_id !== '') {
			$this->db->where('aircrafts.models_id', $models_id);
		}
		return $this->db->where(array('aircraft_status' => '1'))->group_by('aircraft_year')->get('aircrafts')->result_array();
	}

	function get_models_by_manufacturer_id($manufacturer_id) {
		return $this->db->where('manufacturers_id', $manufacturer_id)->get('models')->result_array();
	}

	function get_models() {
		return $this->db->where('model_status', '1')->get('models')->result_array();
	}

	function get_model_by_id($model_id) {
		return $this->db->where('model_id', $model_id)->get('models')->row_array();
	}

	function edit_aircraft_by_id($aircraft_id, $aircraft_update_array) {
		return $this->db->update('aircrafts', $aircraft_update_array, array
					('aircraft_id' => $aircraft_id));
	}

	function edit_model_by_id($model_id, $model_update_array) {
		return $this->db->update('models', $model_update_array, array('model_id' => $model_id));
	}

	function get_aircraft_year_by_manufacturer_id($manufacturer_id) {
		$this->db->join('models', 'models.model_id=aircrafts.models_id');
		$this->db->join('manufacturers', 'manufacturers.manufacturer_id=models.manufacturers_id');
		return $this->db->where(array('manufacturers.manufacturer_id' => $manufacturer_id, 'aircraft_status' => '1'))->group_by('aircraft_year')->get('aircrafts')->result_array();
	}

	function add_aircraft_image($aircraft_image_insert_array) {
		return $this->db->insert('aircraft_images', $aircraft_image_insert_array);
	}

	function edit_aircraft_quote_by_id($quote_id, $quote_array) {
		return $this->db->update('aircraft_quotes', $quote_array, array
					('aircraft_quote_id' => $quote_id));
	}

	function edit_aircraft_sales_interest_by_id($sales_interest_id, $sales_interest_array) {
		return $this->db->update('aircraft_sales_interests', $sales_interest_array, array('aircraft_sales_interest_id'
					=> $sales_interest_id));
	}

	function get_my_aircrafts() {
		return $this->db->where('my_aircraft_status', '1')->get('my_aircrafts')->result_array();
	}

	function get_aircraft_charter() {
		return $this->db->where('aircraft_charter_status', '1')->get('aircraft_charter')->result_array();
	}

	function get_aircraft_charter_by_id($aircraft_charter_id) {
		return $this->db->where('aircraft_charter_id', $aircraft_charter_id)->get('aircraft_charter')->row_array();
	}

	function edit_aircraft_charter_by_id($aircraft_charter_id, $aircraft_charter_array) {
		return $this->db->update('aircraft_charter', $aircraft_charter_array, array('aircraft_charter_id' => $aircraft_charter_id));
	}

	function add_aircraft_management($aircraft_management_array
	) {
		if ($this->db->insert('aircraft_management', $aircraft_management_array) > 0) {
			return $this->db->insert_id();
		} return 0;
	}

	function get_active_aircraft_management() {
		return $this->db->order_by('aircraft_management_order', 'ASC')->where('aircraft_management_status', '1')->get('aircraft_management')->result_array();
	}

	function get_aircraft_management($order = '') {
		if ($order !== '') {
			$this->db->
					order_by('aircraft_management_order', 'ASC');
		}
		return $this->db->where("aircraft_management_status != -1")->get('aircraft_management')->result_array();
	}

	function edit_aircraft_images_by_id($aircraft_id, $aircraft_images_array) {
		return $this->db->update('aircraft_images', $aircraft_images_array, array('aircrafts_id' => $aircraft_id));
	}

	function get_aircraft_management_by_id($aircraft_management_id) {
		return $this->db->where('aircraft_management_id', $aircraft_management_id)->get('aircraft_management')->row_array();
	}

	function edit_aircraft_management_by_id($aircraft_management_id, $aircraft_management_array) {
		return $this->db->update('aircraft_management', $aircraft_management_array, array('aircraft_management_id' => $aircraft_management_id));
	}

	function get_active_sales_and_acquisitions() {
		return $this->db->where('sales_and_acquisition_status', '1')->get('sales_and_acquisitions')->result_array();
	}

	function get_sales_and_acquisitions() {
		return $this->db->where("sales_and_acquisition_status != -1")->get('sales_and_acquisitions')->result_array();
	}

	function get_sales_and_acquisitions_by_id($sales_and_acquisition_id) {
		return $this->db->where('sales_and_acquisition_id', $sales_and_acquisition_id)->get('sales_and_acquisitions')->row_array();
	}

	function edit_sales_and_acquisitions_by_id($sales_and_acquisition_id, $sales_and_acquisition_array) {
		return $this->db->update('sales_and_acquisitions', $sales_and_acquisition_array, array('sales_and_acquisition_id' => $sales_and_acquisition_id));
	}

	function add_sales_and_acquisitions($sales_and_acquistion_array) {
		return $this->db->insert('sales_and_acquisitions', $sales_and_acquistion_array);
	}

	function get_charter_aircrafts() {
		return $this->db->where('charter_aircraft_status', '1')->get('charter_aircrafts')->result_array();
	}

}

?>