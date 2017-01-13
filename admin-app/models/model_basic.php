<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	var $settingstable = 'lp_sitesettings';
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getValue_condition($TableName, $FieldName, $AliasFieldName='', $Condition=''){	
		if($Condition == "") {
			$Condition = "";
		} else {
			$Condition = " WHERE ".$Condition;
		}
		
		if($AliasFieldName == ''){
			$getField = $FieldName;
		}
		else{
			$getField = $AliasFieldName;
			$FieldName = $FieldName ." AS ".$AliasFieldName;
		}
				
		$sql = "SELECT ".$FieldName."  FROM ".$TableName.$Condition;
		
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec = $rs->row();
			
			if(is_numeric($rec->$getField))
			{
				if($rec->$getField > 0)
					return $rec->$getField;
				else
					return "0";
			}
			else{
				return $rec->$getField;
			}
		}else{
			return false;
		}
	}
	
	
	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = ''){
		
		$cnt = 0;
		if($condition == '') $condition = 1;
		
		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
		
		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." <> '".$idValue."'";
		}
		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$rec = $rs->row();
		$cnt = $rec->CNT;

		return $cnt;
	}
	
	
	
	
	
	public function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL) {
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;

		if($key)$params["$key !="] = $value;
		while ($t->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}
		return $slug;
	}
	
	
	public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0) {
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
		
	    if($OrderBy != '') {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 ) {
		$sql .= " LIMIT 0, $Limit";
	    }
	    //echo $sql;exit;
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
	    if($rs->num_rows()) {
			    $rec = $rs->result_array();
	    }else{
		$rec = FALSE;
	    }
	    return $rec;
	}	

    
    	
	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM lp_sitesettings WHERE sitesettings_id in (".$id.") ";
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
	
	
	public function deleteData($table, $where) {
		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		//echo $sql;exit();
		$rec 	= $this->db->query($sql);
		return $rec;
	}


	public function insertIntoTable($tableName,$insertArr)
	{
		// print_r($insertArr);
		// die;
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if($insertArr && is_array($insertArr))
		{
			$this->db->insert($tableName, $insertArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->insert_id();
			// $ret = $this->db->query($this->db->last_query());
		}
		
		return $ret;
	}
	
	public function insertIntoBlogTable($tableName,$insertArr)
	{
		// print_r($insertArr);
		// die;
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if($insertArr && is_array($insertArr))
		{
			
			
			if(array_key_exists('popular_post', $insertArr)){
				$sql = 'INSERT INTO `ep_blog_posts` (`category_id`, `sub_cat_id`, `sub_sub_cat_id`, `sub_sub_sub_cat_id`, `post_author`, `post_short_des`, `post_content`, `featured_image`, `post_title`, `post_slug`, `popular_post`) VALUES ("'.$insertArr['category_id'].'", "'.$insertArr['sub_cat_id'].'", "'.$insertArr['sub_sub_cat_id'].'", "'.$insertArr['sub_sub_sub_cat_id'].'", "'.$insertArr['post_author'].'", "'.mysql_real_escape_string ($insertArr['post_short_des']).'", "'.mysql_real_escape_string ($insertArr['post_content']).'", "'.$insertArr['featured_image'].'", "'.$insertArr['post_title'].'", "'.$insertArr['post_slug'].'", "'.$insertArr['popular_post'].'")';
			} else {
				$sql = 'INSERT INTO `ep_blog_posts` (`category_id`, `sub_cat_id`, `sub_sub_cat_id`, `sub_sub_sub_cat_id`, `post_author`, `post_short_des`, `post_content`, `featured_image`, `post_title`, `post_slug`) VALUES ("'.$insertArr['category_id'].'", "'.$insertArr['sub_cat_id'].'", "'.$insertArr['sub_sub_cat_id'].'", "'.$insertArr['sub_sub_sub_cat_id'].'",  "'.$insertArr['post_author'].'", "'.mysql_real_escape_string ($insertArr['post_short_des']).'", "'.mysql_real_escape_string ($insertArr['post_content']).'", "'.$insertArr['featured_image'].'", "'.$insertArr['post_title'].'", "'.$insertArr['post_slug'].'"';
			}
			// echo $sql;
			// die;
			$ret = $this->db->query($sql);		
			// $config['total_rows'] = 0;
		
			// $ret = $rs->row_array();


			//pr($insertArr);
			// $this->db->insert($tableName, $insertArr);
			// echo $this->db->last_query(); die;
			// //$ret = $this->db->insert_id();
			// $ret = $this->db->query($this->db->last_query());
		}
		
		return $ret;
	}
	
	public function updateIntoBlogTable($tableName, $idArr, $updateArr)
	{
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{	
			
			if(array_key_exists('featured_image', $updateArr)){
				$sql = 'UPDATE `ep_blog_posts` SET `category_id` = "'.$updateArr['category_id'].'", `sub_cat_id` = "'.$updateArr['sub_cat_id'].'", `sub_sub_cat_id` = "'.$updateArr['sub_sub_cat_id'].'", `sub_sub_sub_cat_id` = "'.$updateArr['sub_sub_sub_cat_id'].'", `post_author` = "'.$updateArr['post_author'].'", `post_short_des` = "'.mysql_real_escape_string ($updateArr['post_short_des']).'", `post_content` = "'.mysql_real_escape_string ($updateArr['post_content']).'", `featured_image` = "'.$updateArr['featured_image'].'", `post_title` = "'.$updateArr['post_title'].'", `post_slug` = "'.$updateArr['post_slug'].'", `popular_post` = "'.$updateArr['popular_post'].'", `post_status` = "'.$updateArr['post_status'].'" where id = "'.$updateArr['id'].'"';
			} else {
				$sql = 'UPDATE `ep_blog_posts` SET `category_id` = "'.$updateArr['category_id'].'", `sub_cat_id` = "'.$updateArr['sub_cat_id'].'", `sub_sub_cat_id` = "'.$updateArr['sub_sub_cat_id'].'", `sub_sub_sub_cat_id` = "'.$updateArr['sub_sub_sub_cat_id'].'", `post_author` = "'.$updateArr['post_author'].'", `post_short_des` = "'.mysql_real_escape_string ($updateArr['post_short_des']).'", `post_content` = "'.mysql_real_escape_string ($updateArr['post_content']).'", `post_title` = "'.$updateArr['post_title'].'", `post_slug` = "'.$updateArr['post_slug'].'", `popular_post` = "'.$updateArr['popular_post'].'", `post_status` = "'.$updateArr['post_status'].'" where id = "'.$updateArr['id'].'"';
			}

			// echo $sql;
			// die;
			
			$ret = $this->db->query($sql);	
			// $this->db->update($tableName, $updateArr, $idArr);
			
			// //echo $this->db->last_query();
			// $ret = $this->db->affected_rows();
			
		}
		// $this->db->last_query();
		return $ret;
	}

	public function updateIntoTable($tableName, $idArr, $updateArr)
	{
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{	
			
			// if(array_key_exists('featured_image', $updateArr)){
			// 	$sql = 'UPDATE `ep_blog_posts` SET `category_id` = "'.$updateArr['category_id'].'", `post_author` = "'.$updateArr['post_author'].'", `post_content` = "'.mysql_real_escape_string ($updateArr['post_content']).'", `featured_image` = "'.$updateArr['featured_image'].'", `post_title` = "'.$updateArr['post_title'].'", `post_slug` = "'.$updateArr['post_slug'].'", `popular_post` = "'.$updateArr['popular_post'].'", `post_status` = "'.$updateArr['post_status'].'" where id = "'.$updateArr['id'].'"';
			// } else {
			// 	$sql = 'UPDATE `ep_blog_posts` SET `category_id` = "'.$updateArr['category_id'].'", `post_author` = "'.$updateArr['post_author'].'", `post_content` = "'.mysql_real_escape_string ($updateArr['post_content']).'", `post_title` = "'.$updateArr['post_title'].'", `post_slug` = "'.$updateArr['post_slug'].'", `popular_post` = "'.$updateArr['popular_post'].'", `post_status` = "'.$updateArr['post_status'].'" where id = "'.$updateArr['id'].'"';
			// }

			// echo $sql;
			// die;
			
			// $ret = $this->db->query($sql);	
			$this->db->update($tableName, $updateArr, $idArr);
			
			// //echo $this->db->last_query();
			$ret = $this->db->affected_rows();
			
		}
		// $this->db->last_query();
		return $ret;
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

	public function changeStatus($tableName, $pagearray, $setfieldName, $fieldStatus, $updateFieldName)
	{ 
		$error		= false;		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($pagearray)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){			
			$sql = "UPDATE ".$tableName."
				SET ".$setfieldName." = '".$fieldStatus."'
				WHERE FIND_IN_SET(".$updateFieldName.", '".implode(",", $pagearray)."')";
			$this->db->query($sql);
		}
		if($fieldStatus == 'active') {
			return 'deactive';	
		} else {
			return 'active';	
		}
	}
	
		
	//public function get_property_availibility_dates($property_id){
	//	$sql	= "SELECT DATE_FORMAT(avail_date_format, '%e/%c/%Y') AS avail_date FROM lp_property_availibility WHERE property_id = '".$property_id."'";
	//	$query	= $this->db->query($sql);
	//	if($query->num_rows() > 0){
	//		$result	= $query->result_array();
	//	}else{
	//		$result	= '';
	//	}
	//	return $result;
	//}
	

	public function getShortDescription()
	{
		$sql	= "SELECT* FROM ep_short_about";
		$query	= $this->db->query($sql);
		$result	= $query->result_array();
		return $result[0];
	}
	
	
}