<?php

class giro_in_clearance_line_viewview extends Controller {

	function giro_in_clearance_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_clearance_line_view_id=0)
	{
		if ($giro_in_clearance_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_in_clearance_line_view_id);
$this->db->select('*');
$q = $this->db->get('giroinclearanceline');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_clearance_line_view_id'] = $giro_in_clearance_line_view_id;
foreach ($q->result() as $r) {
$giroin_opt = array();
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['giroinclearanceline__giroin_id'] = $r->giroin_id;
$data['giroinclearanceline__lastupdate'] = $r->lastupdate;
$data['giroinclearanceline__updatedby'] = $r->updatedby;
$data['giroinclearanceline__created'] = $r->created;
$data['giroinclearanceline__createdby'] = $r->createdby;}
$this->load->view('giro_in_clearance_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['giroin_id'] = $_POST['giroinclearanceline__giroin_id'];
$data['lastupdate'] = $_POST['giroinclearanceline__lastupdate'];
$data['updatedby'] = $_POST['giroinclearanceline__updatedby'];
$data['created'] = $_POST['giroinclearanceline__created'];
$data['createdby'] = $_POST['giroinclearanceline__createdby'];
$this->db->where('id', $data['giro_in_clearance_line_view_id']);
$this->db->update('giroinclearanceline', $data);
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