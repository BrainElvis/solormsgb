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
    } else {
        echo htmlspecialchars($object);
    }
    echo 'END >>></font>';
}

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
    } else {
        // Return array
        return $d;
    }
}

function array_filter_recursive($input) {
    foreach ($input as &$value) {
        if (is_array($value)) {
            $value = array_filter_recursive($value);
        }
    }
    return array_filter($input);
}
function base_special_criteria($BaseId){
    $CI= &get_instance();
    return $CI->Orderonline_Model->get_special_criteria($BaseId);
}
