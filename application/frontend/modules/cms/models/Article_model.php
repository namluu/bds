<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends MY_Model
{
    protected $_table = 'cms_article';

    public function get_all($limit = null, $start = 0)
    {
        $this->db->select('main.*, cate.alias cate_alias');
        $this->db->from('cms_article main');
        $this->db->join('cms_category cate', 'main.category_id = cate.id', 'left');

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        $this->db->order_by($this->_order);
        return $this->db->get()->result();
    }
}