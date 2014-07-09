<?php

class sales_paymentedit extends Controller {

	function sales_paymentedit()
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
	
		
$q = $this->db->where('id', $sales_payment_id);
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
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salespayment__customer_id'] = $r->customer_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salespayment__currency_id'] = $r->currency_id;
$data['salespayment__currencyrate'] = $r->currencyrate;
$data['salespayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salespayment__cashbank_id'] = $r->cashbank_id;
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['salespayment__giroin_id'] = $r->giroin_id;
$creditnoteout_opt = array();
$creditnoteout_opt[''] = 'None';
$q = $this->db->get('creditnoteout');
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salespayment__creditnoteout_id'] = $r->creditnoteout_id;
$data['salespayment__totalpay'] = $r->totalpay;
$data['salespayment__adjustment'] = $r->adjustment;
$data['salespayment__lastupdate'] = $r->lastupdate;
$data['salespayment__updatedby'] = $r->updatedby;
$data['salespayment__created'] = $r->created;
$data['salespayment__createdby'] = $r->createdby;}
$this->load->view('sales_payment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salespayment__date']) && ($_POST['salespayment__date'] == "" || $_POST['salespayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salespayment__orderid']) && ($_POST['salespayment__orderid'] == "" || $_POST['salespayment__orderid'] == null))
$error .= "<span class='error'>Sales Payment No must not be empty"."</span><br>";

if (isset($_POST['salespayment__orderid'])) {$this->db->where("id !=", $_POST['sales_payment_id']);
$this->db->where('orderid', $_POST['salespayment__orderid']);
$q = $this->db->get('salespayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>Sales Payment No must be unique"."</span><br>";}

if (!isset($_POST['salespayment__customer_id']) || ($_POST['salespayment__customer_id'] == "" || $_POST['salespayment__customer_id'] == null  || $_POST['salespayment__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salespayment__currency_id']) || ($_POST['salespayment__currency_id'] == "" || $_POST['salespayment__currency_id'] == null  || $_POST['salespayment__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['salespayment__cashbank_id']) || ($_POST['salespayment__cashbank_id'] == "" || $_POST['salespayment__cashbank_id'] == null  || $_POST['salespayment__cashbank_id'] == 0))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Giro")
if (!isset($_POST['salespayment__giroin_id']) || ($_POST['salespayment__giroin_id'] == "" || $_POST['salespayment__giroin_id'] == null  || $_POST['salespayment__giroin_id'] == 0))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Credit Note")
if (!isset($_POST['salespayment__creditnoteout_id']) || ($_POST['salespayment__creditnoteout_id'] == "" || $_POST['salespayment__creditnoteout_id'] == null  || $_POST['salespayment__creditnoteout_id'] == 0))
$error .= "<span class='error'>Credit Note Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salespayment__date']))
$this->db->set('date', "str_to_date('".$_POST['salespayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['salespayment__orderid']))
$data['orderid'] = $_POST['salespayment__orderid'];if (isset($_POST['salespayment__customer_id']))
$data['customer_id'] = $_POST['salespayment__customer_id'];if (isset($_POST['salespayment__currency_id']))
$data['currency_id'] = $_POST['salespayment__currency_id'];if (isset($_POST['salespayment__currencyrate']))
$data['currencyrate'] = $_POST['salespayment__currencyrate'];if (isset($_POST['salespayment__paymenttype']))
$data['paymenttype'] = $_POST['salespayment__paymenttype'];if (isset($_POST['salespayment__cashbank_id']))
$data['cashbank_id'] = $_POST['salespayment__cashbank_id'];if (isset($_POST['salespayment__giroin_id']))
$data['giroin_id'] = $_POST['salespayment__giroin_id'];if (isset($_POST['salespayment__creditnoteout_id']))
$data['creditnoteout_id'] = $_POST['salespayment__creditnoteout_id'];if (isset($_POST['salespayment__totalpay']))
$data['totalpay'] = $_POST['salespayment__totalpay'];if (isset($_POST['salespayment__adjustment']))
$data['adjustment'] = $_POST['salespayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_payment_id']);
$this->db->update('salespayment', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_paymentedit','salespayment','afteredit', $_POST['sales_payment_id']);
			
			
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