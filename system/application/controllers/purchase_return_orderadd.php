<?php

class purchase_return_orderadd extends Controller {

	function purchase_return_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturnorder__date'] = '';
$data['purchasereturnorder__purchasereturnorderid'] = '';$this->load->library('generallib');
$data['purchasereturnorder__purchasereturnorderid'] = $this->generallib->genId('Purchase Return Order');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnorder__supplier_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnorder__currency_id'] = '';
$data['purchasereturnorder__currencyrate'] = '';
$data['purchasereturnorder__notes'] = '';
$data['purchasereturnorder__lastupdate'] = '';
$data['purchasereturnorder__updatedby'] = '';
$data['purchasereturnorder__created'] = '';
$data['purchasereturnorder__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['purchasereturnorder__date'] = $_POST['date'];}if (isset($_POST['purchasereturnorderid']) && $_POST['purchasereturnorderid'] != -1){$data['purchasereturnorder__purchasereturnorderid'] = $_POST['purchasereturnorderid'];}if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1){$data['purchasereturnorder__supplier_id'] = $_POST['supplier_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['purchasereturnorder__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['purchasereturnorder__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['purchasereturnorder__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['purchasereturnorder__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['purchasereturnorder__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['purchasereturnorder__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['purchasereturnorder__createdby'] = $_POST['createdby'];}
if (!isset($_POST['receiveditemline__id'])) { echo 'You must at least tick one option'; return; }
$receiveditemline_ids = $_POST['receiveditemline__id'];
$linedata = array();
foreach ($receiveditemline_ids as $receiveditemline_id)
{
$this->db->where('id', $receiveditemline_id);
$qq = $this->db->get('receiveditemline');
if (isset($qq->row()->supplier_id)) {
if ($data['purchasereturnorder__supplier_id'] > 0 && $data['purchasereturnorder__supplier_id'] != $qq->row()->supplier_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnorder__supplier_id'] = $qq->row()->supplier_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['purchasereturnorder__currency_id'] > 0 && $data['purchasereturnorder__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnorder__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->item_id))
$linedata['purchasereturnorderline__item_id'] = $qq->row()->item_id;
else
$linedata['purchasereturnorderline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytosend))
$linedata['purchasereturnorderline__quantitytosend'] = $qq->row()->quantitytosend;
else
$linedata['purchasereturnorderline__quantitytosend'] = null;
if (isset($qq->row()->uom_id))
$linedata['purchasereturnorderline__uom_id'] = $qq->row()->uom_id;
else
$linedata['purchasereturnorderline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->receiveditemline_id))
$linedata['purchasereturnorderline__receiveditemline_id'] = $qq->row()->receiveditemline_id;
else
$linedata['purchasereturnorderline__receiveditemline_id'] = null;
$receiveditemline_opt = array();
$receiveditemline_opt[''] = 'None';
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $receiveditemline_opt[$row->id] = $row->orderid; }
$data['receiveditemline_opt'] = $receiveditemline_opt;
if (isset($qq->row()->lastupdate))
$linedata['purchasereturnorderline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['purchasereturnorderline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['purchasereturnorderline__updatedby'] = $qq->row()->updatedby;
else
$linedata['purchasereturnorderline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['purchasereturnorderline__created'] = $qq->row()->created;
else
$linedata['purchasereturnorderline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['purchasereturnorderline__createdby'] = $qq->row()->createdby;
else
$linedata['purchasereturnorderline__createdby'] = null;
$linedata['purchasereturnorderline__receiveditemline_id'] = $receiveditemline_id;
$data['purchasereturnorderline_data'][$receiveditemline_id] = $linedata;
}
		

		$this->load->view('purchase_return_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturnorder__date']) && ($_POST['purchasereturnorder__date'] == "" || $_POST['purchasereturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid']) && ($_POST['purchasereturnorder__purchasereturnorderid'] == "" || $_POST['purchasereturnorder__purchasereturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorder__purchasereturnorderid'])) {
$this->db->where('purchasereturnorderid', $_POST['purchasereturnorder__purchasereturnorderid']);
$q = $this->db->get('purchasereturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['purchasereturnorder__supplier_id']) || ($_POST['purchasereturnorder__supplier_id'] == "" || $_POST['purchasereturnorder__supplier_id'] == null  || $_POST['purchasereturnorder__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnorder__currency_id']) || ($_POST['purchasereturnorder__currency_id'] == "" || $_POST['purchasereturnorder__currency_id'] == null  || $_POST['purchasereturnorder__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnorder__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturnorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturnorder__purchasereturnorderid']))
$data['purchasereturnorderid'] = $_POST['purchasereturnorder__purchasereturnorderid'];if (isset($_POST['purchasereturnorder__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturnorder__supplier_id'];if (isset($_POST['purchasereturnorder__currency_id']))
$data['currency_id'] = $_POST['purchasereturnorder__currency_id'];if (isset($_POST['purchasereturnorder__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturnorder__currencyrate'];if (isset($_POST['purchasereturnorder__notes']))
$data['notes'] = $_POST['purchasereturnorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturnorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnorder_id = $this->db->insert_id();


$length = count($_POST['purchasereturnorderline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['purchasereturnorderline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['purchasereturnorderline__item_id'][$i];
if (isset($_POST['purchasereturnorderline__quantitytosend'][$i]))
$coldata[$i]['quantitytosend'] = $_POST['purchasereturnorderline__quantitytosend'][$i];
if (isset($_POST['purchasereturnorderline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['purchasereturnorderline__uom_id'][$i];
if (isset($_POST['purchasereturnorderline__receiveditemline_id'][$i]))
$coldata[$i]['receiveditemline_id'] = $_POST['purchasereturnorderline__receiveditemline_id'][$i];
if (isset($_POST['purchasereturnorderline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['purchasereturnorderline__lastupdate'][$i];
if (isset($_POST['purchasereturnorderline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['purchasereturnorderline__updatedby'][$i];
if (isset($_POST['purchasereturnorderline__created'][$i]))
$coldata[$i]['created'] = $_POST['purchasereturnorderline__created'][$i];
if (isset($_POST['purchasereturnorderline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['purchasereturnorderline__createdby'][$i];
$coldata[$i]['purchasereturnorder_id'] = $purchasereturnorder_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('purchasereturnorderline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_orderadd','purchasereturnorder','aftersave', $purchasereturnorder_id);
			
		
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