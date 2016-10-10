<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin_Controller {

    function __construct() {
        parent::__construct('config');
        $this->site_title = 'Solo Rms';
        //array_push($this->assets_css, 'maps/jquery-jvectormap-2.0.3.css','floatexamples.css');
        //array_push($this->assets_js, 'datepicker/daterangepicker.js');
    }

    public function index() {
        $this->page_title = 'Dashboard';
        $this->current_section = $this->lang->line('site_configuration_title');
        $this->body_class[] = 'admin-dashboard';
        $data['logo_exists'] = $this->Appconfig->get('company_logo') != '';
        $this->render_page('admin/config/index', $data);
    }

    function save_general() {
        $upload_success = $this->_handle_logo_upload();
        $upload_data = $this->upload->data();

        $batch_save_data = array(
            'company' => $this->input->post('company'),
            'vatreg' => $this->input->post('vatreg'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('website'),
            'return_policy' => $this->input->post('return_policy')
        );

        if (!empty($upload_data['orig_name'])) {
            $batch_save_data['company_logo'] = $upload_data['raw_name'] . $upload_data['file_ext'];
        }

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $upload_success && $result ? true : false;
        $message = $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully');
        $message = $upload_success ? $message : $this->upload->display_errors();
        echo json_encode(array('success' => $success, 'message' => $message));
    }

    function save_api() {
        $batch_save_data = array(
            'api_id' => $this->input->post('api_id'),
            'api_name' => $this->input->post('api_name'),
            'api_website' => $this->input->post('api_website'),
            'api_host' => $this->input->post('api_host'),
            'api_key' => $this->input->post('api_key'),
            'api_username' => $this->input->post('api_username'),
            'api_password' => $this->input->post('api_password'),
        );
        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;
        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_payment() {
        $batch_save_data = array(
            'payment_online' => $this->input->post('payment_online'),
            'payment_cod' => $this->input->post('payment_cod'),
            'payment_gateway' => $this->input->post('payment_gateway'),
            'payment_merchant_id' => $this->input->post('payment_merchant_id'),
            'payment_mode' => $this->input->post('payment_mode')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;
        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_locale() {
        $batch_save_data = array(
            'currency_symbol' => $this->input->post('currency_symbol'),
            'currency_side' => $this->input->post('currency_side') != null,
            'language' => $this->input->post('language'),
            'timezone' => $this->input->post('timezone'),
            'dateformat' => $this->input->post('dateformat'),
            'timeformat' => $this->input->post('timeformat'),
            'thousands_separator' => $this->input->post('thousands_separator'),
            'decimal_point' => $this->input->post('decimal_point'),
            'currency_decimals' => $this->input->post('currency_decimals'),
            'tax_decimals' => $this->input->post('tax_decimals'),
            'quantity_decimals' => $this->input->post('quantity_decimals')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_message() {
        $batch_save_data = array(
            'msg_msg' => $this->input->post('msg_msg'),
            'msg_uid' => $this->input->post('msg_uid'),
            'msg_pwd' => $this->input->post('msg_pwd'),
            'msg_src' => $this->input->post('msg_src')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function stock_locations() {
        $stock_locations = $this->Stock_location->get_all()->result_array();

        $this->load->view('partial/stock_locations', array('stock_locations' => $stock_locations));
    }

    function _clear_session_state() {
        $this->load->library('sale_lib');
        $this->sale_lib->clear_sale_location();
        $this->sale_lib->clear_all();
        $this->load->library('receiving_lib');
        $this->receiving_lib->clear_stock_source();
        $this->receiving_lib->clear_stock_destination();
        $this->receiving_lib->clear_all();
    }

    function save_locations() {
        $this->db->trans_start();

        $deleted_locations = $this->Stock_location->get_allowed_locations();
        foreach ($this->input->post() as $key => $value) {
            if (strstr($key, 'stock_location')) {
                $location_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
                unset($deleted_locations[$location_id]);
                // save or update
                $location_data = array('location_name' => $value);
                if ($this->Stock_location->save($location_data, $location_id)) {
                    $this->_clear_session_state();
                }
            }
        }

        // all locations not available in post will be deleted now
        foreach ($deleted_locations as $location_id => $location_name) {
            $this->Stock_location->delete($location_id);
        }

        $success = $this->db->trans_complete();

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_barcode() {
        $batch_save_data = array(
            'barcode_type' => $this->input->post('barcode_type'),
            'barcode_quality' => $this->input->post('barcode_quality'),
            'barcode_width' => $this->input->post('barcode_width'),
            'barcode_height' => $this->input->post('barcode_height'),
            'barcode_font' => $this->input->post('barcode_font'),
            'barcode_font_size' => $this->input->post('barcode_font_size'),
            'barcode_first_row' => $this->input->post('barcode_first_row'),
            'barcode_second_row' => $this->input->post('barcode_second_row'),
            'barcode_third_row' => $this->input->post('barcode_third_row'),
            'barcode_num_in_row' => $this->input->post('barcode_num_in_row'),
            'barcode_page_width' => $this->input->post('barcode_page_width'),
            'barcode_page_cellspacing' => $this->input->post('barcode_page_cellspacing'),
            'barcode_generate_if_empty' => $this->input->post('barcode_generate_if_empty') != null,
            'barcode_content' => $this->input->post('barcode_content')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_receipt() {
        $batch_save_data = array(
            'receipt_show_taxes' => $this->input->post('receipt_show_taxes') != null,
            'receipt_show_total_discount' => $this->input->post('receipt_show_total_discount') != null,
            'receipt_show_description' => $this->input->post('receipt_show_description') != null,
            'receipt_show_serialnumber' => $this->input->post('receipt_show_serialnumber') != null,
            'print_silently' => $this->input->post('print_silently') != null,
            'print_header' => $this->input->post('print_header') != null,
            'print_footer' => $this->input->post('print_footer') != null,
            'print_top_margin' => $this->input->post('print_top_margin'),
            'print_left_margin' => $this->input->post('print_left_margin'),
            'print_bottom_margin' => $this->input->post('print_bottom_margin'),
            'print_right_margin' => $this->input->post('print_right_margin')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    function save_homepage() {
        $batch_save_data = array(
            'home_slider' => $this->input->post('home_slider'),
            'home_weserve' => $this->input->post('home_weserve'),
            'home_menucarousel' => $this->input->post('home_menucarousel'),
            'home_ourfeatures' => $this->input->post('home_ourfeatures'),
            'home_testimonials' => $this->input->post('home_testimonials'),
            'home_promotime' => $this->input->post('home_promotime'),
            'online_book' => $this->input->post('online_book'),
            'online_review' => $this->input->post('online_review')
        );

        $result = $this->Appconfig->batch_save($batch_save_data);
        $success = $result ? true : false;

        echo json_encode(array('success' => $success, 'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')));
    }

    public function remove_logo() {
        $result = $this->Appconfig->batch_save(array('company_logo' => ''));

        echo json_encode(array('success' => $result));
    }

    private function _handle_logo_upload() {
        $this->load->helper('directory');

        // load upload library
        $config = array('upload_path' => './uploads/',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => '1024',
            'max_width' => '800',
            'max_height' => '680',
            'file_name' => 'company_logo');
        $this->load->library('upload', $config);
        $this->upload->do_upload('company_logo');

        return strlen($this->upload->display_errors()) == 0 || !strcmp($this->upload->display_errors(), '<p>' . $this->lang->line('upload_no_file_selected') . '</p>');
    }

    function backup_db() {
        $employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
        if ($this->Employee->has_module_grant('config', $employee_id)) {
            $this->load->dbutil();
            $prefs = array(
                'format' => 'zip',
                'filename' => 'sadia1_Sumonandbrothers'
            );

            $backup = & $this->dbutil->backup($prefs);

            $file_name = 'ospos-' . date("Y-m-d-H-i-s") . '.zip';
            $save = 'uploads/' . $file_name;
            $this->load->helper('download');
            while (ob_get_level()) {
                ob_end_clean();
            }
            force_download($file_name, $backup);
        } else {
            redirect('no_access/config');
        }
    }

}
