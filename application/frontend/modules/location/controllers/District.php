<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends MX_Controller 
{
    public function load()
    {
        $this->load->model('district_model');

        if ($_POST) {
            $cityId = $_POST['city_id'];
            $districts = $this->district_model->get_district_form('id', 'name', $cityId);
            $data = [0 => 'Chọn quận/huyện'] + $districts;
            echo json_encode($data, JSON_FORCE_OBJECT);
        }
    }
}
