<?php

class sales_return_order_open_receivedadd extends Controller {

	function sales_return_order_open_receivedadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturnorder__date'] = '';
$data['salesreturnorder__salesreturnorderid'] = '';$this->load->library('generallib');
$data['salesreturnorder__salesreturnorderid'] = $this->generallib->genId('Sales Return Order Open Received');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnorder__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnorder__currency_id'] = '';
$data['salesreturnorder__currencyrate'] = '';
$data['salesreturnorder__notes'] = '';
$data['salesreturnorder__lastupdate'] = '';
$data['salesreturnorder__updatedby'] = '';
		

		$this->load->view('sales_return_order_open_received_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesreturnorder__date']) && ($_POST['salesreturnorder__date'] == "" || $_POST['salesreturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid']) && ($_POST['salesreturnorder__salesreturnorderid'] == "" || $_POST['salesreturnorder__salesreturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid'])) {
$this->db->where('salesreturnorderid', $_POST['salesreturnorder__salesreturnorderid']);
$q = $this->db->get('salesreturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['salesreturnorder__customer_id']) || ($_POST['salesreturnorder__customer_id'] == "" || $_POST['salesreturnorder__customer_id'] == null  || $_POST['salesreturnorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturnorder__currency_id']) || ($_POST['salesreturnorder__currency_id'] == "" || $_POST['salesreturnorder__currency_id'] == null  || $_POST['salesreturnorder__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnorder__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturnorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturnorder__salesreturnorderid']))
$data['salesreturnorderid'] = $_POST['salesreturnorder__salesreturnorderid'];if (isset($_POST['salesreturnorder__customer_id']))
$data['customer_id'] = $_POST['salesreturnorder__customer_id'];if (isset($_POST['salesreturnorder__currency_id']))
$data['currency_id'] = $_POST['salesreturnorder__currency_id'];if (isset($_POST['salesreturnorder__currencyrate']))
$data['currencyrate'] = $_POST['salesreturnorder__currencyrate'];if (isset($_POST['salesreturnorder__notes']))
$data['notes'] = $_POST['salesreturnorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$this->db->insert('salesreturnorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_order_open_receivedadd','salesreturnorder','aftersave', $salesreturnorder_id);
			
		
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