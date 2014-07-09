<?php

class giro_out_clearanceview extends Controller {

	function giro_out_clearanceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_clearance_id=0)
	{
		if ($giro_out_clearance_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_out_clearance_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('girooutclearance');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_clearance_id'] = $giro_out_clearance_id;
foreach ($q->result() as $r) {
$data['girooutclearance__date'] = $r->date;
$data['girooutclearance__idstring'] = $r->idstring;
$data['girooutclearance__notes'] = $r->notes;
$data['girooutclearance__lastupdate'] = $r->lastupdate;
$data['girooutclearance__updatedby'] = $r->updatedby;
$data['girooutclearance__created'] = $r->created;
$data['girooutclearance__createdby'] = $r->createdby;}
$this->load->view('giro_out_clearance_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['girooutclearance__date'];
$data['idstring'] = $_POST['girooutclearance__idstring'];
$data['notes'] = $_POST['girooutclearance__notes'];
$data['lastupdate'] = $_POST['girooutclearance__lastupdate'];
$data['updatedby'] = $_POST['girooutclearance__updatedby'];
$data['created'] = $_POST['girooutclearance__created'];
$data['createdby'] = $_POST['girooutclearance__createdby'];
$this->db->where('id', $data['giro_out_clearance_id']);
$this->db->update('girooutclearance', $data);
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