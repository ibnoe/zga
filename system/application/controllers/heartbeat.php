<?php

class Heartbeat extends Controller {

	function Heartbeat()
	{
		parent::Controller();	
		
		//$this->load->helper('form');
		//$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index()
	{
		$msg = $this->generallib->heartbeat();
		echo $msg;
	}
}

?>