<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    protected $_redirectAfterLoginSuccess = 'user/account';
    protected $_redirectAfterLoginFail = 'user/auth/login';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('session_model');
        $this->load->model('auth_model');
        $this->load->library('formkey');
    }

    public function login()
    {
        if ($this->session_model->isLoggedIn()) {
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
                    $user = $this->auth_model->authenticate($data['email'], $data['password']);
                    $this->session_model->setCustomerDataAsLoggedIn($customer);
                    $this->session->set_flashdata('success', 'Login successfully');
                    redirect('customer/account');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['main_view'] = 'account/login';
        $data['form_key'] = $this->formkey->outputKey();
        $this->load->view('layout/2columns', $data);
    }

    public function create()
    {
        if ($this->session_model->isLoggedIn()) {
            redirect('customer/account');
        }

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('firstname', __('Firstname'), 'required|max_length[100]');
            $this->form_validation->set_rules('lastname', __('Lastname'), 'required|max_length[100]');
            $this->form_validation->set_rules('email', __('Email'), 'required|valid_email|is_unique[customer.email]');
            $this->form_validation->set_rules('password', __('Password'), 'required|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('password_confirmation', __('Confirm Password'), 'required|matches[password]');
            $this->form_validation->set_rules('captcha', __('Input captcha'), 'required');

            try {
                if ($this->form_validation->run() == false) {
                    throw new Exception(validation_errors());
                } else {
                    if ($this->session->has_userdata('captcha')) {
                        $captcha = $this->session->userdata('captcha');
                        $expiration = time() - 7200; // Two hour limit
                        if (strcasecmp($this->input->post('captcha'), $captcha['word']) != 0 || $captcha['time'] < $expiration) {
                            throw new Exception(__('Wrong captcha'));
                        }
                    }

                    $password = $this->input->post('password');
                    $customer = $this->account_model->createAccount($data, $password);
                    $this->session->set_flashdata('success', 'Create account successfully');
                    redirect('customer/account/login');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $this->load->helper('captcha');
        $vals = init_captcha();
        $captcha = create_captcha($vals);
        $this->session->set_userdata(['captcha' => $captcha]);

        $data['main_view'] = 'account/create';
        $data['captcha'] = $captcha;
        $this->load->view('layout/2columns', $data);
    }

    public function logout()
    {
        $this->session_model->logout();
        redirect('customer/account');
    }
}