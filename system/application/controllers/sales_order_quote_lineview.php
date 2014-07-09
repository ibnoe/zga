<?php

class sales_order_quote_lineview extends Controller {

	function sales_order_quote_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_order_quote_line_id=0)
	{
		if ($sales_order_quote_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_order_quote_line_id);
$this->db->select('*');
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_order_quote_line_id'] = $sales_order_quote_line_id;
foreach ($q->result() as $r) {
$data['salesorderline__type'] = $r->type;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderline__item_id'] = $r->item_id;
$data['salesorderline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderline__uom_id'] = $r->uom_id;
$data['salesorderline__price'] = $r->price;
$data['salesorderline__pdisc'] = $r->pdisc;
$data['salesorderline__subtotal'] = $r->subtotal;
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('sales_order_quote_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['type'] = $_POST['salesorderline__type'];
$data['item_id'] = $_POST['salesorderline__item_id'];
$data['quantity'] = $_POST['salesorderline__quantity'];
$data['uom_id'] = $_POST['salesorderline__uom_id'];
$data['price'] = $_POST['salesorderline__price'];
$data['pdisc'] = $_POST['salesorderline__pdisc'];
$data['subtotal'] = $_POST['salesorderline__subtotal'];
$data['lastupdate'] = $_POST['salesorderline__lastupdate'];
$data['updatedby'] = $_POST['salesorderline__updatedby'];
$data['created'] = $_POST['salesorderline__created'];
$data['createdby'] = $_POST['salesorderline__createdby'];
$this->db->where('id', $data['sales_order_quote_line_id']);
$this->db->update('salesorderline', $data);
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