<?php

class rolledit extends Controller {

	function rolledit()
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
	
		
$q = $this->db->where('id', $roll_id);
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
$data['item__intitemtype'] = $r->intitemtype;
$data['item__itemcategory_id'] = $r->itemcategory_id;
$data['item__purchaseable'] = $r->purchaseable;
$data['item__sellable'] = $r->sellable;
$data['item__manufactured'] = $r->manufactured;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__persediaan_coa_id'] = $r->persediaan_coa_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__hpp_coa_id'] = $r->hpp_coa_id;
$data['item__lastupdate'] = $r->lastupdate;
$data['item__updatedby'] = $r->updatedby;
$data['item__created'] = $r->created;
$data['item__createdby'] = $r->createdby;}
$this->load->view('roll_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['item__idstring']) && ($_POST['item__idstring'] == "" || $_POST['item__idstring'] == null))
$error .= "<span class='error'>Item ID must not be empty"."</span><br>";

if (isset($_POST['item__idstring'])) {$this->db->where("id !=", $_POST['roll_id']);
$this->db->where('idstring', $_POST['item__idstring']);
$q = $this->db->get('item');
if ($q->num_rows() > 0) $error .= "<span class='error'>Item ID must be unique"."</span><br>";}

if (isset($_POST['item__name']) && ($_POST['item__name'] == "" || $_POST['item__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if ($_POST['item__processscheme'] == "BrandNew")
if (!isset($_POST['item__persediaan_coa_id']) || ($_POST['item__persediaan_coa_id'] == "" || $_POST['item__persediaan_coa_id'] == null  || $_POST['item__persediaan_coa_id'] == 0))
$error .= "<span class='error'>Account Persediaan must not be empty"."</span><br>";

if (!isset($_POST['item__hpp_coa_id']) || ($_POST['item__hpp_coa_id'] == "" || $_POST['item__hpp_coa_id'] == null  || $_POST['item__hpp_coa_id'] == 0))
$error .= "<span class='error'>Account HPP must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['item__idstring']))
$data['idstring'] = $_POST['item__idstring'];if (isset($_POST['item__name']))
$data['name'] = $_POST['item__name'];if (isset($_POST['item__rollno']))
$data['rollno'] = $_POST['item__rollno'];if (isset($_POST['item__inktype']))
$data['inktype'] = $_POST['item__inktype'];if (isset($_POST['item__machinetype']))
$data['machinetype'] = $_POST['item__machinetype'];if (isset($_POST['item__core']))
$data['core'] = $_POST['item__core'];if (isset($_POST['item__rd']))
$data['rd'] = $_POST['item__rd'];if (isset($_POST['item__cd']))
$data['cd'] = $_POST['item__cd'];if (isset($_POST['item__rl']))
$data['rl'] = $_POST['item__rl'];if (isset($_POST['item__wl']))
$data['wl'] = $_POST['item__wl'];if (isset($_POST['item__tl']))
$data['tl'] = $_POST['item__tl'];if (isset($_POST['item__compound']))
$data['compound'] = $_POST['item__compound'];if (isset($_POST['item__processscheme']))
$data['processscheme'] = $_POST['item__processscheme'];if (isset($_POST['item__rollertype']))
$data['rollertype'] = $_POST['item__rollertype'];
if (isset($_POST['item__isaccessories']))
$data['isaccessories'] = 1;
else
$data['isaccessories'] = 0;if (isset($_POST['item__minquantity']))
$data['minquantity'] = $_POST['item__minquantity'];if (isset($_POST['item__maxquantity']))
$data['maxquantity'] = $_POST['item__maxquantity'];if (isset($_POST['item__buffer3months']))
$data['buffer3months'] = $_POST['item__buffer3months'];if (isset($_POST['item__intitemtype']))
$data['intitemtype'] = $_POST['item__intitemtype'];if (isset($_POST['item__itemcategory_id']))
$data['itemcategory_id'] = $_POST['item__itemcategory_id'];
if (isset($_POST['item__purchaseable']))
$data['purchaseable'] = 1;
else
$data['purchaseable'] = 0;
if (isset($_POST['item__sellable']))
$data['sellable'] = 1;
else
$data['sellable'] = 0;
if (isset($_POST['item__manufactured']))
$data['manufactured'] = 1;
else
$data['manufactured'] = 0;if (isset($_POST['item__persediaan_coa_id']))
$data['persediaan_coa_id'] = $_POST['item__persediaan_coa_id'];if (isset($_POST['item__hpp_coa_id']))
$data['hpp_coa_id'] = $_POST['item__hpp_coa_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['roll_id']);
$this->db->update('item', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rolledit','item','afteredit', $_POST['roll_id']);
			
			
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