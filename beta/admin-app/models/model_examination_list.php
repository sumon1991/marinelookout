<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_examination_list extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getAllExamList(&$config,&$start)
	{
		$student_id	= $this->uri->segment(5);
		$page 		= $this->uri->segment(6,0);
		$isSession	= $this->uri->segment(6);
		$order_by	= $this->input->get_post('order_by');
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('is_show_all') == 1)
		{
			$param		= '';
			$search_keyword = '';
			$per_page 	= '';
		}
		elseif($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
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
		if($search_keyword != '')
		{
			$where.= " AND (ES.title like '%".$search_keyword."%')";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_examination AS EE
		INNER JOIN ep_student AS EU ON EU.id = EE.student_id
		INNER JOIN ep_subject AS ES ON ES.id = EE.subjects		
		".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT EU.firstname,EU.lastname,EE.id as examinationId,ES.title,EE.added_on,EE.is_passed,EE.total_score,(SELECT COUNT(*) 
		FROM ep_examination_details  WHERE examination_id = EE.id) as totalQuestion
		FROM ep_examination AS EE
		INNER JOIN ep_student AS EU ON EU.id = EE.student_id
		INNER JOIN ep_subject AS ES ON ES.id = EE.subjects		
		".$where." LIMIT ".$start.",".$config['per_page'];
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();
			//pr($rec);
		return array_values($rec);
	}
	public function getDetails($exam_id = '')
	{
		$sql = 'SELECT EE.id,ES.title,EE.added_on,EE.is_passed,EE.total_score,(SELECT COUNT(*) 
		FROM ep_examination_details  WHERE examination_id = EE.id) as totalQuestion
		FROM ep_examination AS EE
		INNER JOIN ep_subject AS ES ON ES.id = EE.subjects
		WHERE EE.id = '.$exam_id;
		$rs	= $this->db->query($sql);
		$rec	= $rs->result_array();
		//pr($rec);
		if(isset($rec[0]['id']))
		{
			$sql 	= 'SELECT EED.is_correct,EED.answer_id as user_given_answer,EED.question_id,EQ.title,EQ.group,EQ.question_type,EQ.image
			FROM ep_examination_details AS EED
			INNER JOIN ep_question AS EQ ON EQ.id = EED.question_id
			WHERE EED.examination_id = '.$rec[0]['id'];
			$rs		= $this->db->query($sql);
			$question_list	= $rs->result_array();
			//pr($question_list);
			if(is_array($question_list) && COUNT($question_list)>0)
			{
				foreach($question_list as $k=>$v)
				{
					$sql 	= 'SELECT EA.id,EA.title,EA.is_correct,EA.answer_type
					FROM ep_answer AS EA
					WHERE EA.question_id = '.$v['question_id'];
					$rs		= $this->db->query($sql);
					$answer_list	= $rs->result_array();
					$question_list[$k]['answer_list'] = $answer_list;
				}
			}
			$rec[0]['question_answer_details'] = $question_list;
		}
		return $rec;
	}
}


