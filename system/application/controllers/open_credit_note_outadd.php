<?php

class open_credit_note_outadd extends Controller {

	function open_credit_note_outadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['creditnoteout__lastupdate'] = '';
$data['creditnoteout__updatedby'] = '';
$data['creditnoteout__created'] = '';
$data['creditnoteout__createdby'] = '';
		

		$this->load->view('open_credit_note_out_add_form', $data);
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
$this->db->insert('creditnoteout', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$creditnoteout_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_credit_note_outadd','creditnoteout','aftersave', $creditnoteout_id);
			
		
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