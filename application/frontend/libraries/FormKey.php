<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FormKey
{
    protected $CI;

    protected $formKey;

    protected $oldFormKey;

    public function __construct()
    {
        $this->CI =& get_instance();
        if ($this->CI->session->has_userdata('form_key')) {
            $this->oldFormKey = $this->CI->session->userdata('form_key');
        }
    }

    private function generateKey()
    {
        $ip = $this->CI->input->ip_address();
        $uniqid = uniqid(mt_rand(), true);
        return md5($ip . $uniqid);
    }

    public function outputKey()
    {
        $this->formKey = $this->generateKey();
        $this->CI->session->set_userdata('form_key', $this->formKey);
        return "<input type='hidden' name='form_key' id='form_key' value='".$this->formKey."' />";
    }

    /**
     * @param array $data
     * @return bool
     */
    public function validate($data)
    {
        return !!$data['form_key'] == $this->oldFormKey;
    }
}