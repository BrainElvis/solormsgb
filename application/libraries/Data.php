<?php

class Data {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
    }

    function get_api_status() {
        return $this->CI->session->userdata('status');
    }

    function set_api_status($status) {
        $this->CI->session->set_userdata('status', $status);
    }

    function clear_api_status() {
        $this->CI->session->unset_userdata('status');
    }

    function get_api_message() {
        return $this->CI->session->userdata('message');
    }

    function set_api_message($message) {
        $this->CI->session->set_userdata('message', $message);
    }

    function clear_api_message() {
        $this->CI->session->unset_userdata('message');
    }

    function get_rest_status() {
        return $this->CI->session->userdata('restaurant_status');
    }

    function set_rest_status($restaurant_status) {
        $this->CI->session->set_userdata('restaurant_status', $restaurant_status);
    }

    function clear_rest_status() {
        $this->CI->session->unset_userdata('restaurant_status');
    }

    function get_rest_schedule() {
        if (!$this->CI->session->userdata('rest_schedule')) {
            $this->set_rest_status('');
        }

        return $this->CI->session->userdata('rest_schedule');
    }

    function set_rest_schedule($rest_schedule) {
        $this->CI->session->set_userdata('rest_schedule', $rest_schedule);
    }

    function clear_rest_schedule() {
        $this->CI->session->unset_userdata('rest_schedule');
    }

    function get_rest_promotion() {
        if (!$this->CI->session->userdata('rest_promotion'))
            $this->set_rest_promotion(array());

        return $this->CI->session->userdata('rest_promotion');
    }

    function set_rest_promotion($rest_promotion) {
        $this->CI->session->set_userdata('rest_promotion', $rest_promotion);
    }

    function clear_rest_promotion() {
        $this->CI->session->unset_userdata('rest_promotion');
    }

    function get_rest_vouchers() {
        if (!$this->CI->session->userdata('rest_vouchers'))
            $this->set_rest_vouchers(array());

        return $this->CI->session->userdata('rest_vouchers');
    }

    function set_rest_vouchers($rest_vouchers) {
        $this->CI->session->set_userdata('rest_vouchers', $rest_vouchers);
    }

    function clear_rest_vouchers() {
        $this->CI->session->unset_userdata('rest_vouchers');
    }

    function get_rest_info() {
        if (!$this->CI->session->userdata('rest_info'))
            $this->set_rest_info(array());

        return $this->CI->session->userdata('rest_info');
    }

    function set_rest_info($rest_info) {
        $this->CI->session->set_userdata('rest_info', $rest_info);
    }

    function clear_rest_info() {
        $this->CI->session->unset_userdata('rest_info');
    }

    function get_order_policy() {
        if (!$this->CI->session->userdata('order_policy'))
            $this->set_order_policy(array());

        return $this->CI->session->userdata('order_policy');
    }

    function set_order_policy($order_policy) {
        $this->CI->session->set_userdata('order_policy', $order_policy);
    }

    function clear_order_policy() {
        $this->CI->session->unset_userdata('order_policy');
    }

    function get_membership() {
        if (!$this->CI->session->userdata('membership'))
            $this->set_membership(array());

        return $this->CI->session->userdata('membership');
    }

    function set_membership($membership) {
        $this->CI->session->set_userdata('membership', $membership);
    }

    function clear_membership() {
        $this->CI->session->unset_userdata('membership');
    }

    public function get_pre_hide_status() {
        return $this->CI->session->userdata('pre_hide_status');
    }

    public function set_pre_hide_status($pre_hide_status) {
        return $this->CI->session->set_userdata('pre_hide_status', $pre_hide_status);
    }

    public function clear_pre_hide_status() {
        $this->CI->session->unset_userdata('pre_hide_status');
    }

    public function get_cuisines() {
        if (!$this->CI->session->userdata('cuisines'))
            $this->set_cuisines(array());

        return $this->CI->session->userdata('cuisines');
    }

    public function set_cuisines($cuisines) {
        $this->CI->session->set_userdata('cuisines', $cuisines);
    }

    public function clear_cuisines() {
        $this->CI->session->unset_userdata('cuisines');
    }

    public function get_deliverypolicy() {
        if (!$this->CI->session->userdata('deliverypolicy'))
            $this->set_deliverypolicy(array());

        return $this->CI->session->userdata('deliverypolicy');
    }

    public function set_deliverypolicy($deliverypolicy) {
        $this->CI->session->set_userdata('deliverypolicy', $deliverypolicy);
    }

    public function clear_deliverypolicy() {
        $this->CI->session->unset_userdata('deliverypolicy');
    }

    public function get_deliveryarea() {
        if (!$this->CI->session->userdata('deliveryarea'))
            $this->set_deliveryarea(array());

        return $this->CI->session->userdata('deliveryarea');
    }

    public function set_deliveryarea($deliveryarea) {
        $this->CI->session->set_userdata('deliveryarea', $deliveryarea);
    }

    public function clear_deliveryarea() {
        $this->CI->session->unset_userdata('deliveryarea');
    }

    public function get_delarea() {
        if (!$this->CI->session->userdata('delarea'))
            $this->set_delarea(array());

        return $this->CI->session->userdata('delarea');
    }

    public function set_delarea($delarea) {
        $this->CI->session->set_userdata('delarea', $delarea);
    }

    public function clear_delarea() {
        $this->CI->session->unset_userdata('delarea');
    }

    public function get_schedule() {
        if (!$this->CI->session->userdata('schedule'))
            $this->set_schedule(array());

        return $this->CI->session->userdata('schedule');
    }

    public function set_schedule($schedule) {
        $this->CI->session->set_userdata('schedule', $schedule);
    }

    public function clear_schedule() {
        $this->CI->session->unset_userdata('schedule');
    }

    public function get_categories() {
        if (!$this->CI->session->userdata('categories'))
            $this->set_categories(array());

        return $this->CI->session->userdata('categories');
    }

    public function set_categories($categories) {
        $this->CI->session->set_userdata('categories', $categories);
    }

    public function clear_categories() {
        $this->CI->session->unset_userdata('categories');
    }

    public function get_bases() {
        if (!$this->CI->session->userdata('bases'))
            $this->set_bases(array());

        return $this->CI->session->userdata('bases');
    }

    public function set_bases($bases) {
        $this->CI->session->set_userdata('bases', $bases);
    }

    public function clear_bases() {
        $this->CI->session->unset_userdata('bases');
    }

    public function get_selections() {
        if (!$this->CI->session->userdata('selections'))
            $this->set_selections(array());

        return $this->CI->session->userdata('selections');
    }

    public function set_selections($bases) {
        $this->CI->session->set_userdata('selections', $bases);
    }

    public function clear_selections() {
        $this->CI->session->unset_userdata('selection_category');
    }

    public function get_selection_category() {
        if (!$this->CI->session->userdata('selection_category'))
            $this->set_selection_category(array());

        return $this->CI->session->userdata('selection_category');
    }

    public function set_selection_category($selection_category) {
        $this->CI->session->set_userdata('selection_category', $selection_category);
    }

    public function clear_selection_category() {
        $this->CI->session->unset_userdata('selections');
    }

    public function get_selcategory() {
        if (!$this->CI->session->userdata('selcategory'))
            $this->set_selcategory(array());

        return $this->CI->session->userdata('selcategory');
    }

    public function set_selcategory($selcategory) {
        $this->CI->session->set_userdata('selcategory', $selcategory);
    }

    public function clear_selcategory() {
        $this->CI->session->unset_userdata('selcategory');
    }

    public function get_cities() {
        if (!$this->CI->session->userdata('cities'))
            $this->set_cities(array());

        return $this->CI->session->userdata('cities');
    }

    public function set_cities($cities) {
        $this->CI->session->set_userdata('cities', $cities);
    }

    public function clear_cities() {
        $this->CI->session->unset_userdata('cities');
    }

    public function get_areas() {
        if (!$this->CI->session->userdata('areas'))
            $this->set_areas(array());

        return $this->CI->session->userdata('areas');
    }

    public function set_areas($areas) {
        $this->CI->session->set_userdata('areas', $areas);
    }

    public function clear_areas() {
        $this->CI->session->unset_userdata('areas');
    }

    public function get_policy() {
        if (!$this->CI->session->userdata('policy'))
            $this->set_policy(array());

        return $this->CI->session->userdata('policy');
    }

    public function set_policy($policy) {
        $this->CI->session->set_userdata('policy', $policy);
    }

    public function clear_policy() {
        $this->CI->session->unset_userdata('policy');
    }

    public function get_globaldiscount() {
        if (!$this->CI->session->userdata('globaldiscount'))
            $this->set_globaldiscount(array());

        return $this->CI->session->userdata('globaldiscount');
    }

    public function set_globaldiscount($globaldiscount) {
        $this->CI->session->set_userdata('globaldiscount', $globaldiscount);
    }

    public function clear_globaldiscount() {
        $this->CI->session->unset_userdata('globaldiscount');
    }

    public function get_menu_attributes_collection() {
        if (!$this->CI->session->userdata('menu_attributes_collection'))
            $this->set_menu_attributes_collection(array());

        return $this->CI->session->userdata('menu_attributes_collection');
    }

    public function set_menu_attributes_collection($menu_attributes_collection) {
        $this->CI->session->set_userdata('menu_attributes_collection', $menu_attributes_collection);
    }

    public function clear_menu_attributes_collection() {
        $this->CI->session->unset_userdata('menu_attributes_collection');
    }

    public function get_special_criteria_details() {
        if (!$this->CI->session->userdata('special_criteria_details'))
            $this->set_policy(array());

        return $this->CI->session->userdata('special_criteria_details');
    }

    public function set_special_criteria_details($special_criteria_details) {
        $this->CI->session->set_userdata('special_criteria_details', $special_criteria_details);
    }

    public function clear_special_criteria_details() {
        $this->CI->session->unset_userdata('special_criteria_details');
    }

    public function get_menu_base() {
        if (!$this->CI->session->userdata('menu_base'))
            $this->set_menu_base(array());

        return $this->CI->session->userdata('menu_base');
    }

    public function set_menu_base($menu_base) {
        $this->CI->session->set_userdata('menu_base', $menu_base);
    }

    public function clear_menu_base() {
        $this->CI->session->unset_userdata('menu_base');
    }

    public function get_menu_selection() {
        if (!$this->CI->session->userdata('menu_selection'))
            $this->set_menu_selection(array());

        return $this->CI->session->userdata('menu_selection');
    }

    public function set_menu_selection($menu_selection) {
        $this->CI->session->set_userdata('menu_selection', $menu_selection);
    }

    public function clear_menu_selection() {
        $this->CI->session->unset_userdata('menu_selection');
    }

    public function get_menu_attributes_configuration() {
        if (!$this->CI->session->userdata('menu_attributes_configuration'))
            $this->set_menu_attributes_configuration(array());
        return $this->CI->session->userdata('menu_attributes_configuration');
    }

    public function set_menu_attributes_configuration($menu_attributes_configuration) {
        $this->CI->session->set_userdata('menu_attributes_configuration', $menu_attributes_configuration);
    }

    public function clear_menu_attributes_configuration() {
        $this->CI->session->unset_userdata('menu_attributes_configuration');
    }

    public function get_raw_openingtime() {
        if (!$this->CI->session->userdata('raw_openingtime'))
            $this->set_raw_openingtime(array());

        return $this->CI->session->userdata('raw_openingtime');
    }

    public function set_raw_openingtime($raw_openingtime) {
        $this->CI->session->set_userdata('raw_openingtime', $raw_openingtime);
    }

    public function clear_raw_openingtime() {
        $this->CI->session->unset_userdata('raw_openingtime');
    }

    public function get_rest_service() {
        if (!$this->CI->session->userdata('rest_service'))
            $this->set_rest_service(array());
        return $this->CI->session->userdata('rest_service');
    }

    public function set_rest_service($rest_service) {
        $this->CI->session->set_userdata('rest_service', $rest_service);
    }

    public function clear_rest_service() {
        $this->CI->session->unset_userdata('rest_service');
    }

    public function get_rest_fees_commission() {
        if (!$this->CI->session->userdata('rest_fees_commission'))
            $this->set_rest_fees_commission(array());
        return $this->CI->session->userdata('rest_fees_commission');
    }

    public function set_rest_fees_commission($rest_fees_commission) {
        $this->CI->session->set_userdata('rest_fees_commission', $rest_fees_commission);
    }

    public function clear_rest_fees_commission() {
        $this->CI->session->unset_userdata('rest_fees_commission');
    }

    function clear_home_session() {
        $this->clear_rest_promotion();
        $this->clear_rest_vouchers();
        $this->clear_rest_status();
        $this->clear_rest_schedule();
    }

    function clear_menupage_session() {
        $this->clear_api_status();
        $this->clear_api_message();
        $this->clear_rest_status();
        $this->clear_rest_info();
        $this->clear_order_policy();
        $this->clear_membership();
        $this->clear_pre_hide_status();
        $this->clear_cuisines();
        $this->clear_deliverypolicy();
        $this->clear_deliveryarea();
        $this->clear_delarea();
        $this->clear_categories();
        $this->clear_bases();
        $this->clear_selections();
        $this->clear_cities();
        $this->clear_areas();
        $this->clear_policy();
        $this->clear_globaldiscount();
        $this->clear_menu_base();
        $this->clear_menu_selection();
        $this->clear_menu_attributes_collection();
        $this->clear_menu_attributes_configuration();
        $this->clear_special_criteria_details();
        $this->clear_rest_service();
        $this->clear_rest_fees_commission();
    }

}
