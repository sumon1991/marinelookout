<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Administrator extends CI_Model
{
	var $adminUser = 'ep_admin'; 
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getSingle($email, $password)
	{
		$rec = array();
		$sql = "SELECT AD.*,ER.menu_id FROM ".ADMIN." as AD
		INNER JOIN ep_role as ER ON ER.role_type = AD.role
		WHERE AD.admin_email = '".$email."' AND AD.password = '".$password."'";
		$rs = $this->db->query($sql);		
		$rect = $rs->row_array();				
		return $rect;	
	}

	 public function get_single($id){
		$sql = "SELECT * FROM ".$this->adminUser." WHERE id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}

	 public function get_list(&$config,&$start, $type = 'admin'){
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
				$param			= $this->nsession->userdata('ADMIN_USER');
			else if($type == 'agent')
				$param = $this->nsession->userdata('AGENT');
			//else if($type == 'rental')
			//	$param			= $this->nsession->userdata('RENTAL_USER');
			else
				$param			= $this->nsession->userdata('VA_USER');
				
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 		= $page;		
		$sessionDataArray['per_page'] 			= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
			$this->nsession->set_userdata('ADMIN_USER', $sessionDataArray);
		else if($type == 'agent')
			$this->nsession->set_userdata('AGENT', $sessionDataArray);
			//else if($type == 'rental')
			//	$this->nsession->set_userdata('RENTAL_USER', $sessionDataArray);	
		else
			$this->nsession->set_userdata('VA_USER', $sessionDataArray);
		
		$start 			= 0;
		$where 			= ' WHERE role = "'.$type.'" ';
				
		if($search_keyword != ''){
			$where.= " AND (first_name like '%".$search_keyword."%'
					 	OR last_name like '%".$search_keyword."%' 
						OR email_id like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".$this->adminUser." ".$where." ";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT u.* FROM ".$this->adminUser." AS u  ".$where."  LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function addAdminUsers($user_image='', $type = 'admin') {
		
		$image_name = '';    
		if($user_image != '')
		{
		    $image_name = $user_image;
		}
            
		$first_name     = strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		$last_name      = strip_tags(addslashes(trim($this->input->get_post('last_name'))));
		$email_address  = strip_tags(addslashes(trim($this->input->get_post('email_address'))));
		$password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
		$role_id        = $type;
		
		$phone_no 	= strip_tags(addslashes(trim($this->input->get_post('phone_no'))));
		$skype_id 	= strip_tags(addslashes(trim($this->input->get_post('skype_id'))));
		if(isset($phone_no) && $phone_no!= '')
			$phone_no = $phone_no;
		else
			$phone_no = '';
			
		if(isset($skype_id) && $skype_id!= '')
			$skype_id = $skype_id;
		else
			$skype_id = '';

		$sql = "INSERT INTO `".$this->adminUser."` 
			SET
			first_name = '".$first_name."', 
			last_name = '".$last_name."',
			phone_no = '".$phone_no."', 
			skype_id = '".$skype_id."',
			email_id = '".$email_address."', 
			password = '".$password."', 
			image    = '".$image_name."',
			role = '".$role_id."'";
		
		//echo $sql;
		//exit();
		$this->db->query($sql);
		return true;
	}

	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM ".SETTINGS." WHERE sitesettings_id in (".$id.") ";
		//echo $sql; exit;
		$query = $this->db->query($sql);
		$rec = false;
		if ($query->num_rows() > 0){
		    foreach ($query->result_array() as $row){
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}


 		public function getUserByEmail($email='') // get user details by email
	{
		$rec = array();
		$sql = "SELECT * FROM ".STUDENT."  WHERE email = '".$email."'";
		$rs  = $this->db->query($sql);
		$rec = $rs->row_array();
		if($rs->num_rows())
		{
			$rec = $rs->result_array();
		}
		return $rec;
	}

}

?>