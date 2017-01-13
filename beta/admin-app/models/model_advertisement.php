<?php

class Model_advertisement extends CI_Model
 {

    function __construct()

    { parent::__construct();
    }

	function allAdvertiseDB($search_by='', $limit='', $offset=0)
	{	   
            //$role = 'editor';
            $this->db->select('EM.*');
            $this->db->from('ep_advertisement EM');
            //$this->db->where('role', $role);
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('EM.id','DESC');
            if($search_by <> '')
            {
		$this->nsession->set_userdata('ADVERTISE_SEARCH',$search_by);
                $this->db->like('EM.title',$search_by);                
            }
            $query=$this->db->get();
	        //echo $this->db->last_query();
	        //pr($query->result_array());
            return $query->result_array();

	}


             // GET TOTAL USER NUMBER                    
   
     function countAdvertiseDB($search_by='')
        {
            //$role = 'editor';
            $this->db->select('SUM(IF(EM.id<>"",1,0)) as total_editor',false);
            $this->db->from('ep_advertisement EM');
            //$this->db->where('role', $role);
            if($search_by <> '')
            {
                $this->db->like('EM.title',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_editor'];

	}

        
}
?>