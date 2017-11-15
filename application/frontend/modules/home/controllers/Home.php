<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller 
{
    public function index()
    {
        $this->load->model('cms/article_model');

        $data['main_view'] = 'home/index';
        $data['title'] = 'Home';
        $data['news'] = $this->article_model->get_all(10);
        $this->load->view('layout/3columns', $data);
    }
}
