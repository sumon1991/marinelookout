<?php
class Cms extends MY_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->library('email');
		$this->load->model(array('model_home','model_basic','model_common','model_administrator', 'model_blog_with_category'));

    }
    
    public function index()
    {
    	$cms_slug = $this->uri->segment(1);
	if($cms_slug=='about-us'){
	$this->data = '';
	$this->data['cms']	= array();
	$this->data['cms']	= $this->model_basic->getValues_conditions(CMS, array(), '', "cms_slug = '".$cms_slug."'");
	//pr($this->data['cms']);

	$this->templatelayout->header();
	$this->templatelayout->footer();
	
	$this->elements['middle']		= 'cms/index';			
	$this->elements_data['middle'] 	=  $this->data;
		    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
	
	}elseif($cms_slug=='refund-policy'){
	    
	 $this->data = '';
	$this->data['cms']	= array();
	$this->data['cms']	= $this->model_basic->getValues_conditions(CMS, array(), '', "cms_slug = '".$cms_slug."'");
	//pr($this->data['cms']);

	$this->templatelayout->header();
	$this->templatelayout->footer();
	
	$this->elements['middle']		= 'cms/refund_policy';			
	$this->elements_data['middle'] 	=  $this->data;
		    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);   
	    
	
	}elseif($cms_slug=='terms-and-conditions'){
	    
	 $this->data = '';
	$this->data['cms']	= array();
	$this->data['cms']	= $this->model_basic->getValues_conditions(CMS, array(), '', "cms_slug = '".$cms_slug."'");
	//pr($this->data['cms']);

	$this->templatelayout->header();
	$this->templatelayout->footer();
	
	$this->elements['middle']		= 'cms/refund_policy';			
	$this->elements_data['middle'] 	=  $this->data;
		    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);   
	    
	    
	    
	}
    }
    
    public function contactus()
    {	

    	if($this->input->post('action') == "email")
    	{
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$this->form_validation->set_rules('name', 'Name', 'trim|required');        	
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length(150)');
		
				if ($this->form_validation->run() == TRUE)
				{
				
			
			  
				    
					$name 		= addslashes(ucwords(trim($this->input->post('name'))));
					$email 		= $this->input->post('email');
					$comment 	= addslashes($this->input->post('comment'));
	
					$data = array(
									'name'		=>	$name,
									'email'		=>	$email,
									'comment'	=>	$comment
					);		

					

					// Mail to USER
					$siteSettings	= $this->model_basic->getValues_conditions(SETTINGS, array('sitesettings_value'),'','sitesettings_id=1 AND status="active"', '', '', '');
					$to 		= $data['email'];
					$subject	= "Thank you for contacting with us. We will get back to you soon.";
					$noreplyext = "IMPORTANT: Please do not reply to this message or mail as this is an automated mail service.For any queries, please write us on info@marinelookout.com";
					$from 		= $siteSettings[0]['sitesettings_value'];

		       $user_mail_body = 	'<html>
						    <body>
							    <table border="0" cellpadding="0" cellspacing="0" style="boder:solid 2px grey;">
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">Hi!&nbsp;'.ucfirst($data['name']).'</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">'.$subject.'</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">-----------------------------------------------------</td></tr>
									    <tr><td colspan="4">'.$noreplyext.'</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
							    </table>
						    </body>
					    </html>';
															
					$config['to'] 			= $to;
					$config['from'] 		= $from;
					$config['from_name'] 		= $data['name'];
					$config['subject']		= $subject;
					$config['message']		= $user_mail_body;

					send_email($config);
					//mail($to, $subject, $body, $headers);

					//$settings 	= $this->model_administrator->get_settings('1');

					// Mail to ADMIN
					$to 		= $siteSettings[0]['sitesettings_value']; 
					$subject	= "New contact request arrived";
					$from 		= $data['email'];
					//$ip 	  = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

					$user_mail_body = 	'<html>
												<body>
													<table border="0" cellpadding="1" cellspacing="1" style="border-radius:3px;background:#bababa;color:#000;padding:0 7px 0 7px;">
															<tr><td colspan="2">&nbsp;</td></tr>
															<tr><td colspan="2">Hi! Admin,</td></tr>
															<tr><td colspan="2">&nbsp;</td></tr>
															<tr><td colspan="2">'.$subject.'</td></tr>
															<tr><td colspan="2">&nbsp;</td></tr>
															<tr>
																	<td>Contact Name:</td>
																	<td>&nbsp;'.ucfirst($data['name']).'</td>
															</tr>
															
															<tr>
																	<td>Email Address:</td>
																	<td>&nbsp;'.$data['email'].'</td>
															</tr>
															<tr>
																	<td>Comments:</td>
																	<td>&nbsp;'.stripslashes($data['comment']).'</td>
															</tr>
															<tr><td colspan="2">&nbsp;</td></tr>
														    <tr><td colspan="2">&nbsp;</td></tr>
														    <tr><td colspan="2">&nbsp;</td></tr>
														    <tr><td colspan="2">&nbsp;</td></tr>
														    <tr><td colspan="2">-----------------------------------------------------</td></tr>
														    <tr><td colspan="4">'.$noreplyext.'</td></tr>
														    <tr><td colspan="2">&nbsp;</td></tr>
													</table>
												</body>
										</html>';
																			
					$config['to'] 			= $to;
					$config['from'] 		= $from;
					$config['from_name'] 		= $data['name'];
					$config['subject']		= $subject;
					$config['message']		= $user_mail_body;

					$mailToAdmin = send_email($config);
					//mail($to, $subject, $body, $headers);
					
					if($mailToAdmin)
					{
						$this->session->set_userdata('succmsg','Your message has been successfully sent to marinelookout.com We shall review it and respond asap.');
						//redirect("cms/contactus");
					}
					
						
						
				}
		}
		$this->data = '';
		$this->data['settings_list'] 	= $this->model_basic->get_settings('1,3,6');
		$this->data['errmsg']  = $this->session->userdata('errmsg');
		$this->data['succmsg']  = $this->session->userdata('succmsg');
		$this->session->unset_userdata('errmsg');
		$this->session->unset_userdata('succmsg');
		$this->templatelayout->header();
		$this->templatelayout->footer();		
		$this->elements['middle']	= 'cms/contact';			
		$this->elements_data['middle'] 	=  $this->data;
			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
			
    }
	
	public function test_insert(){
		$data = $this->model_basic->getValues_conditions('epwp_posts');
		foreach($data as $d){
			$insData = array(
							 
							 'created_at' => $d['post_date'],
							 'post_author' => $d['post_author'],
							 'post_content' => $d['post_content'],
							 'post_title' => $d['post_title'],
							 'post_slug' => str_replace(' ','-',strtolower($d['post_title'])),
							 'post_status' => 'Publish',
							 'post_parent' => $d['post_parent'],
							 'menu_order'	=> $d['menu_order']
							 );
			$this->model_basic->insertIntoTable('ep_blog_posts',$insData);
		}
	}



}
?>
