<?php
class Payment extends MY_Controller{

    public function __construct(){
        parent:: __construct();
		$this->load->library('crypto');
		$this->load->model(array('model_basic', 'model_blog_with_category'));
	    $this->load->helper('download');
    }
    
    public function index()
    {
	$this->chk_login();
	$this->data = '';
	$this->templatelayout->header();
	$this->templatelayout->footer();	
	$this->elements['middle']		= 'payment/index';			
	$this->elements_data['middle'] 	=  $this->data;		    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function proceed()
    {
	$this->chk_login();
	$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
	$this->form_validation->set_rules('billing_name', 'Billing Name', 'trim|required');
	$this->form_validation->set_rules('billing_address', 'Billing Address', 'trim|required');
	$this->form_validation->set_rules('billing_city', 'Billing City', 'trim|required');
	$this->form_validation->set_rules('billing_state', 'Billing State', 'trim|required'); 	
	$this->form_validation->set_rules('billing_zip', 'Billing Zip', 'trim|required');
	$this->form_validation->set_rules('billing_country', 'Billing Country', 'trim|required');
	$this->form_validation->set_rules('billing_tel', 'Billing Telephone', 'trim|required');
	$this->form_validation->set_rules('billing_email', 'Billing Email', 'trim|required');
	if ($this->form_validation->run() == FALSE)
	{
	    
	}
	else
	{
	    $this->data 	= 	'';
	    $post_value 	= 	$_POST;	    
	    $working_key	=	WORKING_KEY;
	    $access_code	=	ACCESS_CODE;
	    $merchant_data	=	MERCHANT_DATA;    
	    foreach ($post_value as $key => $value){
		    $merchant_data.=$key.'='.$value.'&';
	    }
	    $encrypted_data		=	$this->crypto->encrypt($merchant_data,$working_key); 
	    $this->data['production_url']	=	'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;	
	    $this->templatelayout->header();
	    $this->templatelayout->footer();	
	    $this->elements['middle']		= 'payment/iframe';			
	    $this->elements_data['middle'] 	=  $this->data;		    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}
    }
    
    public function store_temp_data()
    {
       $data 		= 	$_POST;
       $insertArr	=	array(
				       'student_id' => $this->session->userdata('student_id'),
				       'order_no'=> $data['order_id'],					
				       'amount'=> $data['amount'],					
				       'billing_name'=> $data['billing_name'],
				       'billing_address'=> $data['billing_address'],
				       'billing_city'=> $data['billing_city'],
				       'billing_state'=> $data['billing_state'],
				       'billing_zip'=> $data['billing_zip'],					
				       'billing_country'=> $data['billing_country'],
				       'billing_tel'=> $data['billing_tel'],
				       'billing_email'=> $data['billing_email'],
				       'attempted_on'=> date('Y-m-d H:i:s')				
				   );
       $this->model_basic->insertIntoTable('ep_payment_temp',$insertArr);
       echo 'Success';exit;
    }
     
     
    public function success()
    {
    	if($this->session->userdata('from_page') == 'pp'){
    		$this->pp_success($_POST["encResp"]);
    	} else {
			$this->data	=	array();
			$insert_arr	=	array();
			$insert_arr['student_id'] = $this->session->userdata('student_id');
			$insert_arr['paid_on'] 	  = date('Y-m-d H:i:s');
			$workingKey	=	WORKING_KEY;	
			$encResponse	=	$_POST["encResp"];		
			$rcvdString	=	$this->crypto->decrypt($encResponse,$workingKey);	
			$order_status	=	"";
			$decryptValues	=	explode('&', $rcvdString);
			$dataSize	=	sizeof($decryptValues);
			if(isset($decryptValues[3])) 
			{
			    $information	=	explode('=',$decryptValues[3]);
			    $order_status	=	$information[1];
			}
			//pr($decryptValues);

			for($i = 0; $i < $dataSize; $i++) 
			{
			    $information	=	explode('=',$decryptValues[$i]);
			    if($i == 0)
				$insert_arr['order_no']	=	$information[1];
			    elseif($i == 1)
				$insert_arr['tracking_id']	=	$information[1];
			    elseif($i == 2)
				$insert_arr['bank_refno']	=	$information[1];
			    elseif($i == 3)
				$insert_arr['order_status']	=	$information[1];
			    elseif($i == 5)
				$insert_arr['payment_mode']	=	$information[1];
			    elseif($i == 6)
				$insert_arr['card_type']	=	$information[1];
			    elseif($i == 8)
				$insert_arr['message']	=	$information[1];
			    elseif($i == 10)
				$insert_arr['amount']	=	$information[1];
			    elseif($i == 11)
				$insert_arr['billing_name']	=	$information[1];
			    elseif($i == 12)
				$insert_arr['billing_address']	=	$information[1];
			    elseif($i == 13)
				$insert_arr['billing_city']	=	$information[1];
			    elseif($i == 14)
				$insert_arr['billing_state']	=	$information[1];
			    elseif($i == 15)
				$insert_arr['billing_zip']	=	$information[1];
			    elseif($i == 16)
				$insert_arr['billing_country']	=	$information[1];
			    elseif($i == 17)
				$insert_arr['billing_tel']	=	$information[1];
			    elseif($i == 18)
				$insert_arr['billing_email']	=	$information[1];
			}
			//pr($insert_arr);
			$this->model_basic->deleteData('ep_payment_temp','order_no = "'.$insert_arr['order_no'].'"');
			$this->data['student_details'] = $this->model_basic->getValues_conditions('ep_student',array('firstname','lastname','wallet'),'','id = '.$this->session->userdata('student_id'));
			if($insert_arr['order_status'] == 'Success')
			{
			    $idArr 		= array('id'=>$this->session->userdata('student_id'));
			    $updateArr 	= array('wallet'=>$this->data['student_details'][0]['wallet']+$insert_arr['amount']);
			    $this->model_basic->updateIntoTable('ep_student', $idArr, $updateArr);
			}    
			
			$this->data['payment_details'] = $insert_arr;
			$this->model_basic->insertIntoTable('ep_payment',$insert_arr);
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']		= 'payment/success';			
			$this->elements_data['middle'] 	=  $this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		}
    }
    
    public function cancel()
    {
    	if($this->session->userdata('from_page') == 'pp'){
    		$this->pp_cancel();
    	} else {
			$order_name 	=	$_POST['orderNo'];
			$order_details 	= 	$this->model_basic->getValues_conditions('ep_payment_temp','','','order_no = "'.$order_name.'"');
			if(isset($order_details[0]['id']))
			{
			    unset($order_details[0]['id']);
			    unset($order_details[0]['attempted_on']);
			    $order_details[0]['order_status'] = 'Cancelled';
			    $this->model_basic->insertIntoTable('ep_payment',$order_details[0]);
			    $this->model_basic->deleteData('ep_payment_temp','order_no = "'.$order_name.'"');
			}
			$this->data	=	array();
			$this->data['student_details'] = $this->model_basic->getValues_conditions('ep_student',array('firstname','lastname'),'','id = '.$this->session->userdata('student_id'));
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']		= 'payment/cancel';			
			$this->elements_data['middle'] 	=  $this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		}
    }
    
    public function show_details()
    {
	$payment_id 			= $_POST['paym_id'];
	$data['payment_details'] 	= $this->model_basic->getValues_conditions('ep_payment','','','id = '.$payment_id);
	echo $html 	= $this->load->view('student/payment_details', $data, TRUE);
	exit;
    }

    public function pp_success($postdata) {
    	$this->session->set_userdata('from_page', '');
		$this->data	=	array();
		$insert_arr	=	array();
		$insert_arr['paid_on'] 	  = date('Y-m-d H:i:s');
		$workingKey	=	WORKING_KEY;	
		$encResponse	=	$postdata;		
		$rcvdString	=	$this->crypto->decrypt($encResponse,$workingKey);	
		$order_status	=	"";
		$decryptValues	=	explode('&', $rcvdString);
		$dataSize	=	sizeof($decryptValues);
		if(isset($decryptValues[3])) 
		{
		    $information	=	explode('=',$decryptValues[3]);
		    $order_status	=	$information[1];
		}
		//pr($decryptValues);
		for($i = 0; $i < $dataSize; $i++) 
		{
		    $information	=	explode('=',$decryptValues[$i]);
		    if($i == 0)
			$insert_arr['order_no']	=	$information[1];
		    elseif($i == 1)
			$insert_arr['tracking_id']	=	$information[1];
		    elseif($i == 2)
			$insert_arr['bank_refno']	=	$information[1];
		    elseif($i == 3)
			$insert_arr['order_status']	=	$information[1];
		    elseif($i == 5)
			$insert_arr['payment_mode']	=	$information[1];
		    elseif($i == 6)
			$insert_arr['card_type']	=	$information[1];
		    elseif($i == 8)
			$insert_arr['message']	=	$information[1];
		    elseif($i == 10)
			$insert_arr['amount']	=	$information[1];
		    elseif($i == 11)
			$insert_arr['billing_name']	=	$information[1];
		    elseif($i == 12)
			$insert_arr['billing_address']	=	$information[1];
		    elseif($i == 13)
			$insert_arr['billing_city']	=	$information[1];
		    elseif($i == 14)
			$insert_arr['billing_state']	=	$information[1];
		    elseif($i == 15)
			$insert_arr['billing_zip']	=	$information[1];
		    elseif($i == 16)
			$insert_arr['billing_country']	=	$information[1];
		    elseif($i == 17)
			$insert_arr['billing_tel']	=	$information[1];
		    elseif($i == 18)
			$insert_arr['billing_email']	=	$information[1];
		}
		$insert_arr['download_attempt'] = 0;
		//pr($insert_arr);
		$insert_arr['file_id'] = $this->model_basic->getFileId($insert_arr['order_no']);
		
		$this->model_basic->deleteData('ep_fileupload_payments_temp','order_no = "'.$insert_arr['order_no'].'"');
		   
		$this->data['payment_details'] = $insert_arr;
		$this->model_basic->insertIntoTable('ep_fileupload_payments',$insert_arr);

		$email 	= $insert_arr['billing_email'];
		$name 	= $insert_arr['billing_name'];
		$mobile = $insert_arr['billing_tel'];
		$order_no = $insert_arr['order_no'];
		$random_string  = rand();
		/* === Send Mail ===*/

	    $to      = $email;
		$subject = 'Download Link';
		$noreplyext = "IMPORTANT: Please do not reply to this message or mail as this is an automated mail service.For any queries, please write us on info@marinelookout.com";
		    
		$message = '<table>
				<tr>
				    <td>Hello, '.$name.'</td>
				    <td><img src="'.FRONTEND_URL.'images/logo.jpg"/></td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>&nbsp;&nbsp;Your payment hasbeen successful! Please click on the link below to download file.</td>
				</tr>
				<tr>
				    <td><a href="'.FRONTEND_URL.'passage_planning/payed-doc/'.$insert_arr['file_id'].'/'.$order_no.'/'.$random_string.'" target="_blank">'.FRONTEND_URL.'passage_planning/payed-doc/'.$insert_arr['file_id'].'/'.$order_no.'/'.$random_string.'</a></td>
				</tr>
				<tr>
				    <td>We will not share you email with third parties.</td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>Thank you,</td>
				</tr>
				<tr>
				    <td>Team Marinelookout</td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>--------------------------------------------</td>
				</tr>
				<tr>
				
				    <td>'.$noreplyext.'</td>
				</tr>
			    </table>';
		$headers = 'From: info@marinelookout' . "\r\n".'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$is_send = mail($to, $subject, $message, $headers);
		
		$to      = 'info@epariksha.com';
		$subject = 'Student Registration';
		$message = '<table><tr><td>Hello,</td></tr><tr><td>One user payed to download file from website</td></tr><tr><td>Consumer Details : </td></tr><tr><td>Consumer Name : '.$name.'</td></tr><tr><td>Consumer mobile : '.$mobile.'</td></tr><tr><td>Order Id : '.$order_no.'</td></tr></table>';
		$headers = 'From: '.$email . "\r\n".'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$is_send = mail($to, $subject, $message, $headers);
		
		if($is_send == 1)
		{
		    $this->session->set_userdata('succmsg', "Your payment done successfully. File download link has been sent to your email address. Please check your inbox and Spam to get the mail.");
		}
		else
		{
		    $this->session->set_userdata('errmsg', "Payment unsuccessful!");
		}
	    /* ===End Mail Sending=== */
		$this->templatelayout->header();
		$this->templatelayout->footer();	
		$this->elements['middle']		= 'passage_planning/success';			
		$this->elements_data['middle'] 	=  $this->data;		    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
	    
    public function pp_cancel() {
    	$this->session->set_userdata('from_page', '');
		$order_name 	=	$_POST['orderNo'];
		$order_details 	= 	$this->model_basic->getValues_conditions('ep_fileupload_payments_temp','','','order_no = "'.$order_name.'"');
		if(isset($order_details[0]['id']))
		{
		    unset($order_details[0]['id']);
		    unset($order_details[0]['attempted_on']);
		    $order_details[0]['order_status'] = 'Cancelled';
		    $this->model_basic->insertIntoTable('ep_fileupload_payments',$order_details[0]);
		    $this->model_basic->deleteData('ep_fileupload_payments_temp','order_no = "'.$order_name.'"');
		}
		$this->data	=	array();
		$this->data['order_no'] = $order_name;
		$this->templatelayout->header();
		$this->templatelayout->footer();	
		$this->elements['middle']		= 'passage_planning/cancel';			
		$this->elements_data['middle'] 	=  $this->data;		    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
}
?>
