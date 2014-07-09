<?php

class sales_order_line_serviceview extends Controller {

	function sales_order_line_serviceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_order_line_service_id=0)
	{
		if ($sales_order_line_service_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_order_line_service_id);
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_order_line_service_id'] = $sales_order_line_service_id;
foreach ($q->result() as $r) {
$rcn_opt = array();
$q = $this->db->get('rcn');
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['salesorderline__rcn_id'] = $r->rcn_id;
$data['salesorderline__quantity'] = $r->quantity;
$data['salesorderline__price'] = $r->price;
$data['salesorderline__pdisc'] = $r->pdisc;
$data['salesorderline__subtotal'] = $r->subtotal;
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('sales_order_line_service_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['rcn_id'] = $_POST['salesorderline__rcn_id'];
$data['quantity'] = $_POST['salesorderline__quantity'];
$data['price'] = $_POST['salesorderline__price'];
$data['pdisc'] = $_POST['salesorderline__pdisc'];
$data['subtotal'] = $_POST['salesorderline__subtotal'];
$data['lastupdate'] = $_POST['salesorderline__lastupdate'];
$data['updatedby'] = $_POST['salesorderline__updatedby'];
$data['created'] = $_POST['salesorderline__created'];
$data['createdby'] = $_POST['salesorderline__createdby'];
$this->db->where('id', $data['sales_order_line_service_id']);
$this->db->update('salesorderline', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>