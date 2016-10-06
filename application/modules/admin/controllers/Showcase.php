<?php

class Showcase extends Admin_Controller {

    private $storeFolder = 'uploads\/gallery\/';

    function __construct() {
        parent::__construct('config');
        $this->site_title = 'Solo Rms';
        $this->load->model('Showcase_Model');
        //array_push($this->assets_css, '',);
        array_push($this->assets_js, 'dropzone/dropzone.js');
    }

    public function index() {
        $this->page_title = 'Dashboard';
        $this->current_section = "Gallery";
        $this->body_class[] = 'dashboard-gallery';
        $data['gallery_images'] = $this->Showcase_Model->get_by(array('deleted' => 0, 'status' => 1));
        $this->render_page('admin/showcase/index', $data);
    }

    public function save_gallery() {

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $this->storeFolder;
            $file_name = $_FILES['file']['name'];
            $targetFile = $targetPath . $file_name;
            $upload_success = move_uploaded_file($tempFile, $targetFile);
            $result = $this->Showcase_Model->save(array('name' => $file_name, 'deleted' => '0', 'status' => '1'));
            $success = $upload_success && $result ? true : false;
            $message = $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully');
            echo json_encode(array('success' => $success, 'message' => $message));
        }
    }

    public function delete_image() {
        $id = $this->input->post('id');
        if ($this->delete_image_data($id, 'gallery_images', 'uploads/gallery/')) {
            echo json_encode(array('success' => true, 'message' => 'Gallery Image deleted Successfuly'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Sorry Thre is an error to delete image deleted '));
        }
    }

    function delete_image_data($id, $table, $path) {
        $query = $this->db->get_where($table, array('id' => $id));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $picture = $row->name;
            unlink(realpath($path . $picture));
            $this->db->delete('gallery_images', array('id' => $id));
            return true;
        }
        return false;
    }

}
