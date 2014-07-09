<?php

class chemicalview extends Controller {

	function chemicalview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($chemical_id=0)
	{
		if ($chemical_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $chemical_id);
$this->db->select('*');
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['chemical_id'] = $chemical_id;
foreach ($q->result() as $r) {
$data['item__idstring'] = $r->idstring;
$data['item__name'] = $r->name;
$data['item__chemicalcode'] = $r->chemicalcode;
$data['item__chemicaltype'] = $r->chemicaltype;
$data['item__packingsize'] = $r->packingsize;
$data['item__purchaseable'] = $r->purchaseable;
$data['item__sellable'] = $r->sellable;
$data['item__manufactured'] = $r->manufactured;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__persediaan_coa_id'] = $r->persediaan_coa_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__hpp_coa_id'] = $r->hpp_coa_id;
$data['item__lastupdate'] = $r->lastupdate;
$data['item__updatedby'] = $r->updatedby;
$data['item__created'] = $r->created;
$data['item__createdby'] = $r->createdby;}
$this->load->view('chemical_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['item__idstring'];
$data['name'] = $_POST['item__name'];
$data['chemicalcode'] = $_POST['item__chemicalcode'];
$data['chemicaltype'] = $_POST['item__chemicaltype'];
$data['packingsize'] = $_POST['item__packingsize'];
$data['purchaseable'] = $_POST['item__purchaseable'];
$data['sellable'] = $_POST['item__sellable'];
$data['manufactured'] = $_POST['item__manufactured'];
$data['persediaan_coa_id'] = $_POST['item__persediaan_coa_id'];
$data['hpp_coa_id'] = $_POST['item__hpp_coa_id'];
$data['lastupdate'] = $_POST['item__lastupdate'];
$data['updatedby'] = $_POST['item__updatedby'];
$data['created'] = $_POST['item__created'];
$data['createdby'] = $_POST['item__createdby'];
$this->db->where('id', $data['chemical_id']);
$this->db->update('item', $data);
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