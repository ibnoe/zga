<?php

class incoming_suppliers_itemsview extends Controller {

	function incoming_suppliers_itemsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($incoming_suppliers_items_id=0)
	{
		if ($incoming_suppliers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $incoming_suppliers_items_id);
$this->db->select('*');
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['incoming_suppliers_items_id'] = $incoming_suppliers_items_id;
foreach ($q->result() as $r) {
$data['purchaseorderline__lastupdate'] = $r->lastupdate;
$data['purchaseorderline__updatedby'] = $r->updatedby;
$data['purchaseorderline__created'] = $r->created;
$data['purchaseorderline__createdby'] = $r->createdby;}
$this->load->view('incoming_suppliers_items_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['purchaseorderline__lastupdate'];
$data['updatedby'] = $_POST['purchaseorderline__updatedby'];
$data['created'] = $_POST['purchaseorderline__created'];
$data['createdby'] = $_POST['purchaseorderline__createdby'];
$this->db->where('id', $data['incoming_suppliers_items_id']);
$this->db->update('purchaseorderline', $data);
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