<?php

class open_purchase_orderadd extends Controller {

	function open_purchase_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['porder__orderid'] = '';
$data['porder__date'] = '';
$data['porder__notes'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__contact_id'] = '';
$currency_opt = array();
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['porder__currency_id'] = '';
$data['porder__currencyrate'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__to_id'] = '';
$data['porder__taxable'] = '';
$data['porder__taxincluded'] = '';
$data['porder__'] = '';
		

		$this->load->view('open_purchase_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['porder__orderid']) && ($_POST['porder__orderid'] == "" || $_POST['porder__orderid'] == null))
$error .= "<span class='error'>Order ID must not be empty"."</span><br>";

if (isset($_POST['porder__orderid'])) {
$this->db->where('orderid', $_POST['porder__orderid']);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['porder__contact_id']) && ($_POST['porder__contact_id'] == "" || $_POST['porder__contact_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (isset($_POST['porder__to_id']) && ($_POST['porder__to_id'] == "" || $_POST['porder__to_id'] == null))
$error .= "<span class='error'>Ship To Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['porder__orderid']))
$data['orderid'] = $_POST['porder__orderid'];if (isset($_POST['porder__date']))
$data['date'] = $_POST['porder__date'];if (isset($_POST['porder__notes']))
$data['notes'] = $_POST['porder__notes'];if (isset($_POST['porder__contact_id']))
$data['contact_id'] = $_POST['porder__contact_id'];if (isset($_POST['porder__currency_id']))
$data['currency_id'] = $_POST['porder__currency_id'];if (isset($_POST['porder__currencyrate']))
$data['currencyrate'] = $_POST['porder__currencyrate'];if (isset($_POST['porder__to_id']))
$data['to_id'] = $_POST['porder__to_id'];if (isset($_POST['porder__taxable']))
$data['taxable'] = $_POST['porder__taxable'];if (isset($_POST['porder__taxincluded']))
$data['taxincluded'] = $_POST['porder__taxincluded'];if (isset($_POST['porder__']))
$data[''] = $_POST['porder__'];
$this->db->insert('porder', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>