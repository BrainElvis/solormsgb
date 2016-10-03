<?php

class Admin_Controller extends MY_Controller {

    public $admin_info;

    /**
     * Site Title
     * 
     * @var string
     */
    public $site_title = '';

    /**
     * Page Title
     * 
     * @var string
     */
    public $page_title = '';

    /**
     * Page Meta Keywords
     * 
     * @var string
     */
    public $page_meta_keywords = '';

    /**
     * Page Meta Description
     * 
     * @var string
     */
    public $page_meta_description = '';

    /**
     * JS Calls on DOM Ready
     * 
     * @var array 
     */
    public $assets_css = array(
        'bootstrap.min.css',
        'animate.min.css',
        'opensourcepos.min.css',
        'custom.css',
        'style.css',
      
    );
    public $assets_js = array(
        'opensourcepos.js',
        'jquery.nicescroll.min.js',
        'custom.js',
    );
    public $js_domready = array();

    /**
     * JS Calls on window load
     * 
     * @var array 
     */
    public $js_windowload = array();

    /**
     * Body classes
     * 
     * @var array 
     */
    public $body_class = array();

    /**
     * Current section
     * 
     * @var string
     */
    public $current_section = '';

    /**
     * Class Constructor
     */
    public function __construct() {
        // Call Parent Constructor
        parent::__construct();
        $this->load->model('Login_model');
        if (!$this->Login_model->is_logged_in()) {
            redirect('admin/login');
        }
        $this->admin_info = $this->Login_model->get_logged_in_admin_info();

        $this->template->set_layout('admin');
        // Site Page Title
        $this->site_title = $this->config->item('app_title');
    }

    /**
     * Prepare BASE Javascript
     */
    private function prepare_base_javascript() {
        $str = "<script type=\"text/javascript\">\n";

        if (count($this->js_domready) > 0) {
            $str.= "$(document).ready(function() {\n";
            $str.= implode("\n", $this->js_domready) . "\n";
            $str.= "});\n";
        }

        if (count($this->js_windowload) > 0) {
            $str.= "$(window).load(function() {\n";
            $str.= implode("\n", $this->js_windowload) . "\n";
            $str.= "});\n";
        }

        $str.= "</script>\n";
        $this->template->append_metadata($str);
    }

    /**
     * Set CSS Meta
     */
    private function set_styles() {
        if (count($this->assets_css) > 0) {
            foreach ($this->assets_css as $asset)
                $this->template->append_metadata('<link rel="stylesheet" type="text/css" href="' . ASSETS_ADMIN_CSS_PATH . $asset . '" media="screen" />');
        }
        $this->template->append_metadata('<link rel="stylesheet" type="text/css" href="' . ASSETS_ADMIN_FONTS_PATH . 'css/font-awesome.min.css" media="screen" />');
    }

    /**
     * Set Javascript Meta
     */
    private function set_javascript() {
        if (count($this->assets_js) > 0) {
            foreach ($this->assets_js as $asset)
                if (stristr($asset, 'http') === FALSE)
                    $this->template->append_metadata('<script type="text/javascript" src="' . ASSETS_ADMIN_JS_PATH . $asset . '"></script>');
                else
                    $this->template->append_metadata('<script type="text/javascript" src="' . $asset . '"></script>');
        }
        $this->template->append_metadata('<!--[if lt IE 9]><script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->');
    }

    /**
     * Renders page
     */
    public function render_page($page, $data = array()) {
        // Renders the whole page
        $this->template
                ->set_metadata('keywords', $this->page_meta_keywords)
                ->set_metadata('description', $this->page_meta_description)
                ->set_metadata('canonical', site_url($this->uri->uri_string()), 'link')
                ->title($this->page_title, $this->site_title);
        $this->set_styles();
        $this->set_javascript();
        $this->prepare_base_javascript();
        // Set global template vars
        $this->template
                ->set('admin', ($this->admin_info->description) ? $this->admin_info->description : $this->admin_info->username)
                ->set('current_section', $this->current_section)
                ->set('body_class', implode(' ', $this->body_class));

        $this->template
                //->set_partial('flash_messages', 'partials/flash_messages')
                ->set_partial('header', 'admin/partials/header')
                ->set_partial('footer', 'admin/partials/footer')
                ->set_partial('notification', 'admin/partials/notification');
        // Renders the main layout
        $this->template->build($page, $data);
    }

}
