<?php

class stockadd extends Controller {

	function stockadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
		

		$this->load->view('stock_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$this->db->insert('stock', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$stock_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stockadd','stock','aftersave', $stock_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>