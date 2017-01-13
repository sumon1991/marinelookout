<?php

#########################################################################
#                                                                       #
#			This is Blog model.                             #
#	                                         			#
#									#
#									#
#									#
#									#
#									#
#########################################################################


class Model_blog extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#           This is Blog model.                         #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allBlogDB($search_by='', $limit='', $offset=0)
	{
	    $this->db->select('BM.*');
            $this->db->from('ep_blog BM');
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('BM.id','DESC');
            if($search_by <> '')
            {
                $this->db->like('BM.title',$search_by);
                $this->db->or_like('BM.first_name', $search_by);
                $this->db->or_like('BM.last_name', $search_by);
                
             }
            $query=$this->db->get();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL Blog NUMBER                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function countBlogDB($search_by='')
        {
            $this->db->select('SUM(IF(BM.id<>"",1,0)) as total_blog',false);
            $this->db->from('ep_blog BM');
            if($search_by <> '')
            {
                $this->db->like('BM.title',$search_by);
                $this->db->or_like('BM.first_name', $search_by);
                $this->db->or_like('BM.last_name', $search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_blog'];

	}

        
}
?>