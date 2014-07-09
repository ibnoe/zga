<?php

class creditnotein_usedflag extends Controller {

	function creditnotein_usedflag()
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
		if (isset($_POST['creditnotein__id']))
		{
			foreach ($_POST['creditnotein__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('creditnotein', $data);
			}
		}
	}
}

?>
