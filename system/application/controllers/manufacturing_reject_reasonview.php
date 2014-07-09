<?php

class manufacturing_reject_reasonview extends Controller {

	function manufacturing_reject_reasonview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_reject_reason_id=0)
	{
		if ($manufacturing_reject_reason_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_reject_reason_id);
$this->db->select('*');
$q = $this->db->get('manufacturingrejectreason');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_reject_reason_id'] = $manufacturing_reject_reason_id;
foreach ($q->result() as $r) {
$data['manufacturingrejectreason__name'] = $r->name;
$data['manufacturingrejectreason__name'] = $r->name;
$data['manufacturingrejectreason__lastupdate'] = $r->lastupdate;
$data['manufacturingrejectreason__updatedby'] = $r->updatedby;
$data['manufacturingrejectreason__created'] = $r->created;
$data['manufacturingrejectreason__createdby'] = $r->createdby;}
$this->load->view('manufacturing_reject_reason_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['manufacturingrejectreason__name'];
$data['name'] = $_POST['manufacturingrejectreason__name'];
$data['lastupdate'] = $_POST['manufacturingrejectreason__lastupdate'];
$data['updatedby'] = $_POST['manufacturingrejectreason__updatedby'];
$data['created'] = $_POST['manufacturingrejectreason__created'];
$data['createdby'] = $_POST['manufacturingrejectreason__createdby'];
$this->db->where('id', $data['manufacturing_reject_reason_id']);
$this->db->update('manufacturingrejectreason', $data);
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