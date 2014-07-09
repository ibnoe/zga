<?php

class banktransferkeluar_transferedflag extends Controller {

	function banktransferkeluar_transferedflag()
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
		if (isset($_POST['banktransferkeluar__id']))
		{
			foreach ($_POST['banktransferkeluar__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('banktransferkeluar', $data);
			}
		}
	}
}

?>
