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

   
	public function get_topbar()
	{
		$this->topbar = '';

		/*-----------------------------------
	       BEGIN :: Fetch image name from admin
	       ------------------------------------*/
	       $findArray 	= array('id'=>$this->obj->nsession->userdata('USER_ID'));
	       $executeQuery 	= $this->obj->model_basic->getValues_conditions(ADMIN,'','','id ='.$this->obj->nsession->userdata('USER_ID'));
	      
	      if(!empty($executeQuery))
	      {
		      $this->topbar['user_image'] =  BACKEND_IMAGE_PATH."admin/".$executeQuery[0]['image'];
		      $this->topbar['file_exists_link'] = FILE_UPLOAD_ABSOLUTE_PATH."admin/".$executeQuery[0]['image'];
	      }
	      $this->topbar['default_user_image'] = BACKEND_IMAGE_PATH.'no_image.png';
	      /*-----------------------------------
	       END :: Fetch image name from admin
	       ------------------------------------*/

		$this->obj->elements['topbar']='layout/topbar';
		$this->obj->elements_data['topbar'] = $this->topbar;	  
    }
     
     
	public function get_breadcrump($brdArr = array())
	{
		$this->breadcrump = '';
		$this->breadcrump['breadcrump'] = $brdArr;
		$this->obj->elements['breadcrump']='includes/breadcrump';
		$this->obj->elements_data['breadcrump'] = $this->breadcrump;
	}
     
	public function get_leftmenu($active = '')
	{
		$this->leftmenu = '';
		/*-----------------------------------
	       BEGIN :: Fetch image name from admin
	       ------------------------------------*/
		$findArray 		= array('id'=>$this->obj->nsession->userdata('USER_ID'));
	       //$executeQuery 	= $this->obj->model_common->fetch_data(ADMIN,$findArray);
	       $executeQuery 	= $this->obj->model_basic->getValues_conditions(ADMIN,'','','id ='.$this->obj->nsession->userdata('USER_ID'));
	       if(!empty($executeQuery))
	       {
		       $this->leftmenu['user_image'] =  BACKEND_IMAGE_PATH."admin/".$executeQuery[0]['image'];
		       $this->leftmenu['file_exists_link'] = FILE_UPLOAD_ABSOLUTE_PATH."admin/".$executeQuery[0]['image'];
	       }
	       $this->leftmenu['default_user_image'] = BACKEND_IMAGE_PATH.'no_image.png';
	       /*-----------------------------------
		END :: Fetch image name from admin
		------------------------------------*/
        

		$this->leftmenu['permited_module'] = explode(',',$this->obj->nsession->userdata('MODULES'));
		$this->sidebar['active'] = $active;
		$this->obj->elements['leftmenu']='layout/leftmenu';
		$this->obj->elements_data['leftmenu'] = $this->leftmenu;
	}       
 
     
     public  function get_footer()
     {
	  $this->footer = '';
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }
     
	
}
?>