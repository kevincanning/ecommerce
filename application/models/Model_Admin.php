<?php

class Model_Admin extends CI_Model {
    public function check_admin($data){
        return $this->db->get_where('admin', $data)->result_array();
    }

    public function add_category($data){
        return $this->db->insert('categories', $data);
    }

    public function check_category($data){
        return $this->db->get_where('categories', array('name' => $data['name']));
    }

    public function get_all_categories(){
        return $this->db->get_where('categories', array('status' => 1))->num_rows();
    }

    public function all_categories_num_rows($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get_where('categories', array('status' => 1));

        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            
            return $data;
        }
        return false;
    }

    public function check_category_by_id($id){
        return $this->db->get_where('categories', array('id' => $id))->result_array();
    }

    public function update_category($data, $category_id){
        $this->db->where('id',  $category_id);
        $this->db->set('name', $data['name']);
        
        return $this->db->update('categories', $data);
    }
}