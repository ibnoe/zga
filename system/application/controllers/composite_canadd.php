<?php

class composite_canadd extends Controller {

	function composite_canadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['composite__name'] = '';
$data['composite__diameter'] = '';
$data['composite__length'] = '';
$data['composite__minquantity'] = '';
$data['composite__maxquantity'] = '';
$data['composite__buffer3months'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['composite__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['composite__selluom_id'] = '';
$data['composite__purchaseable'] = '';
$data['composite__sellable'] = '';
		

		$this->load->view('composite_can_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['composite__name']) && ($_POST['composite__name'] == "" || $_POST['composite__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['composite__name']))
$data['name'] = $_POST['composite__name'];if (isset($_POST['composite__diameter']))
$data['diameter'] = $_POST['composite__diameter'];if (isset($_POST['composite__length']))
$data['length'] = $_POST['composite__length'];if (isset($_POST['composite__minquantity']))
$data['minquantity'] = $_POST['composite__minquantity'];if (isset($_POST['composite__maxquantity']))
$data['maxquantity'] = $_POST['composite__maxquantity'];if (isset($_POST['composite__buffer3months']))
$data['buffer3months'] = $_POST['composite__buffer3months'];if (isset($_POST['composite__buyuom_id']))
$data['buyuom_id'] = $_POST['composite__buyuom_id'];if (isset($_POST['composite__selluom_id']))
$data['selluom_id'] = $_POST['composite__selluom_id'];if (isset($_POST['composite__purchaseable']))
$data['purchaseable'] = $_POST['composite__purchaseable'];if (isset($_POST['composite__sellable']))
$data['sellable'] = $_POST['composite__sellable'];
$this->db->insert('composite', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>