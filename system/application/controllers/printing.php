<?php

class printing extends Controller {

	function printing()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($module, $id = 0)
	{
		$data = array();
		$data['id'] = $id;
		$this->load->view($module."_print_view", $data);
	}
	
}

?>