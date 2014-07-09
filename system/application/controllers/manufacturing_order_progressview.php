<?php

class manufacturing_order_progressview extends Controller {

	function manufacturing_order_progressview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_progress_id=0)
	{
		if ($manufacturing_order_progress_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_order_progress_id);
$this->db->select('*');
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_progress_id'] = $manufacturing_order_progress_id;
foreach ($q->result() as $r) {
$data['manufacturingorder__lastupdate'] = $r->lastupdate;
$data['manufacturingorder__updatedby'] = $r->updatedby;
$data['manufacturingorder__created'] = $r->created;
$data['manufacturingorder__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_progress_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['manufacturingorder__lastupdate'];
$data['updatedby'] = $_POST['manufacturingorder__updatedby'];
$data['created'] = $_POST['manufacturingorder__created'];
$data['createdby'] = $_POST['manufacturingorder__createdby'];
$this->db->where('id', $data['manufacturing_order_progress_id']);
$this->db->update('manufacturingorder', $data);
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