<?php

class under_packing_folexadd extends Controller {

	function under_packing_folexadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['itemzengraunderpackingfolex__name'] = '';
$data['itemzengraunderpackingfolex__netsqm'] = '';
$data['itemzengraunderpackingfolex__grosssqm'] = '';
$data['itemzengraunderpackingfolex__minquantity'] = '';
$data['itemzengraunderpackingfolex__maxquantity'] = '';
$data['itemzengraunderpackingfolex__buffer3months'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['itemzengraunderpackingfolex__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['itemzengraunderpackingfolex__selluom_id'] = '';
$data['itemzengraunderpackingfolex__purchaseable'] = '';
$data['itemzengraunderpackingfolex__sellable'] = '';
		

		$this->load->view('under_packing_folex_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['itemzengraunderpackingfolex__name']) && ($_POST['itemzengraunderpackingfolex__name'] == "" || $_POST['itemzengraunderpackingfolex__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['itemzengraunderpackingfolex__name']))
$data['name'] = $_POST['itemzengraunderpackingfolex__name'];if (isset($_POST['itemzengraunderpackingfolex__netsqm']))
$data['netsqm'] = $_POST['itemzengraunderpackingfolex__netsqm'];if (isset($_POST['itemzengraunderpackingfolex__grosssqm']))
$data['grosssqm'] = $_POST['itemzengraunderpackingfolex__grosssqm'];if (isset($_POST['itemzengraunderpackingfolex__minquantity']))
$data['minquantity'] = $_POST['itemzengraunderpackingfolex__minquantity'];if (isset($_POST['itemzengraunderpackingfolex__maxquantity']))
$data['maxquantity'] = $_POST['itemzengraunderpackingfolex__maxquantity'];if (isset($_POST['itemzengraunderpackingfolex__buffer3months']))
$data['buffer3months'] = $_POST['itemzengraunderpackingfolex__buffer3months'];if (isset($_POST['itemzengraunderpackingfolex__buyuom_id']))
$data['buyuom_id'] = $_POST['itemzengraunderpackingfolex__buyuom_id'];if (isset($_POST['itemzengraunderpackingfolex__selluom_id']))
$data['selluom_id'] = $_POST['itemzengraunderpackingfolex__selluom_id'];if (isset($_POST['itemzengraunderpackingfolex__purchaseable']))
$data['purchaseable'] = $_POST['itemzengraunderpackingfolex__purchaseable'];if (isset($_POST['itemzengraunderpackingfolex__sellable']))
$data['sellable'] = $_POST['itemzengraunderpackingfolex__sellable'];
$this->db->insert('itemzengraunderpackingfolex', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>