<?php

class purchase_return_payment_lineview extends Controller {

	function purchase_return_payment_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_payment_line_id=0)
	{
		if ($purchase_return_payment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_payment_line_id);
$this->db->select('*');
$q = $this->db->get('purchasereturnpaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_payment_line_id'] = $purchase_return_payment_line_id;
foreach ($q->result() as $r) {
$purchasereturninvoice_opt = array();
$q = $this->db->get('purchasereturninvoice');
foreach ($q->result() as $row) { $purchasereturninvoice_opt[$row->id] = $row->purchasereturninvoiceid; }
$data['purchasereturninvoice_opt'] = $purchasereturninvoice_opt;
$data['purchasereturnpaymentline__purchasereturninvoice_id'] = $r->purchasereturninvoice_id;
$data['purchasereturnpaymentline__lastupdate'] = $r->lastupdate;
$data['purchasereturnpaymentline__updatedby'] = $r->updatedby;
$data['purchasereturnpaymentline__created'] = $r->created;
$data['purchasereturnpaymentline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_payment_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['purchasereturninvoice_id'] = $_POST['purchasereturnpaymentline__purchasereturninvoice_id'];
$data['lastupdate'] = $_POST['purchasereturnpaymentline__lastupdate'];
$data['updatedby'] = $_POST['purchasereturnpaymentline__updatedby'];
$data['created'] = $_POST['purchasereturnpaymentline__created'];
$data['createdby'] = $_POST['purchasereturnpaymentline__createdby'];
$this->db->where('id', $data['purchase_return_payment_line_id']);
$this->db->update('purchasereturnpaymentline', $data);
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