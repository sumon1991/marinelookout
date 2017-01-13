<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_common extends CI_Model
{
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	/*
	-----------------
	SELECT
	-----------------
	*/

	public function fetch_data($tablename='', $findArray=array(), $match='')
	{	
		//print_r($findArray);
		if(!empty($findArray)){
			$this->db->where($findArray);	
		}	
		//echo $match;
		if(!empty($match)){
			$this->db->like('region_name', 'match');
			$this->db->or_like('region_slug', $match);
			$this->db->or_like('meta_description', $match);
		}
		//$this->db->select('');

		$this->db->order_by("id", "DESC"); 
		$query = $this->db->get($tablename);

		if($query->num_rows()>0){
			return $query->result_array();
			// For fetching single record, use 'row_array()' inplace of 'result_array()'
		}
	}

	/*
	-----------------
	SELECT MAX
	-----------------
	*/

	public function fetch_max($tablename, $fieldname)
	{	
		//print_r($findArray);
		//$this->db->where($findArray);
		$this->db->select_max($fieldname);
		$query = $this->db->get($tablename);

		if($query->num_rows()>0){
			return $query->result_array();
			// For fetching single record, use 'row_array()' inplace of 'result_array()'
		}
	}

	/*
	-------------------
	INSERT
	-------------------
	*/

	public function insert_user($tableName, $insertArray)
	{
		$flag = FALSE;

		if($tableName == '')
			return $flag;
		
		if($insertArray && is_array($insertArray))
		{
			$this->db->insert($tableName, $insertArray);
			//echo $this->db->last_query(); die;
			$flag = $this->db->insert_id(); 
		}

		return $flag;
	}

	/*
	---------------------
	DELETE
	---------------------
	*/

	public function delete_user($tablename, $fieldname, $id)
	{		
		$this->db->where($fieldname, $id);	
		$rec	= $this->db->delete($tablename);

		return $rec;
	}


	/*
	----------------------
	UPDATE
	----------------------
	*/

	public function update_user($tablename, $updateArray, $fieldname, $id)
	{	
		$this->db->set($updateArray);
		$postArray = $this->db->where($fieldname, $id);	
		$updatedResult = $this->db->update($tablename);
		//pr($postArray);
		
		// Checks if row affected or not
		$rowIsAffected = $this->db->affected_rows();
                if($rowIsAffected > 0) {
			return $updatedResult;
		}
		else return $this->db->affected_rows();
	}

	public function checkRowExists($tableName, $whereArr)
	{ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');		
		$this->db->where($whereArr);
		$query = $this->db->get($tableName);
		//echo $this->db->last_query();exit();
		if ($query->num_rows() > 0){
		    return 0;
		}else{
		    return 1;
		}
	}
	public function getList(&$config,&$start)
	{
		$page 		= $this->uri->segment(4,0);
		$isSession	= $this->uri->segment(5);
		$property_id	= $this->uri->segment(3);
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('QUESIONS');
			$search_keyword = trim($param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else
		{
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 						= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']				= $page;		
		$sessionDataArray['per_page'] 			= $per_page;
		$search_keyword	= mysql_real_escape_string(trim($search_keyword));
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('QUESIONS', $sessionDataArray);		
		
		$start 	= 0;
		
		
		if($search_keyword != ''){
			$where.= " AND (title like '%".$search_keyword."%' ";
		}
		
		
		$sql = "SELECT *
				FROM ".QUESION." ";
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rs->num_rows();
		//echo $rs->num_rows();
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		
		
		$sql = "SELECT *
			FROM ".QUESION."
			
			".$where."
					
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		        
		return $rec;
	}


	// LISTING: JOIN 2 Tables
	public function listQuestion()
	{
		$sql = "SELECT eq.*, es.title AS subject_title			
			FROM ep_question AS eq
			LEFT JOIN ep_subject AS es ON eq.subject_id = es.id
			ORDER BY eq.id DESC";
		$rs	= $this->db->query($sql);
		$rec	= false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}

	// VIEW QUESTION & ANSWER: JOIN 3 Tables(ep.question, ep.answer, ep.subject)
	public function viewQuestionAndAnswer($id)
	{
		$sql = "SELECT qm.id, qm.title AS question,qm.question_type, qm.group AS subject_group, qm.question_order AS question_order, qm.is_active AS question_status, am.title AS answer, am.is_correct AS is_correct_answer, am.is_active AS answer_status, sm.id AS subject_id, sm.title AS subject_title			
			FROM ".QUESTION." AS qm
			LEFT JOIN ".ANSWER." AS am ON qm.id = am.question_id
			LEFT JOIN ".SUBJECT." AS sm ON qm.subject_id = sm.id
			WHERE qm.id=".$id."
			ORDER BY qm.id DESC";
		$rs	= $this->db->query($sql);
		$rec	= false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		//pr($rec);
			          
		return $rec;
	}

	public function getNotificationList($id)
	{		
		$sql = "SELECT id,added_on, message FROM ep_notifications WHERE FIND_IN_SET( '".$id."', user_ids )";		
		$rs = $this->db->query($sql);		
		$rec = false;		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	//
	function check_email_availablity()
	{
		$email = trim($this->input->post('email'));
		$email = strtolower($email);	
		
		$query = $this->db->query('SELECT * FROM ep_student where email="'.$email.'"');
		
		if($query->num_rows() > 0)
		return false;
		else
		return true;
	}
}

//SELECT message, user_ids FROM `ep_notifications` WHERE FIND_IN_SET( '10', user_ids )
