<?php

class Quiz extends CI_Model
    {
        function getQuizForCategory($category)
        {
            $this->load->database();
            $this->db->where('category', $category);
            $query = $this->db->get("quiz");
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        
        function getAllQuiz(){
            $this->load->database();
            $query = $this->db->get("quiz");
            if($query->num_rows() > 0)
            {
                $resultarr = array();
                foreach ($query->result() as $row){
                    $resultarr[] = array(
                        'name' => $row->name,
                        'answer' => $row->answer,
                        'category' => $row->category,
                        'choice1' => $row->choice1,
                        'choice2' => $row->choice2,
                        'choice3' => $row->choice3,
                        'choice4' => $row->choice4
                    );
                }
                
                //return $resultarr;
                //return json_encode($resultarr);
                //echo $query->result();
                return $query->result(); 
                
            }
            
        }
        
        function getQuiz($id){
            $this->load->database();
            $this->db->where('id', $id);
            $query = $this->db->get("quiz");
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        
        function insertQuiz($id, $name, $answer, $category, $choice1, $choice2, $choice3, $choice4){
            $this->load->database();
            $data = array(
                'name' => $name,
                'answer' => $answer,
                'category' => $category,
                'choice1' => $choice1,
                'choice2' => $choice2,
                'choice3' => $choice3,
                'choice4' => $choice4
            );
            if($id == ''){
                $this->db->insert('quiz', $data);
            }else{
                $this->db->where('id', $id);
                $this->db->update('quiz', $data);
            }
        }
    }
/* End of file quiz.php */
/* Location: ./application/models/quiz.php */