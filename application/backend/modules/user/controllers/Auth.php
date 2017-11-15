<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    protected $_redirectAfterLoginSuccess = 'backend/dashboard';
    protected $_redirectAfterLoginFail = 'user/auth/login';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Adminauth_model');
        $this->load->library('formkey');
    }

    public function login()
    {
        if ($this->Adminauth_model->isLoggedIn()) {
            redirect($this->_redirectAfterLoginSuccess);
        }

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if (!$this->formkey->validate($data)) {
                $this->session->set_flashdata('error', 'Formkey is not valid');
                redirect($this->_redirectAfterLoginFail);
            }

            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $user = $this->Adminauth_model->authenticate($data['username'], $data['password']);
                    $this->Adminauth_model->setUserDataAsLoggedIn($user);
                    $this->session->set_flashdata('success', 'Login successfully');
                    redirect($this->_redirectAfterLoginSuccess);
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['form_key'] = $this->formkey->outputKey();
        $data['main_view'] = 'auth/login';
        $this->load->view('layout/empty', $data);
    }

    public function logout()
    {
        $this->Adminauth_model->logout();
        redirect($this->_redirectAfterLoginFail);
    }
}
