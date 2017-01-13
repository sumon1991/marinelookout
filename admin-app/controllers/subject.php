<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_common','model_administrator','model_subject'));
	}


//FOR  USER LISTING                   
 
    public function all()
    {
	$this->chk_login();
	$data['per_page']     	  = PER_PAGE_LISTING;
	$start        		  = 0;
	$data['startRecord']  	  = $start;
	$data['page'] 	          = $this->uri->segment(3);
        $data['search_keyword']   = "";
	
	if($this->input->get_post('is_show_all') == 1)
		$this->nsession->set_userdata('SUBJECT_SEARCH','');
	 $data['search_keyword'] 	= '';
	
	
	if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('SUBJECT_SEARCH')== '')
        {
           
             $data['search_keyword']   	 = $data['search_keyword'];
             $data['per_page'] 	      	 = $data['per_page'];
        }
        else 
        {
            
		if($this->input->get_post('search_keyword',true) != '')
			$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
		else	
			$data['search_keyword']   = $this->nsession->userdata('SUBJECT_SEARCH');
			
		$data['per_page']         	  = $this->input->get_post('per_page',true);
        }
		$total_subject        		  = $this->model_subject->countSubjectDB($data['search_keyword']);
		$data['totalRecord']         	  = $total_subject;
		if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            		  = 0;
	       else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
         if($total_subject > 0) {
		
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/subject/all';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_subject;
            if($this->uri->segment(3)) {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3))) {
                    $offset=0;
                } else {
                    $offset=abs(ceil($this->uri->segment(3)));
                }
            } else {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_subject->allSubjectDB($data['search_keyword'] ,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $subjectId         = $values['id'];
                    $subjectStatus     = $values['is_active'];
                    $status_class=($subjectStatus == 'Yes')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment  = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link    = base_url()."subject/edit/".$subjectId."/".$cur_page."/";
                    $delete_link  = base_url()."subject/delete/".$subjectId."/".$cur_page."/";
                    $update_link  = base_url()."subject/update/".$subjectId."/".$cur_page."/";

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }
                    
                  
                    $total_result[]  = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'class'             => $class,
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

               	$data['subject_all'] = $total_result;
              
                /********** FOR PAGINATION ***********/
                //$config['cur_tag_open']     		= '<span class="current-link">';
                //$config['cur_tag_close']    		= '</span>';
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
                $this->pagination->initialize($config);
                $data['pagination']             	= $this->pagination->create_links();
                
			}
        	}	
		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');	
		$this->nsession->set_userdata('errmsg','');
        		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='subject/subject_list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);		
    }
	
	
	// ADD SUBJECT	
	public function add()
	{
		if($this->input->post('action')=='add')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[ep_subject.title]');
			$this->form_validation->set_rules('instruction', 'Instruction', 'trim|required');
			$this->form_validation->set_rules('timing', 'Exam Time', 'trim|required|numeric');
			$this->form_validation->set_rules('total_question', 'Total Questions', 'trim|required|numeric');
			
			if ($this->form_validation->run() == TRUE)
			{
				$insert = array(
						'title' 	=> $this->input->post('title'),
						'subject_slug'	=> url_title(strtolower(addslashes(trim($this->input->post('title'))))),
						'instruction'	=> addslashes($this->input->post('instruction')),
						'added_on'	=> date('Y-m-d H:i:s', time()),
						'timing'	=> addslashes($this->input->post('timing')),
						'total_question'=> addslashes($this->input->post('total_question')),
						'is_active'	=> $this->input->post('is_active')
						);	
	
				$flag = $this->model_common->insert_user(SUBJECT,$insert);
	
				if($flag>0){
					$this->nsession->set_userdata('succmsg','Subject added succesfully');
					redirect(BACKEND_URL."subject/all");
				}
				else{
					redirect(BACKEND_URL."subject/add");
				}
			}
		}	
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg', "");	
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='subject/add';
		$this->elements_data['middle'] = $this->data;
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}

	// Update Subject
	public function edit()
	{
	    $editId = $this->uri->segment(3);
	    $idArray = array('id'=>$editId);
	    $this->data['subjecteditdata'] = array();
	    $adminListArray = $this->model_basic->getValues_conditions(SUBJECT,'','','id ='.$editId);
	    if($this->input->post('action')=='edit')
	    {
	    	//$editId = $this->uri->segment(3);
		$this->form_validation->set_rules('title', 'Title', 'trim|required|callback_is_title_exists');
		$this->form_validation->set_rules('instruction', 'Instruction', 'trim|required');
		$this->form_validation->set_rules('timing','Exam Time','trim|required|callback_numeric_wcomma');
		$this->form_validation->set_rules('total_question', 'Total Questions', 'trim|required|callback_numeric_wcomma');
		if($this->form_validation->run() == TRUE)
		{
			$updateArr = array(
						'title' 	=> $this->input->post('title'),
						'subject_slug'	=> url_title(strtolower(addslashes(trim($this->input->post('title'))))),
						'instruction'	=> addslashes($this->input->post('instruction')),
						'timing'	=> $this->input->post('timing'),
						'total_question'=> $this->input->post('total_question'),
						'is_active' 	=> $this->input->post('is_active')
					);
			$idArr	= array(
					'id' =>$editId
					);
			$flag 	= $this->model_basic->updateIntoTable('ep_subject',$idArr,$updateArr);
				 
			if($flag)
			{
				$this->nsession->set_userdata('succmsg','Subject updated succesfully');
				redirect(BACKEND_URL."subject/all");
				exit;
			}
			else
			{
				//$this->nsession->set_userdata('errmsgg','Unable to update');
				//redirect(BACKEND_URL."subject/edit/".$editId."/0/");
				redirect(BACKEND_URL."subject/all");
				exit;
			}
		}
	    }
	    $this->data="";
	    $this->data['subjecteditdata'] = $adminListArray;
	    $this->data['errmsg'] = $this->nsession->userdata('errmsgg');
	    $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	    $this->nsession->set_userdata('errmsgg', "");
	    $this->nsession->userdata('succmsg',"");	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='subject/edit';
	    $this->elements_data['middle'] = $this->data;
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);	
	}
	 

	public function delete()
	{
		//$id = $this->input->post('id');
		$id = $this->uri->segment(3);
	
		$fieldname = 'id';
		$idArray = array('subject_id'=>$id);
		$idsubjectArray = array('subject_id'=>$id);
		

	 	$subjectData = $this->model_common->fetch_data(QUESTION,$idsubjectArray);

	 	if($subjectData>0)
	 	{  
			//echo 'Fail';
			$this->nsession->set_userdata('succmsg','Delete not successfully casue this subject releted to others');
			redirect(BACKEND_URL."subject/all");	
			exit;
	 	}
	 	else
	 	{
			$dFlag	= $this->model_common->delete_user(SUBJECT,$fieldname,$id);
			$this->nsession->set_userdata('succmsg','Delete successfully');
			redirect(BACKEND_URL."subject/all");
			exit;
		}
	}
	function is_title_exists()
    {
        
        $id         = $this->uri->segment(3);
        $title      = strip_tags(addslashes(trim($this->input->post('title'))));
        
        $whereArr   = array();
        if($id > 0){
            $whereArr   = array( 'title' => $title,
                         'id != ' => $id                        
                        );
        }else{          
            $whereArr   = array( 'title' => $title );
        }
        $bool   = $this->model_common->checkRowExists(SUBJECT, $whereArr ); 
        if($bool == 0){
            $this->form_validation->set_message('is_title_exists', 'This %s already exists');
            return FALSE;
        }else{
            return TRUE;
        }
    }
}
?>