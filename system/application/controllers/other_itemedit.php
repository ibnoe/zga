<?php

class other_itemedit extends Controller {

	function other_itemedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($other_item_id=0)
	{
		
$q = $this->db->where('id', $other_item_id);
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['other_item_id'] = $other_item_id;
foreach ($q->result() as $r) {
$data['item__name'] = $r->name;
$data['item__type'] = $r->type;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['item__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['item__selluom_id'] = $r->selluom_id;
$data['item__purchaseable'] = $r->purchaseable;
$data['item__sellable'] = $r->sellable;}
$this->load->view('other_item_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['item__name']))
$data['name'] = $_POST['item__name'];if (isset($_POST['item__type']))
$data['type'] = $_POST['item__type'];if (isset($_POST['item__buyuom_id']))
$data['buyuom_id'] = $_POST['item__buyuom_id'];if (isset($_POST['item__selluom_id']))
$data['selluom_id'] = $_POST['item__selluom_id'];if (isset($_POST['item__purchaseable']))
$data['purchaseable'] = $_POST['item__purchaseable'];if (isset($_POST['item__sellable']))
$data['sellable'] = $_POST['item__sellable'];
$this->db->where('id', $_POST['other_item_id']);
$this->db->update('item', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>