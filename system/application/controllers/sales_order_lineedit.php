<?php

class sales_order_lineedit extends Controller {

	function sales_order_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_order_line_id=0)
	{
		if ($sales_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_order_line_id);
$this->db->select('*');
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_order_line_id'] = $sales_order_line_id;
foreach ($q->result() as $r) {
$data['salesorderline__orderid'] = $r->orderid;
$data['salesorderline__date'] = $r->date;
$data['salesorderline__notes'] = $r->notes;
$data['salesorderline__customer_id'] = $r->customer_id;
$data['salesorderline__currency_id'] = $r->currency_id;
$data['salesorderline__currencyrate'] = $r->currencyrate;
$data['salesorderline__warehouse_id'] = $r->warehouse_id;
$data['salesorderline__status'] = $r->status;
$data['salesorderline__type'] = $r->type;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderline__item_id'] = $r->item_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesorderline__warehouse_id'] = $r->warehouse_id;
$rcn_opt = array();
$rcn_opt[''] = 'None';
$q = $this->db->get('rcn');
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['salesorderline__rcn_id'] = $r->rcn_id;
$data['salesorderline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderline__uom_id'] = $r->uom_id;
$data['salesorderline__price'] = $r->price;
$data['salesorderline__pdisc'] = $r->pdisc;
$data['salesorderline__hasppn'] = $r->hasppn;
$data['salesorderline__pph'] = $r->pph;
$data['salesorderline__subtotal'] = $r->subtotal;
$data['salesorderline__modulename'] = $r->modulename;
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('sales_order_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['salesorderline__item_id']) || ($_POST['salesorderline__item_id'] == "" || $_POST['salesorderline__item_id'] == null  || $_POST['salesorderline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['salesorderline__warehouse_id']) || ($_POST['salesorderline__warehouse_id'] == "" || $_POST['salesorderline__warehouse_id'] == null  || $_POST['salesorderline__warehouse_id'] == 0))
$error .= "<span class='error'>Ship From Location must not be empty"."</span><br>";

if ($_POST['salesorderline__type'] == "Service")
if (!isset($_POST['salesorderline__rcn_id']) || ($_POST['salesorderline__rcn_id'] == "" || $_POST['salesorderline__rcn_id'] == null  || $_POST['salesorderline__rcn_id'] == 0))
$error .= "<span class='error'>RCN must not be empty"."</span><br>";

if (isset($_POST['salesorderline__quantity']) && ($_POST['salesorderline__quantity'] == "" || $_POST['salesorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesorderline__uom_id']) || ($_POST['salesorderline__uom_id'] == "" || $_POST['salesorderline__uom_id'] == null  || $_POST['salesorderline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesorderline__price']) && ($_POST['salesorderline__price'] == "" || $_POST['salesorderline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorderline__orderid']))
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
$data['pdisc'] = $_POST['salesorderline__pdisc'];
if (isset($_POST['salesorderline__hasppn']))
$data['hasppn'] = 1;
else
$data['hasppn'] = 0;if (isset($_POST['salesorderline__pph']))
$data['pph'] = $_POST['salesorderline__pph'];if (isset($_POST['salesorderline__subtotal']))
$data['subtotal'] = $_POST['salesorderline__subtotal'];if (isset($_POST['salesorderline__modulename']))
$data['modulename'] = $_POST['salesorderline__modulename'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_order_line_id']);
$this->db->update('salesorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_order_lineedit','salesorderline','afteredit', $_POST['sales_order_line_id']);
			
			
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