<?php

class under_packing_blanketadd extends Controller {

	function under_packing_blanketadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['underpackingblanket__name'] = '';
$data['underpackingblanket__category'] = '';
$data['underpackingblanket__color'] = '';
$data['underpackingblanket__ac'] = '';
$data['underpackingblanket__ar'] = '';
$data['underpackingblanket__thickness'] = '';
$data['underpackingblanket__minquantity'] = '';
$data['underpackingblanket__maxquantity'] = '';
$data['underpackingblanket__buffer3months'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['underpackingblanket__buyuom_id'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['underpackingblanket__selluom_id'] = '';
$data['underpackingblanket__purchaseable'] = '';
$data['underpackingblanket__sellable'] = '';
		

		$this->load->view('under_packing_blanket_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['underpackingblanket__name']) && ($_POST['underpackingblanket__name'] == "" || $_POST['underpackingblanket__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
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
$this->db->insert('underpackingblanket', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>