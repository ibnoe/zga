<?php

class purchase_return_invoiceedit extends Controller {

	function purchase_return_invoiceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_invoice_id=0)
	{
		if ($purchase_return_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_invoice_id'] = $purchase_return_invoice_id;
foreach ($q->result() as $r) {
$data['purchasereturninvoice__date'] = $r->date;
$data['purchasereturninvoice__purchasereturninvoiceid'] = $r->purchasereturninvoiceid;
$purchasereturndelivery_opt = array();
$purchasereturndelivery_opt[''] = 'None';
$q = $this->db->get('purchasereturndelivery');
foreach ($q->result() as $row) { $purchasereturndelivery_opt[$row->id] = $row->purchasereturndeliveryid; }
$data['purchasereturndelivery_opt'] = $purchasereturndelivery_opt;
$data['purchasereturninvoice__purchasereturndelivery_id'] = $r->purchasereturndelivery_id;
$data['purchasereturninvoice__supplier_id'] = $r->supplier_id;
$data['purchasereturninvoice__currency_id'] = $r->currency_id;
$data['purchasereturninvoice__currencyrate'] = $r->currencyrate;
$data['purchasereturninvoice__total'] = $r->total;
$data['purchasereturninvoice__lastupdate'] = $r->lastupdate;
$data['purchasereturninvoice__updatedby'] = $r->updatedby;
$data['purchasereturninvoice__created'] = $r->created;
$data['purchasereturninvoice__createdby'] = $r->createdby;}
$this->load->view('purchase_return_invoice_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchasereturninvoice__date']) && ($_POST['purchasereturninvoice__date'] == "" || $_POST['purchasereturninvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid']) && ($_POST['purchasereturninvoice__purchasereturninvoiceid'] == "" || $_POST['purchasereturninvoice__purchasereturninvoiceid'] == null))
$error .= "<span class='error'>Invoice No must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid'])) {$this->db->where("id !=", $_POST['purchase_return_invoice_id']);
$this->db->where('purchasereturninvoiceid', $_POST['purchasereturninvoice__purchasereturninvoiceid']);
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Invoice No must be unique"."</span><br>";}

if (!isset($_POST['purchasereturninvoice__purchasereturndelivery_id']) || ($_POST['purchasereturninvoice__purchasereturndelivery_id'] == "" || $_POST['purchasereturninvoice__purchasereturndelivery_id'] == null  || $_POST['purchasereturninvoice__purchasereturndelivery_id'] == 0))
$error .= "<span class='error'>Purchase Return Delivery must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturninvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturninvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid']))
$data['purchasereturninvoiceid'] = $_POST['purchasereturninvoice__purchasereturninvoiceid'];if (isset($_POST['purchasereturninvoice__purchasereturndelivery_id']))
$data['purchasereturndelivery_id'] = $_POST['purchasereturninvoice__purchasereturndelivery_id'];if (isset($_POST['purchasereturninvoice__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturninvoice__supplier_id'];if (isset($_POST['purchasereturninvoice__currency_id']))
$data['currency_id'] = $_POST['purchasereturninvoice__currency_id'];if (isset($_POST['purchasereturninvoice__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturninvoice__currencyrate'];if (isset($_POST['purchasereturninvoice__total']))
$data['total'] = $_POST['purchasereturninvoice__total'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_invoice_id']);
$this->db->update('purchasereturninvoice', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_invoiceedit','purchasereturninvoice','afteredit', $_POST['purchase_return_invoice_id']);
			
			
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