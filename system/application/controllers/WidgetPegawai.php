<?php

class WidgetPegawai extends Controller {
    function __construct() {
		$_SERVER['no_login'] = true;
        parent::Controller();
    }
    
    function index() {
        $this->load->view('widget/pegawai_list');
    }
}