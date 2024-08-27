<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends CI_Model {

    public function get_budgets_by_head($budget_head_id) {
        return $this->db->get_where('budget', array('budget_head_id' => $budget_head_id))->result();
    }

    public function insert_budget($data) {
        $this->db->insert('budget', $data);
    }

    public function get_last_balance($budget_head_id) {
        $this->db->select('balance');
        $this->db->where('budget_head_id', $budget_head_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('budget');
        $result = $query->row();
        return $result ? $result->balance : 0;
    }
}
