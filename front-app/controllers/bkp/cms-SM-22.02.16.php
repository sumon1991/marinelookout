<?php
class Cms extends MY_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->library('email');

    }
    
    public function index()
    {
    	$cms_slug = $this->uri->segment(1);
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
				
			if(is_array($_FILES) && COUNT($_FILES)>0)
			{
				$upload_config['field_name']		= 'document';
				$upload_config['file_upload_path'] 		= 'contact_doc/';
				$upload_config['max_size']			= '';
				$upload_config['max_width']			= '';
				$upload_config['max_height']		= '';
				$upload_config['encrypt_name']		= false;
				$upload_config['allowed_types']		= 'doc|docx';
						    
				$sUploaded = file_upload($upload_config);
				if($sUploaded == '')
				{
				    $upload_error = $this->session->userdata('upload_err');
				    $this->session->set_userdata('errmsg',$upload_error);
				    redirect('contact-us');
				}
			}
			    $uploaded_file = array();
			    if($sUploaded != '')
				$uploaded_file[] =	FILE_UPLOAD_ABSOLUTE_PATH.'contact_doc/'.$sUploaded;
				else
				$uploaded_file[] =	'';
				    
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
					$from 		= $siteSettings[0]['sitesettings_value'];

		       $user_mail_body = 	'<html>
						    <body>
							    <table border="0" cellpadding="0" cellspacing="0" style="boder:solid 2px grey;">
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">Hi!&nbsp;'.ucfirst($data['name']).'</td></tr>
									    <tr><td colspan="2">&nbsp;</td></tr>
									    <tr><td colspan="2">'.$subject.'</td></tr>
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
													</table>
												</body>
										</html>';
																			
					$config['to'] 			= $to;
					$config['from'] 		= $from;
					$config['from_name'] 		= $data['name'];
					$config['subject']		= $subject;
					$config['message']		= $user_mail_body;

					$mailToAdmin = send_email($config,$uploaded_file);
					//mail($to, $subject, $body, $headers);
					
					if($mailToAdmin)
					{
						$this->session->set_userdata('succmsg','Your message has been successfully sent to ePariksha.com. We shall review it and respond asap.');
						//redirect("cms/contactus");
					}
					
						
						
				}
		}
		$this->data = '';
		$this->data['settings_list'] 	= $this->model_basic->get_settings('3,6');
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



}
?>
