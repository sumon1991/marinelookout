<?php
class Model_teammember extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }
     //GET ALL USER     
                                                     
	function allMemberDB($search_by='', $limit='', $offset=0) {
            // $role = 'editor';
            $this->db->select('EM.*');
            $this->db->from('ep_team_members EM');
            // $this->db->where('role', $role);
            if($limit > 0) {
		      $this->db->limit($limit, $offset);
            }
            $this->db->order_by('EM.id','DESC');
            if($search_by <> '')
            {
				$this->nsession->set_userdata('MEMBER_SEARCH',$search_by);
                $this->db->like('EM.member_name',$search_by);
                $this->db->or_like('EM.short_description', $search_by);
                $this->db->or_like('EM.designation', $search_by);
                
            }
            $query=$this->db->get();
            //echo $this->db->last_query();
	        //pr($query->result_array());
            return $query->result_array();

	}


//   GET TOTAL USER NUMBER 


    function countMemberDB($search_by='')
    {
	// $role = 'editor';
	$this->db->select('SUM(IF(EM.id<>"",1,0)) as total_member',false);
	$this->db->from('ep_team_members EM');
	// $this->db->where('role', $role);
	if($search_by <> '')
	{
	    $this->db->like('EM.member_name',$search_by);
        $this->db->or_like('EM.short_description', $search_by);
        $this->db->or_like('EM.designation', $search_by);
	}
	$query = $this->db->get();
	$result = $query->result_array();
	//pr($result);
	return $result[0]['total_member'];

    }

    public function insertWPdata($password= '',$name='',$email='')
    {
	$sql = "INSERT INTO `epwp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_status`)
VALUES ('".$email."', MD5('".$password."'), '".$name."', '".$email."', '0')";
	$rec 	= $this->db->query($sql);
	
	$sql = "INSERT INTO `epwp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
	VALUES (NULL, (Select max(id) FROM epwp_users), 'wp_capabilities', 'a:1:{s:6:\\'administrator\\';s:1:\\'1\\';}')";
	$rec 	= $this->db->query($sql);

	$sql =  "INSERT INTO `epwp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
	VALUES (NULL, (Select max(id) FROM epwp_users), 'wp_user_level', '10')";
	$rec 	= $this->db->query($sql);
	
	return true;
    }
    
//    public function updateWPdata($name='',$email='')
//    {
//	$sql = "INSERT INTO `wp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_status`)
//VALUES ('new_user_name', MD5('pass123'), 'firstname lastname', 'email@example.com', '0')";
//	$rec 	= $this->db->query($sql);
//	
//	return true;
//    }
}