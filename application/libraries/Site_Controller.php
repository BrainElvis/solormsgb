<?php
class Site_Controller extends MY_Controller {
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
        'font-awesome.min.css',
        'style.css',
        'responsive.css',
    );
    public $assets_js = array(
        'jquery.js',
        'bootstrap.min.js',
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
                $this->template->append_metadata('<link rel="stylesheet" type="text/css" href="' . ASSETS_SITE_CSS_PATH . $asset . '" media="screen" />');
        }

        // Webkit based browsers
        $this->template->append_metadata('<link rel="stylesheet" type="text/css" href="' . ASSETS_SITE_CSS_PATH . 'cross_browser/webkit.css" media="screen" />');
        // Internet Explorer styles
        $this->template->append_metadata('<!--[if IE 6]><link rel="stylesheet" type="text/css" href="' . $this->config->item('base_url') . 'assets/site/css/cross_browser/ie6.css" media="screen" /><![endif]-->');
        $this->template->append_metadata('<!--[if IE 7]><link rel="stylesheet" type="text/css" href="' . $this->config->item('base_url') . 'assets/site/css/cross_browser/ie7.css" media="screen" /><![endif]-->');
        $this->template->append_metadata('<!--[if IE 8]><link rel="stylesheet" type="text/css" href="' . $this->config->item('base_url') . 'assets/site/css/cross_browser/ie8.css" media="screen" /><![endif]-->');
        $this->template->append_metadata('<!--[if IE 9]><link rel="stylesheet" type="text/css" href="' . $this->config->item('base_url') . 'assets/site/css/cross_browser/ie9.css" media="screen" /><![endif]-->');
    }
    /**
     * Set Javascript Meta
     */
    private function set_javascript() {
        if (count($this->assets_js) > 0) {
            foreach ($this->assets_js as $asset)
                if (stristr($asset, 'http') === FALSE)
                    $this->template->append_metadata('<script type="text/javascript" src="' . ASSETS_SITE_JS_PATH . $asset . '"></script>');
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
                ->set('current_section', $this->current_section)
                ->set('body_class', implode(' ', $this->body_class));
        $this->template
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        // Renders the main layout
        $this->template->build($page, $data);
    }
}