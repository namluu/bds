<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Language
{
    function initialize() 
    {
        $ci =& get_instance();
        $default = $ci->config->item('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('basic', $siteLang);
        } else {
            $ci->session->set_userdata('site_lang', $default);
            $ci->lang->load('basic', $default);
        }
    }
}