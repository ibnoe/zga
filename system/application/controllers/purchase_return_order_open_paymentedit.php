<?php

class purchase_return_order_open_paymentedit extends Controller {

	function purchase_return_order_open_paymentedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_open_payment_id=0)
	{
		if ($purchase_return_order_open_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_order_open_payment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturnorder');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_open_payment_id'] = $purchase_return_order_open_payment_id;
foreach ($q->result() as $r) {
$data['purchasereturnorder__date'] = $r->date;
$data['purchasereturnorder__purchasereturnorderid'] = $r->purchasereturnorderid;
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnorder__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnorder__currency_id'] = $r->currency_id;
$data['purchasereturnorder__currencyrate'] = $r->currencyrate;
$data['purchasereturnorder__notes'] = $r->notes;
$data['purchasereturnorder__lastupdate'] = $r->lastupdate;
$data['purchasereturnorder__updatedby'] = $r->updatedby;}
$this->load->view('purchase_return_order_open_payment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchasereturnorder__date']) && ($_POST['purchasereturnorder__date'] == "" || $_POST['purchasereturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid']) && ($_POST['purchasereturnorder__purchasereturnorderid'] == "" || $_POST['purchasereturnorder__purchasereturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid'])) {$this->db->where("id !=", $_POST['purchase_return_order_open_payment_id']);
$this->db->where('purchasereturnorderid', $_POST['purchasereturnorder__purchasereturnorderid']);
$q = $this->db->get('purchasereturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['purchasereturnorder__supplier_id']) || ($_POST['purchasereturnorder__supplier_id'] == "" || $_POST['purchasereturnorder__supplier_id'] == null  || $_POST['purchasereturnorder__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnorder__currency_id']) || ($_POST['purchasereturnorder__currency_id'] == "" || $_POST['purchasereturnorder__currency_id'] == null  || $_POST['purchasereturnorder__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnorder__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturnorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturnorder__purchasereturnorderid']))
$data['purchasereturnorderid'] = $_POST['purchasereturnorder__purchasereturnorderid'];if (isset($_POST['purchasereturnorder__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturnorder__supplier_id'];if (isset($_POST['purchasereturnorder__currency_id']))
$data['currency_id'] = $_POST['purchasereturnorder__currency_id'];if (isset($_POST['purchasereturnorder__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturnorder__currencyrate'];if (isset($_POST['purchasereturnorder__notes']))
$data['notes'] = $_POST['purchasereturnorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_order_open_payment_id']);
$this->db->update('purchasereturnorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_open_paymentedit','purchasereturnorder','afteredit', $_POST['purchase_return_order_open_payment_id']);
			
			
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