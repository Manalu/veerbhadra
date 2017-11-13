<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * work_order class - handle work order module
   */
	class Work_order extends CI_Controller {
    var $global_data = array(); // $global_data declaration

		public function __construct(){
      parent::__construct();
      $this->output->enable_profiler(TRUE);
      $this->load->model(array('user_model', 'site_model', 'work_order_model'));
      $this->user_model->user_auth('page_auth'); // page authentication

      // global data initilize
      $this->global_data['page_name'] = 'work_order';
      $this->global_data['page_title'] = 'Work Order Management :: Veerbhadra Infra';
      // set header, sidebar, navbar, and footer view for all pages
      $this->global_data['header_view'] = $this->load->view('template/header_view', $this->global_data, TRUE);
      $this->global_data['sidebar_view'] = $this->load->view('template/sidebar_view', $this->global_data, TRUE);
      $this->global_data['navbar_view'] = $this->load->view('template/navbar_view', NULL, TRUE);
      $this->global_data['footer_view'] = $this->load->view('template/footer_view', NULL, TRUE);

    }

    /**
     * index function - show work order list
     *
     * @return mixed work order table show
     */
    public function index(){
      $work_order_data['work_order_data'] = $this->work_order_model->retrieve();
      $this->load->view('work_order/work_order_index_view', array_merge($this->global_data, $work_order_data));
    }

    /**
     * view function - view single work order
     *
     * @param integer $work_order_id - primary key of work order
     * @return mixed - load single work order information page
     */
    public function view($work_order_id = ''){

      // clean work order id
      $work_order_id = clean_input($work_order_id);

      // check work order id is empty or not and numeric or not
      if($work_order_id !== '' && is_numeric($work_order_id)){

        $work_order_data['work_order_data'] = $this->work_order_model->retrieve('WORK_ORDER_DATA', $work_order_id);
        $work_order_list_data['work_order_list_data'] = $this->work_order_model->retrieve('WORK_ORDER_LIST_DATA', $work_order_id);

        if($work_order_data['work_order_data']){
          $this->load->view('work_order/work_order_view', array_merge($this->global_data, $work_order_data, $work_order_list_data));
        }else{
          echo 'work order data not found';
        }

      }else{

        if($work_order_id === ''){
          echo 'blackhole - empty work order id';
        }else if(! is_numeric($work_order_id)){
          echo 'blackhole - not numeric work order id passed';
        }else{
          echo 'blackhole - something unexpected error occured';
        }

      }
    }

    /**
     * create function - create new work order
     *
     * @return mixed - show crete new work order form to user
     */
    public function create(){
      $site_data['site_data'] = $this->site_model->retrieve();
      $this->load->view('work_order/work_order_create_view', array_merge($this->global_data, $site_data));
    }

    public function update($work_order_id = ''){
      $work_order_id = intval(clean_input($work_order_id));

      if($work_order_id !== '' && is_int($work_order_id)){
        $site_data['site_data'] = $this->site_model->retrieve();
        $work_order_data['work_order_data'] = $this->work_order_model->retrieve('WORK_ORDER_LIST_DATA', $work_order_id);

        $this->load->view('work_order/work_order_update_view', array_merge($this->global_data, $site_data, $work_order_data));
      }else{
        if($work_order_id === ''){
          echo 'blackhole- parameter not passed';
        }else if(! is_int($work_order_id)){
          echo 'blackhole- parameter is not numeric';
        }else{
          echo 'blackhole - somethig else happen';
        }
      }
    }

    /**
     * save function - save work order information into database
     *
     * @param string $action - either 'new' or 'existing'
     * @return mixed - redirect to work order page
     */
    public function save($action = ''){
        if($action !== ''){
          // set validation
          $this->form_validation->set_rules(
            'site_name',
            'site name',
            'trim|xss_clean|required|integer'
          );

          $this->form_validation->set_rules(
            'work_order_number',
            'work order number',
            'trim|xss_clean|required|integer'
          );

          $this->form_validation->set_rules(
            'work_order_date',
            'work order date',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'work_type',
            'work type',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'building_name',
            'building name',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'row_count',
            'row count',
            'trim|xss_clean|required|integer'
          );

          // array value validation
          $this->form_validation->set_rules(
            'flat_number[]',
            'flat number',
            'trim|xss_clean'
          );

          $this->form_validation->set_rules(
            'work_order_desc[]',
            'work order description',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'quantity[]',
            'quantity',
            'trim|xss_clean|required|numeric|greater_than_equal_to[0.1]|less_than_equal_to[100000]'
          );

          $this->form_validation->set_rules(
            'unit[]',
            'unit',
            'trim|xss_clean|required'
          );

          $this->form_validation->set_rules(
            'rate[]',
            'rate',
            'trim|xss_clean|required|numeric|greater_than_equal_to[0.1]|less_than_equal_to[10000000]'
          );

          $this->form_validation->set_rules(
            'amount[]',
            'amount',
            'trim|xss_clean|required|numeric|greater_than_equal_to[0.1]|less_than_equal_to[10000000]'
          );

          if ($this->form_validation->run() == FALSE){
            $site_data['site_data'] = $this->site_model->retrieve();
            $this->load->view('work_order/work_order_create_view', array_merge($this->global_data, $site_data));
          }else{
            // clean inputs
            $row_count = clean_input($this->input->post('row_count'));

            // work_orders_tb
            $work_order['site_id'] = clean_input($this->input->post('site_name'));
            $work_order['work_order_type'] = strtoupper(clean_input($this->input->post('work_type')));
            $work_order['work_order_number'] = clean_input($this->input->post('work_order_number'));
            $work_order['work_order_building_name'] = strtoupper(clean_input($this->input->post('building_name')));
            $work_order['work_order_date'] = system_date_convert(clean_input($this->input->post('work_order_date')));

            // work_order_items_tb
            $work_order_item['work_order_id'] = [];
            $work_order_item['work_order_item_id'] = [];
            $work_order_item['work_order_item_flat_number'] = [];
            $work_order_item['work_order_item_desc'] = [];
            $work_order_item['work_order_item_quantity'] = [];
            $work_order_item['work_order_item_unit'] = [];
            $work_order_item['work_order_item_rate'] = [];
            $work_order_item['work_order_item_amount'] = [];

            for($i=0; $i < $row_count; $i++){
              if($action === 'existing'){
                $work_order_id = clean_input($this->input->post('work_order_id'));
                $work_order_item_id = $this->input->post('work_order_item_id');

                array_push($work_order_item['work_order_id'], $work_order_id);

                foreach ($work_order_item_id as $value) {
                  array_push($work_order_item['work_order_item_id'], clean_input($value));                  
                }

              }else{
                array_push($work_order_item['work_order_id'], null);
              }
            }

            foreach($this->input->post('flat_number') as $value){
              array_push($work_order_item['work_order_item_flat_number'], clean_input($value));
            }

            foreach($this->input->post('work_order_desc') as $value){
              array_push($work_order_item['work_order_item_desc'], ucwords(clean_input($value)));
            }

            foreach($this->input->post('quantity') as $value){
              array_push($work_order_item['work_order_item_quantity'], amount_format(clean_input($value)));
            }

            foreach($this->input->post('unit') as $value){
              array_push($work_order_item['work_order_item_unit'], strtoupper(clean_input($value)));
            }

            foreach($this->input->post('rate') as $value){
              array_push($work_order_item['work_order_item_rate'], amount_format(clean_input($value)));
            }

            foreach($this->input->post('amount') as $value){
              array_push($work_order_item['work_order_item_amount'], amount_format(clean_input($value)));
            }

            $result = $this->work_order_model->save($action, $row_count, $work_order, $work_order_item);

            if($result == TRUE){
              if($action === 'new'){
                $this->session->set_userdata('feedback', 'WORK ORDER CREATED');
              }else{
                $this->session->set_userdata('feedback', 'WORK ORDER UPDATED');
              }
              redirect('work_order');
            }else{
              echo 'blackhole - handle falsy result';
            }
          }
        }else{
          echo 'blackhole - action not specified';
        }
    }

  }