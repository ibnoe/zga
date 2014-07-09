<?php

class purchase_return_paymentview extends Controller {

	function purchase_return_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_payment_id=0)
	{
		if ($purchase_return_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_payment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturnpayment');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_payment_id'] = $purchase_return_payment_id;
foreach ($q->result() as $r) {
$data['purchasereturnpayment__date'] = $r->date;
$data['purchasereturnpayment__purchasereturnpaymentid'] = $r->purchasereturnpaymentid;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnpayment__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnpayment__currency_id'] = $r->currency_id;
$data['purchasereturnpayment__currencyrate'] = $r->currencyrate;
$data['purchasereturnpayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasereturnpayment__cashbank_id'] = $r->cashbank_id;
$giroin_opt = array();
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['purchasereturnpayment__giroin_id'] = $r->giroin_id;
$creditnotein_opt = array();
$q = $this->db->get('creditnotein');
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasereturnpayment__creditnotein_id'] = $r->creditnotein_id;
$data['purchasereturnpayment__total'] = $r->total;
$data['purchasereturnpayment__totalpay'] = $r->totalpay;
$data['purchasereturnpayment__adjustment'] = $r->adjustment;
$data['purchasereturnpayment__lastupdate'] = $r->lastupdate;
$data['purchasereturnpayment__updatedby'] = $r->updatedby;
$data['purchasereturnpayment__created'] = $r->created;
$data['purchasereturnpayment__createdby'] = $r->createdby;}
$this->load->view('purchase_return_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchasereturnpayment__date'];
$data['purchasereturnpaymentid'] = $_POST['purchasereturnpayment__purchasereturnpaymentid'];
$data['supplier_id'] = $_POST['purchasereturnpayment__supplier_id'];
$data['currency_id'] = $_POST['purchasereturnpayment__currency_id'];
$data['currencyrate'] = $_POST['purchasereturnpayment__currencyrate'];
$data['paymenttype'] = $_POST['purchasereturnpayment__paymenttype'];
$data['cashbank_id'] = $_POST['purchasereturnpayment__cashbank_id'];
$data['giroin_id'] = $_POST['purchasereturnpayment__giroin_id'];
$data['creditnotein_id'] = $_POST['purchasereturnpayment__creditnotein_id'];
$data['total'] = $_POST['purchasereturnpayment__total'];
$data['totalpay'] = $_POST['purchasereturnpayment__totalpay'];
$data['adjustment'] = $_POST['purchasereturnpayment__adjustment'];
$data['lastupdate'] = $_POST['purchasereturnpayment__lastupdate'];
$data['updatedby'] = $_POST['purchasereturnpayment__updatedby'];
$data['created'] = $_POST['purchasereturnpayment__created'];
$data['createdby'] = $_POST['purchasereturnpayment__createdby'];
$this->db->where('id', $data['purchase_return_payment_id']);
$this->db->update('purchasereturnpayment', $data);
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