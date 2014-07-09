<?php

class sales_return_paymentedit extends Controller {

	function sales_return_paymentedit()
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
	
		
$q = $this->db->where('id', $sales_return_payment_id);
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
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnpayment__customer_id'] = $r->customer_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnpayment__currency_id'] = $r->currency_id;
$data['salesreturnpayment__currencyrate'] = $r->currencyrate;
$data['salesreturnpayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salesreturnpayment__cashbank_id'] = $r->cashbank_id;
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['salesreturnpayment__giroout_id'] = $r->giroout_id;
$creditnoteout_opt = array();
$creditnoteout_opt[''] = 'None';
$q = $this->db->get('creditnoteout');
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salesreturnpayment__creditnoteout_id'] = $r->creditnoteout_id;
$data['salesreturnpayment__totalpay'] = $r->totalpay;
$data['salesreturnpayment__adjustment'] = $r->adjustment;
$data['salesreturnpayment__lastupdate'] = $r->lastupdate;
$data['salesreturnpayment__updatedby'] = $r->updatedby;
$data['salesreturnpayment__created'] = $r->created;
$data['salesreturnpayment__createdby'] = $r->createdby;}
$this->load->view('sales_return_payment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesreturnpayment__date']) && ($_POST['salesreturnpayment__date'] == "" || $_POST['salesreturnpayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturnpayment__salesreturnpaymentid']) && ($_POST['salesreturnpayment__salesreturnpaymentid'] == "" || $_POST['salesreturnpayment__salesreturnpaymentid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['salesreturnpayment__salesreturnpaymentid'])) {$this->db->where("id !=", $_POST['sales_return_payment_id']);
$this->db->where('salesreturnpaymentid', $_POST['salesreturnpayment__salesreturnpaymentid']);
$q = $this->db->get('salesreturnpayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (!isset($_POST['salesreturnpayment__customer_id']) || ($_POST['salesreturnpayment__customer_id'] == "" || $_POST['salesreturnpayment__customer_id'] == null  || $_POST['salesreturnpayment__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturnpayment__currency_id']) || ($_POST['salesreturnpayment__currency_id'] == "" || $_POST['salesreturnpayment__currency_id'] == null  || $_POST['salesreturnpayment__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['salesreturnpayment__cashbank_id']) || ($_POST['salesreturnpayment__cashbank_id'] == "" || $_POST['salesreturnpayment__cashbank_id'] == null  || $_POST['salesreturnpayment__cashbank_id'] == 0))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Giro")
if (!isset($_POST['salesreturnpayment__giroout_id']) || ($_POST['salesreturnpayment__giroout_id'] == "" || $_POST['salesreturnpayment__giroout_id'] == null  || $_POST['salesreturnpayment__giroout_id'] == 0))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Credit Note")
if (!isset($_POST['salesreturnpayment__creditnoteout_id']) || ($_POST['salesreturnpayment__creditnoteout_id'] == "" || $_POST['salesreturnpayment__creditnoteout_id'] == null  || $_POST['salesreturnpayment__creditnoteout_id'] == 0))
$error .= "<span class='error'>Credit Note Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnpayment__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturnpayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturnpayment__salesreturnpaymentid']))
$data['salesreturnpaymentid'] = $_POST['salesreturnpayment__salesreturnpaymentid'];if (isset($_POST['salesreturnpayment__customer_id']))
$data['customer_id'] = $_POST['salesreturnpayment__customer_id'];if (isset($_POST['salesreturnpayment__currency_id']))
$data['currency_id'] = $_POST['salesreturnpayment__currency_id'];if (isset($_POST['salesreturnpayment__currencyrate']))
$data['currencyrate'] = $_POST['salesreturnpayment__currencyrate'];if (isset($_POST['salesreturnpayment__paymenttype']))
$data['paymenttype'] = $_POST['salesreturnpayment__paymenttype'];if (isset($_POST['salesreturnpayment__cashbank_id']))
$data['cashbank_id'] = $_POST['salesreturnpayment__cashbank_id'];if (isset($_POST['salesreturnpayment__giroout_id']))
$data['giroout_id'] = $_POST['salesreturnpayment__giroout_id'];if (isset($_POST['salesreturnpayment__creditnoteout_id']))
$data['creditnoteout_id'] = $_POST['salesreturnpayment__creditnoteout_id'];if (isset($_POST['salesreturnpayment__totalpay']))
$data['totalpay'] = $_POST['salesreturnpayment__totalpay'];if (isset($_POST['salesreturnpayment__adjustment']))
$data['adjustment'] = $_POST['salesreturnpayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_payment_id']);
$this->db->update('salesreturnpayment', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_paymentedit','salesreturnpayment','afteredit', $_POST['sales_return_payment_id']);
			
			
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