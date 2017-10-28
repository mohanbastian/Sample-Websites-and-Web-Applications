<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of quizController
 *
 * @author Shani
 */
class quizController extends CI_Controller{
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    function current_full_url()
    {
        $CI =& get_instance();
        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
    }
    public function runQuiz(){
        if (strpos($this->current_full_url(),'quizController/runQuiz?categories') !== false) {
            $session_items = array('current_id'=>'', 'results'=>'');
            $this->session->unset_userdata($session_items);
        }
        //Starting the quiz
        if($this->session->userdata('current_id') === '' || $this->session->userdata('current_id') === FALSE){
            $this->load->model("quiz");
            $this->session->set_userdata('current_id',0);
            $this->session->set_userdata('category', $this->input->get('categories'));
            $records = $this->quiz->getQuizForCategory($this->input->get('categories'));
            $record['quiz'] = $records[$this->session->userdata('current_id')];
            $this->load->view('quizView', $record);
            $this->session->set_userdata('timestarted',now());
        }else{
            //Save the user's answer for current question
            $this->load->model("quizSession");
            if(isset($_GET['choice']) === true){
                $this->quizSession->addQuestionAnswer($this->session->userdata('session_id'), '', $this->session->userdata('category'), $_GET['choice'], $this->session->userdata('current_id'));
            }else{
                $this->quizSession->addQuestionAnswer($this->session->userdata('session_id'), '', $this->session->userdata('category'), "", $this->session->userdata('current_id'));
            }
            //Setting the current quiz number
            $val = $this->session->userdata('current_id');
            $this->session->unset_userdata('current_id');
            $val = $val +1;
            $this->session->set_userdata('current_id',$val);
            $this->load->model("quiz");
            $quiz = $this->quiz->getQuizForCategory($this->session->userdata('category'));
            //Calculate final score if the question is the last one
            if($this->session->userdata('current_id') === sizeof($quiz)){
                $this->calculateResults($quiz);
            }else{//show the next question
                $record['quiz']=  $quiz[$this->session->userdata('current_id')];
                $this->load->view('quizView', $record); 
            }
        }
    }
    private function calculateResults($quiz){
        
        $score['time']= $this->formateTime(now() - $this->session->userdata('timestarted'));
        $score['correct']=0;
        $score['wrong']=0;
        $score['answered']=0;
        $score['total']=sizeof($quiz);
        $this->load->model("quizSession");
        $userAnswers= $this->quizSession->getUserAnswers($this->session->userdata('session_id'));

        for($i=0; $i<sizeof($quiz); $i++)
        {
            if($userAnswers[$i] !== ''){ $score['answered']++; }
            if($quiz[$i]->answer ===  $userAnswers[$i]){
                $score['correct']++;
            }else{
                $score['wrong']++;
            } 
        }
        $this->session->sess_destroy();
        $score['percentage'] = $score['correct']*100/sizeof($quiz);
        $score['skipped'] = $score['total'] - $score['answered'];
        $this->load->view('resultView', $score);
    }
    private function formateTime($seconds){
        $hours = 0;
        $minutes = 0;
        if($seconds < 60){
            return $seconds + " seconds";
        }
        $minutes = $seconds/60;
        $secondsLeft = $seconds - ($minutes*60);
        if($minutes <60){ 
            return $minutes + " minutes and " + $secondsLeft + " seconds";
        }
        $hours = $minutes/60;
        $minutesLeft = $minutes - ($hours*60);
        return $hours + "hours " + $minutesLeft + " minutes and " + $secondsLeft + " seconds";
    }
    public function test(){
        echo "test text";
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
    public function loadLogin(){
        $this->load->view('loginForm', null);
    }
}
/* End of file quizController.php */
/* Location: ./application/controllers/quizController.php */
