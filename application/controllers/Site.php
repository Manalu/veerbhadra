<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Site extends CI_Controller {

		public function __construct(){
      parent::__construct();
      $this->output->enable_profiler(TRUE);
      $this->load->model(array('user_model', 'customer_model', 'site_model'));
      $this->user_model->user_auth('page_auth'); // page authentication
    }

    public function index(){
      $data['page_name'] = 'site';
      $data['page_title'] = 'Site Management :: Veerbhadra Infra';
      $data['header_view'] = $this->load->view('template/header_view', $data, TRUE);
      $data['sidebar_view'] = $this->load->view('template/sidebar_view', $data, TRUE);
      $data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);
     
      $site_data['site_data'] = $this->site_model->retrieve();

      $this->load->view('site/site_index_view', array_merge($data, $site_data));
    }

    public function view($site_id = ''){
      $data['page_name'] = 'site';
      $data['page_title'] = 'Site Management :: Veerbhadra Infra';
      $data['header_view'] = $this->load->view('template/header_view', $data, TRUE);
      $data['sidebar_view'] = $this->load->view('template/sidebar_view', $data, TRUE);
      $data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);
     
      $site_data['site_data'] = $this->site_model->retrieve($site_id);

      $this->load->view('site/site_view', array_merge($data, $site_data));
    }

    public function create(){
      $data['page_name'] = 'site';
      $data['page_title'] = 'Site Management :: Veerbhadra Infra';
      $data['header_view'] = $this->load->view('template/header_view', $data, TRUE);
      $data['sidebar_view'] = $this->load->view('template/sidebar_view', $data, TRUE);
      $data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);

      $customer_data['customer_data'] = $this->customer_model->retrieve();

      $this->load->view('site/site_create_view', array_merge($data, $customer_data));
    }

    public function save($action = ''){
      if($this->input->server('REQUEST_METHOD') === 'POST'){
        if($action !== ''){
          // set validation rule
          // set validation rule for site id if action = 'existing'
          if($action === 'existing'){
            $this->form_validation->set_rules(
              'site_id',
              'site id',
              'trim|xss_clean|required|integer'
            );
          }

          $this->form_validation->set_rules(
            'customer_id',
            'customer name',
            'trim|xss_clean|required|integer'
          );

          $this->form_validation->set_rules(
            'site_name',
            'site name',
            'trim|xss_clean|required|min_length[3]|max_length[100]'
          );

          $this->form_validation->set_rules(
            'site_address',
            'site address',
            'trim|xss_clean|required|min_length[15]|max_length[300]'
          );

          $this->form_validation->set_rules(
            'site_desc',
            'site description',
            'trim|xss_clean|min_length[15]|max_length[300]'
          );

          // run validation
          if($this->form_validation->run() === false){
            $this->create();
          }else{
            $site_data['customer_id'] = clean_input($this->input->post('customer_id'));
            $site_data['site_name'] = ucwords(clean_input($this->input->post('site_name')));
            $site_data['site_address'] = ucwords(clean_input($this->input->post('site_address')));
            $site_data['site_desc'] = ucwords(clean_input($this->input->post('site_desc')));
            
            if($action === 'existing'){
              $site_id = clean_input($this->input->post('site_id'));
              $result = $this->site_model->save('existing', $site_data, $site_id);
            }else{
              $result = $this->site_model->save('new', $site_data);
            }
            
            if($result === TRUE){
              if($action === 'new'){
                $this->session->set_userdata('feedback', 'SITE CREATED');
                redirect('site');
              }elseif($action === 'existing'){
                $this->session->set_userdata('feedback', 'SITE UPDATED');
                redirect('site');              
              }
            }else {
              echo 'blackhole';
            }
          }
        }else{
          echo 'blackhole';
        }
      }else{
        echo 'blackhole';
      }
    }

    public function update($site_id = ''){
      if($site_id !== ''){
        $data['page_name'] = 'site';
        $data['page_title'] = 'Site Management :: Veerbhadra Infra';
        $data['header_view'] = $this->load->view('template/header_view', $data, TRUE);
        $data['sidebar_view'] = $this->load->view('template/sidebar_view', $data, TRUE);
        $data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
        $data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);

        $customer_data['customer_data'] = $this->customer_model->retrieve();
        $site_data['site_data'] = $this->site_model->retrieve($site_id);

        $this->load->view('site/site_update_view', array_merge($data, $customer_data, $site_data));
      }else{
        echo 'blackhole';
      }
    }
  }