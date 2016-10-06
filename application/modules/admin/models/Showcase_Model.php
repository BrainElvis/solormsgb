<?php
class Showcase_Model extends MY_Model {
    function __construct() {
        parent::__construct();
        $this->_table_name="gallery_images";
    }
}
