<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Welcome extends CI_Controller {

		public function __construct(){
			header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			parent::__construct();
		}

		public function index(){
			$this->load->view('web/welcome_landing_page');
		}
}