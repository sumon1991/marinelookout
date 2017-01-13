<?php
class Importquestion extends MY_Controller{
    
    var $question_csv_heading	= 'Question_Title';
    var $subject_csv_heading	= 'Subject_Name';
    var $group_csv_heading	= 'Group_Name';
    var $answer1_csv_heading 	= 'Answer_1';
    var $answer2_csv_heading 	= 'Answer_2';
    var $answer3_csv_heading 	= 'Answer_3';
    var $answer4_csv_heading 	= 'Answer_4';
    var $answer5_csv_heading 	= 'Answer_5';
    var $answer6_csv_heading	= 'Answer_6';
    var $correct_csv_heading	= 'Correct_Answer';
    var $max_answer		= 6;
    
    public function __construct(){
        parent:: __construct();     
        $this->load->model("model_basic");
	$this->load->library("csvimport");
    }
    
    public function index()
    {
	$ans 		= 1;
	$is_correct	= 'No';
	$result	= $this->csvimport->get_array(FILE_UPLOAD_ABSOLUTE_PATH . 'csv/question.csv');
	
	$subject = $subject_slug = $question_slug = '';
	$insertArr	= array();

	foreach($result as $r)
	{
	    $question	= $r[$this->question_csv_heading];
	    if($question != '')
	    {
	    
		/********** Checking Subject present in the table or not ****************/
		$subject 	= $r[$this->subject_csv_heading];
		
		$subject_id = $this->model_basic->getValue_condition('ep_subject', 'id', '', "title = '".addslashes($subject)."'");
		
		if($subject_id == '' || $subject_id < 1)
		{
		    /********** Insert into Subject ****************/
		    $subject_slug	= $this->model_basic->create_unique_slug($subject, 'ep_subject', 'subject_slug');
		    $insertSArr 	= array(
				       'title'		=> addslashes($subject),
				       'subject_slug'	=> $subject_slug,
				       'added_on'		=> date('Y-m-d H:i:s')
				       );
		    
		    $subject_id	= $this->model_basic->insertIntoTable('ep_subject',$insertSArr);
		}
	    
		/**************** Insert into Question ****************/
		$question_slug	= $this->model_basic->create_unique_slug($question, 'ep_question', 'slug');
		$insertQArr 	= array(
					    'title'		=> addslashes($question),
					    'slug'		=> $question_slug,
					    'subject_id'	=> $subject_id,
					    'group'		=> strtoupper($r[$this->group_csv_heading]),
					    'added_on'		=> date('Y-m-d H:i:s')
					    );
		    
		$question_id	= $this->model_basic->insertIntoTable('ep_question',$insertQArr);
	    
		/**************** Insert into Answer ****************/
		for($ans=1;$ans<$this->max_answer+1;$ans++)
		{
		    
		    if($r['Answer_'.$ans] != '')
		    {
			if(strtolower($ans) == strtolower($r[$this->correct_csv_heading]))
			{
			    $is_correct = 'Yes';
			}
			else
			{
			    $is_correct = 'No';
			}
		   
			$insertAArr = array(
					    'question_id'	=> $question_id,
					    'title'		=> addslashes($r['Answer_'.$ans]),
					    'is_correct'	=> $is_correct,
					    'added_on'	=> 'NOW()'
					    );
			    
			$this->model_basic->insertIntoTable('ep_answer',$insertAArr);
		    }
		}
	    }
	}
	
	echo "Success";
    }
}
?>