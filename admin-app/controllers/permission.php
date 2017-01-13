<?php
class Permission extends MY_Controller{
    
    public function __construct(){
        parent:: __construct();
    }
    
    public function index()
    {
        $this->chk_login(); 
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."cms/index/";

	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Permission';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	//........................	
	$this->data['menu_list'] 		= $this->model_basic->getValues_conditions('ep_menu','','','is_active = "yes"');
	$this->data['permission_list'] 		= $this->model_basic->getValues_conditions('ep_role','','','role_type = "admin"');
	if($this->input->get_post('action') == 'Process')
	{
	    //pr($this->data['permission_list'] );
	    foreach($this->data['permission_list'] as $v)
	    {
		$permission_list = implode(',',$this->input->get_post($v['id'].'_menu'));
		$updArr  		 =  array(
									'menu_id' 	=> $permission_list
								 );
		$idArr			 = 	array( 'id' => $v['id'] );			    
		$ret		     =	$this->model_basic->updateIntoTable('ep_role', $idArr, $updArr);
	    }
	    $this->nsession->set_userdata('succmsg','Permission updated successfuly.Please relogin');
	    redirect(BACKEND_URL."permission/");
	}
	    $this->data['controller'] 	= 'permission';
	    $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";			
	    $this->data['succmsg']	= $this->nsession->userdata('succmsg');
	    $this->data['errmsg']  	= $this->nsession->userdata('errmsg');		
	    $this->nsession->set_userdata('succmsg', "");		
	    $this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
        $this->elements['middle']='permission/index';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        
    }
}
?>