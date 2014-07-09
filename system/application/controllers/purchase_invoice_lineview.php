<?php

class purchase_invoice_lineview extends Controller {

	function purchase_invoice_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_invoice_line_id=0)
	{
		if ($purchase_invoice_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_invoice_line_id);
$this->db->select('*');
$q = $this->db->get('purchaseinvoiceline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_invoice_line_id'] = $purchase_invoice_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseinvoiceline__item_id'] = $r->item_id;
$data['purchaseinvoiceline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseinvoiceline__uom_id'] = $r->uom_id;
$data['purchaseinvoiceline__price'] = $r->price;
$data['purchaseinvoiceline__subtotal'] = $r->subtotal;
$data['purchaseinvoiceline__lastupdate'] = $r->lastupdate;
$data['purchaseinvoiceline__updatedby'] = $r->updatedby;
$data['purchaseinvoiceline__created'] = $r->created;
$data['purchaseinvoiceline__createdby'] = $r->createdby;}
$this->load->view('purchase_invoice_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['purchaseinvoiceline__item_id'];
$data['quantity'] = $_POST['purchaseinvoiceline__quantity'];
$data['uom_id'] = $_POST['purchaseinvoiceline__uom_id'];
$data['price'] = $_POST['purchaseinvoiceline__price'];
$data['subtotal'] = $_POST['purchaseinvoiceline__subtotal'];
$data['lastupdate'] = $_POST['purchaseinvoiceline__lastupdate'];
$data['updatedby'] = $_POST['purchaseinvoiceline__updatedby'];
$data['created'] = $_POST['purchaseinvoiceline__created'];
$data['createdby'] = $_POST['purchaseinvoiceline__createdby'];
$this->db->where('id', $data['purchase_invoice_line_id']);
$this->db->update('purchaseinvoiceline', $data);
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