<?php    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    function random_key($length = ""){
        if($length !== ""){
            $key = openssl_random_pseudo_bytes(25);
            $key = bin2hex($key);
            $keyLength = strlen($key);
            
            if($keyLength/2 > $length){
                $key = substr($key, $keyLength/2, $length);                
            }else{
                $key = substr($key, 0, $length);
            }
            $key = strtolower($key);

            return $key;
        }else{
            $key = openssl_random_pseudo_bytes(25);
            $key = bin2hex($key);
            $keyLength = strlen($hex);
            $key = substr($key,$keyLength/2, 6);
            $key = strtolower($key);
            
            return $key;
        }
    }