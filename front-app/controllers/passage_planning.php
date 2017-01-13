<?php
	class Passage_planning extends MY_Controller{

	    public function __construct(){
	        parent:: __construct();
			$this->load->library('crypto');
			$this->load->model('model_blog_with_category');
		 	$this->load->library('pagination');
	    	$this->load->helper('download');
	    }
	    
	    public function index()
	    {
			$this->data = '';
			if($this->uri->segment(2) != ''){
				$page = $this->uri->segment(2);
			} else {
				$page = 0;
			}

			$slug = "passage-planning";
			$config                 = array();
		    $config["base_url"]     = FRONTEND_URL.$slug.'/';
		    $config["total_rows"]   = $this->model_blog_with_category->count_total_files();
		    $config["per_page"]     = 8;
		    $config['uri_segment']  = 2;

		    // print_r($config);
		    // die;
		    $this->pagination->initialize($config);

		    $this->data["links"]    			= $this->pagination->create_links();
		    $this->data['category_blog_list'] 	= $this->model_blog_with_category->getAllData();
			$this->data['all_files'] 			= $this->model_blog_with_category->allFiles($config["per_page"], $page);
			$this->data['all_notice'] 			= $this->model_blog_with_category->recentNotices();
			$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
	        $this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
			// print_r($this->data['all_files']);
			// die; 
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']	=	'passage_planning/index';			
			$this->elements_data['middle'] 	= 	$this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
	    }

	    public function payment($fileid)
	    {
	    	$fileData = $this->model_blog_with_category->getFileData($fileid);

	    	if($fileData){
	    		$fileData = $fileData[0];
		    	if($fileData['paid_or_free'] == 0){
		    		$data = file_get_contents(FRONTEND_URL . 'upload/passageplan/'.$fileData['file_name']); // Read the file's contents
				    $name = $fileData['file_name'];
				    force_download($name, $data);
				    exit();
		    	} else {
		    		$this->data = '';
		    		$this->data['file_data'] = $fileData;
					$this->templatelayout->header();
					$this->templatelayout->footer();	
					$this->elements['middle']		= 'passage_planning/payment';			
					$this->elements_data['middle'] 	=  $this->data;		    
					$this->layout->setLayout('layout');
					$this->layout->multiple_view($this->elements,$this->elements_data);
		    	}
		    } else {
		    	redirect("/passage-planning/");
	            exit();
		    }
	    }

	    public function payment_proceed($fid) {
	    	$this->form_validation->set_rules('billing_name', 'Billing Name', 'trim|required');
			$this->form_validation->set_rules('billing_address', 'Billing Address', 'trim|required');
			$this->form_validation->set_rules('billing_city', 'Billing City', 'trim|required');
			$this->form_validation->set_rules('billing_state', 'Billing State', 'trim|required'); 	
			$this->form_validation->set_rules('billing_zip', 'Billing Zip', 'trim|required');
			$this->form_validation->set_rules('billing_country', 'Billing Country', 'trim|required');
			$this->form_validation->set_rules('billing_tel', 'Billing Telephone', 'trim|required');
			$this->form_validation->set_rules('billing_email', 'Billing Email', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) { 
			} else {
				$email 	= $this->input->post('billing_email');
				$name 	= $this->input->post('billing_name');
				$mobile = $this->input->post('billing_tel');
				$random_string  = rand();
			    $this->data 	= 	'';
			    $this->data['single_file_amount'] 	= $this->model_blog_with_category->getSingleFileAmount($fid);
			    $post_value 	= 	$_POST;  
			    $working_key	=	WORKING_KEY;
			    $access_code	=	ACCESS_CODE;
			    $merchant_data	=	MERCHANT_DATA;    
			    foreach ($post_value as $key => $value){
			    	if($key == 'actual_amount'){
			    		if($this->data['single_file_amount'] == $value){
				    		$merchant_data.='amount='.$value.'&';
			    		} else {
			    			$merchant_data.=$this->data['single_file_amount'].'='.$value.'&';
			    		}
			    	} else {
			    		$merchant_data.=$key.'='.$value.'&';
			    	}
			    }
				
				$encrypted_data		=	$this->crypto->encrypt($merchant_data,$working_key); 
			    $this->data['production_url']	=	'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;	
			    $this->session->set_userdata('from_page', '');
			    $this->session->set_userdata('from_page', 'pp');
			    $this->templatelayout->header();
				$this->templatelayout->footer();	
				$this->elements['middle']		= 'passage_planning/frame';			
				$this->elements_data['middle'] 	=  $this->data;		    
				$this->layout->setLayout('layout');
				$this->layout->multiple_view($this->elements,$this->elements_data);
			}
    	}
    
    	public function store_temp_data($fid) {
    		$data 		= 	$_POST;
			$insertArr	=	array(
			   'file_id' => $fid,
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
			$this->model_basic->insertIntoTable('ep_fileupload_payments_temp',$insertArr);
			echo 'Success';exit;
		}

		public function payed_doc($fid, $order_id, $randstring)
		{
			$filedata 	= $this->model_blog_with_category->getSingleFileData($fid);
			$oder_details = $this->model_blog_with_category->getOrderData($order_id);

			if(count($oder_details)){
				if( $filedata['can_download'] >= $oder_details[0]['download_attempt']){
					$count = $oder_details[0]['download_attempt']+1;
					$update_count = $this->model_blog_with_category->updateDownloadCount($oder_details[0]['id'], $count);
					if($update_count){
						$data = file_get_contents(FRONTEND_URL . 'upload/passageplan/'.$filedata['file_name']); // Read the file's contents
					    $name = $filedata['file_name'];
					    force_download($name, $data);
					    exit();
					} else {
						$this->session->set_userdata('errmsg', "Given link is not valid or expired! Or some technical issue occured when downloading!");
						redirect("/passage-planning/");
		            	exit();
					}
				} else {
					$this->session->set_userdata('errmsg', "Given link is not valid or expired!");
					redirect("/passage-planning/");
	            	exit();
				}
			} else {
				$this->session->set_userdata('errmsg', "Given link is not valid or expired!");
				redirect("/passage-planning/");
	            exit();
			}
		}

		public function search($search_details, $page=0)
		{
			$this->data = '';

			$slug = "passage-planning";
			$config                 = array();
		    $config["base_url"]     = FRONTEND_URL.$slug.'/search/'.$search_details.'/';
		    $config["total_rows"]   = $this->model_blog_with_category->count_total_files($search_details);
		    $config["per_page"]     = 8;
		    $config['uri_segment']  = 4;

		    // print_r($config);
		    // die;
		    $this->pagination->initialize($config);

		    $this->data["links"]    			= $this->pagination->create_links();
		    $this->data['category_blog_list'] 	= $this->model_blog_with_category->getAllData();
			$this->data['all_files'] 			= $this->model_blog_with_category->searchedFiles($search_details, $config["per_page"], $page);
			$this->data['all_notice'] 			= $this->model_blog_with_category->recentNotices();
			$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
	        $this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
			// print_r($this->data['all_files']);
			// die; 
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']	=	'passage_planning/index';			
			$this->elements_data['middle'] 	= 	$this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		}
	}
    