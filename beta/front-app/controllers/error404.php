<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends MY_Controller {

	
	public function __construct(){
		parent::__construct();

	}
	
	public function index(){
		
		$this->data 			= '';
		
		$this->templatelayout->header();
		$this->templatelayout->footer();
		
		$this->elements['middle']	=	'error_404';			
		$this->elements_data['middle'] 	= 	$this->data;
			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		    
	}
}