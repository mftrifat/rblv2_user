<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelPayments extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function request_new_payment($data)
    {        
        $this->db->trans_start();
        $this->db->insert('tbl_user_payment', $data);        
        $this->db->trans_complete();
        return ($this->db->trans_status() === FALSE) ? false : true;
    }

    function request_new_payment_post($id)
    {
        $this->db->set('pending_payment', 1);
        $this->db->where('user_id', $id);
        $this->db->update('tbl_user_balance');
        return ($this->db->affected_rows());
    }

    function get_user_payment_status($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_payment');
        $this->db->where("user_id", $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_user_transaction_summary($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaction_history');
        $this->db->where("user_id", $id);
        $this->db->order_by("id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}

?>