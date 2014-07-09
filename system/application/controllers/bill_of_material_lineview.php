<?php

class bill_of_material_lineview extends Controller {

	function bill_of_material_lineview()
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
	
		
$this->db->where('id', $bill_of_material_line_id);
$this->db->select('*');
$q = $this->db->get('bomline');
if ($q->num_rows() > 0) {
$data = array();
$data['bill_of_material_line_id'] = $bill_of_material_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['bomline__item_id'] = $r->item_id;
$data['bomline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['bomline__uom_id'] = $r->uom_id;
$data['bomline__lastupdate'] = $r->lastupdate;
$data['bomline__updatedby'] = $r->updatedby;
$data['bomline__created'] = $r->created;
$data['bomline__createdby'] = $r->createdby;}
$this->load->view('bill_of_material_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['bomline__item_id'];
$data['quantity'] = $_POST['bomline__quantity'];
$data['uom_id'] = $_POST['bomline__uom_id'];
$data['lastupdate'] = $_POST['bomline__lastupdate'];
$data['updatedby'] = $_POST['bomline__updatedby'];
$data['created'] = $_POST['bomline__created'];
$data['createdby'] = $_POST['bomline__createdby'];
$this->db->where('id', $data['bill_of_material_line_id']);
$this->db->update('bomline', $data);
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