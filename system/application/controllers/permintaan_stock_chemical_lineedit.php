<?php

class permintaan_stock_chemical_lineedit extends Controller {

	function permintaan_stock_chemical_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_chemical_line_id=0)
	{
		if ($permintaan_stock_chemical_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $permintaan_stock_chemical_line_id);
$this->db->select('*');
$q = $this->db->get('permintaanstockchemicalline');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_chemical_line_id'] = $permintaan_stock_chemical_line_id;
foreach ($q->result() as $r) {
$data['permintaanstockchemicalline__idstring'] = $r->idstring;
$data['permintaanstockchemicalline__date'] = $r->date;
$data['permintaanstockchemicalline__notes'] = $r->notes;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockchemicalline__item_id'] = $r->item_id;
$data['permintaanstockchemicalline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockchemicalline__uom_id'] = $r->uom_id;
$data['permintaanstockchemicalline__lastupdate'] = $r->lastupdate;
$data['permintaanstockchemicalline__updatedby'] = $r->updatedby;
$data['permintaanstockchemicalline__created'] = $r->created;
$data['permintaanstockchemicalline__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_chemical_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['permintaanstockchemicalline__item_id']) || ($_POST['permintaanstockchemicalline__item_id'] == "" || $_POST['permintaanstockchemicalline__item_id'] == null  || $_POST['permintaanstockchemicalline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['permintaanstockchemicalline__quantity']) && ($_POST['permintaanstockchemicalline__quantity'] == "" || $_POST['permintaanstockchemicalline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['permintaanstockchemicalline__uom_id']) || ($_POST['permintaanstockchemicalline__uom_id'] == "" || $_POST['permintaanstockchemicalline__uom_id'] == null  || $_POST['permintaanstockchemicalline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['permintaanstockchemicalline__idstring']))
$data['idstring'] = $_POST['permintaanstockchemicalline__idstring'];if (isset($_POST['permintaanstockchemicalline__date']))
$data['date'] = $_POST['permintaanstockchemicalline__date'];if (isset($_POST['permintaanstockchemicalline__notes']))
$data['notes'] = $_POST['permintaanstockchemicalline__notes'];if (isset($_POST['permintaanstockchemicalline__item_id']))
$data['item_id'] = $_POST['permintaanstockchemicalline__item_id'];if (isset($_POST['permintaanstockchemicalline__quantity']))
$data['quantity'] = $_POST['permintaanstockchemicalline__quantity'];if (isset($_POST['permintaanstockchemicalline__uom_id']))
$data['uom_id'] = $_POST['permintaanstockchemicalline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['permintaan_stock_chemical_line_id']);
$this->db->update('permintaanstockchemicalline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_chemical_lineedit','permintaanstockchemicalline','afteredit', $_POST['permintaan_stock_chemical_line_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>