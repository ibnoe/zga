<?php

class purchase_return_order_for_invoicingedit extends Controller {

	function purchase_return_order_for_invoicingedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_for_invoicing_id=0)
	{
		if ($purchase_return_order_for_invoicing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_order_for_invoicing_id);
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_for_invoicing_id'] = $purchase_return_order_for_invoicing_id;
foreach ($q->result() as $r) {
$data['purchasereturnorderline__lastupdate'] = $r->lastupdate;
$data['purchasereturnorderline__updatedby'] = $r->updatedby;
$data['purchasereturnorderline__created'] = $r->created;
$data['purchasereturnorderline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_order_for_invoicing_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_order_for_invoicing_id']);
$this->db->update('purchasereturnorderline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_order_for_invoicingedit','purchasereturnorderline','afteredit', $_POST['purchase_return_order_for_invoicing_id']);
			
			
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