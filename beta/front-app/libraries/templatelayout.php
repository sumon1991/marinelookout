<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of templatelayout
 */
class templatelayout {
     
     var $obj;
    
     public function __construct()
     {
        $this->obj =& get_instance();
     }

   
     public function header()
     {
        $this->header = '';
        $this->header['dashboard_cats'] = $this->obj->model_blog_with_category->dashboardCategories();
        $this->header['dashboard_menus'] = $this->obj->model_blog_with_category->dashboardMenus();
        $this->header['allads'] = $this->obj->model_blog_with_category->getAllAds();
        $this->header['seo_settings']   = $this->obj->model_basic->get_settings('12,13,14');
        $this->obj->elements['header']  = 'layout/header';
        $this->obj->elements_data['header']   = $this->header; 
     }
     
     public  function footer()
     {


      $this->footer = '';
      $this->footer['social_links'] = $this->obj->model_basic->social_links();
      $this->footer['footerimage'] = $this->obj->model_basic->getValues_conditions(ADVERTISEMENT,array('title','alignment','image','advertisement_link'),'','alignment="bottom" AND is_active="yes" ','','','4');
      //pr($this->footer['footerimage']);
	  $this->footer['footersitesetting'] = $this->obj->model_basic->get_settings('3,4,5,6,7,8,9,10,11,60,63');
	  //pr($this->footer['footersitesetting']);
	  //$this->obj->elements['footer']='layout/footer';
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer; 
     }
     
	
}
?>