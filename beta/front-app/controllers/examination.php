<?php
class Examination extends MY_Controller{

    public function __construct(){
        parent:: __construct();
	//$this->load->model('model_examination');
	$this->load->model(array('model_examination','model_blog_with_category','model_basic'));
    }
    
    public function index()
    {
	$this->chk_login();
	$student_id	= $this->session->userdata('student_id');
	$subject_slug 	= $this->uri->segment(3);
	if($subject_slug != '')
	{
	    $this->data = '';
	    //$this->session->set_userdata('errmsg','');
	    //$this->data['total_exam_duration'] 	= $this->model_basic->get_settings(61);
	    $this->data['student_name'] 	= $this->session->userdata('student_name');
	    $this->data['question_list'] 	= $this->model_examination->get_question_list($subject_slug);
	    $this->data['total_exam_duration']	= $this->model_basic->getValue_condition('ep_subject','timing','','subject_slug = "'.$subject_slug.'"');
	    $this->data['instruction']	= $this->model_basic->getValue_condition('ep_subject','instruction','','subject_slug = "'.$subject_slug.'"');
	    if(is_array($this->data['question_list']) && COUNT($this->data['question_list'])>0)
	    {
		$this->templatelayout->header();
		$this->templatelayout->footer();
		$this->elements['middle']		= 'examination/index';
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);  
	    }
	    else
	    {
		$this->session->set_userdata('errmsg','Sorry No Question found of this subject');
		redirect(FRONTEND_URL.'my_account/test/');
		//echo "Sorry no question found.Click <a href='".FRONTEND_URL."'>here</a> to go to home page";
		exit;
	    }
	}
	else
	{
	    $this->session->set_userdata('errmsg','Sorry No Question found of this subject');
		redirect(FRONTEND_URL.'my_account/test/');
	    //echo "Sorry no question found.Click <a href='".FRONTEND_URL."'>here</a> to go to home page";
	    exit;
	}
    }

    public function complete_exam()
    {
	$this->chk_login();
	//pr($_POST);
	$student_id	= $this->session->userdata('student_id');
	$question_list 	= $this->input->get_post('question_list');
	$is_completed	= $this->input->get_post('is_completed');
	$pass_percent	= $this->model_basic->get_settings(62);
	$total_question = COUNT($question_list);
	$is_correct	= array();
	$is_passed	= 'No';
	$total_marks	= 0;
	if(is_array($question_list) && COUNT($question_list)>0)
	{
	    foreach($question_list as $v)
	    {
		$answer_id = $this->model_basic->getValue_condition('ep_answer','id','','question_id = '.$v.' AND is_correct = "Yes"');
		if($answer_id == $this->input->get_post('answer_'.$v))
		{
		    $total_marks = $total_marks+1;
		    $is_correct[]= 'yes';
		}
		else
		    $is_correct[]= 'no';
	    }
	}
	
	if($total_marks >= (($pass_percent['pass_percent']*$total_question)/100))
	    $is_passed = 'Yes';
	
	$insertArray = array(
			    'student_id'	=> $student_id,
			    'total_score'	=> $total_marks,
			    'subjects'		=> $this->input->get_post('subject'),
			    'is_completed'	=> $is_completed,
			    'is_passed'		=> $is_passed
			    );
        $i_check = $this->model_basic->insertIntoTable('ep_examination',$insertArray);
	
	if(is_array($question_list) && COUNT($question_list)>0)
	{
	    foreach($question_list as $k=>$v)
	    {
		$insertArray = array(
			    'examination_id'	=> $i_check,
			    'question_id'	=> $v,
			    'answer_id'		=> $this->input->get_post('answer_'.$v),
			    'is_correct'	=> $is_correct[$k]
			    );	       
		$this->model_basic->insertIntoTable('ep_examination_details', $insertArray);		
	    }
	}
	redirect(FRONTEND_URL."my_account/result/");
    }
    
    public function show_details()
    {
	$exam_id 		= $this->input->get_post('exam_id');
	$data['exam_details'] 	= $this->model_examination->getDetails($exam_id);
	//pr($data['exam_details']);
	echo $html 	= $this->load->view('student/exam_details', $data, TRUE);
	exit;
    }
    
    public function del_notification()
    {
	$student_id		= $this->session->userdata('student_id');
	$notification_id 	= $this->input->get_post('notification_id');
	$user_ids		= $this->model_basic->getValue_condition('ep_notifications','user_ids','','id='.$notification_id);
	$user_ids		= explode(',',$user_ids);
	$key 			= array_search($student_id,$user_ids);
	unset($user_ids[$key]);
	$user_ids		= implode(',',$user_ids);
	$idArr			= array('id' => $notification_id);
	$updateArr		= array('user_ids' => $user_ids);
	$this->model_basic->updateIntoTable('ep_notifications', $idArr, $updateArr);
	echo 'success';
	exit;
    }
    
    public function view_notification()
    {
	$notification_id 	= $this->input->get_post('notification_id');
	$notification_details	= $this->model_basic->getValues_conditions('ep_notifications','','','id='.$notification_id);
	$notification_details[0]['added_on'] = date('d/m/Y h:i:s',strtotime($notification_details[0]['added_on']));
	echo json_encode($notification_details[0]);
	exit;
    }

    public function update_balance()
    {
		$this->chk_login();
		$student_id	= $this->session->userdata('student_id');
    	$balance	= $this->model_basic->getValue_condition('ep_student','wallet','','id = "'.$student_id.'"');
		$idArr 		= array('id'=> $student_id);
		$updateArr 	= array('wallet'=> $balance-20);
		$this->model_basic->updateIntoTable('ep_student', $idArr, $updateArr);
		echo 'success';
    }
}
?>