<?php
class Model_attempt_test extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }
// GET ALL USER 
    function allSubjectDB($search_by='', $limit='', $offset=0) {
            $this->db->select('*');
            $this->db->from('ep_subject');
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('id','DESC');
            
            $query=$this->db->get();
	    //echo $this->db->last_query();
	    //pr($query->result_array());
	    $result = '';
	    if($query->num_rows()>0){
		$result =  $query->result_array();
		foreach($result as $k=>$res){
		    $this->db->select('COUNT(*) as total');
		    $this->db->from('ep_examination');
		    $this->db->where('subjects',$res['id']);
		    if($search_by <> '')
		    {
			$this->nsession->set_userdata('ATTEMPT_TEST_SEARCH',$search_by);    
			$this->db->where("DATE_FORMAT(added_on,'%m/%d/%Y')",$search_by);
			
		    }
		    $query	=  $this->db->get();
		    $exam_result =  $query->row_array();
		    $result[$k]['total'] = $exam_result['total'];
		}
	    }
	    return $result;
    }


    //GET TOTAL USER NUMBER         


	function countSubjectDB($search_by='')
        {

            $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_subject',false);
            $this->db->from('ep_subject SM');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_subject'];

	}

        
}