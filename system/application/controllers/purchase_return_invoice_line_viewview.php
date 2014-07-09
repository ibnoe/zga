<?php

class purchase_return_invoice_line_viewview extends Controller {

	function purchase_return_invoice_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_invoice_line_view_id=0)
	{
		if ($purchase_return_invoice_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_invoice_line_view_id);
$this->db->select('*');
$q = $this->db->get('purchasereturninvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_invoice_line_view_id'] = $purchase_return_invoice_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturninvoiceline__item_id'] = $r->item_id;
$data['purchasereturninvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturninvoiceline__uom_id'] = $r->uom_id;
$data['purchasereturninvoiceline__price'] = $r->price;
$data['purchasereturninvoiceline__subtotal'] = $r->subtotal;
$data['purchasereturninvoiceline__lastupdate'] = $r->lastupdate;
$data['purchasereturninvoiceline__updatedby'] = $r->updatedby;
$data['purchasereturninvoiceline__created'] = $r->created;
$data['purchasereturninvoiceline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_invoice_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['purchasereturninvoiceline__item_id'];
$data['quantity'] = $_POST['purchasereturninvoiceline__quantity'];
$data['uom_id'] = $_POST['purchasereturninvoiceline__uom_id'];
$data['price'] = $_POST['purchasereturninvoiceline__price'];
$data['subtotal'] = $_POST['purchasereturninvoiceline__subtotal'];
$data['lastupdate'] = $_POST['purchasereturninvoiceline__lastupdate'];
$data['updatedby'] = $_POST['purchasereturninvoiceline__updatedby'];
$data['created'] = $_POST['purchasereturninvoiceline__created'];
$data['createdby'] = $_POST['purchasereturninvoiceline__createdby'];
$this->db->where('id', $data['purchase_return_invoice_line_view_id']);
$this->db->update('purchasereturninvoiceline', $data);
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