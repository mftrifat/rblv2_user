<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelStatus");
    }

    function uploaded_accounts() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Uploaded Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'status/uploaded_account_view_script');
            $this->template->set('page_style', 'status/uploaded_account_view_style');

            $user_id = $this->session->userdata('user_id');
            
            if ($this->session->userdata('user_access_level') == 1) {
                $data['category_list'] = $this->ModelCommon->get_category();
                if(!empty($_POST)){
                    $data['all_accounts'] = $this->ModelStatus->all_accounts($_POST['sub_category_id'], $user_id);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
            } else {
                echo "Access Denied";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'status/uploaded_account_view', $data);
    }

    function rejected_accounts() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Rejected Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'status/rejected_account_view_script');
            $this->template->set('page_style', 'status/rejected_account_view_style');

            $user_id = $this->session->userdata('user_id');


            if ($this->session->userdata('user_access_level') == 1) {
                $data['category_list'] = $this->ModelCommon->get_category();
                if(!empty($_POST)){
                    $data['rejected_accounts'] = $this->ModelStatus->rejected_accounts($_POST['sub_category_id'], $user_id);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
            } else {
                echo "Access Denied";
                redirect('logout');
            }
        } else {
            redirect('Home');            
        }
        $this->template->load('default_layout', 'contents' , 'status/rejected_account_view', $data);
    }
}