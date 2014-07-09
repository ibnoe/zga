<?php

class bill_of_material_lineedit extends Controller {

	function bill_of_material_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bill_of_material_line_id=0)
	{
		if ($bill_of_material_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $bill_of_material_line_id);
$this->db->select('*');
$q = $this->db->get('bomline');
if ($q->num_rows() > 0) {
$data = array();
$data['bill_of_material_line_id'] = $bill_of_material_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['bomline__item_id'] = $r->item_id;
$data['bomline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['bomline__uom_id'] = $r->uom_id;
$data['bomline__lastupdate'] = $r->lastupdate;
$data['bomline__updatedby'] = $r->updatedby;
$data['bomline__created'] = $r->created;
$data['bomline__createdby'] = $r->createdby;}
$this->load->view('bill_of_material_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['bomline__item_id']) || ($_POST['bomline__item_id'] == "" || $_POST['bomline__item_id'] == null  || $_POST['bomline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['bomline__quantity']) && ($_POST['bomline__quantity'] == "" || $_POST['bomline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['bomline__uom_id']) || ($_POST['bomline__uom_id'] == "" || $_POST['bomline__uom_id'] == null  || $_POST['bomline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['bomline__item_id']))
$data['item_id'] = $_POST['bomline__item_id'];if (isset($_POST['bomline__quantity']))
$data['quantity'] = $_POST['bomline__quantity'];if (isset($_POST['bomline__uom_id']))
$data['uom_id'] = $_POST['bomline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['bill_of_material_line_id']);
$this->db->update('bomline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bill_of_material_lineedit','bomline','afteredit', $_POST['bill_of_material_line_id']);
			
			
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