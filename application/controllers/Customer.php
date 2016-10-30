<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author Md.Aktaruzzaman
 */
class Customer extends Site_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->isLogedIn()) {
            redirect(base_url());
        }
        $this->load->model('Customer_Model');
        $this->load->model('User_Model');
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
        $this->load->model('Apimodel');
    }

    public function isLogedIn() {
        if ($this->session->userdata('CustId')) {
            return true;
        }
        else {
            return false;
        }
    }

    public function index() {
        $this->page_title = 'Dashboard';
        $this->current_section = "My Dashboard";
        $this->body_class[] = 'customer-dashboard';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $customer = $this->Customer_Model->get($this->session->userdata('CustId'));
        $this->render_page('customer/index', $customer);
    }

    public function addressbook($caid = '') {
        $this->page_title = 'Dashboard';
        $this->current_section = "My Address Book";
        $this->body_class[] = 'customer-dashboard address-book';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $user_id = $data['customer'] = $this->session->userdata('CustId');
        $customer_info = objectToArray($this->Customer_Model->get($user_id));
        $data['customer_info'] = $customer_info;
        $data['customer_info2'] = $customer_info;
        $cities = $this->session->userdata('cities');
        $areas = $this->session->userdata('areas');
        $cityList = array();
        $areaList = array();
        foreach ($cities as $city) {
            //get the city list 
            $cityList[$city->CityId] = $city->CityName;
            //get areas for that city 
            $city_areas = array();
            foreach ($areas as $ad) {
                if ($city->CityId == $ad->CityId) {
                    $city_areas [] = $ad;
                }
            }

            if (!empty($city_areas)) {
                foreach ($city_areas as $key => $value) {
                    $areaList[$city->CityId][$value->AreaId] = $value->AreaName;
                }
                $city_areas = array();
            }
        }
        $data['cities'] = $cityList;
        $data['areas'] = $areaList;


        if ($this->uri->segment(4) != NULL) {
            $id = $this->uri->segment(4);
            $PrevData = $this->db->get_where('customer_address', array('CustAddId' => $id))->row_array();
            if (!empty($PrevData)) {
                $PrevData['CustEmail'] = $customer_info['CustEmail'];
                $deleteRemote = $this->Apimodel->delete_address($PrevData);
                $this->Customer_Model->deleteCustomerAdd($PrevData);
            }
            redirect("customer/addressbook");
        }
        $data['cust_address'] = objectToArray($this->Customer_Model->get_customeraddress($user_id));
        if ($caid == "") {
            $data['address_action'] = "Create New Address";
            $data['edit_address'] = NULL;
            $data['addid'] = "";
        }
        else {
            $data['address_action'] = "Update Your Address";
            if ($caid == "Primary") {
                $data['edit_address'] = objectToArray($this->Customer_Model->get_primary_address($user_id));
                $data['addid'] = "Primary";
            }
            else {
                $data['edit_address'] = objectToArray($this->Customer_Model->get_customeraddress_by_CustAddId($caid));
                $data['addid'] = $caid;
            }
        }
        //debugPrint($data);
        $this->render_page('customer/addressbook', $data);
    }

    function saveaddress($id = '') {
        $user_id = $data['customer'] = $this->session->userdata('CustId');
        $customer_info = $this->Customer_Model->get_primary_address($user_id);
        $custid = $customer_info[0]->CustId;
        if ($this->input->post('as_new_add') == "0" && $this->input->post('customers_add_label') == 'Primary') {
            $address_data = array(
                "CustAdd1" => $this->input->post('customers_address1'),
                "CustAdd2" => $this->input->post('customers_address2'),
                "CustTown" => html_entity_decode($this->input->post('customers_town')),
                "CustState" => '',
                "CustTelephone" => $this->input->post('phone'),
                "CustPostcode" => $this->input->post('customers_postcode1') . ' ' . $this->input->post('customers_postcode2'),
                "CustArea" => $this->input->post('cust_area'),
                "CustAddLabel" => "Primary"
            );
            $this->db->where('CustId', $custid);
            $this->db->update('customers', $address_data);
            $address_data['CustEmail'] = $customer_info[0]->CustEmail;
            $UpdateRemote = $this->Apimodel->update_primary_address($address_data);
            $this->session->set_flashdata('addmsg', '<strong class="successMessage">' . $this->lang->line('update_success_msg') . '</strong>');
            redirect("customer/addressbook");
        }
        $address_data = array(
            "CustId" => $custid,
            "CustFirstName" => $customer_info[0]->CustFirstName,
            "CustLastName" => $customer_info[0]->CustLastName,
            "CustAdd1" => $this->input->post('customers_address1'),
            "CustAdd2" => $this->input->post('customers_address2'),
            "CustTown" => html_entity_decode($this->input->post('customers_town')),
            "CustPhone" => $this->input->post('phone'),
            "CustPostcode" => $this->input->post('customers_postcode1') . ' ' . $this->input->post('customers_postcode2'),
            "CustArea" => $this->input->post('cust_area'),
            "CustAddLabel" => $this->input->post('customers_add_label')
        );

        if ($this->input->post('as_new_add') == "1") {
            $query = $this->Customer_Model->saveCustomerAdd($address_data);
            $address_data['CustEmail'] = $customer_info[0]->CustEmail;
            $addRemoteAddress = $this->Apimodel->add_address($address_data);
            if ($query) {
                $this->session->set_flashdata('addmsg', '<strong class="successMessage">' . $this->lang->line('insert_success_msg') . '</strong>');
                redirect("customer/addressbook");
            }
        }
        else {
            $query = $this->Customer_Model->updateCustomerAdd($address_data, $id);
            $address_data['CustEmail'] = $customer_info[0]->CustEmail;
            $address_data['PrevCustAddLabel'] = $this->input->post('PrevCustAddLabel');
            $updateRemoteAddress = $this->Apimodel->update_address($address_data);
            if ($query) {
                $this->session->set_flashdata('addmsg', '<strong class="successMessage">' . $this->lang->line('update_success_msg') . '</strong>');
                redirect("customer/addressbook");
            }
        }
    }

    public function changepass() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Change Password";
        $this->body_class[] = 'customer-dashboard address-book';
        $this->render_page('customer/changepass');
    }

    public function profile() {
        $this->page_title = 'Dashboard';
        $this->current_section = "My Profile";
        $this->body_class[] = 'customer-dashboard edit-profile';
        $this->render_page('customer/profile');
    }

    public function editprofile() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Edit Profile";
        $this->body_class[] = 'customer-dashboard edit-profile';
        $this->render_page('customer/editprofile');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

    public function cart() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Customer Cart";
        $this->body_class[] = 'customer-dashboard customer-cart';
        $this->render_page('customer/cart');
    }

    public function orderlist() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Customer Orderlist";
        $this->body_class[] = 'customer-dashboard customer-orderlist';
        $this->render_page('customer/orderlist');
    }

    public function orderreview() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Customer Order REview";
        $this->body_class[] = 'customer-dashboard customer-order-review';
        $this->render_page('customer/orderreview');
    }

    public function pointshop() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Customer Point Shop";
        $this->body_class[] = 'customer-dashboard customer-point-shop';
        $this->render_page('customer/pointshop');
    }

    public function tellurfriend() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Tell Your Firend";
        $this->body_class[] = 'customer-dashboard customer-tell-ur-friend';
        $this->render_page('customer/tellurfriend');
    }

    public function custaffiliate() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Tell Your Firend";
        $this->body_class[] = 'customer-dashboard customer-tell-ur-friend';
        $this->render_page('customer/custaffiliate');
    }

    public function favourits() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Customer Favourits";
        $this->body_class[] = 'customer-dashboard customer-favourits';
        $this->render_page('customer/favourits');
    }

}
