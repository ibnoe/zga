<?php

class journaladd extends Controller {

	function journaladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['journal__lastupdate'] = '';
$data['journal__updatedby'] = '';
$data['journal__created'] = '';
$data['journal__createdby'] = '';
		

		$this->load->view('journal_add_form', $data);
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
$this->db->insert('journal', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$journal_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journaladd','journal','aftersave', $journal_id);
			
		
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