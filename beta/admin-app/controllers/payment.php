<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {

	public function __construct()
	{
	 parent::__construct();		
	 $this->load->model(array('model_common','model_payment'));

	}

	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['payment_all'] 		= array();
		$data['pagination'] 		= array();
		$data['per_page']       	= PER_PAGE_LISTING;		
		$data['page']     		= $this->uri->segment(3);
	
		if($this->input->get_post('is_show_all') == 1)
		   $this->nsession->set_userdata('PAYMENT_SEARCH','');
		$data['search_keyword']  = $this->nsession->userdata('PAYMENT_SEARCH');
		
	if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('PAYMENT_SEARCH')== '')
        {
             $data['search_keyword']   	 = $data['search_keyword'];
             $data['per_page'] 	      	 = $data['per_page'];
        }	
        else 
        {
		if($this->input->get_post('search_keyword',true) != '')
			$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
		else	
			$data['search_keyword']   = $this->nsession->userdata('PAYMENT_SEARCH');
			
		$data['per_page']         = $this->input->get_post('per_page',true);  
        }
	$total_student            	= $this->model_payment->countPaymentDB($data['search_keyword']);
        $data['totalRecord']      	= $total_student;
	if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            	= 0;
	else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
		
	$data['startRecord']   	= $start;
	$data['to_record']   	= $start+PER_PAGE_LISTING;
	
        if($total_student > 0)
	{
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'payment/index';
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
            $resultArr=$this->model_payment->allPaymentDB($data['search_keyword'] ,PER_PAGE_LISTING,$offset);
       

            if(count($resultArr) > 0)
	    {
                $num = 1+$offset;
		foreach($resultArr as $values)
		{
			$viewId              = $values['id'];
			$this->uri_segment  = $this->uri->total_segments();
			$cur_page           = 0;
			if ($this->uri->segment($this->uri_segment) != 0) {
			    $this->cur_page = $this->uri->segment($this->uri_segment);
			    $cur_page = (int) $this->cur_page;
			}
			$view_link    = base_url()."payment/view/".$viewId."/".$cur_page."/";
			
			if($num%2==0)
			{
			    $class = 'class="even"';
			}
			else
			{
			    $class = 'class="odd"';
			}
			
			$total_result[] = array_merge($values,
							    array(
								   'slno'  => $num,
								   'class' => $class,
								   'view_link' => $view_link
								  
								 )
							 );
			$num++;

                }

                $data['payment_all']  = $total_result;
               	$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
	    }
        }
		
		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='payment/list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
	
	public function view()
	{
	   $this->chk_login();	
		
	
        $viewId     = '';
        $viewId = $this->uri->segment(3);
       
        $this->data['paymentViewDetails'] = array();
	$this->data['paymentViewDetails'] = $this->model_payment->viewPayment($viewId);
        $data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->nsession->set_userdata('succmsg','');
	$data['errmsg'] = $this->nsession->userdata('errmsg');
	$this->nsession->set_userdata('errmsg','');
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	$this->elements['middle']='payment/view';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
       }
	
	
}
?>