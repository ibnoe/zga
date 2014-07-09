<?php

class giroin_usedflag extends Controller {

	function giroin_usedflag()
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
		if (isset($_POST['giroin__id']))
		{
			foreach ($_POST['giroin__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('giroin', $data);
			}
		}
	}
}

?>
