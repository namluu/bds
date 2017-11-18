<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    protected $_tableKey = 'email';
    protected $_sessionKey = 'customer';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryptor');
        $this->load->model('user/Customer_model');
    }

    public function checkAuthentication()
    {
        if (!$this->isLoggedIn()) {
            redirect('user/auth/login');
        }
    }

    public function isLoggedIn()
    {
        return $this->getUserSession() && $this->getUserSession()->id;
    }

    public function authenticate($key, $password)
    {
        $user = $this->Customer_model->get_by([$this->_tableKey => $key], true);
        if (!$user) {
            throw new Exception('Invalid login or password.');
        }

        if (!$user->is_active) {
            throw new Exception('The account is locked.');
        }

        if (!$this->encryptor->validateHash($password, $user->password_hash)) {
            throw new Exception('Invalid login or password.');
        }

        return $user;
    }

    public function getUserSession()
    {
        if ($this->session->has_userdata($this->_sessionKey)) {
            return $this->session->userdata($this->_sessionKey);
        }
        return null;
    }

    public function setUserDataAsLoggedIn($data)
    {
        $this->session->set_userdata($this->_sessionKey, $data);
    }

    public function logout()
    {
        if ($this->isLoggedIn()) {
            $this->session->unset_userdata($this->_sessionKey);
        }
    }
}