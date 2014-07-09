<?php

class giro_out_clearance_line_viewview extends Controller {

	function giro_out_clearance_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_clearance_line_view_id=0)
	{
		if ($giro_out_clearance_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_out_clearance_line_view_id);
$this->db->select('*');
$q = $this->db->get('girooutclearanceline');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_clearance_line_view_id'] = $giro_out_clearance_line_view_id;
foreach ($q->result() as $r) {
$giroout_opt = array();
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['girooutclearanceline__giroout_id'] = $r->giroout_id;
$data['girooutclearanceline__lastupdate'] = $r->lastupdate;
$data['girooutclearanceline__updatedby'] = $r->updatedby;
$data['girooutclearanceline__created'] = $r->created;
$data['girooutclearanceline__createdby'] = $r->createdby;}
$this->load->view('giro_out_clearance_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['giroout_id'] = $_POST['girooutclearanceline__giroout_id'];
$data['lastupdate'] = $_POST['girooutclearanceline__lastupdate'];
$data['updatedby'] = $_POST['girooutclearanceline__updatedby'];
$data['created'] = $_POST['girooutclearanceline__created'];
$data['createdby'] = $_POST['girooutclearanceline__createdby'];
$this->db->where('id', $data['giro_out_clearance_line_view_id']);
$this->db->update('girooutclearanceline', $data);
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