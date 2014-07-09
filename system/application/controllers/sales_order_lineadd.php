<?php

class sales_order_lineadd extends Controller {

	function sales_order_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['salesorder_id'] = $id;
$data['salesorderline__orderid'] = '';
$data['salesorderline__date'] = '';
$data['salesorderline__notes'] = '';
$data['salesorderline__customer_id'] = '';
$data['salesorderline__currency_id'] = '';
$data['salesorderline__currencyrate'] = '';
$data['salesorderline__warehouse_id'] = '';
$data['salesorderline__status'] = '';
$data['salesorderline__type'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderline__item_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesorderline__warehouse_id'] = '';
$rcn_opt = array();
$rcn_opt[''] = 'None';
$q = $this->db->get('rcn');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['salesorderline__rcn_id'] = '';
$data['salesorderline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderline__uom_id'] = '';
$data['salesorderline__price'] = '';
$data['salesorderline__pdisc'] = '';
$data['salesorderline__hasppn'] = '';
$data['salesorderline__pph'] = '';
$data['salesorderline__modulename'] = 'sales_order_line';
$data['salesorderline__subtotal'] = '';
$data['salesorderline__lastupdate'] = '';
$data['salesorderline__updatedby'] = '';
$data['salesorderline__created'] = '';
$data['salesorderline__createdby'] = '';
$salesorder = array();
$this->db->where('id', $id);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0)
$salesorder = $q->row_array();
$data['salesorderline__orderid'] = $salesorder['orderid'];
$data['salesorderline__date'] = $salesorder['date'];
$data['salesorderline__notes'] = $salesorder['notes'];
$data['salesorderline__customer_id'] = $salesorder['customer_id'];
$data['salesorderline__currency_id'] = $salesorder['currency_id'];
$data['salesorderline__currencyrate'] = $salesorder['currencyrate'];
$data['salesorderline__lastupdate'] = $salesorder['lastupdate'];
$data['salesorderline__updatedby'] = $salesorder['updatedby'];
$data['salesorderline__created'] = $salesorder['created'];
$data['salesorderline__createdby'] = $salesorder['createdby'];
		

		$this->load->view('sales_order_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesorderline__item_id']) || ($_POST['salesorderline__item_id'] == "" || $_POST['salesorderline__item_id'] == null  || $_POST['salesorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['salesorderline__warehouse_id']) || ($_POST['salesorderline__warehouse_id'] == "" || $_POST['salesorderline__warehouse_id'] == null  || $_POST['salesorderline__warehouse_id'] == null))
$error .= "<span class='error'>Ship From Location must not be empty"."</span><br>";

if ($_POST['salesorderline__type'] == "Service")
if (!isset($_POST['salesorderline__rcn_id']) || ($_POST['salesorderline__rcn_id'] == "" || $_POST['salesorderline__rcn_id'] == null  || $_POST['salesorderline__rcn_id'] == null))
$error .= "<span class='error'>RCN must not be empty"."</span><br>";

if (isset($_POST['salesorderline__quantity']) && ($_POST['salesorderline__quantity'] == "" || $_POST['salesorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesorderline__uom_id']) || ($_POST['salesorderline__uom_id'] == "" || $_POST['salesorderline__uom_id'] == null  || $_POST['salesorderline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesorderline__price']) && ($_POST['salesorderline__price'] == "" || $_POST['salesorderline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['salesorder_id'] = $_POST['salesorder_id'];if (isset($_POST['salesorderline__orderid']))
$data['orderid'] = $_POST['salesorderline__orderid'];if (isset($_POST['salesorderline__date']))
$data['date'] = $_POST['salesorderline__date'];if (isset($_POST['salesorderline__notes']))
$data['notes'] = $_POST['salesorderline__notes'];if (isset($_POST['salesorderline__customer_id']))
$data['customer_id'] = $_POST['salesorderline__customer_id'];if (isset($_POST['salesorderline__currency_id']))
$data['currency_id'] = $_POST['salesorderline__currency_id'];if (isset($_POST['salesorderline__currencyrate']))
$data['currencyrate'] = $_POST['salesorderline__currencyrate'];if (isset($_POST['salesorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['salesorderline__warehouse_id'];if (isset($_POST['salesorderline__status']))
$data['status'] = $_POST['salesorderline__status'];if (isset($_POST['salesorderline__type']))
$data['type'] = $_POST['salesorderline__type'];if (isset($_POST['salesorderline__item_id']))
$data['item_id'] = $_POST['salesorderline__item_id'];if (isset($_POST['salesorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['salesorderline__warehouse_id'];if (isset($_POST['salesorderline__rcn_id']))
$data['rcn_id'] = $_POST['salesorderline__rcn_id'];if (isset($_POST['salesorderline__quantity']))
$data['quantity'] = $_POST['salesorderline__quantity'];if (isset($_POST['salesorderline__uom_id']))
$data['uom_id'] = $_POST['salesorderline__uom_id'];if (isset($_POST['salesorderline__price']))
$data['price'] = $_POST['salesorderline__price'];if (isset($_POST['salesorderline__pdisc']))
$data['pdisc'] = $_POST['salesorderline__pdisc'];if (isset($_POST['salesorderline__hasppn']))
$data['hasppn'] = $_POST['salesorderline__hasppn'];
else $data['hasppn'] = false;if (isset($_POST['salesorderline__pph']))
$data['pph'] = $_POST['salesorderline__pph'];if (isset($_POST['salesorderline__modulename']))
$data['modulename'] = $_POST['salesorderline__modulename'];if (isset($_POST['salesorderline__subtotal']))
$data['subtotal'] = $_POST['salesorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_order_lineadd','salesorderline','aftersave', $salesorderline_id);
			
		
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