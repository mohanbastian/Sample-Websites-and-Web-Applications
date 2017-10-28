<?php

class QuizSession extends CI_Model
    {
        function addQuestionAnswer($sessionId, $username, $category, $answer, $questionNo)
        {
            $this->load->database();
            $this->db->where('sessionId', $sessionId);
            $this->db->where('questionNo',$questionNo);
            $result = $this->db->get('quizsession');
            $data = array(
                'sessionId' => $sessionId,
                'username' => $username,
                'category' => $category,
                'answer' => $answer,
                'questionNo' => $questionNo
            );
            if($result->num_rows() > 0)
            {
                $this->db->where('sessionId', $sessionId);
                $this->db->where('questionNo',$questionNo);
                $this->db->update('quizsession', $data); 
            }else{
                $this->db->insert('quizsession', $data);
            }
        }
        
        function getUserAnswers($sessionId)
        {
            $this->load->database();
            $this->db->where('sessionId', $sessionId);
            $this->db->order_by('questionNo', 'ASC');
            $query = $this->db->get('quizsession');
            
            if($query->num_rows() > 0)
            {
                $myrecords = array();
                $i=0;
                foreach($query->result() as $q){
                    $myrecords[$i]= $q->answer;
                    $i++;
                }
                return $myrecords;
            }
        }
    }
/* End of file quizSession.php */
/* Location: ./application/models/quizSession.php */