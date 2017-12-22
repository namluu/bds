<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends MY_Model
{
    protected $_table = 'land_project';

    public function get_all($limit = null, $start = 0)
    {
        $this->db->select('main.*, cat.alias cat_alias, cat.title cat_title');
        $this->db->from($this->_table . ' main');
        $this->db->join('land_category cat', 'main.category_id = cat.id', 'left');

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        $this->db->order_by($this->_order);
        return $this->db->get()->result();
    }
}