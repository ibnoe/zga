<?php

class purchase_payment_line_viewview extends Controller {

	function purchase_payment_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_payment_line_view_id=0)
	{
		if ($purchase_payment_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_payment_line_view_id);
$this->db->select('*');
$q = $this->db->get('purchasepaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_payment_line_view_id'] = $purchase_payment_line_view_id;
foreach ($q->result() as $r) {
$purchaseinvoice_opt = array();
$q = $this->db->get('purchaseinvoice');
foreach ($q->result() as $row) { $purchaseinvoice_opt[$row->id] = $row->orderid; }
$data['purchaseinvoice_opt'] = $purchaseinvoice_opt;
$data['purchasepaymentline__purchaseinvoice_id'] = $r->purchaseinvoice_id;
$data['purchasepaymentline__lastupdate'] = $r->lastupdate;
$data['purchasepaymentline__updatedby'] = $r->updatedby;
$data['purchasepaymentline__created'] = $r->created;
$data['purchasepaymentline__createdby'] = $r->createdby;}
$this->load->view('purchase_payment_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['purchaseinvoice_id'] = $_POST['purchasepaymentline__purchaseinvoice_id'];
$data['lastupdate'] = $_POST['purchasepaymentline__lastupdate'];
$data['updatedby'] = $_POST['purchasepaymentline__updatedby'];
$data['created'] = $_POST['purchasepaymentline__created'];
$data['createdby'] = $_POST['purchasepaymentline__createdby'];
$this->db->where('id', $data['purchase_payment_line_view_id']);
$this->db->update('purchasepaymentline', $data);
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