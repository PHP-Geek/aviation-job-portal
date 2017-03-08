<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends MY_Controller {

    public $public_methods = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Cron_model');
    }

    function index() {

    }

}