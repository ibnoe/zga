<?php

class purchase_returnadd extends Controller {

	function purchase_returnadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['preturn__orderid'] = '';
$data['preturn__date'] = '';
$porder_opt = array();
$q = $this->db->get('porder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $porder_opt[$row->id] = $row->orderid; }
$data['porder_opt'] = $porder_opt;
$data['preturn__porder_id'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['preturn__to_id'] = '';
$data['preturn__'] = '';
		

		$this->load->view('purchase_return_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['preturn__orderid']) && ($_POST['preturn__orderid'] == "" || $_POST['preturn__orderid'] == null))
$error .= "<span class='error'>Order ID must not be empty"."</span><br>";

if (isset($_POST['preturn__orderid'])) {
$this->db->where('orderid', $_POST['preturn__orderid']);
$q = $this->db->get('preturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['preturn__to_id']) && ($_POST['preturn__to_id'] == "" || $_POST['preturn__to_id'] == null))
$error .= "<span class='error'>Return To Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['preturn__orderid']))
$data['orderid'] = $_POST['preturn__orderid'];if (isset($_POST['preturn__date']))
$data['date'] = $_POST['preturn__date'];if (isset($_POST['preturn__porder_id']))
$data['porder_id'] = $_POST['preturn__porder_id'];if (isset($_POST['preturn__to_id']))
$data['to_id'] = $_POST['preturn__to_id'];if (isset($_POST['preturn__']))
$data[''] = $_POST['preturn__'];
$this->db->insert('preturn', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>