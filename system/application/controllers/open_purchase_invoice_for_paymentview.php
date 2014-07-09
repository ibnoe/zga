<?php

class open_purchase_invoice_for_paymentview extends Controller {

	function open_purchase_invoice_for_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_purchase_invoice_for_payment_id=0)
	{
		if ($open_purchase_invoice_for_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_purchase_invoice_for_payment_id);
$this->db->select('*');
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['open_purchase_invoice_for_payment_id'] = $open_purchase_invoice_for_payment_id;
foreach ($q->result() as $r) {
$data['purchaseinvoice__lastupdate'] = $r->lastupdate;
$data['purchaseinvoice__updatedby'] = $r->updatedby;
$data['purchaseinvoice__created'] = $r->created;
$data['purchaseinvoice__createdby'] = $r->createdby;}
$this->load->view('open_purchase_invoice_for_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['purchaseinvoice__lastupdate'];
$data['updatedby'] = $_POST['purchaseinvoice__updatedby'];
$data['created'] = $_POST['purchaseinvoice__created'];
$data['createdby'] = $_POST['purchaseinvoice__createdby'];
$this->db->where('id', $data['open_purchase_invoice_for_payment_id']);
$this->db->update('purchaseinvoice', $data);
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