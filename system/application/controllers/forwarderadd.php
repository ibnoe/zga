<?php

class forwarderadd extends Controller {

	function forwarderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['forwarder__name'] = '';
$data['forwarder__address'] = '';
$data['forwarder__rating'] = '';
$data['forwarder__notes'] = '';
$data['forwarder__lastupdate'] = '';
$data['forwarder__updatedby'] = '';
$data['forwarder__created'] = '';
$data['forwarder__createdby'] = '';
		

		$this->load->view('forwarder_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['forwarder__name']) && ($_POST['forwarder__name'] == "" || $_POST['forwarder__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['forwarder__name']))
$data['name'] = $_POST['forwarder__name'];if (isset($_POST['forwarder__address']))
$data['address'] = $_POST['forwarder__address'];if (isset($_POST['forwarder__rating']))
$data['rating'] = $_POST['forwarder__rating'];if (isset($_POST['forwarder__notes']))
$data['notes'] = $_POST['forwarder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('forwarder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$forwarder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('forwarderadd','forwarder','aftersave', $forwarder_id);
			
		
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