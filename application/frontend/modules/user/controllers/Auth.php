<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    protected $_redirectAfterLoginSuccess = 'user/account';
    protected $_redirectAfterLoginFail = 'user/auth/login';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->library('formkey');
    }

    public function isLogin()
    {
        return $this->Auth_model->isLoggedIn();
    }

    public function login()
    {
        if ($this->Auth_model->isLoggedIn()) {
            redirect($this->_redirectAfterLoginSuccess);
        }

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if (!$this->formkey->validate($data)) {
                $this->session->set_flashdata('error', 'Formkey is not valid');
                redirect($this->_redirectAfterLoginFail);
            }

            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $user = $this->Auth_model->authenticate($data['email'], $data['password']);
                    $this->Auth_model->setUserDataAsLoggedIn($user);
                    $this->session->set_flashdata('success', 'Login successfully');
                    redirect($this->_redirectAfterLoginSuccess);
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['main_view'] = 'account/login';
        $data['form_key'] = $this->formkey->outputKey();
        $this->load->view('layout/2columns', $data);
    }

    public function logout()
    {
        $this->Auth_model->logout();
        redirect($this->_redirectAfterLoginFail);
    }
}