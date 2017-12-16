<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller 
{
    public function index()
    {
        $this->load->model('cms/article_model');
        $this->load->model('land/project_model');

        $data['main_view'] = 'home/index';
        $data['title'] = 'Home';
        
        $data['news'] = $this->article_model->get_all(15);

        $data['land'] = $this->project_model->get_all(6);

        $this->load->view('layout/2columns', $data);
    }
}
