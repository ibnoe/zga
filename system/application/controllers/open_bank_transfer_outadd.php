<?php

class open_bank_transfer_outadd extends Controller {

	function open_bank_transfer_outadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['banktransferkeluar__lastupdate'] = '';
$data['banktransferkeluar__updatedby'] = '';
$data['banktransferkeluar__created'] = '';
$data['banktransferkeluar__createdby'] = '';
		

		$this->load->view('open_bank_transfer_out_add_form', $data);
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
$this->db->insert('banktransferkeluar', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$banktransferkeluar_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_bank_transfer_outadd','banktransferkeluar','aftersave', $banktransferkeluar_id);
			
		
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