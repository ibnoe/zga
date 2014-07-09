<?php

class purchase_invoice_lineedit extends Controller {

	function purchase_invoice_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_invoice_line_id=0)
	{
		if ($purchase_invoice_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_invoice_line_id);
$q = $this->db->get('purchaseinvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_invoice_line_id'] = $purchase_invoice_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseinvoiceline__item_id'] = $r->item_id;
$data['purchaseinvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseinvoiceline__uom_id'] = $r->uom_id;
$data['purchaseinvoiceline__price'] = $r->price;
$data['purchaseinvoiceline__subtotal'] = $r->subtotal;
$data['purchaseinvoiceline__purchaseorderline_id'] = $r->purchaseorderline_id;
$data['purchaseinvoiceline__lastupdate'] = $r->lastupdate;
$data['purchaseinvoiceline__updatedby'] = $r->updatedby;
$data['purchaseinvoiceline__created'] = $r->created;
$data['purchaseinvoiceline__createdby'] = $r->createdby;}
$this->load->view('purchase_invoice_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['purchaseinvoiceline__item_id']) || ($_POST['purchaseinvoiceline__item_id'] == "" || $_POST['purchaseinvoiceline__item_id'] == null  || $_POST['purchaseinvoiceline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoiceline__quantity']) && ($_POST['purchaseinvoiceline__quantity'] == "" || $_POST['purchaseinvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchaseinvoiceline__uom_id']) || ($_POST['purchaseinvoiceline__uom_id'] == "" || $_POST['purchaseinvoiceline__uom_id'] == null  || $_POST['purchaseinvoiceline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoiceline__price']) && ($_POST['purchaseinvoiceline__price'] == "" || $_POST['purchaseinvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseinvoiceline__item_id']))
$data['item_id'] = $_POST['purchaseinvoiceline__item_id'];if (isset($_POST['purchaseinvoiceline__quantity']))
$data['quantity'] = $_POST['purchaseinvoiceline__quantity'];if (isset($_POST['purchaseinvoiceline__uom_id']))
$data['uom_id'] = $_POST['purchaseinvoiceline__uom_id'];if (isset($_POST['purchaseinvoiceline__price']))
$data['price'] = $_POST['purchaseinvoiceline__price'];if (isset($_POST['purchaseinvoiceline__subtotal']))
$data['subtotal'] = $_POST['purchaseinvoiceline__subtotal'];if (isset($_POST['purchaseinvoiceline__purchaseorderline_id']))
$data['purchaseorderline_id'] = $_POST['purchaseinvoiceline__purchaseorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_invoice_line_id']);
$this->db->update('purchaseinvoiceline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_invoice_lineedit','purchaseinvoiceline','afteredit', $_POST['purchase_invoice_line_id']);
			
			
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