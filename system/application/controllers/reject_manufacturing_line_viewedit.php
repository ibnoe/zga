<?php

class reject_manufacturing_line_viewedit extends Controller {

	function reject_manufacturing_line_viewedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($reject_manufacturing_line_view_id=0)
	{
		if ($reject_manufacturing_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $reject_manufacturing_line_view_id);
$this->db->select('*');
$q = $this->db->get('rejectmanufacturingline');
if ($q->num_rows() > 0) {
$data = array();
$data['reject_manufacturing_line_view_id'] = $reject_manufacturing_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rejectmanufacturingline__item_id'] = $r->item_id;
$data['rejectmanufacturingline__quantitytoprocess'] = $r->quantitytoprocess;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['rejectmanufacturingline__uom_id'] = $r->uom_id;
$data['rejectmanufacturingline__manufacturingorderdoneline_id'] = $r->manufacturingorderdoneline_id;
$data['rejectmanufacturingline__lastupdate'] = $r->lastupdate;
$data['rejectmanufacturingline__updatedby'] = $r->updatedby;
$data['rejectmanufacturingline__created'] = $r->created;
$data['rejectmanufacturingline__createdby'] = $r->createdby;}
$this->load->view('reject_manufacturing_line_view_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['rejectmanufacturingline__item_id']) || ($_POST['rejectmanufacturingline__item_id'] == "" || $_POST['rejectmanufacturingline__item_id'] == null  || $_POST['rejectmanufacturingline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['rejectmanufacturingline__quantitytoprocess']) && ($_POST['rejectmanufacturingline__quantitytoprocess'] == "" || $_POST['rejectmanufacturingline__quantitytoprocess'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['rejectmanufacturingline__uom_id']) || ($_POST['rejectmanufacturingline__uom_id'] == "" || $_POST['rejectmanufacturingline__uom_id'] == null  || $_POST['rejectmanufacturingline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rejectmanufacturingline__item_id']))
$data['item_id'] = $_POST['rejectmanufacturingline__item_id'];if (isset($_POST['rejectmanufacturingline__quantitytoprocess']))
$data['quantitytoprocess'] = $_POST['rejectmanufacturingline__quantitytoprocess'];if (isset($_POST['rejectmanufacturingline__uom_id']))
$data['uom_id'] = $_POST['rejectmanufacturingline__uom_id'];if (isset($_POST['rejectmanufacturingline__manufacturingorderdoneline_id']))
$data['manufacturingorderdoneline_id'] = $_POST['rejectmanufacturingline__manufacturingorderdoneline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['reject_manufacturing_line_view_id']);
$this->db->update('rejectmanufacturingline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('reject_manufacturing_line_viewedit','rejectmanufacturingline','afteredit', $_POST['reject_manufacturing_line_view_id']);
			
			
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