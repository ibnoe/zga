<?php

class cuti_to_processadd extends Controller {

	function cuti_to_processadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['cutiklaim__lastupdate'] = '';
$data['cutiklaim__updatedby'] = '';
$data['cutiklaim__created'] = '';
$data['cutiklaim__createdby'] = '';
		

		$this->load->view('cuti_to_process_add_form', $data);
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
$this->db->insert('cutiklaim', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$cutiklaim_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('cuti_to_processadd','cutiklaim','aftersave', $cutiklaim_id);
			
		
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