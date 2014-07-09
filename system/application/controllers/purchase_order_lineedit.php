<?php

class purchase_order_lineedit extends Controller {

	function purchase_order_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_line_id=0)
	{
		if ($purchase_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_order_line_id);
$this->db->select('*');
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_line_id'] = $purchase_order_line_id;
foreach ($q->result() as $r) {
$data['purchaseorderline__orderid'] = $r->orderid;
$data['purchaseorderline__date'] = $r->date;
$data['purchaseorderline__notes'] = $r->notes;
$data['purchaseorderline__supplier_id'] = $r->supplier_id;
$data['purchaseorderline__currency_id'] = $r->currency_id;
$data['purchaseorderline__currencyrate'] = $r->currencyrate;
$data['purchaseorderline__warehouse_id'] = $r->warehouse_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderline__item_id'] = $r->item_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchaseorderline__warehouse_id'] = $r->warehouse_id;
$data['purchaseorderline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderline__uom_id'] = $r->uom_id;
$data['purchaseorderline__price'] = $r->price;
$data['purchaseorderline__hasppn'] = $r->hasppn;
$data['purchaseorderline__pph'] = $r->pph;
$data['purchaseorderline__subtotal'] = $r->subtotal;
$data['purchaseorderline__lastupdate'] = $r->lastupdate;
$data['purchaseorderline__updatedby'] = $r->updatedby;
$data['purchaseorderline__created'] = $r->created;
$data['purchaseorderline__createdby'] = $r->createdby;}
$this->load->view('purchase_order_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['purchaseorderline__item_id']) || ($_POST['purchaseorderline__item_id'] == "" || $_POST['purchaseorderline__item_id'] == null  || $_POST['purchaseorderline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['purchaseorderline__warehouse_id']) || ($_POST['purchaseorderline__warehouse_id'] == "" || $_POST['purchaseorderline__warehouse_id'] == null  || $_POST['purchaseorderline__warehouse_id'] == 0))
$error .= "<span class='error'>Ship To Location must not be empty"."</span><br>";

if (isset($_POST['purchaseorderline__quantity']) && ($_POST['purchaseorderline__quantity'] == "" || $_POST['purchaseorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchaseorderline__uom_id']) || ($_POST['purchaseorderline__uom_id'] == "" || $_POST['purchaseorderline__uom_id'] == null  || $_POST['purchaseorderline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchaseorderline__price']) && ($_POST['purchaseorderline__price'] == "" || $_POST['purchaseorderline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseorderline__orderid']))
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
$data['price'] = $_POST['purchaseorderline__price'];
if (isset($_POST['purchaseorderline__hasppn']))
$data['hasppn'] = 1;
else
$data['hasppn'] = 0;if (isset($_POST['purchaseorderline__pph']))
$data['pph'] = $_POST['purchaseorderline__pph'];if (isset($_POST['purchaseorderline__subtotal']))
$data['subtotal'] = $_POST['purchaseorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_order_line_id']);
$this->db->update('purchaseorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_order_lineedit','purchaseorderline','afteredit', $_POST['purchase_order_line_id']);
			
			
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