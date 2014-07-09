<?php

class purchase_order_lineview extends Controller {

	function purchase_order_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_line_id=0)
	{
		if ($purchase_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_order_line_id);
$this->db->select('*');
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_line_id'] = $purchase_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderline__item_id'] = $r->item_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchaseorderline__warehouse_id'] = $r->warehouse_id;
$data['purchaseorderline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderline__uom_id'] = $r->uom_id;
$data['purchaseorderline__price'] = $r->price;
$data['purchaseorderline__hasppn'] = $r->hasppn;
$data['purchaseorderline__pph'] = $r->pph;
$data['purchaseorderline__subtotal'] = $r->subtotal;
$data['purchaseorderline__lastupdate'] = $r->lastupdate;
$data['purchaseorderline__updatedby'] = $r->updatedby;
$data['purchaseorderline__created'] = $r->created;
$data['purchaseorderline__createdby'] = $r->createdby;}
$this->load->view('purchase_order_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['purchaseorderline__item_id'];
$data['warehouse_id'] = $_POST['purchaseorderline__warehouse_id'];
$data['quantity'] = $_POST['purchaseorderline__quantity'];
$data['uom_id'] = $_POST['purchaseorderline__uom_id'];
$data['price'] = $_POST['purchaseorderline__price'];
$data['hasppn'] = $_POST['purchaseorderline__hasppn'];
$data['pph'] = $_POST['purchaseorderline__pph'];
$data['subtotal'] = $_POST['purchaseorderline__subtotal'];
$data['lastupdate'] = $_POST['purchaseorderline__lastupdate'];
$data['updatedby'] = $_POST['purchaseorderline__updatedby'];
$data['created'] = $_POST['purchaseorderline__created'];
$data['createdby'] = $_POST['purchaseorderline__createdby'];
$this->db->where('id', $data['purchase_order_line_id']);
$this->db->update('purchaseorderline', $data);
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