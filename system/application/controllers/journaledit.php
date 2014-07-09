<?php

class journaledit extends Controller {

	function journaledit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($journal_id=0)
	{
		if ($journal_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $journal_id);
$this->db->select('*');
$q = $this->db->get('journal');
if ($q->num_rows() > 0) {
$data = array();
$data['journal_id'] = $journal_id;
foreach ($q->result() as $r) {
$data['journal__lastupdate'] = $r->lastupdate;
$data['journal__updatedby'] = $r->updatedby;
$data['journal__created'] = $r->created;
$data['journal__createdby'] = $r->createdby;}
$this->load->view('journal_edit_form', $data);
}
		

		
		
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
$this->db->where('id', $_POST['journal_id']);
$this->db->update('journal', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journaledit','journal','afteredit', $_POST['journal_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
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