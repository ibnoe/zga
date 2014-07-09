<?php

class purchase_return_invoice_lineadd extends Controller {

	function purchase_return_invoice_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturninvoiceline__item_id'] = '';
$data['purchasereturninvoiceline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturninvoiceline__uom_id'] = '';
$data['purchasereturninvoiceline__price'] = '';
$purchasereturnorderline_opt = array();
$purchasereturnorderline_opt[''] = 'None';
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturnorderline_opt[$row->id] = $row->purchasereturnorderid; }
$data['purchasereturnorderline_opt'] = $purchasereturnorderline_opt;
$data['purchasereturninvoiceline__purchasereturnorderline_id'] = '';
$data['purchasereturninvoiceline__subtotal'] = '';
$data['purchasereturninvoiceline__lastupdate'] = '';
$data['purchasereturninvoiceline__updatedby'] = '';
$data['purchasereturninvoiceline__created'] = '';
$data['purchasereturninvoiceline__createdby'] = '';
		

		$this->load->view('purchase_return_invoice_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['purchasereturninvoiceline__item_id']) || ($_POST['purchasereturninvoiceline__item_id'] == "" || $_POST['purchasereturninvoiceline__item_id'] == null  || $_POST['purchasereturninvoiceline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoiceline__quantity']) && ($_POST['purchasereturninvoiceline__quantity'] == "" || $_POST['purchasereturninvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchasereturninvoiceline__uom_id']) || ($_POST['purchasereturninvoiceline__uom_id'] == "" || $_POST['purchasereturninvoiceline__uom_id'] == null  || $_POST['purchasereturninvoiceline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoiceline__price']) && ($_POST['purchasereturninvoiceline__price'] == "" || $_POST['purchasereturninvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturninvoiceline__item_id']))
$data['item_id'] = $_POST['purchasereturninvoiceline__item_id'];if (isset($_POST['purchasereturninvoiceline__quantity']))
$data['quantity'] = $_POST['purchasereturninvoiceline__quantity'];if (isset($_POST['purchasereturninvoiceline__uom_id']))
$data['uom_id'] = $_POST['purchasereturninvoiceline__uom_id'];if (isset($_POST['purchasereturninvoiceline__price']))
$data['price'] = $_POST['purchasereturninvoiceline__price'];if (isset($_POST['purchasereturninvoiceline__purchasereturnorderline_id']))
$data['purchasereturnorderline_id'] = $_POST['purchasereturninvoiceline__purchasereturnorderline_id'];if (isset($_POST['purchasereturninvoiceline__subtotal']))
$data['subtotal'] = $_POST['purchasereturninvoiceline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturninvoiceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturninvoiceline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_invoice_lineadd','purchasereturninvoiceline','aftersave', $purchasereturninvoiceline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('purchasereturninvoiceline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_invoice_lineadd','purchasereturninvoiceline','validation', 0, $valdata);
		
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