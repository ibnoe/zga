<?php

class creditnoteout_usedflag extends Controller {

	function creditnoteout_usedflag()
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
		if (isset($_POST['creditnoteout__id']))
		{
			foreach ($_POST['creditnoteout__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('creditnoteout', $data);
			}
		}
	}
}

?>
