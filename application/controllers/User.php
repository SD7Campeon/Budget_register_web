<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Budget_head_model');
        $this->load->model('Budget_model');
        $this->load->model('Expenditure_model');
        $this->load->model('Department_model');
    }

    public function dashboard() {
        if ($this->session->userdata('role') != 'user') {
            redirect('auth/login');
        }
        $dept_shortname = $this->session->userdata('dept_shortname');
        $username = $this->session->userdata('username');
    
        $department = $this->Department_model->get_department_by_shortname($dept_shortname);
    
        $data['budget_heads'] = $this->Budget_head_model->get_budget_heads_by_department($dept_shortname);
        $data['username'] = $username;
        $data['department'] = $department->dept_name;
        $this->load->view('user/dashboard', $data);
    }

    public function view_budget($budget_head_id) {
        $data['budget_head'] = $this->Budget_head_model->get_budget_head($budget_head_id);
        $data['budgets'] = $this->Budget_model->get_budgets_by_head($budget_head_id);
        $data['expenditures'] = $this->Expenditure_model->get_expenditures_by_head($budget_head_id);
        $data['username'] = $this->session->userdata('username');
        $data['dept_name'] = $this->session->userdata('department');
        $this->load->view('user/view_budget', $data);
    }

    public function add_budget($budget_head_id) {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('proposal_amount', 'Proposal Amount', 'required|decimal');

        if ($this->form_validation->run() == FALSE) {
            $response = array('success' => false, 'message' => validation_errors());
            echo json_encode($response);
        } else {
            $budget_data = array(
                'date' => $this->input->post('date'),
                'description' => $this->input->post('description'),
                'proposal_amount' => $this->input->post('proposal_amount'),
                'provision_availed' => 0,
                'balance' => $this->input->post('proposal_amount'),
                'budget_head_id' => $budget_head_id
            );

            $this->Budget_model->insert_budget($budget_data);
            $response = array('success' => true, 'message' => 'Budget data added successfully');
            echo json_encode($response);
        }
    }

    public function add_expenditure($budget_head_id) {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('partyname', 'Party Name', 'required');
        $this->form_validation->set_rules('expenditure', 'Expenditure', 'required|decimal');
        $this->form_validation->set_rules('total_expenditure', 'Total Expenditure', 'required|decimal');

        if ($this->form_validation->run() == FALSE) {
            $response = array('success' => false, 'message' => validation_errors());
            echo json_encode($response);
        } else {
            $expenditure_data = array(
                'date' => $this->input->post('date'),
                'description' => $this->input->post('description'),
                'partyname' => $this->input->post('partyname'),
                'expenditure' => $this->input->post('expenditure'),
                'total_expenditure' => $this->input->post('total_expenditure'),
                'balance' => $this->Budget_model->get_last_balance($budget_head_id) - $this->input->post('total_expenditure'),
                'budget_head_id' => $budget_head_id
            );

            $this->Expenditure_model->insert_expenditure($expenditure_data);
            $response = array('success' => true, 'message' => 'Expenditure data added successfully');
            echo json_encode($response);
        }
    }
}
?>
