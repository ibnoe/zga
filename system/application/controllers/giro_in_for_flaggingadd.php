<?php

class giro_in_for_flaggingadd extends Controller {

	function giro_in_for_flaggingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['giroin__lastupdate'] = '';
$data['giroin__updatedby'] = '';
$data['giroin__created'] = '';
$data['giroin__createdby'] = '';
		

		$this->load->view('giro_in_for_flagging_add_form', $data);
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
$this->db->insert('giroin', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$giroin_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_in_for_flaggingadd','giroin','aftersave', $giroin_id);
			
		
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