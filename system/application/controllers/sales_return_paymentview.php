<?php

class sales_return_paymentview extends Controller {

	function sales_return_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_payment_id=0)
	{
		if ($sales_return_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_return_payment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturnpayment');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_payment_id'] = $sales_return_payment_id;
foreach ($q->result() as $r) {
$data['salesreturnpayment__date'] = $r->date;
$data['salesreturnpayment__salesreturnpaymentid'] = $r->salesreturnpaymentid;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnpayment__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnpayment__currency_id'] = $r->currency_id;
$data['salesreturnpayment__currencyrate'] = $r->currencyrate;
$data['salesreturnpayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salesreturnpayment__cashbank_id'] = $r->cashbank_id;
$giroout_opt = array();
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['salesreturnpayment__giroout_id'] = $r->giroout_id;
$creditnoteout_opt = array();
$q = $this->db->get('creditnoteout');
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salesreturnpayment__creditnoteout_id'] = $r->creditnoteout_id;
$data['salesreturnpayment__total'] = $r->total;
$data['salesreturnpayment__totalpay'] = $r->totalpay;
$data['salesreturnpayment__adjustment'] = $r->adjustment;
$data['salesreturnpayment__lastupdate'] = $r->lastupdate;
$data['salesreturnpayment__updatedby'] = $r->updatedby;
$data['salesreturnpayment__created'] = $r->created;
$data['salesreturnpayment__createdby'] = $r->createdby;}
$this->load->view('sales_return_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salesreturnpayment__date'];
$data['salesreturnpaymentid'] = $_POST['salesreturnpayment__salesreturnpaymentid'];
$data['customer_id'] = $_POST['salesreturnpayment__customer_id'];
$data['currency_id'] = $_POST['salesreturnpayment__currency_id'];
$data['currencyrate'] = $_POST['salesreturnpayment__currencyrate'];
$data['paymenttype'] = $_POST['salesreturnpayment__paymenttype'];
$data['cashbank_id'] = $_POST['salesreturnpayment__cashbank_id'];
$data['giroout_id'] = $_POST['salesreturnpayment__giroout_id'];
$data['creditnoteout_id'] = $_POST['salesreturnpayment__creditnoteout_id'];
$data['total'] = $_POST['salesreturnpayment__total'];
$data['totalpay'] = $_POST['salesreturnpayment__totalpay'];
$data['adjustment'] = $_POST['salesreturnpayment__adjustment'];
$data['lastupdate'] = $_POST['salesreturnpayment__lastupdate'];
$data['updatedby'] = $_POST['salesreturnpayment__updatedby'];
$data['created'] = $_POST['salesreturnpayment__created'];
$data['createdby'] = $_POST['salesreturnpayment__createdby'];
$this->db->where('id', $data['sales_return_payment_id']);
$this->db->update('salesreturnpayment', $data);
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