<?php

class open_order_for_invoicingview extends Controller {

	function open_order_for_invoicingview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_order_for_invoicing_id=0)
	{
		if ($open_order_for_invoicing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_order_for_invoicing_id);
$this->db->select('*');
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['open_order_for_invoicing_id'] = $open_order_for_invoicing_id;
foreach ($q->result() as $r) {
$data['purchaseorderline__lastupdate'] = $r->lastupdate;
$data['purchaseorderline__updatedby'] = $r->updatedby;
$data['purchaseorderline__created'] = $r->created;
$data['purchaseorderline__createdby'] = $r->createdby;}
$this->load->view('open_order_for_invoicing_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['purchaseorderline__lastupdate'];
$data['updatedby'] = $_POST['purchaseorderline__updatedby'];
$data['created'] = $_POST['purchaseorderline__created'];
$data['createdby'] = $_POST['purchaseorderline__createdby'];
$this->db->where('id', $data['open_order_for_invoicing_id']);
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