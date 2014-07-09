<?php

class forwarderedit extends Controller {

	function forwarderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($forwarder_id=0)
	{
		if ($forwarder_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $forwarder_id);
$this->db->select('*');
$q = $this->db->get('forwarder');
if ($q->num_rows() > 0) {
$data = array();
$data['forwarder_id'] = $forwarder_id;
foreach ($q->result() as $r) {
$data['forwarder__name'] = $r->name;
$data['forwarder__address'] = $r->address;
$data['forwarder__rating'] = $r->rating;
$data['forwarder__notes'] = $r->notes;
$data['forwarder__lastupdate'] = $r->lastupdate;
$data['forwarder__updatedby'] = $r->updatedby;
$data['forwarder__created'] = $r->created;
$data['forwarder__createdby'] = $r->createdby;}
$this->load->view('forwarder_edit_form', $data);
}
		

		
		
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
$this->db->where('id', $_POST['forwarder_id']);
$this->db->update('forwarder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('forwarderedit','forwarder','afteredit', $_POST['forwarder_id']);
			
			
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