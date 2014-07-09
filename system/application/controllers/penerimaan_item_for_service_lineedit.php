<?php

class penerimaan_item_for_service_lineedit extends Controller {

	function penerimaan_item_for_service_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penerimaan_item_for_service_line_id=0)
	{
		if ($penerimaan_item_for_service_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $penerimaan_item_for_service_line_id);
$this->db->select('*');
$q = $this->db->get('insertitemline');
if ($q->num_rows() > 0) {
$data = array();
$data['penerimaan_item_for_service_line_id'] = $penerimaan_item_for_service_line_id;
foreach ($q->result() as $r) {
$data['insertitemline__idstring'] = $r->idstring;
$data['insertitemline__date'] = $r->date;
$data['insertitemline__notes'] = $r->notes;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['insertitemline__warehouse_id'] = $r->warehouse_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['insertitemline__item_id'] = $r->item_id;
$data['insertitemline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['insertitemline__uom_id'] = $r->uom_id;
$data['insertitemline__price'] = $r->price;
$data['insertitemline__lastupdate'] = $r->lastupdate;
$data['insertitemline__updatedby'] = $r->updatedby;
$data['insertitemline__created'] = $r->created;
$data['insertitemline__createdby'] = $r->createdby;}
$this->load->view('penerimaan_item_for_service_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['insertitemline__warehouse_id']) || ($_POST['insertitemline__warehouse_id'] == "" || $_POST['insertitemline__warehouse_id'] == null  || $_POST['insertitemline__warehouse_id'] == 0))
$error .= "<span class='error'>Location must not be empty"."</span><br>";

if (!isset($_POST['insertitemline__item_id']) || ($_POST['insertitemline__item_id'] == "" || $_POST['insertitemline__item_id'] == null  || $_POST['insertitemline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['insertitemline__quantity']) && ($_POST['insertitemline__quantity'] == "" || $_POST['insertitemline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['insertitemline__uom_id']) || ($_POST['insertitemline__uom_id'] == "" || $_POST['insertitemline__uom_id'] == null  || $_POST['insertitemline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['insertitemline__idstring']))
$data['idstring'] = $_POST['insertitemline__idstring'];if (isset($_POST['insertitemline__date']))
$data['date'] = $_POST['insertitemline__date'];if (isset($_POST['insertitemline__notes']))
$data['notes'] = $_POST['insertitemline__notes'];if (isset($_POST['insertitemline__warehouse_id']))
$data['warehouse_id'] = $_POST['insertitemline__warehouse_id'];if (isset($_POST['insertitemline__item_id']))
$data['item_id'] = $_POST['insertitemline__item_id'];if (isset($_POST['insertitemline__quantity']))
$data['quantity'] = $_POST['insertitemline__quantity'];if (isset($_POST['insertitemline__uom_id']))
$data['uom_id'] = $_POST['insertitemline__uom_id'];if (isset($_POST['insertitemline__price']))
$data['price'] = $_POST['insertitemline__price'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['penerimaan_item_for_service_line_id']);
$this->db->update('insertitemline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penerimaan_item_for_service_lineedit','insertitemline','afteredit', $_POST['penerimaan_item_for_service_line_id']);
			
			
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