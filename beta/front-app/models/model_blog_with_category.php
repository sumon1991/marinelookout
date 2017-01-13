<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_blog_with_category extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getAllData()
	{		
		
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active' and show_on_dashboard = '0' and show_in_menu = '1'  and parent_id = '0'";

		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$count = 1;
			$rec = $rs->result_array();
			$allData = [];
			foreach ($rec as $key => $cat) {
				//print_r($cat);
				$sql=" SELECT * FROM ep_blog_posts where category_id = '".$cat['id']."' and post_status = 'Publish' ORDER BY id DESC limit 0,3";
				$res = $this->db->query($sql);
				$noOfRows = $rs->num_rows();
				if($noOfRows){
					$response = $res->result_array();
					$cat['blog_list'] = $response;
					array_push($allData, $cat);

					if($count == $noOfRows){
						return $allData;
					} else {
						$count++;
					}
				} else {
					$response = [];
					$cat['blog_list'] = $response;
					array_push($allData, $cat);

					if($count == $noOfRows){
						return $allData;
					} else {
						$count++;
					}
				}
			}

		}
	}

	public function getAllQuickLinks()
	{		
		
		$sql=" SELECT * FROM ep_quick_links where status = 'Active' ORDER by id DESC";

		$rs = $this->db->query($sql);
		if($rs->num_rows()){
			$rec = $rs->result_array();
			return $rec;
		} else {
			$rec = [];
		}
	}

	public function getCategoryTree($id = 0) {
	    $s = "SELECT id, name, slug FROM ep_blog_categories WHERE parent_id = $id and status = 'Active'";
	    $r = mysql_query($s);

	    $children = array();

	    $allchildrendata = array();
	    if(mysql_num_rows($r) > 0) {
	        $count = 0;
	        # It has children, let's get them.
	        while($row = mysql_fetch_array($r)) {
	        	$allchildrendata[$count] = $row;
	        	// print_r($row);
	        	// die;
	            # Add the child to the list of children, and get its subchildren
	            $children[$row['id']] = $this->getCategoryTree($row['id']);
	            array_push($allchildrendata[$count], $this->getCategoryTree($row['id']));
	            $count++;
	        }
	    }

	    //return $children;
	    return $allchildrendata;
	}

	public function dashboardCategories (){
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active' and show_on_dashboard = '1' and show_in_menu = '0' and parent_id = '0'";
		$rs = $this->db->query($sql);
		$count = 1;
		$rec = $rs->result_array();
		$allData = [];
		foreach ($rec as $key => $cat) {
			//print_r($cat);
			$sql=" SELECT * FROM ep_blog_posts where category_id = '".$cat['id']."' and post_status = 'Publish' ORDER BY id DESC limit 0,1";
			$res = $this->db->query($sql);
			$noOfRows = $rs->num_rows();
			if($noOfRows){
				$response = $res->result_array();
				$cat['bl'] =  $response;
				array_push($allData, $cat);

				if($count == $noOfRows){
					return $allData;
				} else {
					$count++;
				}
			} else {
				$response = [];
				$cat['bl'] = $response;
				array_push($allData, $cat);

				if($count == $noOfRows){
					return $allData;
				} else {
					$count++;
				}
			}
		}
	}

	public function dashboardMenus (){
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active' and show_in_menu = '1'";
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();
		return $rec;
	}

	
	public function recentNotices()
	{
		$sql=" SELECT * FROM ep_notice where status = 'active' ORDER BY id DESC limit 0,5";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}

	public function popularPosts()
	{
		$sql=" SELECT * FROM ep_blog_posts where post_status = 'Publish' and popular_post = '1' ORDER BY id DESC limit 0,5";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}

	public function suscribeme($email='')
	{
		if($email){
			$checkemail = "SELECT * FROM ep_subscription WHERE `email` = '".$email."'";
			$res = $this->db->query($checkemail);
			if(!$res->num_rows()){
				$sql=" INSERT INTO ep_subscription (`id`, `name`, `email`) VALUES (NULL, '".$email."', '".$email."');";
				$rs = $this->db->query($sql);
				if($rs){
					return 'success';
				} else {
					return 'error';
				}
			} else {
				return 'error';
			}
		}
	}

	public function get_single_notice($idArray)
	{
		$sql = "SELECT * FROM ep_notice WHERE id = '" . $idArray['noticeid'] . "'";
		$rs = $this->db->query($sql);

		// $sql1 = "SELECT * FROM ep_blog_categories where status = 'Active'";
		// $res = $this->db->query($sql1);

		// $sql2 = "SELECT * FROM ep_blog_categories WHERE id = '" . $idarray['catid'] . "'";
		// $response = $this->db->query($sql2);
		// $catdetails = $response->result_array();
		$allRecord = [];
		// $allRecord['categories'] = $res->result_array();
		$allRecord['categories'] = $this->getCategoryTree(0);
		
		if($rs->num_rows()) {
			$rec = $rs->result_array();
			$allRecord['all_notice'] = $rec;        
			return $allRecord;
		} else {
			return $allRecord;
		}
	}

	
	public function get_single($idarray){
		$sql = "SELECT * FROM ep_blog_posts WHERE id = '" . $idarray['blogid'] . "'";
		$rs = $this->db->query($sql);

		// $sql1 = "SELECT * FROM ep_blog_categories where status = 'Active'";
		// $res = $this->db->query($sql1);

		$sql2 = "SELECT * FROM ep_blog_categories WHERE id = '" . $idarray['catid'] . "'";
		$response = $this->db->query($sql2);
		$catdetails = $response->result_array();
		$allRecord = [];
		// $allRecord['categories'] = $res->result_array();
		$allRecord['categories'] = $this->getCategoryTree(0);
		
		if($rs->num_rows()) {
			$rec = $rs->result_array();
			$rec[0]['catname'] = $catdetails[0]['name'];
			$allRecord['blog'] = $rec;        
			return $allRecord;
		} else {
			return $allRecord;
		}
	}

	public function childs($parentid){
		$sql = "SELECT * FROM ep_blog_categories where parent_id = '".$parentid."'";
		$res = $this->db->query($sql);
		$response = $res->result_array();

		if($res->num_rows()){
			echo $response;
		} else {
			$response = [];
			echo $response;
		}
	}

	public function get_slug_page($slug, $limit, $start = 0)
	{
		// echo $offset;
		// die;
		$count = 1;
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active' and slug = '".$slug."'";
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();

		$sql1=" SELECT * FROM ep_blog_posts where category_id = '".$rec[0]['id']."' and post_status = 'Publish' ORDER BY id DESC LIMIT $start, $limit";
		// echo $sql1;
		// die;
		$rs1 = $this->db->query($sql1);

		$sql3 = "SELECT * FROM ep_blog_categories";
		$res3 = $this->db->query($sql3);
		$allData = [];
		$Posts = [];
		$allData['categories'] = $res3->result_array();
		$noOfRows = $rs1->num_rows();
		if($noOfRows) {

			$rec1 = $rs1->result_array();

			foreach ($rec1 as $key => $post) {
				$sql2=" SELECT * FROM ep_blog_author where id = '".$post['post_author']."' and status = 'Active'";
				$rs2 = $this->db->query($sql2);
				$res2 = $rs2->result_array();
				$post['authorname'] = $res2[0]['name'];
				$post['catname'] = $rec[0]['name'];
				array_push($Posts, $post);
				if($count == $noOfRows){
					$allData['posts'] = $Posts;
					return $allData;
				} else {
					$count++;
				}
			}
			
		} else {
			$allData['posts'] = $Posts;
			return $allData;
		}
	}

	public function count_total_row($slug)
	{
		// echo $offset;
		// die;
		$count = 1;
		$sql=" SELECT * FROM ep_blog_categories where status = 'Active' and slug = '".$slug."'";
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();

		$sql1=" SELECT * FROM ep_blog_posts where category_id = '".$rec[0]['id']."' and post_status = 'Publish' ORDER BY id DESC";
		$rs1 = $this->db->query($sql1);
		$noOfRows = $rs1->num_rows();
		return $noOfRows;
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

	public function getAllAds()
	{
		$sql=" SELECT * FROM ep_advertisement where is_active = 'yes' ORDER by id DESC";
		$rs = $this->db->query($sql);
		$rec = $rs->result_array();
		$allAd = [];
		$allAd['right'] = [];
		$allAd['left'] = [];
		$allAd['bottom'] = [];

		if(count($rec)){
			foreach ($rec as $key => $ads) {
				if($ads['alignment'] == 'right'){
					array_push($allAd['right'], $ads);
				} else if($ads['alignment'] == 'left'){
					array_push($allAd['left'], $ads);
				} else {
					array_push($allAd['bottom'], $ads);
				}
			}
		}

		return $allAd;
	}
	
}