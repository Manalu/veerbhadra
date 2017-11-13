<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * dashboard class - show company information to user
   */
  class Dashboard extends CI_Controller{
    var $global_data = array(); // $global_data declaration

    public function __construct(){
      parent::__construct();
      $this->output->enable_profiler(TRUE);
      $this->load->model(array('user_model'));
      $this->user_model->user_auth('page_auth'); // page authentication
      
      // global data initilize
      $this->global_data['page_name'] = 'dashboard';
      $this->global_data['page_title'] = 'Dashboard :: Veerbhadra Infra';
      // set header, sidebar, navbar, and footer view for all pages
      $this->global_data['header_view'] = $this->load->view('template/header_view', $this->global_data, TRUE);
      $this->global_data['sidebar_view'] = $this->load->view('template/sidebar_view', $this->global_data, TRUE);
      $this->global_data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $this->global_data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);
    }

    /**
     * index function - show company information to user
     *
     * @return mixed - load view from dashboard file
     */
    public function index(){
      $this->load->view('dashboard/dashboard_index_view', $this->global_data);
    }
  }