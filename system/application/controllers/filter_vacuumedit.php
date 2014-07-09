<?php

class filter_vacuumedit extends Controller {

	function filter_vacuumedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($filter_vacuum_id=0)
	{
		
$q = $this->db->where('id', $filter_vacuum_id);
$q = $this->db->get('filtervacuum');
if ($q->num_rows() > 0) {
$data = array();
$data['filter_vacuum_id'] = $filter_vacuum_id;
foreach ($q->result() as $r) {
$data['filtervacuum__name'] = $r->name;
$data['filtervacuum__subcategory'] = $r->subcategory;
$data['filtervacuum__minquantity'] = $r->minquantity;
$data['filtervacuum__maxquantity'] = $r->maxquantity;
$data['filtervacuum__buffer3months'] = $r->buffer3months;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['filtervacuum__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['filtervacuum__selluom_id'] = $r->selluom_id;
$data['filtervacuum__purchaseable'] = $r->purchaseable;
$data['filtervacuum__sellable'] = $r->sellable;}
$this->load->view('filter_vacuum_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['filtervacuum__name']))
$data['name'] = $_POST['filtervacuum__name'];if (isset($_POST['filtervacuum__subcategory']))
$data['subcategory'] = $_POST['filtervacuum__subcategory'];if (isset($_POST['filtervacuum__minquantity']))
$data['minquantity'] = $_POST['filtervacuum__minquantity'];if (isset($_POST['filtervacuum__maxquantity']))
$data['maxquantity'] = $_POST['filtervacuum__maxquantity'];if (isset($_POST['filtervacuum__buffer3months']))
$data['buffer3months'] = $_POST['filtervacuum__buffer3months'];if (isset($_POST['filtervacuum__buyuom_id']))
$data['buyuom_id'] = $_POST['filtervacuum__buyuom_id'];if (isset($_POST['filtervacuum__selluom_id']))
$data['selluom_id'] = $_POST['filtervacuum__selluom_id'];if (isset($_POST['filtervacuum__purchaseable']))
$data['purchaseable'] = $_POST['filtervacuum__purchaseable'];if (isset($_POST['filtervacuum__sellable']))
$data['sellable'] = $_POST['filtervacuum__sellable'];
$this->db->where('id', $_POST['filter_vacuum_id']);
$this->db->update('filtervacuum', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>