<?php

class purchase_order_open_receivedview extends Controller {

	function purchase_order_open_receivedview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_open_received_id=0)
	{
		if ($purchase_order_open_received_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_order_open_received_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(estarrivaldate, "%d-%m-%Y") as estarrivaldate', false);
$q = $this->db->get('purchaseorder');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_open_received_id'] = $purchase_order_open_received_id;
foreach ($q->result() as $r) {
$data['purchaseorder__orderid'] = $r->orderid;
$data['purchaseorder__date'] = $r->date;
$suratpermintaanpembelian_opt = array();
$q = $this->db->get('suratpermintaanpembelian');
foreach ($q->result() as $row) { $suratpermintaanpembelian_opt[$row->id] = $row->orderid; }
$data['suratpermintaanpembelian_opt'] = $suratpermintaanpembelian_opt;
$data['purchaseorder__suratpermintaanpembelian_id'] = $r->suratpermintaanpembelian_id;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier_id'] = $r->supplier_id;
$data['purchaseorder__buysource'] = $r->buysource;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchaseorder__currency_id'] = $r->currency_id;
$data['purchaseorder__currencyrate'] = $r->currencyrate;
$data['purchaseorder__quote1'] = $r->quote1;
$data['purchaseorder__notes'] = $r->notes;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier2_id'] = $r->supplier2_id;
$data['purchaseorder__quote2'] = $r->quote2;
$data['purchaseorder__notes2'] = $r->notes2;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier3_id'] = $r->supplier3_id;
$data['purchaseorder__quote3'] = $r->quote3;
$data['purchaseorder__notes3'] = $r->notes3;
$forwarder_opt = array();
$q = $this->db->get('forwarder');
foreach ($q->result() as $row) { $forwarder_opt[$row->id] = $row->name; }
$data['forwarder_opt'] = $forwarder_opt;
$data['purchaseorder__forwarder_id'] = $r->forwarder_id;
$data['purchaseorder__shipmethod'] = $r->shipmethod;
$data['purchaseorder__estarrivaldate'] = $r->estarrivaldate;
$data['purchaseorder__total'] = $r->total;
$data['purchaseorder__lastupdate'] = $r->lastupdate;
$data['purchaseorder__updatedby'] = $r->updatedby;}
$this->load->view('purchase_order_open_received_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['orderid'] = $_POST['purchaseorder__orderid'];
$data['date'] = $_POST['purchaseorder__date'];
$data['suratpermintaanpembelian_id'] = $_POST['purchaseorder__suratpermintaanpembelian_id'];
$data['supplier_id'] = $_POST['purchaseorder__supplier_id'];
$data['buysource'] = $_POST['purchaseorder__buysource'];
$data['currency_id'] = $_POST['purchaseorder__currency_id'];
$data['currencyrate'] = $_POST['purchaseorder__currencyrate'];
if (isset($_FILES['quote1'])){$filepath = 'penawarandocs/'.$_FILES['quote1']['name'];move_uploaded_file($_FILES['quote1']['tmp_name'], $filepath);}
$data['quote1'] = $_POST['purchaseorder__quote1'];
$data['notes'] = $_POST['purchaseorder__notes'];
$data['supplier2_id'] = $_POST['purchaseorder__supplier2_id'];
if (isset($_FILES['quote2'])){$filepath = 'penawarandocs/'.$_FILES['quote2']['name'];move_uploaded_file($_FILES['quote2']['tmp_name'], $filepath);}
$data['quote2'] = $_POST['purchaseorder__quote2'];
$data['notes2'] = $_POST['purchaseorder__notes2'];
$data['supplier3_id'] = $_POST['purchaseorder__supplier3_id'];
if (isset($_FILES['quote3'])){$filepath = 'penawarandocs/'.$_FILES['quote3']['name'];move_uploaded_file($_FILES['quote3']['tmp_name'], $filepath);}
$data['quote3'] = $_POST['purchaseorder__quote3'];
$data['notes3'] = $_POST['purchaseorder__notes3'];
$data['forwarder_id'] = $_POST['purchaseorder__forwarder_id'];
$data['shipmethod'] = $_POST['purchaseorder__shipmethod'];
$data['estarrivaldate'] = $_POST['purchaseorder__estarrivaldate'];
$data['total'] = $_POST['purchaseorder__total'];
$data['lastupdate'] = $_POST['purchaseorder__lastupdate'];
$data['updatedby'] = $_POST['purchaseorder__updatedby'];
$this->db->where('id', $data['purchase_order_open_received_id']);
$this->db->update('purchaseorder', $data);
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