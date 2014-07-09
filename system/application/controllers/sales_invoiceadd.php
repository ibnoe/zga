<?php

class sales_invoiceadd extends Controller {

	function sales_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesinvoice__date'] = '';
$data['salesinvoice__orderid'] = '';$this->load->library('generallib');
$data['salesinvoice__orderid'] = $this->generallib->genId('Sales Invoice');
$data['salesinvoice__donum'] = '';
$deliveryorder_opt = array();
$deliveryorder_opt[''] = 'None';
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $deliveryorder_opt[$row->id] = $row->orderid; }
$data['deliveryorder_opt'] = $deliveryorder_opt;
$data['salesinvoice__deliveryorder_id'] = '';
$data['salesinvoice__customer_id'] = '';
$data['salesinvoice__currency_id'] = '';
$data['salesinvoice__currencyrate'] = '';
$data['salesinvoice__total'] = '';
$data['salesinvoice__top'] = '';
$data['salesinvoice__lastupdate'] = '';
$data['salesinvoice__updatedby'] = '';
$data['salesinvoice__created'] = '';
$data['salesinvoice__createdby'] = '';
		

		$this->load->view('sales_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesinvoice__date']) && ($_POST['salesinvoice__date'] == "" || $_POST['salesinvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesinvoice__orderid']) && ($_POST['salesinvoice__orderid'] == "" || $_POST['salesinvoice__orderid'] == null))
$error .= "<span class='error'>Sales Invoice No must not be empty"."</span><br>";

if (isset($_POST['salesinvoice__orderid'])) {
$this->db->where('orderid', $_POST['salesinvoice__orderid']);
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Sales Invoice No must be unique"."</span><br>";}

if (!isset($_POST['salesinvoice__deliveryorder_id']) || ($_POST['salesinvoice__deliveryorder_id'] == "" || $_POST['salesinvoice__deliveryorder_id'] == null  || $_POST['salesinvoice__deliveryorder_id'] == null))
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
$this->db->insert('salesinvoice', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesinvoice_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_invoiceadd','salesinvoice','aftersave', $salesinvoice_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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