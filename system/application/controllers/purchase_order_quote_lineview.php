<?php

class purchase_order_quote_lineview extends Controller {

	function purchase_order_quote_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_quote_line_id=0)
	{
		if ($purchase_order_quote_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_order_quote_line_id);
$q = $this->db->get('purchaseorderquoteline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_quote_line_id'] = $purchase_order_quote_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderquoteline__item_id'] = $r->item_id;
$data['purchaseorderquoteline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderquoteline__uom_id'] = $r->uom_id;
$data['purchaseorderquoteline__price'] = $r->price;
$data['purchaseorderquoteline__subtotal'] = $r->subtotal;
$data['purchaseorderquoteline__lastupdate'] = $r->lastupdate;
$data['purchaseorderquoteline__updatedby'] = $r->updatedby;}
$this->load->view('purchase_order_quote_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['purchaseorderquoteline__item_id'];
$data['quantity'] = $_POST['purchaseorderquoteline__quantity'];
$data['uom_id'] = $_POST['purchaseorderquoteline__uom_id'];
$data['price'] = $_POST['purchaseorderquoteline__price'];
$data['subtotal'] = $_POST['purchaseorderquoteline__subtotal'];
$data['lastupdate'] = $_POST['purchaseorderquoteline__lastupdate'];
$data['updatedby'] = $_POST['purchaseorderquoteline__updatedby'];
$this->db->where('id', $data['purchase_order_quote_line_id']);
$this->db->update('purchaseorderquoteline', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>