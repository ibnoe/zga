<?php

class sales_return_invoice_lineadd extends Controller {

	function sales_return_invoice_lineadd()
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
$data['salesreturninvoiceline__item_id'] = '';
$data['salesreturninvoiceline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturninvoiceline__uom_id'] = '';
$data['salesreturninvoiceline__price'] = '';
$salesreturnorderline_opt = array();
$salesreturnorderline_opt[''] = 'None';
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesreturnorderline_opt[$row->id] = $row->salesreturnorderid; }
$data['salesreturnorderline_opt'] = $salesreturnorderline_opt;
$data['salesreturninvoiceline__salesreturnorderline_id'] = '';
$data['salesreturninvoiceline__subtotal'] = '';
$data['salesreturninvoiceline__lastupdate'] = '';
$data['salesreturninvoiceline__updatedby'] = '';
$data['salesreturninvoiceline__created'] = '';
$data['salesreturninvoiceline__createdby'] = '';
		

		$this->load->view('sales_return_invoice_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesreturninvoiceline__item_id']) || ($_POST['salesreturninvoiceline__item_id'] == "" || $_POST['salesreturninvoiceline__item_id'] == null  || $_POST['salesreturninvoiceline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesreturninvoiceline__quantity']) && ($_POST['salesreturninvoiceline__quantity'] == "" || $_POST['salesreturninvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesreturninvoiceline__uom_id']) || ($_POST['salesreturninvoiceline__uom_id'] == "" || $_POST['salesreturninvoiceline__uom_id'] == null  || $_POST['salesreturninvoiceline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesreturninvoiceline__price']) && ($_POST['salesreturninvoiceline__price'] == "" || $_POST['salesreturninvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturninvoiceline__item_id']))
$data['item_id'] = $_POST['salesreturninvoiceline__item_id'];if (isset($_POST['salesreturninvoiceline__quantity']))
$data['quantity'] = $_POST['salesreturninvoiceline__quantity'];if (isset($_POST['salesreturninvoiceline__uom_id']))
$data['uom_id'] = $_POST['salesreturninvoiceline__uom_id'];if (isset($_POST['salesreturninvoiceline__price']))
$data['price'] = $_POST['salesreturninvoiceline__price'];if (isset($_POST['salesreturninvoiceline__salesreturnorderline_id']))
$data['salesreturnorderline_id'] = $_POST['salesreturninvoiceline__salesreturnorderline_id'];if (isset($_POST['salesreturninvoiceline__subtotal']))
$data['subtotal'] = $_POST['salesreturninvoiceline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesreturninvoiceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturninvoiceline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_invoice_lineadd','salesreturninvoiceline','aftersave', $salesreturninvoiceline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('salesreturninvoiceline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_invoice_lineadd','salesreturninvoiceline','validation', 0, $valdata);
		
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