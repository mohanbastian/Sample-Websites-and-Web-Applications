<?php
class User extends CI_Model{
    
    function getUser($username, $password){
        $this->load->database();
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get("user");
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return null;
        }
    }
    
    function getUserData($username){
        $this->load->database();
        $this->db->where('username', $username);
        $query = $this->db->get("user");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
            $userData = array(
                    'id' => $data[0]->id,
                    'name' => $data[0]->name,
                    'email' => $data[0]->email,
                    'username'=>$data[0]->username
                );
            return $userData;
        }else{
            return null;
        }
    }
    
    function setLoggedUser($username, $accessToken){
        $this->load->database();
        $this->db->where('username', $username);
        $this->db->where('isLoggedIn', 1); //to check records of logged
        $q1 = $this->db->get("loggeduser");
        if($q1->num_rows() > 0)
        {   //return the existing record
            return $q1->result();
        }else{
            //add record to db
            $data = array(
                'username' => $username,
                'accessToken' => $accessToken,
                'isLoggedIn' => 0
            );
            $this->db->insert('loggeduser', $data);
            return null;
        } 
    }
    
    function setLoggedStatusFalse($username, $accessToken){
        $this->load->database();
        $this->db->where('username', $username);
        $this->db->where('accessToken', $accessToken);
        $data = array(
            'isLoggedIn' => 0
        );
        $this->db->update('loggeduser', $data);
    }
}

