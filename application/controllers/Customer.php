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
        $this->template->set_layout('public');
        $this->site_title = 'Solo Rms';
    }

    public function index() {
        $this->page_title = 'Dashboard';
        $this->current_section = "My Dashboard";
        $this->body_class[] = 'customer-dashboard';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('customer/index');
    }

    public function addressbook() {
        $this->page_title = 'Dashboard';
        $this->current_section = "My Address Book";
        $this->body_class[] = 'customer-dashboard address-book';
        $this->page_meta_keywords = 'Online,order, Restaurant';
        $this->page_meta_description = 'Online Order at Restaurant';
        $this->render_page('customer/addressbook');
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
        $this->page_title = 'Dashboard';
        $this->current_section = "Logout";
        $this->body_class[] = 'customer-dashboard logout';
        $this->render_page('customer/logout');
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
