<?php

class purchase_paymentview extends Controller {

	function purchase_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_payment_id=0)
	{
		if ($purchase_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_payment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasepayment');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_payment_id'] = $purchase_payment_id;
foreach ($q->result() as $r) {
$data['purchasepayment__date'] = $r->date;
$data['purchasepayment__purchasepaymentid'] = $r->purchasepaymentid;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasepayment__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasepayment__currency_id'] = $r->currency_id;
$data['purchasepayment__currencyrate'] = $r->currencyrate;
$data['purchasepayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasepayment__cashbank_id'] = $r->cashbank_id;
$giroout_opt = array();
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['purchasepayment__giroout_id'] = $r->giroout_id;
$creditnotein_opt = array();
$q = $this->db->get('creditnotein');
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasepayment__creditnotein_id'] = $r->creditnotein_id;
$data['purchasepayment__total'] = $r->total;
$data['purchasepayment__totalpay'] = $r->totalpay;
$data['purchasepayment__adjustment'] = $r->adjustment;
$data['purchasepayment__lastupdate'] = $r->lastupdate;
$data['purchasepayment__updatedby'] = $r->updatedby;
$data['purchasepayment__created'] = $r->created;
$data['purchasepayment__createdby'] = $r->createdby;}
$this->load->view('purchase_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchasepayment__date'];
$data['purchasepaymentid'] = $_POST['purchasepayment__purchasepaymentid'];
$data['supplier_id'] = $_POST['purchasepayment__supplier_id'];
$data['currency_id'] = $_POST['purchasepayment__currency_id'];
$data['currencyrate'] = $_POST['purchasepayment__currencyrate'];
$data['paymenttype'] = $_POST['purchasepayment__paymenttype'];
$data['cashbank_id'] = $_POST['purchasepayment__cashbank_id'];
$data['giroout_id'] = $_POST['purchasepayment__giroout_id'];
$data['creditnotein_id'] = $_POST['purchasepayment__creditnotein_id'];
$data['total'] = $_POST['purchasepayment__total'];
$data['totalpay'] = $_POST['purchasepayment__totalpay'];
$data['adjustment'] = $_POST['purchasepayment__adjustment'];
$data['lastupdate'] = $_POST['purchasepayment__lastupdate'];
$data['updatedby'] = $_POST['purchasepayment__updatedby'];
$data['created'] = $_POST['purchasepayment__created'];
$data['createdby'] = $_POST['purchasepayment__createdby'];
$this->db->where('id', $data['purchase_payment_id']);
$this->db->update('purchasepayment', $data);
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