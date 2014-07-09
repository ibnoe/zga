<?php

class purchase_return_delivery_for_invoiceadd extends Controller {

	function purchase_return_delivery_for_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturndelivery__date'] = '';
$data['purchasereturndelivery__purchasereturndeliveryid'] = '';$this->load->library('generallib');
$data['purchasereturndelivery__purchasereturndeliveryid'] = $this->generallib->genId('Purchase Return Delivery For Invoice');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturndelivery__supplier_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchasereturndelivery__warehouse_id'] = '';
$data['purchasereturndelivery__notes'] = '';
$data['purchasereturndelivery__lastupdate'] = '';
$data['purchasereturndelivery__updatedby'] = '';
$data['purchasereturndelivery__created'] = '';
$data['purchasereturndelivery__createdby'] = '';
		

		$this->load->view('purchase_return_delivery_for_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturndelivery__date']) && ($_POST['purchasereturndelivery__date'] == "" || $_POST['purchasereturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturndelivery__purchasereturndeliveryid']) && ($_POST['purchasereturndelivery__purchasereturndeliveryid'] == "" || $_POST['purchasereturndelivery__purchasereturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__supplier_id']) || ($_POST['purchasereturndelivery__supplier_id'] == "" || $_POST['purchasereturndelivery__supplier_id'] == null  || $_POST['purchasereturndelivery__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__warehouse_id']) || ($_POST['purchasereturndelivery__warehouse_id'] == "" || $_POST['purchasereturndelivery__warehouse_id'] == null  || $_POST['purchasereturndelivery__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturndelivery__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturndelivery__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturndelivery__purchasereturndeliveryid']))
$data['purchasereturndeliveryid'] = $_POST['purchasereturndelivery__purchasereturndeliveryid'];if (isset($_POST['purchasereturndelivery__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturndelivery__supplier_id'];if (isset($_POST['purchasereturndelivery__warehouse_id']))
$data['warehouse_id'] = $_POST['purchasereturndelivery__warehouse_id'];if (isset($_POST['purchasereturndelivery__notes']))
$data['notes'] = $_POST['purchasereturndelivery__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturndelivery', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturndelivery_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_delivery_for_invoiceadd','purchasereturndelivery','aftersave', $purchasereturndelivery_id);
			
		
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