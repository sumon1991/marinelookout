<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_examination extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_question_list($subject_slug = '')
	{
		$final_array			= array();
		//$total_no_of_question 		= $this->model_basic->get_settings(57);
		$exam_Detils	= $this->model_basic->getValues_conditions('ep_subject','','','subject_slug = "'.$subject_slug.'"');
		$total_no_of_group_A_question 	= $this->model_basic->get_settings(58);
		$total_no_of_group_B_question 	= $this->model_basic->get_settings(59);
		$total_no_of_group_A_question 	= ceil(($total_no_of_group_A_question['group_a']/100)*$exam_Detils[0]['total_question']);
		$total_no_of_group_B_question 	= ceil(($total_no_of_group_B_question['group_b']/100)*$exam_Detils[0]['total_question']);
		
		$sql = 'SELECT EQ.id, EQ.title, EQ.slug, EQ.subject_id, EQ.group,EQ.question_type, EQ.question_order,EQ.image FROM ep_question AS EQ
		INNER JOIN ep_subject AS ES ON ES.subject_slug = "'.$subject_slug.'"
		WHERE EQ.subject_id = ES.id AND EQ.is_active = "yes" AND EQ.group = "A"
		GROUP BY EQ.id ORDER BY RAND(),EQ.question_order ASC LIMIT '.$total_no_of_group_A_question;
		$rs	= $this->db->query($sql);
		$group_a= $rs->result_array();
		foreach($group_a as $v)
		{
			$final_array[] = $v;
		}
		
		$sql = 'SELECT EQ.id, EQ.title, EQ.slug, EQ.subject_id, EQ.group, EQ.question_order,EQ.question_type,EQ.image FROM ep_question AS EQ
		INNER JOIN ep_subject AS ES ON ES.subject_slug = "'.$subject_slug.'"
		WHERE EQ.subject_id = ES.id AND EQ.is_active = "yes" AND EQ.group = "B"
		GROUP BY EQ.id ORDER BY RAND(),EQ.question_order ASC LIMIT '.$total_no_of_group_B_question;
		$rs	= $this->db->query($sql);
		$group_b= $rs->result_array();
		foreach($group_b as $v)
		{
			$final_array[] = $v;
		}
		
		if(is_array($final_array) && COUNT($final_array))
		{
			foreach($final_array as $k=>$v)
			{
				$sql 	= 'SELECT * FROM ep_answer AS EA
				WHERE EA.question_id = '.$v['id'];
				$rs	= $this->db->query($sql);
				$answer 	= $rs->result_array();
				$final_array[$k]['answer_list']	=	$answer;
			}
		}
		return $final_array;
	}
	
	
	public function get_exam_list()
	{
		$student_id	= $this->session->userdata('student_id');
		$sql 	= 'SELECT EE.id,ES.title,EE.added_on,EE.is_passed,EE.total_score,(SELECT COUNT(*) 
		FROM ep_examination_details  WHERE examination_id = EE.id) as totalQuestion
		FROM ep_examination AS EE
		INNER JOIN ep_subject AS ES ON ES.id = EE.subjects
		WHERE EE.student_id = "'.$student_id.'" order by EE.id DESC';
		$rs	= $this->db->query($sql);
		$rec	= $rs->result_array();		
		//pr($rec);
		return $rec;
	}
	
	public function getDetails($exam_id = '')
	{
		$sql 	= 'SELECT EE.id,ES.title,EE.added_on,EE.is_passed,EE.total_score,(SELECT COUNT(*) 
		FROM ep_examination_details  WHERE examination_id = EE.id) as totalQuestion
		FROM ep_examination AS EE
		INNER JOIN ep_subject AS ES ON ES.id = EE.subjects
		WHERE EE.id = '.$exam_id;
		$rs	= $this->db->query($sql);
		$rec	= $rs->result_array();
		if(isset($rec[0]['id']))
		{
			$sql 	= 'SELECT EED.is_correct,EED.answer_id as user_given_answer,EED.question_id,EQ.title,EQ.group,EQ.question_type,EQ.image
			FROM ep_examination_details AS EED
			INNER JOIN ep_question AS EQ ON EQ.id = EED.question_id
			WHERE EED.examination_id = '.$rec[0]['id'];
			$rs		= $this->db->query($sql);
			$question_list	= $rs->result_array();		
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
	
	public function get_subject()
	{
		$subject_list 	= $this->model_basic->getValues_conditions('ep_subject','','','is_active = "yes"');
		if(is_array($subject_list) && COUNT($subject_list)>0)
		{
			foreach($subject_list as $k=>$v)
			{
				$no_of_a_qsn = $this->model_basic->getValue_condition('ep_question as EQ','COUNT(*)','','EQ.group = "A" AND EQ.subject_id = '.$v['id']);
				$no_of_b_qsn = $this->model_basic->getValue_condition('ep_question as EQ','COUNT(*)','','EQ.group = "B" AND EQ.subject_id = '.$v['id']);
				$total_no_of_group_A_question 	= $this->model_basic->get_settings(58);
				$total_no_of_group_B_question 	= $this->model_basic->get_settings(59);
				$total_no_of_group_A_question 	= ceil(($total_no_of_group_A_question['group_a']/100)*$v['total_question']);
				$total_no_of_group_B_question 	= ceil(($total_no_of_group_B_question['group_b']/100)*$v['total_question']);
				
				if($v['total_question'] > ($no_of_a_qsn+$no_of_b_qsn) || ($no_of_a_qsn < $total_no_of_group_A_question) || ($no_of_b_qsn< $total_no_of_group_B_question))
					unset($subject_list[$k]);
			}
		}
		return array_values($subject_list);
	}
}