<?php

class journalview extends Controller {

	function journalview()
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
	
		
$this->db->where('id', $journal_id);
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
$this->load->view('journal_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['journal__lastupdate'];
$data['updatedby'] = $_POST['journal__updatedby'];
$data['created'] = $_POST['journal__created'];
$data['createdby'] = $_POST['journal__createdby'];
$this->db->where('id', $data['journal_id']);
$this->db->update('journal', $data);
			validationonserver();
			
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