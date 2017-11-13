<?php    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    /**
     * [Clean user inputs]
     * 
     * @param  [string] $data   [data which will required to clean]
     * @return [string]         [cleaned data for further process]
     */
    function clean_input($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strtolower($data); // it might harmful for you.        
        
        return $data;
    }