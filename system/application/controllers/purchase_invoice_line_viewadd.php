<?php

class purchase_invoice_line_viewadd extends Controller {

	function purchase_invoice_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['purchaseinvoice_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseinvoiceline__item_id'] = '';
$data['purchaseinvoiceline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseinvoiceline__uom_id'] = '';
$data['purchaseinvoiceline__price'] = '';
$purchaseorderline_opt = array();
$purchaseorderline_opt[''] = 'None';
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchaseorderline_opt[$row->id] = $row->orderid; }
$data['purchaseorderline_opt'] = $purchaseorderline_opt;
$data['purchaseinvoiceline__purchaseorderline_id'] = '';
$data['purchaseinvoiceline__subtotal'] = '';
$data['purchaseinvoiceline__lastupdate'] = '';
$data['purchaseinvoiceline__updatedby'] = '';
$data['purchaseinvoiceline__created'] = '';
$data['purchaseinvoiceline__createdby'] = '';
		

		$this->load->view('purchase_invoice_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['purchaseinvoiceline__item_id']) || ($_POST['purchaseinvoiceline__item_id'] == "" || $_POST['purchaseinvoiceline__item_id'] == null  || $_POST['purchaseinvoiceline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoiceline__quantity']) && ($_POST['purchaseinvoiceline__quantity'] == "" || $_POST['purchaseinvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchaseinvoiceline__uom_id']) || ($_POST['purchaseinvoiceline__uom_id'] == "" || $_POST['purchaseinvoiceline__uom_id'] == null  || $_POST['purchaseinvoiceline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoiceline__price']) && ($_POST['purchaseinvoiceline__price'] == "" || $_POST['purchaseinvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['purchaseinvoice_id'] = $_POST['purchaseinvoice_id'];if (isset($_POST['purchaseinvoiceline__item_id']))
$data['item_id'] = $_POST['purchaseinvoiceline__item_id'];if (isset($_POST['purchaseinvoiceline__quantity']))
$data['quantity'] = $_POST['purchaseinvoiceline__quantity'];if (isset($_POST['purchaseinvoiceline__uom_id']))
$data['uom_id'] = $_POST['purchaseinvoiceline__uom_id'];if (isset($_POST['purchaseinvoiceline__price']))
$data['price'] = $_POST['purchaseinvoiceline__price'];if (isset($_POST['purchaseinvoiceline__purchaseorderline_id']))
$data['purchaseorderline_id'] = $_POST['purchaseinvoiceline__purchaseorderline_id'];if (isset($_POST['purchaseinvoiceline__subtotal']))
$data['subtotal'] = $_POST['purchaseinvoiceline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchaseinvoiceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseinvoiceline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_invoice_line_viewadd','purchaseinvoiceline','aftersave', $purchaseinvoiceline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('purchaseinvoiceline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_invoice_line_viewadd','purchaseinvoiceline','validation', 0, $valdata);
		
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