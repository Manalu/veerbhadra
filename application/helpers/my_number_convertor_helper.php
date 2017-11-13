<?php    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    function amount_format($data){
        $data = floatval($data);
        $data = number_format($data, 2, '.', '');
        
        return $data;
    }