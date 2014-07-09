<?php

class credit_note_outview extends Controller {

	function credit_note_outview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($credit_note_out_id=0)
	{
		if ($credit_note_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $credit_note_out_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(expirydate, "%d-%m-%Y") as expirydate', false);
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0) {
$data = array();
$data['credit_note_out_id'] = $credit_note_out_id;
foreach ($q->result() as $r) {
$data['creditnoteout__creditnoteoutid'] = $r->creditnoteoutid;
$data['creditnoteout__date'] = $r->date;
$data['creditnoteout__expirydate'] = $r->expirydate;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['creditnoteout__customer_id'] = $r->customer_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['creditnoteout__coa_id'] = $r->coa_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['creditnoteout__currency_id'] = $r->currency_id;
$data['creditnoteout__amount'] = $r->amount;
$data['creditnoteout__amountused'] = $r->amountused;
$data['creditnoteout__notes'] = $r->notes;
$data['creditnoteout__usedflag'] = $r->usedflag;
$data['creditnoteout__lastupdate'] = $r->lastupdate;
$data['creditnoteout__updatedby'] = $r->updatedby;
$data['creditnoteout__created'] = $r->created;
$data['creditnoteout__createdby'] = $r->createdby;}
$this->load->view('credit_note_out_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['creditnoteoutid'] = $_POST['creditnoteout__creditnoteoutid'];
$data['date'] = $_POST['creditnoteout__date'];
$data['expirydate'] = $_POST['creditnoteout__expirydate'];
$data['customer_id'] = $_POST['creditnoteout__customer_id'];
$data['coa_id'] = $_POST['creditnoteout__coa_id'];
$data['currency_id'] = $_POST['creditnoteout__currency_id'];
$data['amount'] = $_POST['creditnoteout__amount'];
$data['amountused'] = $_POST['creditnoteout__amountused'];
$data['notes'] = $_POST['creditnoteout__notes'];
$data['usedflag'] = $_POST['creditnoteout__usedflag'];
$data['lastupdate'] = $_POST['creditnoteout__lastupdate'];
$data['updatedby'] = $_POST['creditnoteout__updatedby'];
$data['created'] = $_POST['creditnoteout__created'];
$data['createdby'] = $_POST['creditnoteout__createdby'];
$this->db->where('id', $data['credit_note_out_id']);
$this->db->update('creditnoteout', $data);
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