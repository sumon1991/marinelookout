<?php

class Model_payment extends CI_Model
 {

    function __construct()

    { parent::__construct();
    }

	function allPaymentDB($search_by='', $limit='', $offset=0)
	{	   
           
            $this->db->select('PM.*,ST.firstname,ST.lastname');
            $this->db->from('ep_payment PM');
	    $this->db->join('ep_student ST', 'ST.id = PM.student_id', 'union'); 
   
	   
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('PM.order_no','DESC');
            if($search_by <> '')
            {
		$this->nsession->set_userdata('PAYMENT_SEARCH',$search_by);
                $this->db->like('PM.order_no',$search_by);
		$this->db->or_like('ST.firstname',$search_by);
		$this->db->or_like('ST.lastname',$search_by);
	       
            }
            $query=$this->db->get();
	        //echo $this->db->last_query();
	     
            return $query->result_array();

	}


             // GET TOTAL USER NUMBER                    
   
     function countPaymentDB($search_by='')
        {
           
            $this->db->select('SUM(IF(PM.id<>"",1,0)) as total_payment ,PM.*,ST.firstname,ST.lastname',false);
	    
            $this->db->from('ep_payment PM');
	     $this->db->join('ep_student ST', 'ST.id = PM.student_id', 'union'); 
            if($search_by <> '')
            {
                $this->db->like('PM.order_no',$search_by);
		$this->db->or_like('ST.firstname',$search_by);
		$this->db->or_like('ST.lastname',$search_by);
		
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_payment'];

	}

        function viewPayment($viewId)
	{	   
           
            $this->db->select('PM.*,ST.firstname,ST.lastname,ST.email,ST.mobile');
            $this->db->from('ep_payment PM');
	    $this->db->join('ep_student ST', 'ST.id = PM.student_id', 'join'); 
	    $this->db->where('PM.id', $viewId);   
	    $query = $this->db->get();
	    return $query->result_array();  
	}
	
}
?>