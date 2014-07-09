<?php

class rollview extends Controller {

	function rollview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($roll_id=0)
	{
		if ($roll_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $roll_id);
$this->db->select('*');
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['roll_id'] = $roll_id;
foreach ($q->result() as $r) {
$data['item__idstring'] = $r->idstring;
$data['item__name'] = $r->name;
$data['item__rollno'] = $r->rollno;
$data['item__inktype'] = $r->inktype;
$data['item__machinetype'] = $r->machinetype;
$data['item__core'] = $r->core;
$data['item__rd'] = $r->rd;
$data['item__cd'] = $r->cd;
$data['item__rl'] = $r->rl;
$data['item__wl'] = $r->wl;
$data['item__tl'] = $r->tl;
$data['item__compound'] = $r->compound;
$data['item__processscheme'] = $r->processscheme;
$data['item__rollertype'] = $r->rollertype;
$data['item__isaccessories'] = $r->isaccessories;
$data['item__minquantity'] = $r->minquantity;
$data['item__maxquantity'] = $r->maxquantity;
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
$this->load->view('roll_view_form', $data);
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
$data['rollno'] = $_POST['item__rollno'];
$data['inktype'] = $_POST['item__inktype'];
$data['machinetype'] = $_POST['item__machinetype'];
$data['core'] = $_POST['item__core'];
$data['rd'] = $_POST['item__rd'];
$data['cd'] = $_POST['item__cd'];
$data['rl'] = $_POST['item__rl'];
$data['wl'] = $_POST['item__wl'];
$data['tl'] = $_POST['item__tl'];
$data['compound'] = $_POST['item__compound'];
$data['processscheme'] = $_POST['item__processscheme'];
$data['rollertype'] = $_POST['item__rollertype'];
$data['isaccessories'] = $_POST['item__isaccessories'];
$data['minquantity'] = $_POST['item__minquantity'];
$data['maxquantity'] = $_POST['item__maxquantity'];
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
$this->db->where('id', $data['roll_id']);
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