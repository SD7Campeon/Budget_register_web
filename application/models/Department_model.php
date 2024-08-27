<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

    public function get_departments() {
        return $this->db->get('department')->result();
    }

    public function insert_department($data) {
        $this->db->insert('department', $data);
    }

    public function delete_department($id) {
        $this->db->delete('department', array('id' => $id));
    }
    public function get_department_by_shortname($shortname) {
        return $this->db->get_where('department', array('dept_shortname' => $shortname))->row();
    }
    
    
}
