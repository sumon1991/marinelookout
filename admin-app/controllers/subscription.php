<?php

 class Subscription extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_basic');
    }
    
    public function index(){
        $this->chk_login(); 
		$this->data='';  
		$data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
		$data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
		$data['search_keyword']   = "";
        if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0){
            $start            	= 0;
        }
        else{
            $start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
        }
        $data['startRecord']   	= $start;
        $data['to_record']   	= $start+PER_PAGE_LISTING;
        $total_subscription     = $this->model_basic->getValues_conditions('ep_subscription',array('count(id) as total_sub' ));
        $data['totalRecord'] = $total_subscription     = $total_subscription[0]['total_sub'];
            /********** FOR PAGINATION ***********/
        $config['base_url'] = base_url().'/subscription/index';
        $config['per_page'] = PER_PAGE_LISTING;
        $config['total_rows'] = $total_subscription;
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
        $this->db->limit($config['per_page'],$offset);
        $this->db->order_by('id','DESC');
        $this->db->from('ep_subscription');
        $result = $this->db->get();
        $result = $result->result_array();
        $data['records'] = $result;
        $config['uri_segment']	= 3;
        $config['num_links'] 	= 5;
        $this->pagination->setCustomAdminPaginationStyle($config);
        $this->pagination->initialize($config);
        $data['pagination']     = $this->pagination->create_links();
                
    
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='subscription/list';
        $this->elements_data['middle'] = $data;             
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
 }

?>