<?php

class core_repairedit extends Controller {

	function core_repairedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($core_repair_id=0)
	{
		if ($core_repair_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $core_repair_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) {
$data = array();
$data['core_repair_id'] = $core_repair_id;
foreach ($q->result() as $r) {
$data['manufacturingorder__idstring'] = $r->idstring;
$data['manufacturingorder__date'] = $r->date;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorder__item_id'] = $r->item_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__to_warehouse_id'] = $r->to_warehouse_id;
$bom_opt = array();
$bom_opt[''] = 'None';
$q = $this->db->get('bom');
foreach ($q->result() as $row) { $bom_opt[$row->id] = $row->name; }
$data['bom_opt'] = $bom_opt;
$data['manufacturingorder__bom_id'] = $r->bom_id;
$data['manufacturingorder__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorder__uom_id'] = $r->uom_id;
$data['manufacturingorder__type'] = $r->type;
$data['manufacturingorder__lastupdate'] = $r->lastupdate;
$data['manufacturingorder__updatedby'] = $r->updatedby;
$data['manufacturingorder__created'] = $r->created;
$data['manufacturingorder__createdby'] = $r->createdby;}
$this->load->view('core_repair_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['manufacturingorder__idstring']) && ($_POST['manufacturingorder__idstring'] == "" || $_POST['manufacturingorder__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingorder__idstring'])) {$this->db->where("id !=", $_POST['core_repair_id']);
$this->db->where('idstring', $_POST['manufacturingorder__idstring']);
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['manufacturingorder__date']) && ($_POST['manufacturingorder__date'] == "" || $_POST['manufacturingorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__item_id']) || ($_POST['manufacturingorder__item_id'] == "" || $_POST['manufacturingorder__item_id'] == null  || $_POST['manufacturingorder__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__bom_id']) || ($_POST['manufacturingorder__bom_id'] == "" || $_POST['manufacturingorder__bom_id'] == null  || $_POST['manufacturingorder__bom_id'] == 0))
$error .= "<span class='error'>Bill Of Material must not be empty"."</span><br>";

if (isset($_POST['manufacturingorder__quantity']) && ($_POST['manufacturingorder__quantity'] == "" || $_POST['manufacturingorder__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorder__uom_id']) || ($_POST['manufacturingorder__uom_id'] == "" || $_POST['manufacturingorder__uom_id'] == null  || $_POST['manufacturingorder__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingorder__idstring']))
$data['idstring'] = $_POST['manufacturingorder__idstring'];if (isset($_POST['manufacturingorder__date']))
$this->db->set('date', "str_to_date('".$_POST['manufacturingorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['manufacturingorder__item_id']))
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
$this->db->where('id', $_POST['core_repair_id']);
$this->db->update('manufacturingorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('core_repairedit','manufacturingorder','afteredit', $_POST['core_repair_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
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