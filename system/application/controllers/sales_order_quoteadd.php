<?php

class sales_order_quoteadd extends Controller {

	function sales_order_quoteadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesorder__nopenawaran'] = '';$this->load->library('generallib');
$data['salesorder__nopenawaran'] = $this->generallib->genId('Sales Order Quote');
$data['salesorder__customerponumber'] = '';
$data['salesorder__date'] = '';
$data['salesorder__notes'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesorder__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesorder__currency_id'] = '';
$data['salesorder__currencyrate'] = '';
$marketingofficer_opt = array();
$marketingofficer_opt[''] = 'None';
$q = $this->db->get('marketingofficer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['salesorder__marketingofficer_id'] = '';
$data['salesorder__status'] = '';
$data['salesorder__orderid'] = '';$this->load->library('generallib');
$data['salesorder__orderid'] = $this->generallib->genId('Sales Order Quote');
$data['salesorder__modulename'] = 'sales_order_quote';
$data['salesorder__lastupdate'] = '';
$data['salesorder__updatedby'] = '';
$data['salesorder__created'] = '';
$data['salesorder__createdby'] = '';
		

		$this->load->view('sales_order_quote_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesorder__nopenawaran']) && ($_POST['salesorder__nopenawaran'] == "" || $_POST['salesorder__nopenawaran'] == null))
$error .= "<span class='error'>No Penawaran must not be empty"."</span><br>";

if (isset($_POST['salesorder__nopenawaran'])) {
$this->db->where('nopenawaran', $_POST['salesorder__nopenawaran']);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Penawaran must be unique"."</span><br>";}

if (isset($_POST['salesorder__customerponumber'])) {
$this->db->where('customerponumber', $_POST['salesorder__customerponumber']);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO must be unique"."</span><br>";}

if (isset($_POST['salesorder__date']) && ($_POST['salesorder__date'] == "" || $_POST['salesorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['salesorder__customer_id']) || ($_POST['salesorder__customer_id'] == "" || $_POST['salesorder__customer_id'] == null  || $_POST['salesorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesorder__currency_id']) || ($_POST['salesorder__currency_id'] == "" || $_POST['salesorder__currency_id'] == null  || $_POST['salesorder__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salesorder__status'] == "Approved")
if (isset($_POST['salesorder__orderid']) && ($_POST['salesorder__orderid'] == "" || $_POST['salesorder__orderid'] == null))
$error .= "<span class='error'>SO ID must not be empty"."</span><br>";

if (isset($_POST['salesorder__orderid'])) {
$this->db->where('orderid', $_POST['salesorder__orderid']);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>SO ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorder__nopenawaran']))
$data['nopenawaran'] = $_POST['salesorder__nopenawaran'];if (isset($_POST['salesorder__customerponumber']))
$data['customerponumber'] = $_POST['salesorder__customerponumber'];if (isset($_POST['salesorder__date']))
$this->db->set('date', "str_to_date('".$_POST['salesorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesorder__notes']))
$data['notes'] = $_POST['salesorder__notes'];if (isset($_POST['salesorder__customer_id']))
$data['customer_id'] = $_POST['salesorder__customer_id'];if (isset($_POST['salesorder__currency_id']))
$data['currency_id'] = $_POST['salesorder__currency_id'];if (isset($_POST['salesorder__currencyrate']))
$data['currencyrate'] = $_POST['salesorder__currencyrate'];if (isset($_POST['salesorder__marketingofficer_id']))
$data['marketingofficer_id'] = $_POST['salesorder__marketingofficer_id'];if (isset($_POST['salesorder__status']))
$data['status'] = $_POST['salesorder__status'];if (isset($_POST['salesorder__orderid']))
$data['orderid'] = $_POST['salesorder__orderid'];if (isset($_POST['salesorder__modulename']))
$data['modulename'] = $_POST['salesorder__modulename'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_order_quoteadd','salesorder','aftersave', $salesorder_id);
			
		
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