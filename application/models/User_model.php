<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class User_model extends CI_Model{
    
    public function resolve_login($username, $password){
      
      $this->db->select("password");
      $this->db->from("users_tb");
      $this->db->where('username', $username);
      
      $passwordHased = $this->db->get()->row("password");
      
      if (! empty($passwordHased)) {
          if (password_verify($password, $passwordHased)) {                
              return true;
          } else {                
              return false;
          }
      }else{
          return false;
      }
    }

    public function get_user_by_key($key, $value){
        
        $this->db->select('*');
        $this->db->from('users_tb');
        $this->db->where($key, $value);            
        $this->db->limit(1);
        $query = $this->db->get();

        $result = $query->result_array();

        return $result; 
    }

    public function user_auth($page_name = "", $access_auth = ""){
        if($page_name !== ""){
            // if page name is 'login' and session variable exist then redirect to dashboard page
            if($page_name == 'login'){
                if($this->session->logged_in === TRUE && !empty($this->session->username)){
                    redirect('dashboard');
                }
            }else if($page_name == 'ajax'){
                if($access_auth == FALSE && $this->session->logged_in !== TRUE && empty($this->session->username)){
                    redirect('logout');
                }
            }else if($page_name == 'page_auth'){
                if ($this->session->logged_in !== TRUE && empty($this->session->username)){
                    redirect('logout');
                }
            }
        }
    }
  }