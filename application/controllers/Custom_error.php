<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * custom_error class constroller
   * handle runtime error for example access denied, invalid action done by user
   * @return mixed show error message
   */
	class Custom_error extends CI_Controller {

		public function __construct(){
			parent::__construct();
    }

    public function index(){
      echo 'blackhole';
    }

    /**
     * function error - handle custom error
     * @param string $error_type - pass error_type like access denied, etc
     * @return mixed error message template
     */
    public function error($error_type = 'access_denied'){
      echo 'You have not access Denied';
    }
  }