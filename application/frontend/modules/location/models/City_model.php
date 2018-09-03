<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class City_model extends MY_Model
{
    protected $_table = 'location';

    public function get_data_array($fields = [])
    {
        if ($fields) {
            $this->db->select($fields);
        }
        $this->db->where(['parent_id' => 0]);
        
        return $this->db->get($this->_table)->result_array();
    }
}