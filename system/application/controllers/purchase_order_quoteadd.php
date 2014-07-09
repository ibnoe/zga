<?php

class purchase_order_quoteadd extends Controller {

	function purchase_order_quoteadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchaseorderquote__orderid'] = '';
$data['purchaseorderquote__date'] = '';
$data['purchaseorderquote__notes'] = '';
$suratpermintaanpembelian_opt = array();
$q = $this->db->get('suratpermintaanpembelian');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $suratpermintaanpembelian_opt[$row->id] = $row->orderid; }
$data['suratpermintaanpembelian_opt'] = $suratpermintaanpembelian_opt;
$data['purchaseorderquote__suratpermintaanpembelian_id'] = '';
$supplier_opt = array();
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorderquote__supplier_id'] = '';
$currency_opt = array();
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchaseorderquote__currency_id'] = '';
$data['purchaseorderquote__currencyrate'] = '';
$warehouse_opt = array();
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchaseorderquote__warehouse_id'] = '';
$data['purchaseorderquote__lastupdate'] = '';
$data['purchaseorderquote__updatedby'] = '';
		

		$this->load->view('purchase_order_quote_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchaseorderquote__orderid']) && ($_POST['purchaseorderquote__orderid'] == "" || $_POST['purchaseorderquote__orderid'] == null))
$error .= "<span class='error'>No PO Quote must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquote__orderid'])) {
$this->db->where('orderid', $_POST['purchaseorderquote__orderid']);
$q = $this->db->get('purchaseorderquote');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO Quote must be unique"."</span><br>";}

if (isset($_POST['purchaseorderquote__date']) && ($_POST['purchaseorderquote__date'] == "" || $_POST['purchaseorderquote__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquote__suratpermintaanpembelian_id']) && ($_POST['purchaseorderquote__suratpermintaanpembelian_id'] == "" || $_POST['purchaseorderquote__suratpermintaanpembelian_id'] == null))
$error .= "<span class='error'>SPP must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquote__supplier_id']) && ($_POST['purchaseorderquote__supplier_id'] == "" || $_POST['purchaseorderquote__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquote__currency_id']) && ($_POST['purchaseorderquote__currency_id'] == "" || $_POST['purchaseorderquote__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquote__warehouse_id']) && ($_POST['purchaseorderquote__warehouse_id'] == "" || $_POST['purchaseorderquote__warehouse_id'] == null))
$error .= "<span class='error'>Ship To Location must not be empty"."</span><br>";

$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_order_quoteadd','purchaseorderquote','validation', 0, $_POST);
		
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
$this->db->insert('purchaseorderquote', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorderquote_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_quoteadd','purchaseorderquote','aftersave', $purchaseorderquote_id);
	
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>