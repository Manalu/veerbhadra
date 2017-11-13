<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Site_model extends CI_Model{
    
    public function retrieve($site_id = ''){
      if($site_id !== ''){        
        $result = $this->db->query("SELECT customers_tb.*, sites_tb.* FROM customers_tb, sites_tb WHERE customers_tb.customer_id = sites_tb.customer_id AND sites_tb.site_id = '$site_id'")->result_array();
        return $result;
      }else if($site_id === ''){        
        $result = $this->db->query("SELECT customers_tb.*, sites_tb.* FROM customers_tb, sites_tb WHERE customers_tb.customer_id = sites_tb.customer_id")->result_array();
        return $result;
      }
    }

    // action may be 'new' or 'existing'
    public function save($action = '', $data = '', $site_id = ''){
      if($data !== '' && $action === 'new'){
        $result = $this->db->insert('sites_tb', $data);
        return $result;
      }else if($data !== '' && $action === 'existing' && $site_id !== ''){
        $result = $this->db->where('site_id', $site_id)->update('sites_tb', $data);
        return $result;
      }
    }
  }