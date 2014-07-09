<?php

class forwarderview extends Controller {

	function forwarderview()
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
	
		
$this->db->where('id', $forwarder_id);
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
$this->load->view('forwarder_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['forwarder__name'];
$data['address'] = $_POST['forwarder__address'];
$data['rating'] = $_POST['forwarder__rating'];
$data['notes'] = $_POST['forwarder__notes'];
$data['lastupdate'] = $_POST['forwarder__lastupdate'];
$data['updatedby'] = $_POST['forwarder__updatedby'];
$data['created'] = $_POST['forwarder__created'];
$data['createdby'] = $_POST['forwarder__createdby'];
$this->db->where('id', $data['forwarder_id']);
$this->db->update('forwarder', $data);
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