<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model 
{
    protected $_table = '';

    protected $_key = 'id';

    protected $_order = '';

    protected $_direction = '';

    public function get_all($limit = null, $start = 0)
    {
        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        $this->db->order_by($this->_order, $this->_direction);
        return $this->db->get($this->_table)->result();
    }

    public function get($id = null)
    {
        $id = intval($id);
        $this->db->where($this->_key, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row();

        if(!count($result)){
            $fields = $query->list_fields();
            $result = new stdClass;
            foreach($fields as $field){
                $result->$field = '';
            }
        }

        return $result;
    }

    public function get_by($where, $single = false)
    {
        $this->db->where($where);
        $this->db->order_by($this->_order);
        if ($single) {
            return $this->db->get($this->_table)->row();
        } else {
            return $this->db->get($this->_table)->result();
        }
    }

    public function save($data, $id = null)
    {
        if ($id == null) {
            // insert
            if (isset($data[$this->_key])) {
                $data[$this->_key] = null;
            }
            $this->db->set($data);
            $this->db->insert($this->_table);
            $id = $this->db->insert_id();
        } else {
            // update
            $id = intval($id);
            $this->db->set($data);
            $this->db->where($this->_key, $id);
            $this->db->update($this->_table);
        }

        return $id;
    }

    public function delete($id)
    {
        $id = intval($id);

        $this->db->where($this->_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table);
    }

    public function check_exists($where)
    {
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function get_unique_slug($slug, $id)
    {
        $slug = string_url_safe($slug);
        $cond = ['alias' => $slug, $this->_key . ' != ' => $id];
        if ($this->check_exists($cond)) {
            $this->db->like('alias', $slug, 'after');
            $query = $this->db->get($this->_table);
            $count = $query->num_rows();
            return $slug . '-' . $count;
        }
        
        return $slug;
    }

    public function insert_batch($data = array())
    {
        if($this->db->insert_batch($this->_table, $data))
        {
           return true;
        }else{
            return false;
        }
    }

    public function num_rows()
    {
        return $this->db->count_all($this->_table);
    }

    public function get_data_array($fields = [])
    {
        if ($fields) {
            $this->db->select($fields);
        }
        
        return $this->db->get($this->_table)->result_array();
    }

    public function get_data_form($key, $name)
    {
        $data = $this->get_data_array([$key, $name]);
        $result = [];
        foreach ($data as $d) {
            $result[$d[$key]] = $d[$name];
        }
        return $result;
    }
}