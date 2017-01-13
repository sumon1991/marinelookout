<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_common','model_administrator','model_editor'));

	}


	// LIST EDITOR USER
	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['student_all'] = array();
		$data['pagination'] = array();



		$data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
		$data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
        
		$total_student            = $this->model_student->countStudentDB();
		$data['totalRecord']      = $total_student;
		$data['search_keyword']   = "";
		 $this->data['params']       = $this->nsession->userdata('EDITOR_SEARCH');
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
        {
            //$this->nsession->set_userdata('CMS_SEARCH','');
            $this->data['search_keyword'] = $this->data['params']['search_keyword'];
            $this->data['per_page'] = $this->data['params']['per_page'];
        }
        else 
        {
            $this->data['search_keyword']   = $this->input->get_post('search_keyword',true);
            $this->data['per_page']         = $this->input->get_post('per_page',true);  
        }
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/studentuser/index';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_student;
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
            $resultArr=$this->model_student->allStudentDB($this->data['search_keyword'] ,PER_PAGE_LISTING,$offset);
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

                    $edit_link    = base_url()."studentuser/edit/".$subjectId."/".$cur_page."/";
                    $delete_link  = base_url()."studentuser/delete/".$subjectId."/".$cur_page."/";

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
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

                $data['student_all']        = $total_result;
                //pr($data['subject_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     			= '<span class="current-link">';
                $config['cur_tag_close']    			= '</span>';

                $this->pagination->initialize($config);
                $data['pagination']             		= $this->pagination->create_links();
			}
        }
		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='userstudent/list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
}
?>