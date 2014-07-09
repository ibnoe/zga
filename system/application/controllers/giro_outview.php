<?php

class giro_outview extends Controller {

	function giro_outview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_id=0)
	{
		if ($giro_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_out_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(createdate, "%d-%m-%Y") as createdate', false);
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_id'] = $giro_out_id;
foreach ($q->result() as $r) {
$data['giroout__girooutid'] = $r->girooutid;
$data['giroout__createdate'] = $r->createdate;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['giroout__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroout__currency_id'] = $r->currency_id;
$data['giroout__amount'] = $r->amount;
$data['giroout__amountused'] = $r->amountused;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroout__coa_id'] = $r->coa_id;
$data['giroout__notes'] = $r->notes;
$data['giroout__usedflag'] = $r->usedflag;
$data['giroout__lastupdate'] = $r->lastupdate;
$data['giroout__updatedby'] = $r->updatedby;
$data['giroout__created'] = $r->created;
$data['giroout__createdby'] = $r->createdby;}
$this->load->view('giro_out_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['girooutid'] = $_POST['giroout__girooutid'];
$data['createdate'] = $_POST['giroout__createdate'];
$data['supplier_id'] = $_POST['giroout__supplier_id'];
$data['currency_id'] = $_POST['giroout__currency_id'];
$data['amount'] = $_POST['giroout__amount'];
$data['amountused'] = $_POST['giroout__amountused'];
$data['coa_id'] = $_POST['giroout__coa_id'];
$data['notes'] = $_POST['giroout__notes'];
$data['usedflag'] = $_POST['giroout__usedflag'];
$data['lastupdate'] = $_POST['giroout__lastupdate'];
$data['updatedby'] = $_POST['giroout__updatedby'];
$data['created'] = $_POST['giroout__created'];
$data['createdby'] = $_POST['giroout__createdby'];
$this->db->where('id', $data['giro_out_id']);
$this->db->update('giroout', $data);
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