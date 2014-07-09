<?php

class delivery_orderadd extends Controller {

	function delivery_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['deliveryorder__date'] = '';
$data['deliveryorder__orderid'] = '';$this->load->library('generallib');
$data['deliveryorder__orderid'] = $this->generallib->genId('Delivery Order');
$data['deliveryorder__donum'] = '';
$data['deliveryorder__dodate'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['deliveryorder__customer_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['deliveryorder__warehouse_id'] = '';
$data['deliveryorder__deliveredby'] = '';
$data['deliveryorder__vehicleno'] = '';
$data['deliveryorder__notes'] = '';
$data['deliveryorder__lastupdate'] = '';
$data['deliveryorder__updatedby'] = '';
$data['deliveryorder__created'] = '';
$data['deliveryorder__createdby'] = '';if (isset($_POST['date'])){$data['deliveryorder__date'] = $_POST['date'];}if (isset($_POST['orderid'])){$data['deliveryorder__orderid'] = $_POST['orderid'];}if (isset($_POST['donum'])){$data['deliveryorder__donum'] = $_POST['donum'];}if (isset($_POST['dodate'])){$data['deliveryorder__dodate'] = $_POST['dodate'];}if (isset($_POST['customer_id'])){$data['deliveryorder__customer_id'] = $_POST['customer_id'];}if (isset($_POST['warehouse_id'])){$data['deliveryorder__warehouse_id'] = $_POST['warehouse_id'];}if (isset($_POST['deliveredby'])){$data['deliveryorder__deliveredby'] = $_POST['deliveredby'];}if (isset($_POST['vehicleno'])){$data['deliveryorder__vehicleno'] = $_POST['vehicleno'];}if (isset($_POST['notes'])){$data['deliveryorder__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate'])){$data['deliveryorder__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby'])){$data['deliveryorder__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created'])){$data['deliveryorder__created'] = $_POST['created'];}if (isset($_POST['createdby'])){$data['deliveryorder__createdby'] = $_POST['createdby'];}
if (!isset($_POST['salesorderline__id'])) { echo 'You must at least tick one option'; return; }
$salesorderline_ids = $_POST['salesorderline__id'];
$linedata = array();
foreach ($salesorderline_ids as $salesorderline_id)
{
$this->db->where('id', $salesorderline_id);
$qq = $this->db->get('salesorderline');
if (isset($qq->row()->customer_id)) {
if ($data['deliveryorder__customer_id'] > 0 && $data['deliveryorder__customer_id'] != $qq->row()->customer_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['deliveryorder__customer_id'] = $qq->row()->customer_id;
}
if (isset($qq->row()->warehouse_id)) {
if ($data['deliveryorder__warehouse_id'] > 0 && $data['deliveryorder__warehouse_id'] != $qq->row()->warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['deliveryorder__warehouse_id'] = $qq->row()->warehouse_id;
}
if (isset($qq->row()->item_id))
$linedata['deliveryorderline__item_id'] = $qq->row()->item_id;
else
$linedata['deliveryorderline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytosend))
$linedata['deliveryorderline__quantitytosend'] = $qq->row()->quantitytosend;
else
$linedata['deliveryorderline__quantitytosend'] = null;
if (isset($qq->row()->uom_id))
$linedata['deliveryorderline__uom_id'] = $qq->row()->uom_id;
else
$linedata['deliveryorderline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->salesorderline_id))
$linedata['deliveryorderline__salesorderline_id'] = $qq->row()->salesorderline_id;
else
$linedata['deliveryorderline__salesorderline_id'] = null;
$salesorderline_opt = array();
$salesorderline_opt[''] = 'None';
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesorderline_opt[$row->id] = $row->orderid; }
$data['salesorderline_opt'] = $salesorderline_opt;
if (isset($qq->row()->lastupdate))
$linedata['deliveryorderline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['deliveryorderline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['deliveryorderline__updatedby'] = $qq->row()->updatedby;
else
$linedata['deliveryorderline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['deliveryorderline__created'] = $qq->row()->created;
else
$linedata['deliveryorderline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['deliveryorderline__createdby'] = $qq->row()->createdby;
else
$linedata['deliveryorderline__createdby'] = null;
$linedata['deliveryorderline__salesorderline_id'] = $salesorderline_id;
$data['deliveryorderline_data'][$salesorderline_id] = $linedata;
}
		

		$this->load->view('delivery_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['deliveryorder__date']) && ($_POST['deliveryorder__date'] == "" || $_POST['deliveryorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid']) && ($_POST['deliveryorder__orderid'] == "" || $_POST['deliveryorder__orderid'] == null))
$error .= "<span class='error'>Delivery Order No must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid'])) {
$this->db->where('orderid', $_POST['deliveryorder__orderid']);
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Delivery Order No must be unique"."</span><br>";}

if (isset($_POST['deliveryorder__dodate']) && ($_POST['deliveryorder__dodate'] == "" || $_POST['deliveryorder__dodate'] == null))
$error .= "<span class='error'>DO Date must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__customer_id']) || ($_POST['deliveryorder__customer_id'] == "" || $_POST['deliveryorder__customer_id'] == null  || $_POST['deliveryorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__warehouse_id']) || ($_POST['deliveryorder__warehouse_id'] == "" || $_POST['deliveryorder__warehouse_id'] == null  || $_POST['deliveryorder__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('deliveryorder__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('delivery_orderadd','deliveryorder','validation', 0, $valdata);
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['deliveryorder__date']))
$data['date'] = $_POST['deliveryorder__date'];if (isset($_POST['deliveryorder__orderid']))
$data['orderid'] = $_POST['deliveryorder__orderid'];if (isset($_POST['deliveryorder__donum']))
$data['donum'] = $_POST['deliveryorder__donum'];if (isset($_POST['deliveryorder__dodate']))
$data['dodate'] = $_POST['deliveryorder__dodate'];if (isset($_POST['deliveryorder__customer_id']))
$data['customer_id'] = $_POST['deliveryorder__customer_id'];if (isset($_POST['deliveryorder__warehouse_id']))
$data['warehouse_id'] = $_POST['deliveryorder__warehouse_id'];if (isset($_POST['deliveryorder__deliveredby']))
$data['deliveredby'] = $_POST['deliveryorder__deliveredby'];if (isset($_POST['deliveryorder__vehicleno']))
$data['vehicleno'] = $_POST['deliveryorder__vehicleno'];if (isset($_POST['deliveryorder__notes']))
$data['notes'] = $_POST['deliveryorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('deliveryorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$deliveryorder_id = $this->db->insert_id();


$length = count($_POST['deliveryorderline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['deliveryorderline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['deliveryorderline__item_id'][$i];
if (isset($_POST['deliveryorderline__quantitytosend'][$i]))
$coldata[$i]['quantitytosend'] = $_POST['deliveryorderline__quantitytosend'][$i];
if (isset($_POST['deliveryorderline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['deliveryorderline__uom_id'][$i];
if (isset($_POST['deliveryorderline__salesorderline_id'][$i]))
$coldata[$i]['salesorderline_id'] = $_POST['deliveryorderline__salesorderline_id'][$i];
if (isset($_POST['deliveryorderline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['deliveryorderline__lastupdate'][$i];
if (isset($_POST['deliveryorderline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['deliveryorderline__updatedby'][$i];
if (isset($_POST['deliveryorderline__created'][$i]))
$coldata[$i]['created'] = $_POST['deliveryorderline__created'][$i];
if (isset($_POST['deliveryorderline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['deliveryorderline__createdby'][$i];
$coldata[$i]['deliveryorder_id'] = $deliveryorder_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('deliveryorderline', $linedata);
}
$this->load->library('generallib');
$this->generallib->commonfunction('delivery_orderadd','deliveryorder','aftersave', $deliveryorder_id);
	
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>