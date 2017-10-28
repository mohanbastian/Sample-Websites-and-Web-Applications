<?php

class Quiz extends CI_Controller {
    function _construct()
    {
        parent::__construct();
       // $this->load->model('quiz');
    }
    public function getQuiz()
    {
        
        $request_method = $this->input->server('REQUEST_METHOD');
        if ($request_method == 'GET') {
            // get all the quizes
             $this->load->model('quiz');
            $data = $this->quiz->getAllQuiz();
            echo $data;
            //echo json_encode($data);
            //echo json_encode(array('arr' => $data,'status' => 1));
        }
        else {
            // not supported
            echo json_encode(array('status' => 0)); // 0 will be used to mean error
        }
         
    }
}

