<?php

class giro_out_for_flaggingview extends Controller {

	function giro_out_for_flaggingview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_for_flagging_id=0)
	{
		if ($giro_out_for_flagging_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_out_for_flagging_id);
$this->db->select('*');
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_for_flagging_id'] = $giro_out_for_flagging_id;
foreach ($q->result() as $r) {
$data['giroout__lastupdate'] = $r->lastupdate;
$data['giroout__updatedby'] = $r->updatedby;
$data['giroout__created'] = $r->created;
$data['giroout__createdby'] = $r->createdby;}
$this->load->view('giro_out_for_flagging_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['giroout__lastupdate'];
$data['updatedby'] = $_POST['giroout__updatedby'];
$data['created'] = $_POST['giroout__created'];
$data['createdby'] = $_POST['giroout__createdby'];
$this->db->where('id', $data['giro_out_for_flagging_id']);
$this->db->update('giroout', $data);
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