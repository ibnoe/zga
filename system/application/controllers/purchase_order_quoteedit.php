<?php

class purchase_order_quoteedit extends Controller {

	function purchase_order_quoteedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_quote_id=0)
	{
		if ($purchase_order_quote_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_order_quote_id);
$q = $this->db->get('purchaseorderquote');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_quote_id'] = $purchase_order_quote_id;
foreach ($q->result() as $r) {
$data['purchaseorderquote__orderid'] = $r->orderid;
$data['purchaseorderquote__date'] = $r->date;
$data['purchaseorderquote__notes'] = $r->notes;
$suratpermintaanpembelian_opt = array();
$q = $this->db->get('suratpermintaanpembelian');
foreach ($q->result() as $row) { $suratpermintaanpembelian_opt[$row->id] = $row->orderid; }
$data['suratpermintaanpembelian_opt'] = $suratpermintaanpembelian_opt;
$data['purchaseorderquote__suratpermintaanpembelian_id'] = $r->suratpermintaanpembelian_id;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorderquote__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchaseorderquote__currency_id'] = $r->currency_id;
$data['purchaseorderquote__currencyrate'] = $r->currencyrate;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchaseorderquote__warehouse_id'] = $r->warehouse_id;
$data['purchaseorderquote__lastupdate'] = $r->lastupdate;
$data['purchaseorderquote__updatedby'] = $r->updatedby;}
$this->load->view('purchase_order_quote_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['purchaseorderquote__orderid'])) {$this->db->where("id !=", $_POST['purchase_order_quote_id']);
$this->db->where('orderid', $_POST['purchaseorderquote__orderid']);
$q = $this->db->get('purchaseorderquote');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO Quote must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseorderquote__orderid']))
$data['orderid'] = $_POST['purchaseorderquote__orderid'];if (isset($_POST['purchaseorderquote__date']))
$data['date'] = $_POST['purchaseorderquote__date'];if (isset($_POST['purchaseorderquote__notes']))
$data['notes'] = $_POST['purchaseorderquote__notes'];if (isset($_POST['purchaseorderquote__suratpermintaanpembelian_id']))
$data['suratpermintaanpembelian_id'] = $_POST['purchaseorderquote__suratpermintaanpembelian_id'];if (isset($_POST['purchaseorderquote__supplier_id']))
$data['supplier_id'] = $_POST['purchaseorderquote__supplier_id'];if (isset($_POST['purchaseorderquote__currency_id']))
$data['currency_id'] = $_POST['purchaseorderquote__currency_id'];if (isset($_POST['purchaseorderquote__currencyrate']))
$data['currencyrate'] = $_POST['purchaseorderquote__currencyrate'];if (isset($_POST['purchaseorderquote__warehouse_id']))
$data['warehouse_id'] = $_POST['purchaseorderquote__warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_order_quote_id']);
$this->db->update('purchaseorderquote', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_quoteedit','purchaseorderquote','aftersave');
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>