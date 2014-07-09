<?php

class composite_canedit extends Controller {

	function composite_canedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($composite_can_id=0)
	{
		
$q = $this->db->where('id', $composite_can_id);
$q = $this->db->get('composite');
if ($q->num_rows() > 0) {
$data = array();
$data['composite_can_id'] = $composite_can_id;
foreach ($q->result() as $r) {
$data['composite__name'] = $r->name;
$data['composite__diameter'] = $r->diameter;
$data['composite__length'] = $r->length;
$data['composite__minquantity'] = $r->minquantity;
$data['composite__maxquantity'] = $r->maxquantity;
$data['composite__buffer3months'] = $r->buffer3months;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['composite__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['composite__selluom_id'] = $r->selluom_id;
$data['composite__purchaseable'] = $r->purchaseable;
$data['composite__sellable'] = $r->sellable;}
$this->load->view('composite_can_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
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
$this->db->where('id', $_POST['composite_can_id']);
$this->db->update('composite', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>