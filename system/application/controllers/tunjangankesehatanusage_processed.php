<?php

class tunjangankesehatanusage_processed extends Controller {

	function tunjangankesehatanusage_processed()
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
		if (isset($_POST['tunjangankesehatanusage__id']))
		{
			foreach ($_POST['tunjangankesehatanusage__id'] as $k=>$v)
			{
				$id = $v;
				$this->db->where('id', $id);
				$this->db->update('tunjangankesehatanusage', $data);
			}
		}
	}
}

?>
