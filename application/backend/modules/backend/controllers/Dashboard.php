<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller 
{
    public function index()
    {
        $data['main_view'] = 'dashboard/index';
        $this->load->view('layout/1column', $data);
    }
}
