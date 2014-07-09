<?php

class move_order_between_warehouseadd extends Controller {

	function move_order_between_warehouseadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['porder__orderid'] = '';
$data['porder__date'] = '';
$data['porder__notes'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__from_id'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__to_id'] = '';
$data['porder__'] = '';
		

		$this->load->view('move_order_between_warehouse_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['porder__orderid']) && ($_POST['porder__orderid'] == "" || $_POST['porder__orderid'] == null))
$error .= "<span class='error'>Order ID must not be empty"."</span><br>";

if (isset($_POST['porder__orderid'])) {
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
$data['to_id'] = $_POST['porder__to_id'];if (isset($_POST['porder__']))
$data[''] = $_POST['porder__'];
$this->db->insert('porder', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>