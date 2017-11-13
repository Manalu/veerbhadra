<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * customer class controller
   * handle customer module like create, retrieve, update, delete and view functionality   *  
   */
	class Customer extends CI_Controller {
    var $global_data = array(); // $global_data declaration

		public function __construct(){
      parent::__construct();
      $this->output->enable_profiler(TRUE);
      $this->load->model(array('user_model', 'customer_model'));
      $this->user_model->user_auth('page_auth'); // page authentication
      // global data initilize
      $this->global_data['page_name'] = 'customer';
      $this->global_data['page_title'] = 'Customer Management :: Veerbhadra Infra';
      // set header, sidebar, navbar, and footer view for all pages
      $this->global_data['header_view'] = $this->load->view('template/header_view', $this->global_data, TRUE);
      $this->global_data['sidebar_view'] = $this->load->view('template/sidebar_view', $this->global_data, TRUE);
      $this->global_data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $this->global_data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);
    }

    /**
     * index function - default view load for customer controller
     * @param null
     * @return mixed shows customer list
     */
    public function index(){
      $customer_data['customer_data'] = $this->customer_model->retrieve(); // retrieve customer data
      $this->load->view('customer/customer_index_view', array_merge($this->global_data, $customer_data)); // load customer index view
    }

    /**
     * view function - single customer view
     *
     * @param integer $customer_id - primary key of customers_tb
     * @return mixed show information of parameter passed customer
     */
    public function view($customer_id = ''){
      
      // check customer_id is not null and customer id should be numeric value
      if($customer_id !== '' && is_numeric($customer_id)){
        // retrieve customer information
        $customer_id = clean_input($customer_id);
        $customer_data['customer_data'] = $this->customer_model->retrieve($customer_id);
        
        // check customer data is empty or not        
        if($customer_data['customer_data']){
          $this->load->view('customer/customer_view', array_merge($this->global_data, $customer_data));
        }else{
          echo 'blackhole - you have passed invalid customer id now';
        }
      }else{
        
        // check customer_id is equal to empty string or not
        if($customer_id === ''){
          echo 'you have required to pass customer id';
        }else if(! is_numeric($customer_id)){ // check customer id is not numeric value
          echo 'you have tried to access customer information using invalid customer id';
        }else{ // anything else goes here
          echo 'blackhole - something went wrong.';
        }

      }
    }

    /**
     * create function - create new customer
     * 
     * @return mixed - load customer create form
     */
    public function create(){
      $this->load->view('customer/customer_create_view', $this->global_data); // load create customer view
    }

    /**
     * save function - save new and existing customer information
     *
     * @param string $action - either 'new' or 'existing' value
     * @return mixed - save customer information into database
     */
    public function save($action = ''){
      
      // check request method is post or not
      if($this->input->server('REQUEST_METHOD') == 'POST'){
        // clean action
        $action = clean_input($action);
        
        // set validation        
        
        $this->form_validation->set_rules(
          'customer_name',
          'customer name',
          'trim|required|xss_clean|min_length[3]|max_length[100]'
        );
        
        $this->form_validation->set_rules(
          'company_name',
          'company name',
          'trim|required|xss_clean|min_length[5]|max_length[120]'
        );
        
        $this->form_validation->set_rules(
          'mobile_number',
          'mobile number',
          'trim|xss_clean'
        );
        
        $this->form_validation->set_rules(
          'email_address',
          'email address',
          'trim|xss_clean|valid_email'
        );
        
        $this->form_validation->set_rules(
          'address',
          'address',
          'trim|xss_clean|required|min_length[15]|max_length[300]'
        );
        
        $this->form_validation->set_rules(
          'gst_number',
          'gst number',
          'trim|xss_clean|required|alpha_numeric'
        );
        
        $this->form_validation->set_rules(
          'vendor_code',
          'vendor code',
          'trim|xss_clean'
        );
        
        // run validation
        if($this->form_validation->run() === false){
          
          // check action is new or existing
          if($action === 'new'){            
            $this->load->view('customer/customer_create_view', array_merge($this->global_data));
          }else if($action === 'existing'){            
            // validation of customer id only for update action            
            $this->form_validation->set_rules(
              'customer_id',
              'customer id',
              'trim|required|xss_clean|integer'
            );

            $this->load->view('customer/customer_update_view', array_merge($this->global_data));
          }else{
            echo 'blackhole - invalid action entered by user';
          }
          
        }else{
          
          // clean inputs and text transform
          $customer_data['customer_name'] = ucwords(clean_input($this->input->post('customer_name')));
          $customer_data['customer_company_name'] = ucwords(clean_input($this->input->post('company_name')));
          $customer_data['customer_mobile_number'] = clean_input($this->input->post('mobile_number'));
          $customer_data['customer_email_address'] = strtolower(clean_input($this->input->post('email_address')));
          $customer_data['customer_address'] = ucwords(clean_input($this->input->post('address')));
          $customer_data['customer_gst_number'] = strtoupper(clean_input($this->input->post('gst_number')));
          $customer_data['customer_vendor_code'] = strtoupper(clean_input($this->input->post('vendor_code')));
          
          // check action is new or existing
          if($action === 'new'){
            
            $result = $this->customer_model->save($action, $customer_data);
            
            // check result from model
            if($result === TRUE){
              $this->session->set_userdata('feedback', 'CUSTOMER CREATED');
            }else{
              echo 'blackhole - false result ';
            }
            
          }else if($action === 'existing'){
            
            // clean inputs db column name = variable name
            $customer_id = clean_input($this->input->post('customer_id'));

            $result = $this->customer_model->save($action, $customer_data, $customer_id);
            // check result from model
            if($result === TRUE){
              $this->session->set_userdata('feedback', 'CUSTOMER UPDATED');
            }else{
              echo 'blackhole - false result ';
            }

          }else{
            echo 'blackhole - inavlid action entered by user 2';
          }          
          
          // redirect after done to customer controller
          redirect('customer');
        }
      }
    }

    /**
     * update function
     *
     * @param string $customer_id - customer primary key
     * @return mixed - show customer update form to user
     */
    public function update($customer_id = ''){
      // check customer id is null and is numeric value
      if($customer_id !== '' && is_numeric($customer_id)){
          // retrieve customer data form customer model
          $customer_data['customer_data'] = $this->customer_model->retrieve($customer_id);
          
          if($customer_data['customer_data']){
            // load customer update form
            $this->load->view('customer/customer_update_view', array_merge($this->global_data, $customer_data));
          }else{
            echo 'There is no any customer has mention id';
          }
      }else{
        if($customer_id === ''){
          echo 'blackhole - unable to update customer form';
        }else if(! is_numeric($customer_id)){
          echo 'blackhole - unable to update customer form bcz customer id is not numeric';
        }else{
          echo 'blackhole - something unexpected error occured';
        }
      }
    }

    /**
     * delete function - delete customer from database
     * [incomplete function]
     * 
     * @param integer $customer_id
     * @return mixed - show customer delete for to user
     */
    public function delete($customer_id = ''){
      
      // clean customer id for security
      $customer_id = clean_input($customer_id);

      // check request method is post or not
      if($this->input->server('REQUEST_METHOD') === 'POST'){
        if($customer_id !== '' && is_numeric($customer_id)){
          // set validation
          $this->form_validation->set_rules(
            'customer_id',
            'customer id',
            'trim|xss_clean|required'
          );
          
          $this->form_validation->set_rules(
            'reason',
            'reason',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'remark',
            'remark',
            'trim|xss_clean|min_length[15]|max_length[300]'
          );

          // run validation
          if($this->form_validation->run() === false){
            $customer_data['customer_data'] = $this->customer_model->retrieve($customer_id);

            $this->load->view('customer/customer_delete_view', array_merge($this->global_data, $customer_data));
          }else{
            echo 'validation done & ready to save data';
          }

        }else{
          if($customer_id === ''){
            echo 'customer is not passed';
          }else if(! is_numeric($customer_id)){
            echo 'customer id not numeric value';
          }else{
            echo 'blackhole';
          }
        }
      }else{
        if($customer_id !== '' && is_numeric($customer_id)){
          $customer_data['customer_data'] = $this->customer_model->retrieve($customer_id);
          $this->load->view('customer/customer_delete_view', array_merge($this->global_data, $customer_data));
        }else{
          if($customer_id === ''){
            echo 'customer is not passed';
          }else if(! is_numeric($customer_id)){
            echo 'customer id not numeric value';
          }else{
            echo 'blackhole';
          }
        }
      }
      
    }
  }