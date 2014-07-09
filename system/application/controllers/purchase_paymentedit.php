<?php

class purchase_paymentedit extends Controller {

	function purchase_paymentedit()
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
	
		
$q = $this->db->where('id', $purchase_payment_id);
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
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasepayment__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasepayment__currency_id'] = $r->currency_id;
$data['purchasepayment__currencyrate'] = $r->currencyrate;
$data['purchasepayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasepayment__cashbank_id'] = $r->cashbank_id;
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['purchasepayment__giroout_id'] = $r->giroout_id;
$creditnotein_opt = array();
$creditnotein_opt[''] = 'None';
$q = $this->db->get('creditnotein');
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasepayment__creditnotein_id'] = $r->creditnotein_id;
$data['purchasepayment__totalpay'] = $r->totalpay;
$data['purchasepayment__adjustment'] = $r->adjustment;
$data['purchasepayment__lastupdate'] = $r->lastupdate;
$data['purchasepayment__updatedby'] = $r->updatedby;
$data['purchasepayment__created'] = $r->created;
$data['purchasepayment__createdby'] = $r->createdby;}
$this->load->view('purchase_payment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchasepayment__date']) && ($_POST['purchasepayment__date'] == "" || $_POST['purchasepayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasepayment__purchasepaymentid']) && ($_POST['purchasepayment__purchasepaymentid'] == "" || $_POST['purchasepayment__purchasepaymentid'] == null))
$error .= "<span class='error'>Purchase Payment No must not be empty"."</span><br>";

if (isset($_POST['purchasepayment__purchasepaymentid'])) {$this->db->where("id !=", $_POST['purchase_payment_id']);
$this->db->where('purchasepaymentid', $_POST['purchasepayment__purchasepaymentid']);
$q = $this->db->get('purchasepayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>Purchase Payment No must be unique"."</span><br>";}

if (!isset($_POST['purchasepayment__supplier_id']) || ($_POST['purchasepayment__supplier_id'] == "" || $_POST['purchasepayment__supplier_id'] == null  || $_POST['purchasepayment__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasepayment__currency_id']) || ($_POST['purchasepayment__currency_id'] == "" || $_POST['purchasepayment__currency_id'] == null  || $_POST['purchasepayment__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['purchasepayment__cashbank_id']) || ($_POST['purchasepayment__cashbank_id'] == "" || $_POST['purchasepayment__cashbank_id'] == null  || $_POST['purchasepayment__cashbank_id'] == 0))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Giro")
if (!isset($_POST['purchasepayment__giroout_id']) || ($_POST['purchasepayment__giroout_id'] == "" || $_POST['purchasepayment__giroout_id'] == null  || $_POST['purchasepayment__giroout_id'] == 0))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Credit Note")
if (!isset($_POST['purchasepayment__creditnotein_id']) || ($_POST['purchasepayment__creditnotein_id'] == "" || $_POST['purchasepayment__creditnotein_id'] == null  || $_POST['purchasepayment__creditnotein_id'] == 0))
$error .= "<span class='error'>Credit Note In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasepayment__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasepayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasepayment__purchasepaymentid']))
$data['purchasepaymentid'] = $_POST['purchasepayment__purchasepaymentid'];if (isset($_POST['purchasepayment__supplier_id']))
$data['supplier_id'] = $_POST['purchasepayment__supplier_id'];if (isset($_POST['purchasepayment__currency_id']))
$data['currency_id'] = $_POST['purchasepayment__currency_id'];if (isset($_POST['purchasepayment__currencyrate']))
$data['currencyrate'] = $_POST['purchasepayment__currencyrate'];if (isset($_POST['purchasepayment__paymenttype']))
$data['paymenttype'] = $_POST['purchasepayment__paymenttype'];if (isset($_POST['purchasepayment__cashbank_id']))
$data['cashbank_id'] = $_POST['purchasepayment__cashbank_id'];if (isset($_POST['purchasepayment__giroout_id']))
$data['giroout_id'] = $_POST['purchasepayment__giroout_id'];if (isset($_POST['purchasepayment__creditnotein_id']))
$data['creditnotein_id'] = $_POST['purchasepayment__creditnotein_id'];if (isset($_POST['purchasepayment__totalpay']))
$data['totalpay'] = $_POST['purchasepayment__totalpay'];if (isset($_POST['purchasepayment__adjustment']))
$data['adjustment'] = $_POST['purchasepayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_payment_id']);
$this->db->update('purchasepayment', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_paymentedit','purchasepayment','afteredit', $_POST['purchase_payment_id']);
			
			
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