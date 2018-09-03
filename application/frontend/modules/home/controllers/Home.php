<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller 
{
    public function index()
    {
        $this->load->model('cms/article_model');
        $this->load->model('land/project_model');
        $this->load->model('land/category_model');
        $this->load->model('location/city_model');

        $data['main_view'] = 'home/index';
        $data['title'] = 'Home';
        
        $data['news'] = $this->article_model->get_all(15);

        $data['land'] = $this->project_model->get_all(6);

        $categories = $this->category_model->get_data_form('id', 'title');
        $data['categories'] = array_merge([0 => 'Chọn loại nhà đất'], $categories);

        $cities = $this->city_model->get_data_form('id', 'name');
        $data['cities'] = [0 => 'Chọn tỉnh/thành phố'] + $cities;

        $data['disctricts'] = [0 => 'Chọn quận/huyện'];

        $this->load->view('layout/2columns', $data);
    }
}
