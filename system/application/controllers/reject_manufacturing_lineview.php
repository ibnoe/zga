<?php

class reject_manufacturing_lineview extends Controller {

	function reject_manufacturing_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($reject_manufacturing_line_id=0)
	{
		if ($reject_manufacturing_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $reject_manufacturing_line_id);
$this->db->select('*');
$q = $this->db->get('rejectmanufacturingline');
if ($q->num_rows() > 0) {
$data = array();
$data['reject_manufacturing_line_id'] = $reject_manufacturing_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rejectmanufacturingline__item_id'] = $r->item_id;
$data['rejectmanufacturingline__quantitytoprocess'] = $r->quantitytoprocess;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['rejectmanufacturingline__uom_id'] = $r->uom_id;
$data['rejectmanufacturingline__lastupdate'] = $r->lastupdate;
$data['rejectmanufacturingline__updatedby'] = $r->updatedby;
$data['rejectmanufacturingline__created'] = $r->created;
$data['rejectmanufacturingline__createdby'] = $r->createdby;}
$this->load->view('reject_manufacturing_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['rejectmanufacturingline__item_id'];
$data['quantitytoprocess'] = $_POST['rejectmanufacturingline__quantitytoprocess'];
$data['uom_id'] = $_POST['rejectmanufacturingline__uom_id'];
$data['lastupdate'] = $_POST['rejectmanufacturingline__lastupdate'];
$data['updatedby'] = $_POST['rejectmanufacturingline__updatedby'];
$data['created'] = $_POST['rejectmanufacturingline__created'];
$data['createdby'] = $_POST['rejectmanufacturingline__createdby'];
$this->db->where('id', $data['reject_manufacturing_line_id']);
$this->db->update('rejectmanufacturingline', $data);
			validationonserver();
			
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