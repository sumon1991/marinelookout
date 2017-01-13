<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Questionans extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_common','model_question'));

	}
       
    // LIST QUESTION       
   	public function listing()
	{	
		$this->chk_login();

		$data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
                $data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
		$data['search_keyword']   = "";
		$data['params']       = $this->nsession->userdata('QUESTION_SEARCH');

	if($this->input->get_post('is_show_all') == 1)
	{
		$this->nsession->set_userdata('QUESTION_SEARCH','');
		$data['search_keyword']   	 = '';
		$data['per_page'] 	      	 = PER_PAGE_LISTING;
	}
        //elseif($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('QUESTION_SEARCH')== '')
        //{
        // 
        //    $data['search_keyword']   	 = $this->nsession->userdata('QUESTION_SEARCH');
        //    $data['per_page'] 	      	 = PER_PAGE_LISTING;
        //}
        else 
        {
            if($this->input->get_post('search_keyword',true) != '')
			$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
		else	
			$data['search_keyword']   = $this->nsession->userdata('QUESTION_SEARCH');
			
		$data['per_page']         = PER_PAGE_LISTING;  
        }
        $total_question           = $this->model_question->countQuestionDB($data['search_keyword']);
        $data['totalRecord']      = $total_question;
	
	if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            	= 0;
	else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
        if($total_question > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/questionans/listing';
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
            
            $resultArr = $this->model_question->allQuestionDB($data['search_keyword'],PER_PAGE_LISTING,$offset);
       

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
                    $delete_link        = base_url()."questionans/delete/".$questionId."/".$cur_page."/";
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
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
               
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
		$this->elements['middle']='question/list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);	
	}

	// DELETE  QUESTION & ANSWER

	public function delete()
	{	
		$this->chk_login();
		$deleteSlug='';
		$questionId = $this->uri->segment(3);
		$deleteSlug = $this->uri->segment(5);
		$fieldname = 'id';
		$answerIdFieldName = 'question_id';
		$this->model_common->delete_user(ANSWER,$answerIdFieldName,$questionId);

		
		$deleteRecord = $this->model_common->delete_user(QUESTION,$fieldname,$questionId);
		$this->nsession->set_userdata('succmsg','Yours question and answer deleted successfully');
		
		
		
		if($deleteSlug==''){
		redirect("questionans/listing");}
		else {redirect("subject_list/listing_sub/".$deleteSlug);}
	}

	// VIEW QUESTION
	public function view()
	{	
		// Initialize variables
		$this->chk_login();
		$data 	= array();        
		$this->data['log'] = array();

		$subjectListArray = $this->model_common->fetch_data(SUBJECT);
		
		//print_r($subjectListArray);

		if(!empty($subjectListArray)) {
			$this->data='';
			$this->data['log'] = $subjectListArray;			
			$this->templatelayout->get_topbar();
			$this->templatelayout->get_leftmenu();
			$this->templatelayout->get_footer();
			$this->elements['middle']='question/add';
			$this->elements_data['middle'] = $this->data;			    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		}
	}


	// ADD QUESTION	& ANSWER
	public function add()
	{
		
		$this->chk_login();
		if($this->input->post('action')=='add')
		{
			$this->form_validation->set_rules('question_title', 'Question Title', 'trim|required');
			$this->form_validation->set_rules('subject_name', 'Subject Name', 'trim|required');
			$this->form_validation->set_rules('subject_group', 'Subject Group', 'trim|required');
			$this->form_validation->set_rules('question_status', 'Question Status', 'trim|required');
			$this->form_validation->set_rules('answer_sheet[]', 'Answer Sheet', 'trim|required');
			$this->form_validation->set_rules('isCorrect', 'Correct Answer', 'trim|required');
		
	        if ($this->form_validation->run() == TRUE)
	        {
				if($this->input->post('question_type') != 'Text')
				{	
					if($_FILES['question_image']['name'] !='')
					{
						if(is_array($_FILES) && count($_FILES)>0)
						{
							// echo 'fsdf';exit;
							$upload_config['field_name']        	= 'question_image';
							$upload_config['file_upload_path']  	= 'question/';
							$upload_config['max_size']          	= '';
							$upload_config['max_width']         	= '300';
							$upload_config['max_height']        	= '300';
							$upload_config['allowed_types']     	= 'jpg|jpeg|gif|png';
							$thumb_config['thumb_create']       	= false;
							$thumb_config['thumb_file_upload_path'] = 'thumb/';
							$thumb_config['thumb_marker']       	= '';
							$thumb_config['maintain_ratio']     	= '';
							$thumb_config['thumb_width']        	= '336';
							$thumb_config['thumb_height']       	= '280';
							
							$sUploaded = image_upload($upload_config, $thumb_config);
							
							if($sUploaded != '')
							{
								$answer_sheet = $this->input->post('answer_sheet');
								//$isCorrect    = $this->input->post('isCorrect');
								$correct_ans  = $this->input->post('isCorrect');
								$data = array(
										'question_type'	=> $this->input->post('question_type'),
										'image'			=> $sUploaded,
										'title'			=> addslashes(trim($this->input->post('question_title'))),
										'slug'			=> url_title(strtolower(addslashes(trim($this->input->post('question_title'))))),
										'subject_id'	=> $this->input->post('subject_name'),
										'group'			=> $this->input->post('subject_group'),
										//'question_order'=>	trim($this->input->post('question_order')),
										'is_active'		=> $this->input->post('question_status'),
										'added_on'		=> date('Y-m-d H:i:s', time())					
									);
								$insert_question = $this->model_common->insert_user(QUESTION, $data);
								if(!empty($insert_question))
								{	
									for($i= 0; $i<count($answer_sheet);$i++)
									{
										if(!empty($answer_sheet[$i]))
										{
											//$correct = $i+1;
											if($i == ($correct_ans-1))
											{
												$Insertarray =  array(	"question_id"   => addslashes($insert_question),
													"title"       	=> addslashes($answer_sheet[$i]),
													"is_correct"  	=> 'Yes',
													"added_on"	=> date('Y-m-d H:i:s', time())
												);
											}
											else
											{
												$Insertarray =  array("question_id"   => addslashes($insert_question),
													"title"       => addslashes($answer_sheet[$i]),
													"is_correct"  => 'No',
													"added_on"    => date('Y-m-d H:i:s', time())
												       );
											}
											//pr($Insertarray,0);
											$this->model_basic->insertIntoTable(ANSWER,$Insertarray);
										}
									}
									$this->nsession->set_userdata('succmsg','Question added successfully');
									redirect(BACKEND_URL.'questionans/listing/');
									exit;
								}
							}
						}
					}
					else
					{	
						$this->nsession->set_userdata('errmsg', 'Image Field Required');
						redirect(BACKEND_URL."questionans/add/");
						exit;
					}			
				}
				else
				{
					//pr($_POST);
					$answer_sheet = $this->input->post('answer_sheet');
					//$isCorrect    = $this->input->post('isCorrect');
					$correct_ans  = $this->input->post('isCorrect');
					$data = array(
							'question_type'	=> $this->input->post('question_type'),						
							'title'			=> addslashes(trim($this->input->post('question_title'))),
							'slug'			=> url_title(strtolower(addslashes(trim($this->input->post('question_title'))))),
							'subject_id'		=> $this->input->post('subject_name'),
							'group'			=> $this->input->post('subject_group'),
							//'question_order'=>	trim($this->input->post('question_order')),
							'is_active'		=> $this->input->post('question_status'),
							'added_on'		=> date('Y-m-d H:i:s', time())					
						);
					$insert_question = $this->model_common->insert_user(QUESTION, $data);
					if(!empty($insert_question))
					{	
						for($i= 0; $i<count($answer_sheet);$i++)
						{
							if(!empty($answer_sheet[$i]))
							{
								//$correct = $i+1;
								if($i == ($correct_ans-1))
								{
									$Insertarray =  array(	"question_id"   => addslashes($insert_question),
												"title"       	=> addslashes($answer_sheet[$i]),
												"is_correct"  	=> 'Yes',
												"added_on"	=> date('Y-m-d H:i:s', time())
											);
								}
								else
								{
									$Insertarray =  array("question_id"   => addslashes($insert_question),
												"title"       => addslashes($answer_sheet[$i]),
												"is_correct"  => 'No',
												"added_on"    => date('Y-m-d H:i:s', time())
											       );
								}
								//pr($Insertarray,0);
								$this->model_basic->insertIntoTable(ANSWER,$Insertarray);
							}
						}
						$this->nsession->set_userdata('succmsg','Question added successfully');
						redirect(BACKEND_URL.'questionans/listing/');
						exit;
					}
				}				
			}	
		}		
		$data 	= array();  
		$this->data='';      
		$this->data['log'] = array();
		$subjectListArray = $this->model_common->fetch_data(SUBJECT);
		
		if(!empty($subjectListArray)) {
			$this->data='';
			$this->data['log'] = $subjectListArray;	
		}
		
		$this->data['subjectSlug'] = array();
		$subjectSlag = $this->uri->segment(3);
		$data['subjectSlug'] = array();
		$subjectSlug = $this->model_basic->getValues_conditions('ep_subject',array('id','title','subject_slug'),'','subject_slug = "'.$subjectSlag.'"');
		
		$this->data['subjectSlug'] = $subjectSlug;	
		
		
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');

		$this->nsession->set_userdata('errmsg', '');
		$this->nsession->set_userdata('succmsg', '');

		$this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='question/add';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
				
	}			
				
		

	// UPDATE QUESTION ANSWER
	public function edit()
	{
		$this->chk_login();
		$id = $this->uri->segment(3);
		$this->data['id'] = $id;
		$this->data['questionList'] = array();
		$this->data['subjectList'] = array();
		
		// Show Image In Edit Form
		$questionListArray 	= $this->model_common->viewQuestionAndAnswer($id);
		$subjectListArray 	= $this->model_common->fetch_data(SUBJECT);
		//pr($questionListArray);
		
		if(!empty($questionListArray))
		{		
			$this->data['questionList'] = $questionListArray;
			$this->data['subjectList'] = $subjectListArray;	
		}
		//echo $this->input->post('question_type');exit;
		if($this->input->post('action')=='edit')
		{
			$this->form_validation->set_rules('question_title', 'Question Title', 'trim|required');
			$this->form_validation->set_rules('subject_name', 'Subject name', 'trim|required');
			$this->form_validation->set_rules('subject_group', 'Subject group', 'trim|required');
			$this->form_validation->set_rules('question_status', 'Question Status', 'trim|required');
			$this->form_validation->set_rules('answer_sheet[]', 'Answer Sheet', 'trim|required');
			$this->form_validation->set_rules('isCorrect', 'Correct Answer', 'trim|required');	
			
			if ($this->form_validation->run() != FALSE)
			{
				if($this->input->post('question_type') != 'Text')
				{
					if($_FILES['question_image']['name'] !='')
					{
						if(is_array($_FILES) && count($_FILES)>0)
						{
							$upload_config['field_name']        = 'question_image';
							$upload_config['file_upload_path']  = 'question/';
							$upload_config['max_size']          = '';
							$upload_config['max_width']         = '300';
							$upload_config['max_height']        = '300';
							$upload_config['allowed_types']     = 'jpg|jpeg|gif|png';
							$thumb_config['thumb_create']       = false;
							$thumb_config['thumb_file_upload_path'] = 'thumb/';
							$thumb_config['thumb_marker']       = '';
							$thumb_config['maintain_ratio']     = '';
							$thumb_config['thumb_width']        = '336';
							$thumb_config['thumb_height']       = '280';
							//pr($_FILES);
							
							$sUploaded = image_upload($upload_config, $thumb_config);
			
							if($sUploaded != '')
							{
								$question_image = $sUploaded;
								$oldImg = $questionListArray[0]['image'];
								@unlink (FILE_UPLOAD_ABSOLUTE_PATH."question/".$oldImg);
								$answer_sheet = $this->input->post('answer_sheet');
								//$isCorrect    = $this->input->post('isCorrect');
								$correct_ans  = $this->input->post('isCorrect');
								$updArr = array(
										'question_type'	=> $this->input->post('question_type'),
										'image'		=> $sUploaded,
										'title'		=> addslashes(trim($this->input->post('question_title'))),
										'slug'		=> url_title(strtolower(addslashes(trim($this->input->post('question_title'))))),
										'subject_id'	=> $this->input->post('subject_name'),
										'group'		=> $this->input->post('subject_group'),
										//'question_order'=>	trim($this->input->post('question_order')),
										'is_active'	=> $this->input->post('question_status'),
										'added_on'	=> date('Y-m-d H:i:s', time())				
									);
								$idArr		= 	array( 'id' => $id );			    
								$ret=$this->model_basic->updateIntoTable('ep_question', $idArr, $updArr);
								
								$this->model_basic->deleteData('ep_answer','question_id = '.$id);
				
								if(is_array($answer_sheet) && COUNT($answer_sheet)>0)
								{
									foreach($answer_sheet as $k=>$v)
									{
										if($k == ($correct_ans-1))
											$is_correct	=	'Yes';
										else
											$is_correct	=	'No';										
										$insertArr	=	array(
														  'question_id' => $id,
														  'title' => addslashes($v),
														  'is_correct' => $is_correct,
														  'is_active' => 'yes',
														  'question_id' => $id,
														  'added_on' => date('Y-m-d H:i:s')
														  );
										//pr($insertArr,0);
										$this->model_basic->insertIntoTable('ep_answer',$insertArr);
									}	
								}
								$this->nsession->set_userdata('succmsg', 'Question updated successfully');
								redirect(BACKEND_URL."questionans/listing/");
								exit;							
							}
							else
							{	
								$this->nsession->set_userdata('errmsg', $this->nsession->userdata('upload_err'));
								$this->nsession->set_userdata('upload_err', '');
								redirect(BACKEND_URL."questionans/listing/");
								exit;
							}
			
						}			
					}
					else
					{
						//pr($_POST,0);
						$answer_sheet = $this->input->post('answer_sheet');
						$isCorrect    = '';
						$correct_ans  = $this->input->post('isCorrect');
						$updArr = array(
								'question_type'	=> $this->input->post('question_type'),						
								'title'		=> addslashes(trim($this->input->post('question_title'))),
								'slug'		=> url_title(strtolower(addslashes(trim($this->input->post('question_title'))))),
								'subject_id'	=> $this->input->post('subject_name'),
								'group'		=> $this->input->post('subject_group'),
								'is_active'	=> $this->input->post('question_status'),
								'added_on'	=> date('Y-m-d H:i:s', time())					
							);
						$idArr		= 	array( 'id' => $id );			    
						$ret=$this->model_basic->updateIntoTable('ep_question', $idArr, $updArr);					
						$this->model_basic->deleteData('ep_answer','question_id = '.$id);	
						if(is_array($answer_sheet) && COUNT($answer_sheet)>0)
						{
							foreach($answer_sheet as $k=>$v)
							{
								if($k == ($correct_ans-1))
									$is_correct	=	'Yes';
								else
									$is_correct	=	'No';										
								$insertArr	=	array(
												'question_id' => $id,
												'title' => addslashes($v),
												'is_correct' => $is_correct,
												'is_active' => 'yes',
												'question_id' => $id,
												'added_on' => date('Y-m-d H:i:s')
												);
								//pr($insertArr,0);
								$this->model_basic->insertIntoTable('ep_answer',$insertArr);
							}
							$this->nsession->set_userdata('succmsg', 'Question updated successfully');				
						}
						redirect(BACKEND_URL."questionans/listing/");
						exit;						
					}					
				}
				else 
				{
					//pr($_POST);
					$answer_sheet = $this->input->post('answer_sheet');
					//$isCorrect    = $this->input->post('isCorrect');
					$correct_ans  = $this->input->post('isCorrect');
					$updArr = array(
							'question_type'	=> $this->input->post('question_type'),						
							'title'		=> addslashes(trim($this->input->post('question_title'))),
							'slug'		=> url_title(strtolower(addslashes(trim($this->input->post('question_title'))))),
							'subject_id'	=> $this->input->post('subject_name'),
							'group'		=> $this->input->post('subject_group'),
							//'question_order'=>	trim($this->input->post('question_order')),
							'is_active'	=> $this->input->post('question_status'),
							'added_on'	=> date('Y-m-d H:i:s', time())					
						);
					$idArr		= 	array( 'id' => $id );			    
					$ret=$this->model_basic->updateIntoTable('ep_question', $idArr, $updArr);					
					$this->model_basic->deleteData('ep_answer','question_id = '.$id);	
					if(is_array($answer_sheet) && COUNT($answer_sheet)>0)
					{
						foreach($answer_sheet as $k=>$v)
						{
							if($k == ($correct_ans-1))
								$is_correct	=	'Yes';
							else
								$is_correct	=	'No';										
							$insertArr	=	array(
											'question_id' => $id,
											'title' => addslashes($v),
											'is_correct' => $is_correct,
											'is_active' => 'yes',
											'question_id' => $id,
											'added_on' => date('Y-m-d H:i:s')
											);
							$this->model_basic->insertIntoTable('ep_answer',$insertArr);
						}
						$this->nsession->set_userdata('succmsg', 'Question updated successfully');				
					}
					redirect(BACKEND_URL."questionans/listing/");
					exit;
				}
			}			
		}
		$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('errmsg', '');
		$this->nsession->set_userdata('succmsg', '');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='question/edit';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}	
		
}
?>