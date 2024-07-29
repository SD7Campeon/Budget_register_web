<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert_user($data) {
        $this->db->insert('users', $data);
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('users', array('username' => $username))->row();
    }
}
