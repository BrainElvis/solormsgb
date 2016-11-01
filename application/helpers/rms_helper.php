<?php

function debugPrint($object, $title = "", $isMarkup = false) {
    echo '<font color="red">Debug <<< START';
    if (!empty($title)) {
        echo "$title: ";
    }
    if ($isMarkup == false) {
        echo "<pre>";
        print_r($object);
        echo "</pre>";
    }
    else {
        echo htmlspecialchars($object);
    }
    echo 'END >>></font>';
}

if (!function_exists('objectToArray')) {

    function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }

}
if (!function_exists('get_mails')) {

    function get_mails() {
        $CI = & get_instance();
        $CI->db->limit(10);
        $CI->db->order_by('id', 'DESC');
        return $CI->db->get('contact')->result();
    }

}

function show_date($date, $time_stamp = false, $format = "d/m/Y") {
    if ($time_stamp) {
        return date($format, $date);
    }
    else {
        return date($format, strtotime($date));
    }
}

function get_city_name($id) {
    $CI = & get_instance();
    $cities = $CI->session->userdata('cities');
    foreach ($cities as $city) {
        if ($city->CityId == $id) {
            return $city->CityName;
        }
    }
}

function get_area_name($id) {
    $CI = & get_instance();
    $areas = $CI->session->userdata('areas');
    foreach ($areas as $area) {
        if ($area->AreaId == $id) {
            return $area->AreaName;
        }
    }
}
if (!function_exists('order_id')) {

    function order_id($id) {
        return sprintf("%06s", $id);
    }

}