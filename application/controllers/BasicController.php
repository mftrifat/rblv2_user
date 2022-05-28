<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BasicController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
    }

    function ajaxRequestGetSubCategory($id)
    {
        $data = $this->ModelCommon->get_sub_category($id);
        echo json_encode($data);
    }

    function ajaxRequestGetTemplateInfo($id)
    {
        $data = $this->ModelCommon->get_template_info($id);
        echo json_encode($data);
    }

    function ajaxRequestGetFieldInfo($id)
    {
        $data = $this->ModelCommon->get_field_info($id);
        echo json_encode($data);
    }

    function ajaxRequestGetLoadEmail($id)
    {
        $data = $this->ModelCommon->get_load_email_info($id);
        echo json_encode($data);
    }

    function ajaxRequestGetEmailDetails()
    {
        $user_id = $this->session->userdata('user_id');
        $data = $this->ModelCommon->get_email_info();
        foreach ($data as $row) {
            $this->ModelCommon->lock_email_info($row->id, $user_id);
        }
        echo json_encode($data);
    }
}