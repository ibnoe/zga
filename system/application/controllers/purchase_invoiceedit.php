<?php

class purchase_invoiceedit extends Controller {

	function purchase_invoiceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_invoice_id=0)
	{
		if ($purchase_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_invoice_id'] = $purchase_invoice_id;
foreach ($q->result() as $r) {
$data['purchaseinvoice__date'] = $r->date;
$data['purchaseinvoice__orderid'] = $r->orderid;
$receiveditem_opt = array();
$receiveditem_opt[''] = 'None';
$q = $this->db->get('receiveditem');
foreach ($q->result() as $row) { $receiveditem_opt[$row->id] = $row->suratjalanno; }
$data['receiveditem_opt'] = $receiveditem_opt;
$data['purchaseinvoice__receiveditem_id'] = $r->receiveditem_id;
$data['purchaseinvoice__supplier_id'] = $r->supplier_id;
$data['purchaseinvoice__currency_id'] = $r->currency_id;
$data['purchaseinvoice__currencyrate'] = $r->currencyrate;
$data['purchaseinvoice__total'] = $r->total;
$data['purchaseinvoice__top'] = $r->top;
$ongkoskirimimport_opt = array();
$ongkoskirimimport_opt[''] = 'None';
$q = $this->db->get('ongkoskirimimport');
foreach ($q->result() as $row) { $ongkoskirimimport_opt[$row->id] = $row->idstring; }
$data['ongkoskirimimport_opt'] = $ongkoskirimimport_opt;
$data['purchaseinvoice__ongkoskirimimport_id'] = $r->ongkoskirimimport_id;
$data['purchaseinvoice__lastupdate'] = $r->lastupdate;
$data['purchaseinvoice__updatedby'] = $r->updatedby;
$data['purchaseinvoice__created'] = $r->created;
$data['purchaseinvoice__createdby'] = $r->createdby;}
$this->load->view('purchase_invoice_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchaseinvoice__date']) && ($_POST['purchaseinvoice__date'] == "" || $_POST['purchaseinvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoice__orderid']) && ($_POST['purchaseinvoice__orderid'] == "" || $_POST['purchaseinvoice__orderid'] == null))
$error .= "<span class='error'>Purchase Invoice No must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoice__orderid'])) {$this->db->where("id !=", $_POST['purchase_invoice_id']);
$this->db->where('orderid', $_POST['purchaseinvoice__orderid']);
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Purchase Invoice No must be unique"."</span><br>";}

if (!isset($_POST['purchaseinvoice__receiveditem_id']) || ($_POST['purchaseinvoice__receiveditem_id'] == "" || $_POST['purchaseinvoice__receiveditem_id'] == null  || $_POST['purchaseinvoice__receiveditem_id'] == 0))
$error .= "<span class='error'>Receive Items must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseinvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['purchaseinvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchaseinvoice__orderid']))
$data['orderid'] = $_POST['purchaseinvoice__orderid'];if (isset($_POST['purchaseinvoice__receiveditem_id']))
$data['receiveditem_id'] = $_POST['purchaseinvoice__receiveditem_id'];if (isset($_POST['purchaseinvoice__supplier_id']))
$data['supplier_id'] = $_POST['purchaseinvoice__supplier_id'];if (isset($_POST['purchaseinvoice__currency_id']))
$data['currency_id'] = $_POST['purchaseinvoice__currency_id'];if (isset($_POST['purchaseinvoice__currencyrate']))
$data['currencyrate'] = $_POST['purchaseinvoice__currencyrate'];if (isset($_POST['purchaseinvoice__total']))
$data['total'] = $_POST['purchaseinvoice__total'];if (isset($_POST['purchaseinvoice__top']))
$data['top'] = $_POST['purchaseinvoice__top'];if (isset($_POST['purchaseinvoice__ongkoskirimimport_id']))
$data['ongkoskirimimport_id'] = $_POST['purchaseinvoice__ongkoskirimimport_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_invoice_id']);
$this->db->update('purchaseinvoice', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_invoiceedit','purchaseinvoice','afteredit', $_POST['purchase_invoice_id']);
			
			
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