<?php

class sales_return_orderview extends Controller {

	function sales_return_orderview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_order_id=0)
	{
		if ($sales_return_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_return_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturnorder');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_order_id'] = $sales_return_order_id;
foreach ($q->result() as $r) {
$data['salesreturnorder__date'] = $r->date;
$data['salesreturnorder__salesreturnorderid'] = $r->salesreturnorderid;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnorder__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnorder__currency_id'] = $r->currency_id;
$data['salesreturnorder__currencyrate'] = $r->currencyrate;
$data['salesreturnorder__notes'] = $r->notes;
$data['salesreturnorder__lastupdate'] = $r->lastupdate;
$data['salesreturnorder__updatedby'] = $r->updatedby;
$data['salesreturnorder__created'] = $r->created;
$data['salesreturnorder__createdby'] = $r->createdby;}
$this->load->view('sales_return_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['salesreturnorder__date'];
$data['salesreturnorderid'] = $_POST['salesreturnorder__salesreturnorderid'];
$data['customer_id'] = $_POST['salesreturnorder__customer_id'];
$data['currency_id'] = $_POST['salesreturnorder__currency_id'];
$data['currencyrate'] = $_POST['salesreturnorder__currencyrate'];
$data['notes'] = $_POST['salesreturnorder__notes'];
$data['lastupdate'] = $_POST['salesreturnorder__lastupdate'];
$data['updatedby'] = $_POST['salesreturnorder__updatedby'];
$data['created'] = $_POST['salesreturnorder__created'];
$data['createdby'] = $_POST['salesreturnorder__createdby'];
$this->db->where('id', $data['sales_return_order_id']);
$this->db->update('salesreturnorder', $data);
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