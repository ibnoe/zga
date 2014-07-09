<?php

class purchase_return_delivery_for_invoiceview extends Controller {

	function purchase_return_delivery_for_invoiceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_delivery_for_invoice_id=0)
	{
		if ($purchase_return_delivery_for_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_delivery_for_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturndelivery');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_delivery_for_invoice_id'] = $purchase_return_delivery_for_invoice_id;
foreach ($q->result() as $r) {
$data['purchasereturndelivery__date'] = $r->date;
$data['purchasereturndelivery__purchasereturndeliveryid'] = $r->purchasereturndeliveryid;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturndelivery__supplier_id'] = $r->supplier_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchasereturndelivery__warehouse_id'] = $r->warehouse_id;
$data['purchasereturndelivery__notes'] = $r->notes;
$data['purchasereturndelivery__lastupdate'] = $r->lastupdate;
$data['purchasereturndelivery__updatedby'] = $r->updatedby;
$data['purchasereturndelivery__created'] = $r->created;
$data['purchasereturndelivery__createdby'] = $r->createdby;}
$this->load->view('purchase_return_delivery_for_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchasereturndelivery__date'];
$data['purchasereturndeliveryid'] = $_POST['purchasereturndelivery__purchasereturndeliveryid'];
$data['supplier_id'] = $_POST['purchasereturndelivery__supplier_id'];
$data['warehouse_id'] = $_POST['purchasereturndelivery__warehouse_id'];
$data['notes'] = $_POST['purchasereturndelivery__notes'];
$data['lastupdate'] = $_POST['purchasereturndelivery__lastupdate'];
$data['updatedby'] = $_POST['purchasereturndelivery__updatedby'];
$data['created'] = $_POST['purchasereturndelivery__created'];
$data['createdby'] = $_POST['purchasereturndelivery__createdby'];
$this->db->where('id', $data['purchase_return_delivery_for_invoice_id']);
$this->db->update('purchasereturndelivery', $data);
			validationonserver();
			
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