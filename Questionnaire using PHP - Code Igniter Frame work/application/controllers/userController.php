<?php

class UserController extends CI_Controller{
    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('user');
        $data = $this->user->getUser($username, $password);
        if($data !== null){
            $accessToken = $this->getGUID();
            $loggedUser = $this->user->setLoggedUser($username, $accessToken);
            if($loggedUser == null){
                $userData=array(
                    'id' => $data[0]->id,
                    'name' => $data[0]->name,
                    'email' => $data[0]->email,
                    'username'=>$data[0]->username
                );
                echo json_encode(array('userData'=>$userData, 'msg'=>'Login Success','token'=>$accessToken));
            }else{
                echo json_encode(array('username'=>$username, 'msg'=>'You have logged in another place', 'status'=>2));
            }
        }else{
            echo json_encode(array('username'=>$username, 'msg'=>'Login Fail, User does not exist!', 'status'=>1));
        }
    }
    
    public function getUser(){
        $username = $this->input->get('username');
        $this->load->model('user');
        $data = $this->user->getUserData($username);
        echo $data;
    }
    
    public function logout(){
        $username = $this->input->get('username');
        $accessToken = $this->input->get('accessToken');
        $this->load->model('user');
        $this->user->setLoggedStatusFalse($username, $accessToken);
        echo json_encode(array('msg'=>'logout success'));
    }

    public function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        } 
    }
    
    public function loadLogin(){
        $this->load->view('loginForm', null);
    }
}

