<?php

class open_credit_note_outview extends Controller {

	function open_credit_note_outview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_credit_note_out_id=0)
	{
		if ($open_credit_note_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_credit_note_out_id);
$this->db->select('*');
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0) {
$data = array();
$data['open_credit_note_out_id'] = $open_credit_note_out_id;
foreach ($q->result() as $r) {
$data['creditnoteout__lastupdate'] = $r->lastupdate;
$data['creditnoteout__updatedby'] = $r->updatedby;
$data['creditnoteout__created'] = $r->created;
$data['creditnoteout__createdby'] = $r->createdby;}
$this->load->view('open_credit_note_out_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['creditnoteout__lastupdate'];
$data['updatedby'] = $_POST['creditnoteout__updatedby'];
$data['created'] = $_POST['creditnoteout__created'];
$data['createdby'] = $_POST['creditnoteout__createdby'];
$this->db->where('id', $data['open_credit_note_out_id']);
$this->db->update('creditnoteout', $data);
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