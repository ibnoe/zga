<?php

class usersedit extends Controller {

	function usersedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($users_id=0)
	{
		if ($users_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $users_id);
$this->db->select('*');
$q = $this->db->get('users');
if ($q->num_rows() > 0) {
$data = array();
$data['users_id'] = $users_id;
foreach ($q->result() as $r) {
$data['users__firstname'] = $r->firstname;
$data['users__lastname'] = $r->lastname;
$data['users__username'] = $r->username;
$data['users__password'] = $r->password;
$data['users__lastupdate'] = $r->lastupdate;
$data['users__updatedby'] = $r->updatedby;
$data['users__created'] = $r->created;
$data['users__createdby'] = $r->createdby;}
$this->load->view('users_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['users__firstname']))
$data['firstname'] = $_POST['users__firstname'];if (isset($_POST['users__lastname']))
$data['lastname'] = $_POST['users__lastname'];if (isset($_POST['users__username']))
$data['username'] = $_POST['users__username'];if (isset($_POST['users__password']))
$data['password'] = md5($_POST['users__password']);
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['users_id']);
$this->db->update('users', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('usersedit','users','afteredit', $_POST['users_id']);
			
			
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