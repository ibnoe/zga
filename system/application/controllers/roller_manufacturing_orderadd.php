<?php

class roller_manufacturing_orderadd extends Controller {

	function roller_manufacturing_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['manufacturingorder__idstring'] = '';$this->load->library('generallib');
$data['manufacturingorder__idstring'] = $this->generallib->genId('Roller Manufacturing Order');
$data['manufacturingorder__date'] = '';
$rcn_opt = array();
$rcn_opt[''] = 'None';
$q = $this->db->get('rcn');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['manufacturingorder__rcn_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorder__item_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__from_warehouse_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__to_warehouse_id'] = '';
$bom_opt = array();
$bom_opt[''] = 'None';
$q = $this->db->get('bom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $bom_opt[$row->id] = $row->name; }
$data['bom_opt'] = $bom_opt;
$data['manufacturingorder__bom_id'] = '';
$data['manufacturingorder__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorder__uom_id'] = '';
$data['manufacturingorder__type'] = 'roller_manufacturing_order';
$data['manufacturingorder__lastupdate'] = '';
$data['manufacturingorder__updatedby'] = '';
$data['manufacturingorder__created'] = '';
$data['manufacturingorder__createdby'] = '';
		

		$this->load->view('roller_manufacturing_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['manufacturingorder__idstring']) && ($_POST['manufacturingorder__idstring'] == "" || $_POST['manufacturingorder__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingorder__idstring'])) {
$this->db->where('idstring', $_POST['manufacturingorder__idstring']);
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['manufacturingorder__date']) && ($_POST['manufacturingorder__date'] == "" || $_POST['manufacturingorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__rcn_id']) || ($_POST['manufacturingorder__rcn_id'] == "" || $_POST['manufacturingorder__rcn_id'] == null  || $_POST['manufacturingorder__rcn_id'] == null))
$error .= "<span class='error'>RCN must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__item_id']) || ($_POST['manufacturingorder__item_id'] == "" || $_POST['manufacturingorder__item_id'] == null  || $_POST['manufacturingorder__item_id'] == null))
$error .= "<span class='error'>Roll must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__from_warehouse_id']) || ($_POST['manufacturingorder__from_warehouse_id'] == "" || $_POST['manufacturingorder__from_warehouse_id'] == null  || $_POST['manufacturingorder__from_warehouse_id'] == null))
$error .= "<span class='error'>Raw Material Location must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__to_warehouse_id']) || ($_POST['manufacturingorder__to_warehouse_id'] == "" || $_POST['manufacturingorder__to_warehouse_id'] == null  || $_POST['manufacturingorder__to_warehouse_id'] == null))
$error .= "<span class='error'>Finish Goods Location must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__bom_id']) || ($_POST['manufacturingorder__bom_id'] == "" || $_POST['manufacturingorder__bom_id'] == null  || $_POST['manufacturingorder__bom_id'] == null))
$error .= "<span class='error'>Bill Of Material must not be empty"."</span><br>";

if (isset($_POST['manufacturingorder__quantity']) && ($_POST['manufacturingorder__quantity'] == "" || $_POST['manufacturingorder__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__uom_id']) || ($_POST['manufacturingorder__uom_id'] == "" || $_POST['manufacturingorder__uom_id'] == null  || $_POST['manufacturingorder__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingorder__idstring']))
$data['idstring'] = $_POST['manufacturingorder__idstring'];if (isset($_POST['manufacturingorder__date']))
$this->db->set('date', "str_to_date('".$_POST['manufacturingorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['manufacturingorder__rcn_id']))
$data['rcn_id'] = $_POST['manufacturingorder__rcn_id'];if (isset($_POST['manufacturingorder__item_id']))
$data['item_id'] = $_POST['manufacturingorder__item_id'];if (isset($_POST['manufacturingorder__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['manufacturingorder__from_warehouse_id'];if (isset($_POST['manufacturingorder__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['manufacturingorder__to_warehouse_id'];if (isset($_POST['manufacturingorder__bom_id']))
$data['bom_id'] = $_POST['manufacturingorder__bom_id'];if (isset($_POST['manufacturingorder__quantity']))
$data['quantity'] = $_POST['manufacturingorder__quantity'];if (isset($_POST['manufacturingorder__uom_id']))
$data['uom_id'] = $_POST['manufacturingorder__uom_id'];if (isset($_POST['manufacturingorder__type']))
$data['type'] = $_POST['manufacturingorder__type'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('manufacturingorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$manufacturingorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('roller_manufacturing_orderadd','manufacturingorder','aftersave', $manufacturingorder_id);
			
		
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