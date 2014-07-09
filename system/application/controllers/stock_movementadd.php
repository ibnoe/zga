<?php

class stock_movementadd extends Controller {

	function stock_movementadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['moveaction__date'] = '';
$data['moveaction__orderid'] = '';$this->load->library('generallib');
$data['moveaction__orderid'] = $this->generallib->genId('Stock Movement');
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__from_warehouse_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__to_warehouse_id'] = '';
$data['moveaction__lastupdate'] = '';
$data['moveaction__updatedby'] = '';
$data['moveaction__created'] = '';
$data['moveaction__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['moveaction__date'] = $_POST['date'];}if (isset($_POST['orderid']) && $_POST['orderid'] != -1){$data['moveaction__orderid'] = $_POST['orderid'];}if (isset($_POST['from_warehouse_id']) && $_POST['from_warehouse_id'] != -1){$data['moveaction__from_warehouse_id'] = $_POST['from_warehouse_id'];}if (isset($_POST['to_warehouse_id']) && $_POST['to_warehouse_id'] != -1){$data['moveaction__to_warehouse_id'] = $_POST['to_warehouse_id'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['moveaction__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['moveaction__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['moveaction__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['moveaction__createdby'] = $_POST['createdby'];}
if (!isset($_POST['moveorderline__id'])) { echo 'You must at least tick one option'; return; }
$moveorderline_ids = $_POST['moveorderline__id'];
$linedata = array();
foreach ($moveorderline_ids as $moveorderline_id)
{
$this->db->where('id', $moveorderline_id);
$qq = $this->db->get('moveorderline');
if (isset($qq->row()->from_warehouse_id)) {
if ($data['moveaction__from_warehouse_id'] > 0 && $data['moveaction__from_warehouse_id'] != $qq->row()->from_warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['moveaction__from_warehouse_id'] = $qq->row()->from_warehouse_id;
}
if (isset($qq->row()->to_warehouse_id)) {
if ($data['moveaction__to_warehouse_id'] > 0 && $data['moveaction__to_warehouse_id'] != $qq->row()->to_warehouse_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['moveaction__to_warehouse_id'] = $qq->row()->to_warehouse_id;
}
if (isset($qq->row()->item_id))
$linedata['moveactionline__item_id'] = $qq->row()->item_id;
else
$linedata['moveactionline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytomove))
$linedata['moveactionline__quantitytomove'] = $qq->row()->quantitytomove;
else
$linedata['moveactionline__quantitytomove'] = null;
if (isset($qq->row()->uom_id))
$linedata['moveactionline__uom_id'] = $qq->row()->uom_id;
else
$linedata['moveactionline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->moveorderline_id))
$linedata['moveactionline__moveorderline_id'] = $qq->row()->moveorderline_id;
else
$linedata['moveactionline__moveorderline_id'] = null;
$moveorderline_opt = array();
$moveorderline_opt[''] = 'None';
$q = $this->db->get('moveorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $moveorderline_opt[$row->id] = $row->orderid; }
$data['moveorderline_opt'] = $moveorderline_opt;
if (isset($qq->row()->lastupdate))
$linedata['moveactionline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['moveactionline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['moveactionline__updatedby'] = $qq->row()->updatedby;
else
$linedata['moveactionline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['moveactionline__created'] = $qq->row()->created;
else
$linedata['moveactionline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['moveactionline__createdby'] = $qq->row()->createdby;
else
$linedata['moveactionline__createdby'] = null;
$linedata['moveactionline__moveorderline_id'] = $moveorderline_id;
$data['moveactionline_data'][$moveorderline_id] = $linedata;
}
		

		$this->load->view('stock_movement_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['moveaction__date']) && ($_POST['moveaction__date'] == "" || $_POST['moveaction__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['moveaction__orderid']) && ($_POST['moveaction__orderid'] == "" || $_POST['moveaction__orderid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['moveaction__orderid'])) {
$this->db->where('orderid', $_POST['moveaction__orderid']);
$q = $this->db->get('moveaction');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveaction__date']))
$this->db->set('date', "str_to_date('".$_POST['moveaction__date']."', '%d-%m-%Y')", false);if (isset($_POST['moveaction__orderid']))
$data['orderid'] = $_POST['moveaction__orderid'];if (isset($_POST['moveaction__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['moveaction__from_warehouse_id'];if (isset($_POST['moveaction__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['moveaction__to_warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('moveaction', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$moveaction_id = $this->db->insert_id();


$length = count($_POST['moveactionline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['moveactionline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['moveactionline__item_id'][$i];
if (isset($_POST['moveactionline__quantitytomove'][$i]))
$coldata[$i]['quantitytomove'] = $_POST['moveactionline__quantitytomove'][$i];
if (isset($_POST['moveactionline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['moveactionline__uom_id'][$i];
if (isset($_POST['moveactionline__moveorderline_id'][$i]))
$coldata[$i]['moveorderline_id'] = $_POST['moveactionline__moveorderline_id'][$i];
if (isset($_POST['moveactionline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['moveactionline__lastupdate'][$i];
if (isset($_POST['moveactionline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['moveactionline__updatedby'][$i];
if (isset($_POST['moveactionline__created'][$i]))
$coldata[$i]['created'] = $_POST['moveactionline__created'][$i];
if (isset($_POST['moveactionline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['moveactionline__createdby'][$i];
$coldata[$i]['moveaction_id'] = $moveaction_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('moveactionline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_movementadd','moveaction','aftersave', $moveaction_id);
			
		
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