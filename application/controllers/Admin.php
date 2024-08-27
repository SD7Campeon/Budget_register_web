
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Department_model');
        $this->load->model('Budget_head_model');
    }

    public function dashboard() {
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $this->load->view('admin/dashboard');
    }

    public function manage_departments() {
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $data['departments'] = $this->Department_model->get_departments();
        $this->load->view('admin/manage_departments', $data);
    }

    public function add_department() {
        $this->form_validation->set_rules('dept_name', 'Department Name', 'required');
        $this->form_validation->set_rules('dept_shortname', 'Department Shortname', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->manage_departments();
        } else {
            $department_data = array(
                'dept_name' => $this->input->post('dept_name'),
                'dept_shortname' => $this->input->post('dept_shortname')
            );

            $this->Department_model->insert_department($department_data);
            redirect('admin/manage_departments');
        }
    }

    public function delete_department($id) {
        $this->Department_model->delete_department($id);
        redirect('admin/manage_departments');
    }

    public function manage_budget_heads() {
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $data['budget_heads'] = $this->Budget_head_model->get_budget_heads();
        $this->load->view('admin/manage_budget_heads', $data);
    }

    public function add_budget_head() {
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('dept_shortname', 'Department Shortname', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->manage_budget_heads();
        } else {
            $budget_head_data = array(
                'code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'dept_shortname' => $this->input->post('dept_shortname')
            );

            $this->Budget_head_model->insert_budget_head($budget_head_data);
            redirect('admin/manage_budget_heads');
        }
    }

    public function delete_budget_head($id) {
        $this->Budget_head_model->delete_budget_head($id);
        redirect('admin/manage_budget_heads');
    }
}
