<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{
    protected $_table = 'land_category';

    protected $_order = 'sort_order';

    public function get_all($limit = null, $start = 0)
    {
        $this->db->select('main.*, sec.alias sec_alias, sec.title sec_title');
        $this->db->from($this->_table . ' main');
        $this->db->join('land_section sec', 'main.section_id = sec.id', 'left');

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        $this->db->order_by($this->_order);
        return $this->db->get()->result();
    }
}