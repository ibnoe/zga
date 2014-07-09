<?php

class inking_unit_foiladd extends Controller {

	function inking_unit_foiladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['inkingunitfoil__name'] = '';
$data['inkingunitfoil__category'] = '';
$data['inkingunitfoil__color'] = '';
$data['inkingunitfoil__ac'] = '';
$data['inkingunitfoil__ar'] = '';
$data['inkingunitfoil__thickness'] = '';
$data['inkingunitfoil__minquantity'] = '';
$data['inkingunitfoil__maxquantity'] = '';
$data['inkingunitfoil__buffer3months'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['inkingunitfoil__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['inkingunitfoil__selluom_id'] = '';
$data['inkingunitfoil__purchaseable'] = '';
$data['inkingunitfoil__sellable'] = '';
		

		$this->load->view('inking_unit_foil_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['inkingunitfoil__name']) && ($_POST['inkingunitfoil__name'] == "" || $_POST['inkingunitfoil__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
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
$this->db->insert('inkingunitfoil', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>