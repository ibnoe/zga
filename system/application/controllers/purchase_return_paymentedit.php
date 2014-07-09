<?php

class purchase_return_paymentedit extends Controller {

	function purchase_return_paymentedit()
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
	
		
$q = $this->db->where('id', $purchase_return_payment_id);
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
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnpayment__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnpayment__currency_id'] = $r->currency_id;
$data['purchasereturnpayment__currencyrate'] = $r->currencyrate;
$data['purchasereturnpayment__paymenttype'] = $r->paymenttype;
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasereturnpayment__cashbank_id'] = $r->cashbank_id;
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['purchasereturnpayment__giroin_id'] = $r->giroin_id;
$creditnotein_opt = array();
$creditnotein_opt[''] = 'None';
$q = $this->db->get('creditnotein');
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasereturnpayment__creditnotein_id'] = $r->creditnotein_id;
$data['purchasereturnpayment__totalpay'] = $r->totalpay;
$data['purchasereturnpayment__adjustment'] = $r->adjustment;
$data['purchasereturnpayment__lastupdate'] = $r->lastupdate;
$data['purchasereturnpayment__updatedby'] = $r->updatedby;
$data['purchasereturnpayment__created'] = $r->created;
$data['purchasereturnpayment__createdby'] = $r->createdby;}
$this->load->view('purchase_return_payment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchasereturnpayment__date']) && ($_POST['purchasereturnpayment__date'] == "" || $_POST['purchasereturnpayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid']) && ($_POST['purchasereturnpayment__purchasereturnpaymentid'] == "" || $_POST['purchasereturnpayment__purchasereturnpaymentid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid'])) {$this->db->where("id !=", $_POST['purchase_return_payment_id']);
$this->db->where('purchasereturnpaymentid', $_POST['purchasereturnpayment__purchasereturnpaymentid']);
$q = $this->db->get('purchasereturnpayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (!isset($_POST['purchasereturnpayment__supplier_id']) || ($_POST['purchasereturnpayment__supplier_id'] == "" || $_POST['purchasereturnpayment__supplier_id'] == null  || $_POST['purchasereturnpayment__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnpayment__currency_id']) || ($_POST['purchasereturnpayment__currency_id'] == "" || $_POST['purchasereturnpayment__currency_id'] == null  || $_POST['purchasereturnpayment__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['purchasereturnpayment__cashbank_id']) || ($_POST['purchasereturnpayment__cashbank_id'] == "" || $_POST['purchasereturnpayment__cashbank_id'] == null  || $_POST['purchasereturnpayment__cashbank_id'] == 0))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Giro")
if (!isset($_POST['purchasereturnpayment__giroin_id']) || ($_POST['purchasereturnpayment__giroin_id'] == "" || $_POST['purchasereturnpayment__giroin_id'] == null  || $_POST['purchasereturnpayment__giroin_id'] == 0))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Credit Note")
if (!isset($_POST['purchasereturnpayment__creditnotein_id']) || ($_POST['purchasereturnpayment__creditnotein_id'] == "" || $_POST['purchasereturnpayment__creditnotein_id'] == null  || $_POST['purchasereturnpayment__creditnotein_id'] == 0))
$error .= "<span class='error'>Credit Note In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnpayment__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturnpayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid']))
$data['purchasereturnpaymentid'] = $_POST['purchasereturnpayment__purchasereturnpaymentid'];if (isset($_POST['purchasereturnpayment__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturnpayment__supplier_id'];if (isset($_POST['purchasereturnpayment__currency_id']))
$data['currency_id'] = $_POST['purchasereturnpayment__currency_id'];if (isset($_POST['purchasereturnpayment__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturnpayment__currencyrate'];if (isset($_POST['purchasereturnpayment__paymenttype']))
$data['paymenttype'] = $_POST['purchasereturnpayment__paymenttype'];if (isset($_POST['purchasereturnpayment__cashbank_id']))
$data['cashbank_id'] = $_POST['purchasereturnpayment__cashbank_id'];if (isset($_POST['purchasereturnpayment__giroin_id']))
$data['giroin_id'] = $_POST['purchasereturnpayment__giroin_id'];if (isset($_POST['purchasereturnpayment__creditnotein_id']))
$data['creditnotein_id'] = $_POST['purchasereturnpayment__creditnotein_id'];if (isset($_POST['purchasereturnpayment__totalpay']))
$data['totalpay'] = $_POST['purchasereturnpayment__totalpay'];if (isset($_POST['purchasereturnpayment__adjustment']))
$data['adjustment'] = $_POST['purchasereturnpayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_payment_id']);
$this->db->update('purchasereturnpayment', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_paymentedit','purchasereturnpayment','afteredit', $_POST['purchase_return_payment_id']);
			
			
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