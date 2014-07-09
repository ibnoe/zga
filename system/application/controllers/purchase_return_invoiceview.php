<?php

class purchase_return_invoiceview extends Controller {

	function purchase_return_invoiceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_invoice_id=0)
	{
		if ($purchase_return_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_invoice_id'] = $purchase_return_invoice_id;
foreach ($q->result() as $r) {
$data['purchasereturninvoice__date'] = $r->date;
$data['purchasereturninvoice__purchasereturninvoiceid'] = $r->purchasereturninvoiceid;
$purchasereturndelivery_opt = array();
$q = $this->db->get('purchasereturndelivery');
foreach ($q->result() as $row) { $purchasereturndelivery_opt[$row->id] = $row->purchasereturndeliveryid; }
$data['purchasereturndelivery_opt'] = $purchasereturndelivery_opt;
$data['purchasereturninvoice__purchasereturndelivery_id'] = $r->purchasereturndelivery_id;
$data['purchasereturninvoice__total'] = $r->total;
$data['purchasereturninvoice__lastupdate'] = $r->lastupdate;
$data['purchasereturninvoice__updatedby'] = $r->updatedby;
$data['purchasereturninvoice__created'] = $r->created;
$data['purchasereturninvoice__createdby'] = $r->createdby;}
$this->load->view('purchase_return_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchasereturninvoice__date'];
$data['purchasereturninvoiceid'] = $_POST['purchasereturninvoice__purchasereturninvoiceid'];
$data['purchasereturndelivery_id'] = $_POST['purchasereturninvoice__purchasereturndelivery_id'];
$data['total'] = $_POST['purchasereturninvoice__total'];
$data['lastupdate'] = $_POST['purchasereturninvoice__lastupdate'];
$data['updatedby'] = $_POST['purchasereturninvoice__updatedby'];
$data['created'] = $_POST['purchasereturninvoice__created'];
$data['createdby'] = $_POST['purchasereturninvoice__createdby'];
$this->db->where('id', $data['purchase_return_invoice_id']);
$this->db->update('purchasereturninvoice', $data);
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