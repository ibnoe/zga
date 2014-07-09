<?php

class sales_returnadd extends Controller {

	function sales_returnadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['sreturn__orderid'] = '';
$data['sreturn__date'] = '';
$sorder_opt = array();
$q = $this->db->get('sorder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $sorder_opt[$row->id] = $row->orderid; }
$data['sorder_opt'] = $sorder_opt;
$data['sreturn__sorder_id'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['sreturn__to_id'] = '';
$data['sreturn__'] = '';
		

		$this->load->view('sales_return_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['sreturn__orderid']) && ($_POST['sreturn__orderid'] == "" || $_POST['sreturn__orderid'] == null))
$error .= "<span class='error'>Order ID must not be empty"."</span><br>";

if (isset($_POST['sreturn__orderid'])) {
$this->db->where('orderid', $_POST['sreturn__orderid']);
$q = $this->db->get('sreturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['sreturn__to_id']) && ($_POST['sreturn__to_id'] == "" || $_POST['sreturn__to_id'] == null))
$error .= "<span class='error'>Return To Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['sreturn__orderid']))
$data['orderid'] = $_POST['sreturn__orderid'];if (isset($_POST['sreturn__date']))
$data['date'] = $_POST['sreturn__date'];if (isset($_POST['sreturn__sorder_id']))
$data['sorder_id'] = $_POST['sreturn__sorder_id'];if (isset($_POST['sreturn__to_id']))
$data['to_id'] = $_POST['sreturn__to_id'];if (isset($_POST['sreturn__']))
$data[''] = $_POST['sreturn__'];
$this->db->insert('sreturn', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>