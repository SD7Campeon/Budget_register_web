<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_head_model extends CI_Model {

    public function get_budget_heads() {
        return $this->db->get('budget_head')->result();
    }

    public function get_budget_heads_by_department($dept_shortname) {
        return $this->db->get_where('budget_head', array('dept_shortname' => $dept_shortname))->result();
    }

    public function get_budget_head($id) {
        return $this->db->get_where('budget_head', array('id' => $id))->row();
    }

    public function insert_budget_head($data) {
        $this->db->insert('budget_head', $data);
    }

    public function delete_budget_head($id) {
        $this->db->delete('budget_head', array('id' => $id));
    }
}
