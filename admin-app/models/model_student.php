<?php

/*
 ------------------------------------
  Model Student: Listing & Pegination
 ------------------------------------
 */

class Model_student extends CI_Model {

		 // Get all students:
		 
		 function allStudentDB($search_by='', $limit='', $offset=0)
		 {
				  //pr($_POST);
				  $this->db->select('SM.*');
				  $this->db->from('ep_student SM');
				  //$this->db->where('role_id ', $id);
		 
				  if($limit > 0) {
						   $this->db->limit($limit, $offset);
				  }
				  $this->db->order_by('SM.id','DESC');
				  if($search_by <> '')
				  {
						   $this->nsession->set_userdata('STUDENT_SEARCH', $search_by);	  
						   $this->db->like('SM.firstname', $search_by);
						   $this->db->or_like('SM.lastname', $search_by);
						   $this->db->or_like('SM.email', $search_by);						   
						   $this->db->or_like('SM.indos', $search_by);
						   $this->db->or_like('SM.mobile', $search_by);
				  }
				  $query=$this->db->get();
				  // echo $this->db->last_query();
				  // pr($query->result_array());
				  return $query->result_array();

		 }
		 
		 // Get total number of students:
		 
		 function countStudentDB($search_by='')
		 {	 
				 $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_student',false);
				 $this->db->from('ep_student SM');
				 if($search_by <> '')
				 {
						   $this->db->like('SM.firstname', $search_by);
						   $this->db->or_like('SM.lastname', $search_by);
						   $this->db->or_like('SM.email', $search_by);						   
						   $this->db->or_like('SM.indos', $search_by);
						   $this->db->or_like('SM.mobile', $search_by);
				 }
				 $query = $this->db->get();
				 $result = $query->result_array();
				 return $result[0]['total_student'];	 
		 }

        
}