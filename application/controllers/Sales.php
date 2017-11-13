<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sales extends CI_Controller {
    var $global_data = array(); // $global_data declaration

		public function __construct(){
      parent::__construct();
      $this->output->enable_profiler(TRUE);
      $this->load->model(array('user_model', 'sales_model'));
      $this->user_model->user_auth('page_auth'); // page authentication
    
      // global data initilize
      $this->global_data['page_name'] = 'sales';
      $this->global_data['page_title'] = 'Sales Management :: Veerbhadra Infra';
      // set header, sidebar, navbar, and footer view for all pages
      $this->global_data['header_view'] = $this->load->view('template/header_view', $this->global_data, TRUE);
      $this->global_data['sidebar_view'] = $this->load->view('template/sidebar_view', $this->global_data, TRUE);
      $this->global_data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $this->global_data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);

    }

		public function index(){
      $sales_data['sales_data'] = $this->sales_model->retrieve('SALES_INVOICE_DATA');

      $this->load->view('sales/sales_index_view', array_merge($this->global_data, $sales_data));
		}
}