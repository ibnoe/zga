<?php

class sales_invoice_line_viewedit extends Controller {

	function sales_invoice_line_viewedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_invoice_line_view_id=0)
	{
		if ($sales_invoice_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_invoice_line_view_id);
$q = $this->db->get('salesinvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_invoice_line_view_id'] = $sales_invoice_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesinvoiceline__item_id'] = $r->item_id;
$data['salesinvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesinvoiceline__uom_id'] = $r->uom_id;
$data['salesinvoiceline__price'] = $r->price;
$data['salesinvoiceline__subtotal'] = $r->subtotal;
$data['salesinvoiceline__salesorderline_id'] = $r->salesorderline_id;
$data['salesinvoiceline__lastupdate'] = $r->lastupdate;
$data['salesinvoiceline__updatedby'] = $r->updatedby;
$data['salesinvoiceline__created'] = $r->created;
$data['salesinvoiceline__createdby'] = $r->createdby;}
$this->load->view('sales_invoice_line_view_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['salesinvoiceline__item_id']) || ($_POST['salesinvoiceline__item_id'] == "" || $_POST['salesinvoiceline__item_id'] == null  || $_POST['salesinvoiceline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesinvoiceline__quantity']) && ($_POST['salesinvoiceline__quantity'] == "" || $_POST['salesinvoiceline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesinvoiceline__uom_id']) || ($_POST['salesinvoiceline__uom_id'] == "" || $_POST['salesinvoiceline__uom_id'] == null  || $_POST['salesinvoiceline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesinvoiceline__price']) && ($_POST['salesinvoiceline__price'] == "" || $_POST['salesinvoiceline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesinvoiceline__item_id']))
$data['item_id'] = $_POST['salesinvoiceline__item_id'];if (isset($_POST['salesinvoiceline__quantity']))
$data['quantity'] = $_POST['salesinvoiceline__quantity'];if (isset($_POST['salesinvoiceline__uom_id']))
$data['uom_id'] = $_POST['salesinvoiceline__uom_id'];if (isset($_POST['salesinvoiceline__price']))
$data['price'] = $_POST['salesinvoiceline__price'];if (isset($_POST['salesinvoiceline__subtotal']))
$data['subtotal'] = $_POST['salesinvoiceline__subtotal'];if (isset($_POST['salesinvoiceline__salesorderline_id']))
$data['salesorderline_id'] = $_POST['salesinvoiceline__salesorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_invoice_line_view_id']);
$this->db->update('salesinvoiceline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_invoice_line_viewedit','salesinvoiceline','afteredit', $_POST['sales_invoice_line_view_id']);
			
			
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