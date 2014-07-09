<?php

class sales_invoice_line_viewview extends Controller {

	function sales_invoice_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_invoice_line_view_id=0)
	{
		if ($sales_invoice_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_invoice_line_view_id);
$this->db->select('*');
$q = $this->db->get('salesinvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_invoice_line_view_id'] = $sales_invoice_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesinvoiceline__item_id'] = $r->item_id;
$data['salesinvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesinvoiceline__uom_id'] = $r->uom_id;
$data['salesinvoiceline__price'] = $r->price;
$data['salesinvoiceline__subtotal'] = $r->subtotal;
$data['salesinvoiceline__lastupdate'] = $r->lastupdate;
$data['salesinvoiceline__updatedby'] = $r->updatedby;
$data['salesinvoiceline__created'] = $r->created;
$data['salesinvoiceline__createdby'] = $r->createdby;}
$this->load->view('sales_invoice_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['salesinvoiceline__item_id'];
$data['quantity'] = $_POST['salesinvoiceline__quantity'];
$data['uom_id'] = $_POST['salesinvoiceline__uom_id'];
$data['price'] = $_POST['salesinvoiceline__price'];
$data['subtotal'] = $_POST['salesinvoiceline__subtotal'];
$data['lastupdate'] = $_POST['salesinvoiceline__lastupdate'];
$data['updatedby'] = $_POST['salesinvoiceline__updatedby'];
$data['created'] = $_POST['salesinvoiceline__created'];
$data['createdby'] = $_POST['salesinvoiceline__createdby'];
$this->db->where('id', $data['sales_invoice_line_view_id']);
$this->db->update('salesinvoiceline', $data);
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