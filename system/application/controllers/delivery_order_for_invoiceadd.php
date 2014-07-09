<?php

class delivery_order_for_invoiceadd extends Controller {

	function delivery_order_for_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['deliveryorder__date'] = '';
$data['deliveryorder__orderid'] = '';$this->load->library('generallib');
$data['deliveryorder__orderid'] = $this->generallib->genId('Delivery Order For Invoice');
$data['deliveryorder__donum'] = '';
$data['deliveryorder__dodate'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['deliveryorder__customer_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['deliveryorder__warehouse_id'] = '';
$data['deliveryorder__deliveredby'] = '';
$data['deliveryorder__vehicleno'] = '';
$data['deliveryorder__notes'] = '';
$data['deliveryorder__lastupdate'] = '';
$data['deliveryorder__updatedby'] = '';
$data['deliveryorder__created'] = '';
$data['deliveryorder__createdby'] = '';
		

		$this->load->view('delivery_order_for_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['deliveryorder__date']) && ($_POST['deliveryorder__date'] == "" || $_POST['deliveryorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid']) && ($_POST['deliveryorder__orderid'] == "" || $_POST['deliveryorder__orderid'] == null))
$error .= "<span class='error'>Delivery Order No must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid'])) {
$this->db->where('orderid', $_POST['deliveryorder__orderid']);
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Delivery Order No must be unique"."</span><br>";}

if (isset($_POST['deliveryorder__dodate']) && ($_POST['deliveryorder__dodate'] == "" || $_POST['deliveryorder__dodate'] == null))
$error .= "<span class='error'>DO Date must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__customer_id']) || ($_POST['deliveryorder__customer_id'] == "" || $_POST['deliveryorder__customer_id'] == null  || $_POST['deliveryorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__warehouse_id']) || ($_POST['deliveryorder__warehouse_id'] == "" || $_POST['deliveryorder__warehouse_id'] == null  || $_POST['deliveryorder__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['deliveryorder__date']))
$this->db->set('date', "str_to_date('".$_POST['deliveryorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['deliveryorder__orderid']))
$data['orderid'] = $_POST['deliveryorder__orderid'];if (isset($_POST['deliveryorder__donum']))
$data['donum'] = $_POST['deliveryorder__donum'];if (isset($_POST['deliveryorder__dodate']))
$this->db->set('dodate', "str_to_date('".$_POST['deliveryorder__dodate']."', '%d-%m-%Y')", false);if (isset($_POST['deliveryorder__customer_id']))
$data['customer_id'] = $_POST['deliveryorder__customer_id'];if (isset($_POST['deliveryorder__warehouse_id']))
$data['warehouse_id'] = $_POST['deliveryorder__warehouse_id'];if (isset($_POST['deliveryorder__deliveredby']))
$data['deliveredby'] = $_POST['deliveryorder__deliveredby'];if (isset($_POST['deliveryorder__vehicleno']))
$data['vehicleno'] = $_POST['deliveryorder__vehicleno'];if (isset($_POST['deliveryorder__notes']))
$data['notes'] = $_POST['deliveryorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('deliveryorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$deliveryorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('delivery_order_for_invoiceadd','deliveryorder','aftersave', $deliveryorder_id);
			
		
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