<?php

class move_order_between_warehouseedit extends Controller {

	function move_order_between_warehouseedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_between_warehouse_id=0)
	{
		
$q = $this->db->where('id', $move_order_between_warehouse_id);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_between_warehouse_id'] = $move_order_between_warehouse_id;
foreach ($q->result() as $r) {
$data['porder__orderid'] = $r->orderid;
$data['porder__date'] = $r->date;
$data['porder__notes'] = $r->notes;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__from_id'] = $r->from_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__to_id'] = $r->to_id;
$data['porder__orderid'] = $r->orderid;
$data['porder__date'] = $r->date;
$data['porder__notes'] = $r->notes;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__from_id'] = $r->from_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__to_id'] = $r->to_id;
$data['porder__'] = $r->;}
$this->load->view('move_order_between_warehouse_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['porder__orderid'])) {$this->db->where("id !=", $_POST['move_order_between_warehouse_id']);
$this->db->where('orderid', $_POST['porder__orderid']);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['porder__orderid'])) {$this->db->where("id !=", $_POST['move_order_between_warehouse_id']);
$this->db->where('orderid', $_POST['porder__orderid']);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['porder__orderid']))
$data['orderid'] = $_POST['porder__orderid'];if (isset($_POST['porder__date']))
$data['date'] = $_POST['porder__date'];if (isset($_POST['porder__notes']))
$data['notes'] = $_POST['porder__notes'];if (isset($_POST['porder__from_id']))
$data['from_id'] = $_POST['porder__from_id'];if (isset($_POST['porder__to_id']))
$data['to_id'] = $_POST['porder__to_id'];if (isset($_POST['porder__orderid']))
$data['orderid'] = $_POST['porder__orderid'];if (isset($_POST['porder__date']))
$data['date'] = $_POST['porder__date'];if (isset($_POST['porder__notes']))
$data['notes'] = $_POST['porder__notes'];if (isset($_POST['porder__from_id']))
$data['from_id'] = $_POST['porder__from_id'];if (isset($_POST['porder__to_id']))
$data['to_id'] = $_POST['porder__to_id'];if (isset($_POST['porder__']))
$data[''] = $_POST['porder__'];
$this->db->where('id', $_POST['move_order_between_warehouse_id']);
$this->db->update('porder', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>