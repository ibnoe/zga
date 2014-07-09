<?php

class purchase_return_payment_line_viewedit extends Controller {

	function purchase_return_payment_line_viewedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_payment_line_view_id=0)
	{
		if ($purchase_return_payment_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_payment_line_view_id);
$this->db->select('*');
$q = $this->db->get('purchasereturnpaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_payment_line_view_id'] = $purchase_return_payment_line_view_id;
foreach ($q->result() as $r) {
$purchasereturninvoice_opt = array();
$purchasereturninvoice_opt[''] = 'None';
$q = $this->db->get('purchasereturninvoice');
foreach ($q->result() as $row) { $purchasereturninvoice_opt[$row->id] = $row->purchasereturninvoiceid; }
$data['purchasereturninvoice_opt'] = $purchasereturninvoice_opt;
$data['purchasereturnpaymentline__purchasereturninvoice_id'] = $r->purchasereturninvoice_id;
$data['purchasereturnpaymentline__lastupdate'] = $r->lastupdate;
$data['purchasereturnpaymentline__updatedby'] = $r->updatedby;
$data['purchasereturnpaymentline__created'] = $r->created;
$data['purchasereturnpaymentline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_payment_line_view_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnpaymentline__purchasereturninvoice_id']))
$data['purchasereturninvoice_id'] = $_POST['purchasereturnpaymentline__purchasereturninvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_payment_line_view_id']);
$this->db->update('purchasereturnpaymentline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_payment_line_viewedit','purchasereturnpaymentline','afteredit', $_POST['purchase_return_payment_line_view_id']);
			
			
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