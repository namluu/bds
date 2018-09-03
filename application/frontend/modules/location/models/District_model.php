<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class District_model extends MY_Model
{
    protected $_table = 'location';

    /**
     * Load via Ajax
     */
    public function get_district_array($fields = [], $parentId)
    {
        if ($fields) {
            $this->db->select($fields);
        }

        $this->db->where(['parent_id' => $parentId]);
        
        return $this->db->get($this->_table)->result_array();
    }

    public function get_district_form($key, $name, $cityId)
    {
        $data = $this->get_district_array([$key, $name], $cityId);
        $result = [];
        foreach ($data as $d) {
            $result[$d[$key]] = $d[$name];
        }
        return $result;
    }
}