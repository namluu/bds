<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session_model extends CI_Model
{
    public function authenticate()
    {
        if ($this->isLoggedIn()) {
            return true;
        }

        redirect('customer/account/login');

        return false;
    }

    public function isLoggedIn()
    {
        return (bool)$this->getCustomer();
    }

    public function setCustomerDataAsLoggedIn($customer)
    {
        $this->session->set_userdata('customer', $customer);
    }

    public function getCustomer()
    {
        if ($this->session->has_userdata('customer')) {
            return $this->session->userdata('customer');
        }
        return null;
    }

    public function logout()
    {
        if ($this->isLoggedIn()) {
            $this->session->unset_userdata('customer');
        }
    }
}