<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelAccounts extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("category_level", 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_sub_category($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("main_category_id", $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_template_info($id)
    {
        $this->db->select('template_link_csv, template_link_txt');
        $this->db->from('tbl_category');
        $this->db->where("id", $id);
        // $this->db->limit(1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_field_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_field_list');
        $this->db->where("category_id", $id);
        $this->db->where("status", 1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function insert_new_account_action($data)
    {        
        $this->db->trans_start();
        $this->db->set('date_entry', 'NOW()', FALSE);
        $this->db->insert('tbl_new_accounts', $data);        
        $this->db->trans_complete();
        return ($this->db->trans_status() === FALSE) ? false : true;
    }

    function used_email_info($id, $user)
    {
        $this->db->set('flag_used', 1);
        $this->db->set('date_used', 'NOW()', FALSE);
        $this->db->set('id_used_user', $user);
        $this->db->where('id', $id);
        $this->db->update('tbl_email_accounts');
        return ($this->db->affected_rows());
    }

    function check_reject_account($id, $user, $cat)
    {
        $this->db->select('flag_rejected as res');
        $this->db->from('tbl_new_accounts');
        $this->db->where("Id", $id);
        $this->db->where("id_input_user", $user);
        $this->db->where("sub_category", $cat);
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row();

        if ($query->num_rows() > 0) {
            return $row->res;
        }
        return 0;
    }

    function edit_account($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_new_accounts');
        $this->db->where("Id", $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function edit_account_action($id, $data)
    {
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_new_account_action($user)
    {
        $this->db->select('a_data');
        $this->db->from('tbl_new_accounts');
        $this->db->where("id_input_user", $user);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;


        $this->db->trans_start();
        $this->db->set('date_entry', 'NOW()', FALSE);
        $this->db->insert('tbl_new_accounts', $data);        
        $this->db->trans_complete();
        return ($this->db->trans_status() === FALSE) ? false : true;
    }

    function get_price_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("status", 1);
        $this->db->order_by('main_category_id', 'ASC');
        $this->db->order_by('id', 'ASC');
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function get_custom_rate_user($id, $cat)
    {
        $this->db->select('rate');
        $this->db->from('tbl_user_custom_rate');
        $this->db->where("status", 1);
        $this->db->where("user_id", $id);
        $this->db->where("sub_category_id", $cat);
        $query=$this->db->get();
        $row = $query->row();

        if ($query->num_rows() > 0) {
            return $row->rate;
        }
    }
}

?>