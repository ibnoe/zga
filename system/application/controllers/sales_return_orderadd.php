<?php

class sales_return_orderadd extends Controller {

	function sales_return_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturnorder__date'] = '';
$data['salesreturnorder__salesreturnorderid'] = '';$this->load->library('generallib');
$data['salesreturnorder__salesreturnorderid'] = $this->generallib->genId('Sales Return Order');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnorder__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnorder__currency_id'] = '';
$data['salesreturnorder__currencyrate'] = '';
$data['salesreturnorder__notes'] = '';
$data['salesreturnorder__lastupdate'] = '';
$data['salesreturnorder__updatedby'] = '';
$data['salesreturnorder__created'] = '';
$data['salesreturnorder__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['salesreturnorder__date'] = $_POST['date'];}if (isset($_POST['salesreturnorderid']) && $_POST['salesreturnorderid'] != -1){$data['salesreturnorder__salesreturnorderid'] = $_POST['salesreturnorderid'];}if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1){$data['salesreturnorder__customer_id'] = $_POST['customer_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['salesreturnorder__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['salesreturnorder__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['salesreturnorder__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['salesreturnorder__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['salesreturnorder__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['salesreturnorder__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['salesreturnorder__createdby'] = $_POST['createdby'];}
if (!isset($_POST['deliveryorderline__id'])) { echo 'You must at least tick one option'; return; }
$deliveryorderline_ids = $_POST['deliveryorderline__id'];
$linedata = array();
foreach ($deliveryorderline_ids as $deliveryorderline_id)
{
$this->db->where('id', $deliveryorderline_id);
$qq = $this->db->get('deliveryorderline');
if (isset($qq->row()->customer_id)) {
if ($data['salesreturnorder__customer_id'] > 0 && $data['salesreturnorder__customer_id'] != $qq->row()->customer_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnorder__customer_id'] = $qq->row()->customer_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['salesreturnorder__currency_id'] > 0 && $data['salesreturnorder__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnorder__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->item_id))
$linedata['salesreturnorderline__item_id'] = $qq->row()->item_id;
else
$linedata['salesreturnorderline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytoreceive))
$linedata['salesreturnorderline__quantitytoreceive'] = $qq->row()->quantitytoreceive;
else
$linedata['salesreturnorderline__quantitytoreceive'] = null;
if (isset($qq->row()->uom_id))
$linedata['salesreturnorderline__uom_id'] = $qq->row()->uom_id;
else
$linedata['salesreturnorderline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->deliveryorderline_id))
$linedata['salesreturnorderline__deliveryorderline_id'] = $qq->row()->deliveryorderline_id;
else
$linedata['salesreturnorderline__deliveryorderline_id'] = null;
$deliveryorderline_opt = array();
$deliveryorderline_opt[''] = 'None';
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $deliveryorderline_opt[$row->id] = $row->orderid; }
$data['deliveryorderline_opt'] = $deliveryorderline_opt;
if (isset($qq->row()->lastupdate))
$linedata['salesreturnorderline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['salesreturnorderline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['salesreturnorderline__updatedby'] = $qq->row()->updatedby;
else
$linedata['salesreturnorderline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['salesreturnorderline__created'] = $qq->row()->created;
else
$linedata['salesreturnorderline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['salesreturnorderline__createdby'] = $qq->row()->createdby;
else
$linedata['salesreturnorderline__createdby'] = null;
$linedata['salesreturnorderline__deliveryorderline_id'] = $deliveryorderline_id;
$data['salesreturnorderline_data'][$deliveryorderline_id] = $linedata;
}
		

		$this->load->view('sales_return_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesreturnorder__date']) && ($_POST['salesreturnorder__date'] == "" || $_POST['salesreturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid']) && ($_POST['salesreturnorder__salesreturnorderid'] == "" || $_POST['salesreturnorder__salesreturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid'])) {
$this->db->where('salesreturnorderid', $_POST['salesreturnorder__salesreturnorderid']);
$q = $this->db->get('salesreturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['salesreturnorder__customer_id']) || ($_POST['salesreturnorder__customer_id'] == "" || $_POST['salesreturnorder__customer_id'] == null  || $_POST['salesreturnorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturnorder__currency_id']) || ($_POST['salesreturnorder__currency_id'] == "" || $_POST['salesreturnorder__currency_id'] == null  || $_POST['salesreturnorder__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnorder__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturnorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturnorder__salesreturnorderid']))
$data['salesreturnorderid'] = $_POST['salesreturnorder__salesreturnorderid'];if (isset($_POST['salesreturnorder__customer_id']))
$data['customer_id'] = $_POST['salesreturnorder__customer_id'];if (isset($_POST['salesreturnorder__currency_id']))
$data['currency_id'] = $_POST['salesreturnorder__currency_id'];if (isset($_POST['salesreturnorder__currencyrate']))
$data['currencyrate'] = $_POST['salesreturnorder__currencyrate'];if (isset($_POST['salesreturnorder__notes']))
$data['notes'] = $_POST['salesreturnorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesreturnorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnorder_id = $this->db->insert_id();


$length = count($_POST['salesreturnorderline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['salesreturnorderline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['salesreturnorderline__item_id'][$i];
if (isset($_POST['salesreturnorderline__quantitytoreceive'][$i]))
$coldata[$i]['quantitytoreceive'] = $_POST['salesreturnorderline__quantitytoreceive'][$i];
if (isset($_POST['salesreturnorderline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['salesreturnorderline__uom_id'][$i];
if (isset($_POST['salesreturnorderline__deliveryorderline_id'][$i]))
$coldata[$i]['deliveryorderline_id'] = $_POST['salesreturnorderline__deliveryorderline_id'][$i];
if (isset($_POST['salesreturnorderline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['salesreturnorderline__lastupdate'][$i];
if (isset($_POST['salesreturnorderline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['salesreturnorderline__updatedby'][$i];
if (isset($_POST['salesreturnorderline__created'][$i]))
$coldata[$i]['created'] = $_POST['salesreturnorderline__created'][$i];
if (isset($_POST['salesreturnorderline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['salesreturnorderline__createdby'][$i];
$coldata[$i]['salesreturnorder_id'] = $salesreturnorder_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('salesreturnorderline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_orderadd','salesreturnorder','aftersave', $salesreturnorder_id);
			
		
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