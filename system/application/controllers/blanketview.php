<?php

class blanketview extends Controller {

	function blanketview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_id=0)
	{
		if ($blanket_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $blanket_id);
$this->db->select('*');
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_id'] = $blanket_id;
foreach ($q->result() as $r) {
$data['item__idstring'] = $r->idstring;
$data['item__name'] = $r->name;
$data['item__palleteno'] = $r->palleteno;
$data['item__codebaru'] = $r->codebaru;
$data['item__pressntype'] = $r->pressntype;
$data['item__ac'] = $r->ac;
$data['item__ar'] = $r->ar;
$data['item__thickness'] = $r->thickness;
$data['item__bartype'] = $r->bartype;
$data['item__movingspeed'] = $r->movingspeed;
$data['item__minquantity'] = $r->minquantity;
$data['item__maxquantity'] = $r->maxquantity;
$data['item__barorigin'] = $r->barorigin;
$data['item__barnonbar'] = $r->barnonbar;
$data['item__buffer3months'] = $r->buffer3months;
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
$this->load->view('blanket_view_form', $data);
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
$data['palleteno'] = $_POST['item__palleteno'];
$data['codebaru'] = $_POST['item__codebaru'];
$data['pressntype'] = $_POST['item__pressntype'];
$data['ac'] = $_POST['item__ac'];
$data['ar'] = $_POST['item__ar'];
$data['thickness'] = $_POST['item__thickness'];
$data['bartype'] = $_POST['item__bartype'];
$data['movingspeed'] = $_POST['item__movingspeed'];
$data['minquantity'] = $_POST['item__minquantity'];
$data['maxquantity'] = $_POST['item__maxquantity'];
$data['barorigin'] = $_POST['item__barorigin'];
$data['barnonbar'] = $_POST['item__barnonbar'];
$data['buffer3months'] = $_POST['item__buffer3months'];
$data['purchaseable'] = $_POST['item__purchaseable'];
$data['sellable'] = $_POST['item__sellable'];
$data['manufactured'] = $_POST['item__manufactured'];
$data['persediaan_coa_id'] = $_POST['item__persediaan_coa_id'];
$data['hpp_coa_id'] = $_POST['item__hpp_coa_id'];
$data['lastupdate'] = $_POST['item__lastupdate'];
$data['updatedby'] = $_POST['item__updatedby'];
$data['created'] = $_POST['item__created'];
$data['createdby'] = $_POST['item__createdby'];
$this->db->where('id', $data['blanket_id']);
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