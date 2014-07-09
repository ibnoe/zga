<?php

class purchase_order_lineadd extends Controller {

	function purchase_order_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['purchaseorder_id'] = $id;
$data['purchaseorderline__orderid'] = '';
$data['purchaseorderline__date'] = '';
$data['purchaseorderline__notes'] = '';
$data['purchaseorderline__supplier_id'] = '';
$data['purchaseorderline__currency_id'] = '';
$data['purchaseorderline__currencyrate'] = '';
$data['purchaseorderline__warehouse_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderline__item_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchaseorderline__warehouse_id'] = '';
$data['purchaseorderline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderline__uom_id'] = '';
$data['purchaseorderline__price'] = '';
$data['purchaseorderline__hasppn'] = '';
$data['purchaseorderline__pph'] = '';
$data['purchaseorderline__subtotal'] = '';
$data['purchaseorderline__lastupdate'] = '';
$data['purchaseorderline__updatedby'] = '';
$data['purchaseorderline__created'] = '';
$data['purchaseorderline__createdby'] = '';
$purchaseorder = array();
$this->db->where('id', $id);
$q = $this->db->get('purchaseorder');
if ($q->num_rows() > 0)
$purchaseorder = $q->row_array();
$data['purchaseorderline__orderid'] = $purchaseorder['orderid'];
$data['purchaseorderline__date'] = $purchaseorder['date'];
$data['purchaseorderline__notes'] = $purchaseorder['notes'];
$data['purchaseorderline__supplier_id'] = $purchaseorder['supplier_id'];
$data['purchaseorderline__currency_id'] = $purchaseorder['currency_id'];
$data['purchaseorderline__currencyrate'] = $purchaseorder['currencyrate'];
$data['purchaseorderline__lastupdate'] = $purchaseorder['lastupdate'];
$data['purchaseorderline__updatedby'] = $purchaseorder['updatedby'];
$data['purchaseorderline__created'] = $purchaseorder['created'];
$data['purchaseorderline__createdby'] = $purchaseorder['createdby'];
		

		$this->load->view('purchase_order_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['purchaseorderline__item_id']) || ($_POST['purchaseorderline__item_id'] == "" || $_POST['purchaseorderline__item_id'] == null  || $_POST['purchaseorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['purchaseorderline__warehouse_id']) || ($_POST['purchaseorderline__warehouse_id'] == "" || $_POST['purchaseorderline__warehouse_id'] == null  || $_POST['purchaseorderline__warehouse_id'] == null))
$error .= "<span class='error'>Ship To Location must not be empty"."</span><br>";

if (isset($_POST['purchaseorderline__quantity']) && ($_POST['purchaseorderline__quantity'] == "" || $_POST['purchaseorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchaseorderline__uom_id']) || ($_POST['purchaseorderline__uom_id'] == "" || $_POST['purchaseorderline__uom_id'] == null  || $_POST['purchaseorderline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchaseorderline__price']) && ($_POST['purchaseorderline__price'] == "" || $_POST['purchaseorderline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['purchaseorder_id'] = $_POST['purchaseorder_id'];if (isset($_POST['purchaseorderline__orderid']))
$data['orderid'] = $_POST['purchaseorderline__orderid'];if (isset($_POST['purchaseorderline__date']))
$data['date'] = $_POST['purchaseorderline__date'];if (isset($_POST['purchaseorderline__notes']))
$data['notes'] = $_POST['purchaseorderline__notes'];if (isset($_POST['purchaseorderline__supplier_id']))
$data['supplier_id'] = $_POST['purchaseorderline__supplier_id'];if (isset($_POST['purchaseorderline__currency_id']))
$data['currency_id'] = $_POST['purchaseorderline__currency_id'];if (isset($_POST['purchaseorderline__currencyrate']))
$data['currencyrate'] = $_POST['purchaseorderline__currencyrate'];if (isset($_POST['purchaseorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['purchaseorderline__warehouse_id'];if (isset($_POST['purchaseorderline__item_id']))
$data['item_id'] = $_POST['purchaseorderline__item_id'];if (isset($_POST['purchaseorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['purchaseorderline__warehouse_id'];if (isset($_POST['purchaseorderline__quantity']))
$data['quantity'] = $_POST['purchaseorderline__quantity'];if (isset($_POST['purchaseorderline__uom_id']))
$data['uom_id'] = $_POST['purchaseorderline__uom_id'];if (isset($_POST['purchaseorderline__price']))
$data['price'] = $_POST['purchaseorderline__price'];if (isset($_POST['purchaseorderline__hasppn']))
$data['hasppn'] = $_POST['purchaseorderline__hasppn'];
else $data['hasppn'] = false;if (isset($_POST['purchaseorderline__pph']))
$data['pph'] = $_POST['purchaseorderline__pph'];if (isset($_POST['purchaseorderline__subtotal']))
$data['subtotal'] = $_POST['purchaseorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchaseorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_order_lineadd','purchaseorderline','aftersave', $purchaseorderline_id);
			
		
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