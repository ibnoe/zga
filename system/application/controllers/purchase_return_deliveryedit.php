<?php

class purchase_return_deliveryedit extends Controller {

	function purchase_return_deliveryedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_delivery_id=0)
	{
		if ($purchase_return_delivery_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_delivery_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturndelivery');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_delivery_id'] = $purchase_return_delivery_id;
foreach ($q->result() as $r) {
$data['purchasereturndelivery__date'] = $r->date;
$data['purchasereturndelivery__purchasereturndeliveryid'] = $r->purchasereturndeliveryid;
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturndelivery__supplier_id'] = $r->supplier_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchasereturndelivery__warehouse_id'] = $r->warehouse_id;
$data['purchasereturndelivery__notes'] = $r->notes;
$data['purchasereturndelivery__lastupdate'] = $r->lastupdate;
$data['purchasereturndelivery__updatedby'] = $r->updatedby;
$data['purchasereturndelivery__created'] = $r->created;
$data['purchasereturndelivery__createdby'] = $r->createdby;}
$this->load->view('purchase_return_delivery_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchasereturndelivery__date']) && ($_POST['purchasereturndelivery__date'] == "" || $_POST['purchasereturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturndelivery__purchasereturndeliveryid']) && ($_POST['purchasereturndelivery__purchasereturndeliveryid'] == "" || $_POST['purchasereturndelivery__purchasereturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__supplier_id']) || ($_POST['purchasereturndelivery__supplier_id'] == "" || $_POST['purchasereturndelivery__supplier_id'] == null  || $_POST['purchasereturndelivery__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__warehouse_id']) || ($_POST['purchasereturndelivery__warehouse_id'] == "" || $_POST['purchasereturndelivery__warehouse_id'] == null  || $_POST['purchasereturndelivery__warehouse_id'] == 0))
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
$this->db->where('id', $_POST['purchase_return_delivery_id']);
$this->db->update('purchasereturndelivery', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_deliveryedit','purchasereturndelivery','afteredit', $_POST['purchase_return_delivery_id']);
			
			
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