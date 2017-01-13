<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_home extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_home_content()
	{
		$final_array			= array();
		$final_array['notice_list']	= $this->model_basic->getValues_conditions('ep_notice','','','status = "active"','added_on','DESC');
		$final_array['article_list']	= $this->model_basic->getValues_conditions('epwp_posts',array('ID','post_title','post_content','guid'),'','post_type = "post" AND post_title != "Auto Draft"','post_date','DESC');
		if(is_array($final_array['article_list']) && COUNT($final_array['article_list']))
		{
			foreach($final_array['article_list'] as $k=>$v)
			{
				$img_name = $this->model_basic->getValue_condition('epwp_posts','guid','','post_parent = '.$v['ID'].' AND post_type = "attachment"');
				$final_array['article_list'][$k]['image_link'] = $img_name;
			}
		}
		return $final_array;
	}
}