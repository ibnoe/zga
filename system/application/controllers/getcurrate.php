<?php

class getcurrate extends Controller {

	function getcurrate()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id) 
	{
		$this->db->where("id", $id);
		$q = $this->db->get("currency");
		
		if ($q->num_rows() > 0)
		{
			echo $q->row()->rate;
		}
		else
		{
			echo "1";
		}
	}

}

?>