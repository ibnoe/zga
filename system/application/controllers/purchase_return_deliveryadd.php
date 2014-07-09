<?php

class purchase_return_deliveryadd extends Controller {

	function purchase_return_deliveryadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturndelivery__date'] = '';
$data['purchasereturndelivery__purchasereturndeliveryid'] = '';$this->load->library('generallib');
$data['purchasereturndelivery__purchasereturndeliveryid'] = $this->generallib->genId('Purchase Return Delivery');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturndelivery__supplier_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['purchasereturndelivery__warehouse_id'] = '';
$data['purchasereturndelivery__notes'] = '';
$data['purchasereturndelivery__lastupdate'] = '';
$data['purchasereturndelivery__updatedby'] = '';
$data['purchasereturndelivery__created'] = '';
$data['purchasereturndelivery__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['purchasereturndelivery__date'] = $_POST['date'];}if (isset($_POST['purchasereturndeliveryid']) && $_POST['purchasereturndeliveryid'] != -1){$data['purchasereturndelivery__purchasereturndeliveryid'] = $_POST['purchasereturndeliveryid'];}if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1){$data['purchasereturndelivery__supplier_id'] = $_POST['supplier_id'];}if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1){$data['purchasereturndelivery__warehouse_id'] = $_POST['warehouse_id'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['purchasereturndelivery__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['purchasereturndelivery__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['purchasereturndelivery__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['purchasereturndelivery__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['purchasereturndelivery__createdby'] = $_POST['createdby'];}
if (!isset($_POST['purchasereturnorderline__id'])) { echo 'You must at least tick one option'; return; }
$purchasereturnorderline_ids = $_POST['purchasereturnorderline__id'];
$linedata = array();
foreach ($purchasereturnorderline_ids as $purchasereturnorderline_id)
{
$this->db->where('id', $purchasereturnorderline_id);
$qq = $this->db->get('purchasereturnorderline');
if (isset($qq->row()->supplier_id)) {
if ($data['purchasereturndelivery__supplier_id'] > 0 && $data['purchasereturndelivery__supplier_id'] != $qq->row()->supplier_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturndelivery__supplier_id'] = $qq->row()->supplier_id;
}
if (isset($qq->row()->warehouse_id)) {
if ($data['purchasereturndelivery__warehouse_id'] > 0 && $data['purchasereturndelivery__warehouse_id'] != $qq->row()->warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturndelivery__warehouse_id'] = $qq->row()->warehouse_id;
}
if (isset($qq->row()->item_id))
$linedata['purchasereturndeliveryline__item_id'] = $qq->row()->item_id;
else
$linedata['purchasereturndeliveryline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytosendactual))
$linedata['purchasereturndeliveryline__quantitytosend'] = $qq->row()->quantitytosendactual;
else
$linedata['purchasereturndeliveryline__quantitytosend'] = null;
if (isset($qq->row()->uom_id))
$linedata['purchasereturndeliveryline__uom_id'] = $qq->row()->uom_id;
else
$linedata['purchasereturndeliveryline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->purchasereturnorderline_id))
$linedata['purchasereturndeliveryline__purchasereturnorderline_id'] = $qq->row()->purchasereturnorderline_id;
else
$linedata['purchasereturndeliveryline__purchasereturnorderline_id'] = null;
$purchasereturnorderline_opt = array();
$purchasereturnorderline_opt[''] = 'None';
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturnorderline_opt[$row->id] = $row->purchasereturnorderid; }
$data['purchasereturnorderline_opt'] = $purchasereturnorderline_opt;
if (isset($qq->row()->lastupdate))
$linedata['purchasereturndeliveryline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['purchasereturndeliveryline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['purchasereturndeliveryline__updatedby'] = $qq->row()->updatedby;
else
$linedata['purchasereturndeliveryline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['purchasereturndeliveryline__created'] = $qq->row()->created;
else
$linedata['purchasereturndeliveryline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['purchasereturndeliveryline__createdby'] = $qq->row()->createdby;
else
$linedata['purchasereturndeliveryline__createdby'] = null;
$linedata['purchasereturndeliveryline__purchasereturnorderline_id'] = $purchasereturnorderline_id;
$data['purchasereturndeliveryline_data'][$purchasereturnorderline_id] = $linedata;
}
		

		$this->load->view('purchase_return_delivery_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturndelivery__date']) && ($_POST['purchasereturndelivery__date'] == "" || $_POST['purchasereturndelivery__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturndelivery__purchasereturndeliveryid']) && ($_POST['purchasereturndelivery__purchasereturndeliveryid'] == "" || $_POST['purchasereturndelivery__purchasereturndeliveryid'] == null))
$error .= "<span class='error'>Delivery No must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__supplier_id']) || ($_POST['purchasereturndelivery__supplier_id'] == "" || $_POST['purchasereturndelivery__supplier_id'] == null  || $_POST['purchasereturndelivery__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndelivery__warehouse_id']) || ($_POST['purchasereturndelivery__warehouse_id'] == "" || $_POST['purchasereturndelivery__warehouse_id'] == null  || $_POST['purchasereturndelivery__warehouse_id'] == null))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturndelivery__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturndelivery__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturndelivery__purchasereturndeliveryid']))
$data['purchasereturndeliveryid'] = $_POST['purchasereturndelivery__purchasereturndeliveryid'];if (isset($_POST['purchasereturndelivery__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturndelivery__supplier_id'];if (isset($_POST['purchasereturndelivery__warehouse_id']))
$data['warehouse_id'] = $_POST['purchasereturndelivery__warehouse_id'];if (isset($_POST['purchasereturndelivery__notes']))
$data['notes'] = $_POST['purchasereturndelivery__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturndelivery', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturndelivery_id = $this->db->insert_id();


$length = count($_POST['purchasereturndeliveryline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['purchasereturndeliveryline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['purchasereturndeliveryline__item_id'][$i];
if (isset($_POST['purchasereturndeliveryline__quantitytosend'][$i]))
$coldata[$i]['quantitytosend'] = $_POST['purchasereturndeliveryline__quantitytosend'][$i];
if (isset($_POST['purchasereturndeliveryline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['purchasereturndeliveryline__uom_id'][$i];
if (isset($_POST['purchasereturndeliveryline__purchasereturnorderline_id'][$i]))
$coldata[$i]['purchasereturnorderline_id'] = $_POST['purchasereturndeliveryline__purchasereturnorderline_id'][$i];
if (isset($_POST['purchasereturndeliveryline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['purchasereturndeliveryline__lastupdate'][$i];
if (isset($_POST['purchasereturndeliveryline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['purchasereturndeliveryline__updatedby'][$i];
if (isset($_POST['purchasereturndeliveryline__created'][$i]))
$coldata[$i]['created'] = $_POST['purchasereturndeliveryline__created'][$i];
if (isset($_POST['purchasereturndeliveryline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['purchasereturndeliveryline__createdby'][$i];
$coldata[$i]['purchasereturndelivery_id'] = $purchasereturndelivery_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('purchasereturndeliveryline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_deliveryadd','purchasereturndelivery','aftersave', $purchasereturndelivery_id);
			
		
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