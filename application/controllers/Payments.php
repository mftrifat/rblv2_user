<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelAccounts");
        $this->load->model("ModelPayments");
    }

    function payment_request() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $data['post_act'] = 0;
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Request Payment');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'payment/payment_request_view_script');
            $this->template->set('page_style', 'payment/payment_request_view_style');

            if($this->session->userdata('user_access_level') < 100) {
                if($this->session->userdata('user_access_level') == 11) {
                    $this->template->set('nav', '_layouts/nav/navigation_layout_admin');
                }
                if($this->input->post('submit') == "request") {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('request_amount','Pequest Amount','trim|required');
                    $this->form_validation->set_rules('charge_amount','Payment Amount','trim|required');
                    $this->form_validation->set_rules('payment_amount','Payment Amount','trim|required');
                    $this->form_validation->set_rules('payment_charge','Payment Charge','trim|required');
                    $this->form_validation->set_rules('request_remarks','Request Method','required');
                 
                    if($this->form_validation->run()==FALSE)
                    {
                        header("Access-Control-Allow-Origin: *");
                        $data = array();
                        echo "false";
                    } else {
                        $data = array();
                        $request_amount = $this->input->post('request_amount');
                        $charge_amount = $this->input->post('charge_amount');
                        $payment_amount = $this->input->post('payment_amount');
                        $payment_charge = $this->ModelCommon->single_result('tbl_users', 'payment_charge', 'user_id', $this->session->userdata('user_id'));                        
                        $data['request_amount'] = $request_amount;
                        $data['charge_amount'] = round($request_amount*$payment_charge/100);
                        $data['payment_amount'] = $request_amount-$data['charge_amount'];

                        $data['commision_user_id'] = $this->ModelCommon->single_result('tbl_users', 'parent_user_id', 'user_id', $this->session->userdata('user_id'));
                        $data['request_date'] = date("Y-m-d H:i:s");
                        $data['user_id'] = $this->session->userdata('user_id');
                        $data['request_remarks'] = $this->input->post('request_remarks');

                        if ($this->ModelPayments->request_new_payment($data)) {
                            $this->ModelPayments->request_new_payment_post($data['user_id']);
                            $sdata = array();
                            $sdata['msg'] = 'Request Submitted.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                        $data['post_act'] = 1;
                    }
                }
                $data['balance'] = $this->ModelCommon->get_user_balance($this->session->userdata('user_id'));
                $data['payment_charge'] = $this->ModelCommon->single_result('tbl_users', 'payment_charge', 'user_id', $this->session->userdata('user_id'));
                $data['payment_pending'] = $this->ModelCommon->single_result('tbl_user_balance', 'pending_payment', 'user_id', $this->session->userdata('user_id'));
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/payment_request_view', $data);
    }

    function payment_status() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $data['post_act'] = 0;
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Payment Status');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'payment/payment_status_view_script');
            $this->template->set('page_style', 'payment/payment_status_view_style');

            if($this->session->userdata('user_access_level') < 100) {
                if($this->session->userdata('user_access_level') == 11) {
                    $this->template->set('nav', '_layouts/nav/navigation_layout_admin');
                }
                $data['all_payments'] = $this->ModelPayments->get_user_payment_status($this->session->userdata('user_id'));
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/payment_status_view', $data);
    }

    function transaction_summary() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_user')) {
            $this->template->set('title', 'Transaction Summary');
            $this->template->set('nav', '_layouts/nav/navigation_layout_user');
            $this->template->set('page_script', 'payment/transaction_summary_view_script');
            $this->template->set('page_style', 'payment/transaction_summary_view_style');

            if($this->session->userdata('user_access_level') < 100) {
                if($this->session->userdata('user_access_level') == 11) {
                    $this->template->set('nav', '_layouts/nav/navigation_layout_admin');
                }
                $data['transaction_summary'] = $this->ModelPayments->get_user_transaction_summary($this->session->userdata('user_id'));
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/transaction_summary_view', $data);
    }
}