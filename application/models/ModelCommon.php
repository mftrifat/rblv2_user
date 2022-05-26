<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModelCommon extends CI_Model {

    public function __construct() {
        parent::__construct();
        $CI = & get_instance();
    }

    function get_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("category_level", 0);
        $this->db->where("status", 1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_sub_category($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("main_category_id", $id);
        $this->db->where("status", 1);
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
        $this->db->order_by("seq", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function single_result($table, $field, $search_on, $search_value) {
        $query = $this->db->query("select $field as total from $table where $search_on='$search_value' LIMIT 1");
        $row = $query->row();

        if ($query->num_rows() > 0) {
            return $row->total;
        }
    }

    function get_single_field_info($id,$field)
    {
        $this->db->select('*');
        $this->db->from('tbl_field_list');
        $this->db->where("category_id", $id);
        $this->db->where("field_id", $field);
        $this->db->where("status", 1);
        $this->db->limit(1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function update_data_single_cond($table, $con_field, $con_value, $up_field, $up_value) {
        $data=array(
            $up_field=>$up_value
        );
        $where_cond=array(
            $con_field=>$con_value
        );

        $this->db->where($where_cond);
        $this->db->update($table, $data);
    }

    function get_conditional_data($table, $cond) {
        $query = $this->db->query("select * from $table  $cond");
        return $query->result();
    }

    function get_field_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row->$field;
        }
    }

    function get_max_by_cond($table, $field, $cond) {
        $query = $this->db->query("select MAX($field) as max_val from $table where $cond ");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row->max_val;
        }
    }

    function get_list_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond ");
        $result = $query->result();
        if ($query->num_rows() > 0) {
            return $result;
        }
    }

    function get_row_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row;
        }
    }

    function get_count_user_submitted($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_new_accounts');
        $this->db->where("id_input_user", $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_user_cond($id,$cond)
    {
        $cond = "flag_".$cond;
        $this->db->select('*');
        $this->db->from('tbl_new_accounts');
        $this->db->where("id_input_user", $id);
        $this->db->where($cond, 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>