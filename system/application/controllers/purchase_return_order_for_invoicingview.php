<?php

class purchase_return_order_for_invoicingview extends Controller {

	function purchase_return_order_for_invoicingview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_for_invoicing_id=0)
	{
		if ($purchase_return_order_for_invoicing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_order_for_invoicing_id);
$this->db->select('*');
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_for_invoicing_id'] = $purchase_return_order_for_invoicing_id;
foreach ($q->result() as $r) {
$data['purchasereturnorderline__lastupdate'] = $r->lastupdate;
$data['purchasereturnorderline__updatedby'] = $r->updatedby;
$data['purchasereturnorderline__created'] = $r->created;
$data['purchasereturnorderline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_order_for_invoicing_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['purchasereturnorderline__lastupdate'];
$data['updatedby'] = $_POST['purchasereturnorderline__updatedby'];
$data['created'] = $_POST['purchasereturnorderline__created'];
$data['createdby'] = $_POST['purchasereturnorderline__createdby'];
$this->db->where('id', $data['purchase_return_order_for_invoicing_id']);
$this->db->update('purchasereturnorderline', $data);
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