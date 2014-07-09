<?php

class sales_order_open_sentview extends Controller {

	function sales_order_open_sentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_order_open_sent_id=0)
	{
		if ($sales_order_open_sent_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_order_open_sent_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesorder');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_order_open_sent_id'] = $sales_order_open_sent_id;
foreach ($q->result() as $r) {
$data['salesorder__orderid'] = $r->orderid;
$data['salesorder__date'] = $r->date;
$data['salesorder__nopenawaran'] = $r->nopenawaran;
$data['salesorder__customerponumber'] = $r->customerponumber;
$marketingofficer_opt = array();
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['salesorder__marketingofficer_id'] = $r->marketingofficer_id;
$data['salesorder__notes'] = $r->notes;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesorder__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesorder__currency_id'] = $r->currency_id;
$data['salesorder__currencyrate'] = $r->currencyrate;
$data['salesorder__total'] = $r->total;
$data['salesorder__totaldiscount'] = $r->totaldiscount;
$data['salesorder__totaltax'] = $r->totaltax;
$data['salesorder__lastupdate'] = $r->lastupdate;
$data['salesorder__updatedby'] = $r->updatedby;}
$this->load->view('sales_order_open_sent_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['orderid'] = $_POST['salesorder__orderid'];
$data['date'] = $_POST['salesorder__date'];
$data['nopenawaran'] = $_POST['salesorder__nopenawaran'];
$data['customerponumber'] = $_POST['salesorder__customerponumber'];
$data['marketingofficer_id'] = $_POST['salesorder__marketingofficer_id'];
$data['notes'] = $_POST['salesorder__notes'];
$data['customer_id'] = $_POST['salesorder__customer_id'];
$data['currency_id'] = $_POST['salesorder__currency_id'];
$data['currencyrate'] = $_POST['salesorder__currencyrate'];
$data['total'] = $_POST['salesorder__total'];
$data['totaldiscount'] = $_POST['salesorder__totaldiscount'];
$data['totaltax'] = $_POST['salesorder__totaltax'];
$data['lastupdate'] = $_POST['salesorder__lastupdate'];
$data['updatedby'] = $_POST['salesorder__updatedby'];
$this->db->where('id', $data['sales_order_open_sent_id']);
$this->db->update('salesorder', $data);
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