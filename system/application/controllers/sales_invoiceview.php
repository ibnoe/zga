<?php

class sales_invoiceview extends Controller {

	function sales_invoiceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_invoice_id=0)
	{
		if ($sales_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_invoice_id'] = $sales_invoice_id;
foreach ($q->result() as $r) {
$data['salesinvoice__date'] = $r->date;
$data['salesinvoice__orderid'] = $r->orderid;
$data['salesinvoice__donum'] = $r->donum;
$deliveryorder_opt = array();
$q = $this->db->get('deliveryorder');
foreach ($q->result() as $row) { $deliveryorder_opt[$row->id] = $row->orderid; }
$data['deliveryorder_opt'] = $deliveryorder_opt;
$data['salesinvoice__deliveryorder_id'] = $r->deliveryorder_id;
$data['salesinvoice__total'] = $r->total;
$data['salesinvoice__top'] = $r->top;
$data['salesinvoice__lastupdate'] = $r->lastupdate;
$data['salesinvoice__updatedby'] = $r->updatedby;
$data['salesinvoice__created'] = $r->created;
$data['salesinvoice__createdby'] = $r->createdby;}
$this->load->view('sales_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salesinvoice__date'];
$data['orderid'] = $_POST['salesinvoice__orderid'];
$data['donum'] = $_POST['salesinvoice__donum'];
$data['deliveryorder_id'] = $_POST['salesinvoice__deliveryorder_id'];
$data['total'] = $_POST['salesinvoice__total'];
$data['top'] = $_POST['salesinvoice__top'];
$data['lastupdate'] = $_POST['salesinvoice__lastupdate'];
$data['updatedby'] = $_POST['salesinvoice__updatedby'];
$data['created'] = $_POST['salesinvoice__created'];
$data['createdby'] = $_POST['salesinvoice__createdby'];
$this->db->where('id', $data['sales_invoice_id']);
$this->db->update('salesinvoice', $data);
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