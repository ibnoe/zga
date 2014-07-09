<?php

class bank_transfer_masukview extends Controller {

	function bank_transfer_masukview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bank_transfer_masuk_id=0)
	{
		if ($bank_transfer_masuk_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $bank_transfer_masuk_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('banktransfermasuk');
if ($q->num_rows() > 0) {
$data = array();
$data['bank_transfer_masuk_id'] = $bank_transfer_masuk_id;
foreach ($q->result() as $r) {
$data['banktransfermasuk__idstring'] = $r->idstring;
$data['banktransfermasuk__date'] = $r->date;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransfermasuk__currency_id'] = $r->currency_id;
$data['banktransfermasuk__amount'] = $r->amount;
$data['banktransfermasuk__notes'] = $r->notes;
$data['banktransfermasuk__transferedflag'] = $r->transferedflag;
$data['banktransfermasuk__lastupdate'] = $r->lastupdate;
$data['banktransfermasuk__updatedby'] = $r->updatedby;
$data['banktransfermasuk__created'] = $r->created;
$data['banktransfermasuk__createdby'] = $r->createdby;}
$this->load->view('bank_transfer_masuk_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['banktransfermasuk__idstring'];
$data['date'] = $_POST['banktransfermasuk__date'];
$data['currency_id'] = $_POST['banktransfermasuk__currency_id'];
$data['amount'] = $_POST['banktransfermasuk__amount'];
$data['notes'] = $_POST['banktransfermasuk__notes'];
$data['transferedflag'] = $_POST['banktransfermasuk__transferedflag'];
$data['lastupdate'] = $_POST['banktransfermasuk__lastupdate'];
$data['updatedby'] = $_POST['banktransfermasuk__updatedby'];
$data['created'] = $_POST['banktransfermasuk__created'];
$data['createdby'] = $_POST['banktransfermasuk__createdby'];
$this->db->where('id', $data['bank_transfer_masuk_id']);
$this->db->update('banktransfermasuk', $data);
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