<?php

class filter_vacuumadd extends Controller {

	function filter_vacuumadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['filtervacuum__name'] = '';
$data['filtervacuum__subcategory'] = '';
$data['filtervacuum__minquantity'] = '';
$data['filtervacuum__maxquantity'] = '';
$data['filtervacuum__buffer3months'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['filtervacuum__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['filtervacuum__selluom_id'] = '';
$data['filtervacuum__purchaseable'] = '';
$data['filtervacuum__sellable'] = '';
		

		$this->load->view('filter_vacuum_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['filtervacuum__name']) && ($_POST['filtervacuum__name'] == "" || $_POST['filtervacuum__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
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
$this->db->insert('filtervacuum', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>