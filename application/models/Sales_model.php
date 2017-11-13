<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Sales_model extends CI_Model{
    
    public function retrieve($action = '', $sales_invoice_id = ''){
      if($action !== '' && $sales_invoice_id === ''){
        if($action === 'SALES_INVOICE_DATA'){
          $result = $this->db->get('sales_invoices_tb')->result_array();          
        }else if($action === 'SALES_INVOICE_ITEM_DATA'){
          $result = $this->db->get('sales_invoice_items_tb')->result_array();          
        }

      }else if($sales_invoice_id !== ''){
        $result = $this->db->query("SELECT sales_invoices_tb.*, sales_invoice_items_tb.* FROM sales_invoices_tb, sales_invoice_items_tb WHERE sales_invoices_tb.sales_invoice_system_id = sales_invoice_items_tb.sales_invoice_system_id AND sales_invoices_tb.sales_invoice_system_id= '$sales_invoice_id' ")->result_array();
      }
      
      return $result;
    }
  }