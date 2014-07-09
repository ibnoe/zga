<?php

class under_packing_blanketedit extends Controller {

	function under_packing_blanketedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($under_packing_blanket_id=0)
	{
		
$q = $this->db->where('id', $under_packing_blanket_id);
$q = $this->db->get('underpackingblanket');
if ($q->num_rows() > 0) {
$data = array();
$data['under_packing_blanket_id'] = $under_packing_blanket_id;
foreach ($q->result() as $r) {
$data['underpackingblanket__name'] = $r->name;
$data['underpackingblanket__category'] = $r->category;
$data['underpackingblanket__color'] = $r->color;
$data['underpackingblanket__ac'] = $r->ac;
$data['underpackingblanket__ar'] = $r->ar;
$data['underpackingblanket__thickness'] = $r->thickness;
$data['underpackingblanket__minquantity'] = $r->minquantity;
$data['underpackingblanket__maxquantity'] = $r->maxquantity;
$data['underpackingblanket__buffer3months'] = $r->buffer3months;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['underpackingblanket__buyuom_id'] = $r->buyuom_id;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['underpackingblanket__selluom_id'] = $r->selluom_id;
$data['underpackingblanket__purchaseable'] = $r->purchaseable;
$data['underpackingblanket__sellable'] = $r->sellable;}
$this->load->view('under_packing_blanket_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['underpackingblanket__name']))
$data['name'] = $_POST['underpackingblanket__name'];if (isset($_POST['underpackingblanket__category']))
$data['category'] = $_POST['underpackingblanket__category'];if (isset($_POST['underpackingblanket__color']))
$data['color'] = $_POST['underpackingblanket__color'];if (isset($_POST['underpackingblanket__ac']))
$data['ac'] = $_POST['underpackingblanket__ac'];if (isset($_POST['underpackingblanket__ar']))
$data['ar'] = $_POST['underpackingblanket__ar'];if (isset($_POST['underpackingblanket__thickness']))
$data['thickness'] = $_POST['underpackingblanket__thickness'];if (isset($_POST['underpackingblanket__minquantity']))
$data['minquantity'] = $_POST['underpackingblanket__minquantity'];if (isset($_POST['underpackingblanket__maxquantity']))
$data['maxquantity'] = $_POST['underpackingblanket__maxquantity'];if (isset($_POST['underpackingblanket__buffer3months']))
$data['buffer3months'] = $_POST['underpackingblanket__buffer3months'];if (isset($_POST['underpackingblanket__buyuom_id']))
$data['buyuom_id'] = $_POST['underpackingblanket__buyuom_id'];if (isset($_POST['underpackingblanket__selluom_id']))
$data['selluom_id'] = $_POST['underpackingblanket__selluom_id'];if (isset($_POST['underpackingblanket__purchaseable']))
$data['purchaseable'] = $_POST['underpackingblanket__purchaseable'];if (isset($_POST['underpackingblanket__sellable']))
$data['sellable'] = $_POST['underpackingblanket__sellable'];
$this->db->where('id', $_POST['under_packing_blanket_id']);
$this->db->update('underpackingblanket', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>