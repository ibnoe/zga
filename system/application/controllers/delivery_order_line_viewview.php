<?php

class delivery_order_line_viewview extends Controller {

	function delivery_order_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($delivery_order_line_view_id=0)
	{
		if ($delivery_order_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $delivery_order_line_view_id);
$this->db->select('*');
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['delivery_order_line_view_id'] = $delivery_order_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['deliveryorderline__item_id'] = $r->item_id;
$data['deliveryorderline__quantitytosend'] = $r->quantitytosend;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['deliveryorderline__uom_id'] = $r->uom_id;
$data['deliveryorderline__lastupdate'] = $r->lastupdate;
$data['deliveryorderline__updatedby'] = $r->updatedby;
$data['deliveryorderline__created'] = $r->created;
$data['deliveryorderline__createdby'] = $r->createdby;}
$this->load->view('delivery_order_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['deliveryorderline__item_id'];
$data['quantitytosend'] = $_POST['deliveryorderline__quantitytosend'];
$data['uom_id'] = $_POST['deliveryorderline__uom_id'];
$data['lastupdate'] = $_POST['deliveryorderline__lastupdate'];
$data['updatedby'] = $_POST['deliveryorderline__updatedby'];
$data['created'] = $_POST['deliveryorderline__created'];
$data['createdby'] = $_POST['deliveryorderline__createdby'];
$this->db->where('id', $data['delivery_order_line_view_id']);
$this->db->update('deliveryorderline', $data);
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