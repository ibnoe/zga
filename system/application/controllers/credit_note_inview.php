<?php

class credit_note_inview extends Controller {

	function credit_note_inview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($credit_note_in_id=0)
	{
		if ($credit_note_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $credit_note_in_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(expirydate, "%d-%m-%Y") as expirydate', false);
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0) {
$data = array();
$data['credit_note_in_id'] = $credit_note_in_id;
foreach ($q->result() as $r) {
$data['creditnotein__creditnoteinid'] = $r->creditnoteinid;
$data['creditnotein__date'] = $r->date;
$data['creditnotein__expirydate'] = $r->expirydate;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['creditnotein__supplier_id'] = $r->supplier_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['creditnotein__coa_id'] = $r->coa_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['creditnotein__currency_id'] = $r->currency_id;
$data['creditnotein__amount'] = $r->amount;
$data['creditnotein__amountused'] = $r->amountused;
$data['creditnotein__notes'] = $r->notes;
$data['creditnotein__usedflag'] = $r->usedflag;
$data['creditnotein__lastupdate'] = $r->lastupdate;
$data['creditnotein__updatedby'] = $r->updatedby;
$data['creditnotein__created'] = $r->created;
$data['creditnotein__createdby'] = $r->createdby;}
$this->load->view('credit_note_in_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['creditnoteinid'] = $_POST['creditnotein__creditnoteinid'];
$data['date'] = $_POST['creditnotein__date'];
$data['expirydate'] = $_POST['creditnotein__expirydate'];
$data['supplier_id'] = $_POST['creditnotein__supplier_id'];
$data['coa_id'] = $_POST['creditnotein__coa_id'];
$data['currency_id'] = $_POST['creditnotein__currency_id'];
$data['amount'] = $_POST['creditnotein__amount'];
$data['amountused'] = $_POST['creditnotein__amountused'];
$data['notes'] = $_POST['creditnotein__notes'];
$data['usedflag'] = $_POST['creditnotein__usedflag'];
$data['lastupdate'] = $_POST['creditnotein__lastupdate'];
$data['updatedby'] = $_POST['creditnotein__updatedby'];
$data['created'] = $_POST['creditnotein__created'];
$data['createdby'] = $_POST['creditnotein__createdby'];
$this->db->where('id', $data['credit_note_in_id']);
$this->db->update('creditnotein', $data);
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