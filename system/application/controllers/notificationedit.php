<?php

class notificationedit extends Controller {

	function notificationedit()
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
	
		
$q = $this->db->where('id', $notification_id);
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
$this->load->view('notification_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['vmessagenotification__summary']))
$data['summary'] = $_POST['vmessagenotification__summary'];if (isset($_POST['vmessagenotification__message']))
$data['message'] = $_POST['vmessagenotification__message'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['notification_id']);
$this->db->update('vmessagenotification', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('notificationedit','vmessagenotification','afteredit', $_POST['notification_id']);
			
			
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