<?php

class banktransfermasuk_transferedflag extends Controller {

	function banktransfermasuk_transferedflag()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index()
	{
		$data = array();
		$data['transferedflag'] = true;
		if (isset($_POST['banktransfermasuk__id']))
		{
			foreach ($_POST['banktransfermasuk__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('banktransfermasuk', $data);
			}
		}
	}
}

?>
