<?php

class hr_usersview extends Controller {

	function hr_usersview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($hr_users_id=0)
	{
		if ($hr_users_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $hr_users_id);
$this->db->select('*');
$q = $this->db->get('users');
if ($q->num_rows() > 0) {
$data = array();
$data['hr_users_id'] = $hr_users_id;
foreach ($q->result() as $r) {
$data['users__firstname'] = $r->firstname;
$data['users__lastname'] = $r->lastname;
$data['users__username'] = $r->username;
$data['users__lastupdate'] = $r->lastupdate;
$data['users__updatedby'] = $r->updatedby;
$data['users__created'] = $r->created;
$data['users__createdby'] = $r->createdby;}
$this->load->view('hr_users_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['firstname'] = $_POST['users__firstname'];
$data['lastname'] = $_POST['users__lastname'];
$data['username'] = $_POST['users__username'];
$data['lastupdate'] = $_POST['users__lastupdate'];
$data['updatedby'] = $_POST['users__updatedby'];
$data['created'] = $_POST['users__created'];
$data['createdby'] = $_POST['users__createdby'];
$this->db->where('id', $data['hr_users_id']);
$this->db->update('users', $data);
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