<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelUser extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_new_user($data)
    {
        $this->db->set('signup_date', 'NOW()', FALSE);
        $this->db->insert('tbl_users', $data);
        return ($this->db->insert_id()) ? true : false;
    }

    function add_user_access($data)
    {
        $this->db->insert('tbl_user_access', $data);
        return ($this->db->insert_id()) ? $this->add_user_payment($data) : false;
    }

    function add_user_payment($data)
    {        
        $insert_data = [
            'user_id'   => $data['user_id'],
        ];
        $this->db->insert('tbl_user_balance', $insert_data);
        return ($this->db->insert_id()) ? true : false;
    }

    function get_user_id($data)
    {
        $this->db->select('max(user_id) as max');
        $this->db->from('tbl_users');
        $this->db->where("user_type_id", $data);
        $query = $this->db->get();
        $row = $query->row();

        if ($query->num_rows() > 0) {
            return $row->max;
        }
    }

    function get_user_access_level($data)
    {
        $this->db->select('access_level as def');
        $this->db->from('tbl_user_type');
        $this->db->where("user_type_id", $data);
        $query = $this->db->get();
        $row = $query->row();

        if ($query->num_rows() > 0) {
            return $row->def;
        }
    }

    function get_user_list($data)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where("authorized_by",$data);
        $this->db->order_by("id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function edit_user_action($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('tbl_users', $data);

        return ($this->db->affected_rows() > 0);
    }
}

?>