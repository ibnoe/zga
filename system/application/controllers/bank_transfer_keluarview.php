<?php

class bank_transfer_keluarview extends Controller {

	function bank_transfer_keluarview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bank_transfer_keluar_id=0)
	{
		if ($bank_transfer_keluar_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $bank_transfer_keluar_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) {
$data = array();
$data['bank_transfer_keluar_id'] = $bank_transfer_keluar_id;
foreach ($q->result() as $r) {
$data['banktransferkeluar__idstring'] = $r->idstring;
$data['banktransferkeluar__date'] = $r->date;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransferkeluar__currency_id'] = $r->currency_id;
$data['banktransferkeluar__amount'] = $r->amount;
$data['banktransferkeluar__notes'] = $r->notes;
$data['banktransferkeluar__transferedflag'] = $r->transferedflag;
$data['banktransferkeluar__lastupdate'] = $r->lastupdate;
$data['banktransferkeluar__updatedby'] = $r->updatedby;
$data['banktransferkeluar__created'] = $r->created;
$data['banktransferkeluar__createdby'] = $r->createdby;}
$this->load->view('bank_transfer_keluar_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['banktransferkeluar__idstring'];
$data['date'] = $_POST['banktransferkeluar__date'];
$data['currency_id'] = $_POST['banktransferkeluar__currency_id'];
$data['amount'] = $_POST['banktransferkeluar__amount'];
$data['notes'] = $_POST['banktransferkeluar__notes'];
$data['transferedflag'] = $_POST['banktransferkeluar__transferedflag'];
$data['lastupdate'] = $_POST['banktransferkeluar__lastupdate'];
$data['updatedby'] = $_POST['banktransferkeluar__updatedby'];
$data['created'] = $_POST['banktransferkeluar__created'];
$data['createdby'] = $_POST['banktransferkeluar__createdby'];
$this->db->where('id', $data['bank_transfer_keluar_id']);
$this->db->update('banktransferkeluar', $data);
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