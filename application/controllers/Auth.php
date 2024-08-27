<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Department_model');
    }

    public function index() {
        $this->load->view('auth/index');
    }

    public function signup() {
        $data['departments'] = $this->Department_model->get_departments();
        $this->load->view('auth/signup', $data);
    }

    public function register() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dept_shortname', 'Department', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->signup();
        } else {
            $user_data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'email' => $this->input->post('email'),
                'dept_shortname' => $this->input->post('dept_shortname')
            );

            $this->User_model->insert_user($user_data);
            redirect('auth/login');
        }
    }

    public function login() {
        $this->load->view('auth/login');
    }

    public function login_action() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                // Retrieve the department details
                $department = $this->Department_model->get_department_by_shortname($user->dept_shortname);

                $session_data = array(
                    'id' => $user->id,
                    'username' => $user->username,
                    'dept_shortname' => $user->dept_shortname,
                    'dept_name' => $department->dept_name, // Store department name in session
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);

                if ($user->role == 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
