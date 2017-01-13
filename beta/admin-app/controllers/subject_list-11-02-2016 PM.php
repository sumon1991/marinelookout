<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subject_list extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_common','model_subject_list'));

	}
        

            public function listing_sub()
	{
		$this->chk_login();
		$subjectSlag = $this->uri->segment(3);
		$data='';
		//$subjectSlag = 'gk';
		//$this->$data->subjectSlag ;
		
		$data['subjectSlug'] = array();
  $subjectListArray = $this->model_basic->getValues_conditions('ep_subject',array('id','subject_slug','title'),'','subject_slug = "'.$subjectSlag.'"');
$subject = $subjectListArray[0]['id'];
$deleteSlug = $subjectListArray[0]['subject_slug'];

		
		
		$data['subjectSlug'] = $subjectListArray;
                $data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
                $data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
		$data['search_keyword']   = "";
		$data['params']      	  = $this->nsession->userdata('QUESTION_LIST_SEARCH');
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('QUESTION_LIST_SEARCH')== '')
        {
         
            $data['search_keyword']   	 = $data['params']['search_keyword'];
            $data['per_page'] 	      	 = $data['params']['per_page'];
        }
        else 
        {
            $data['search_keyword']   = $this->input->get_post('search_keyword',true);
            $data['per_page']         = $this->input->get_post('per_page',true);  
        }
        $total_question           = $this->model_subject_list->countQuestionDB($data['search_keyword'],$subject);
        $data['totalRecord']      = $total_question;
	if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            	= 0;
	else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
        if($total_question > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/subject_list/listing_sub';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_question;
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
            
            $resultArr = $this->model_subject_list->allQuestionDB($data['search_keyword'],PER_PAGE_LISTING,$offset,$subject);
       

            if(count($resultArr) > 0)
	       {
		    $delete="";
		    $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $questionId         = $values['id'];
                    $questionStatus     = $values['is_active'];
                    $status_class=($questionStatus == 'yes')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."questionans/edit/".$questionId."/".$cur_page."/";
                    $delete_link        = base_url()."questionans/delete/".$questionId."/".$cur_page."/".$deleteSlug."/";
                    $view_link          = base_url()."questionans/view/".$questionId."/".$cur_page."/";

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'class'             => $class,
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
                                                            'delete_link'       => $delete_link,
                                                            'view_link'			=> $view_link
                                                            )
                                            );
                    $num++;

                  }

			$data['questionList']        = $total_result;
		       
			/********** FOR PAGINATION ***********/
			$config['cur_tag_open']     = '<span class="current-link">';
			$config['cur_tag_close']    = '</span>';
			$this->pagination->setCustomAdminPaginationStyle($config);
			$this->pagination->initialize($config);
			$data['pagination']         = $this->pagination->create_links();

                	
		}
		}
		$data['succmsg'] = $this->nsession->userdata('succmsg');		
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->nsession->set_userdata('succmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='question/sub_list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	}  
        
}
?>