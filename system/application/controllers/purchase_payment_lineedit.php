<?php

class purchase_payment_lineedit extends Controller {

	function purchase_payment_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_payment_line_id=0)
	{
		if ($purchase_payment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_payment_line_id);
$this->db->select('*');
$q = $this->db->get('purchasepaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_payment_line_id'] = $purchase_payment_line_id;
foreach ($q->result() as $r) {
$purchaseinvoice_opt = array();
$purchaseinvoice_opt[''] = 'None';
$q = $this->db->get('purchaseinvoice');
foreach ($q->result() as $row) { $purchaseinvoice_opt[$row->id] = $row->orderid; }
$data['purchaseinvoice_opt'] = $purchaseinvoice_opt;
$data['purchasepaymentline__purchaseinvoice_id'] = $r->purchaseinvoice_id;
$data['purchasepaymentline__lastupdate'] = $r->lastupdate;
$data['purchasepaymentline__updatedby'] = $r->updatedby;
$data['purchasepaymentline__created'] = $r->created;
$data['purchasepaymentline__createdby'] = $r->createdby;}
$this->load->view('purchase_payment_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasepaymentline__purchaseinvoice_id']))
$data['purchaseinvoice_id'] = $_POST['purchasepaymentline__purchaseinvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_payment_line_id']);
$this->db->update('purchasepaymentline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_payment_lineedit','purchasepaymentline','afteredit', $_POST['purchase_payment_line_id']);
			
			
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