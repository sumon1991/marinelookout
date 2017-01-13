<?php

/*
 ------------------------------------
  Model Student: Listing & Pegination
 ------------------------------------
 */

class Model_testimonial extends CI_Model {

		 // Get all students:
		 
		 function allTestimonialDB($search_by='', $limit='', $offset=0)
		 {
				  //pr($_POST);
				  $this->db->select('SM.*');
				  $this->db->from('ep_testimonials SM');
				  //$this->db->where('role_id ', $id);
		 
				  if($limit > 0) {
						   $this->db->limit($limit, $offset);
				  }
				  $this->db->order_by('SM.id','DESC');
				  if($search_by <> '')
				  {
						   $this->nsession->set_userdata('TESTIMONIAL_SEARCH', $search_by);	  
						   $this->db->like('SM.name', $search_by);
				  }
				  $query=$this->db->get();
				  // echo $this->db->last_query();
				  // pr($query->result_array());
				  return $query->result_array();

		 }
		 
		 // Get total number of students:
		 
		 function countTestimonialDB($search_by='')
		 {	 
				 $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_testimonial',false);
				 $this->db->from('ep_testimonials SM');
				 if($search_by <> '')
				 {
						   $this->db->like('SM.name', $search_by);
				 }
				 $query = $this->db->get();
				 $result = $query->result_array();
				 return $result[0]['total_testimonial'];	 
		 }

        
}