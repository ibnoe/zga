<?php

class sales_invoice_lineadd extends Controller {

	function sales_invoice_lineadd()
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
$data['salesinvoiceline__item_id'] = '';
$data['salesinvoiceline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesinvoiceline__uom_id'] = '';
$data['salesinvoiceline__price'] = '';
$salesorderline_opt = array();
$salesorderline_opt[''] = 'None';
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesorderline_opt[$row->id] = $row->orderid; }
$data['salesorderline_opt'] = $salesorderline_opt;
$data['salesinvoiceline__salesorderline_id'] = '';
$data['salesinvoiceline__subtotal'] = '';
$data['salesinvoiceline__lastupdate'] = '';
$data['salesinvoiceline__updatedby'] = '';
$data['salesinvoiceline__created'] = '';
$data['salesinvoiceline__createdby'] = '';
		

		$this->load->view('sales_invoice_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesinvoiceline__item_id']) || ($_POST['salesinvoiceline__item_id'] == "" || $_POST['salesinvoiceline__item_id'] == null  || $_POST['salesinvoiceline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesinvoiceline__quantity']) && ($_POST['salesinvoiceline__quantity'] == "" || $_POST['salesinvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesinvoiceline__uom_id']) || ($_POST['salesinvoiceline__uom_id'] == "" || $_POST['salesinvoiceline__uom_id'] == null  || $_POST['salesinvoiceline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesinvoiceline__price']) && ($_POST['salesinvoiceline__price'] == "" || $_POST['salesinvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesinvoiceline__item_id']))
$data['item_id'] = $_POST['salesinvoiceline__item_id'];if (isset($_POST['salesinvoiceline__quantity']))
$data['quantity'] = $_POST['salesinvoiceline__quantity'];if (isset($_POST['salesinvoiceline__uom_id']))
$data['uom_id'] = $_POST['salesinvoiceline__uom_id'];if (isset($_POST['salesinvoiceline__price']))
$data['price'] = $_POST['salesinvoiceline__price'];if (isset($_POST['salesinvoiceline__salesorderline_id']))
$data['salesorderline_id'] = $_POST['salesinvoiceline__salesorderline_id'];if (isset($_POST['salesinvoiceline__subtotal']))
$data['subtotal'] = $_POST['salesinvoiceline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesinvoiceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesinvoiceline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('sales_invoice_lineadd','salesinvoiceline','aftersave', $salesinvoiceline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('salesinvoiceline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_invoice_lineadd','salesinvoiceline','validation', 0, $valdata);
		
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