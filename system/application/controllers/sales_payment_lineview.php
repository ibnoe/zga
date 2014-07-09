<?php

class sales_payment_lineview extends Controller {

	function sales_payment_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_payment_line_id=0)
	{
		if ($sales_payment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_payment_line_id);
$this->db->select('*');
$q = $this->db->get('salespaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_payment_line_id'] = $sales_payment_line_id;
foreach ($q->result() as $r) {
$salesinvoice_opt = array();
$q = $this->db->get('salesinvoice');
foreach ($q->result() as $row) { $salesinvoice_opt[$row->id] = $row->orderid; }
$data['salesinvoice_opt'] = $salesinvoice_opt;
$data['salespaymentline__salesinvoice_id'] = $r->salesinvoice_id;
$data['salespaymentline__lastupdate'] = $r->lastupdate;
$data['salespaymentline__updatedby'] = $r->updatedby;
$data['salespaymentline__created'] = $r->created;
$data['salespaymentline__createdby'] = $r->createdby;}
$this->load->view('sales_payment_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['salesinvoice_id'] = $_POST['salespaymentline__salesinvoice_id'];
$data['lastupdate'] = $_POST['salespaymentline__lastupdate'];
$data['updatedby'] = $_POST['salespaymentline__updatedby'];
$data['created'] = $_POST['salespaymentline__created'];
$data['createdby'] = $_POST['salespaymentline__createdby'];
$this->db->where('id', $data['sales_payment_line_id']);
$this->db->update('salespaymentline', $data);
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