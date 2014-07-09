<?php

class purchase_orderadd extends Controller {

	function purchase_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchaseorder__orderid'] = '';$this->load->library('generallib');
$data['purchaseorder__orderid'] = $this->generallib->genId('Purchase Order');
$data['purchaseorder__date'] = '';
$suratpermintaanpembelian_opt = array();
$suratpermintaanpembelian_opt[''] = 'None';
$q = $this->db->get('suratpermintaanpembelian');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $suratpermintaanpembelian_opt[$row->id] = $row->orderid; }
$data['suratpermintaanpembelian_opt'] = $suratpermintaanpembelian_opt;
$data['purchaseorder__suratpermintaanpembelian_id'] = '';
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier_id'] = '';
$data['purchaseorder__buysource'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchaseorder__currency_id'] = '';
$data['purchaseorder__currencyrate'] = '';
$data['purchaseorder__quote1'] = '';
$data['purchaseorder__notes'] = '';
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier2_id'] = '';
$data['purchaseorder__quote2'] = '';
$data['purchaseorder__notes2'] = '';
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchaseorder__supplier3_id'] = '';
$data['purchaseorder__quote3'] = '';
$data['purchaseorder__notes3'] = '';
$forwarder_opt = array();
$forwarder_opt[''] = 'None';
$q = $this->db->get('forwarder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $forwarder_opt[$row->id] = $row->name; }
$data['forwarder_opt'] = $forwarder_opt;
$data['purchaseorder__forwarder_id'] = '';
$data['purchaseorder__shipmethod'] = '';
$data['purchaseorder__lastupdate'] = '';
$data['purchaseorder__updatedby'] = '';
$data['purchaseorder__created'] = '';
$data['purchaseorder__createdby'] = '';
		

		$this->load->view('purchase_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchaseorder__orderid']) && ($_POST['purchaseorder__orderid'] == "" || $_POST['purchaseorder__orderid'] == null))
$error .= "<span class='error'>PO ID must not be empty"."</span><br>";

if (isset($_POST['purchaseorder__orderid'])) {
$this->db->where('orderid', $_POST['purchaseorder__orderid']);
$q = $this->db->get('purchaseorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>PO ID must be unique"."</span><br>";}

if (isset($_POST['purchaseorder__date']) && ($_POST['purchaseorder__date'] == "" || $_POST['purchaseorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['purchaseorder__supplier_id']) || ($_POST['purchaseorder__supplier_id'] == "" || $_POST['purchaseorder__supplier_id'] == null  || $_POST['purchaseorder__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchaseorder__currency_id']) || ($_POST['purchaseorder__currency_id'] == "" || $_POST['purchaseorder__currency_id'] == null  || $_POST['purchaseorder__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseorder__orderid']))
$data['orderid'] = $_POST['purchaseorder__orderid'];

;if (isset($_POST['purchaseorder__suratpermintaanpembelian_id']))
$data['suratpermintaanpembelian_id'] = $_POST['purchaseorder__suratpermintaanpembelian_id'];if (isset($_POST['purchaseorder__supplier_id']))
$data['supplier_id'] = $_POST['purchaseorder__supplier_id'];if (isset($_POST['purchaseorder__buysource']))
$data['buysource'] = $_POST['purchaseorder__buysource'];if (isset($_POST['purchaseorder__currency_id']))
$data['currency_id'] = $_POST['purchaseorder__currency_id'];if (isset($_POST['purchaseorder__currencyrate']))
$data['currencyrate'] = $_POST['purchaseorder__currencyrate'];
if (isset($_FILES['purchaseorder__quote1'])){$filepath = 'upload//'.$_FILES['purchaseorder__quote1']['name'];move_uploaded_file($_FILES['purchaseorder__quote1']['tmp_name'], $filepath);$data['quote1'] = $_FILES['purchaseorder__quote1']['name'];}if (isset($_POST['purchaseorder__notes']))
$data['notes'] = $_POST['purchaseorder__notes'];if (isset($_POST['purchaseorder__supplier2_id']))
$data['supplier2_id'] = $_POST['purchaseorder__supplier2_id'];
if (isset($_FILES['purchaseorder__quote2'])){$filepath = 'upload//'.$_FILES['purchaseorder__quote2']['name'];move_uploaded_file($_FILES['purchaseorder__quote2']['tmp_name'], $filepath);$data['quote2'] = $_FILES['purchaseorder__quote2']['name'];}if (isset($_POST['purchaseorder__notes2']))
$data['notes2'] = $_POST['purchaseorder__notes2'];if (isset($_POST['purchaseorder__supplier3_id']))
$data['supplier3_id'] = $_POST['purchaseorder__supplier3_id'];
if (isset($_FILES['purchaseorder__quote3'])){$filepath = 'upload//'.$_FILES['purchaseorder__quote3']['name'];move_uploaded_file($_FILES['purchaseorder__quote3']['tmp_name'], $filepath);$data['quote3'] = $_FILES['purchaseorder__quote3']['name'];}if (isset($_POST['purchaseorder__notes3']))
$data['notes3'] = $_POST['purchaseorder__notes3'];if (isset($_POST['purchaseorder__forwarder_id']))
$data['forwarder_id'] = $_POST['purchaseorder__forwarder_id'];if (isset($_POST['purchaseorder__shipmethod']))
$data['shipmethod'] = $_POST['purchaseorder__shipmethod'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');


$this->db->set('date', "str_to_date('".$_POST['purchaseorder__date']."', '%d-%m-%Y')", false);
$this->db->insert('purchaseorder', $data);


$this->db->set('date', "str_to_date('".$_POST['purchaseorder__date']."', '%d-%m-%Y')", false);
//$this->db->update('purchaseorder');

$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorder_id = $this->db->insert_id();
$this->load->library('generallib');
//$this->generallib->commonfunction('purchase_orderadd','purchaseorder','aftersave', $purchaseorder_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('purchaseorder__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
//$error .= $this->generallib->commonfunction('purchase_orderadd','purchaseorder','validation', 0, $valdata);
		echo $this->db->last_query();
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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