<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_notification extends CI_Model
{
	var $cmsTable = 'ep_cms';
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getList($search_keyword,$start=0)
	{		
		$where = '';
		
		if($search_keyword){
			$start = 0;
			$where .= " where message like '%".$search_keyword."%' ";
			$where .= " OR added_on like '%".$search_keyword."%' ";
		}
		$sql = "SELECT * 
			FROM ep_notifications ".$where."
			ORDER BY added_on DESC
			LIMIT ".$start.",".PER_PAGE_LISTING;
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}

	
	
	
}