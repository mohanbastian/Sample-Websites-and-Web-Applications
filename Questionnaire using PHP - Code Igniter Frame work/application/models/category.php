<?php

class Category extends CI_Model
    {
        function getAllRecords()
        {
            $this->load->database();
            $q = $this->db->get("categories");
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array(array("id"=>1,"name"=>"simple"),array("id"=>2,"name"=>"hard"));
        }
        
        function getCategory($id){
            $this->load->database();
            $this->db->where('ID', $id);
             $query = $this->db->get("categories");
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        function insertCategory($id, $name, $description){
            $this->load->database();
            $data = array(
                'Name' => $name,
                'Description' => $description
            );
            
            if($id == ''){
                $this->db->insert('categories', $data);
            }else{
                $this->db->where('ID', $id);
                $this->db->update('categories', $data);
            }
        }
        
        function updateCategory($id, $name, $description){
            $this->load->database();
            $this->db->where('ID',$id);
            $data = array(
                'Name' => $name,
                'Description' => $description
            );
            $this->db->update('categories', $data);
        }
    }
/* End of file category.php */
/* Location: ./application/models/category.php */
