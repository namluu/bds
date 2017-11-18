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
}