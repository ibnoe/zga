<?php

class received_suppliers_itemsview extends Controller {

	function received_suppliers_itemsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($received_suppliers_items_id=0)
	{
		if ($received_suppliers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $received_suppliers_items_id);
$this->db->select('*');
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0) {
$data = array();
$data['received_suppliers_items_id'] = $received_suppliers_items_id;
foreach ($q->result() as $r) {
$data['receiveditemline__lastupdate'] = $r->lastupdate;
$data['receiveditemline__updatedby'] = $r->updatedby;
$data['receiveditemline__created'] = $r->created;
$data['receiveditemline__createdby'] = $r->createdby;}
$this->load->view('received_suppliers_items_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['receiveditemline__lastupdate'];
$data['updatedby'] = $_POST['receiveditemline__updatedby'];
$data['created'] = $_POST['receiveditemline__created'];
$data['createdby'] = $_POST['receiveditemline__createdby'];
$this->db->where('id', $data['received_suppliers_items_id']);
$this->db->update('receiveditemline', $data);
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