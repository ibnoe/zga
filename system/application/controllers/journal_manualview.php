<?php

class journal_manualview extends Controller {

	function journal_manualview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($journal_manual_id=0)
	{
		if ($journal_manual_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $journal_manual_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0) {
$data = array();
$data['journal_manual_id'] = $journal_manual_id;
foreach ($q->result() as $r) {
$data['journalmanual__reference'] = $r->reference;
$data['journalmanual__date'] = $r->date;
$data['journalmanual__notes'] = $r->notes;
$data['journalmanual__lastupdate'] = $r->lastupdate;
$data['journalmanual__updatedby'] = $r->updatedby;
$data['journalmanual__created'] = $r->created;
$data['journalmanual__createdby'] = $r->createdby;}
$this->load->view('journal_manual_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['reference'] = $_POST['journalmanual__reference'];
$data['date'] = $_POST['journalmanual__date'];
$data['notes'] = $_POST['journalmanual__notes'];
$data['lastupdate'] = $_POST['journalmanual__lastupdate'];
$data['updatedby'] = $_POST['journalmanual__updatedby'];
$data['created'] = $_POST['journalmanual__created'];
$data['createdby'] = $_POST['journalmanual__createdby'];
$this->db->where('id', $data['journal_manual_id']);
$this->db->update('journalmanual', $data);
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