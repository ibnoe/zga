<?php

class sales_return_delivery_for_invoiceadd extends Controller {

	function sales_return_delivery_for_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturndelivery__date'] = '';
$data['salesreturndelivery__salesreturndeliveryid'] = '';$this->load->library('generallib');
$data['salesreturndelivery__salesreturndeliveryid'] = $this->generallib->genId('Sales Return Delivery For Invoice');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturndelivery__customer_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesreturndelivery__warehouse_id'] = '';
$data['salesreturndelivery__notes'] = '';
$data['salesreturndelivery__lastupdate'] = '';
$data['salesreturndelivery__updatedby'] = '';
$data['salesreturndelivery__created'] = '';
$data['salesreturndelivery__createdby'] = '';
		

		$this->load->view('sales_return_delivery_for_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesreturndelivery__date']) && ($_POST['salesreturndelivery__date'] == "" || $_POST['salesreturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturndelivery__salesreturndeliveryid']) && ($_POST['salesreturndelivery__salesreturndeliveryid'] == "" || $_POST['salesreturndelivery__salesreturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__customer_id']) || ($_POST['salesreturndelivery__customer_id'] == "" || $_POST['salesreturndelivery__customer_id'] == null  || $_POST['salesreturndelivery__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__warehouse_id']) || ($_POST['salesreturndelivery__warehouse_id'] == "" || $_POST['salesreturndelivery__warehouse_id'] == null  || $_POST['salesreturndelivery__warehouse_id'] == null))
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
$this->db->insert('salesreturndelivery', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturndelivery_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_delivery_for_invoiceadd','salesreturndelivery','aftersave', $salesreturndelivery_id);
			
		
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