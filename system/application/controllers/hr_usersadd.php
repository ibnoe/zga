<?php

class hr_usersadd extends Controller {

	function hr_usersadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['users__firstname'] = '';
$data['users__lastname'] = '';
$data['users__username'] = '';
$data['users__lastupdate'] = '';
$data['users__updatedby'] = '';
$data['users__created'] = '';
$data['users__createdby'] = '';
		

		$this->load->view('hr_users_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['users__firstname']))
$data['firstname'] = $_POST['users__firstname'];if (isset($_POST['users__lastname']))
$data['lastname'] = $_POST['users__lastname'];if (isset($_POST['users__username']))
$data['username'] = $_POST['users__username'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('users', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$users_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('hr_usersadd','users','aftersave', $users_id);
			
		
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