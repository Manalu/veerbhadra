<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Customer_model extends CI_Model{
    
    public function retrieve($customer_id = ''){
      if($customer_id === ''){
        $result = $this->db->get('customers_tb')->result_array();        
        return $result;
      }else if($customer_id != ''){
        $result = $this->db->get_where('customers_tb', array('customer_id' => $customer_id), 1)->result_array();
        return $result;
      }
    }

    // action may be 'new' or 'existing'
    public function save($action = '', $data = '', $customer_id = ''){
      if($data !== '' && $action === 'new'){
        $result = $this->db->insert('customers_tb', $data);
        return $result;
      }else if($data !== '' && $action === 'existing'){
        $result = $this->db->where('customer_id', $customer_id)->update('customers_tb', $data);
        return $result;
      }
    }
  }