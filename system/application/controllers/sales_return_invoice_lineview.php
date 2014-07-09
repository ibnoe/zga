<?php

class sales_return_invoice_lineview extends Controller {

	function sales_return_invoice_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_invoice_line_id=0)
	{
		if ($sales_return_invoice_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_return_invoice_line_id);
$this->db->select('*');
$q = $this->db->get('salesreturninvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_invoice_line_id'] = $sales_return_invoice_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesreturninvoiceline__item_id'] = $r->item_id;
$data['salesreturninvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturninvoiceline__uom_id'] = $r->uom_id;
$data['salesreturninvoiceline__price'] = $r->price;
$data['salesreturninvoiceline__subtotal'] = $r->subtotal;
$data['salesreturninvoiceline__lastupdate'] = $r->lastupdate;
$data['salesreturninvoiceline__updatedby'] = $r->updatedby;
$data['salesreturninvoiceline__created'] = $r->created;
$data['salesreturninvoiceline__createdby'] = $r->createdby;}
$this->load->view('sales_return_invoice_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['salesreturninvoiceline__item_id'];
$data['quantity'] = $_POST['salesreturninvoiceline__quantity'];
$data['uom_id'] = $_POST['salesreturninvoiceline__uom_id'];
$data['price'] = $_POST['salesreturninvoiceline__price'];
$data['subtotal'] = $_POST['salesreturninvoiceline__subtotal'];
$data['lastupdate'] = $_POST['salesreturninvoiceline__lastupdate'];
$data['updatedby'] = $_POST['salesreturninvoiceline__updatedby'];
$data['created'] = $_POST['salesreturninvoiceline__created'];
$data['createdby'] = $_POST['salesreturninvoiceline__createdby'];
$this->db->where('id', $data['sales_return_invoice_line_id']);
$this->db->update('salesreturninvoiceline', $data);
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