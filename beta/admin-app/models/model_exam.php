<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_exam extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getAllExamList(&$config,&$start)
	{
		$student_id	= $this->uri->segment(5);
		$page 		= $this->uri->segment(3,0);
		$isSession	= $this->uri->segment(4);
		$order_by	= $this->input->get_post('order_by');
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('EXAM');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('EXAM', $sessionDataArray);		
		
		$start 	= 0;
		
		$where	= 'WHERE 1 AND student_id = '.$student_id;			
		if($search_keyword != ''){
			$where.= " AND (contact_name like '%".$search_keyword."%'
					OR email_address like '%".$search_keyword."%'
					OR sales_rentals like '%".$search_keyword."%'
					)
				 ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_examination ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT EE.*,ES.firstname,ES.lastname,ES.gender,ESJ.title FROM ep_examination as EE
		INNER JOIN ep_student AS ES ON ES.id = EE.student_id
		INNER JOIN ep_subject AS ESJ ON ESJ.id = EE.subjects
		".$where." LIMIT ".$start.",".$config['per_page'];
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();
		//pr($rec);
		return array_values($rec);
	}
}


