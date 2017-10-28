<?php

class Admin extends CI_Controller {
    function _construct()
    {
        parent::__construct();
       // $this->load->model('quiz');
    }
    public function getQuiz()
    {
        $this->load->model('quiz');
        $request_method = $this->input->server('REQUEST_METHOD');
        if ($request_method == 'GET') {
            // get all the quizes
            $data = $this->quiz->getAllQuiz();
            echo json_encode($data);
            //echo json_encode(array($data,'status' => 1));
        }
        else {
            // not supported
            echo json_encode(array('status' => 0)); // 0 will be used to mean error
        }
    }
    public function getCategories()
    {
        $this->load->model('category');
        $request_method = $this->input->server('REQUEST_METHOD');
        if ($request_method == 'GET') {
            // get all the categories
            $data = $this->category->getAllRecords();
            echo json_encode($data);
        }
        else {
            // not supported
            echo json_encode(array('status' => 0)); // 0 will be used to mean error
        }
    }
    public function saveCategory(){
        $request_method = $this->input->server('REQUEST_METHOD');
        if($request_method == 'POST' || $request_method == 'PUT'){
            $phpArray = json_decode(file_get_contents('php://input'));
            if(!isset($phpArray->id)){
                $id='';
            }else{
                $id = $phpArray->id;
            }
            $name = $phpArray->name;
            $description = $phpArray->description;
            $this->load->model('category');
            $this->category->insertCategory($id, $name, $description);
            echo 'success';
        }else if($request_method == 'GET'){
            $categoryId = $this->input->get('id');
            $this->load->model('category');
            $data = $this->category->getCategory($categoryId);
            echo json_encode($data[0]);
        }
    }

    public function getQuizForCategory()
    {
        $this->load->model('quiz');
        $id = $this->input->get('id');
        $data = $this->quiz->getQuizForCategory($id);
        echo json_encode($data);
    }
    
    public function saveQuiz(){
        
        $request_method = $this->input->server('REQUEST_METHOD');
        if($request_method == 'POST' || $request_method == 'PUT'){
            $phpArray = json_decode(file_get_contents('php://input'));
            $name =  $phpArray->name;
            $answer= $phpArray->answer;
            $category = $phpArray->category;
            $choice1 = $phpArray->choice1;
            $choice2 = $phpArray->choice2;
            $choice3 = $phpArray->choice3;
            $choice4 = $phpArray->choice4;
            $this->load->model('quiz');

            if(isset($phpArray->id)){
                $id = $phpArray->id;
            }else{
                $id = '';
            }
            $this->quiz-> insertQuiz($id, $name, $answer, $category, $choice1, $choice2, $choice3, $choice4);
            echo 'success';
        }else if($request_method == 'GET'){
            $quizId = $this->input->get('id');
            $this->load->model('quiz');
            $data = $this->quiz->getQuiz($quizId);
            echo json_encode($data[0]);
          
        }else if($request_method == 'DELETE'){
            
        }
    }
    
    public function login(){
        $phpArray = json_decode(file_get_contents('php://input'));
        $username =  $phpArray->username;
        $password= $phpArray->password;
        $this->load->model('user');
        $data = $this->user->getUser($username, $password);
        if($data !== null && $username == 'admin'){
            echo json_encode(array('username'=>$username, 'msg'=>'Login Success','token'=>'953'));
        }else{
            echo json_encode(array('username'=>$username, 'msg'=>'Login Fail'));
        }
    }
}


