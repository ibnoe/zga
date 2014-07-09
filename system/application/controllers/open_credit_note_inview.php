<?php

class open_credit_note_inview extends Controller {

	function open_credit_note_inview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_credit_note_in_id=0)
	{
		if ($open_credit_note_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_credit_note_in_id);
$this->db->select('*');
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0) {
$data = array();
$data['open_credit_note_in_id'] = $open_credit_note_in_id;
foreach ($q->result() as $r) {
$data['creditnotein__lastupdate'] = $r->lastupdate;
$data['creditnotein__updatedby'] = $r->updatedby;
$data['creditnotein__created'] = $r->created;
$data['creditnotein__createdby'] = $r->createdby;}
$this->load->view('open_credit_note_in_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['creditnotein__lastupdate'];
$data['updatedby'] = $_POST['creditnotein__updatedby'];
$data['created'] = $_POST['creditnotein__created'];
$data['createdby'] = $_POST['creditnotein__createdby'];
$this->db->where('id', $data['open_credit_note_in_id']);
$this->db->update('creditnotein', $data);
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