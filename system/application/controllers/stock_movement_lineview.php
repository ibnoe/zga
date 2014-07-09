<?php

class stock_movement_lineview extends Controller {

	function stock_movement_lineview()
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
	
		
$this->db->where('id', $stock_movement_line_id);
$this->db->select('*');
$q = $this->db->get('moveactionline');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_movement_line_id'] = $stock_movement_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveactionline__item_id'] = $r->item_id;
$data['moveactionline__quantitytomove'] = $r->quantitytomove;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveactionline__uom_id'] = $r->uom_id;
$data['moveactionline__lastupdate'] = $r->lastupdate;
$data['moveactionline__updatedby'] = $r->updatedby;
$data['moveactionline__created'] = $r->created;
$data['moveactionline__createdby'] = $r->createdby;}
$this->load->view('stock_movement_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['moveactionline__item_id'];
$data['quantitytomove'] = $_POST['moveactionline__quantitytomove'];
$data['uom_id'] = $_POST['moveactionline__uom_id'];
$data['lastupdate'] = $_POST['moveactionline__lastupdate'];
$data['updatedby'] = $_POST['moveactionline__updatedby'];
$data['created'] = $_POST['moveactionline__created'];
$data['createdby'] = $_POST['moveactionline__createdby'];
$this->db->where('id', $data['stock_movement_line_id']);
$this->db->update('moveactionline', $data);
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