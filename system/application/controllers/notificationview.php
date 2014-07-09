<?php

class notificationview extends Controller {

	function notificationview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($notification_id=0)
	{
		if ($notification_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $notification_id);
$this->db->select('*');
$q = $this->db->get('vmessagenotification');
if ($q->num_rows() > 0) {
$data = array();
$data['notification_id'] = $notification_id;
foreach ($q->result() as $r) {
$data['vmessagenotification__summary'] = $r->summary;
$data['vmessagenotification__message'] = $r->message;
$data['vmessagenotification__lastupdate'] = $r->lastupdate;
$data['vmessagenotification__updatedby'] = $r->updatedby;}
$this->load->view('notification_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['summary'] = $_POST['vmessagenotification__summary'];
$data['message'] = $_POST['vmessagenotification__message'];
$data['lastupdate'] = $_POST['vmessagenotification__lastupdate'];
$data['updatedby'] = $_POST['vmessagenotification__updatedby'];
$this->db->where('id', $data['notification_id']);
$this->db->update('vmessagenotification', $data);
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