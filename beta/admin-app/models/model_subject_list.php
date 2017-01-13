<?php
class Model_subject_list extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }
     //GET ALL USER     
                                                     
	function allQuestionDBBKP($search_by='', $limit='', $offset=0,$Id='') {
            //$Id = 3;
	    $group = $this->input->get_post('select_group');
            $this->db->select('EM.*');
            $this->db->from('ep_question EM');
            $this->db->where('subject_id',$Id);
	    if($group != '')
		$this->db->where('group', $group);
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('EM.id','DESC');
            if($search_by <> '')
            {
		$this->nsession->set_userdata('QUESTION_LIST_SEARCH',$search_by);
                $this->db->like('EM.title',$search_by);
           
                
             }
            $query=$this->db->get();
        
            return $query->result_array();

	}
	
	
	function allQuestionDB($search_by='', $group_name='', $Id='', $limit='', $offset=0)
	{
	    $this->db->select('EQ.*');
            $this->db->from('ep_question EQ');
            
	    if($search_by <> '')
            {
        	//$where .= " AND EQ.title LIKE '%".$search_by."%'";
		$this->db->like('EQ.title', $search_by	);
	    }
	    
	    if($group_name != '')
	    {
		$this->db->where('EQ.group', $group_name);
	    }
	    
	    if($Id != '')
	    {
		//$where .= " AND EQ.subject_id = '".$Id."'";
		$this->db->where('EQ.subject_id', $Id);
	    }
	    
            if($limit > 0)
	    {
		$this->db->limit($limit, $offset);
            }
	    
            $this->db->order_by('EQ.id','DESC');
            
            $query=$this->db->get();
	    
	    //echo $this->db->last_query();
        
            return $query->result_array();
        
            return $result;

	}


//   GET TOTAL USER NUMBER 


	function countQuestionDB($search_by='', $group_name='', $Id='')
        {
	    $where = '';
	    
	    if($search_by <> '')
            {
        	$where .= " AND EQ.title LIKE '%".$search_by."%'";
	    }
	    
	    if($group_name != '')
	    {
		$where .= " AND EQ.group = '".$group_name."'";
	    }
	    
	    if($Id != '')
	    {
		$where .= " AND EQ.subject_id = '".$Id."'";
	    }
		    
	    $sql	= "SELECT COUNT(*) AS total_editor FROM ep_question  AS EQ WHERE 1 ".$where;
	    $rec	= mysql_query($sql);
	    $result	= mysql_fetch_array($rec);
            
            return $result['total_editor'];

	  }

        
}