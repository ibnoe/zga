<?php

class sent_customers_itemsview extends Controller {

	function sent_customers_itemsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sent_customers_items_id=0)
	{
		if ($sent_customers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sent_customers_items_id);
$this->db->select('*');
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sent_customers_items_id'] = $sent_customers_items_id;
foreach ($q->result() as $r) {
$data['deliveryorderline__lastupdate'] = $r->lastupdate;
$data['deliveryorderline__updatedby'] = $r->updatedby;
$data['deliveryorderline__created'] = $r->created;
$data['deliveryorderline__createdby'] = $r->createdby;}
$this->load->view('sent_customers_items_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['deliveryorderline__lastupdate'];
$data['updatedby'] = $_POST['deliveryorderline__updatedby'];
$data['created'] = $_POST['deliveryorderline__created'];
$data['createdby'] = $_POST['deliveryorderline__createdby'];
$this->db->where('id', $data['sent_customers_items_id']);
$this->db->update('deliveryorderline', $data);
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