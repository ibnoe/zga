<?php

class purchase_return_order_open_paymentadd extends Controller {

	function purchase_return_order_open_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturnorder__date'] = '';
$data['purchasereturnorder__purchasereturnorderid'] = '';$this->load->library('generallib');
$data['purchasereturnorder__purchasereturnorderid'] = $this->generallib->genId('Purchase Return Order Open Payment');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnorder__supplier_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnorder__currency_id'] = '';
$data['purchasereturnorder__currencyrate'] = '';
$data['purchasereturnorder__notes'] = '';
$data['purchasereturnorder__lastupdate'] = '';
$data['purchasereturnorder__updatedby'] = '';
		

		$this->load->view('purchase_return_order_open_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturnorder__date']) && ($_POST['purchasereturnorder__date'] == "" || $_POST['purchasereturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid']) && ($_POST['purchasereturnorder__purchasereturnorderid'] == "" || $_POST['purchasereturnorder__purchasereturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid'])) {
$this->db->where('purchasereturnorderid', $_POST['purchasereturnorder__purchasereturnorderid']);
$q = $this->db->get('purchasereturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['purchasereturnorder__supplier_id']) || ($_POST['purchasereturnorder__supplier_id'] == "" || $_POST['purchasereturnorder__supplier_id'] == null  || $_POST['purchasereturnorder__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnorder__currency_id']) || ($_POST['purchasereturnorder__currency_id'] == "" || $_POST['purchasereturnorder__currency_id'] == null  || $_POST['purchasereturnorder__currency_id'] == null))
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
$this->db->insert('purchasereturnorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_open_paymentadd','purchasereturnorder','aftersave', $purchasereturnorder_id);
			
		
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