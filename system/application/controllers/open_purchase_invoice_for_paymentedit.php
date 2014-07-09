<?php

class open_purchase_invoice_for_paymentedit extends Controller {

	function open_purchase_invoice_for_paymentedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_purchase_invoice_for_payment_id=0)
	{
		if ($open_purchase_invoice_for_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_purchase_invoice_for_payment_id);
$this->db->select('*');
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['open_purchase_invoice_for_payment_id'] = $open_purchase_invoice_for_payment_id;
foreach ($q->result() as $r) {
$data['purchaseinvoice__lastupdate'] = $r->lastupdate;
$data['purchaseinvoice__updatedby'] = $r->updatedby;
$data['purchaseinvoice__created'] = $r->created;
$data['purchaseinvoice__createdby'] = $r->createdby;}
$this->load->view('open_purchase_invoice_for_payment_edit_form', $data);
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
$this->db->where('id', $_POST['open_purchase_invoice_for_payment_id']);
$this->db->update('purchaseinvoice', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_purchase_invoice_for_paymentedit','purchaseinvoice','afteredit', $_POST['open_purchase_invoice_for_payment_id']);
			
			
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