<?php

class giro_in_for_flaggingview extends Controller {

	function giro_in_for_flaggingview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_for_flagging_id=0)
	{
		if ($giro_in_for_flagging_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_in_for_flagging_id);
$this->db->select('*');
$q = $this->db->get('giroin');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_for_flagging_id'] = $giro_in_for_flagging_id;
foreach ($q->result() as $r) {
$data['giroin__lastupdate'] = $r->lastupdate;
$data['giroin__updatedby'] = $r->updatedby;
$data['giroin__created'] = $r->created;
$data['giroin__createdby'] = $r->createdby;}
$this->load->view('giro_in_for_flagging_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['giroin__lastupdate'];
$data['updatedby'] = $_POST['giroin__updatedby'];
$data['created'] = $_POST['giroin__created'];
$data['createdby'] = $_POST['giroin__createdby'];
$this->db->where('id', $data['giro_in_for_flagging_id']);
$this->db->update('giroin', $data);
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