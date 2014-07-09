<?php

class sales_return_delivery_for_invoiceedit extends Controller {

	function sales_return_delivery_for_invoiceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_delivery_for_invoice_id=0)
	{
		if ($sales_return_delivery_for_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_delivery_for_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturndelivery');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_delivery_for_invoice_id'] = $sales_return_delivery_for_invoice_id;
foreach ($q->result() as $r) {
$data['salesreturndelivery__date'] = $r->date;
$data['salesreturndelivery__salesreturndeliveryid'] = $r->salesreturndeliveryid;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturndelivery__customer_id'] = $r->customer_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesreturndelivery__warehouse_id'] = $r->warehouse_id;
$data['salesreturndelivery__notes'] = $r->notes;
$data['salesreturndelivery__lastupdate'] = $r->lastupdate;
$data['salesreturndelivery__updatedby'] = $r->updatedby;
$data['salesreturndelivery__created'] = $r->created;
$data['salesreturndelivery__createdby'] = $r->createdby;}
$this->load->view('sales_return_delivery_for_invoice_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesreturndelivery__date']) && ($_POST['salesreturndelivery__date'] == "" || $_POST['salesreturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturndelivery__salesreturndeliveryid']) && ($_POST['salesreturndelivery__salesreturndeliveryid'] == "" || $_POST['salesreturndelivery__salesreturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__customer_id']) || ($_POST['salesreturndelivery__customer_id'] == "" || $_POST['salesreturndelivery__customer_id'] == null  || $_POST['salesreturndelivery__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__warehouse_id']) || ($_POST['salesreturndelivery__warehouse_id'] == "" || $_POST['salesreturndelivery__warehouse_id'] == null  || $_POST['salesreturndelivery__warehouse_id'] == 0))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturndelivery__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturndelivery__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturndelivery__salesreturndeliveryid']))
$data['salesreturndeliveryid'] = $_POST['salesreturndelivery__salesreturndeliveryid'];if (isset($_POST['salesreturndelivery__customer_id']))
$data['customer_id'] = $_POST['salesreturndelivery__customer_id'];if (isset($_POST['salesreturndelivery__warehouse_id']))
$data['warehouse_id'] = $_POST['salesreturndelivery__warehouse_id'];if (isset($_POST['salesreturndelivery__notes']))
$data['notes'] = $_POST['salesreturndelivery__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_delivery_for_invoice_id']);
$this->db->update('salesreturndelivery', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_delivery_for_invoiceedit','salesreturndelivery','afteredit', $_POST['sales_return_delivery_for_invoice_id']);
			
			
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