<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('session_model');
        $this->preDispatch();
    }

    public function preDispatch()
    {
        $action = $this->uri->segment('3');
        $openActions = array(
            'index',
            'forgotpassword',
            'resetpassword',
            'confirm',
            'confirmation'
        );
        $pattern = '/^(' . implode('|', $openActions) . ')/i';

        if (!preg_match($pattern, $action)) {
            $this->session_model->authenticate();
        }
    }

    public function index()
    {
        $data['main_view'] = 'account/index';
        $this->load->view('layout/1column', $data);
    }
}
