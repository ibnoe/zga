<?php

class under_packing_folexedit extends Controller {

	function under_packing_folexedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($under_packing_folex_id=0)
	{
		
$q = $this->db->where('id', $under_packing_folex_id);
$q = $this->db->get('itemzengraunderpackingfolex');
if ($q->num_rows() > 0) {
$data = array();
$data['under_packing_folex_id'] = $under_packing_folex_id;
foreach ($q->result() as $r) {
$data['itemzengraunderpackingfolex__name'] = $r->name;
$data['itemzengraunderpackingfolex__netsqm'] = $r->netsqm;
$data['itemzengraunderpackingfolex__grosssqm'] = $r->grosssqm;
$data['itemzengraunderpackingfolex__minquantity'] = $r->minquantity;
$data['itemzengraunderpackingfolex__maxquantity'] = $r->maxquantity;
$data['itemzengraunderpackingfolex__buffer3months'] = $r->buffer3months;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['itemzengraunderpackingfolex__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['itemzengraunderpackingfolex__selluom_id'] = $r->selluom_id;
$data['itemzengraunderpackingfolex__purchaseable'] = $r->purchaseable;
$data['itemzengraunderpackingfolex__sellable'] = $r->sellable;}
$this->load->view('under_packing_folex_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
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
$this->db->where('id', $_POST['under_packing_folex_id']);
$this->db->update('itemzengraunderpackingfolex', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>