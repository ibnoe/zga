<?php

class sales_paymentview extends Controller {

	function sales_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_payment_id=0)
	{
		if ($sales_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_payment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salespayment');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_payment_id'] = $sales_payment_id;
foreach ($q->result() as $r) {
$data['salespayment__date'] = $r->date;
$data['salespayment__orderid'] = $r->orderid;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salespayment__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salespayment__currency_id'] = $r->currency_id;
$data['salespayment__currencyrate'] = $r->currencyrate;
$data['salespayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salespayment__cashbank_id'] = $r->cashbank_id;
$giroin_opt = array();
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['salespayment__giroin_id'] = $r->giroin_id;
$creditnoteout_opt = array();
$q = $this->db->get('creditnoteout');
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salespayment__creditnoteout_id'] = $r->creditnoteout_id;
$data['salespayment__total'] = $r->total;
$data['salespayment__totalpay'] = $r->totalpay;
$data['salespayment__adjustment'] = $r->adjustment;
$data['salespayment__lastupdate'] = $r->lastupdate;
$data['salespayment__updatedby'] = $r->updatedby;
$data['salespayment__created'] = $r->created;
$data['salespayment__createdby'] = $r->createdby;}
$this->load->view('sales_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salespayment__date'];
$data['orderid'] = $_POST['salespayment__orderid'];
$data['customer_id'] = $_POST['salespayment__customer_id'];
$data['currency_id'] = $_POST['salespayment__currency_id'];
$data['currencyrate'] = $_POST['salespayment__currencyrate'];
$data['paymenttype'] = $_POST['salespayment__paymenttype'];
$data['cashbank_id'] = $_POST['salespayment__cashbank_id'];
$data['giroin_id'] = $_POST['salespayment__giroin_id'];
$data['creditnoteout_id'] = $_POST['salespayment__creditnoteout_id'];
$data['total'] = $_POST['salespayment__total'];
$data['totalpay'] = $_POST['salespayment__totalpay'];
$data['adjustment'] = $_POST['salespayment__adjustment'];
$data['lastupdate'] = $_POST['salespayment__lastupdate'];
$data['updatedby'] = $_POST['salespayment__updatedby'];
$data['created'] = $_POST['salespayment__created'];
$data['createdby'] = $_POST['salespayment__createdby'];
$this->db->where('id', $data['sales_payment_id']);
$this->db->update('salespayment', $data);
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