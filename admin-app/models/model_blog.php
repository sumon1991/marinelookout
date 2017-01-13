<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_blog extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getList(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('BLOG_SEARCH');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= $this->input->get_post('search_keyword',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		$search_keyword = trim($search_keyword);
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('BLOG_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != ''){
			$where.= " AND title like '%".$search_keyword."%' OR first_name like '%".$search_keyword."%' OR last_name like '%".$search_keyword."%'";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_blog ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT title,first_name,last_name,no_views,status,CONCAT('".BACKEND_URL."blog/edit/',id) as edit_link,
		CONCAT('".BACKEND_URL."blog/delete/',id) as delete_link
			FROM ep_blog".$where."
			ORDER BY id DESC
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		
		return $rec;
	}

	public function getallcategories()
	{
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		return $rec;
	}

	
	public function get_single($id){
		$sql = "SELECT * FROM ep_blog WHERE id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getcategoryList(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_blog_categories";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT *,CONCAT('".BACKEND_URL."blog/edit/',id) as edit_link,
		CONCAT('".BACKEND_URL."blog/delete/',id) as delete_link
			FROM ep_blog_categories 
			ORDER BY id DESC
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		
		return $rec;
	}
	
	public function getauthorList(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_blog_author";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT *,CONCAT('".BACKEND_URL."blog/edit/',id) as edit_link,
		CONCAT('".BACKEND_URL."blog/delete/',id) as delete_link
			FROM ep_blog_author 
			ORDER BY id DESC
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		
		return $rec;
	}

	public function getParent($pid)
	{
		$sql="SELECT * FROM ep_blog_categories where id = $pid";
		$rs = $this->db->query($sql);
		
		$rec = $rs->result_array();
		return $rec[0];
	}
	
}