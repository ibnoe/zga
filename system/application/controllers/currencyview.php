<?php

class currencyview extends Controller {

	function currencyview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($currency_id=0)
	{
		if ($currency_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $currency_id);
$this->db->select('*');
$q = $this->db->get('currency');
if ($q->num_rows() > 0) {
$data = array();
$data['currency_id'] = $currency_id;
foreach ($q->result() as $r) {
$data['currency__idstring'] = $r->idstring;
$data['currency__name'] = $r->name;
$data['currency__rate'] = $r->rate;
$data['currency__lastupdate'] = $r->lastupdate;
$data['currency__updatedby'] = $r->updatedby;
$data['currency__created'] = $r->created;
$data['currency__createdby'] = $r->createdby;}
$this->load->view('currency_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['currency__idstring'];
$data['name'] = $_POST['currency__name'];
$data['rate'] = $_POST['currency__rate'];
$data['lastupdate'] = $_POST['currency__lastupdate'];
$data['updatedby'] = $_POST['currency__updatedby'];
$data['created'] = $_POST['currency__created'];
$data['createdby'] = $_POST['currency__createdby'];
$this->db->where('id', $data['currency_id']);
$this->db->update('currency', $data);
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