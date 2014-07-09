<?php

class manufacturing_order_done_to_rejectview extends Controller {

	function manufacturing_order_done_to_rejectview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_done_to_reject_id=0)
	{
		if ($manufacturing_order_done_to_reject_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_order_done_to_reject_id);
$this->db->select('*');
$q = $this->db->get('manufacturingorderdoneline');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_done_to_reject_id'] = $manufacturing_order_done_to_reject_id;
foreach ($q->result() as $r) {
$data['manufacturingorderdoneline__lastupdate'] = $r->lastupdate;
$data['manufacturingorderdoneline__updatedby'] = $r->updatedby;
$data['manufacturingorderdoneline__created'] = $r->created;
$data['manufacturingorderdoneline__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_done_to_reject_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['manufacturingorderdoneline__lastupdate'];
$data['updatedby'] = $_POST['manufacturingorderdoneline__updatedby'];
$data['created'] = $_POST['manufacturingorderdoneline__created'];
$data['createdby'] = $_POST['manufacturingorderdoneline__createdby'];
$this->db->where('id', $data['manufacturing_order_done_to_reject_id']);
$this->db->update('manufacturingorderdoneline', $data);
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