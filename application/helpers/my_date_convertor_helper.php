<?php

    // function convert system date and time into user readable date and time
    // output 3rd Augest 2017 02:39:04 PM
    function user_datetime_convert($date){
        $date = strtotime($date);
        $date =  date('jS F Y h:i:s A', $date);
        return $date;
    }

    // function to convert user readable date and time into system date and time
    // output 2017-08-03 14:39:04
    function system_datetime_convert($date){
        $date = strtotime($date);
        $date =  date('Y-m-d H:i:s', $date);
        return $date;
    }

    // function convert system only date into user readable date
    // output 4th August 2017
    function user_date_convert($date){
        $date = strtotime($date);
        $date =  date('jS F Y', $date);
        return $date;
    }

    // function to convert user readable only date into system date
    // output 2017-08-03
    function system_date_convert($date){
        $date = strtotime($date);
        $date =  date('Y-m-d', $date);
        return $date;
    }

    function user_date_month_convert($date){
        $date = strtotime($date);
        $date =  date('jS F', $date);
        return $date;
    }
?>