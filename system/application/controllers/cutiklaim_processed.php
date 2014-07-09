<?php

class cutiklaim_processed extends Controller {

	function cutiklaim_processed()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index()
	{
		$data = array();
		$data['processed'] = true;
		if (isset($_POST['cutiklaim__id']))
		{
			foreach ($_POST['cutiklaim__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('cutiklaim', $data);
			}
		}
	}
}

?>
