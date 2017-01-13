<?php

/*
 ------------------------------------
  Model Student: Listing & Pegination
 ------------------------------------
 */

class Model_blogpost extends CI_Model {

		 // Get all students:
		 
		 function allBlogPostDB($search_by='', $limit='', $offset=0)
		 {
				  //pr($_POST);
				  $this->db->select('SM.*');
				  $this->db->from('ep_blog_posts SM');
				  $this->db->join('ep_blog_author BA', 'BA.id = SM.post_author');
				  if($limit > 0) {
						   $this->db->limit($limit, $offset);
				  }
				  $this->db->order_by('SM.id','DESC');
				  if($search_by <> '')
				  {
						   $this->nsession->set_userdata('BLOGPOST_SEARCH', $search_by);	  
						   $this->db->like('SM.post_title', $search_by);
						   $this->db->or_like('BA.name', $search_by);
				  }
				  $query=$this->db->get();
				  //echo $this->db->last_query();
				  // pr($query->result_array());
				  return $query->result_array();

		 }
		 
		 // Get total number of students:
		 
		 function countBlogPostDB($search_by='')
		 {	 
				 $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_blog_post',false);
				 $this->db->from('ep_blog_posts SM');
				 if($search_by <> '')
				 {
						   $this->db->like('SM.post_title', $search_by);
				 }
				 $query = $this->db->get();
				 $result = $query->result_array();
				 return $result[0]['total_blog_post'];	 
		 }

        
}