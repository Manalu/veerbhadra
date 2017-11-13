<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Work_order_model extends CI_Model{

    public function retrieve($action = '', $work_order_id = ''){
      if($work_order_id !== '' && $action !== ''){
        
        if($action === 'WORK_ORDER_DATA'){
          $result = $this->db->query("SELECT work_orders_tb.*, sites_tb.* FROM work_orders_tb, sites_tb WHERE sites_tb.site_id = work_orders_tb.site_id AND work_orders_tb.work_order_id = '$work_order_id'")->result_array();
        }else if($action === 'WORK_ORDER_LIST_DATA'){
          $result = $this->db->query("SELECT work_order_items_tb.*, work_orders_tb.* FROM work_order_items_tb, work_orders_tb WHERE work_order_items_tb.work_order_id = work_orders_tb.work_order_id AND work_order_items_tb.`work_order_id` = '$work_order_id'")->result_array();
          
        }
        
        return $result;
      }else if($work_order_id === ''){
        $result = $this->db->query("SELECT work_orders_tb.*, sites_tb.* FROM work_orders_tb, sites_tb WHERE sites_tb.site_id = work_orders_tb.site_id")->result_array();
        return $result;
      }
    }

    public function save($action = '', $row_count = '', $work_order = '', $work_order_item = ''){
      if($action === 'new' && $work_order !== '' && $work_order_item !== ''){
        $result = $this->db->insert('work_orders_tb', $work_order);
        if($this->db->affected_rows() > 0){
          $work_order_id = $this->db->insert_id();

          for($i=0; $i < $row_count; $i++){
            $data[] = array(
              'work_order_id' => $work_order_id,
              'work_order_item_flat_number' => $work_order_item['work_order_item_flat_number'][$i],
              'work_order_item_desc' => $work_order_item['work_order_item_desc'][$i],
              'work_order_item_quantity' => $work_order_item['work_order_item_quantity'][$i],
              'work_order_item_unit' => $work_order_item['work_order_item_unit'][$i],
              'work_order_item_rate' => $work_order_item['work_order_item_rate'][$i],
              'work_order_item_amount' => $work_order_item['work_order_item_amount'][$i]
            );
          }          
            $result = $this->db->insert_batch('work_order_items_tb', $data);           
        }else{
          $result = false;          
        }
        return $result;
      }else if($action === 'existing' && $work_order !== '' && $work_order_item !== ''){
        
        for($i=0; $i < $row_count; $i++){
          $data[] = array(
            'work_order_id' => $work_order_item['work_order_id'][$i],            
            'work_order_item_flat_number' => $work_order_item['work_order_item_flat_number'][$i],
            'work_order_item_desc' => $work_order_item['work_order_item_desc'][$i],
            'work_order_item_quantity' => $work_order_item['work_order_item_quantity'][$i],
            'work_order_item_unit' => $work_order_item['work_order_item_unit'][$i],
            'work_order_item_rate' => $work_order_item['work_order_item_rate'][$i],
            'work_order_item_amount' => $work_order_item['work_order_item_amount'][$i]
          );
        } 

        $result = $this->db->delete('work_order_items_tb', array( 'work_order_id'=> $data[0]['work_order_id']));

        if($result === TRUE){
          $result = $this->db->insert_batch('work_order_items_tb', $data);
        }else{
          echo 'blackhole';
        }

        return $result;
      }
    }
  
  }
