<?php

class sales_return_invoiceview extends Controller {

	function sales_return_invoiceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_invoice_id=0)
	{
		if ($sales_return_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_return_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_invoice_id'] = $sales_return_invoice_id;
foreach ($q->result() as $r) {
$data['salesreturninvoice__date'] = $r->date;
$data['salesreturninvoice__salesreturninvoiceid'] = $r->salesreturninvoiceid;
$salesreturndelivery_opt = array();
$q = $this->db->get('salesreturndelivery');
foreach ($q->result() as $row) { $salesreturndelivery_opt[$row->id] = $row->salesreturndeliveryid; }
$data['salesreturndelivery_opt'] = $salesreturndelivery_opt;
$data['salesreturninvoice__salesreturndelivery_id'] = $r->salesreturndelivery_id;
$data['salesreturninvoice__total'] = $r->total;
$data['salesreturninvoice__lastupdate'] = $r->lastupdate;
$data['salesreturninvoice__updatedby'] = $r->updatedby;
$data['salesreturninvoice__created'] = $r->created;
$data['salesreturninvoice__createdby'] = $r->createdby;}
$this->load->view('sales_return_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salesreturninvoice__date'];
$data['salesreturninvoiceid'] = $_POST['salesreturninvoice__salesreturninvoiceid'];
$data['salesreturndelivery_id'] = $_POST['salesreturninvoice__salesreturndelivery_id'];
$data['total'] = $_POST['salesreturninvoice__total'];
$data['lastupdate'] = $_POST['salesreturninvoice__lastupdate'];
$data['updatedby'] = $_POST['salesreturninvoice__updatedby'];
$data['created'] = $_POST['salesreturninvoice__created'];
$data['createdby'] = $_POST['salesreturninvoice__createdby'];
$this->db->where('id', $data['sales_return_invoice_id']);
$this->db->update('salesreturninvoice', $data);
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