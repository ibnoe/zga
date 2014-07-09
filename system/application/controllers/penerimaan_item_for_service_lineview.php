<?php

class penerimaan_item_for_service_lineview extends Controller {

	function penerimaan_item_for_service_lineview()
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
	
		
$this->db->where('id', $penerimaan_item_for_service_line_id);
$this->db->select('*');
$q = $this->db->get('insertitemline');
if ($q->num_rows() > 0) {
$data = array();
$data['penerimaan_item_for_service_line_id'] = $penerimaan_item_for_service_line_id;
foreach ($q->result() as $r) {
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['insertitemline__warehouse_id'] = $r->warehouse_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['insertitemline__item_id'] = $r->item_id;
$data['insertitemline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['insertitemline__uom_id'] = $r->uom_id;
$data['insertitemline__price'] = $r->price;
$data['insertitemline__lastupdate'] = $r->lastupdate;
$data['insertitemline__updatedby'] = $r->updatedby;
$data['insertitemline__created'] = $r->created;
$data['insertitemline__createdby'] = $r->createdby;}
$this->load->view('penerimaan_item_for_service_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['warehouse_id'] = $_POST['insertitemline__warehouse_id'];
$data['item_id'] = $_POST['insertitemline__item_id'];
$data['quantity'] = $_POST['insertitemline__quantity'];
$data['uom_id'] = $_POST['insertitemline__uom_id'];
$data['price'] = $_POST['insertitemline__price'];
$data['lastupdate'] = $_POST['insertitemline__lastupdate'];
$data['updatedby'] = $_POST['insertitemline__updatedby'];
$data['created'] = $_POST['insertitemline__created'];
$data['createdby'] = $_POST['insertitemline__createdby'];
$this->db->where('id', $data['penerimaan_item_for_service_line_id']);
$this->db->update('insertitemline', $data);
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