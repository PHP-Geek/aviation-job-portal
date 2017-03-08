<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Advertisement_model');
		$this->load->model('Page_model');
	}

}
