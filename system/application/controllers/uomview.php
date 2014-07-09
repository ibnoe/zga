<?php

class uomview extends Controller {

	function uomview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($uom_id=0)
	{
		if ($uom_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $uom_id);
$this->db->select('*');
$q = $this->db->get('uom');
if ($q->num_rows() > 0) {
$data = array();
$data['uom_id'] = $uom_id;
foreach ($q->result() as $r) {
$data['uom__name'] = $r->name;
$data['uom__multiplier'] = $r->multiplier;
$data['uom__lastupdate'] = $r->lastupdate;
$data['uom__updatedby'] = $r->updatedby;
$data['uom__created'] = $r->created;
$data['uom__createdby'] = $r->createdby;}
$this->load->view('uom_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['uom__name'];
$data['multiplier'] = $_POST['uom__multiplier'];
$data['lastupdate'] = $_POST['uom__lastupdate'];
$data['updatedby'] = $_POST['uom__updatedby'];
$data['created'] = $_POST['uom__created'];
$data['createdby'] = $_POST['uom__createdby'];
$this->db->where('id', $data['uom_id']);
$this->db->update('uom', $data);
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