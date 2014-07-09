<?php

class purchase_return_order_open_sentview extends Controller {

	function purchase_return_order_open_sentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_open_sent_id=0)
	{
		if ($purchase_return_order_open_sent_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_order_open_sent_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchasereturnorder');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_open_sent_id'] = $purchase_return_order_open_sent_id;
foreach ($q->result() as $r) {
$data['purchasereturnorder__date'] = $r->date;
$data['purchasereturnorder__purchasereturnorderid'] = $r->purchasereturnorderid;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnorder__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnorder__currency_id'] = $r->currency_id;
$data['purchasereturnorder__currencyrate'] = $r->currencyrate;
$data['purchasereturnorder__notes'] = $r->notes;
$data['purchasereturnorder__lastupdate'] = $r->lastupdate;
$data['purchasereturnorder__updatedby'] = $r->updatedby;}
$this->load->view('purchase_return_order_open_sent_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchasereturnorder__date'];
$data['purchasereturnorderid'] = $_POST['purchasereturnorder__purchasereturnorderid'];
$data['supplier_id'] = $_POST['purchasereturnorder__supplier_id'];
$data['currency_id'] = $_POST['purchasereturnorder__currency_id'];
$data['currencyrate'] = $_POST['purchasereturnorder__currencyrate'];
$data['notes'] = $_POST['purchasereturnorder__notes'];
$data['lastupdate'] = $_POST['purchasereturnorder__lastupdate'];
$data['updatedby'] = $_POST['purchasereturnorder__updatedby'];
$this->db->where('id', $data['purchase_return_order_open_sent_id']);
$this->db->update('purchasereturnorder', $data);
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