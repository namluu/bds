<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('encryptor');
    }

    /**
     * @param $data
     * @param $password
     *
     * @return int id
     */
    public function createAccount($data, $password)
    {
        $hash = $this->encryptor->getHash($password);
        $customer = array(
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'password_hash' => $hash
        );

        return $this->customer_model->save($customer);
    }

    public function authenticate($email, $password)
    {
        $customer = $this->customer_model->get_by(['email' => $email], true);
        if (!$customer) {
            throw new Exception('Invalid login or password.');
        }

        if (!$customer->is_active) {
            throw new Exception('The account is locked.');
        }

        if (!$this->encryptor->validateHash($password, $customer->password_hash)) {
            throw new Exception('Invalid login or password.');
        }

        return $customer;
    }
}