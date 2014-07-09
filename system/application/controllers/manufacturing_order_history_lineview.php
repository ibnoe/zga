<?php

class manufacturing_order_history_lineview extends Controller {

	function manufacturing_order_history_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_history_line_id=0)
	{
		if ($manufacturing_order_history_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_order_history_line_id);
$this->db->select('*');
$q = $this->db->get('manufacturingorderdoneline');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_history_line_id'] = $manufacturing_order_history_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorderdoneline__item_id'] = $r->item_id;
$data['manufacturingorderdoneline__quantitytoprocess'] = $r->quantitytoprocess;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorderdoneline__uom_id'] = $r->uom_id;
$data['manufacturingorderdoneline__lastupdate'] = $r->lastupdate;
$data['manufacturingorderdoneline__updatedby'] = $r->updatedby;
$data['manufacturingorderdoneline__created'] = $r->created;
$data['manufacturingorderdoneline__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_history_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['manufacturingorderdoneline__item_id'];
$data['quantitytoprocess'] = $_POST['manufacturingorderdoneline__quantitytoprocess'];
$data['uom_id'] = $_POST['manufacturingorderdoneline__uom_id'];
$data['lastupdate'] = $_POST['manufacturingorderdoneline__lastupdate'];
$data['updatedby'] = $_POST['manufacturingorderdoneline__updatedby'];
$data['created'] = $_POST['manufacturingorderdoneline__created'];
$data['createdby'] = $_POST['manufacturingorderdoneline__createdby'];
$this->db->where('id', $data['manufacturing_order_history_line_id']);
$this->db->update('manufacturingorderdoneline', $data);
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