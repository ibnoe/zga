<?php

class other_itemadd extends Controller {

	function other_itemadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['item__name'] = '';
$data['item__type'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['item__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['item__selluom_id'] = '';
$data['item__purchaseable'] = '';
$data['item__sellable'] = '';
		

		$this->load->view('other_item_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['item__name']) && ($_POST['item__name'] == "" || $_POST['item__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['item__name']))
$data['name'] = $_POST['item__name'];if (isset($_POST['item__type']))
$data['type'] = $_POST['item__type'];if (isset($_POST['item__buyuom_id']))
$data['buyuom_id'] = $_POST['item__buyuom_id'];if (isset($_POST['item__selluom_id']))
$data['selluom_id'] = $_POST['item__selluom_id'];if (isset($_POST['item__purchaseable']))
$data['purchaseable'] = $_POST['item__purchaseable'];if (isset($_POST['item__sellable']))
$data['sellable'] = $_POST['item__sellable'];
$this->db->insert('item', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>