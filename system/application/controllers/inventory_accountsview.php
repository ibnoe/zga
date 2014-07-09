<?php

class inventory_accountsview extends Controller {

	function inventory_accountsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($inventory_accounts_id=0)
	{
		if ($inventory_accounts_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $inventory_accounts_id);
$this->db->select('*');
$q = $this->db->get('coa');
if ($q->num_rows() > 0) {
$data = array();
$data['inventory_accounts_id'] = $inventory_accounts_id;
foreach ($q->result() as $r) {
$data['coa__idstring'] = $r->idstring;
$data['coa__name'] = $r->name;
$coatype_opt = array();
$q = $this->db->get('coatype');
foreach ($q->result() as $row) { $coatype_opt[$row->id] = $row->name; }
$data['coatype_opt'] = $coatype_opt;
$data['coa__coatype_id'] = $r->coatype_id;
$data['coa__lastupdate'] = $r->lastupdate;
$data['coa__updatedby'] = $r->updatedby;
$data['coa__created'] = $r->created;
$data['coa__createdby'] = $r->createdby;}
$this->load->view('inventory_accounts_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['coa__idstring'];
$data['name'] = $_POST['coa__name'];
$data['coatype_id'] = $_POST['coa__coatype_id'];
$data['lastupdate'] = $_POST['coa__lastupdate'];
$data['updatedby'] = $_POST['coa__updatedby'];
$data['created'] = $_POST['coa__created'];
$data['createdby'] = $_POST['coa__createdby'];
$this->db->where('id', $data['inventory_accounts_id']);
$this->db->update('coa', $data);
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