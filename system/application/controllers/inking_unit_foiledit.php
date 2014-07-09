<?php

class inking_unit_foiledit extends Controller {

	function inking_unit_foiledit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($inking_unit_foil_id=0)
	{
		
$q = $this->db->where('id', $inking_unit_foil_id);
$q = $this->db->get('inkingunitfoil');
if ($q->num_rows() > 0) {
$data = array();
$data['inking_unit_foil_id'] = $inking_unit_foil_id;
foreach ($q->result() as $r) {
$data['inkingunitfoil__name'] = $r->name;
$data['inkingunitfoil__category'] = $r->category;
$data['inkingunitfoil__color'] = $r->color;
$data['inkingunitfoil__ac'] = $r->ac;
$data['inkingunitfoil__ar'] = $r->ar;
$data['inkingunitfoil__thickness'] = $r->thickness;
$data['inkingunitfoil__minquantity'] = $r->minquantity;
$data['inkingunitfoil__maxquantity'] = $r->maxquantity;
$data['inkingunitfoil__buffer3months'] = $r->buffer3months;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['inkingunitfoil__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['inkingunitfoil__selluom_id'] = $r->selluom_id;
$data['inkingunitfoil__purchaseable'] = $r->purchaseable;
$data['inkingunitfoil__sellable'] = $r->sellable;}
$this->load->view('inking_unit_foil_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['inkingunitfoil__name']))
$data['name'] = $_POST['inkingunitfoil__name'];if (isset($_POST['inkingunitfoil__category']))
$data['category'] = $_POST['inkingunitfoil__category'];if (isset($_POST['inkingunitfoil__color']))
$data['color'] = $_POST['inkingunitfoil__color'];if (isset($_POST['inkingunitfoil__ac']))
$data['ac'] = $_POST['inkingunitfoil__ac'];if (isset($_POST['inkingunitfoil__ar']))
$data['ar'] = $_POST['inkingunitfoil__ar'];if (isset($_POST['inkingunitfoil__thickness']))
$data['thickness'] = $_POST['inkingunitfoil__thickness'];if (isset($_POST['inkingunitfoil__minquantity']))
$data['minquantity'] = $_POST['inkingunitfoil__minquantity'];if (isset($_POST['inkingunitfoil__maxquantity']))
$data['maxquantity'] = $_POST['inkingunitfoil__maxquantity'];if (isset($_POST['inkingunitfoil__buffer3months']))
$data['buffer3months'] = $_POST['inkingunitfoil__buffer3months'];if (isset($_POST['inkingunitfoil__buyuom_id']))
$data['buyuom_id'] = $_POST['inkingunitfoil__buyuom_id'];if (isset($_POST['inkingunitfoil__selluom_id']))
$data['selluom_id'] = $_POST['inkingunitfoil__selluom_id'];if (isset($_POST['inkingunitfoil__purchaseable']))
$data['purchaseable'] = $_POST['inkingunitfoil__purchaseable'];if (isset($_POST['inkingunitfoil__sellable']))
$data['sellable'] = $_POST['inkingunitfoil__sellable'];
$this->db->where('id', $_POST['inking_unit_foil_id']);
$this->db->update('inkingunitfoil', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>