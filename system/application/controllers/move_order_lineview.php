<?php

class move_order_lineview extends Controller {

	function move_order_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_line_id=0)
	{
		if ($move_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $move_order_line_id);
$this->db->select('*');
$q = $this->db->get('moveorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_line_id'] = $move_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveorderline__item_id'] = $r->item_id;
$data['moveorderline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveorderline__uom_id'] = $r->uom_id;
$data['moveorderline__lastupdate'] = $r->lastupdate;
$data['moveorderline__updatedby'] = $r->updatedby;
$data['moveorderline__created'] = $r->created;
$data['moveorderline__createdby'] = $r->createdby;}
$this->load->view('move_order_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['moveorderline__item_id'];
$data['quantity'] = $_POST['moveorderline__quantity'];
$data['uom_id'] = $_POST['moveorderline__uom_id'];
$data['lastupdate'] = $_POST['moveorderline__lastupdate'];
$data['updatedby'] = $_POST['moveorderline__updatedby'];
$data['created'] = $_POST['moveorderline__created'];
$data['createdby'] = $_POST['moveorderline__createdby'];
$this->db->where('id', $data['move_order_line_id']);
$this->db->update('moveorderline', $data);
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