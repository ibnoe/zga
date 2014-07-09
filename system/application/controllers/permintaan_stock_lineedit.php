<?php

class permintaan_stock_lineedit extends Controller {

	function permintaan_stock_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_line_id=0)
	{
		if ($permintaan_stock_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $permintaan_stock_line_id);
$this->db->select('*');
$q = $this->db->get('permintaanstockline');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_line_id'] = $permintaan_stock_line_id;
foreach ($q->result() as $r) {
$data['permintaanstockline__idstring'] = $r->idstring;
$data['permintaanstockline__date'] = $r->date;
$data['permintaanstockline__notes'] = $r->notes;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockline__item_id'] = $r->item_id;
$data['permintaanstockline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockline__uom_id'] = $r->uom_id;
$data['permintaanstockline__lastupdate'] = $r->lastupdate;
$data['permintaanstockline__updatedby'] = $r->updatedby;
$data['permintaanstockline__created'] = $r->created;
$data['permintaanstockline__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['permintaanstockline__item_id']) || ($_POST['permintaanstockline__item_id'] == "" || $_POST['permintaanstockline__item_id'] == null  || $_POST['permintaanstockline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['permintaanstockline__quantity']) && ($_POST['permintaanstockline__quantity'] == "" || $_POST['permintaanstockline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['permintaanstockline__uom_id']) || ($_POST['permintaanstockline__uom_id'] == "" || $_POST['permintaanstockline__uom_id'] == null  || $_POST['permintaanstockline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['permintaanstockline__idstring']))
$data['idstring'] = $_POST['permintaanstockline__idstring'];if (isset($_POST['permintaanstockline__date']))
$data['date'] = $_POST['permintaanstockline__date'];if (isset($_POST['permintaanstockline__notes']))
$data['notes'] = $_POST['permintaanstockline__notes'];if (isset($_POST['permintaanstockline__item_id']))
$data['item_id'] = $_POST['permintaanstockline__item_id'];if (isset($_POST['permintaanstockline__quantity']))
$data['quantity'] = $_POST['permintaanstockline__quantity'];if (isset($_POST['permintaanstockline__uom_id']))
$data['uom_id'] = $_POST['permintaanstockline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['permintaan_stock_line_id']);
$this->db->update('permintaanstockline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_lineedit','permintaanstockline','afteredit', $_POST['permintaan_stock_line_id']);
			
			
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