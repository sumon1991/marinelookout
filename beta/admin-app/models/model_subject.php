<?php
class Model_subject extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }
// GET ALL USER 
function allSubjectDB($search_by='', $limit='', $offset=0) {

            $this->db->select('SM.*,(SELECT COUNT(*) FROM ep_question as EQ WHERE EQ.group = "A" AND EQ.subject_id = SM.id) as no_of_a_qsn,(SELECT COUNT(*) FROM ep_question as EQ WHERE EQ.group = "B" AND EQ.subject_id = SM.id) as no_of_b_qsn');
            $this->db->from('ep_subject SM');
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('SM.id','DESC');
            if($search_by <> '')
            {
		$this->nsession->set_userdata('SUBJECT_SEARCH',$search_by);    
                $this->db->like('SM.title',$search_by);
             }
            $query=$this->db->get();
	    //echo $this->db->last_query();
	    //pr($query->result_array());
            return $query->result_array();

	}


    //GET TOTAL USER NUMBER         


	function countSubjectDB($search_by='')
        {

            $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_subject',false);
            $this->db->from('ep_subject SM');
            if($search_by <> '')
            {
                $this->db->like('SM.title',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_subject'];

	}

        
}