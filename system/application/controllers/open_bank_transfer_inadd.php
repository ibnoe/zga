<?php

class open_bank_transfer_inadd extends Controller {

	function open_bank_transfer_inadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['banktransfermasuk__lastupdate'] = '';
$data['banktransfermasuk__updatedby'] = '';
$data['banktransfermasuk__created'] = '';
$data['banktransfermasuk__createdby'] = '';
		

		$this->load->view('open_bank_transfer_in_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('banktransfermasuk', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$banktransfermasuk_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_bank_transfer_inadd','banktransfermasuk','aftersave', $banktransfermasuk_id);
			
		
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