<?php

class purchase_invoiceview extends Controller {

	function purchase_invoiceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_invoice_id=0)
	{
		if ($purchase_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_invoice_id'] = $purchase_invoice_id;
foreach ($q->result() as $r) {
$data['purchaseinvoice__date'] = $r->date;
$data['purchaseinvoice__orderid'] = $r->orderid;
$receiveditem_opt = array();
$q = $this->db->get('receiveditem');
foreach ($q->result() as $row) { $receiveditem_opt[$row->id] = $row->suratjalanno; }
$data['receiveditem_opt'] = $receiveditem_opt;
$data['purchaseinvoice__receiveditem_id'] = $r->receiveditem_id;
$data['purchaseinvoice__total'] = $r->total;
$data['purchaseinvoice__top'] = $r->top;
$ongkoskirimimport_opt = array();
$q = $this->db->get('ongkoskirimimport');
foreach ($q->result() as $row) { $ongkoskirimimport_opt[$row->id] = $row->idstring; }
$data['ongkoskirimimport_opt'] = $ongkoskirimimport_opt;
$data['purchaseinvoice__ongkoskirimimport_id'] = $r->ongkoskirimimport_id;
$data['purchaseinvoice__lastupdate'] = $r->lastupdate;
$data['purchaseinvoice__updatedby'] = $r->updatedby;
$data['purchaseinvoice__created'] = $r->created;
$data['purchaseinvoice__createdby'] = $r->createdby;}
$this->load->view('purchase_invoice_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['purchaseinvoice__date'];
$data['orderid'] = $_POST['purchaseinvoice__orderid'];
$data['receiveditem_id'] = $_POST['purchaseinvoice__receiveditem_id'];
$data['total'] = $_POST['purchaseinvoice__total'];
$data['top'] = $_POST['purchaseinvoice__top'];
$data['ongkoskirimimport_id'] = $_POST['purchaseinvoice__ongkoskirimimport_id'];
$data['lastupdate'] = $_POST['purchaseinvoice__lastupdate'];
$data['updatedby'] = $_POST['purchaseinvoice__updatedby'];
$data['created'] = $_POST['purchaseinvoice__created'];
$data['createdby'] = $_POST['purchaseinvoice__createdby'];
$this->db->where('id', $data['purchase_invoice_id']);
$this->db->update('purchaseinvoice', $data);
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