<?php

class open_sales_invoice_for_paymentview extends Controller {

	function open_sales_invoice_for_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_sales_invoice_for_payment_id=0)
	{
		if ($open_sales_invoice_for_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_sales_invoice_for_payment_id);
$this->db->select('*');
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['open_sales_invoice_for_payment_id'] = $open_sales_invoice_for_payment_id;
foreach ($q->result() as $r) {
$data['salesinvoice__lastupdate'] = $r->lastupdate;
$data['salesinvoice__updatedby'] = $r->updatedby;
$data['salesinvoice__created'] = $r->created;
$data['salesinvoice__createdby'] = $r->createdby;}
$this->load->view('open_sales_invoice_for_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['salesinvoice__lastupdate'];
$data['updatedby'] = $_POST['salesinvoice__updatedby'];
$data['created'] = $_POST['salesinvoice__created'];
$data['createdby'] = $_POST['salesinvoice__createdby'];
$this->db->where('id', $data['open_sales_invoice_for_payment_id']);
$this->db->update('salesinvoice', $data);
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