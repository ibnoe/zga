<?php

class store_finished_productsadd extends Controller {

	function store_finished_productsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['morder__orderid'] = '';
$data['morder__date'] = '';
$data['morder__notes'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__from_id'] = '';
$contact_opt = array();
$q = $this->db->get('contact');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__to_id'] = '';
$data['morder__'] = '';
		

		$this->load->view('store_finished_products_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['morder__orderid']) && ($_POST['morder__orderid'] == "" || $_POST['morder__orderid'] == null))
$error .= "<span class='error'>Order ID must not be empty"."</span><br>";

if (isset($_POST['morder__orderid'])) {
$this->db->where('orderid', $_POST['morder__orderid']);
$q = $this->db->get('morder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['morder__orderid']))
$data['orderid'] = $_POST['morder__orderid'];if (isset($_POST['morder__date']))
$data['date'] = $_POST['morder__date'];if (isset($_POST['morder__notes']))
$data['notes'] = $_POST['morder__notes'];if (isset($_POST['morder__from_id']))
$data['from_id'] = $_POST['morder__from_id'];if (isset($_POST['morder__to_id']))
$data['to_id'] = $_POST['morder__to_id'];if (isset($_POST['morder__']))
$data[''] = $_POST['morder__'];
$this->db->insert('morder', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>