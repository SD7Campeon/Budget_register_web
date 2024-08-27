<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure_model extends CI_Model {

    public function get_expenditures_by_head($budget_head_id) {
        return $this->db->get_where('expenditure', array('budget_head_id' => $budget_head_id))->result();
    }

    public function insert_expenditure($data) {
        $this->db->insert('expenditure', $data);
    }
}
