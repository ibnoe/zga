<?php

class open_sales_return_invoice_for_paymentview extends Controller {

	function open_sales_return_invoice_for_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_sales_return_invoice_for_payment_id=0)
	{
		if ($open_sales_return_invoice_for_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_sales_return_invoice_for_payment_id);
$this->db->select('*');
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['open_sales_return_invoice_for_payment_id'] = $open_sales_return_invoice_for_payment_id;
foreach ($q->result() as $r) {
$data['salesreturninvoice__lastupdate'] = $r->lastupdate;
$data['salesreturninvoice__updatedby'] = $r->updatedby;
$data['salesreturninvoice__created'] = $r->created;
$data['salesreturninvoice__createdby'] = $r->createdby;}
$this->load->view('open_sales_return_invoice_for_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['salesreturninvoice__lastupdate'];
$data['updatedby'] = $_POST['salesreturninvoice__updatedby'];
$data['created'] = $_POST['salesreturninvoice__created'];
$data['createdby'] = $_POST['salesreturninvoice__createdby'];
$this->db->where('id', $data['open_sales_return_invoice_for_payment_id']);
$this->db->update('salesreturninvoice', $data);
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