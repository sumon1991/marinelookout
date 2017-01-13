<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Passageplan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_basic'));
    }

    
    public function index(){
        $this->chk_login();
		$data = array();
		$data['file_all'] = array();
		$data['pagination'] = array();



		$data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
		$data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
        
		$total_files            = $this->model_basic->getValue_condition('ep_fileupload','count(*)','total_file');
		$data['totalRecord']      = $total_files;
		$data['search_keyword']   = "";
		 $this->data['params']       = $this->nsession->userdata('EDITOR_SEARCH');
      
        if($total_files > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/passageplan/index';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_files;
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
            $resultArr=$this->model_basic->getValues_conditions('ep_fileupload','','',' 1=1 limit '.$offset.','.$config['per_page']);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $id         = $values['id'];
                    $status     = $values['status'];
                    $status_class=($status == 'Yes')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment  = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $delete_link  = base_url()."passageplan/delete/".$id."/".$cur_page."/";

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
                                                            'status'            => $status,
                                                            'status_class'      => $status_class,
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

                $data['file_all']        = $total_result;
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
		$this->elements['middle']='passageplan/file_list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

    }
    
    public function create(){
        
       
         if($this->input->post('action')=='add'){
        $this->form_validation->set_rules('file_title', 'Title', 'trim|required');
        $this->form_validation->set_rules('file_description', 'Description', 'trim|required');
        $this->form_validation->set_rules('file_amount', 'Paid or Free', 'trim|required');
        
        	if ($this->form_validation->run() == TRUE)
			{

                $insertdata['file_title'] = $_POST['file_title'];
                $insertdata['description'] = $_POST['file_description'];
                $insertdata['paid_or_free'] = $_POST['file_amount'];
                if($insertdata['paid_or_free'] == 1){
                    if($_POST['download_count'] != ''){
                        $insertdata['can_download'] = $_POST['download_count'];
                    } else {
                        $this->nsession->set_userdata('errmsg','Download attemt count is mandatory!');
                        $data['errmsg'] = $this->nsession->userdata('errmsg');
                        $this->nsession->set_userdata('errmsg','');
                        $this->templatelayout->get_topbar();
                        $this->templatelayout->get_leftmenu();
                        $this->templatelayout->get_footer();
                        $this->elements['middle']='passageplan/create';
                        $this->elements_data['middle'] = $data;             
                        $this->layout->setLayout('layout');
                        $this->layout->multiple_view($this->elements,$this->elements_data);
                    }
                } else {
                    $insertdata['can_download'] = '';
                }
                if($insertdata['paid_or_free'] != '0'){
                    //$insertdata['pay_amount'] = $_POST['pay_amount'];
                    if(isset($_POST['pay_amount'])){
                        $insertdata['amount'] = $_POST['pay_amount'];
                    } else {
                        $this->nsession->set_userdata('errmsg','Please insert only amount in integer value which is greater than 0!');
                        $data['errmsg'] = $this->nsession->userdata('errmsg');
                        $this->nsession->set_userdata('errmsg','');
                        $this->templatelayout->get_topbar();
                        $this->templatelayout->get_leftmenu();
                        $this->templatelayout->get_footer();
                        $this->elements['middle']='passageplan/create';
                        $this->elements_data['middle'] = $data;             
                        $this->layout->setLayout('layout');
                        $this->layout->multiple_view($this->elements,$this->elements_data);
                    }
                }
                $file_name = $_FILES['file_name']['name'];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                
                if($ext == 'pdf' || $ext == 'PDF' || $ext == 'doc' || $ext == 'docx' || $ext == 'xls'){
                    move_uploaded_file($_FILES['file_name']['tmp_name'], FILE_UPLOAD_ABSOLUTE_PATH.'passageplan/'.$file_name );
                    $insertdata['file_name'] = $file_name;
                    $insertdata = $this->model_basic->insertIntoTable('ep_fileupload',$insertdata);
                    $this->nsession->set_userdata('succmsg', 'File is uploaded successfully');
                    redirect("passageplan/index"); 
                } else {
                    $this->nsession->set_userdata('errmsg','Please upload pdf/doc/xls file only!');
                    $data['errmsg'] = $this->nsession->userdata('errmsg');
                    $this->nsession->set_userdata('errmsg','');
                    $this->templatelayout->get_topbar();
                    $this->templatelayout->get_leftmenu();
                    $this->templatelayout->get_footer();
                    $this->elements['middle']='passageplan/create';
                    $this->elements_data['middle'] = $data;             
                    $this->layout->setLayout('layout');
                    $this->layout->multiple_view($this->elements,$this->elements_data);
                }
            }
        }
        $data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='passageplan/create';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function delete($id){
        $file_name = $this->model_basic->getValue_condition('ep_fileupload','file_name','',' id="'.$id.'"');
        @unlink(FILE_UPLOAD_ABSOLUTE_PATH.'passageplan/'.$file_name);
        $this->model_basic->deleteData('ep_fileupload',' id="'.$id.'"');
        $this->nsession->set_userdata('succmsg', 'File is deleted successfully');
        redirect("passageplan/index"); 
        
    }
}