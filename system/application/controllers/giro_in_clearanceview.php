<?php

class giro_in_clearanceview extends Controller {

	function giro_in_clearanceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_clearance_id=0)
	{
		if ($giro_in_clearance_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_in_clearance_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('giroinclearance');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_clearance_id'] = $giro_in_clearance_id;
foreach ($q->result() as $r) {
$data['giroinclearance__date'] = $r->date;
$data['giroinclearance__idstring'] = $r->idstring;
$data['giroinclearance__notes'] = $r->notes;
$data['giroinclearance__lastupdate'] = $r->lastupdate;
$data['giroinclearance__updatedby'] = $r->updatedby;
$data['giroinclearance__created'] = $r->created;
$data['giroinclearance__createdby'] = $r->createdby;}
$this->load->view('giro_in_clearance_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['giroinclearance__date'];
$data['idstring'] = $_POST['giroinclearance__idstring'];
$data['notes'] = $_POST['giroinclearance__notes'];
$data['lastupdate'] = $_POST['giroinclearance__lastupdate'];
$data['updatedby'] = $_POST['giroinclearance__updatedby'];
$data['created'] = $_POST['giroinclearance__created'];
$data['createdby'] = $_POST['giroinclearance__createdby'];
$this->db->where('id', $data['giro_in_clearance_id']);
$this->db->update('giroinclearance', $data);
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