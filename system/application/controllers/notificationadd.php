<?php

class notificationadd extends Controller {

	function notificationadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['vmessagenotification__summary'] = '';
$data['vmessagenotification__message'] = '';
$data['vmessagenotification__lastupdate'] = '';
$data['vmessagenotification__updatedby'] = '';
		

		$this->load->view('notification_add_form', $data);
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
$this->db->insert('vmessagenotification', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$vmessagenotification_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('notificationadd','vmessagenotification','aftersave', $vmessagenotification_id);
			
		
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