<?php

class sales_return_deliveryadd extends Controller {

	function sales_return_deliveryadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturndelivery__date'] = '';
$data['salesreturndelivery__salesreturndeliveryid'] = '';$this->load->library('generallib');
$data['salesreturndelivery__salesreturndeliveryid'] = $this->generallib->genId('Sales Return Delivery');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturndelivery__customer_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['salesreturndelivery__warehouse_id'] = '';
$data['salesreturndelivery__notes'] = '';
$data['salesreturndelivery__lastupdate'] = '';
$data['salesreturndelivery__updatedby'] = '';
$data['salesreturndelivery__created'] = '';
$data['salesreturndelivery__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['salesreturndelivery__date'] = $_POST['date'];}if (isset($_POST['salesreturndeliveryid']) && $_POST['salesreturndeliveryid'] != -1){$data['salesreturndelivery__salesreturndeliveryid'] = $_POST['salesreturndeliveryid'];}if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1){$data['salesreturndelivery__customer_id'] = $_POST['customer_id'];}if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1){$data['salesreturndelivery__warehouse_id'] = $_POST['warehouse_id'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['salesreturndelivery__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['salesreturndelivery__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['salesreturndelivery__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['salesreturndelivery__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['salesreturndelivery__createdby'] = $_POST['createdby'];}
if (!isset($_POST['salesreturnorderline__id'])) { echo 'You must at least tick one option'; return; }
$salesreturnorderline_ids = $_POST['salesreturnorderline__id'];
$linedata = array();
foreach ($salesreturnorderline_ids as $salesreturnorderline_id)
{
$this->db->where('id', $salesreturnorderline_id);
$qq = $this->db->get('salesreturnorderline');
if (isset($qq->row()->customer_id)) {
if ($data['salesreturndelivery__customer_id'] > 0 && $data['salesreturndelivery__customer_id'] != $qq->row()->customer_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturndelivery__customer_id'] = $qq->row()->customer_id;
}
if (isset($qq->row()->warehouse_id)) {
if ($data['salesreturndelivery__warehouse_id'] > 0 && $data['salesreturndelivery__warehouse_id'] != $qq->row()->warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturndelivery__warehouse_id'] = $qq->row()->warehouse_id;
}
if (isset($qq->row()->item_id))
$linedata['salesreturndeliveryline__item_id'] = $qq->row()->item_id;
else
$linedata['salesreturndeliveryline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytoreceiveactual))
$linedata['salesreturndeliveryline__quantitytoreceive'] = $qq->row()->quantitytoreceiveactual;
else
$linedata['salesreturndeliveryline__quantitytoreceive'] = null;
if (isset($qq->row()->uom_id))
$linedata['salesreturndeliveryline__uom_id'] = $qq->row()->uom_id;
else
$linedata['salesreturndeliveryline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->salesreturnorderline_id))
$linedata['salesreturndeliveryline__salesreturnorderline_id'] = $qq->row()->salesreturnorderline_id;
else
$linedata['salesreturndeliveryline__salesreturnorderline_id'] = null;
$salesreturnorderline_opt = array();
$salesreturnorderline_opt[''] = 'None';
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesreturnorderline_opt[$row->id] = $row->salesreturnorderid; }
$data['salesreturnorderline_opt'] = $salesreturnorderline_opt;
if (isset($qq->row()->lastupdate))
$linedata['salesreturndeliveryline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['salesreturndeliveryline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['salesreturndeliveryline__updatedby'] = $qq->row()->updatedby;
else
$linedata['salesreturndeliveryline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['salesreturndeliveryline__created'] = $qq->row()->created;
else
$linedata['salesreturndeliveryline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['salesreturndeliveryline__createdby'] = $qq->row()->createdby;
else
$linedata['salesreturndeliveryline__createdby'] = null;
$linedata['salesreturndeliveryline__salesreturnorderline_id'] = $salesreturnorderline_id;
$data['salesreturndeliveryline_data'][$salesreturnorderline_id] = $linedata;
}
		

		$this->load->view('sales_return_delivery_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesreturndelivery__date']) && ($_POST['salesreturndelivery__date'] == "" || $_POST['salesreturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturndelivery__salesreturndeliveryid']) && ($_POST['salesreturndelivery__salesreturndeliveryid'] == "" || $_POST['salesreturndelivery__salesreturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__customer_id']) || ($_POST['salesreturndelivery__customer_id'] == "" || $_POST['salesreturndelivery__customer_id'] == null  || $_POST['salesreturndelivery__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturndelivery__warehouse_id']) || ($_POST['salesreturndelivery__warehouse_id'] == "" || $_POST['salesreturndelivery__warehouse_id'] == null  || $_POST['salesreturndelivery__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturndelivery__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturndelivery__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturndelivery__salesreturndeliveryid']))
$data['salesreturndeliveryid'] = $_POST['salesreturndelivery__salesreturndeliveryid'];if (isset($_POST['salesreturndelivery__customer_id']))
$data['customer_id'] = $_POST['salesreturndelivery__customer_id'];if (isset($_POST['salesreturndelivery__warehouse_id']))
$data['warehouse_id'] = $_POST['salesreturndelivery__warehouse_id'];if (isset($_POST['salesreturndelivery__notes']))
$data['notes'] = $_POST['salesreturndelivery__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesreturndelivery', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturndelivery_id = $this->db->insert_id();


$length = count($_POST['salesreturndeliveryline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['salesreturndeliveryline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['salesreturndeliveryline__item_id'][$i];
if (isset($_POST['salesreturndeliveryline__quantitytoreceive'][$i]))
$coldata[$i]['quantitytoreceive'] = $_POST['salesreturndeliveryline__quantitytoreceive'][$i];
if (isset($_POST['salesreturndeliveryline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['salesreturndeliveryline__uom_id'][$i];
if (isset($_POST['salesreturndeliveryline__salesreturnorderline_id'][$i]))
$coldata[$i]['salesreturnorderline_id'] = $_POST['salesreturndeliveryline__salesreturnorderline_id'][$i];
if (isset($_POST['salesreturndeliveryline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['salesreturndeliveryline__lastupdate'][$i];
if (isset($_POST['salesreturndeliveryline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['salesreturndeliveryline__updatedby'][$i];
if (isset($_POST['salesreturndeliveryline__created'][$i]))
$coldata[$i]['created'] = $_POST['salesreturndeliveryline__created'][$i];
if (isset($_POST['salesreturndeliveryline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['salesreturndeliveryline__createdby'][$i];
$coldata[$i]['salesreturndelivery_id'] = $salesreturndelivery_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('salesreturndeliveryline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_deliveryadd','salesreturndelivery','aftersave', $salesreturndelivery_id);
			
		
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