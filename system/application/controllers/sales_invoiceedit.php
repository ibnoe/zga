<?php

class sales_invoiceedit extends Controller {

	function sales_invoiceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_invoice_id=0)
	{
		if ($sales_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_invoice_id'] = $sales_invoice_id;
foreach ($q->result() as $r) {
$data['salesinvoice__date'] = $r->date;
$data['salesinvoice__orderid'] = $r->orderid;
$data['salesinvoice__donum'] = $r->donum;
$deliveryorder_opt = array();
$deliveryorder_opt[''] = 'None';
$q = $this->db->get('deliveryorder');
foreach ($q->result() as $row) { $deliveryorder_opt[$row->id] = $row->orderid; }
$data['deliveryorder_opt'] = $deliveryorder_opt;
$data['salesinvoice__deliveryorder_id'] = $r->deliveryorder_id;
$data['salesinvoice__customer_id'] = $r->customer_id;
$data['salesinvoice__currency_id'] = $r->currency_id;
$data['salesinvoice__currencyrate'] = $r->currencyrate;
$data['salesinvoice__total'] = $r->total;
$data['salesinvoice__top'] = $r->top;
$data['salesinvoice__lastupdate'] = $r->lastupdate;
$data['salesinvoice__updatedby'] = $r->updatedby;
$data['salesinvoice__created'] = $r->created;
$data['salesinvoice__createdby'] = $r->createdby;}
$this->load->view('sales_invoice_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesinvoice__date']) && ($_POST['salesinvoice__date'] == "" || $_POST['salesinvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesinvoice__orderid']) && ($_POST['salesinvoice__orderid'] == "" || $_POST['salesinvoice__orderid'] == null))
$error .= "<span class='error'>Sales Invoice No must not be empty"."</span><br>";

if (isset($_POST['salesinvoice__orderid'])) {$this->db->where("id !=", $_POST['sales_invoice_id']);
$this->db->where('orderid', $_POST['salesinvoice__orderid']);
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Sales Invoice No must be unique"."</span><br>";}

if (!isset($_POST['salesinvoice__deliveryorder_id']) || ($_POST['salesinvoice__deliveryorder_id'] == "" || $_POST['salesinvoice__deliveryorder_id'] == null  || $_POST['salesinvoice__deliveryorder_id'] == 0))
$error .= "<span class='error'>Delivery Order must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesinvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['salesinvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesinvoice__orderid']))
$data['orderid'] = $_POST['salesinvoice__orderid'];if (isset($_POST['salesinvoice__donum']))
$data['donum'] = $_POST['salesinvoice__donum'];if (isset($_POST['salesinvoice__deliveryorder_id']))
$data['deliveryorder_id'] = $_POST['salesinvoice__deliveryorder_id'];if (isset($_POST['salesinvoice__customer_id']))
$data['customer_id'] = $_POST['salesinvoice__customer_id'];if (isset($_POST['salesinvoice__currency_id']))
$data['currency_id'] = $_POST['salesinvoice__currency_id'];if (isset($_POST['salesinvoice__currencyrate']))
$data['currencyrate'] = $_POST['salesinvoice__currencyrate'];if (isset($_POST['salesinvoice__total']))
$data['total'] = $_POST['salesinvoice__total'];if (isset($_POST['salesinvoice__top']))
$data['top'] = $_POST['salesinvoice__top'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_invoice_id']);
$this->db->update('salesinvoice', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_invoiceedit','salesinvoice','afteredit', $_POST['sales_invoice_id']);
			
			
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