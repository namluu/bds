<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->model('Account_model');
        $this->preDispatch();
    }

    public function preDispatch()
    {
        $action = $this->uri->segment('3');
        $openActions = array(
            'create',
            'forgotpassword',
            'resetpassword',
            'confirm',
            'confirmation'
        );
        $pattern = '/^(' . implode('|', $openActions) . ')/i';

        if (!preg_match($pattern, $action)) {
            $this->Auth_model->checkAuthentication();
        }
    }

    public function index()
    {
        $data['main_view'] = 'account/index';
        $this->load->view('layout/1column', $data);
    }

    public function create()
    {
        if ($this->Auth_model->isLoggedIn()) {
            redirect('user/account');
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
                    $customer = $this->Account_model->createAccount($data, $password);
                    $this->session->set_flashdata('success', 'Create account successfully');
                    redirect('user/auth/login');
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
}
