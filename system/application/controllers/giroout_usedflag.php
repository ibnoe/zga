<?php

class giroout_usedflag extends Controller {

	function giroout_usedflag()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index()
	{
		$data = array();
		$data['usedflag'] = true;
		if (isset($_POST['giroout__id']))
		{
			foreach ($_POST['giroout__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('giroout', $data);
			}
		}
	}
}

?>
