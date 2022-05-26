<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelAccounts");
    }

    function add_account_single() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Add New Account - Single');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'account/add_account_single_view_script');
            $this->template->set('page_style', 'account/add_account_single_view_style');

            if($this->session->userdata('user_access_level') == 1) {
                if($this->input->post()) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('category_id','Category','trim|required');
                    $this->form_validation->set_rules('sub_category_id','Sub Category','trim|required');
                 
                    if($this->form_validation->run()==FALSE)
                    {
                        header("Access-Control-Allow-Origin: *");
                        $data = array();
                        $this->template->load('default_layout', 'contents' , 'account/add_account_single_view', $data);
                    } else {
                        $data = array();

                        foreach($this->input->post() as $key => $val) {
                            if($key != 'category_id' && $key != 'sub_category_id' && $key != 'submit') {
                                $field_name = "a_data_".substr($key, strpos($key, "_")-1, 1);
                                $data[$field_name] = $this->encryption->encrypt($val);
                            }
                        }
                        $data['category'] = $this->input->post('category_id');
                        $data['sub_category'] = $this->input->post('sub_category_id');
                        $data['id_input_user'] = $this->session->userdata('user_id');

                        if ($this->ModelAccounts->insert_new_account_action($data)) {
                            $sdata = array();
                            $sdata['msg'] = 'You have Successfully Inserted New Account.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                    }
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/add_account_single_view', $data);
    }

    function add_account_batch() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Add New Account - Batch');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'account/add_account_batch_view_script');
            $this->template->set('page_style', 'account/add_account_batch_view_style');

            if($this->session->userdata('user_access_level') == 1) {
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/add_account_batch_view', $data);
    }

    function edit_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Edit Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'account/account_edit_view_script');
            $this->template->set('page_style', 'account/account_edit_view_style');

            if ($this->session->userdata('user_access_level') == 1) {
                if($this->input->post()) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('category_id','Category','trim|required');
                    $this->form_validation->set_rules('sub_category_id','Sub Category','trim|required');
                    $this->form_validation->set_rules('edit_id','Id','trim|required');
                 
                    if($this->form_validation->run()==FALSE)
                    {
                        header("Access-Control-Allow-Origin: *");
                        $data = array();
                    } else {
                        $data = array();

                        foreach($this->input->post() as $key => $val) {
                            if($key != 'category_id' && $key != 'sub_category_id' && $key != 'submit' && $key != 'edit_id') {
                                $field_name = "a_data_".substr($key, strpos($key, "_")-1, 1);
                                $data[$field_name] = $this->encryption->encrypt($val);
                            }
                        }
                        $data['category'] = $this->input->post('category_id');
                        $data['sub_category'] = $this->input->post('sub_category_id');
                        $data['id_input_user'] = $this->session->userdata('user_id');
                        $data['id_check_user'] = null;
                        $data['id_download_user'] = null;
                        $data['id_upload_user'] = null;
                        $data['id_reject_user'] = null;
                        $data['flag_checked'] = 0;
                        $data['flag_download'] = 0;
                        $data['flag_upload'] = 0;
                        $data['flag_used'] = 0;
                        $data['flag_locked'] = 0;
                        $data['flag_rejected'] = 0;
                        $data['date_check'] = null;
                        $data['date_download'] = null;
                        $data['date_upload'] = null;
                        $data['date_reject'] = null;
                        $data['date_used'] = null;

                        $edit_id = $this->input->post('edit_id');

                        if ($this->ModelAccounts->edit_account_action($edit_id, $data)) {
                            $sdata = array();
                            $sdata['msg'] = 'You have Successfully Edited Account.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                        redirect('rejected_accounts');
                    }
                }
                $edit_id = $this->input->get('id');
                $user_id = $this->session->userdata('user_id');
                $edit_cat = $this->input->get('cat');

                if($this->ModelAccounts->check_reject_account($edit_id,$user_id,$edit_cat)){
                    $data['edit_account'] = $this->ModelAccounts->edit_account($edit_id);
                }
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/account_edit_view', $data);
    }
}