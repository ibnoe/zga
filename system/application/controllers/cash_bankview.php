<?php

class cash_bankview extends Controller {

	function cash_bankview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($cash_bank_id=0)
	{
		if ($cash_bank_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $cash_bank_id);
$this->db->select('*');
$q = $this->db->get('cashbank');
if ($q->num_rows() > 0) {
$data = array();
$data['cash_bank_id'] = $cash_bank_id;
foreach ($q->result() as $r) {
$data['cashbank__name'] = $r->name;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['cashbank__currency_id'] = $r->currency_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['cashbank__coa_id'] = $r->coa_id;
$data['cashbank__notes'] = $r->notes;
$data['cashbank__lastupdate'] = $r->lastupdate;
$data['cashbank__updatedby'] = $r->updatedby;
$data['cashbank__created'] = $r->created;
$data['cashbank__createdby'] = $r->createdby;}
$this->load->view('cash_bank_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['cashbank__name'];
$data['currency_id'] = $_POST['cashbank__currency_id'];
$data['coa_id'] = $_POST['cashbank__coa_id'];
$data['notes'] = $_POST['cashbank__notes'];
$data['lastupdate'] = $_POST['cashbank__lastupdate'];
$data['updatedby'] = $_POST['cashbank__updatedby'];
$data['created'] = $_POST['cashbank__created'];
$data['createdby'] = $_POST['cashbank__createdby'];
$this->db->where('id', $data['cash_bank_id']);
$this->db->update('cashbank', $data);
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