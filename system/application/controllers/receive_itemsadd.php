<?php

class receive_itemsadd extends Controller {

	function receive_itemsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['receiveditem__date'] = '';
$data['receiveditem__orderid'] = '';$this->load->library('generallib');
$data['receiveditem__orderid'] = $this->generallib->genId('Receive Items');
$data['receiveditem__suratjalanno'] = '';$this->load->library('generallib');
$data['receiveditem__suratjalanno'] = $this->generallib->genId('Receive Items');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['receiveditem__supplier_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['receiveditem__warehouse_id'] = '';
$data['receiveditem__lastupdate'] = '';
$data['receiveditem__updatedby'] = '';
$data['receiveditem__created'] = '';
$data['receiveditem__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['receiveditem__date'] = $_POST['date'];}if (isset($_POST['orderid']) && $_POST['orderid'] != -1){$data['receiveditem__orderid'] = $_POST['orderid'];}if (isset($_POST['suratjalanno']) && $_POST['suratjalanno'] != -1){$data['receiveditem__suratjalanno'] = $_POST['suratjalanno'];}if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1){$data['receiveditem__supplier_id'] = $_POST['supplier_id'];}if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1){$data['receiveditem__warehouse_id'] = $_POST['warehouse_id'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['receiveditem__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['receiveditem__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['receiveditem__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['receiveditem__createdby'] = $_POST['createdby'];}
if (!isset($_POST['purchaseorderline__id'])) { echo 'You must at least tick one option'; return; }
$purchaseorderline_ids = $_POST['purchaseorderline__id'];
$linedata = array();
foreach ($purchaseorderline_ids as $purchaseorderline_id)
{
$this->db->where('id', $purchaseorderline_id);
$qq = $this->db->get('purchaseorderline');
if (isset($qq->row()->supplier_id)) {
if ($data['receiveditem__supplier_id'] > 0 && $data['receiveditem__supplier_id'] != $qq->row()->supplier_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['receiveditem__supplier_id'] = $qq->row()->supplier_id;
}
if (isset($qq->row()->warehouse_id)) {
if ($data['receiveditem__warehouse_id'] > 0 && $data['receiveditem__warehouse_id'] != $qq->row()->warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['receiveditem__warehouse_id'] = $qq->row()->warehouse_id;
}
if (isset($qq->row()->item_id))
$linedata['receiveditemline__item_id'] = $qq->row()->item_id;
else
$linedata['receiveditemline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytoreceive))
$linedata['receiveditemline__quantitytoreceive'] = $qq->row()->quantitytoreceive;
else
$linedata['receiveditemline__quantitytoreceive'] = null;
if (isset($qq->row()->uom_id))
$linedata['receiveditemline__uom_id'] = $qq->row()->uom_id;
else
$linedata['receiveditemline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->purchaseorderline_id))
$linedata['receiveditemline__purchaseorderline_id'] = $qq->row()->purchaseorderline_id;
else
$linedata['receiveditemline__purchaseorderline_id'] = null;
$purchaseorderline_opt = array();
$purchaseorderline_opt[''] = 'None';
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchaseorderline_opt[$row->id] = $row->orderid; }
$data['purchaseorderline_opt'] = $purchaseorderline_opt;
if (isset($qq->row()->serialno))
$linedata['receiveditemline__serialno'] = $qq->row()->serialno;
else
$linedata['receiveditemline__serialno'] = null;
if (isset($qq->row()->expireddate))
$linedata['receiveditemline__expireddate'] = $qq->row()->expireddate;
else
$linedata['receiveditemline__expireddate'] = null;
if (isset($qq->row()->hscode))
$linedata['receiveditemline__hscode'] = $qq->row()->hscode;
else
$linedata['receiveditemline__hscode'] = null;
if (isset($qq->row()->packinglist))
$linedata['receiveditemline__packinglist'] = $qq->row()->packinglist;
else
$linedata['receiveditemline__packinglist'] = null;
if (isset($qq->row()->lastupdate))
$linedata['receiveditemline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['receiveditemline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['receiveditemline__updatedby'] = $qq->row()->updatedby;
else
$linedata['receiveditemline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['receiveditemline__created'] = $qq->row()->created;
else
$linedata['receiveditemline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['receiveditemline__createdby'] = $qq->row()->createdby;
else
$linedata['receiveditemline__createdby'] = null;
$linedata['receiveditemline__purchaseorderline_id'] = $purchaseorderline_id;
$data['receiveditemline_data'][$purchaseorderline_id] = $linedata;
}
		

		$this->load->view('receive_items_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['receiveditem__date']) && ($_POST['receiveditem__date'] == "" || $_POST['receiveditem__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid']) && ($_POST['receiveditem__orderid'] == "" || $_POST['receiveditem__orderid'] == null))
$error .= "<span class='error'>Receive Item No must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid'])) {
$this->db->where('orderid', $_POST['receiveditem__orderid']);
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0) $error .= "<span class='error'>Receive Item No must be unique"."</span><br>";}

if (isset($_POST['receiveditem__suratjalanno']) && ($_POST['receiveditem__suratjalanno'] == "" || $_POST['receiveditem__suratjalanno'] == null))
$error .= "<span class='error'>Surat Jalan No must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__supplier_id']) || ($_POST['receiveditem__supplier_id'] == "" || $_POST['receiveditem__supplier_id'] == null  || $_POST['receiveditem__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__warehouse_id']) || ($_POST['receiveditem__warehouse_id'] == "" || $_POST['receiveditem__warehouse_id'] == null  || $_POST['receiveditem__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['receiveditem__date']))
$this->db->set('date', "str_to_date('".$_POST['receiveditem__date']."', '%d-%m-%Y')", false);if (isset($_POST['receiveditem__orderid']))
$data['orderid'] = $_POST['receiveditem__orderid'];if (isset($_POST['receiveditem__suratjalanno']))
$data['suratjalanno'] = $_POST['receiveditem__suratjalanno'];if (isset($_POST['receiveditem__supplier_id']))
$data['supplier_id'] = $_POST['receiveditem__supplier_id'];if (isset($_POST['receiveditem__warehouse_id']))
$data['warehouse_id'] = $_POST['receiveditem__warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('receiveditem', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$receiveditem_id = $this->db->insert_id();


$length = count($_POST['receiveditemline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['receiveditemline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['receiveditemline__item_id'][$i];
if (isset($_POST['receiveditemline__quantitytoreceive'][$i]))
$coldata[$i]['quantitytoreceive'] = $_POST['receiveditemline__quantitytoreceive'][$i];
if (isset($_POST['receiveditemline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['receiveditemline__uom_id'][$i];
if (isset($_POST['receiveditemline__purchaseorderline_id'][$i]))
$coldata[$i]['purchaseorderline_id'] = $_POST['receiveditemline__purchaseorderline_id'][$i];
if (isset($_POST['receiveditemline__serialno'][$i]))
$coldata[$i]['serialno'] = $_POST['receiveditemline__serialno'][$i];
if (isset($_POST['receiveditemline__expireddate'][$i]))
$coldata[$i]['expireddate'] = $_POST['receiveditemline__expireddate'][$i];
if (isset($_POST['receiveditemline__hscode'][$i]))
$coldata[$i]['hscode'] = $_POST['receiveditemline__hscode'][$i];
if (isset($_POST['receiveditemline__packinglist'][$i]))
$coldata[$i]['packinglist'] = $_POST['receiveditemline__packinglist'][$i];
if (isset($_POST['receiveditemline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['receiveditemline__lastupdate'][$i];
if (isset($_POST['receiveditemline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['receiveditemline__updatedby'][$i];
if (isset($_POST['receiveditemline__created'][$i]))
$coldata[$i]['created'] = $_POST['receiveditemline__created'][$i];
if (isset($_POST['receiveditemline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['receiveditemline__createdby'][$i];
$coldata[$i]['receiveditem_id'] = $receiveditem_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('receiveditemline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('receive_itemsadd','receiveditem','aftersave', $receiveditem_id);
			
		
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