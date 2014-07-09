<?php

class sales_order_line_serviceadd extends Controller {

	function sales_order_line_serviceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['salesorder_id'] = $id;
$data['salesorderline__orderid'] = '';
$data['salesorderline__date'] = '';
$data['salesorderline__notes'] = '';
$data['salesorderline__customer_id'] = '';
$data['salesorderline__currency_id'] = '';
$data['salesorderline__currencyrate'] = '';
$data['salesorderline__warehouse_id'] = '';
$data['salesorderline__status'] = '';
$rcn_opt = array();
$q = $this->db->get('rcn');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['salesorderline__rcn_id'] = '';
$data['salesorderline__quantity'] = '';
$data['salesorderline__price'] = '';
$data['salesorderline__pdisc'] = '';
$data['salesorderline__modulename'] = '';
$data['salesorderline__subtotal'] = '';
$data['salesorderline__lastupdate'] = '';
$data['salesorderline__updatedby'] = '';
$data['salesorderline__created'] = '';
$data['salesorderline__createdby'] = '';
$salesorder = array();
$this->db->where('id', $id);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0)
$salesorder = $q->row_array();
$data['salesorderline__orderid'] = $salesorder['orderid'];
$data['salesorderline__date'] = $salesorder['date'];
$data['salesorderline__notes'] = $salesorder['notes'];
$data['salesorderline__customer_id'] = $salesorder['customer_id'];
$data['salesorderline__currency_id'] = $salesorder['currency_id'];
$data['salesorderline__currencyrate'] = $salesorder['currencyrate'];
$data['salesorderline__warehouse_id'] = $salesorder['warehouse_id'];
$data['salesorderline__lastupdate'] = $salesorder['lastupdate'];
$data['salesorderline__updatedby'] = $salesorder['updatedby'];
$data['salesorderline__created'] = $salesorder['created'];
$data['salesorderline__createdby'] = $salesorder['createdby'];
		

		$this->load->view('sales_order_line_service_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesorderline__quantity']) && ($_POST['salesorderline__quantity'] == "" || $_POST['salesorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (isset($_POST['salesorderline__price']) && ($_POST['salesorderline__price'] == "" || $_POST['salesorderline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_order_line_serviceadd','salesorderline','validation', 0, $_POST);
		
		if ($error == "")
		{
			
$data = array();
$data['salesorder_id'] = $_POST['salesorder_id'];if (isset($_POST['salesorderline__orderid']))
$data['orderid'] = $_POST['salesorderline__orderid'];if (isset($_POST['salesorderline__date']))
$data['date'] = $_POST['salesorderline__date'];if (isset($_POST['salesorderline__notes']))
$data['notes'] = $_POST['salesorderline__notes'];if (isset($_POST['salesorderline__customer_id']))
$data['customer_id'] = $_POST['salesorderline__customer_id'];if (isset($_POST['salesorderline__currency_id']))
$data['currency_id'] = $_POST['salesorderline__currency_id'];if (isset($_POST['salesorderline__currencyrate']))
$data['currencyrate'] = $_POST['salesorderline__currencyrate'];if (isset($_POST['salesorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['salesorderline__warehouse_id'];if (isset($_POST['salesorderline__status']))
$data['status'] = $_POST['salesorderline__status'];if (isset($_POST['salesorderline__rcn_id']))
$data['rcn_id'] = $_POST['salesorderline__rcn_id'];if (isset($_POST['salesorderline__quantity']))
$data['quantity'] = $_POST['salesorderline__quantity'];if (isset($_POST['salesorderline__price']))
$data['price'] = $_POST['salesorderline__price'];if (isset($_POST['salesorderline__pdisc']))
$data['pdisc'] = $_POST['salesorderline__pdisc'];if (isset($_POST['salesorderline__modulename']))
$data['modulename'] = $_POST['salesorderline__modulename'];if (isset($_POST['salesorderline__subtotal']))
$data['subtotal'] = $_POST['salesorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('sales_order_line_serviceadd','salesorderline','aftersave', $salesorderline_id);
	
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>