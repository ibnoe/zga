<?php

class penawaranview extends Controller {

	function penawaranview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penawaran_id=0)
	{
		if ($penawaran_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $penawaran_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0) {
$data = array();
$data['penawaran_id'] = $penawaran_id;
foreach ($q->result() as $r) {
$data['salesorderquote__nopenawaran'] = $r->nopenawaran;
$data['salesorderquote__customerponumber'] = $r->customerponumber;
$data['salesorderquote__date'] = $r->date;
$data['salesorderquote__notes'] = $r->notes;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesorderquote__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesorderquote__currency_id'] = $r->currency_id;
$data['salesorderquote__currencyrate'] = $r->currencyrate;
$marketingofficer_opt = array();
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['salesorderquote__marketingofficer_id'] = $r->marketingofficer_id;
$data['salesorderquote__status'] = $r->status;
$data['salesorderquote__orderid'] = $r->orderid;
$data['salesorderquote__lastupdate'] = $r->lastupdate;
$data['salesorderquote__updatedby'] = $r->updatedby;
$data['salesorderquote__created'] = $r->created;
$data['salesorderquote__createdby'] = $r->createdby;}
$this->load->view('penawaran_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['nopenawaran'] = $_POST['salesorderquote__nopenawaran'];
$data['customerponumber'] = $_POST['salesorderquote__customerponumber'];
$data['date'] = $_POST['salesorderquote__date'];
$data['notes'] = $_POST['salesorderquote__notes'];
$data['customer_id'] = $_POST['salesorderquote__customer_id'];
$data['currency_id'] = $_POST['salesorderquote__currency_id'];
$data['currencyrate'] = $_POST['salesorderquote__currencyrate'];
$data['marketingofficer_id'] = $_POST['salesorderquote__marketingofficer_id'];
$data['status'] = $_POST['salesorderquote__status'];
$data['orderid'] = $_POST['salesorderquote__orderid'];
$data['lastupdate'] = $_POST['salesorderquote__lastupdate'];
$data['updatedby'] = $_POST['salesorderquote__updatedby'];
$data['created'] = $_POST['salesorderquote__created'];
$data['createdby'] = $_POST['salesorderquote__createdby'];
$this->db->where('id', $data['penawaran_id']);
$this->db->update('salesorderquote', $data);
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