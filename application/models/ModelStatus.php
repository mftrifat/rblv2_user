<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelStatus extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all_accounts($cat_id, $user_id)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.sub_category', $cat_id);
        $this->db->where('a.id_input_user', $user_id);
        // $this->db->limit(5);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function rejected_accounts($cat_id, $user_id)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.sub_category', $cat_id);
        $this->db->where('a.id_input_user', $user_id);
        $this->db->where('a.flag_rejected', 1);
        // $this->db->limit(5);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }
}

?>