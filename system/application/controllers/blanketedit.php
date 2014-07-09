<?php

class blanketedit extends Controller {

	function blanketedit()
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
	
		
$q = $this->db->where('id', $blanket_id);
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
$this->load->view('blanket_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['item__idstring']) && ($_POST['item__idstring'] == "" || $_POST['item__idstring'] == null))
$error .= "<span class='error'>Item ID must not be empty"."</span><br>";

if (isset($_POST['item__idstring'])) {$this->db->where("id !=", $_POST['blanket_id']);
$this->db->where('idstring', $_POST['item__idstring']);
$q = $this->db->get('item');
if ($q->num_rows() > 0) $error .= "<span class='error'>Item ID must be unique"."</span><br>";}

if (isset($_POST['item__name']) && ($_POST['item__name'] == "" || $_POST['item__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (!isset($_POST['item__persediaan_coa_id']) || ($_POST['item__persediaan_coa_id'] == "" || $_POST['item__persediaan_coa_id'] == null  || $_POST['item__persediaan_coa_id'] == 0))
$error .= "<span class='error'>Account Persediaan must not be empty"."</span><br>";

if (!isset($_POST['item__hpp_coa_id']) || ($_POST['item__hpp_coa_id'] == "" || $_POST['item__hpp_coa_id'] == null  || $_POST['item__hpp_coa_id'] == 0))
$error .= "<span class='error'>Account HPP must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['item__idstring']))
$data['idstring'] = $_POST['item__idstring'];if (isset($_POST['item__name']))
$data['name'] = $_POST['item__name'];if (isset($_POST['item__palleteno']))
$data['palleteno'] = $_POST['item__palleteno'];if (isset($_POST['item__codebaru']))
$data['codebaru'] = $_POST['item__codebaru'];if (isset($_POST['item__pressntype']))
$data['pressntype'] = $_POST['item__pressntype'];if (isset($_POST['item__ac']))
$data['ac'] = $_POST['item__ac'];if (isset($_POST['item__ar']))
$data['ar'] = $_POST['item__ar'];if (isset($_POST['item__thickness']))
$data['thickness'] = $_POST['item__thickness'];if (isset($_POST['item__bartype']))
$data['bartype'] = $_POST['item__bartype'];if (isset($_POST['item__movingspeed']))
$data['movingspeed'] = $_POST['item__movingspeed'];if (isset($_POST['item__minquantity']))
$data['minquantity'] = $_POST['item__minquantity'];if (isset($_POST['item__maxquantity']))
$data['maxquantity'] = $_POST['item__maxquantity'];if (isset($_POST['item__barorigin']))
$data['barorigin'] = $_POST['item__barorigin'];
if (isset($_POST['item__barnonbar']))
$data['barnonbar'] = 1;
else
$data['barnonbar'] = 0;if (isset($_POST['item__buffer3months']))
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
$this->db->where('id', $_POST['blanket_id']);
$this->db->update('item', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanketedit','item','afteredit', $_POST['blanket_id']);
			
			
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