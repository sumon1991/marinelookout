<?php

class Model_question extends CI_Model {

    function allQuestionDB($search_by='', $limit='', $offset=0) {

            $this->db->select('QM.*,SM.title AS subject_title');
            $this->db->from('ep_question QM');
            $this->db->join('ep_subject SM', 'SM.id = QM.subject_id','JOIN');
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('QM.id','DESC');
            if($search_by <> '')
            {
		$this->nsession->set_userdata('QUESTION_SEARCH',$search_by);
                $this->db->like('QM.title',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
	        //pr($query->result_array());
            return $query->result_array();

	}


// GET TOTAL QUESTION NUMBER

	function countQuestionDB($search_by='')
        {

            $this->db->select('SUM(IF(QM.id<>"",1,0)) as total_question',false);
            $this->db->from('ep_question QM');
            if($search_by <> '')
            {
                $this->db->like('QM.title',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_question'];

	}

        
}