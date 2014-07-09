<?php

class giro_inview extends Controller {

	function giro_inview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_id=0)
	{
		if ($giro_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $giro_in_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(createdate, "%d-%m-%Y") as createdate', false);
$q = $this->db->get('giroin');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_id'] = $giro_in_id;
foreach ($q->result() as $r) {
$data['giroin__giroinid'] = $r->giroinid;
$data['giroin__createdate'] = $r->createdate;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['giroin__customer_id'] = $r->customer_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroin__currency_id'] = $r->currency_id;
$data['giroin__amount'] = $r->amount;
$data['giroin__amountused'] = $r->amountused;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroin__coa_id'] = $r->coa_id;
$data['giroin__notes'] = $r->notes;
$data['giroin__usedflag'] = $r->usedflag;
$data['giroin__lastupdate'] = $r->lastupdate;
$data['giroin__updatedby'] = $r->updatedby;
$data['giroin__created'] = $r->created;
$data['giroin__createdby'] = $r->createdby;}
$this->load->view('giro_in_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['giroinid'] = $_POST['giroin__giroinid'];
$data['createdate'] = $_POST['giroin__createdate'];
$data['customer_id'] = $_POST['giroin__customer_id'];
$data['currency_id'] = $_POST['giroin__currency_id'];
$data['amount'] = $_POST['giroin__amount'];
$data['amountused'] = $_POST['giroin__amountused'];
$data['coa_id'] = $_POST['giroin__coa_id'];
$data['notes'] = $_POST['giroin__notes'];
$data['usedflag'] = $_POST['giroin__usedflag'];
$data['lastupdate'] = $_POST['giroin__lastupdate'];
$data['updatedby'] = $_POST['giroin__updatedby'];
$data['created'] = $_POST['giroin__created'];
$data['createdby'] = $_POST['giroin__createdby'];
$this->db->where('id', $data['giro_in_id']);
$this->db->update('giroin', $data);
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