<?php

class stock_movement_lineedit extends Controller {

	function stock_movement_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_movement_line_id=0)
	{
		if ($stock_movement_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $stock_movement_line_id);
$this->db->select('*');
$q = $this->db->get('moveactionline');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_movement_line_id'] = $stock_movement_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveactionline__item_id'] = $r->item_id;
$data['moveactionline__quantitytomove'] = $r->quantitytomove;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveactionline__uom_id'] = $r->uom_id;
$data['moveactionline__moveorderline_id'] = $r->moveorderline_id;
$data['moveactionline__lastupdate'] = $r->lastupdate;
$data['moveactionline__updatedby'] = $r->updatedby;
$data['moveactionline__created'] = $r->created;
$data['moveactionline__createdby'] = $r->createdby;}
$this->load->view('stock_movement_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['moveactionline__item_id']) || ($_POST['moveactionline__item_id'] == "" || $_POST['moveactionline__item_id'] == null  || $_POST['moveactionline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['moveactionline__quantitytomove']) && ($_POST['moveactionline__quantitytomove'] == "" || $_POST['moveactionline__quantitytomove'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['moveactionline__uom_id']) || ($_POST['moveactionline__uom_id'] == "" || $_POST['moveactionline__uom_id'] == null  || $_POST['moveactionline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveactionline__item_id']))
$data['item_id'] = $_POST['moveactionline__item_id'];if (isset($_POST['moveactionline__quantitytomove']))
$data['quantitytomove'] = $_POST['moveactionline__quantitytomove'];if (isset($_POST['moveactionline__uom_id']))
$data['uom_id'] = $_POST['moveactionline__uom_id'];if (isset($_POST['moveactionline__moveorderline_id']))
$data['moveorderline_id'] = $_POST['moveactionline__moveorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['stock_movement_line_id']);
$this->db->update('moveactionline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_movement_lineedit','moveactionline','afteredit', $_POST['stock_movement_line_id']);
			
			
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