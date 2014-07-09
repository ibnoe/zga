<?php

class sales_return_delivery_for_invoiceview extends Controller {

	function sales_return_delivery_for_invoiceview()
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
	
		
$this->db->where('id', $sales_return_delivery_for_invoice_id);
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
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturndelivery__customer_id'] = $r->customer_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesreturndelivery__warehouse_id'] = $r->warehouse_id;
$data['salesreturndelivery__notes'] = $r->notes;
$data['salesreturndelivery__lastupdate'] = $r->lastupdate;
$data['salesreturndelivery__updatedby'] = $r->updatedby;
$data['salesreturndelivery__created'] = $r->created;
$data['salesreturndelivery__createdby'] = $r->createdby;}
$this->load->view('sales_return_delivery_for_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salesreturndelivery__date'];
$data['salesreturndeliveryid'] = $_POST['salesreturndelivery__salesreturndeliveryid'];
$data['customer_id'] = $_POST['salesreturndelivery__customer_id'];
$data['warehouse_id'] = $_POST['salesreturndelivery__warehouse_id'];
$data['notes'] = $_POST['salesreturndelivery__notes'];
$data['lastupdate'] = $_POST['salesreturndelivery__lastupdate'];
$data['updatedby'] = $_POST['salesreturndelivery__updatedby'];
$data['created'] = $_POST['salesreturndelivery__created'];
$data['createdby'] = $_POST['salesreturndelivery__createdby'];
$this->db->where('id', $data['sales_return_delivery_for_invoice_id']);
$this->db->update('salesreturndelivery', $data);
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