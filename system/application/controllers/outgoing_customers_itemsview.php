<?php

class outgoing_customers_itemsview extends Controller {

	function outgoing_customers_itemsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($outgoing_customers_items_id=0)
	{
		if ($outgoing_customers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $outgoing_customers_items_id);
$this->db->select('*');
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['outgoing_customers_items_id'] = $outgoing_customers_items_id;
foreach ($q->result() as $r) {
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('outgoing_customers_items_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['salesorderline__lastupdate'];
$data['updatedby'] = $_POST['salesorderline__updatedby'];
$data['created'] = $_POST['salesorderline__created'];
$data['createdby'] = $_POST['salesorderline__createdby'];
$this->db->where('id', $data['outgoing_customers_items_id']);
$this->db->update('salesorderline', $data);
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