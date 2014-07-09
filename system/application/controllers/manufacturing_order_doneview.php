<?php

class manufacturing_order_doneview extends Controller {

	function manufacturing_order_doneview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_done_id=0)
	{
		if ($manufacturing_order_done_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_order_done_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingorderdone');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_done_id'] = $manufacturing_order_done_id;
foreach ($q->result() as $r) {
$data['manufacturingorderdone__idstring'] = $r->idstring;
$data['manufacturingorderdone__date'] = $r->date;
$data['manufacturingorderdone__notes'] = $r->notes;
$data['manufacturingorderdone__lastupdate'] = $r->lastupdate;
$data['manufacturingorderdone__updatedby'] = $r->updatedby;
$data['manufacturingorderdone__created'] = $r->created;
$data['manufacturingorderdone__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_done_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['manufacturingorderdone__idstring'];
$data['date'] = $_POST['manufacturingorderdone__date'];
$data['notes'] = $_POST['manufacturingorderdone__notes'];
$data['lastupdate'] = $_POST['manufacturingorderdone__lastupdate'];
$data['updatedby'] = $_POST['manufacturingorderdone__updatedby'];
$data['created'] = $_POST['manufacturingorderdone__created'];
$data['createdby'] = $_POST['manufacturingorderdone__createdby'];
$this->db->where('id', $data['manufacturing_order_done_id']);
$this->db->update('manufacturingorderdone', $data);
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