<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminauth_model extends CI_Model
{
    protected $_table = 'admin_user';
    protected $_tableKey = 'username';
    protected $_sessionKey = 'user';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encryptor');
        $this->load->model('user/Adminuser_model');
    }

    public function isLoggedIn()
    {
        return $this->getUserSession() && $this->getUserSession()->id;
    }

    public function authenticate($key, $password)
    {
        $user = $this->Adminuser_model->get_by([$this->_tableKey => $key], true);
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